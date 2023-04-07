<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Commonhelper;
use DataTables;
use Illuminate\Support\Str;
use Config;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Country;

class UserController extends Controller
{
	/**
	 * Page load then call first method.
	 * @author Hitesh Khandar
	 */
	public function __construct()
	{
		$this->moduleRouteText	= "admin.user";
		$this->moduleViewName	= "admin.user";
		$this->list_url			= route($this->moduleRouteText . ".index");
		$module					= "User";
		$this->module			= $module;
		$this->modelObj			= new User();
        $this->path = "uploads/user/";
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
            ->with(['user' => function ($query) {
                $query->select('id', 'username');
            }])
            ->get() */
             $model = User::query()->with('role');
			return DataTables::eloquent($model)
				->addColumn('action', function (User $row) {
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
                ->editColumn('status', function (User $row) {
                    $checked = "";
                    if ($row->status == 1) {
                        $checked = "checked";
                    }
                    return '<input type="checkbox" ' . $checked . ' data-toggle="toggle" data-on="Active" data-off="Inactive" onchange="statusChange(' . $row->id . ')" data-onstyle="success" data-offstyle="danger" class="toggle-demo" id="toggle-demo">';
                })
				->rawColumns(['image','role','status','action'])
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
			"genderData" 		=> ['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'],
			"selectedGenderID"  => 1,
            "country"  => Country::AllCountry()
		);
		return view($this->moduleViewName . '.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 * @author Hitesh Khandar
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(UserRequest $request)
	{
		$user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = Str::lower(trim($request->email));
		$user->password    = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->street_address = $request->street_address;
        $user->street_address2 = $request->street_address2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->pincode = $request->pincode;
        $user->country = $request->country;
        $user->status      = $request->status;
        $user->role_id = Role::getRoleId(Config::get('constants.ROLE_USER'));
		$user->save();

		return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'user']));
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

		$user = User::find($id);
		$data = array(
			"formObj" 			=> $user,
			"module" 			=> $this->module,
			"page_title" 		=> "Update",
			"action_url" 		=> $this->moduleRouteText . ".update",
			"action_params"     => $user->id,
			"method" 			=> "PUT",
			"statusData" 		=> ['1' => 'Active', '0' => 'Inactive'],
			"selectedStatusID"  => $user->status,
			"genderData" 		=> ['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'],
			"selectedGenderID"  => $user->gender,
            "country"  => Country::AllCountry()
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
	public function update(UserRequest $request, $id)
	{
		$user  = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = Str::lower(trim($request->email));
        if($request->password){
			$user->password    = Hash::make($request->password);
		}
        $user->phone_number = $request->phone_number;
        $user->street_address = $request->street_address;
        $user->street_address2 = $request->street_address2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->pincode = $request->pincode;
        $user->country = $request->country;
        $user->status      = $request->status;
		$user->save();

		return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.update_message', ['title' => 'user']));
	}

	/**
	 * Remove the specified resource from storage.
	 * @author Hitesh Khandar
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
        $user->delete();
        if($user->image){
            if (file_exists(public_path($this->path . $user->image))) {
                Commonhelper::deleteFile(public_path($this->path . $user->image));
            }
        }
		return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'admin']), 'data' => array()]);
	}
    public function updateStatus(Request $request)
    {
        $userStatus = User::where('id', request('id'))->first();

        if ($userStatus->status == 1) {
            $dataUpdate = array(
                "status" => 0
            );
            $statusMessage = "Inactive";
            User::where('id', request('id'))->update($dataUpdate);
        } else {

            $dataUpdate = array(
                "status" => 1
            );
            $statusMessage = "Active";
            User::where('id', request('id'))->update($dataUpdate);
        }

        //return response(['status' => 200, "msg" => $this->module ." has been $statusMessage successfully."]);
        return response(['status' => 200, "msg" =>  __('messages.status_message', ['title' => $this->module,'status_type' => $statusMessage])]);
        //return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'carrier']));
    }
}
