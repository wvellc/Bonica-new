<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CMSPageRequest;
use App\Models\CmsPage;
use App\Models\OurStory;
use App\Models\Sustainablity;
use App\Models\Bonica5bs3;
use App\Commonhelper;
use App\Models\ourTeam;
use App\Models\Team;
use App\Models\Milestone;
use Illuminate\Support\Facades\Storage;
use App\Models\sizeGuide;
use App\Models\sizeGuideImage;

use DataTables;
use Config;
use Illuminate\Support\Facades\Hash;
use DB;

class CMSPageController extends Controller
{
    /**
     * Page load then call first method.
     * @author Hitesh Khandar
     */
    public function __construct()
    {
        $this->moduleRouteText    = "admin.cmspage";
        $this->moduleViewName    = "admin.cmspage";
        $this->list_url            = route($this->moduleRouteText . ".index");
        $module                    = "CMS Page";
        $this->module            = $module;
        $this->modelObj            = new CmsPage();
        $this->path = "uploads/cmspage/";
        $this->path1 = "uploads/cmspage/thumb/";
    }
    /**
     * Display a listing of the resource.
     * @author Hitesh Khandar
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $model = CmsPage::query();
            return DataTables::eloquent($model)
                ->addColumn('action', function (CmsPage $row) {
                    return view(
                        "admin.partials.action",
                        [
                            'currentRoute'    => $this->moduleRouteText,
                            'row'            => $row,
                            'isEdit'        => 1,
                            'isDelete'        => 1,
                        ]
                    )->render();
                })
                ->editColumn('created_at', function ($row) {
                    return Commonhelper::dateFormatChange($row->created_at);
                })
                ->editColumn('status', function (CmsPage $row) {
                    $checked = "";
                    if ($row->status == 1) {
                        $checked = "checked";
                    }
                    return '<input type="checkbox" ' . $checked . ' data-toggle="toggle" data-on="Active" data-off="Inactive" onchange="statusChange(' . $row->id . ')" data-onstyle="success" data-offstyle="danger" class="toggle-demo" id="toggle-demo">';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        } else {
            $data['module']        = $this->module;
            $data['page_title']    = "List";
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
            "formObj"            => $this->modelObj,
            "module"             => $this->module,
            "page_title"         => "Create",
            "action_url"         => $this->moduleRouteText . ".store",
            "action_params"     => $this->modelObj->id,
            "method"             => "POST",
            "statusData"         => ['1' => 'Active', '0' => 'Inactive'],
            "selectedStatusID"  => 1,
        );
        return view($this->moduleViewName . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @author Hitesh Khandar
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CMSPageRequest $request)
    {
        $cmspage = new CmsPage();
        $cmspage->name  = $request->name;
        $cmspage->status  = $request->status;
        $cmspage->content  = $request->content;
        $cmspage->meta_title  = $request->meta_title;
        $cmspage->meta_keywords  = $request->meta_keywords;
        $cmspage->meta_description  = $request->meta_description;

        if ($request->has('banner_image')) {
            $banner_image = Commonhelper::uploadFileWithThumbnail($request, 'banner_image', $this->path, $thumbnailPath = NULL, $resizeH = 300, $resizeW = 1920);
            $cmspage->banner_image = $banner_image;
        }
        if ($request->has('image')) {
            $image = Commonhelper::uploadFileWithThumbnail($request, 'image', $this->path, $thumbnailPath = NULL, $resizeH = 560, $resizeW = 690);
            $cmspage->image = $image;
        }
        $cmspage->save();
        return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'CMS Page']));
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
    public function pageediting(Request $request)
    {

        $data = array();
        $teams = array();
        $milestones = array();

        $sizeGuideImage = array();
        $sizeGuideImage['rings'] = array();
        $sizeGuideImage['bracelets'] = array();
        $sizeGuideImage['necklaces'] = array();

        if ($request->segment(3)) {

            if ($request->segment(3) == 'our-story') {
                $cmspage = OurStory::where('slug', $request->segment(3))->first();
            } else if ($request->segment(3) == 'sustainablity') {
                $cmspage = Sustainablity::where('slug', $request->segment(3))->first();
            } else if ($request->segment(3) == 'bonica5bs3') {
                $cmspage = Bonica5bs3::where('slug', $request->segment(3))->first();
            } else if ($request->segment(3) == 'our-team') {
                $cmspage = ourTeam::where('slug', $request->segment(3))->first();
                $teams = Team::get();
                $milestones = Milestone::orderBy('year', 'ASC')->get();
            } else if ($request->segment(3) == 'size-guide') {
                $cmspage = sizeGuide::where('slug', $request->segment(3))->first();


                $sizeGuideImageData = sizeGuideImage::get();
                if (count($sizeGuideImageData) > 0) {
                    foreach ($sizeGuideImageData as $guideImage) {
                        if ($guideImage->category_type == 'rings') {
                            $sizeGuideImage['rings'][] = array('id' => $guideImage->id, 'image' => $guideImage->image, 'product_url' => $guideImage->product_url);
                        }
                        if ($guideImage->category_type == 'bracelets') {
                            $sizeGuideImage['bracelets'][] = array('id' => $guideImage->id, 'image' => $guideImage->image);
                        }
                        if ($guideImage->category_type == 'necklaces') {
                            $sizeGuideImage['necklaces'][] = array('id' => $guideImage->id, 'image' => $guideImage->image);
                        }
                    }
                }
            } else {
                $cmspage = CmsPage::where('slug', $request->segment(3))->first();
            }
            if (!empty($cmspage)) {
                $data = array(
                    "formObj"             => $cmspage,
                    "module"             => $cmspage->name,
                    "page_title"         => "Update",
                    "action_url"         => $this->moduleRouteText . ".update",
                    "action_params"     => $cmspage->id,
                    "method"             => "PUT",
                    "statusData"         => ['1' => 'Active', '0' => 'Inactive'],
                    "selectedStatusID"  => $cmspage->status,
                    "teams"  => $teams,
                    "milestones"  => $milestones,
                    "rings"  => $sizeGuideImage['rings'],
                    "bracelets"  => $sizeGuideImage['bracelets'],
                    "necklaces"  => $sizeGuideImage['necklaces'],
                );
                if ($request->segment(3) == 'our-story') {
                    return view('admin.cmspage.our-story', $data);
                } else if ($request->segment(3) == 'sustainablity') {
                    return view('admin.cmspage.sustainablity', $data);
                } else if ($request->segment(3) == 'bonica5bs3') {
                    return view('admin.cmspage.bonica5bs3', $data);
                } else if ($request->segment(3) == 'our-team') {
                    return view('admin.cmspage.our-team', $data);
                } else if ($request->segment(3) == 'size-guide') {
                    return view('admin.cmspage.size-guide', $data);
                }
                return view($this->moduleViewName . '.create', $data);
            }
        }
        return view('admin.404');
    }

    public function edit($id)
    {

        $user = CmsPage::find($id);
        $data = array(
            "formObj"             => $user,
            "module"             => $this->module,
            "page_title"         => "Update",
            "action_url"         => $this->moduleRouteText . ".update",
            "action_params"     => $user->id,
            "method"             => "PUT",
            "statusData"         => ['1' => 'Active', '0' => 'Inactive'],
            "selectedStatusID"  => $user->status,
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
    public function update(CMSPageRequest $request, $id)
    {
        if ($request->page == 'our-story') {
            $this->ourStory($request, $id);
            return redirect()->route('admin.cmspage', 'our-story')->with('success', __('messages.update_message', ['title' => 'CMS Page']));
        } else if ($request->page == 'sustainablity') {
            $this->sustainablity($request, $id);
            return redirect()->route('admin.cmspage', 'sustainablity')->with('success', __('messages.update_message', ['title' => 'CMS Page']));
        } else if ($request->page == 'bonica5bs3') {
            $this->bonica5bs3($request, $id);
            return redirect()->route('admin.cmspage', 'bonica5bs3')->with('success', __('messages.update_message', ['title' => 'CMS Page']));
        } else if ($request->page == 'our-team') {
            $this->ourTeam($request, $id);
            return redirect()->route('admin.cmspage', 'our-team')->with('success', __('messages.update_message', ['title' => 'CMS Page']));
        } else if ($request->page == 'size-guide') {
            $this->sizeGuide($request, $id);
            return redirect()->route('admin.cmspage', 'size-guide')->with('success', __('messages.update_message', ['title' => 'CMS Page']));
        }

        $cmspage  = CmsPage::find($id);
        $cmspage->name  = $request->name;
        $cmspage->status  = $request->status;
        $cmspage->content  = $this->base64ImageUpload($request->content);
        $cmspage->meta_title  = $request->meta_title;
        $cmspage->meta_keywords  = $request->meta_keywords;
        $cmspage->meta_description  = $request->meta_description;
        if ($request->has('banner_image')) {

            $banner_image = Commonhelper::uploadFileWithThumbnail($request, 'banner_image', $this->path, $thumbnailPath = NULL, $resizeH = 300, $resizeW = 1920, $cmspage->banner_image);
            $cmspage->banner_image = $banner_image;
        }
        if ($request->has('image')) {
            $image = Commonhelper::uploadFileWithThumbnail($request, 'image', $this->path, $thumbnailPath = NULL, $resizeH = 560, $resizeW = 690, $cmspage->image);
            $cmspage->image = $image;
        }
        $cmspage->save();
        return redirect()->route('admin.cmspage', $cmspage->slug)->with('success', __('messages.update_message', ['title' => 'CMS Page']));
    }
    public function sizeGuide($request, $id)
    {

        $cmspage  = sizeGuide::find($id);
        $cmspage->status  = $request->status;
        $cmspage->page_title  = $request->page_title;
        $cmspage->rings_title  = $request->rings_title;
        $cmspage->rings_content1  = $request->rings_content1;
        $cmspage->rings_content2  = $request->rings_content2;


        $cmspage->bracelets_title  = $request->bracelets_title;
        $cmspage->bracelets_content1  = $request->bracelets_content1;
        $cmspage->bracelets_content2  = $request->bracelets_content2;

        $cmspage->necklaces_content  = $request->necklaces_content;



        $cmspage->meta_title  = $request->meta_title;
        $cmspage->meta_keywords  = $request->meta_keywords;
        $cmspage->meta_description  = $request->meta_description;

        if ($request->has('banner_image')) {
            $banner_image = Commonhelper::uploadFileWithThumbnail($request, 'banner_image', $this->path, $thumbnailPath = NULL, $resizeH = 300, $resizeW = 1920, $cmspage->banner_image);
            $cmspage->banner_image = $banner_image;
        }

        if ($request->has('measurement_image')) {
            $measurement_image = Commonhelper::uploadFileWithThumbnail($request, 'measurement_image', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $cmspage->measurement_image);
            $cmspage->measurement_image = $measurement_image;
        }
        if ($request->has('diamond_skeleton_image')) {
            $diamond_skeleton_image = Commonhelper::uploadFileWithThumbnail($request, 'diamond_skeleton_image', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $cmspage->diamond_skeleton_image);
            $cmspage->diamond_skeleton_image = $diamond_skeleton_image;
        }
        if ($request->has('step1_image')) {
            $step1_image = Commonhelper::uploadFileWithThumbnail($request, 'step1_image', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $cmspage->step1_image);
            $cmspage->step1_image = $step1_image;
        }
        if ($request->has('step2_image')) {
            $step2_image = Commonhelper::uploadFileWithThumbnail($request, 'step2_image', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $cmspage->step2_image);
            $cmspage->step2_image = $step2_image;
        }

        if ($request->has('diameter_skeleton_image')) {
            $diameter_skeleton_image = Commonhelper::uploadFileWithThumbnail($request, 'diameter_skeleton_image', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $cmspage->diameter_skeleton_image);
            $cmspage->diameter_skeleton_image = $diameter_skeleton_image;
        }

        if ($request->has('bracelets_image')) {
            $bracelets_image = Commonhelper::uploadFileWithThumbnail($request, 'bracelets_image', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $cmspage->bracelets_image);
            $cmspage->bracelets_image = $bracelets_image;
        }

        if ($request->has('necklaces_image')) {
            $necklaces_image = Commonhelper::uploadFileWithThumbnail($request, 'necklaces_image', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $cmspage->necklaces_image);
            $cmspage->necklaces_image = $necklaces_image;
        }

        /*Add Rings*/
        foreach ($request->action as $key => $value) {
            if ($value != '') {
                $image = '';
                if ($request->action[$key] == 'update') {
                    $sizeguideimage  = sizeGuideImage::find($key);
                } else {
                    $sizeguideimage = new sizeGuideImage();
                }
                $sizeguideimage->product_url  = $request->product_url[$key];
                $sizeguideimage->category_type  = 'rings';
                if (isset($request->file('rings')[$key])) {
                    $image = Commonhelper::uploadFile1($request->file('rings')[$key], $this->path, $thumbnailPath = NULL, $resizeH = 800, $resizeW = 600, true);
                    $sizeguideimage->image  = $image;
                }
                $sizeguideimage->save();
            }
        }

