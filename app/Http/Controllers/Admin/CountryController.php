<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\HomeSliderRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Country;


class CountryController extends Controller
{
	/**
	 * Page load then call first method.
	 * @author Hitesh Khandar
	 */
	public function __construct()
	{
		$this->moduleRouteText	= "admin.country";
		$this->moduleViewName	= "admin.country";
		$this->list_url			= route($this->moduleRouteText . ".index");
		$module					= "Country";
		$this->module			= $module;
		$this->modelObj			= new Country();
        $this->path = "uploads/";
	}
	/**
	 * Display a listing of the resource.
	 * @author Hitesh Khandar
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
            $country = Country::select('id','slug','name','symbol','rate')->whereNotIn('slug', ['india','canada','australia'])->orderBy('sort_order', 'asc')->get();
            //dd($country);
            $data = array(
                "countries" 		=> $country,
                "module" 			=> $this->module,
                "page_title" 		=> "List",
                "action_url" 		=> $this->moduleRouteText . ".store",
                "action_params"     => 0,
                "method" 			=> "POST",
            );
            return view($this->moduleViewName . '.index', $data);
	}
    public function shippingCharge(Request $request)
    {
        $country = Country::select('id','slug','name','symbol','shipping_charge')->orderBy('sort_order', 'asc')->get();
            //dd($country);
            $data = array(
                "countries" 		=> $country,
                "module" 			=> 'Shipping Charge',
                "page_title" 		=> "List",
                "action_url" 		=> "admin.save_shipping_charge",
                "action_params"     => 0,
                "method" 			=> "POST",
            );
            return view($this->moduleViewName . '.shipping_charge', $data);
    }

    public function saveShippingCharge(Request $request)
	{
        if(count($request->shipping_charge) > 0){
            foreach($request->shipping_charge as $key => $value){
                Country::where('slug', $key)->update(['shipping_charge' => $value]);
            }
        }
        return redirect()->route('admin.shipping_charge')->with('success', __('messages.update_message', ['title' => 'shipping charge']));
	}
	/**
	 * Show the form for creating a new resource.
	 * @author Hitesh Khandar
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created resource in storage.
	 * @author Hitesh Khandar
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
        if(count($request->rate) > 0){
            foreach($request->rate as $key => $value){
                Country::where('slug', $key)->update(['rate' => $value]);
            }

            $slug_array = array('canada','south-africa','australia');
            foreach($slug_array as $slug){
                Country::where('slug', $slug)->update(['rate' => $request->rate['united-states']]);
            }
        }
        return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.update_message', ['title' => 'country rate']));
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
	}

	/**
	 * Update the specified resource in storage.
	 * @author Hitesh Khandar
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{

	}

	/**
	 * Remove the specified resource from storage.
	 * @author Hitesh Khandar
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
	}

}
