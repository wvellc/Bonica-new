<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\DiscoverProduct;
use App\Models\ShopthelookProduct;
use App\Models\Metal;
use App\Models\Material;
use App\Models\MaterialMetal;
use App\Models\ProductMetalMaterial;
use App\Models\SizeCountry;
use App\Models\ProductCenterDiamondPacket;
use App\Models\ProductSideDiamondPacket;
use App\Models\SizeMasterPrice;
use App\Models\Size;
use App\Models\Country;
use App\Models\Shape;

use Cookie;


class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showCategoryProduct(Request $request)
    {
        $data = array();
        if ($request->segment(2)) {
            /*Get Data From Category Slug*/
            $category = Category::query()->with('parent')->where('slug', $request->segment(2))->Active()->first();
            $data['category'] = $category;
            $data['is_parent_category'] = ($category['parent_id'] == 0) ? 1 : 0;
            $data['category_description'] = $category['description'];
            $data['category_banner_image'] = ($category['banner_image']) ? env('CLOUDFRONTURL')."categories/" . $category['banner_image'] : 'images/banners/banner-2.png';
            $data['discover_image'] = ($category['discover_image']) ? 'uploads/category/' . $category['discover_image'] : 'images/no_image_big.png';
            $data['shopthelook_image'] = ($category['shopthelook_image']) ? 'uploads/category/' . $category['shopthelook_image'] : 'images/no_image_big.png';

            $data['metals'] = Metal::query()->Active()->orderBy('sort_order', 'ASC')->get();
            $data['materials'] = Material::query()->Active()->orderBy('sort_order', 'ASC')->get();

            /* $products = Product::with('firstProductShape','firstProductMetalMaterial','firstProductMetalMaterial.metal','firstProductMetalMaterial.material');

            $products = $products->where('cat_id',$category->id);


            $products = $products->orderBy('recommended', 'DESC');

            $products = $products->Active()->get();
            dd($products);
 */


            /*
            $products = Product::with([
                'productImages' => function (Builder $query) {
                    $query->where('shape_id', 1);
                    $query->where('metal_id', 1);
                }
            ])->get(); */


            /* $products = Product::with('productImages')->whereHas('productImages', function($q) {
                $q->where('shape_id', '1');
                $q->where('metal_id', '1');
               })->get();
             dd($products); */




            return view('frontend.products.products-list', $data);
        }
        return view('frontend.404');
    }
    public function showSubCategoryProduct(Request $request)
    {
        $data = array();
        $product_slug = $request->segment(3);
        $category_slug = $request->segment(3);
        $category = Category::query()->with('parent')->where('slug', $category_slug)->Active()->first();

        if ($category) {
            /*Get Data From Category Slug*/
            $data['category'] = $category;
            $data['is_parent_category'] = ($category['parent_id'] == 0) ? 1 : 0;
            $data['category_description'] = $category['description'];
            $data['category_banner_image'] = ($category['banner_image']) ? env('CLOUDFRONTURL')."categories/" . $category['banner_image'] : 'images/banners/banner-2.png';
            $data['discover_image'] = ($category['discover_image']) ? 'uploads/category/' . $category['discover_image'] : 'images/no_image_big.png';
            $data['shopthelook_image'] = ($category['shopthelook_image']) ? 'uploads/category/' . $category['shopthelook_image'] : 'images/no_image_big.png';

            $data['metals'] = Metal::query()->Active()->orderBy('sort_order', 'ASC')->get();
            $data['materials'] = Material::query()->Active()->orderBy('sort_order', 'ASC')->get();

            return view('frontend.products.products-list', $data);
        } else {
            $category_slug = $request->segment(2);
        }

        return $this->productDetail($category_slug, $product_slug);
    }
    public function product(Request $request)
    {
        $category_slug = $request->segment(3);
        $product_slug = $request->segment(4);
        return $this->productDetail($category_slug, $product_slug);
    }
    public function productDetail($category_slug, $product_slug)
    {

        $data = array();
        /*Get Single Product Details*/
        $product = Product::with('productImages', 'ProductShapes', 'firstProductShape', 'ProductShapes.shape', 'ProductMetalMaterial', 'ProductMetalMaterial.metal', 'ProductMetalMaterial.material', 'firstProductMetalMaterial');
        $product = $product->where('slug', $product_slug);
        $product = $product->Active()->first();

        $product->ProductSize = Size::select('name as size','id')->Active()->where('category_id',$product->cat_id)->get();

        $product_center_diamonds = ProductCenterDiamondPacket::where('product_id', $product->id)->with('color','clarity')->get()->toArray();

        $center_diamond_colors = array();
        $center_diamond_claritys = array();
        if(count($product_center_diamonds) > 0){
            foreach($product_center_diamonds as $product_center_diamond){
                $center_diamond_colors[$product_center_diamond['color_id']] = $product_center_diamond['color']['name'];
                $center_diamond_claritys[$product_center_diamond['clarity_id']] = $product_center_diamond['clarity']['name'];
            }
        }

        $product_side_diamonds = ProductSideDiamondPacket::where('product_id', $product->id)->with('color','clarity')->get()->toArray();

        $side_diamond_colors = array();
        $side_diamond_claritys = array();
        if(count($product_side_diamonds) > 0){
            foreach($product_side_diamonds as $product_side_diamond){
                $side_diamond_colors[$product_side_diamond['color_id']] = $product_side_diamond['color']['name'];
                $side_diamond_claritys[$product_side_diamond['clarity_id']] = $product_side_diamond['clarity']['name'];
            }
        }

        //dd($center_diamond_claritys);
        //dd($product->ProductSize[0]->size->sort_order);

        /*Get Category Details*/
        $category = Category::with('parent')->where('slug', $category_slug)->Active()->first();
        $catSegment =  $category_slug;
        $is_show_size_chart = $category->is_show_size_chart;
        $subCategorySegment = '';
        if ($category->parent) {
            $subCategorySegment =  $category_slug;
            $catSegment =  $category->parent->slug;

        }
        /*Get YOU MAY ALSO LIKE Products*/
        $likes_products = Product::with('productImages', 'firstProductShape', 'firstProductMetalMaterial', 'firstProductMetalMaterial.metal', 'firstProductMetalMaterial.material');

        $likes_products = $likes_products->whereNotIn('id', [$product->id]);
        if ($category->parent_id > 0) {
            $likes_products = $likes_products->where('sub_cat_id', $category->id);
        } else {
            $likes_products = $likes_products->where('cat_id', $category->id);
        }
        $likes_products = $likes_products->Active()->inRandomOrder()->limit(4)->get();


        $currency =  countryCurrency();
        $country_size = SizeCountry::where('country_id', $currency['country_id'])->pluck('size_id')->toArray();

        //dd($product);
        // dd($product->ProductMetalMaterial);
        $data['product'] =  $product;
        $data['likes_products'] =  $likes_products;
        $data['cat_segment'] =  $catSegment;
        $data['subcategory_segment'] =  $subCategorySegment;
        $data['category'] =  $category;
        $data['is_show_size_chart'] =  $is_show_size_chart;
        $data['country_size'] =  $country_size;

        $data['center_diamond_colors'] =  $center_diamond_colors;
        $data['center_diamond_claritys'] =  $center_diamond_claritys;

        $data['side_diamond_colors'] =  $side_diamond_colors;
        $data['side_diamond_claritys'] =  $side_diamond_claritys;
        return view('frontend.products.product-detail', $data);
    }

    public function getWishlistData(Request $request)
    {
        $ProductData_Html = '';
        $products = array();
        if (Cookie::has('cookiewishlist')) {
            $productIds = unserialize(Cookie::get('cookiewishlist'));

            $products = Product::with('productImages', 'category', 'subcategory', 'firstProductShape', 'firstProductMetalMaterial', 'firstProductMetalMaterial.metal', 'firstProductMetalMaterial.material');
            $products = $products->whereIn('id', $productIds);
            $products = $products->Active()->get();

            $ProductData_Html = '';
            $ProductData_Html .= '<div class="row align-items-center">';
            foreach ($products as $product) {

                $ProductData_Html .= '<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 product-wishlist-box-wrapper-col" id="product-' . $product->id . '">';
                $ProductData_Html .= view('frontend.products.product-wishlist-box')->with('product', $product);
                $ProductData_Html .= '</div>';
            }
            $ProductData_Html .= '</div>';
        }
        return response()->json(['msg' => 'success', 'totalProducts' => count($products), 'ProductData_Html' => $ProductData_Html]);
    }


    public function getData(Request $request)
    {
        $category_id = $request->category_id;
        $metal_id = $request->metal_id;
        $material_id = $request->material_id;
        $gender = $request->gender;
        $sorting = $request->sorting;

        $cat_segment = $request->cat_segment;
        $subcategory_segment = $request->subcategory_segment;

        $page = $request['page_no'];
        $per_page_data = 12;
        $skip = $page == 1? 0: $per_page_data * ($page-1);
        $productIds = array();
        if ($metal_id || $material_id) {

            $page = $request['page_no'];
            $per_page_data = 12;
            $skip = $page == 1? 0: $per_page_data * ($page-1);
            $product_metal_material =  ProductMetalMaterial::select('product_id');
            if ($metal_id) {
                $product_metal_material = $product_metal_material->where('metal_id', $metal_id);
            }
            if ($material_id) {
                $product_metal_material = $product_metal_material->where('material_id', $material_id);

            }
            $product_metal_material = $product_metal_material->get()->toArray();
            if (count($product_metal_material) > 0) {
                foreach ($product_metal_material as $pmm) {
                    $productIds[] = $pmm['product_id'];
                }
                $productIds = array_unique($productIds);
            }
        }

        //$products = Product::with('productImages','firstProductShape','firstProductShape.shape','firstProductMetalMaterial','firstProductMetalMaterial.metal','firstProductMetalMaterial.material')->where('cat_id',$request->category_id)->Active()->get();
        $products = Product::with('productImages', 'firstProductShape', 'firstProductMetalMaterial', 'firstProductMetalMaterial.metal', 'firstProductMetalMaterial.material');
       
        if ($subcategory_segment) {
            $products = $products->where('sub_cat_id', $category_id);
        } else {
            $products = $products->where('cat_id', $category_id);
        }

        if ($gender) {
            $products = $products->where('gender', $gender);
            $page = $request['page_no'];
            $per_page_data = 12;
            $skip = $page == 1? 0: $per_page_data * ($page-1);
        }
        if (count($productIds) > 0) {
            $products = $products->whereIn('id', $productIds);
        }
        $products = $products->Active();
        $product_count = count($products->get());

        if ($sorting) {
            $page = $request['page_no'];
            $per_page_data = 12;
            $skip = $page == 1? 0: $per_page_data * ($page-1);
            if ($sorting == 'recommended') {
                $products = $products->orderBy('recommended', 'DESC');
            } else if ($sorting == 'price_high_to_low') {
                $products = $products->orderBy('price', 'desc');
            } else if ($sorting == 'price_low_to_high') {
                $products = $products->orderBy('price', 'asc');
            }
        }
        $products = $products->skip($skip);
        $products = $products->take($per_page_data);

        $products = $products->get();
        $pageproductdata = count($products);

        $ProductData_Html = '';
        //dd($products);
        $ProductData_Html .= '<div class="row align-items-center">';
        foreach ($products->slice(0, 4) as $product) {
            $ProductData_Html .= '<div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 product-col">';
            //$ProductData_Html .= view('frontend.products.product-box',compact('product'))->render();
            $ProductData_Html .= view('frontend.products.product-box')->with('product', $product)->with('cat_segment', $cat_segment)->with('subcategory_segment', $subcategory_segment);
            $ProductData_Html .= '</div>';
        }
        $ProductData_Html .= '</div>';

        if (count($products) > 4) {
            if ($request->discover_status) {
                $ProductData_Html .= '
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="row h-100">
                            <div class="col-md-12 mt-3">
                                <div class="pr-inner-banner">
                                    <img src="' . asset($request->discover_image) . '" alt="pendent" />
                                    <div class="pr-inner-banner-overlay"></div>
                                    <div class="pr-inner-banner-info">
                                        <a href="#" onclick="getDiscoverProduct()"
                                            class="btn btn-primary btn-discovermodal"
                                            data-bs-toggle="modal">Discover</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="row align-items-center">';
                foreach ($products->slice(4, 4) as $product) {
                    $ProductData_Html .= '<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6  product-col four-product-col">';
                    $ProductData_Html .= view('frontend.products.product-box')->with('product', $product)->with('cat_segment', $cat_segment)->with('subcategory_segment', $subcategory_segment);
                    $ProductData_Html .= '</div>';
                }
                $ProductData_Html .= '</div>
                    </div>
                </div>';
            } else {
                $ProductData_Html .= '<div class="row align-items-center">';
                foreach ($products->slice(4, 4) as $product) {
                    $ProductData_Html .= '<div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3  product-col">';
                    $ProductData_Html .= view('frontend.products.product-box')->with('product', $product)->with('cat_segment', $cat_segment)->with('subcategory_segment', $subcategory_segment);
                    $ProductData_Html .= '</div>';
                }
                $ProductData_Html .= '</div>';
            }
        }
        $ProductData_Html .= '<div class="row align-items-center">';
        foreach ($products->slice(8, 4) as $product) {
            $ProductData_Html .= '<div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3  product-col">';
            $ProductData_Html .= view('frontend.products.product-box')->with('product', $product)->with('cat_segment', $cat_segment)->with('subcategory_segment', $subcategory_segment);
            $ProductData_Html .= '</div>';
        }
        $ProductData_Html .= '</div>';
        if (count($products) > 12) {
            if ($request->shopthelook_status) {
                $ProductData_Html .= '<div class="row ">
                    <div class="col-md-6 col-lg-6">
                        <div class="row align-items-center justify-content-between">';
                foreach ($products->slice(12, 4) as $product) {
                    $ProductData_Html .= '<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6  product-col four-product-col">';
                    $ProductData_Html .= view('frontend.products.product-box')->with('product', $product)->with('cat_segment', $cat_segment)->with('subcategory_segment', $subcategory_segment);
                    $ProductData_Html .= '</div>';
                }
                $ProductData_Html .= '</div>
                    </div>';
                if (count($products) > 14) {
                    $ProductData_Html .= '<div class="col-md-6 col-lg-6">
                            <div class="row h-100">
                                <div class="col-md-12 mt-3">
                                    <div class="pr-inner-banner">
                                        <img src="' . asset($request->shopthelook_image) . '"
                                            alt="pendent" />
                                        <div class="pr-inner-banner-overlay"></div>
                                        <div class="pr-inner-banner-info">
                                            <!-- <h2 class="text-white">Pendant</h2> -->
                                            <a href="#" onclick="getShopthelookProduct()"
                                                class="btn btn-primary btn-shopthelook"
                                                data-bs-toggle="modal" >Shop The Look</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
                $ProductData_Html .= '</div>';
            } else {
                $ProductData_Html .= '<div class="row align-items-center">';
                foreach ($products->slice(12, 4) as $product) {
                    $ProductData_Html .= '<div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3  product-col">';
                    $ProductData_Html .= view('frontend.products.product-box')->with('product', $product)->with('cat_segment', $cat_segment)->with('subcategory_segment', $subcategory_segment);
                    $ProductData_Html .= '</div>';
                }
                $ProductData_Html .= '</div>';
            }
        }

        if (count($products) > 16) {
            $ProductData_Html .= '<div class="row align-items-center">';
            foreach ($products->slice(16) as $product) {
                $ProductData_Html .= '<div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3  product-col">';
                $ProductData_Html .= view('frontend.products.product-box')->with('product', $product)->with('cat_segment', $cat_segment)->with('subcategory_segment', $subcategory_segment);
                $ProductData_Html .= '</div>';
            }
            $ProductData_Html .= '</div>';
        }

        return response()->json(['msg' => 'success', 'totalProducts' => $product_count, 'pageproductdata' => $pageproductdata ,'ProductData_Html' => $ProductData_Html]);
    }
    public function gatDiscoverProduct(Request $request)
    {
        $category_id = $request->category_id;
        $cat_segment = $request->cat_segment;
        $subcategory_segment = $request->subcategory_segment;

        $discoverProductsObjs = DiscoverProduct::with('product', 'product.productImages')->where('category_id', $category_id)->get();
        $discoverProducts = array();
        $ProductData_Html = '';
        foreach ($discoverProductsObjs as $discoverProduct) {
            $discoverProducts[] = $discoverProduct['product'][0];
        }

        if (count($discoverProducts) > 0) {
            foreach ($discoverProducts as $product) {
                $ProductData_Html .= '<div class="col-12 col-sm-6 four-product-col">';
                $ProductData_Html .= view('frontend.products.product-box')->with('product', $product)->with('cat_segment', $cat_segment)->with('subcategory_segment', $subcategory_segment);
                $ProductData_Html .= '</div>';
            }
        } else {
            $ProductData_Html .= 'No Product Available!';
        }
        return response()->json(['msg' => 'success', 'ProductData_Html' => $ProductData_Html]);
    }
    public function gatShopthelookProduct(Request $request)
    {
        $category_id = $request->category_id;
        $cat_segment = $request->cat_segment;
        $subcategory_segment = $request->subcategory_segment;
        $shopthelookProductsObjs = ShopthelookProduct::with('product', 'product.productImages')->where('category_id', $category_id)->get();
        $shopthelookProducts = array();
        $ProductData_Html = '';
        foreach ($shopthelookProductsObjs as $shopthelookProduct) {
            $shopthelookProducts[] = $shopthelookProduct['product'][0];
        }
        if (count($shopthelookProducts) > 0) {
            foreach ($shopthelookProducts as $product) {
                $ProductData_Html .= '<div class="col-12 col-sm-6 four-product-col">';

                $ProductData_Html .= view('frontend.products.product-box')->with('product', $product)->with('cat_segment', $cat_segment)->with('subcategory_segment', $subcategory_segment);
                $ProductData_Html .= '</div>';
            }
        } else {
            $ProductData_Html .= 'No Product Available!';
        }
        return response()->json(['msg' => 'success', 'ProductData_Html' => $ProductData_Html]);
    }
    public function addRemoveWishlist(Request $request)
    {
        $product_id = $request->id;
        $wishlist_arr = array();
        if (Cookie::has('cookiewishlist')) {
            $wishlist_arr = unserialize(Cookie::get('cookiewishlist'));

            if ($request->status) {
                $key = array_search($product_id, $wishlist_arr);
                if (false !== $key) {
                    unset($wishlist_arr[$key]);
                }
            } else {
                $wishlist_arr[] = $product_id;
            }
            $cookie = Cookie::forever('cookiewishlist', serialize($wishlist_arr));
        } else {
            $wishlist_arr = array($product_id);
            $cookie = Cookie::forever('cookiewishlist', serialize($wishlist_arr));
        }

        return response(['status' => 200, "msg" => 'success', "wishlist_count" => count($wishlist_arr)])->withCookie($cookie);
    }
    public function deleteWishlist(Request $request)
    {
        $product_id = $request->product_id;

        if (Cookie::has('cookiewishlist')) {
            $wishlist_arr = unserialize(Cookie::get('cookiewishlist'));
            $key = array_search($product_id, $wishlist_arr);
            if (false !== $key) {
                unset($wishlist_arr[$key]);
            }
            $cookie = Cookie::forever('cookiewishlist', serialize($wishlist_arr));
            return response(['status' => 200, "msg" => 'success', "wishlist_count" => count($wishlist_arr)])->withCookie($cookie);
        }
    }
    public function getProductPrice(Request $request)
    {
        $currency =  countryCurrency();
        $productData = ['product_id' => $request->product_id,
        'center_diamond_color' => $request->center_diamond_color,
        'center_diamond_clarity' => $request->center_diamond_clarity,
        'side_diamond_color' => $request->side_diamond_color,
        'side_diamond_clarity' => $request->side_diamond_clarity,
        'ringSize' => $request->ringSize,
        'shape_id' => $request->shape_id,
        'metal_id' => $request->metal_id,
        'material_id' => $request->material_id];

        $productDataArr = productPriceCalculation($productData);

        //start calculation of users select size wise change price logic  
        // $price = 0; 
        // if($request->ringSize){
        //     //Get the selected ring size
        //     $ringSize = Size::where('id',$request->ringSize)->first();
        //     // Get the master price for sizes
        //     $price = SizeMasterPrice::where('min_size', '<=', $ringSize->name)
        //                             ->where('max_size', '>=', $ringSize->name)
        //                             ->where('category_id',$productDataArr['cat_id'])
        //                             ->value('price');
        // }
        
        // if($price > 0){
        //     // Calculate the price increment based on the percentage of size price
        //     $priceIncrement = $productDataArr['total_price'] * $price / 100;
        //     // Add the calculated price increment to the total price
        //     $productDataArr['total_price'] = $productDataArr['total_price'] + $priceIncrement;
        // }
        //end calculation of users select size wise change price logic  

        $salesProductPrice = Product::getProductSalesPrice($request->product_id);
        $product_price = $currency['symbol'] . ' ' . number_format((float)($productDataArr['countryMultiplyby'][$currency['country_id']] * $productDataArr['total_price']) / $currency['rate'], 3, '.', '');

        //$salesProductPrice = $currency['symbol'] . ' ' . number_format((float)($salesProductPrice + $shape_price + $metal_material_price) / $currency['rate'], 3, '.', '');
        $salesProductPrice = $currency['symbol'] . ' ' . number_format((float)($salesProductPrice) / $currency['rate'], 3, '.', '');
        return response()->json(['msg' => 'success', 'product_price' => $product_price, 'salesProductPrice' => $salesProductPrice]);

    }
    public function getProductPriceImage(Request $request)
    {
        /* print_r($currency); */
        $product_id = $request->product_id;
        $shape_id = ($request->shape_id) ? $request->shape_id : 0;
        $metal_id = ($request->metal_id) ? $request->metal_id : 0;
        $material_id = ($request->material_id) ? $request->material_id : 0;
        $cat_segment = ($request->cat_segment) ? $request->cat_segment : "";


        $materialMetal = ProductMetalMaterial::with("material")->where("product_id",$product_id)->where("metal_id",$metal_id)->get();

        $shape = Shape::where('id',$shape_id)->first();

        $diamondShape = strtolower($shape->name);

        $materialMetalHTML = "";
        // $materialMetalHTML1 = array();
        if(!empty($materialMetal)){
            foreach ($materialMetal as $key => $value) {
                if(!empty($value->material)){
                    // $materialMetalHTML1[] = $value->material;
                    if($key == 0){
                        $radioChecked = "checked";
                    } else {
                        $radioChecked = "";
                    }
                    $materialMetalHTML .= '<input onclick="getProductPrice();" type="radio" '.$radioChecked.' id="material_'.$value->material->id.'" name="material" value="'.$value->material->id.'" /><label for="material_'.$value->material->id.'">'.$value->material->name.'</label>';
                }
            }
        }
        //dd($materialMetalHTML);
        /* $product_price = Product::getProductPrice($product_id);
        $salesProductPrice = Product::getProductSalesPrice($product_id);
        $shape_price = ProductShape::getProductShapePrice($product_id, $shape_id);
        $metal_material_price = ProductMetalMaterial::getProductMetalMaterial($product_id, $metal_id, $material_id);

        $currency =  countryCurrency();
        $product_price = $currency['symbol'] . ' ' . number_format((float)($product_price + $shape_price + $metal_material_price) / $currency['rate'], 3, '.', '');
        $salesProductPrice = $currency['symbol'] . ' ' . number_format((float)($salesProductPrice + $shape_price + $metal_material_price) / $currency['rate'], 3, '.', ''); */
        //echo $product_id.' = '.$metal_id.' = '.$shape_id;
        $productImages = productImages($product_id, $metal_id, $shape_id);
        $image_paths = $productImages['image_paths'];
        $video_paths = $productImages['video_paths'];
        $is_360video = $productImages['is_360video'];
        $product_first_image = $productImages['product_first_image'];

        $handImageHtml = '';

        if($cat_segment == 'rings'){
            $handImageHtml = '  <div class="col-sm-6">
                                    <div class="hand-wrapper">
                                        <img id="hand" src="' . asset('images/hand.png') .'" alt="image" class="v-hand" >
                                        <div class="box-diamond-on-hand">
                                            <img id="diamondOnhand" src="' . asset("images/shapes/".$diamondShape.".png") .'" alt="image" class="diamond-on-hand" style="transform: scale(1.70);">
                                        </div>
                                        
                                    </div>
                                   
                                    <div class="carat-size d-flex align-items-center justify-content-between pb-2">
                                        <p class="pb-0">0.5 ct</p>
                                        <p>4 ct</p>
                                    </div>
                                    <div class="diamondOnhand-wrapper mb-4">
                                        <input class="range-slider__range" id="myRange" type="range" value="3" min="0.5" max="4" step="0.25">
                                    </div>
                                    <p class="text-center">
                                        Shown with <b ><span id="caratValue">3</span> carat</b> Diamond
                                    </p>
                                </div>';
        }

        $ProductImageHtml = '';
        $ProductImageHtml .= '<div class="row">';
        if (count($image_paths) > 0) {
            foreach ($image_paths as $key => $productImage) {
                $ProductImageHtml .= '<div class="col-sm-6">
                                                    <div class="pd-slider-large-img">';
                if ($is_360video[$key]) {
                    $ProductImageHtml .= '<video src="' . $video_paths[$key] . '" loop muted autoplay></video>';
                } else {
                    $ProductImageHtml .= '<a href="' . $productImage . '" data-fancybox="gallery" class="d-block" >';
                    $ProductImageHtml .= '<img src="' . $productImage . '" alt="ring">';
                    $ProductImageHtml .= '</a>';
                }

                $ProductImageHtml .= '</div>
                                                </div>';
            }
        } else {
            $ProductImageHtml .= '<div class="col-sm-6">
                                                <div class="pd-slider-large-img">
                                                    <a href="' . asset('images/no_image.png') . '" data-fancybox="gallery" class="d-block" >
                                                        <img src="' . asset('images/no_image.png') . '" alt="ring">
                                                    </a>
                                                </div>
                                            </div>';
        }

            $ProductImageHtml .= ''.$handImageHtml.'
                                </div>';

		 						// <div class="products-d-small-image-wrapper">
		 						// 	<div class="slider slider-nav">';

        // if (count($image_paths) > 0) {
        //     foreach ($image_paths as $key => $productImage) {
        //         $ProductImageHtml .= '<div class="item">';
        //         if ($is_360video[$key] == 1) {

        //             $ProductImageHtml .= '<div class="pd-slider-mini-img rotate-wrapper">
        //                                                         <img src="' . $productImage . '" alt="ring">
        //                                                         <img src="' . asset('images/icons/360-degree-icon.svg') . '" alt="ring" class="rotate-icon">
        //                                                     </div>';
        //         }else if ($is_360video[$key] == 2) {

        //             $ProductImageHtml .= '<div class="pd-slider-mini-img rotate-wrapper">
        //                                                         <img src="' . $productImage . '" alt="ring">
        //                                                     </div>';
        //         } else {
        //             $ProductImageHtml .= '<div class="pd-slider-mini-img">
        //                                                         <img src="' . $productImage . '" alt="ring">
        //                                                     </div>';
        //         }

        //         $ProductImageHtml .= '</div>';
        //     }
        // } else {
        //     $ProductImageHtml .= '<div class="item">
        //                                             <div class="pd-slider-mini-img">
        //                                                 <img src="' . asset('images/no_image.png') . '" alt="ring">
        //                                             </div>
        //                                         </div>';
        // }
        // $ProductImageHtml .= '</div>
		// 						</div>';

        return response()->json(['msg' => 'success', 'ProductImageHtml' => $ProductImageHtml,'materialMetalHTML' => $materialMetalHTML]);
    }
}