        /*Add >Bracelets*/
        foreach ($request->bracelet_action as $key => $value) {
            if ($value != '') {
                $image = '';
                if ($request->bracelet_action[$key] == 'update') {
                    $sizeguideimage  = sizeGuideImage::find($key);
                } else {
                    $sizeguideimage = new sizeGuideImage();
                }
                $sizeguideimage->category_type  = 'bracelets';

                if (isset($request->file('bracelets')[$key])) {

                    $image = Commonhelper::uploadFile1($request->file('bracelets')[$key], $this->path, $thumbnailPath = NULL, $resizeH = 800, $resizeW = 600, true);
                    $sizeguideimage->image  = $image;
                    $sizeguideimage->save();
                }
            }
        }

        /*Add >necklaces*/
        foreach ($request->necklace_action as $key => $value) {
            if ($value != '') {
                $image = '';
                if ($request->necklace_action[$key] == 'update') {
                    $sizeguideimage  = sizeGuideImage::find($key);
                } else {
                    $sizeguideimage = new sizeGuideImage();
                }
                $sizeguideimage->category_type  = 'necklaces';

                if (isset($request->file('necklaces')[$key])) {

                    $image = Commonhelper::uploadFile1($request->file('necklaces')[$key], $this->path, $thumbnailPath = NULL, $resizeH = 800, $resizeW = 600, true);
                    $sizeguideimage->image  = $image;
                    $sizeguideimage->save();
                }
            }
        }
        $cmspage->save();
    }
    public function ourTeam($request, $id)
    {

        $cmspage  = ourTeam::find($id);
        $cmspage->status  = $request->status;
        $cmspage->title  = $request->title;
        $cmspage->member1_name  = $request->member1_name;
        $cmspage->member1_info  = $request->member1_info;
        $cmspage->member2_name  = $request->member2_name;
        $cmspage->member2_info  = $request->member2_info;
        $cmspage->team_title  = $request->team_title;
        $cmspage->milestone_title  = $request->milestone_title;
        $cmspage->meta_title  = $request->meta_title;
        $cmspage->meta_keywords  = $request->meta_keywords;
        $cmspage->meta_description  = $request->meta_description;

        if ($request->has('member1_image')) {
            $member1_image = Commonhelper::uploadFileWithThumbnail($request, 'member1_image', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $cmspage->member1_image);
            $cmspage->member1_image = $member1_image;
        }
        if ($request->has('member2_image')) {
            $member2_image = Commonhelper::uploadFileWithThumbnail($request, 'member2_image', $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, $cmspage->member2_image);
            $cmspage->member2_image = $member2_image;
        }
        $cmspage->save();

        /*Add Team*/
        //dd($request->file('images'));
        foreach ($request->designation as $key => $value) {
            if ($value != '') {
                $image = '';
                if ($request->action[$key] == 'update') {
                    $teamdata  = Team::find($key);
                } else {
                    $teamdata = new Team();
                }
                $teamdata->designation  = $request->designation[$key];
                $teamdata->content  = $request->content[$key];
                if (isset($request->file('images')[$key])) {
                    $image = Commonhelper::uploadFile1($request->file('images')[$key], $this->path, $thumbnailPath = NULL, $resizeH = 444, $resizeW = 523, true);
                    $teamdata->image  = $image;
                }
                $teamdata->save();
            }
        }

        /*Add Milestone*/
        //dd($request->file('images'));
        foreach ($request->milestoneaction as $key => $value) {
            $milestoneimages = '';
            $milestoneicons = '';
            if ($value == 'update') {
                $milestone  = Milestone::find($key);
            } else {
                $milestone = new Milestone();
            }
            $milestone->year  = $request->milestoneyear[$key];
            $milestone->content  = $request->milestonecontent[$key];
            if (isset($request->file('milestoneimages')[$key])) {
                $milestoneimages = Commonhelper::uploadFile1($request->file('milestoneimages')[$key], $this->path, $thumbnailPath = NULL, $resizeH = 831, $resizeW = 256, true);
                $milestone->image  = $milestoneimages;
            }
            if (isset($request->file('milestoneicons')[$key])) {
                $milestoneicons = Commonhelper::uploadFile1($request->file('milestoneicons')[$key], $this->path, $thumbnailPath = NULL, $resizeH = 83, $resizeW = 83, true);
                $milestone->icon  = $milestoneicons;
            }
            $milestone->save();
        }
        return true;
    }
    public function bonica5bs3($request, $id)
    {
        $cmspage  = Bonica5bs3::find($id);
        /*  $cmspage->name  = $request->name; */
        $cmspage->status  = $request->status;
        $cmspage->title  = $request->title;
        $cmspage->title_1  = $request->title_1;
        $cmspage->title_2  = $request->title_2;
        $cmspage->title_3  = $request->title_3;
        $cmspage->title_4  = $request->title_4;
        $cmspage->title_5  = $request->title_5;
        $cmspage->content_1  = $request->content_1;
        $cmspage->content_2  = $request->content_2;
        $cmspage->content_3  = $request->content_3;
        $cmspage->content_4  = $request->content_4;
        $cmspage->content_5  = $request->content_5;
        $cmspage->meta_title  = $request->meta_title;
        $cmspage->meta_keywords  = $request->meta_keywords;
        $cmspage->meta_description  = $request->meta_description;

        if ($request->has('banner_image')) {
            $banner_image = Commonhelper::uploadFileWithThumbnail($request, 'banner_image', $this->path, $thumbnailPath = NULL, $resizeH = 300, $resizeW = 1920, $cmspage->banner_image);
            $cmspage->banner_image = $banner_image;
        }
        if ($request->has('big_image')) {
            $big_image = Commonhelper::uploadFileWithThumbnail($request, 'big_image', $this->path, $thumbnailPath = NULL, $resizeH = 819, $resizeW = 746, $cmspage->big_image);
            $cmspage->big_image = $big_image;
        }

        if ($request->has('image_1')) {
            $image_1 = Commonhelper::uploadFileWithThumbnail($request, 'image_1', $this->path, $thumbnailPath = NULL, $resizeH = 150, $resizeW = 150, $cmspage->image_1);
            $cmspage->image_1 = $image_1;
        }
        if ($request->has('image_2')) {
            $image_2 = Commonhelper::uploadFileWithThumbnail($request, 'image_2', $this->path, $thumbnailPath = NULL, $resizeH = 150, $resizeW = 150, $cmspage->image_2);
            $cmspage->image_2 = $image_2;
        }
        if ($request->has('image_3')) {
            $image_3 = Commonhelper::uploadFileWithThumbnail($request, 'image_3', $this->path, $thumbnailPath = NULL, $resizeH = 150, $resizeW = 150, $cmspage->image_3);
            $cmspage->image_3 = $image_3;
        }
        if ($request->has('image_4')) {
            $image_4 = Commonhelper::uploadFileWithThumbnail($request, 'image_4', $this->path, $thumbnailPath = NULL, $resizeH = 150, $resizeW = 150, $cmspage->image_4);
            $cmspage->image_4 = $image_4;
        }
        if ($request->has('image_5')) {
            $image_5 = Commonhelper::uploadFileWithThumbnail($request, 'image_5', $this->path, $thumbnailPath = NULL, $resizeH = 150, $resizeW = 150, $cmspage->image_5);
            $cmspage->image_5 = $image_5;
        }

        $cmspage->save();
        return true;
    }
    public function sustainablity($request, $id)
    {

        $cmspage  = Sustainablity::find($id);
        /*  $cmspage->name  = $request->name; */
        $cmspage->status  = $request->status;
        $cmspage->sustainability_title  = $request->sustainability_title;
        $cmspage->sustainability_sub_title  = $request->sustainability_sub_title;
        $cmspage->sustainability_content  = $request->sustainability_content;
        $cmspage->mining_free_process_title  = $request->mining_free_process_title;
        $cmspage->mining_free_process_content  = $request->mining_free_process_content;
        $cmspage->mining_free_title  = $request->mining_free_title;
        $cmspage->mining_free_sub_title  = $request->mining_free_sub_title;
        $cmspage->meta_title  = $request->meta_title;
        $cmspage->meta_keywords  = $request->meta_keywords;
        $cmspage->meta_description  = $request->meta_description;

        if ($request->has('banner_image')) {
            $banner_image = Commonhelper::uploadFileWithThumbnail($request, 'banner_image', $this->path, $thumbnailPath = NULL, $resizeH = 300, $resizeW = 1920, $cmspage->banner_image);
            $cmspage->banner_image = $banner_image;
        }

        if ($request->has('sustainability_image')) {
            $sustainability_image = Commonhelper::uploadFileWithThumbnail($request, 'sustainability_image', $this->path, $thumbnailPath = NULL, $resizeH = 670, $resizeW = 588, $cmspage->sustainability_image);
            $cmspage->sustainability_image = $sustainability_image;
        }
        if ($request->has('mining_free_process_image')) {
            $mining_free_process_image = Commonhelper::uploadFileWithThumbnail($request, 'mining_free_process_image', $this->path, $thumbnailPath = NULL, $resizeH = 670, $resizeW = 588, $cmspage->mining_free_process_image);
            $cmspage->mining_free_process_image = $mining_free_process_image;
        }
        if ($request->has('mining_free_image_1')) {
            $mining_free_image_1 = Commonhelper::uploadFileWithThumbnail($request, 'mining_free_image_1', $this->path, $thumbnailPath = NULL, $resizeH = 398, $resizeW = 732, $cmspage->mining_free_image_1);
            $cmspage->mining_free_image_1 = $mining_free_image_1;
        }
        if ($request->has('mining_free_image_2')) {
            $mining_free_image_2 = Commonhelper::uploadFileWithThumbnail($request, 'mining_free_image_2', $this->path, $thumbnailPath = NULL, $resizeH = 398, $resizeW = 732, $cmspage->mining_free_image_2);
            $cmspage->mining_free_image_2 = $mining_free_image_2;
        }
        if ($request->has('mining_free_image_3')) {
            $mining_free_image_3 = Commonhelper::uploadFileWithThumbnail($request, 'mining_free_image_3', $this->path, $thumbnailPath = NULL, $resizeH = 398, $resizeW = 732, $cmspage->mining_free_image_3);
            $cmspage->mining_free_image_3 = $mining_free_image_3;
        }

        $cmspage->save();
        return true;
    }

    public function ourStory($request, $id)
    {

        $cmspage  = OurStory::find($id);
        $big_diamond_image = $cmspage->big_diamond_image;
        $big_diamond_video = $cmspage->big_diamond_video;

        /* $cmspage->name  = $request->name; */
        $cmspage->status  = $request->status;

        $cmspage->our_vision_content  = $request->our_vision_content; //$this->base64ImageUpload($request->our_vision_content);
        $cmspage->our_mission_content  = $request->our_mission_content; //$this->base64ImageUpload($request->our_mission_content);
        $cmspage->why_bonica_title  = $request->why_bonica_title;
        $cmspage->why_bonica_sub_title  = $request->why_bonica_sub_title;
        $cmspage->why_bonica_authentic_title  = $request->why_bonica_authentic_title;
        $cmspage->why_bonica_authentic_description  = $request->why_bonica_authentic_description;
        $cmspage->why_bonica_economical_title  = $request->why_bonica_economical_title;
        $cmspage->why_bonica_economical_description  = $request->why_bonica_economical_description;
        $cmspage->why_bonica_protector_title  = $request->why_bonica_protector_title;
        $cmspage->why_bonica_protector_description  = $request->why_bonica_protector_description;
        $cmspage->why_bonica_maestros_title  = $request->why_bonica_maestros_title;
        $cmspage->why_bonica_maestros_description  = $request->why_bonica_maestros_description;
        $cmspage->our_commitment_title  = $request->our_commitment_title;
        $cmspage->our_commitment_first_description  = $request->our_commitment_first_description;
        $cmspage->our_commitment_second_description  = $request->our_commitment_second_description;
        $cmspage->our_commitment_third_description  = $request->our_commitment_third_description;
        $cmspage->making_bonica_title  = $request->making_bonica_title;
        $cmspage->making_bonica_sub_title  = $request->making_bonica_sub_title;
        $cmspage->making_bonica_diamond_seed_title  = $request->making_bonica_diamond_seed_title;
        $cmspage->making_bonica_diamond_seed_description  =  $this->base64ImageUpload($request->making_bonica_diamond_seed_description);
        $cmspage->making_bonica_plasma_title  = $request->making_bonica_plasma_title;
        $cmspage->making_bonica_plasma_description  = $this->base64ImageUpload($request->making_bonica_plasma_description);
        $cmspage->making_bonica_heating_title  = $request->making_bonica_heating_title;
        $cmspage->making_bonica_heating_description  = $this->base64ImageUpload($request->making_bonica_heating_description);
        $cmspage->making_bonica_all_diamonds_title  = $request->making_bonica_all_diamonds_title;
        $cmspage->making_bonica_all_diamonds_description  = $this->base64ImageUpload($request->making_bonica_all_diamonds_description);
        $cmspage->meta_title  = $request->meta_title;
        $cmspage->meta_keywords  = $request->meta_keywords;
        $cmspage->meta_description  = $request->meta_description;

        if ($request->has('banner_image')) {
            $banner_image = Commonhelper::uploadFileWithThumbnail($request, 'banner_image', $this->path, $thumbnailPath = NULL, $resizeH = 300, $resizeW = 1920, $cmspage->banner_image);
            $cmspage->banner_image = $banner_image;
        }
        if ($request->has('our_vision_image')) {

            $our_vision_image = Commonhelper::uploadFileWithThumbnail($request, 'our_vision_image', $this->path, $thumbnailPath = NULL, $resizeH = 670, $resizeW = 588, $cmspage->our_vision_image);
            $cmspage->our_vision_image = $our_vision_image;
        }
        if ($request->has('our_mission_image')) {
            $our_mission_image = Commonhelper::uploadFileWithThumbnail($request, 'our_mission_image', $this->path, $thumbnailPath = NULL, $resizeH = 670, $resizeW = 588, $cmspage->our_mission_image);
            $cmspage->our_mission_image = $our_mission_image;
        }
        if ($request->has('big_diamond_image')) {

            if($big_diamond_image){
                $exploded = explode('/', $big_diamond_image);
                $big_diamond_image = end($exploded);
                if (Storage::disk('s3')->exists('images/'.$big_diamond_image)) {
                    Storage::disk('s3')->delete('images/'.$big_diamond_image);
                }
            }
            if($big_diamond_video){
                $exploded = explode('/', $big_diamond_video);
                $big_diamond_video = end($exploded);
                if (Storage::disk('s3')->exists('images/'.$big_diamond_video)) {
                    Storage::disk('s3')->delete('images/'.$big_diamond_video);
                }
            }

            $video = Commonhelper::compressImageVideo('video', $request->file('big_diamond_image'), $this->path, 800);

            $cmspage->big_diamond_image = $video['imagePath'];
            $cmspage->big_diamond_video = $video['videoPath'];
        }
        if ($request->has('why_bonica_image')) {
            $why_bonica_image = Commonhelper::uploadFileWithThumbnail($request, 'why_bonica_image', $this->path, $thumbnailPath = NULL, $resizeH = 680, $resizeW = 455, $cmspage->why_bonica_image);
            $cmspage->why_bonica_image = $why_bonica_image;
        }
        if ($request->has('our_commitment_first_icon')) {
            $our_commitment_first_icon = Commonhelper::uploadFileWithThumbnail($request, 'our_commitment_first_icon', $this->path, $thumbnailPath = NULL, $resizeH = 105, $resizeW = 105, $cmspage->our_commitment_first_icon);
            $cmspage->our_commitment_first_icon = $our_commitment_first_icon;
        }
        if ($request->has('our_commitment_second_icon')) {
            $our_commitment_second_icon = Commonhelper::uploadFileWithThumbnail($request, 'our_commitment_second_icon', $this->path, $thumbnailPath = NULL, $resizeH = 105, $resizeW = 105, $cmspage->our_commitment_second_icon);
            $cmspage->our_commitment_second_icon = $our_commitment_second_icon;
        }
        if ($request->has('our_commitment_third_icon')) {
            $our_commitment_third_icon = Commonhelper::uploadFileWithThumbnail($request, 'our_commitment_third_icon', $this->path, $thumbnailPath = NULL, $resizeH = 105, $resizeW = 105, $cmspage->our_commitment_third_icon);
            $cmspage->our_commitment_third_icon = $our_commitment_third_icon;
        }
        if ($request->has('making_bonica_diamond_seed_icon')) {
            $making_bonica_diamond_seed_icon = Commonhelper::uploadFileWithThumbnail($request, 'making_bonica_diamond_seed_icon', $this->path, $thumbnailPath = NULL, $resizeH = 140, $resizeW = 90, $cmspage->making_bonica_diamond_seed_icon);
            $cmspage->making_bonica_diamond_seed_icon = $making_bonica_diamond_seed_icon;
        }

        if ($request->has('making_bonica_heating_icon')) {
            $making_bonica_heating_icon = Commonhelper::uploadFileWithThumbnail($request, 'making_bonica_heating_icon', $this->path, $thumbnailPath = NULL, $resizeH = 140, $resizeW = 90, $cmspage->making_bonica_heating_icon);
            $cmspage->making_bonica_heating_icon = $making_bonica_heating_icon;
        }
        if ($request->has('making_bonica_plasma_icon')) {
            $making_bonica_plasma_icon = Commonhelper::uploadFileWithThumbnail($request, 'making_bonica_plasma_icon', $this->path, $thumbnailPath = NULL, $resizeH = 140, $resizeW = 90, $cmspage->making_bonica_plasma_icon);
            $cmspage->making_bonica_plasma_icon = $making_bonica_plasma_icon;
        }
        if ($request->has('making_bonica_all_diamonds_icon')) {
            $making_bonica_all_diamonds_icon = Commonhelper::uploadFileWithThumbnail($request, 'making_bonica_all_diamonds_icon', $this->path, $thumbnailPath = NULL, $resizeH = 140, $resizeW = 90, $cmspage->making_bonica_all_diamonds_icon);
            $cmspage->making_bonica_all_diamonds_icon = $making_bonica_all_diamonds_icon;
        }
        $cmspage->save();
        return true;
    }
    public function base64ImageUpload($content)
    {
        if ($content) {
            $content = mb_convert_encoding($content, "HTML-ENTITIES", 'UTF-8');
            $dom = new \DomDocument();
            @$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $imageFile = $dom->getElementsByTagName('img');

            foreach ($imageFile as $item => $image) {

                $data = $image->getAttribute('src');
                $base64Image = explode(";base64,", $data);
                if (isset($base64Image[1])) {
                    list($type, $data) = explode(';', $data);

                    $extention = explode('/', $type);
                    list(, $data)      = explode(',', $data);

                    $imgeData = base64_decode($data);
                    $image_name = "/" . $this->path . time() . $item . '.' . $extention[1];
                    $path = public_path() . $image_name;
                    file_put_contents($path, $imgeData);

                    $image->removeAttribute('src');
                    $image->setAttribute('src', $image_name);
                }
            }
            $content = $dom->saveHTML();
            return $content;
        }
    }
    public function deleteTeam(Request $request)
    {
        $id =  $request->id;
        $team = Team::select('image')->where('id', $id)->first();
        if (file_exists(public_path($this->path . $team->image))) {
            Commonhelper::deleteFile(public_path($this->path . $team->image));
        }
        Team::where('id', $id)->delete();
        return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'Team Member']), 'msg' => 'delete']);
    }
    public function deleteSizeGuideImage(Request $request)
    {
        $id =  $request->id;
        $sizeguideimage = sizeGuideImage::select('image')->where('id', $id)->first();
        if (file_exists(public_path($this->path . $sizeguideimage->image))) {
            Commonhelper::deleteFile(public_path($this->path . $sizeguideimage->image));
        }
        sizeGuideImage::where('id', $id)->delete();
        return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'Size Guide Image']), 'msg' => 'delete']);
    }
    public function deleteMilestone(Request $request)
    {
        $id =  $request->id;
        $milestone = Milestone::where('id', $id)->first();
        if (file_exists(public_path($this->path . $milestone->image))) {
            Commonhelper::deleteFile(public_path($this->path . $milestone->image));
        }
        if (file_exists(public_path($this->path . $milestone->icon))) {
            Commonhelper::deleteFile(public_path($this->path . $milestone->icon));
        }
        Milestone::where('id', $id)->delete();
        return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'Milestone']), 'msg' => 'delete']);
    }
    /**
     * Remove the specified resource from storage.
     * @author Hitesh Khandar
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = CmsPage::find($id);
        $user->delete();
        return response()->json(['code' => 200, 'message' => __('messages.delete_message', ['title' => 'CMS Page']), 'data' => array()]);
    }
    public function updateStatus(Request $request)
    {
        $metalStatus = CmsPage::where('id', request('id'))->first();

        if ($metalStatus->status == 1) {
            $dataUpdate = array(
                "status" => 0
            );
            $statusMessage = "Inactive";
            CmsPage::where('id', request('id'))->update($dataUpdate);
        } else {

            $dataUpdate = array(
                "status" => 1
            );
            $statusMessage = "Active";
            CmsPage::where('id', request('id'))->update($dataUpdate);
        }

        //return response(['status' => 200, "msg" => $this->module ." has been $statusMessage successfully."]);
        return response(['status' => 200, "msg" =>  __('messages.status_message', ['title' => $this->module, 'status_type' => $statusMessage])]);
        //return redirect()->route($this->moduleViewName . '.index')->with('success', __('messages.create_message', ['title' => 'carrier']));
    }
}
