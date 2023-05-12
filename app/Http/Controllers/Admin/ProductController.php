<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use App\Models\ProductMetalMaterial;
use App\Models\ProductSize;
use App\Models\ProductShape;
use App\Models\ProductImage;
use App\Models\Metal;
use App\Models\Material;
use App\Models\Size;
use App\Models\Shape;
use App\Models\Packet;
use App\Models\Category;
use App\Models\Clarity;
use App\Models\Color;
use App\Commonhelper;
use App\Models\MaterialMetal;
use App\Models\ProductShapePacket;
use App\Models\ProductCenterDiamondClarity;
use App\Models\ProductCenterDiamondColor;
use App\Models\ProductSideDiamondClarity;
use App\Models\ProductSideDiamondColor;
use App\Models\Labour;
use App\Models\Country;
use App\Models\ProductCenterDiamondPacket;
use App\Models\ProductSideDiamondPacket;

use DataTables;

use DB;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Page load then call first method.
     * @author Hitesh Khandar
     */
    public function __construct()
    {
        $this->moduleRouteText    = "admin.product";
        $this->moduleViewName    = "admin.product";
        $this->list_url            = route($this->moduleRouteText . ".index");
        $module                    = "Product";
        $this->module            = $module;
        $this->modelObj            = new Product();
        $this->path = "uploads/product/";
    }

    /**
     * Display a listing of the resource.
     * @author Hitesh Khandar
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Product::query()->with('category','subcategory','singleProductImages');
            return DataTables::eloquent($model)
                ->addColumn('action', function (Product $row) {
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
                ->editColumn('price', function ($row) {
                    return '&#8377; ' .$row->price;
                })

                ->editColumn('category', function ($row) {
                    $category = $row->category;
                    if($row->cat_id > 0){
                        $category = $row->category->name;
                    }
					return $category;
				})
                ->editColumn('subcategory', function ($row) {
                    $subcategory = '';
                    if($row->sub_cat_id > 0){
                        $subcategory = $row->subcategory->name;
                    }
					return $subcategory;
				})
                ->editColumn('image', function ($row) {
                    $product_image =  '/images/default-img.png';

                    if(isset($row->singleProductImages) && $row->singleProductImages['image_path']){
                        $product_image = $row->singleProductImages['image_path'];
                    }

                    return '<img  width="100" src="'.url($product_image).'" class="img-thumbnail" alt="category">';
                })

                ->editColumn('status', function (Product $row) {
                    $checked = "";
                    if ($row->status == 1) {
                        $checked = "checked";
                    }
                    return '<input type="checkbox" ' . $checked . ' data-toggle="toggle" data-on="Active" data-off="Inactive" onchange="statusChange(' . $row->id . ')" data-onstyle="success" data-offstyle="danger" class="toggle-demo" id="toggle-demo">';
                })
                ->rawColumns(['price','image','category','subcategory','status', 'action'])
                ->make(true);
        } else {
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
            "selectedcatID"  => null,
            "selectedsubcatID"  => null,
            "selectMetalDisplayPrio"=>null,
        );
        $data['category'] = Category::where('parent_id', 0)->pluck('name', 'id')->toArray();
        $data['metals'] = Metal::select('id', 'name')->Active()->get();
        $data['labour_type'] = Labour::Active()->pluck('name', 'id')->toArray();
        $data['selectedLabourTypeID'] = null;

        $data['materials'] = Material::select('id', 'name')->Active()->get();
        $data['sizes'] =  Size::Active()->pluck('name', 'id'); //Size::pluck('name', 'id')->toArray();
        $data['selectedSize'] = array();
        $data['selectedSizePercentage'] = null;

        /*Image Shape and metal dropdown*/
        $shapes = Shape::select('id', 'name', 'image')->Active()->get();
        $shape_arr = array();
        if(!empty($shapes)){
            foreach($shapes as $shape){
                $shape_arr[$shape->id] = $shape->name;
            }
        }
        $data['shape_arr'] = $shape_arr;

        $metal_arr = array();
        if(!empty($data['metals'])){
            foreach($data['metals'] as $metal){
                $metal_arr[$metal->id] = $metal->name;
            }
        }
        $data['metal_arr'] = $metal_arr;

        $data['shapes'] = $shapes->pluck('name', 'id');
        $data['selectedShapeID'] = null;// $shapes->pluck('id')->toArray();
        $data['selectedShape'] = null;


        /*End Shape*/
        /*Diamond Clarity*/
        $diamond_clarity = Clarity::Active()->pluck('name', 'id');
        $data['center_diamond_clarity'] = $diamond_clarity;
        $data['selectedCenterDiamondClarityID'] = null;

        $data['side_diamond_clarity'] = $diamond_clarity;
        $data['selectedSideDiamondClarityID'] = null;
        /*End Center Diamond Clarity*/

        /*Center Diamond Color*/
        $diamond_color = Color::Active()->pluck('name', 'id');
        $data['center_diamond_color'] = $diamond_color;
        $data['selectedCenterDiamondColorID'] = null;
        $data['side_diamond_color'] = $diamond_color;
        $data['selectedSideDiamondColorID'] = null;// $shapes->pluck('id')->toArray();

        /*End Center Diamond Color*/

        /*Packet*/
        $data['packet'] = Packet::select(
            DB::raw("CONCAT(id,'-',color_id,'-',clarity_id,'-',price) AS id"),'name')->Active()->pluck('name', 'id')->toArray();

            //dd($data['packet']);
        /*End Packet*/

        $data['selected_metalmaterial'] = array();
        //$data['selected_shape'] = array();

        $materialmetal = MaterialMetal::query()->with('metal','material')->get()->toArray();

        $materialmetal_arr = array();
        if(count($materialmetal) > 0){
            foreach( $materialmetal as $key => $value){
                $material =  isset($value['material']['name']) ? $value['material']['name'].' ' : '';
                $material_id = isset($value['material_id']) ? '-'.$value['material_id'] : '';
                $materialmetal_arr[$value['metal_id'].$material_id] = $material.$value['metal']['name'];
            }
        }

        $data['materialmetal'] = $materialmetal_arr;
        $data['selected_materialmetal'] = array();
        $data['countrys'] = Country::select('id','name')->whereNotIn('slug', ['india'])->orderBy('sort_order', 'asc')->get();
        $data['countrymultiplyby'] = ['1' => 1,'2' => 1,'3' => 1,'4' => 1,'5' => 1,'6' => 1,'7' => 1];
        return view($this->moduleViewName . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @author Hitesh Khandar
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //dd($request->all());
        return $this->handleCreateOrUpdate($request);
    }

    /**
     * Display the specified resource.
     * @author Hitesh Khandar
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @author Hitesh Khandar
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $data = array(
            "formObj"             => $product,
            "module"             => $this->module,
            "page_title"         => "Update",
            "action_url"         => $this->moduleRouteText . ".update",
            "action_params"     => $product->id,
            "method"             => "PUT",
            "statusData"         => ['1' => 'Active', '0' => 'Inactive'],
            "selectedStatusID"  => $product->status,
            "selectedcatID"  => $product->cat_id,
            "selectedsubcatID"  => $product->sub_cat_id,
            "selectMetalDisplayPrio"=>$product->metal_display_priority_id,
        );

        $data['category'] = Category::where('parent_id', 0)->pluck('name', 'id')->toArray();
        $data['metals'] = Metal::select('id', 'name')->Active()->get();
        $data['materials'] = Material::select('id', 'name')->Active()->get();

        $data['sizes'] =  Size::Active()->pluck('name', 'id'); //Size::pluck('name', 'id')->toArray();
        $data['selectedSize'] = ProductSize::where('product_id', $id)->pluck('size_id')->all();

        $data['selectedSizePercentage'] = ProductSize::where('product_id', $id)->with('size')->get();
        //dd($data['selectedSize']);

        $data['labour_type'] = Labour::Active()->pluck('name', 'id')->toArray();
        $data['selectedLabourTypeID'] = $product->labour_type;

        /*Packet*/
        $data['packet'] = Packet::select(
            DB::raw("CONCAT(id,'-',color_id,'-',clarity_id,'-',price) AS id"),'name')->Active()->pluck('name', 'id')->toArray();
        /*End Packet*/

        /*Diamond Clarity*/
        $diamond_clarity = Clarity::Active()->pluck('name', 'id');
        $data['center_diamond_clarity'] = $diamond_clarity;
        $data['selectedCenterDiamondClarityID'] = ProductCenterDiamondClarity::where('product_id', $id)->pluck('clarity_id')->all();

        $data['side_diamond_clarity'] = $diamond_clarity;
        $data['selectedSideDiamondClarityID'] = ProductSideDiamondClarity::where('product_id', $id)->pluck('clarity_id')->all();
        /*End Diamond Clarity*/

        /*Diamond Color*/
        $diamond_color = Color::Active()->pluck('name', 'id');
        $data['center_diamond_color'] = $diamond_color;
        $data['selectedCenterDiamondColorID'] = ProductCenterDiamondColor::where('product_id', $id)->pluck('color_id')->all();

        $data['side_diamond_color'] = $diamond_color;
        $data['selectedSideDiamondColorID'] = ProductSideDiamondColor::where('product_id', $id)->pluck('color_id')->all();

        /*End Diamond Color*/


        $metal_arr = array();
        if(!empty($data['metals'])){
            foreach($data['metals'] as $metal){
                $metal_arr[$metal->id] = $metal->name;
            }
        }
        $data['metal_arr'] = $metal_arr;
        //$data['shapes'] = Shape::select('id', 'name', 'image')->Active()->get();


        $shapes = Shape::select('id', 'name', 'image')->Active()->get();
        $shape_arr = array();
        if(!empty($shapes)){
            foreach($shapes as $shape){
                $shape_arr[$shape->id] = $shape->name;
            }
        }
        $data['shape_arr'] = $shape_arr;

        $data['shapes'] = $shapes->pluck('name', 'id');
        $data['selectedShapeID'] = ProductShape::where('product_id', $id)->pluck('shape_id')->all();

        $data['selectedShape'] = ProductShape::where('product_id', $id)->with('shape')->get()->toArray();


        //$ProductShapePacket =  ProductShapePacket::where([['product_id', $product->id],['shape_id', 1]])->get()->toArray();
        //dd($ProductShapePacket);
        //echo count($data['selectedShape']);
        //dd($data['selectedShape']);

        $materialmetal = MaterialMetal::query()->with('metal','material')->get()->toArray();
        $materialmetal_arr = array();
        if(count($materialmetal) > 0){
            foreach( $materialmetal as $key => $value){
                $material =  isset($value['material']['name']) ? $value['material']['name'].' ' : '';
                $material_id = isset($value['material_id']) ? '-'.$value['material_id'] : '';
                $materialmetal_arr[$value['metal_id'].$material_id] = $material.$value['metal']['name'];
            }
        }
        $data['materialmetal'] = $materialmetal_arr;

        $selected_materialmetal = ProductMetalMaterial::select('metal_id','material_id')->where('product_id', $id)->get()->toArray();

        $selected_materialmetal_arr = array();
        if(count($selected_materialmetal) > 0){
            foreach( $selected_materialmetal as $key => $value){
                $material_id = isset($value['material_id']) ? '-'.$value['material_id'] : '';
                $selected_materialmetal_arr[] = $value['metal_id'].$material_id;
            }
        }
        //dd($selected_materialmetal_arr);
        $data['selected_materialmetal'] = $selected_materialmetal_arr;

        $data['productImages'] = ProductImage::where('product_id', $id)->get();

        $data['countrys'] = Country::select('id','name')->whereNotIn('slug', ['india'])->orderBy('sort_order', 'asc')->get();
        $data['countrymultiplyby']  = ['1' => 1,'2' => 1,'3' => 1,'4' => 1,'5' => 1,'6' => 1,'7' => 1];
        if($product->multiplyby){
            $data['countrymultiplyby']  = json_decode($product->multiplyby, true);
        }

       // dd($data['countrymultiplyby']);
        //dd($data['productImages']);
        return view($this->moduleViewName . '.create', $data);
    }

    /**
     * Update the specified resource in storage.
     * @author Hitesh Khandar
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        return $this->handleCreateOrUpdate($request, true, $id);
    }
    private function handleCreateOrUpdate($request, $edit = false, $id = null)
    {

        if ($edit) {
            $product  = Product::find($id);
            $msg = 'messages.update_message';
        } else {
            $product = new Product();
            $msg = 'messages.create_message';
        }

        DB::beginTransaction();
        // try {
            if ($request->description) {
                $dom = new \DomDocument();
                $dom->loadHtml($request->description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $request->description = $dom->saveHTML();
            }
            $product->cat_id = $request->cat_id;
            $product->sub_cat_id = $request->sub_cat_id;
            $product->name  = $request->name;
            $product->sku = $request->sku;
            if($request->is_all_include_price){
                $product->is_all_include_price = $request->is_all_include_price;
            }
            $product->description  = $request->description;
            $product->price  = $request->price;

            $category = Category::getInfoById($request->cat_id);
            $product->is_sales  = ($category->slug == 'sale') ? 1 : 0;

            $product->sales_price  = $request->sales_price;
            $product->quantity  = $request->quantity;
            $product->gender  = $request->gender;
            $product->clarity  = $request->clarity;
            $product->color  = $request->color;
            $product->igi_certified_text  = $request->igi_certified_text;
            $product->product_size  = $request->product_size;
            $product->made_in  = $request->made_in;
            $product->metal  = $request->metal;
            $product->stone  = $request->stone;
            $product->free_delivery  = $request->free_delivery;
            $product->diamond_weight  = $request->diamond_weight;

            $product->net_weight  = $request->net_weight;
            $product->grosswt  = $request->grosswt;

            $product->labour_type  = $request->labour_type;
            $product->other_expenses  = $request->other_expenses;

            $product->meta_title  = $request->meta_title;
            $product->meta_keywords  = $request->meta_keywords;
            $product->meta_description  = $request->meta_description;
            $product->metal_display_priority_id = $request->metal_display_priority;
            $product->multiplyby = json_encode($request->multiplyby);

            if($request->recommended){
                $product->recommended  = $request->recommended;
            }

            $product->is_solitaire  = ($request->is_solitaire) ? 1 : 0;

            if ($request->has('recommended_hover_image')) {
                $recommended_hover_image = Commonhelper::uploadFileWithThumbnail($request, 'recommended_hover_image', $this->path, $thumbnailPath = NULL, $resizeH = 560, $resizeW = 690);
                $product->recommended_hover_image = $recommended_hover_image;
            }

            if($request->has('igi_certified'))
            {
                $igi_certified = Commonhelper::uploadFileWithThumbnail($request, 'igi_certified', $this->path, $thumbnailPath = NULL, $resizeH = 560, $resizeW = 690);
                $product->igi_certified = $igi_certified;
            }
            $product->save();

            ProductMetalMaterial::where('product_id', $product->id)->delete();
            $metalmaterial_arr = $request->materialmetal;

            if(is_array($metalmaterial_arr)){
                foreach ($metalmaterial_arr as $value) {

                    $metalmaterial = explode('-',$value);
                    $metal_id = $metalmaterial[0];
                    $material_id = isset($metalmaterial[1]) ? $metalmaterial[1] : null;
                    $metalmaterial_data = array('product_id' => $product->id, 'metal_id' => $metal_id, 'material_id' =>  $material_id);
                    ProductMetalMaterial::create($metalmaterial_data);
                }

            }
            //ProductMetalMaterial::where('product_id',$product->id)->where('metal_id',$request->metal_display_priority)->update(['metal_display_priority_id'=>1]);

            ProductSize::where('product_id', $product->id)->delete();
            if (!empty($request->size)) {
                foreach ($request->size as $key => $value) {
                    $price_percentage = '';
                    if(isset($request->price_percentage)){
                        $price_percentage = $request->price_percentage[$key];
                    }
                    $size_data = array('product_id' => $product->id, 'size_id' =>  $value, 'price_percentage' =>  $price_percentage);
                    ProductSize::create($size_data);
                }
            }
            ProductShape::where('product_id', $product->id)->delete();
            ProductCenterDiamondPacket::where('product_id', $product->id)->delete();

            if (!empty($request->shape_ids)) {
                foreach ($request->shape_ids as $value) {

                    $shape_data = array('product_id' => $product->id, 'shape_id' =>  $value);
                    ProductShape::create($shape_data);
                    
                    if(!empty($request->center_diamonds_shape)){
                        if(count($request->center_diamonds_shape[$value]) > 0){

                            foreach ($request->center_diamonds_shape[$value] as $shape_packet) {
                                $shape_packet_arr = explode('-',$shape_packet);
                                if($shape_packet_arr[3] > 0){
                                    $packet_id = $shape_packet_arr[0];
                                    $color_id = $shape_packet_arr[1];
                                    $clarity_id = $shape_packet_arr[2];
                                    $weight = $request->center_diamonds_weight[$value];
                                    $pcs =  $request->center_diamonds_pcs[$value];
                                    $price =  $shape_packet_arr[3];

                                    $shapepacket_data = array('product_id' => $product->id,'shape_id' => $value, 'packet_id' => $packet_id, 'color_id' => $color_id, 'clarity_id' => $clarity_id,'weight' =>  $weight,'pcs' =>  $pcs,'price' => $price);
                                    ProductCenterDiamondPacket::create($shapepacket_data);
                                }
                            }
                        }
                    }
                }
                // ProductShape::where('product_id',$product->id)->where('shape_id',$request->shape_prio)->update(['shape_priority_id'=>1]);
            }

            ProductSideDiamondPacket::where('product_id', $product->id)->delete();
            if (!empty($request->side_diamonds_packet)) {
                if(count($request->side_diamonds_packet) > 0){
                    foreach ($request->side_diamonds_packet as $key => $side_dia_packet) {

                        if(!empty($side_dia_packet)){
                            if(count($side_dia_packet) > 0){
                                foreach ($side_dia_packet as $side_packet) {
                                    $side_packet_arr = explode('-',$side_packet);
                                    if($side_packet_arr[3] > 0){

                                    $packet_id = $side_packet_arr[0];
                                    $color_id = $side_packet_arr[1];
                                    $clarity_id = $side_packet_arr[2];
                                    $weight = $request->side_diamonds_wt[$key];
                                    $pcs =  $request->side_diamonds_pcs[$key];
                                    $price =  $request->side_diamonds_wt[$key] * $side_packet_arr[3];

                                    $shapepacket_data = array('product_id' => $product->id, 'packet_id' => $packet_id, 'color_id' => $color_id, 'clarity_id' => $clarity_id,'weight' =>  $weight,'pcs' =>  $pcs,'price' => $price,'row_index' => $key);
                                    ProductSideDiamondPacket::create($shapepacket_data);
                                    }
                                }
                            }
                        }

                    }
                }
            }

            ProductCenterDiamondClarity::where('product_id', $product->id)->delete();
            if (!empty($request->center_diamond_clarity)) {
                foreach ($request->center_diamond_clarity as $key => $value) {
                    $size_data = array('product_id' => $product->id, 'clarity_id' =>  $value);
                    ProductCenterDiamondClarity::create($size_data);
                }
            }

            ProductCenterDiamondColor::where('product_id', $product->id)->delete();
            if (!empty($request->center_diamond_color)) {
                foreach ($request->center_diamond_color as $key => $value) {
                    $size_data = array('product_id' => $product->id, 'color_id' =>  $value);
                    ProductCenterDiamondColor::create($size_data);
                }
            }

            ProductSideDiamondClarity::where('product_id', $product->id)->delete();
            if (!empty($request->side_diamond_clarity)) {
                foreach ($request->side_diamond_clarity as $key => $value) {
                    $size_data = array('product_id' => $product->id, 'clarity_id' =>  $value);
                    ProductSideDiamondClarity::create($size_data);
                }
            }

            ProductSideDiamondColor::where('product_id', $product->id)->delete();
            if (!empty($request->side_diamond_color)) {
                foreach ($request->side_diamond_color as $key => $value) {
                    $size_data = array('product_id' => $product->id, 'color_id' =>  $value);
                    ProductSideDiamondColor::create($size_data);
                }
            }

            /* if($request->multiplyby){
                foreach($request->multiplyby as $key => $value){
                    Country::where('id', $key)->update(['multiplyby' => $value]);
                }
            } */
           ProductImage::where('product_id',$product->id)->update(['metal_display_priority_id'=>0]);
            if($request->file('images'))
            {
                foreach($request->file('images') as $key => $productimages)
                {
                    foreach($productimages as $index => $file)
                    {
                        $videoPath = '';
                        $imagePath = '';
                        $imageName = '';
                        $filetype    =  explode("/", $file->getMimeType());
                        $video_type = 0;
                        $type = 0;
                        if($filetype[0] == 'video'){
                            $video = Commonhelper::compressImageVideo('video',$file,$this->path);
                            $imageName = $video['imageName'];
                            $videoPath = $video['videoPath'];
                            $imagePath = $video['imagePath'];
                            $video_type = 1;
                            $type = 1;
                        }
                        if($filetype[0] == 'image')
                        {
                            $image = Commonhelper::compressImageVideo('image',$file,$this->path);
                            $imageName = $image['imageName'];
                            $imagePath = env("CLOUDFRONTURL", "https://bonicajewels.s3.amazonaws.com/").'images/'.$imageName; //$image['imagePath'];

                        }
                        $shape_id = ($request->shape_arr[$key]) ? $request->shape_arr[$key] : null ;
                        $metal_id = ($request->metal_arr[$key]) ? $request->metal_arr[$key] : null ;
                
                        $image_data = array('product_id' => $product->id, 'shape_id' =>  $shape_id, 'metal_id' =>  $metal_id, 'image' =>  $imageName, 'image_path' =>  $imagePath ,'video_path' => $videoPath, 'video_type' =>  $video_type, 'type' =>  $type, 'sort_order' =>  1 + $index,'metal_display_priority_id'=>0);
                        ProductImage::create($image_data);
                    }
                }
            }
            ProductImage::where('product_id',$product->id)->where('metal_id',$request->metal_display_priority)->update(['metal_display_priority_id'=>1]);
            DB::commit();
            return redirect()->route($this->moduleViewName . '.index')->with('success', __($msg, ['title' => 'Product']));
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return redirect()->route($this->moduleViewName . '.edit', $id)->with('error', $e->getMessage());
        //     // something went wrong
        // }
    }
    /**
     * Remove the specified resource from storage.
     * @author Hitesh Khandar
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $productimages = ProductImage::select('image')->where('product_id',$id)->get();

        if(!empty($productimages)){
            foreach($productimages as $productimage){
                if (Storage::disk('s3')->exists('images/'.$productimage->image)) {
                    Storage::disk('s3')->delete('images/'.$productimage->image);
                }
            }
        }
        $product->delete();
        return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'Product']), 'data' => array()]);
    }
    public function deleteSideDiamondPacket(Request $request)
    {

        $product_id =  $request->product_id;
        $row_index =  $request->row_index;
        ProductSideDiamondPacket::where([['product_id', $product_id],['row_index', $row_index]])->delete();
        return response()->json(['code' => 200, 'msg' => 'delete']);
    }

    public function deleteImage(Request $request)
    {
        $id =  $request->id;
        $productimage = ProductImage::select('image')->where('id',$id)->first();
        if (Storage::disk('s3')->exists('images/'.$productimage->image)) {
            Storage::disk('s3')->delete('images/'.$productimage->image);
        }
        ProductImage::where('id', $id)->delete();
        return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'Image / Video']), 'msg' => 'delete']);
    }
    public function updateImageAttribute(Request $request)
    {
        $id =  $request->id;
        $value =  $request->value;
        $type =  $request->type;
        
        if($value == $request->metal_display_priority){
            ProductImage::where('id', $id )->update([$type => $value,'metal_display_priority_id'=>1]);
        }else{
            ProductImage::where('id', $id )->update([$type => $value,'metal_display_priority_id'=>0]);
        }
        return response()->json(['code' => 200, 'message' => 'The image attribute has been successfully updated.', 'msg' => 'update']);
    }
    public function updateStatus(Request $request)
    {
        $productStatus = Product::where('id', request('id'))->first();

        if ($productStatus->status == 1) {
            $dataUpdate = array(
                "status" => 0
            );
            $statusMessage = "Inactive";
            Product::where('id', request('id'))->update($dataUpdate);
        } else {

            $dataUpdate = array(
                "status" => 1
            );
            $statusMessage = "Active";
            Product::where('id', request('id'))->update($dataUpdate);
        }

        //return response(['status' => 200, "msg" => $this->module ." has been $statusMessage successfully."]);
        return response(['status' => 200, "msg" =>  __('messages.status_message', ['title' => $this->module, 'status_type' => $statusMessage])]);
        //return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'carrier']));
    }
    public function getSubProduct(Request $request)
    {
        $sub_category_html = '<option value="">Select Sub Category</option>';
        if ($request->id != '') {
            $sub_category = Category::where('parent_id', $request->id)->pluck('name', 'id')->toArray();
            if (!empty($sub_category)) {
                foreach ($sub_category as $key => $value) {
                    $selected = '';
                    if($request->subcat_id == $key){
                        $selected = 'selected="selected"';
                    }
                    $sub_category_html .= '<option value="' . $key . '" '.$selected.'>' . $value . '</option>';
                }
            }
        }
        return response(['status' => 'success', "sub_category_html" => $sub_category_html]);
    }
    public function productPriceCalculation(Request $request)
    {

        $other_expenses = ($request->other_expenses) ? $request->other_expenses : 0;
        $net_weight = $request->net_weight;
        $grosswt = $request->grosswt;
        $price_percentage = $request->price_percentage;

        $diamond_price = $request->diamond_price;

        $labour_price = 0;
        if($request->labour_type_id){
            $labour_price = Labour::where('id',$request->labour_type_id)->value('price');
            $labour_price = $labour_price * $net_weight;
        }

        $materialmetal_price = 0;
        if(isset($request->materialmetal)){
            $materialmetal = $request->materialmetal[0];
            $metalmaterial_arr = explode('-',$materialmetal);
            $metal_id = $metalmaterial_arr[0];
            $material_id = isset($metalmaterial_arr[1]) ? $metalmaterial_arr[1] : null;
            $materialmetal_price = MaterialMetal::where([['metal_id',$metal_id],['material_id',$material_id]])->value('price');
            $materialmetal_price = $materialmetal_price * $net_weight;
        }

        $total_price =  $materialmetal_price + $labour_price + $diamond_price + $other_expenses;
        //dd($total_price);
        if($price_percentage != ''){
            $total_price = $total_price + (($price_percentage / 100) * $total_price);
        }

        $total_price = number_format((float)$total_price, 3, '.', '');
        return response()->json(['msg' => 'success', 'total_price' => $total_price]);

    }
}
