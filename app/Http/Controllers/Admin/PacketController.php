<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PacketRequest;
use App\Models\Packet;
use App\Models\Shape;
use App\Models\Color;
use App\Models\Clarity;
use DataTables;

class PacketController extends Controller
{
	/**
	 * Page load then call first method.
	 * @author Hitesh Khandar
	 */
	public function __construct()
	{
		$this->moduleRouteText	= "admin.packet";
		$this->moduleViewName	= "admin.packet";
		$this->list_url			= route($this->moduleRouteText . ".index");
		$module					= "Packet";
		$this->module			= $module;
		$this->modelObj			= new Packet();
        $this->path = "uploads/packet/";
	}

	/**
	 * Display a listing of the resource.
	 * @author Hitesh Khandar
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {

             $model = Packet::query()->with('shape','color','clarity');
			return DataTables::eloquent($model)
				->addColumn('action', function (Packet $row) {
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
                ->editColumn('shape', function ($row) {
					return $row->shape->name;
				})
                ->editColumn('color', function ($row) {
					return $row->color->name;
				})
                ->editColumn('clarity', function ($row) {
					return $row->clarity->name;
				})
                ->editColumn('status', function (Packet $row) {
                    $checked = "";
                    if ($row->status == 1) {
                        $checked = "checked";
                    }
                    return '<input type="checkbox" ' . $checked . ' data-toggle="toggle" data-on="Active" data-off="Inactive" onchange="statusChange(' . $row->id . ')" data-onstyle="success" data-offstyle="danger" class="toggle-demo" id="toggle-demo">';
                })
				->rawColumns(['shape','color','clarity','status','action'])
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
            "selectedshapeID"  => null,
            "selectedcolorID"  => null,
            "selectedclarityID"  => null
		);
        $data['shape'] =  Shape::Active()->pluck('name', 'id')->toArray();
        $data['color'] = Color::Active()->pluck('name', 'id')->toArray();
        $data['clarity'] = Clarity::Active()->pluck('name', 'id')->toArray();
		return view($this->moduleViewName . '.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 * @author Hitesh Khandar
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(PacketRequest $request)
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
		$Packet = Packet::find($id);

		$data = array(
			"formObj" 			=> $Packet,
			"module" 			=> $this->module,
			"page_title" 		=> "Update",
			"action_url" 		=> $this->moduleRouteText . ".update",
			"action_params"     => $Packet->id,
			"method" 			=> "PUT",
			"statusData" 		=> ['1' => 'Active', '0' => 'Inactive'],
			"selectedStatusID"  => $Packet->status,
            "selectedshapeID"  => $Packet->shape_id,
            "selectedcolorID"  => $Packet->color_id,
            "selectedclarityID"  => $Packet->clarity_id
		);
        $data['shape'] = Shape::Active()->pluck('name', 'id')->toArray();
        $data['color'] = Color::Active()->pluck('name', 'id')->toArray();
        $data['clarity'] = Clarity::Active()->pluck('name', 'id')->toArray();
		return view($this->moduleViewName . '.create', $data);
	}

	/**
	 * Update the specified resource in storage.
	 * @author Hitesh Khandar
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(PacketRequest $request, $id)
	{
        return $this->handleCreateOrUpdate($request, true, $id);
	}
    private function handleCreateOrUpdate($request, $edit = false, $id = null)
    {

        if ($edit) {
            $Packet  = Packet::find($id);
            $msg = 'messages.update_message';
        } else {
            $Packet = new Packet();
            $msg = 'messages.create_message';
        }

        /*if ($Packet::where([['shape_id',$request->shape],['color_id',$request->color],['clarity_id',$request->clarity]])->exists()) {
            return redirect()->back()->with('error', 'Packet combination already exists.');
        }*/

        try {
            $Packet->name  = $request->name;
            $Packet->diamond_size  = $request->diamond_size;
            $Packet->shape_id  = $request->shape;
            $Packet->color_id  = $request->color;
            $Packet->clarity_id  = $request->clarity;
            $Packet->price  = $request->price;
            $Packet->status = $request->status;
            $Packet->save();

            return redirect()->route($this->moduleViewName . '.index')->with('success', __($msg, ['title' => 'Packet']));
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
		$Packet = Packet::find($id);
        $Packet->delete();
		return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'Packet']), 'data' => array()]);
	}
    public function updateStatus(Request $request)
    {
        $metalStatus = Packet::where('id', request('id'))->first();

        if ($metalStatus->status == 1) {
            $dataUpdate = array(
                "status" => 0
            );
            $statusMessage = "Inactive";
            Packet::where('id', request('id'))->update($dataUpdate);
        } else {

            $dataUpdate = array(
                "status" => 1
            );
            $statusMessage = "Active";
            Packet::where('id', request('id'))->update($dataUpdate);
        }
        return response(['status' => 200, "msg" =>  __('messages.status_message', ['title' => $this->module,'status_type' => $statusMessage])]);

    }


}
