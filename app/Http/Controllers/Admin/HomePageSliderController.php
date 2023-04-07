<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\HomeSliderRequest;
use App\Models\HomePageSlider;
use App\Models\HomePageSliderImage;

use Illuminate\Support\Facades\Storage;



class HomePageSliderController extends Controller
{
    /**
     * Page load then call first method.
     * @author Hitesh Khandar
     */
    public function __construct()
    {
        $this->moduleRouteText    = "admin.homepageslider";
        $this->moduleViewName    = "admin.homepageslider";
        $this->list_url            = route($this->moduleRouteText . ".index");
        $module                    = "Home Page Slider";
        $this->module            = $module;
        $this->modelObj            = new HomePageSlider();
        $this->path = "uploads/slider";
    }
    /**
     * Display a listing of the resource.
     * @author Hitesh Khandar
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sliderImage = HomePageSliderImage::select('id', 'image', 'image_path', 'status', 'sort_order')->get();
        $homePageSlider = HomePageSlider::find(1);
        $data = array(
            "formObj"             => $homePageSlider,
            "module"             => $this->module,
            "page_title"         => "List",
            "action_url"         => $this->moduleRouteText . ".update",
            "action_params"     => $homePageSlider->id,
            "method"             => "PUT",
            "sliderTypeData"         => ['0' => 'Image', '1' => 'Video'],
            "selectedSliderTypeID"  => $homePageSlider->slider_type,
            "statusData"         => ['1' => 'Active', '0' => 'Inactive'],
            "selectedStatusID"  => $homePageSlider->status,
            "sliderImage" => $sliderImage
        );
        return view($this->moduleViewName . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @author Hitesh Khandar
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     * @author Hitesh Khandar
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HomeSliderRequest $request)
    {
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
    }

    /**
     * Update the specified resource in storage.
     * @author Hitesh Khandar
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HomeSliderRequest $request, $id)
    {
        session_start();
        $homeSlider = HomePageSlider::find($id);
        if ($request->has('video')) {
            if (Storage::disk('s3')->exists($homeSlider->video)) {
                Storage::disk('s3')->delete($homeSlider->video);
            }

            $video = Storage::disk('s3')->put('banners', $request->file('video'), 'public');
            $video_path = Storage::disk('s3')->url($video);

            $homeSlider->video = $video;
            $homeSlider->video_path = $video_path;
        }
        $homeSlider->slider_type  = $request->slider_type;
        $homeSlider->status  = $request->status;
        $homeSlider->save();

        if (isset($_SESSION["imageId"])) {
            foreach ($_SESSION["imageId"] as $image_id) {
                HomePageSliderImage::where('id', $image_id)->update(['status' => 1]);
            }
            unset($_SESSION["imageId"]);
        }

        return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.update_message', ['title' => 'Home Slider']));
    }

    /**
     * Remove the specified resource from storage.
     * @author Hitesh Khandar
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
    public function updateStatus(Request $request)
    {
        $homepagesliderStatus = HomePageSlider::where('id', request('id'))->first();

        if ($homepagesliderStatus->status == 1) {
            $dataUpdate = array(
                "status" => 0
            );
            $statusMessage = "Inactive";
            HomePageSlider::where('id', request('id'))->update($dataUpdate);
        } else {

            $dataUpdate = array(
                "status" => 1
            );
            $statusMessage = "Active";
            HomePageSlider::where('id', request('id'))->update($dataUpdate);
        }

        //return response(['status' => 200, "msg" => $this->module ." has been $statusMessage successfully."]);
        return response(['status' => 200, "msg" =>  __('messages.status_message', ['title' => $this->module, 'status_type' => $statusMessage])]);
        //return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'carrier']));
    }
    public function dropzoneStore(Request $request)
    {
        session_start();
        //unset($_SESSION["imageId"]);
        //dd($request->file('file'));
        //$image = Commonhelper::uploadFileWithThumbnail($request, 'file', $this->path, $thumbnailPath = NULL, $resizeH = NULL, $resizeW = NULL);

        $destinationPath = public_path($this->path);
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move($destinationPath, $imageName);

        $imageUpload = new HomePageSliderImage();
        $imageUpload->image = $imageName;
        $imageUpload->status = 0;
        $imageUpload->save();

        $image_array = array();
        if (isset($_SESSION["imageId"])) {
            $image_array = $_SESSION["imageId"];
            $image_array[] = $imageUpload->id;
            $_SESSION["imageId"] = $image_array;
        } else {
            $image_array[] = $imageUpload->id;
            $_SESSION["imageId"] = $image_array;
        }
        return response()->json(['success' => $image]);
    }
    public function dropzoneDelete(Request $request)
    {
        $filename =  $request->filename;
        $query = HomePageSliderImage::where('image', $filename);
        if (isset($request->id)) {
            $query = $query->where('id', $request->id);
        }
        $query = $query->delete();
        $path = public_path() . '/' . $this->path . '/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return response()->json(['msg' => 'delete']);
    }
}
