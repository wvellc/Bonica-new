<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\BlogCategory;
use App\Commonhelper;
use DataTables;
use Auth;

class BlogController extends Controller
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
		$this->moduleRouteText	= "admin.blog";
		$this->moduleViewName	= "admin.blog";
		$this->list_url			= route($this->moduleRouteText . ".index");
		$module					= "Blog";
		$this->module			= $module;
		$this->modelObj			= new Blog();
        $this->path = "uploads/blog/";
	}

    /**
	 * Display a listing of the resource.
	 * @author Hitesh Khandar
	 * @return \Illuminate\Http\Response
	 */
    public function index(Request $request)
    {
        if ($request->ajax()) {
			$model = Blog::query()->with('category');

			return DataTables::eloquent($model)
            ->addColumn('action', function (Blog $row) {
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
					return DateFormateDMY($row->created_at);
				})
                ->editColumn('category', function ($row) {
					return $row->category->name;
				})
                ->editColumn('image', function ($row) {
                    if($row->image){
                        $image = file_exists($this->path.$row->image) ? $this->path.$row->image :  '/images/default-img.png';
                    }
                    else{
                        $image =  '/images/default-img.png';
                    }
                    return '<img  width="100" src="'.url($image).'" class="img-thumbnail" alt="category">';
                })
                ->editColumn('status', function (Blog $row) {
                    $checked = "";
                    if ($row->status == 1) {
                        $checked = "checked";
                    }
                    return '<input type="checkbox" ' . $checked . ' data-toggle="toggle" data-on="Active" data-off="Inactive" onchange="statusChange(' . $row->id . ')" data-onstyle="success" data-offstyle="danger" class="toggle-demo" id="toggle-demo">';
                })

				->rawColumns(['practitioner','created_at','updated_at','image','status','action'])
                /* ->filter(function ($query)
                {
                    if(!empty(request()->get("search_practitioner")))
                    {
                        $query = $query->where("blogs.user_id", 'LIKE', '%'.request()->get("search_practitioner").'%');
                    }

                }) */
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
            "selectedCategory"  => null,

		);
        $data['category'] = BlogCategory::Active()->pluck('name', 'id')->toArray();

		return view($this->moduleViewName . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        try {
            $blog = new Blog();
            $blog->category_id = $request->category;
            $blog->title = $request->title;
            $blog->status  = $request->status;
            $blog->content  = $request->content;
            $blog->meta_title  = $request->meta_title;
            $blog->meta_keywords  = $request->meta_keywords;
            $blog->meta_description  = $request->meta_description;


            $content = $request->content;
            if($content){
                $content = mb_convert_encoding($content, "HTML-ENTITIES", 'UTF-8');
                $dom = new \DomDocument();
                @$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

                $imageFile = $dom->getElementsByTagName('img');

                foreach($imageFile as $item => $image){

                    $data = $image->getAttribute('src');
                    $base64Image = explode(";base64,", $data);
                    if(isset($base64Image[1])){
                        list($type, $data) = explode(';', $data);

                        $extention = explode('/', $type);
                        list(, $data)      = explode(',', $data);

                        $imgeData = base64_decode($data);
                        $image_name= "/uploads/blog/" . time().$item.'.'.$extention[1];
                        $path = public_path() . $image_name;
                        file_put_contents($path, $imgeData);

                        $image->removeAttribute('src');
                        $image->setAttribute('src', $image_name);
                    }
                }
                $blog->content = $dom->saveHTML();
            }


            $blog->	created_by = Auth::guard('admin')->user()->id;
            if($request->has('image'))
            {
                $image = Commonhelper::uploadFileWithThumbnail($request, 'image', $this->path, $thumbnailPath = NULL, $resizeH = NULL, $resizeW = NULL);
                $blog->image = $image;
            }
            $blog->save();

            } catch (\Exception $e) {
                return redirect()->route($this->moduleViewName . '.create')->with('error', $e->getMessage());
            }
            return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'Blog']));
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
        $blog = Blog::find($id);

		$data = array(
			"formObj" 			=> $blog,
			"module" 			=> $this->module,
			"page_title" 		=> "Update",
			"action_url" 		=> $this->moduleRouteText . ".update",
			"action_params"     => $blog->id,
			"method" 			=> "PUT",
			"statusData" 		=> ['1' => 'Active', '0' => 'Inactive'],
            "selectedStatusID"  => $blog->status,
            "selectedCategory"  => $blog->category_id,
		);
        $data['category'] = BlogCategory::Active()->pluck('name', 'id')->toArray();
		return view($this->moduleViewName . '.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {
        $blog  = Blog::find($id);
		$blog->category_id = $request->category;
        $blog->title = $request->title;
        $blog->status  = $request->status;
        $blog->content = $request->content;
        $blog->meta_title  = $request->meta_title;
        $blog->meta_keywords  = $request->meta_keywords;
        $blog->meta_description  = $request->meta_description;

        $content = $request->content;
        if($content){
            $content = mb_convert_encoding($content, "HTML-ENTITIES", 'UTF-8');
            $dom = new \DomDocument();
            @$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $imageFile = $dom->getElementsByTagName('img');

            foreach($imageFile as $item => $image){

                $data = $image->getAttribute('src');
                $base64Image = explode(";base64,", $data);
                if(isset($base64Image[1])){
                    list($type, $data) = explode(';', $data);

                    $extention = explode('/', $type);
                    list(, $data)      = explode(',', $data);

                    $imgeData = base64_decode($data);
                    $image_name= "/uploads/blog/" . time().$item.'.'.$extention[1];
                    $path = public_path() . $image_name;
                    file_put_contents($path, $imgeData);

                    $image->removeAttribute('src');
                    $image->setAttribute('src', $image_name);
                }
            }
            $blog->content = $dom->saveHTML();
        }

        if($request->has('image'))
        {
            $image = Commonhelper::uploadFileWithThumbnail($request, 'image', $this->path, $thumbnailPath = NULL, $resizeH = 100, $resizeW = 100, $blog->image);
            $blog->image = $image;
        }
		$blog->save();

		return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.update_message', ['title' => 'Blog']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        if($blog->image){
            if (file_exists(public_path($this->path . $blog->image))) {
                Commonhelper::deleteFile(public_path($this->path . $blog->image));
            }
        }
        $blog->delete();
        return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'Blog']), 'data' => array()]);
    }
    public function updateStatus(Request $request)
    {
        $status = Blog::where('id', request('id'))->first();

        if ($status->status == 1) {
            $dataUpdate = array(
                "status" => 0
            );
            $statusMessage = "Inactive";
            Blog::where('id', request('id'))->update($dataUpdate);
        } else {

            $dataUpdate = array(
                "status" => 1
            );
            $statusMessage = "Active";
            Blog::where('id', request('id'))->update($dataUpdate);
        }

        //return response(['status' => 200, "msg" => $this->module ." has been $statusMessage successfully."]);
        return response(['status' => 200, "msg" =>  __('messages.status_message', ['title' => $this->module,'status_type' => $statusMessage])]);
        //return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'carrier']));
    }
    public function getContent(Request $request)
    {
        if($request->id){
            $blog_content = Blog::select('content')->where('id',$request->id)->first();
        }

        return response(['status' => 200, "content" => $blog_content->content]);
    }
}
