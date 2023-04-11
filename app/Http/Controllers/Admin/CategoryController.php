<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\DiscoverProduct;
use App\Models\ShopthelookProduct;
use App\Commonhelper;
use App\AWSHelper;
use DataTables;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;
use Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response

     * Page load then call first method.
     * @author Hitesh Khandar
     */
    public function __construct()
    {
        $this->moduleRouteText    = "admin.category";
        $this->moduleViewName    = "admin.category";
        $this->list_url            = route($this->moduleRouteText . ".index");
        $module                    = "Category";
        $this->module            = $module;
        $this->modelObj            = new Category();
        $this->path = "categories/";
        $this->cloud_front_path = env('CLOUDFRONTURL')."categories/";
    }

    /**
     * Display a listing of the resource.
     * @author Hitesh Khandar
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Category::query()->with('parent');
            return DataTables::eloquent($model)
                ->addColumn('action', function (Category $row) {
                    return view(
                        "admin.partials.action",
                        [
                            'currentRoute'    => $this->moduleRouteText,
                            'row'            => $row,
                            'isEdit'        => 1,
                            'isDelete'        => 1,
                        ]
                    )->render();
                })
                ->editColumn('created_at', function ($row) {
                    return Commonhelper::dateFormatChange($row->created_at);
                })
                ->editColumn('is_parent', function ($row) {
                    $is_parent = $row->parent;
                    if ($row->parent_id > 0) {
                        $is_parent = $row->parent->name;
                    }
                    return $is_parent;
                })
                ->editColumn('image', function ($row) {
                    if ($row->image && Storage::disk('s3')->has($this->path .  $row->image)) {
                        $category_image =$this->cloud_front_path . $row->image;
                    } else {
                        $category_image =  '/images/default-img.png';
                    }
                    return '<img  width="100" src="' . url($category_image) . '" class="img-thumbnail" alt="category">';
                })
                ->editColumn('status', function (Category $row) {
                    $checked = "";
                    if ($row->status == 1) {
                        $checked = "checked";
                    }
                    return '<input type="checkbox" ' . $checked . ' data-toggle="toggle" data-on="Active" data-off="Inactive" onchange="statusChange(' . $row->id . ')" data-onstyle="success" data-offstyle="danger" class="toggle-demo" id="toggle-demo">';
                })
                ->rawColumns(['image', 'is_parent', 'status', 'action'])
                ->filter(function ($query) {

                    if (!empty(request()->get("search_parent_category"))) {
                        $query = $query->where("parent_id", request()->get("search_parent_category"));
                    }
                    if (request()->get("search")['value'] != '') {
                        $query = $query->where("name", 'LIKE', '%'. request()->get("search")['value'].'%');

                    }
                })
                ->make(true);
        } else {
            $data['parent_category'] = Category::where('parent_id', 0)->pluck('name', 'id')->toArray();
            $data['module']        = $this->module;
            $data['page_title']    = "List";
            return view($this->moduleViewName . '.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @author Hitesh Khandar
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $data = array(
            "formObj"             => $this->modelObj,
            "module"             => $this->module,
            "page_title"         => "Create",
            "action_url"         => $this->moduleRouteText . ".store",
            "action_params"     => $this->modelObj->id,
            "method"             => "POST",
            "statusData"         => ['1' => 'Active', '0' => 'Inactive'],
            "selectedStatusID"  => 1,
            "selectedParentID"  => null,
            "discoverStatusData"         => ['1' => 'Active', '0' => 'Inactive'],
            "selecteddiscoverStatusID"  => null,
            "shopthelookStatusData"         => ['1' => 'Active', '0' => 'Inactive'],
            "selectedShopthelookStatusID"  => null,
        );
        $data['parent_category'] = Category::where('parent_id', 0)->pluck('name', 'id')->toArray();
        $data['discover_products'] = array();
        $data['shopthelook_products'] = array();
        return view($this->moduleViewName . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {

            $category = new Category();
            $category->name        = $request->name;
            $category->parent_id   = $request->parent_id;
            $category->status      = $request->status;
            $category->description  = $request->description;
            $category->is_show_size_chart  = ($request->is_show_size_chart) ? $request->is_show_size_chart : 0;
            $category->meta_title  = $request->meta_title;
            $category->meta_keywords  = $request->meta_keywords;
            $category->meta_description  = $request->meta_description;

            if ($request->has('image')) {
                $image = AWSHelper::uploadImageS3($request, 'image', $this->path);
                $category->image = $image;
            }
            if ($request->has('icon')) {
                $icon = Commonhelper::uploadFileWithThumbnail($request, 'icon', NULL, $thumbnailPath = $this->path, $resizeH = 24, $resizeW = 24);
                $category->icon = $icon;
            }
            if ($request->has('banner_image')) {
                $banner_image = Commonhelper::uploadFileWithThumbnail($request, 'banner_image', $this->path, $thumbnailPath = NULL, $resizeH = 300, $resizeW = 1920);
                $category->banner_image = $banner_image;
            }
            $category->save();
        } catch (\Exception $e) {
            return redirect()->route($this->moduleViewName . '.create')->with('error', $e->getMessage());
        }
        return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'category']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $selectedDiscoverProducts = DiscoverProduct::where('category_id', $id)->pluck('product_id')->all();
        $selectedshopthelookProducts = ShopthelookProduct::where('category_id', $id)->pluck('product_id')->all();

        $data = array(
            "formObj"             => $category,
            "module"             => $this->module,
            "page_title"         => "Update",
            "action_url"         => $this->moduleRouteText . ".update",
            "action_params"     => $category->id,
            "method"             => "PUT",
            "statusData"         => ['1' => 'Active', '0' => 'Inactive'],
            "selectedStatusID"  => $category->status,
            "selectedParentID"  => $category->parent_id,
            "discoverStatusData"         => ['1' => 'Active', '0' => 'Inactive'],
            "selecteddiscoverStatusID"  => $category->discover_status,
            "shopthelookStatusData"         => ['1' => 'Active', '0' => 'Inactive'],
            "selectedShopthelookStatusID"  => $category->shopthelook_status,
            "selectedDiscoverProducts"  => $selectedDiscoverProducts,
            "selectedshopthelookProducts"  => $selectedshopthelookProducts,
            "cloud_front_url"=> $this->cloud_front_path,
        );

        $data['parent_category'] = Category::where('parent_id', 0)->pluck('name', 'id')->toArray();
        $condition_id = ($category->parent_id > 0) ? 'sub_cat_id' : 'cat_id';
        $data['discover_products'] = Product::where($condition_id, $id)->pluck('name', 'id')->toArray();
        $data['shopthelook_products'] = Product::where($condition_id, $id)->pluck('name', 'id')->toArray();

        return view($this->moduleViewName . '.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {

        $category  = Category::find($id);
        $category->name        = $request->name;
        $category->parent_id   = $request->parent_id;
        $category->status      = $request->status;
        $category->description  = $request->description;
        $category->is_show_size_chart  = $request->is_show_size_chart;
        $category->discover_status = $request->discover_status;
        $category->meta_title  = $request->meta_title;
        $category->meta_keywords  = $request->meta_keywords;
        $category->meta_description  = $request->meta_description;
        $category->shopthelook_status = $request->shopthelook_status;

        if ($request->has('image')) {
            $image = AWSHelper::uploadImageS3($request, 'image', $this->path, $category->image);
            $category->image = $image;
        }
        if ($request->has('icon')) {
            $icon = Commonhelper::uploadFileWithThumbnail($request, 'icon', $this->path, $thumbnailPath = NULL, $resizeH = 24, $resizeW = 24, $category->icon);
            $category->icon = $icon;
        }
        if ($request->has('banner_image')) {
            $banner_image = Commonhelper::uploadFileWithThumbnail($request, 'banner_image', $this->path, $thumbnailPath = NULL, $resizeH = 300, $resizeW = 1920, $category->banner_image);
            $category->banner_image = $banner_image;
        }

        /*Discover Image*/
        if ($request->has('discover_image')) {
            $discover_image = Commonhelper::uploadFileWithThumbnail($request, 'discover_image', $this->path, $thumbnailPath = NULL, $resizeH = 819, $resizeW = 842, $category->discover_image);

            $category->discover_image = $discover_image;
        }

        DiscoverProduct::where('category_id', $id)->delete();
        if (!empty($request->discover_product_id)) {
            $discoverProducts = array();
            foreach ($request->discover_product_id as $value) {
                $discoverProducts[] = array('category_id' => $id, 'product_id' => $value, "created_at" => Carbon::now(), "updated_at" => Carbon::now());
            }
            DiscoverProduct::insert($discoverProducts);
        }
        /*Shop The Look Image*/
        if ($request->has('shopthelook_image')) {
            $shopthelook_image = Commonhelper::uploadFileWithThumbnail($request, 'shopthelook_image', $this->path, $thumbnailPath = NULL, $resizeH = 819, $resizeW = 842, $category->shopthelook_image);

            $category->shopthelook_image = $shopthelook_image;
        }

        ShopthelookProduct::where('category_id', $id)->delete();
        if (!empty($request->shopthelook_product_id)) {
            $shopthelookProducts = array();
            foreach ($request->shopthelook_product_id as $value) {
                $shopthelookProducts[] = array('category_id' => $id, 'product_id' => $value, "created_at" => Carbon::now(), "updated_at" => Carbon::now());
            }
            ShopthelookProduct::insert($shopthelookProducts);
        }

        $category->save();

        return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.update_message', ['title' => 'category']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        if ($category->image) {
            if (file_exists(public_path($this->path . $category->image))) {
                AWSHelper::deleteImageS3(public_path($this->path . $category->image));
            }
        }
        if ($category->icon) {
            if (file_exists(public_path($this->path . $category->icon))) {
                Commonhelper::deleteFile(public_path($this->path . $category->icon));
            }
        }
        return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'category']), 'data' => array()]);
    }
    public function updateStatus(Request $request)
    {
        $status = Category::where('id', request('id'))->first();

        if ($status->status == 1) {
            $dataUpdate = array(
                "status" => 0
            );
            $statusMessage = "Inactive";
            Category::where('id', request('id'))->update($dataUpdate);
        } else {

            $dataUpdate = array(
                "status" => 1
            );
            $statusMessage = "Active";
            Category::where('id', request('id'))->update($dataUpdate);
        }

        //return response(['status' => 200, "msg" => $this->module ." has been $statusMessage successfully."]);
        return response(['status' => 200, "msg" =>  __('messages.status_message', ['title' => $this->module, 'status_type' => $statusMessage])]);
        //return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'carrier']));
    }
    public function searchCateProduct(Request $request)
    {
        $term = trim($request->searchTerm);
        $condition_id = ($request->parent_id > 0) ? 'sub_cat_id' : 'cat_id';

        if (empty($term)) {
            return \Response::json([]);
        }
        $products = Product::select("id", "name")->where($condition_id, $request->cate_id)->where('name', 'LIKE', "%$term%")->get();

        /*Get Products*/
        $searchItems = [];
        if (count($products) > 0) {
            foreach ($products as $product) {
                $searchItems[] = ['id' => $product->id, 'text' => $product->name];
            }
        }
        return \Response::json($searchItems);
    }
}
