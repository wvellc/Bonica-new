<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Commonhelper;
use DataTables;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
	{
		$this->moduleRouteText	= "admin.appointment";
		$this->moduleViewName	= "admin.appointment";
		$this->list_url			= route($this->moduleRouteText . ".index");
		$module					= "Appointment";
		$this->module			= $module;
		$this->modelObj			= new Appointment();
	}


    public function index(Request $request)
    {
        if ($request->ajax()) {
			$model = Appointment::query();
			return DataTables::eloquent($model)
				->addColumn('action', function (Appointment $row) {
					return view(
						"admin.partials.action",
						[
							'currentRoute'	=> $this->moduleRouteText,
							'row'			=> $row,
							'isEdit'		=> 0,
							'isDelete'		=> 0,
                            'isViewInModel' => 1,
						]
					)->render();
				})
				->editColumn('created_at', function ($row) {
					return Commonhelper::dateFormatChange($row->created_at);
				})


				->rawColumns(['created_at','action'])
				->make(true);
		} else {
			$data['module']		= $this->module;
			$data['page_title']	= "List";
			return view($this->moduleViewName . '.index', $data);
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    public function getContent(Request $request)
    {
        if($request->id){
            $appointment_message = Appointment::select('message')->where('id',$request->id)->first();
        }

        return response(['status' => 200, "content" => $appointment_message->message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $appointment)
    {
        //
    }
}
