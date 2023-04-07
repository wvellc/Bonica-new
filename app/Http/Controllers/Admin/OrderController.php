<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Commonhelper;
use DataTables;

class OrderController extends Controller
{
	/**
	 * Page load then call first method.
	 * @author Hitesh Khandar
	 */
	public function __construct()
	{
		$this->moduleRouteText	= "admin.order";
		$this->moduleViewName	= "admin.order";
		$this->list_url			= route($this->moduleRouteText . ".index");
		$module					= "Order";
		$this->module			= $module;
		$this->modelObj			= new Order();
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

             $model = Order::query();

			return DataTables::eloquent($model)
				->addColumn('action', function (Order $row) {
					return view(
						"admin.partials.action",
						[
							'currentRoute'	=> $this->moduleRouteText,
							'row'			=> $row,
							'isEdit'		=> 0,
							'isDelete'		=> 0,
                            'isView'		=> 1,
						]
					)->render();
				})
				->editColumn('created_at', function ($row) {
					return Commonhelper::dateFormatChange($row->created_at);
				})
                ->editColumn('subtotal', function ($row) {
					return $row->currency_symbol.' '.$row->subtotal;
				})
                ->editColumn('shipping_charges', function ($row) {
					return $row->currency_symbol.' '.$row->shipping_charges;
				})
                ->editColumn('discount', function ($row) {
					return $row->currency_symbol.' '.$row->discount;
				})
                ->editColumn('total', function ($row) {
					return $row->currency_symbol.' '.$row->total;
				})
                ->editColumn('address', function ($row) {
                    $address = $row->street_address;
                    if($row->street_address2 != ''){
                        $address .= ', '.$row->street_address2;
                    }
                    if($row->city != ''){
                        $address .= ', '.$row->city;
                    }
                    if($row->state != ''){
                        $address .= ' '.$row->state;
                    }
                    if($row->pincode != ''){
                        $address .= ' '.$row->pincode;
                    }
                    if($row->countryDetals != ''){
                        $address .= ' '.$row->countryDetals->name;
                    }

					return $address;

				})
				->rawColumns(['total','discount','shipping_charges','subtotal','address','action'])
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
	public function store(Request $request)
	{

		$Order = new Order();
		$Order->name  = $request->name;
		$Order->status  = $request->status;
		$Order->save();

		return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'Order']));
	}

	/**
	 * Display the specified resource.
	 * @author Hitesh Khandar
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
        $data = array();
        $orders = Order::with('countryDetals')->where('id',$id)->first();
        $orderDetails = OrderDetail::with('orderStatus')->where('order_id',$id)->get();
        $orderStatus = OrderStatus::Active()->get();
        $data = array(
			"orders" => $orders,
            "orderDetails" 	=> $orderDetails,
            "orderStatus" 	=> $orderStatus,
			"page_title" 		=> "Create",
		);
		return view($this->moduleViewName . '.view', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 * @author Hitesh Khandar
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{

		$Order = Order::find($id);
		$data = array(
			"formObj" 			=> $Order,
			"module" 			=> $this->module,
			"page_title" 		=> "Update",
			"action_url" 		=> $this->moduleRouteText . ".update",
			"action_params"     => $Order->id,
			"method" 			=> "PUT",
			"statusData" 		=> ['1' => 'Active', '0' => 'Inactive'],
			"selectedStatusID"  => $Order->status,
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
	public function update(Request $request, $id)
	{
		$Order  = Order::find($id);
		$Order->name  = $request->name;
		$Order->status  = $request->status;
		$Order->save();

		return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.update_message', ['title' => 'Order']));
	}

	/**
	 * Remove the specified resource from storage.
	 * @author Hitesh Khandar
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$Order = Order::find($id);
        $Order->delete();
		return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'metal']), 'data' => array()]);
	}
    public function updateStatus(Request $request)
    {
        $OrderStatus = Order::where('id', request('id'))->first();

        if ($OrderStatus->status == 1) {
            $dataUpdate = array(
                "status" => 0
            );
            $statusMessage = "Inactive";
            Order::where('id', request('id'))->update($dataUpdate);
        } else {

            $dataUpdate = array(
                "status" => 1
            );
            $statusMessage = "Active";
            Order::where('id', request('id'))->update($dataUpdate);
        }

        //return response(['status' => 200, "msg" => $this->module ." has been $statusMessage successfully."]);
        return response(['status' => 200, "msg" =>  __('messages.status_message', ['title' => $this->module,'status_type' => $statusMessage])]);
        //return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'carrier']));
    }
    public function updateShippingStatus(Request $request)
    {
        OrderDetail::Where('id',request('id'))->update((['order_status_id'=> request('status_id')]));
        return response(['status' => 200, "msg" =>  'Order status updated successfully']);

    }
}
