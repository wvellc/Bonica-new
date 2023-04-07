<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BlogCategoryRequest;
use App\Models\BlogCategory;
use App\Commonhelper;
use DataTables;
use Config;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use DB;

class BlogCategoryController extends Controller
{
	/**
	 * Page load then call first method.
	 * @author Hitesh Khandar
	 */
	public function __construct()
	{
		$this->moduleRouteText	= "admin.blogcategory";
		$this->moduleViewName	= "admin.blogcategory";
		$this->list_url			= route($this->moduleRouteText . ".index");
		$module					= "BlogCategory";
		$this->module			= $module;
		$this->modelObj			= new BlogCategory();
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

             $model = BlogCategory::query();
			return DataTables::eloquent($model)
				->addColumn('action', function (BlogCategory $row) {
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
				->editColumn('created_at', function ($row) {
					return Commonhelper::dateFormatChange($row->created_at);
				})
                ->editColumn('status', function (BlogCategory $row) {
                    $checked = "";
                    if ($row->status == 1) {
                        $checked = "checked";
                    }
                    return '<input type="checkbox" ' . $checked . ' data-toggle="toggle" data-on="Active" data-off="Inactive" onchange="statusChange(' . $row->id . ')" data-onstyle="success" data-offstyle="danger" class="toggle-demo" id="toggle-demo">';
                })
				->rawColumns(['status','action'])
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
		$data = array(
			"formObj" 			=> $this->modelObj,
			"module" 			=> $this->module,
			"page_title" 		=> "Create",
			"action_url" 		=> $this->moduleRouteText . ".store",
			"action_params"     => $this->modelObj->id,
			"method" 			=> "POST",
			"statusData" 		=> ['1' => 'Active', '0' => 'Inactive'],
			"selectedStatusID"  => 1,
		);
		return view($this->moduleViewName . '.create', $data);
	}
	/**
	 * Store a newly created resource in storage.
	 * @author Hitesh Khandar
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(BlogCategoryRequest $request)
	{

		$blogcategory = new BlogCategory();
		$blogcategory->name  = $request->name;
		$blogcategory->save();

		return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'blogcategory']));
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

		$blogcategory = BlogCategory::find($id);
		$data = array(
			"formObj" 			=> $blogcategory,
			"module" 			=> $this->module,
			"page_title" 		=> "Update",
			"action_url" 		=> $this->moduleRouteText . ".update",
			"action_params"     => $blogcategory->id,
			"method" 			=> "PUT",
			"statusData" 		=> ['1' => 'Active', '0' => 'Inactive'],
			"selectedStatusID"  => $blogcategory->status,
		);
		return view($this->moduleViewName . '.create', $data);
	}

	/**
	 * Update the specified resource in storage.
	 * @author Hitesh Khandar
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(BlogCategoryRequest $request, $id)
	{
		$blogcategory  = BlogCategory::find($id);
		$blogcategory->name        = $request->name;
		$blogcategory->save();

		return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.update_message', ['title' => 'blogcategory']));
	}

	/**
	 * Remove the specified resource from storage.
	 * @author Hitesh Khandar
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$blogcategory = BlogCategory::find($id);
        $blogcategory->delete();
		return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'blogcategory']), 'data' => array()]);
	}
    public function updateStatus(Request $request)
    {
        $blogcategoryStatus = BlogCategory::where('id', request('id'))->first();

        if ($blogcategoryStatus->status == 1) {
            $dataUpdate = array(
                "status" => 0
            );
            $statusMessage = "Inactive";
            BlogCategory::where('id', request('id'))->update($dataUpdate);
        } else {

            $dataUpdate = array(
                "status" => 1
            );
            $statusMessage = "Active";
            BlogCategory::where('id', request('id'))->update($dataUpdate);
        }
        return response(['status' => 200, "msg" =>  __('messages.status_message', ['title' => $this->module,'status_type' => $statusMessage])]);

    }
}
