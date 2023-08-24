<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SizeMasterPrice;
use App\Commonhelper;
use DataTables;
use Config;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;
use App\Models\Size;
use App\Models\Country;

class SizeMasterPriceController extends Controller
{
    public function __construct()
    {
        $this->moduleRouteText  = "admin.size-master-price";
        $this->moduleViewName   = "admin.sizemasterprice";
        $this->list_url         = route($this->moduleRouteText . ".index");
        $module                 = "Size master price";
        $this->module           = $module;
        $this->modelObj         = new SizeMasterPrice();
        $this->path = "";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {

    //         $model = SizeMasterPrice::query()->with('size','country');
    //         return DataTables::eloquent($model)
    //             ->addColumn('action', function (SizeMasterPrice $row) {
    //                 return view(
    //                     "admin.partials.action",
    //                     [
    //                         'currentRoute'  => $this->moduleRouteText,
    //                         'row'           => $row,
    //                         'isEdit'        => 1,
    //                         'isDelete'      => 1,
    //                     ]
    //                 )->render();
    //             })
    //             ->editColumn('price', function ($row) {
    //                 $price = "";
    //                 if($row->price){
    //                     $price = $row->price . '%';
    //                 }
    //                 return $price;
    //             })
    //             // ->editColumn('size_id', function ($row) {
    //             //     $size_id = "";
    //             //     if($row->size_id){
    //             //         $size_id = $row->size->name;
    //             //     }
    //             //     return $size_id;
    //             // })
    //             // ->editColumn('country_id', function ($row) {
    //             //     $country_id = "";
    //             //     if($row->country_id){
    //             //         $country_id = $row->country->name;
    //             //     }
    //             //     return $country_id;
    //             // })
    //             ->editColumn('status', function (SizeMasterPrice $row) {
    //                 $checked = "";
    //                 if ($row->status == 1) {
    //                     $checked = "checked";
    //                 }
    //                 return '<input type="checkbox" ' . $checked . ' data-toggle="toggle" data-on="Active" data-off="Inactive" onchange="statusChange(' . $row->id . ')" data-onstyle="success" data-offstyle="danger" class="toggle-demo" id="toggle-demo">';
    //             })
    //             ->rawColumns(['price','status','action','size_id'])
    //             ->make(true);
    //     } else {
    //         $data['module']     = $this->module;
    //         $data['page_title'] = "List";
    //         return view($this->moduleViewName . '.index', $data);
    //     }
    // }

    public function index()
    {
        $sizeMasterPrice = SizeMasterPrice::find(1);
        $size = Size::AllSize();
        asort($size);
        $data = array(
            "formObj"           => $sizeMasterPrice,
            "module"            => $this->module,
            "page_title"        => "Update",
            "action_url"        => $this->moduleRouteText . ".update",
            "action_params"     => $sizeMasterPrice->id,
            "method"            => "PUT",
            "statusData"        => ['1' => 'Active', '0' => 'Inactive'],
            "selectedStatusID"  => $sizeMasterPrice->status,
            "size" => $size,
            "country" => Country::AllCountry(),
            "selectedSizeID"  => $sizeMasterPrice->size_id,
            "selectedCountryID"  => $sizeMasterPrice->country_id
        );
        return view($this->moduleViewName . '.create', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $size = Size::AllSize();
        asort($size);
        $data = array(
            "formObj"           => $this->modelObj,
            "module"            => $this->module,
            "page_title"        => "Create",
            "action_url"        => $this->moduleRouteText . ".store",
            "action_params"     => $this->modelObj->id,
            "method"            => "POST",
            "statusData"        => ['1' => 'Active', '0' => 'Inactive'],
            "selectedStatusID"  => 1,
            "size" => $size,
            "country" => Country::AllCountry(),
            "selectedSizeID"  => null,
            "selectedCountryID"  => null
        );

        return view($this->moduleViewName . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $sizeMasterPrice = new SizeMasterPrice();
            // $sizeMasterPrice->size_id  = $request->size;
            // $sizeMasterPrice->country_id  = $request->country;
            $sizeMasterPrice->price  = $request->price;
            $sizeMasterPrice->save();

            return redirect()->route($this->moduleRouteText . '.index')->with('success', __('messages.create_message', ['title' => 'size master price']));
        } catch (\Exception $e) {
            return redirect()->route($this->moduleRouteText . '.create')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sizeMasterPrice = SizeMasterPrice::find($id);
        $size = Size::AllSize();
        asort($size);
        $data = array(
            "formObj"           => $sizeMasterPrice,
            "module"            => $this->module,
            "page_title"        => "Update",
            "action_url"        => $this->moduleRouteText . ".update",
            "action_params"     => $sizeMasterPrice->id,
            "method"            => "PUT",
            "statusData"        => ['1' => 'Active', '0' => 'Inactive'],
            "selectedStatusID"  => $sizeMasterPrice->status,
            "size" => $size,
            "country" => Country::AllCountry(),
            "selectedSizeID"  => $sizeMasterPrice->size_id,
            "selectedCountryID"  => $sizeMasterPrice->country_id
        );
        return view($this->moduleViewName . '.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $sizeMasterPrice = SizeMasterPrice::find($id);
            // $sizeMasterPrice->size_id  = $request->size;
            // $sizeMasterPrice->country_id  = $request->country;
            $sizeMasterPrice->price  = $request->price;
            $sizeMasterPrice->save();

            return redirect()->route($this->moduleRouteText . '.index')->with('success', __('messages.update_message', ['title' => 'size master price']));
        } catch (\Exception $e) {
            return redirect()->route($this->moduleRouteText . '.edit' , $id)->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sizeMasterPrice = SizeMasterPrice::find($id);
        $sizeMasterPrice->delete();
        return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'size master price']), 'data' => array()]);
    }

    public function updateStatus(Request $request)
    {
        $sizeMasterPrice = SizeMasterPrice::where('id', request('id'))->first();

        if ($sizeMasterPrice->status == 1) {
            $dataUpdate = array(
                "status" => 0
            );
            $statusMessage = "Inactive";
            SizeMasterPrice::where('id', request('id'))->update($dataUpdate);
        } else {

            $dataUpdate = array(
                "status" => 1
            );
            $statusMessage = "Active";
            SizeMasterPrice::where('id', request('id'))->update($dataUpdate);
        }
        return response(['status' => 200, "msg" =>  __('messages.status_message', ['title' => $this->module,'status_type' => $statusMessage])]);

    }
}
