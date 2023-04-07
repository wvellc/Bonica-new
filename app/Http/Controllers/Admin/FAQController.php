<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FAQRequest;
use App\Models\Faq;
use App\Models\CategoryFaq;
use App\Commonhelper;
use DataTables;
use Config;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response

	 * Page load then call first method.
	 * @author Hitesh Khandar
	 */
	public function __construct()
	{
		$this->moduleRouteText	= "admin.faq";
		$this->moduleViewName	= "admin.faq";
		$this->list_url			= route($this->moduleRouteText . ".index");
		$module					= "FAQ";
		$this->module			= $module;
		$this->modelObj			= new Faq();
        //$this->path = "uploads/testimonial/";
	}

    /**
	 * Display a listing of the resource.
	 * @author Hitesh Khandar
	 * @return \Illuminate\Http\Response
	 */
    public function index(Request $request)
    {
        if ($request->ajax()) {
			$model = Faq::query()->with('topics');

			return DataTables::eloquent($model)
                ->addColumn('action', function (Faq $row) {
                    return view(
                        "admin.partials.action",
                        [
                            'currentRoute'	=> $this->moduleRouteText,
                            'row'			=> $row,
                            'isEdit'		=> 1,
                            'isDelete'		=> 1,
                            'isViewInModel' => 0,
                        ]
                    )->render();
                })
				->editColumn('created_at', function ($row) {
					return Commonhelper::dateFormatChange($row->created_at);
				})

                ->editColumn('topic', function ($row) {
					return $row->topics->topic;
				})
                ->editColumn('status', function (Faq $row) {
                    $checked = "";
                    if ($row->status == 1) {
                        $checked = "checked";
                    }
                    return '<input type="checkbox" ' . $checked . ' data-toggle="toggle" data-on="Active" data-off="Inactive" onchange="statusChange(' . $row->id . ')" data-onstyle="success" data-offstyle="danger" class="toggle-demo" id="toggle-demo">';
                })
				->rawColumns(['topic','created_at','status','action'])
                ->filter(function ($query)
                {
                    if(!empty(request()->get("search_topic")))
                    {
                        //$query = $query->where("cate_id", 'LIKE', '%'.request()->get("search_topic").'%');
                        $query = $query->where("cate_id", request()->get("search_topic"));
                    }

                })
				->make(true);
		} else {

			$data['module']		= $this->module;
			$data['page_title']	= "List";
            $data['topics'] = CategoryFaq::Active()->pluck('topic', 'id')->toArray();
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
            "selectedtopicsID"  => null,

		);
        $data['topics'] = CategoryFaq::Active()->pluck('topic', 'id')->toArray();
		return view($this->moduleViewName . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FAQRequest $request)
    {
        $faq  = new Faq();
		$faq->cate_id   = $request->cate_id;
        $faq->question   = $request->question;
        $faq->answer   = $request->answer;
		$faq->status  = $request->status;
		$faq->save();
		return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'FAQ']));
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
        $faq = Faq::find($id);
		$data = array(
			"formObj" 			=> $faq,
			"module" 			=> $this->module,
			"page_title" 		=> "Update",
			"action_url" 		=> $this->moduleRouteText . ".update",
			"action_params"     => $faq->id,
			"method" 			=> "PUT",
			"statusData" 		=> ['1' => 'Active', '0' => 'Inactive'],
            "selectedStatusID"  => $faq->status,
            "selectedtopicsID"  => $faq->cate_id,
		);
        $data['topics'] = CategoryFaq::Active()->pluck('topic', 'id')->toArray();
		return view($this->moduleViewName . '.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FAQRequest $request, $id)
    {
        $faq  = Faq::find($id);
		$faq->cate_id   = $request->cate_id;
        $faq->question   = $request->question;
        $faq->answer   = $request->answer;
		$faq->status  = $request->status;
		$faq->save();

		return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.update_message', ['title' => 'FAQ']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::find($id);
        $faq->delete();

		return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'FAQ']), 'data' => array()]);
    }
    public function updateStatus(Request $request)
    {
        $status = Faq::where('id', request('id'))->first();

        if ($status->status == 1) {
            $dataUpdate = array(
                "status" => 0
            );
            $statusMessage = "Inactive";
            Faq::where('id', request('id'))->update($dataUpdate);
        } else {

            $dataUpdate = array(
                "status" => 1
            );
            $statusMessage = "Active";
            Faq::where('id', request('id'))->update($dataUpdate);
        }

        //return response(['status' => 200, "msg" => $this->module ." has been $statusMessage successfully."]);
        return response(['status' => 200, "msg" =>  __('messages.status_message', ['title' => $this->module,'status_type' => $statusMessage])]);
        //return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'carrier']));
    }

    public function getContent(Request $request)
    {
        if($request->id){
            $faq_content = Faq::select('answer')->where('id',$request->id)->first();
        }
        return response(['status' => 200, "content" => $faq_content->answer]);
    }


}
