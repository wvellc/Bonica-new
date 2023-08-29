<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SizeRequest;
use App\Models\Size;
use App\Models\SizeCountry;
use App\Models\Country;
use App\Commonhelper;
use DataTables;
use Config;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;
use App\Models\Category;

class SizeController extends Controller
{
	/**
	 * Page load then call first method.
	 * @author Hitesh Khandar
	 */
	public function __construct()
	{
		$this->moduleRouteText	= "admin.size";
		$this->moduleViewName	= "admin.size";
		$this->list_url			= route($this->moduleRouteText . ".index");
		$module					= "Size";
		$this->module			= $module;
		$this->modelObj			= new Size();
        $this->path = "";
	}

	/**
	 * Display a listing of the resource.
	 * @author Hitesh Khandar
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {

            /* Post::query()
            ->with(['size' => function ($query) {
                $query->select('id', 'sizename');
            }])
            ->get() */
            $model = Size::query()->with('country','category');

			return DataTables::eloquent($model)
				->addColumn('action', function (Size $row) {
					return view(
						"admin.partials.action",
						[
							'currentRoute'	=> $this->moduleRouteText,
							'row'			=> $row,
							'isEdit'		=> 1,
							'isDelete'		=> 1,
						]
					)->render();
				})
				->editColumn('country', function ($row) {
                    $country = array();
                    if(!empty($row->country)){
                        foreach($row->country as $value ){
                            $country[] = $value->name;
                        }
                    }
                    return implode(',',$country);
				})
				->editColumn('category_id', function ($row) {
               		$category = "";
                    if(!empty($row->category->name)){
               			$category = $row->category->name;
                    }
                    return $category;
				})
                ->editColumn('price', function ($row) {
                    $price = "";
                    if($row->price){
                        $price = '&#8377; ' . $row->price;
                    }
                    return $price;
                })
                ->editColumn('status', function (Size $row) {
                    $checked = "";
                    if ($row->status == 1) {
                        $checked = "checked";
                    }
                    return '<input type="checkbox" ' . $checked . ' data-toggle="toggle" data-on="Active" data-off="Inactive" onchange="statusChange(' . $row->id . ')" data-onstyle="success" data-offstyle="danger" class="toggle-demo" id="toggle-demo">';
                })
				->rawColumns(['price','country','status','action'])
				->make(true);
		} else {
			$data['module']		= $this->module;
			$data['page_title']	= "List";
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
        $selectedCountryID =  Country::pluck('id')->toArray();
		$data = array(
			"formObj" 			=> $this->modelObj,
			"module" 			=> $this->module,
			"page_title" 		=> "Create",
			"action_url" 		=> $this->moduleRouteText . ".store",
			"action_params"     => $this->modelObj->id,
			"method" 			=> "POST",
			"statusData" 		=> ['1' => 'Active', '0' => 'Inactive'],
			"selectedStatusID"  => 1,
            "country" => Country::AllCountry(),
            "selectedCountryID"  => $selectedCountryID,
            "selectedParentID"  => ""
		);
		$data['parent_category'] = Category::where('parent_id', 0)
												->whereIn('slug',['rings','bracelets','bangles'])
												->pluck('name', 'id')
												->toArray();
											
		return view($this->moduleViewName . '.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 * @author Hitesh Khandar
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(SizeRequest $request)
	{
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
		$size = Size::find($id);
        $selectedCountryID = SizeCountry::where('size_id',$id)->pluck('country_id')->all();
		$data = array(
			"formObj" 			=> $size,
			"module" 			=> $this->module,
			"page_title" 		=> "Update",
			"action_url" 		=> $this->moduleRouteText . ".update",
			"action_params"     => $size->id,
			"method" 			=> "PUT",
			"statusData" 		=> ['1' => 'Active', '0' => 'Inactive'],
			"selectedStatusID"  => $size->status,
            "country" => Country::AllCountry(),
            "selectedCountryID"  => $selectedCountryID,
            "selectedParentID"  => $size->category_id,
		);
		$data['parent_category'] = Category::where('parent_id', 0)
												->whereIn('slug',['rings','bracelets','bangles'])
												->pluck('name', 'id')
												->toArray();
											
		return view($this->moduleViewName . '.create', $data);
	}

	/**
	 * Update the specified resource in storage.
	 * @author Hitesh Khandar
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(SizeRequest $request, $id)
	{
        return $this->handleCreateOrUpdate($request, true, $id);
	}
    private function handleCreateOrUpdate($request, $edit = false, $id = null)
    {

        if ($edit) {
            $size  = Size::find($id);
            $msg = 'messages.update_message';
        } else {
            $size = new Size();
            $msg = 'messages.create_message';
        }

        DB::beginTransaction();
        try {
            $size->name  = $request->name;
            //$size->price  = $request->price;
            $size->status = $request->status;
            $size->sort_order = $request->sort_order;
            $size->category_id = $request->category;
            $size->save();

            SizeCountry::where('size_id', $id)->delete();
            if (!empty($request->country)) {
                $sizeCountry = array();
                foreach ($request->country as $value) {
                    $sizeCountry[] = array('size_id' => $size->id, 'country_id' => $value, "created_at" => Carbon::now(), "updated_at" => Carbon::now());
                }
                SizeCountry::insert($sizeCountry);
            }
            DB::commit();

            return redirect()->route($this->moduleViewName . '.index')->with('success', __($msg, ['title' => 'size']));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route($this->moduleViewName . '.edit', $id)->with('error', $e->getMessage());
            // something went wrong
        }
    }
	/**
	 * Remove the specified resource from storage.
	 * @author Hitesh Khandar
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$size = Size::find($id);
        $size->delete();
		return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'size']), 'data' => array()]);
	}
    public function updateStatus(Request $request)
    {
        $metalStatus = Size::where('id', request('id'))->first();

        if ($metalStatus->status == 1) {
            $dataUpdate = array(
                "status" => 0
            );
            $statusMessage = "Inactive";
            Size::where('id', request('id'))->update($dataUpdate);
        } else {

            $dataUpdate = array(
                "status" => 1
            );
            $statusMessage = "Active";
            Size::where('id', request('id'))->update($dataUpdate);
        }
        return response(['status' => 200, "msg" =>  __('messages.status_message', ['title' => $this->module,'status_type' => $statusMessage])]);

    }
    public function searchCountry(Request $request)
    {
        $term = trim($request->searchTerm);
        if (empty($term)) {
            return \Response::json([]);
        }
        $countries = Country::select("id","name")->where('name','LIKE',"%$term%")->get();

        /*Get Products*/
        $searchItems = [];
        if(count($countries) > 0){
            foreach ($countries as $country) {
                $searchItems[] = ['id' => $country->id, 'text' => $country->name];
            }
        }
        return \Response::json($searchItems);
    }
    public function searchSize(Request $request)
    {
        $term = trim($request->searchTerm);
        if (empty($term)) {
            return \Response::json([]);
        }
        $sizes = Size::select("id","name")->Active()->where('name','LIKE',"%$term%")->get();

        /*Get Products*/
        $searchItems = [];
        if(count($sizes) > 0){
            foreach ($sizes as $size) {
                $searchItems[] = ['id' => $size->id, 'text' => $size->name];
            }
        }
        return \Response::json($searchItems);
    }

}
