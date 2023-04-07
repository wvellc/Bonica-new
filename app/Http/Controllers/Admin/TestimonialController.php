<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Models\Testimonial;
use App\Commonhelper;
use DataTables;
use Config;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;

class TestimonialController extends Controller
{
	/**
	 * Page load then call first method.
	 * @author Hitesh Khandar
	 */
	public function __construct()
	{
		$this->moduleRouteText	= "admin.testimonial";
		$this->moduleViewName	= "admin.testimonial";
		$this->list_url			= route($this->moduleRouteText . ".index");
		$module					= "Testimonial";
		$this->module			= $module;
		$this->modelObj			= new Testimonial();
        $this->path = "uploads/testimonial/";
	}
	/**
	 * Display a listing of the resource.
	 * @author Hitesh Khandar
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {

            $model = Testimonial::query();
			return DataTables::eloquent($model)
				->addColumn('action', function (Testimonial $row) {
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
                    return DateFormateDMY($row->created_at);
				})
                ->editColumn('content', function ($row) {
                    return \Illuminate\Support\Str::limit($row->content, 50, $end='...');
				})
                ->editColumn('status', function (Testimonial $row) {
                    $checked = "";
                    if ($row->status == 1) {
                        $checked = "checked";
                    }
                    return '<input type="checkbox" ' . $checked . ' data-toggle="toggle" data-on="Active" data-off="Inactive" onchange="statusChange(' . $row->id . ')" data-onstyle="success" data-offstyle="danger" class="toggle-demo" id="toggle-demo">';
                })
				->rawColumns(['content','status','action'])
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
	public function store(TestimonialRequest $request)
	{

		$testimonial = new Testimonial();

        $testimonial->status  = $request->status;
        $testimonial->content  = $request->content;
        $testimonial->added_by  =  ($request->added_by) ? $request->added_by : Auth::guard('admin')->user()->name;
        if($request->has('image'))
        {
            $image = Commonhelper::uploadFileWithThumbnail($request, 'image', NULL, $this->path, $resizeH = 340, $resizeW = 235);
            $testimonial->image = $image;
        }
		$testimonial->save();

		return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'Testimonial']));
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

	public function edit($id)
	{

		$user = Testimonial::find($id);
		$data = array(
			"formObj" 			=> $user,
			"module" 			=> $this->module,
			"page_title" 		=> "Update",
			"action_url" 		=> $this->moduleRouteText . ".update",
			"action_params"     => $user->id,
			"method" 			=> "PUT",
			"statusData" 		=> ['1' => 'Active', '0' => 'Inactive'],
			"selectedStatusID"  => $user->status,
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
	public function update(TestimonialRequest $request, $id)
	{
		$testimonial  = Testimonial::find($id);
        $testimonial->status  = $request->status;
        $testimonial->content  = $request->content;
        $testimonial->added_by  =  ($request->added_by) ? $request->added_by : Auth::guard('admin')->user()->name;
        if($request->has('image'))
        {
            $image = Commonhelper::uploadFileWithThumbnail($request, 'image', NULL, $this->path, $resizeH = 340, $resizeW = 235,$testimonial->image);
            $testimonial->image = $image;
        }
		$testimonial->save();
        return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.update_message', ['title' => 'Testimonial']));
	}

	/**
	 * Remove the specified resource from storage.
	 * @author Hitesh Khandar
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$user = Testimonial::find($id);
        $user->delete();
		return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'Testimonial']), 'data' => array()]);
	}
    public function updateStatus(Request $request)
    {
        $metalStatus = Testimonial::where('id', request('id'))->first();

        if ($metalStatus->status == 1) {
            $dataUpdate = array(
                "status" => 0
            );
            $statusMessage = "Inactive";
            Testimonial::where('id', request('id'))->update($dataUpdate);
        } else {

            $dataUpdate = array(
                "status" => 1
            );
            $statusMessage = "Active";
            Testimonial::where('id', request('id'))->update($dataUpdate);
        }

        //return response(['status' => 200, "msg" => $this->module ." has been $statusMessage successfully."]);
        return response(['status' => 200, "msg" =>  __('messages.status_message', ['title' => $this->module,'status_type' => $statusMessage])]);
        //return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'carrier']));
    }
}
