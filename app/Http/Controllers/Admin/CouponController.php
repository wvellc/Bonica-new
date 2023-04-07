<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CouponRequest;
use App\Models\Coupon;
use App\Commonhelper;
use DataTables;
use Carbon\Carbon;

class CouponController extends Controller
{
	/**
	 * Page load then call first method.
	 * @author Hitesh Khandar
	 */
	public function __construct()
	{
		$this->moduleRouteText	= "admin.coupon";
		$this->moduleViewName	= "admin.coupon";
		$this->list_url			= route($this->moduleRouteText . ".index");
		$module					= "Coupon";
		$this->module			= $module;
		$this->modelObj			= new Coupon();
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

             $model = Coupon::query();
			return DataTables::eloquent($model)
				->addColumn('action', function (Coupon $row) {
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
                ->editColumn('discount', function ($row) {
					return '&#8377; '.$row->discount;
				})
                ->editColumn('expired', function ($row) {
					return  ($row->expired) ? Commonhelper::dateDMYFormat($row->expired) : '';
				})
                ->editColumn('status', function (Coupon $row) {
                    $checked = "";
                    if ($row->status == 1) {
                        $checked = "checked";
                    }
                    return '<input type="checkbox" ' . $checked . ' data-toggle="toggle" data-on="Active" data-off="Inactive" onchange="statusChange(' . $row->id . ')" data-onstyle="success" data-offstyle="danger" class="toggle-demo" id="toggle-demo">';
                })
				->rawColumns(['expired','discount','status','action'])
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
	public function store(CouponRequest $request)
	{

		$coupon = new Coupon();
		$coupon->code  = $request->code;
        $coupon->discount  = $request->discount;
        if($request->expired){
            $coupon->expired  = Carbon::createFromFormat('d/m/Y', $request->expired)->format('Y-m-d');
        }
        $coupon->status  = $request->status;
		$coupon->save();

		return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'coupon']));
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

		$coupon = Coupon::find($id);

        $coupon->expired = Carbon::createFromFormat('Y-m-d h:i:s', $coupon->expired)->format('d/m/Y');


		$data = array(
			"formObj" 			=> $coupon,
			"module" 			=> $this->module,
			"page_title" 		=> "Update",
			"action_url" 		=> $this->moduleRouteText . ".update",
			"action_params"     => $coupon->id,
			"method" 			=> "PUT",
			"statusData" 		=> ['1' => 'Active', '0' => 'Inactive'],
			"selectedStatusID"  => $coupon->status,
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
	public function update(CouponRequest $request, $id)
	{
		$coupon  = Coupon::find($id);
		$coupon->code  = $request->code;
        $coupon->discount  = $request->discount;
        if($request->expired){
            $coupon->expired  = Carbon::createFromFormat('d/m/Y', $request->expired)->format('Y-m-d');
        }
        $coupon->status  = $request->status;
		$coupon->save();

		return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.update_message', ['title' => 'coupon']));
	}

	/**
	 * Remove the specified resource from storage.
	 * @author Hitesh Khandar
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$coupon = Coupon::find($id);
        $coupon->delete();
		return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'coupon']), 'data' => array()]);
	}
    public function updateStatus(Request $request)
    {
        $couponStatus = Coupon::where('id', request('id'))->first();

        if ($couponStatus->status == 1) {
            $dataUpdate = array(
                "status" => 0
            );
            $statusMessage = "Inactive";
            Coupon::where('id', request('id'))->update($dataUpdate);
        } else {

            $dataUpdate = array(
                "status" => 1
            );
            $statusMessage = "Active";
            Coupon::where('id', request('id'))->update($dataUpdate);
        }

        //return response(['status' => 200, "msg" => $this->module ." has been $statusMessage successfully."]);
        return response(['status' => 200, "msg" =>  __('messages.status_message', ['title' => $this->module,'status_type' => $statusMessage])]);
        //return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'carrier']));
    }
}
