<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use App\Commonhelper;
use DataTables;
use Str;
use File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
	/**
	 * Page load then call first method.
	 * @author Hitesh Khandar
	 */
	public function __construct()
	{
		$this->moduleRouteText	= "admin.admin";
		$this->moduleViewName	= "admin.admin";
		$this->list_url			= route($this->moduleRouteText . ".index");
		$module					= "Admin";
		$this->module			= $module;
		$this->modelObj			= new Admin();
	}

	/**
	 * Display a listing of the resource.
	 * @author Hitesh Khandar
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$model = Admin::query();
			return DataTables::eloquent($model)
				->addColumn('action', function (Admin $row) {
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
                // ->editColumn('profile_image', function ($row) {
                //     if($row->profile_image){
                //         return view( "admin.partials.image", [ 'row' => $row ] )->render();
                //     } else {
                //         return "";
                //     }
				// })
                ->editColumn('is_super', function ($row) {
                    if($row->is_super){
                        return "Super Admin";
                    } else {
                        return "Admin";
                    }
				})
                ->editColumn('status', function ($row) {
                    if($row->status){
                        return "Active";
                    } else {
                        return "Inactive";
                    }
				})
				->rawColumns(['action'])
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
			"isSuperData"       => ['1' => 'Yes', '0' => 'No'],
			"selectedStatusID"  => 1,
			"selectedIsSuperID" => 0,
		);
		return view($this->moduleViewName . '.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 * @author Hitesh Khandar
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(AdminRequest $request)
	{
		$admin = new Admin();
		$admin->name        = $request->name;
		$admin->email       = $request->email;
		$admin->password    = Hash::make($request->password);
		$admin->status      = $request->status;
		$admin->is_super    = $request->is_super;
		$admin->save();

		return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'admin']));
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
		$admin = Admin::find($id);
		$data = array(
			"formObj" 			=> $admin,
			"module" 			=> $this->module,
			"page_title" 		=> "Update",
			"action_url" 		=> $this->moduleRouteText . ".update",
			"action_params"     => $admin->id,
			"method" 			=> "PUT",
			"statusData" 		=> ['1' => 'Active', '0' => 'Inactive'],
			"isSuperData"       => ['1' => 'Yes', '0' => 'No'],
			"selectedStatusID"  => $admin->status,
			"selectedIsSuperID" => $admin->is_super,
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
	public function update(AdminRequest $request, $id)
	{
		$admin          = Admin::find($id);
        $oldFileName    = "";
        if($admin->profile_image){
            $oldFileName    = $admin->profile_image;
        }
		$admin->name	= $request->name;
		$admin->email	= $request->email;
        if($request->password){
            $admin->password = Hash::make($request->password);
        }
		$admin->status		= $request->status;
		$admin->is_super    = $request->is_super;
		$admin->save();

		return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.update_message', ['title' => 'admin']));
	}

	/**
	 * Remove the specified resource from storage.
	 * @author Hitesh Khandar
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$admin = Admin::find($id);
        $admin->delete();
		// if (!empty($admin)) {
        //     $filePath = public_path("uploads/admin/").$id."/";
        //     Commonhelper::deleteDirectory($filePath);
		// }
		return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'admin']), 'data' => array()]);
	}
}
