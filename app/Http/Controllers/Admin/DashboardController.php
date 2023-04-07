<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Payment;
use Carbon\Carbon;

class DashboardController extends Controller {
    /**
	 * Page load then call first method.
	 * @author Purvesh Patel
	 */
	public function __construct() {
		$this->moduleRouteText	= "admin.dashboard";
		$this->moduleViewName	= "admin.dashboard";
		$this->list_url			= route($this->moduleRouteText . ".index");
		$module					= "Dashboard";
		$this->module			= $module;
		$this->modelObj			= "";
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

        $data['module']		= $this->module;
		$data['page_title']	= "Dashboard";

        $data['todayOrders'] = Order::whereDate('created_at', Carbon::today())->count();
        $data['latesOrders'] =  Order::latest()->take(5)->get();
        $data['latesCustomers'] =  User::latest()->take(5)->get();

        //$data['latesSaleCategory'] = OrderDetail::select('id')->groupBy('category_id');
        $data['latesSaleCategorys'] = OrderDetail::select('categories.name','category_id', \DB::raw("count(category_id) as total_orders"))
        ->leftJoin('categories', 'order_details.category_id', '=', 'categories.id')
        ->groupBy('category_id')->get();

        $data['months'] = array('1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');


        return view($this->moduleViewName . '.dashboard', $data);
	}

    public function getSalesValue(Request $request)
    {

        if ($request->month_year) {
            $month_year_arr = explode('-', $request->month_year);
            $month = $month_year_arr[0];
            $year = $month_year_arr[1];

            $total_payment = Payment::whereMonth('created_at', $month)
                ->whereYear('created_at', $year)->get()->sum('amount_in_INR');


            return response()->json(['status' => true,  "total_payment" => '&#8377; ' . number_format((float)$total_payment, 3, '.', '')]);

            /* return response(['status' => true, "service_data_arr" => $service_data_arr, "total" => $total]);  */
        }
    }
}
