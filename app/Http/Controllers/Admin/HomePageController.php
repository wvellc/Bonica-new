<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomePage;
use App\Models\HomePageSlider;
use App\Models\Category;
use App\Models\HomePageSliderImage;
use App\Http\Requests\Admin\HomeSliderRequest;
use Illuminate\Support\Facades\Storage;
use App\Commonhelper;
use App\AWSHelper;

class HomePageController extends Controller
{
    public function __construct()
    {
        $this->moduleRouteText    = "admin.homepage";
        $this->moduleViewName    = "admin.homepage";
        $this->module            = "Home Page";
        $this->modelObj           = new HomePage();
        $this->path = "uploads/homepage";
    }
    public function searchCategory(Request $request)
    {
        $term = trim($request->searchTerm);
        if (empty($term)) {
            return \Response::json([]);
        }
        $categories = Category::select("id", "name")->where('parent_id', 0)->where('name', 'LIKE', "%$term%")->get();
        $searchItems = [];
        if (count($categories) > 0) {
            foreach ($categories as $category) {
                $searchItems[] = ['id' => $category->id, 'text' => $category->name];
            }
        }
        return \Response::json($searchItems);
    }
    public function index(Request $request)
    {
        $homePage = HomePage::find(1);
        $sliderImage = HomePageSliderImage::select('id', 'image', 'image_path', 'status', 'sort_order')->get();
        $homePageSlider = HomePageSlider::find(1);

        $selectedcategoryIDS = array();

        if ($homePage->catalog_category_ids) {
            $selectedcategoryIDS =  explode(",", $homePage->catalog_category_ids);
        }
        //$selectedcategory_ids = //Category::pluck('id')->all();
        //dd($selectedcategoryIDS);

        $data = array(
            "formObj"             => $homePage,
            "module"             => $this->module,
            "page_title"         => "List",
            "action_url"         => $this->moduleRouteText . ".update",
            "action_params"     => $homePage->id,
            "method"             => "POST",
            "sliderTypeData"         => ['0' => 'Image', '1' => 'Video'],
            "selectedSliderTypeID"  => $homePage->banner_type,
            "statusData"         => ['1' => 'Active', '0' => 'Inactive'],
            "selectedStatusID"  => $homePage->status,
            "sliderImage" => $sliderImage,
            "categories" => Category::where('parent_id', 0)->pluck('name', 'id')->toArray(),
            "selectedcategoryIDS" => $selectedcategoryIDS, //Category::where('parent_id', 0)->pluck('name', 'id')->toArray()
            "banner_images"  => HomePageSliderImage::get()

        );

        return view($this->moduleViewName . '.index', $data);
    }
    public function deleteBannerImage(Request $request)
    {
        $id =  $request->id;

        $bannerimage = HomePageSliderImage::select('image')->where('id', $id)->first();
        if (file_exists(public_path($this->path . $bannerimage->image))) {
            Commonhelper::deleteFile(public_path($this->path . $bannerimage->image));
        }
        HomePageSliderImage::where('id', $id)->delete();
        return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'Banner Image']), 'msg' => 'delete']);
    }
    public function update(Request $request, $id)
    {

        //dd($request->all());
        $homePage = HomePage::find($id);

        $homePage->banner_type  = $request->banner_type;
        $homePage->status  = $request->status;

        if ($request->has('video')) {
            if (Storage::disk('s3')->exists($homePage->video)) {
                Storage::disk('s3')->delete($homePage->video);
            }
            $video = Storage::disk('s3')->put('banners', $request->file('video'), 'public');
            $video_path = Storage::disk('s3')->url($video);
            $homePage->video = $video;
            $homePage->video_path = $video_path;
        }

        foreach ($request->action as $key => $value) {
            if ($value != '') {
                $image = '';
                if ($request->action[$key] == 'update') {
                    $bannerimage  = HomePageSliderImage::find($key);
                } else {
                    $bannerimage = new HomePageSliderImage();
                }

                if (isset($request->file('banner_images')[$key])) {

                    $image = Commonhelper::uploadFile1($request->file('banner_images')[$key], $this->path, $thumbnailPath = NULL, $resizeH = 800, $resizeW = 600, false);
                    $bannerimage->image  = $image;
                    $bannerimage->save();
                }
            }
        }

        $homePage->video_title  = $request->video_title;
        $homePage->video_content  = $request->video_content;
        $homePage->video_link  = $request->video_link;

        $homePage->fisrt_our_story_title  = $request->fisrt_our_story_title;
        $homePage->fisrt_our_story_content  = $request->fisrt_our_story_content;
        $homePage->fisrt_our_story_link  = $request->fisrt_our_story_link;
        $homePage->second_our_story_title  = $request->second_our_story_title;
        $homePage->second_our_story_content  = $request->second_our_story_content;
        $homePage->second_our_story_link  = $request->second_our_story_link;
        $homePage->shringaar_title  = $request->shringaar_title;
        $homePage->shringaar_sub_title  = $request->shringaar_sub_title;
        $homePage->shringaar_image1_title  = $request->shringaar_image1_title;
        $homePage->shringaar_image2_title  = $request->shringaar_image2_title;
        $homePage->shringaar_image3_title  = $request->shringaar_image3_title;
        $homePage->shringaar_image4_title  = $request->shringaar_image4_title;
        $homePage->shringaar_image5_title  = $request->shringaar_image5_title;
        $homePage->shringaar_image6_title  = $request->shringaar_image6_title;
        $homePage->shringaar_image1_link  = $request->shringaar_image1_link;
        $homePage->shringaar_image2_link  = $request->shringaar_image2_link;
        $homePage->shringaar_image3_link  = $request->shringaar_image3_link;
        $homePage->shringaar_image4_link  = $request->shringaar_image4_link;
        $homePage->shringaar_image5_link  = $request->shringaar_image5_link;
        $homePage->shringaar_image6_link  = $request->shringaar_image6_link;

        $homePage->catalog_title  = $request->catalog_title;
        $homePage->catalog_sub_title  = $request->catalog_sub_title;
        if ($request->catalog_category_ids) {
            $homePage->catalog_category_ids  = implode(",", $request->catalog_category_ids);
        }
        $homePage->bonica_jewels_title  = $request->bonica_jewels_title;
        $homePage->bonica_jewels_sub_title  = $request->bonica_jewels_sub_title;
        $homePage->bonica_jewels_icon1_title  = $request->bonica_jewels_icon1_title;
        $homePage->bonica_jewels_icon1_content  = $request->bonica_jewels_icon1_content;
        $homePage->bonica_jewels_icon2_title  = $request->bonica_jewels_icon2_title;
        $homePage->bonica_jewels_icon2_content  = $request->bonica_jewels_icon2_content;
        $homePage->bonica_jewels_icon3_title  = $request->bonica_jewels_icon3_title;
        $homePage->bonica_jewels_icon3_content  = $request->bonica_jewels_icon3_content;
        $homePage->bonica_jewels_icon4_title  = $request->bonica_jewels_icon4_title;
        $homePage->bonica_jewels_icon4_content  = $request->bonica_jewels_icon4_content;
        $homePage->recommended_title  = $request->recommended_title;
        $homePage->recommended_sub_title  = $request->recommended_sub_title;
        $homePage->about_bonica_title  = $request->about_bonica_title;
        $homePage->about_bonica_link  = $request->about_bonica_link;
        $homePage->about_bonica_content  = $request->about_bonica_content;

        $homePage->meta_title  = $request->meta_title;
        $homePage->meta_keywords  = $request->meta_keywords;
        $homePage->meta_description  = $request->meta_description;

        if ($request->has('our_story_image1')) {
            $our_story_image1 = Commonhelper::uploadFileWithThumbnail($request, 'our_story_image1', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $homePage->our_story_image1);
            $homePage->our_story_image1 = $our_story_image1;
        }
        if ($request->has('our_story_image2')) {
            $our_story_image2 = Commonhelper::uploadFileWithThumbnail($request, 'our_story_image2', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $homePage->our_story_image2);
            $homePage->our_story_image2 = $our_story_image2;
        }
        if ($request->has('shringaar_image1')) {
            //$shringaar_image1 = Commonhelper::uploadFileWithThumbnail($request, 'shringaar_image1', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $homePage->shringaar_image1);

            $shringaar_image1 = AWSHelper::uploadImageS3($request, 'shringaar_image1', "/homepage/", $homePage->shringaar_image1);
            $homePage->shringaar_image1 = $shringaar_image1;
        }
        if ($request->has('shringaar_image2')) {
            //$shringaar_image2 = Commonhelper::uploadFileWithThumbnail($request, 'shringaar_image2', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $homePage->shringaar_image2);

            $shringaar_image2 = AWSHelper::uploadImageS3($request, 'shringaar_image2', "/homepage/", $homePage->shringaar_image2);
            $homePage->shringaar_image2 = $shringaar_image2;
        }
        if ($request->has('shringaar_image3')) {
            // $shringaar_image3 = Commonhelper::uploadFileWithThumbnail($request, 'shringaar_image3', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $homePage->shringaar_image3);
            $shringaar_image3 = AWSHelper::uploadImageS3($request, 'shringaar_image3', "/homepage/", $homePage->shringaar_image3);
            $homePage->shringaar_image3 = $shringaar_image3;
        }
        if ($request->has('shringaar_image4')) {
            // $shringaar_image4 = Commonhelper::uploadFileWithThumbnail($request, 'shringaar_image4', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $homePage->shringaar_image4);
            $shringaar_image4 = AWSHelper::uploadImageS3($request, 'shringaar_image4', "/homepage/", $homePage->shringaar_image4);
            $homePage->shringaar_image4 = $shringaar_image4;
        }
        if ($request->has('shringaar_image5')) {
            // $shringaar_image5 = Commonhelper::uploadFileWithThumbnail($request, 'shringaar_image5', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $homePage->shringaar_image5);
            $shringaar_image5 = AWSHelper::uploadImageS3($request, 'shringaar_image5', "/homepage/", $homePage->shringaar_image5);
            $homePage->shringaar_image5 = $shringaar_image5;
        }
        if ($request->has('shringaar_image6')) {
            // $shringaar_image6 = Commonhelper::uploadFileWithThumbnail($request, 'shringaar_image6', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $homePage->shringaar_image6);
            $shringaar_image6 = AWSHelper::uploadImageS3($request, 'shringaar_image6', "/homepage/", $homePage->shringaar_image6);
            $homePage->shringaar_image6 = $shringaar_image6;
        }
        if ($request->has('about_bonica_bg_image')) {
            $about_bonica_bg_image = Commonhelper::uploadFileWithThumbnail($request, 'about_bonica_bg_image', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $homePage->about_bonica_bg_image);
            $homePage->about_bonica_bg_image = $about_bonica_bg_image;
        }
        if ($request->has('bonica_jewels_icon4')) {
            $bonica_jewels_icon4 = Commonhelper::uploadFileWithThumbnail($request, 'bonica_jewels_icon4', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $homePage->bonica_jewels_icon4);
            $homePage->bonica_jewels_icon4 = $bonica_jewels_icon4;
        }
        if ($request->has('bonica_jewels_icon3')) {
            $bonica_jewels_icon3 = Commonhelper::uploadFileWithThumbnail($request, 'bonica_jewels_icon3', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $homePage->bonica_jewels_icon3);
            $homePage->bonica_jewels_icon3 = $bonica_jewels_icon3;
        }
        if ($request->has('bonica_jewels_icon2')) {
            $bonica_jewels_icon2 = Commonhelper::uploadFileWithThumbnail($request, 'bonica_jewels_icon2', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $homePage->bonica_jewels_icon2);
            $homePage->bonica_jewels_icon2 = $bonica_jewels_icon2;
        }
        if ($request->has('bonica_jewels_icon1')) {
            $bonica_jewels_icon1 = Commonhelper::uploadFileWithThumbnail($request, 'bonica_jewels_icon1', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $homePage->bonica_jewels_icon1);
            $homePage->bonica_jewels_icon1 = $bonica_jewels_icon1;
        }

        $homePage->save();


        /*  if (isset($request->file('images')[$key])) {
            $image = Commonhelper::uploadFile1($request->file('images')[$key], $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, true);
            $teamdata->image  = $image;
        } */

        /*  session_start();
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
        } */

        return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.update_message', ['title' => 'Home Page']));
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
        return response(['status' => 200, "msg" =>  __('messages.status_message', ['title' => $this->module, 'status_type' => $statusMessage])]);
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
