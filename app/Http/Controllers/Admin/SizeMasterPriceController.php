<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SizeMasterPrice;
use App\Commonhelper;
use DataTables;
use Config;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;
use App\Models\Size;
use App\Models\Country;
use App\Models\Category;

class SizeMasterPriceController extends Controller
{
    public function __construct()
    {
        $this->moduleRouteText  = "admin.size-master-price";
        $this->moduleViewName   = "admin.sizemasterprice";
        $this->list_url         = route($this->moduleRouteText . ".index");
        $module                 = "Size master price";
        $this->module           = $module;
        $this->modelObj         = new SizeMasterPrice();
        $this->path = "";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {

    //         $model = SizeMasterPrice::query()->with('size','country');
    //         return DataTables::eloquent($model)
    //             ->addColumn('action', function (SizeMasterPrice $row) {
    //                 return view(
    //                     "admin.partials.action",
    //                     [
    //                         'currentRoute'  => $this->moduleRouteText,
    //                         'row'           => $row,
    //                         'isEdit'        => 1,
    //                         'isDelete'      => 1,
    //                     ]
    //                 )->render();
    //             })
    //             ->editColumn('price', function ($row) {
    //                 $price = "";
    //                 if($row->price){
    //                     $price = $row->price . '%';
    //                 }
    //                 return $price;
    //             })
    //             // ->editColumn('size_id', function ($row) {
    //             //     $size_id = "";
    //             //     if($row->size_id){
    //             //         $size_id = $row->size->name;
    //             //     }
    //             //     return $size_id;
    //             // })
    //             // ->editColumn('country_id', function ($row) {
    //             //     $country_id = "";
    //             //     if($row->country_id){
    //             //         $country_id = $row->country->name;
    //             //     }
    //             //     return $country_id;
    //             // })
    //             ->editColumn('status', function (SizeMasterPrice $row) {
    //                 $checked = "";
    //                 if ($row->status == 1) {
    //                     $checked = "checked";
    //                 }
    //                 return '<input type="checkbox" ' . $checked . ' data-toggle="toggle" data-on="Active" data-off="Inactive" onchange="statusChange(' . $row->id . ')" data-onstyle="success" data-offstyle="danger" class="toggle-demo" id="toggle-demo">';
    //             })
    //             ->rawColumns(['price','status','action','size_id'])
    //             ->make(true);
    //     } else {
    //         $data['module']     = $this->module;
    //         $data['page_title'] = "List";
    //         return view($this->moduleViewName . '.index', $data);
    //     }
    // }

    public function index()
    {
        $sizeMasterPrices = SizeMasterPrice::get();
       
        $size = Size::pluck('name', 'name')->toArray();
        asort($size);
        
        $data = array(
            "formObj"           => $this->modelObj,
            "module"            => $this->module,
            "page_title"        => "Create",
            "action_url"        => $this->moduleRouteText . ".store",
            "action_params"     => $this->modelObj->id,
            "method"            => "POST",
            "size"              => $size,
            'sizeMasterPrices'  => $sizeMasterPrices,
            'selectedParentID'  => ""
        );
        
        $data['parent_category'] = Category::where('parent_id', 0)
                                                ->whereIn('slug',['rings','bracelets','bangles'])
                                                ->pluck('name', 'id')
                                                ->toArray();

        return view($this->moduleViewName . '.create', $data);
    }

    public function store(Request $request)
    {
        SizeMasterPrice::truncate();
        
        try{
            $priceArray = [];
            foreach ($request->category as $key => $category) {   
                if($category){
                    $minSize = ($request->min_size[$key]) ? $request->min_size[$key] : null ;
                    $maxSize = ($request->max_size[$key]) ? $request->max_size[$key] : null ;
                    $price = ($request->price[$key]) ? $request->price[$key] : null ;
                    
                    $priceArray[] = [
                        'price' => $price,
                        'min_size' => $minSize,
                        'max_size' => $maxSize,
                        'category_id' => $category,
                        'created_at'=> date("Y-m-d H:i:s"),
                        'updated_at'=> date("Y-m-d H:i:s"),
                    ];
                }
            }
            DB::table('size_master_prices')->insert($priceArray);

            return redirect()->route($this->moduleRouteText . '.index')->with('success', __('messages.create_message', ['title' => 'size master price']));
        } catch (\Exception $e) {
            return redirect()->route($this->moduleRouteText . '.index')->with('error', $e->getMessage());
        }
    }

    public function deletePrices(Request $request){
        
        $sizeMasterPrice = SizeMasterPrice::where('id',$request->id)->first();
        if($sizeMasterPrice){
            $sizeMasterPrice->delete();
        }
      
        return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'size price']), 'msg' => 'delete']);
    }

    public function updateContent(Request $request)
    {
        $id =  $request->id;
        $value =  $request->value;
        $field =  $request->field;
        
        SizeMasterPrice::where('id', $id )->update([$field => $value]);

        return response()->json(['code' => 200, 'message' => 'The size price has been successfully updated.', 'msg' => 'update']);
    }

    public function sizeChange(Request $request){
        $size = Size::where('category_id',$request->value)->pluck('name','name')->toArray();
        asort($size);
    
        return response()->json(['code' => 200, 'data' => $size]);
    }
}
