<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomePageSlider;
use App\Models\HomePage;
use App\Models\Country;
use App\Models\Product;
use App\Models\HomePageSliderImage;
use Session;
use App\Models\Category;
use App\Models\Newsletter;

class HomeController extends Controller
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
    public function index()
    {
        $data = array();

        $data['home_page'] = HomePage::first();

        $data['sliderImage'] = HomePageSliderImage::select('id', 'image', 'status', 'sort_order')->Active()->orderBy('sort_order', 'ASC')->get();

        $selectedcategory = array();
        if ($data['home_page']['catalog_category_ids'] != '') {
            $selectedcategory = explode(',', $data['home_page']['catalog_category_ids']);
        }
        $data['homecategories'] = Category::whereIn('id', $selectedcategory)->Active()->get();

        $data['recommendedProducts'] =  Product::with('singleProductImages', 'category', 'subcategory')->where('recommended',1)->orderBy('id', 'desc')->limit(10)->get();

        return view('frontend.home', $data);
    }
    public function currencyUpdate(Request $request)
    {
        $currency = Country::where('slug', $request->slug)->first();
        Session::put('currency', array('country_id' => $currency->id, 'country' => $currency->name, 'symbol' => $currency->symbol, 'currency_code' => $currency->currency_code, 'rate' => $currency->rate, 'shipping_charge' => $currency->shipping_charge));
        return response()->json(['msg' => 'success']);
    }
    public function Search(Request $request)
    {
         /* Search Category */
        $search = $request->search;
        $category_data = Category::with('parent')->where('name', 'LIKE', '%' . $search . "%")
        ->Active()->get();

        $response = array();
        if ($category_data) {
            foreach ($category_data as $key => $value) {
                $image = ($value->image) ? asset('uploads/category/' . $value->image) : asset('images/default-img.png');
                $product_url =  route('frontend.show_category_product', ['category' => $value['slug']]);
                if ($value->parent) {
                    $product_url =  route('frontend.show_sub_category_product', ['category' => $value->parent->slug, 'subcategory' => $value['slug']]);
                }
                $response[] = array("image" =>$image, "value1" => $product_url, "value" => $value['name'], "label" => $value['name']);
            }
        }

        /* Search Product */
        $product_data =  Product::with('category','subcategory','singleProductImages')->where('name', 'LIKE', '%' . $search . "%")->Active()->get();

        if ($product_data) {
            foreach ($product_data as $key => $value) {

                if($value->singleProductImages){
                    $image =  $value->singleProductImages->image_path;
                }else{
                    $image =  asset('images/default-img.png');
                }
                if ($value->subcategory) {
                    $product_url =  route('frontend.product_detail', ['category' => $value->category->slug, 'subcategory' => $value->subcategory->slug, 'product' => $value->slug]);
                } else if ($value->category) {
                    $product_url =  route('frontend.show_sub_category_product', ['category' => $value->category->slug, 'subcategory' => $value->slug]);
                }

                $response[] = array("image" => $image, "value1" => $product_url, "value" => $value['name'], "label" => $value['name']);
            }
        }
        return $response;
    }
    public function newsletter(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255'
        ]);
        $newsletter = new Newsletter();
        $newsletter->email = $request->email;
        $newsletter->ip_address = $request->ip();
        $newsletter->save();
        return response()->json(['msg' => 'success']);
    }
}
