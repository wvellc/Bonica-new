<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\LabourRequest;
use App\Models\Labour;
use App\Models\Metal;
use App\Models\Material;

use DataTables;

class LabourController extends Controller
{
	/**
	 * Page load then call first method.
	 * @author Hitesh Khandar
	 */
	public function __construct()
	{
		$this->moduleRouteText	= "admin.labour";
		$this->moduleViewName	= "admin.labour";
		$this->list_url			= route($this->moduleRouteText . ".index");
		$module					= "Labour Price";
		$this->module			= $module;
		$this->modelObj			= new Labour();
        $this->path = "uploads/labour/";
	}

	/**
	 * Display a listing of the resource.
	 * @author Hitesh Khandar
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {

             $model = Labour::query();
			return DataTables::eloquent($model)
				->addColumn('action', function (Labour $row) {
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

                ->editColumn('status', function (Labour $row) {
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
            "selectedmaterialID"  => null,
            "selectedmetalID"  => null
		);
        $data['material'] =  Material::Active()->pluck('name', 'id')->toArray();
        $data['metal'] = Metal::Active()->pluck('name', 'id')->toArray();
		return view($this->moduleViewName . '.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 * @author Hitesh Khandar
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(LabourRequest $request)
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
		$Labour = Labour::find($id);

		$data = array(
			"formObj" 			=> $Labour,
			"module" 			=> $this->module,
			"page_title" 		=> "Update",
			"action_url" 		=> $this->moduleRouteText . ".update",
			"action_params"     => $Labour->id,
			"method" 			=> "PUT",
			"statusData" 		=> ['1' => 'Active', '0' => 'Inactive'],
			"selectedStatusID"  => $Labour->status,
            "selectedmaterialID"  => $Labour->material_id,
            "selectedmetalID"  => $Labour->metal_id
		);
        $data['material'] =  Material::Active()->pluck('name', 'id')->toArray();
        $data['metal'] = Metal::Active()->pluck('name', 'id')->toArray();
		return view($this->moduleViewName . '.create', $data);
	}

	/**
	 * Update the specified resource in storage.
	 * @author Hitesh Khandar
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(LabourRequest $request, $id)
	{
        return $this->handleCreateOrUpdate($request, true, $id);
	}
    private function handleCreateOrUpdate($request, $edit = false, $id = null)
    {

        if ($edit) {
            $Labour  = Labour::find($id);
            $msg = 'messages.update_message';
        } else {
            $Labour = new Labour();
            $msg = 'messages.create_message';
        }
        try {
            $Labour->name  = $request->name;
            $Labour->price  = $request->price;
            $Labour->status = $request->status;
            $Labour->save();

            return redirect()->route($this->moduleViewName . '.index')->with('success', __($msg, ['title' => 'Labour Price']));
        } catch (\Exception $e) {

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
		$Labour = Labour::find($id);
        $Labour->delete();
		return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'Labour']), 'data' => array()]);
	}
    public function updateStatus(Request $request)
    {
        $metalStatus = Labour::where('id', request('id'))->first();

        if ($metalStatus->status == 1) {
            $dataUpdate = array(
                "status" => 0
            );
            $statusMessage = "Inactive";
            Labour::where('id', request('id'))->update($dataUpdate);
        } else {

            $dataUpdate = array(
                "status" => 1
            );
            $statusMessage = "Active";
            Labour::where('id', request('id'))->update($dataUpdate);
        }
        return response(['status' => 200, "msg" =>  __('messages.status_message', ['title' => $this->module,'status_type' => $statusMessage])]);

    }


}
