<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;
use App\Models\Testimonial;
use App\Models\Sustainablity;
use App\Models\Bonica5bs3;
use App\Models\ourTeam;
use App\Models\Team;
use App\Models\Milestone;
use Carbon\Carbon;
use App\Models\OurStory;
use App\Models\sizeGuide;
use App\Models\sizeGuideImage;



class CMSPageController extends Controller
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

	}
    public function index(Request $request)
    {
       $data = array();
       $teams = array();
       $milestones = array();
       $testimonial = array();

       $sizeGuideImage = array();
       $sizeGuideImage['rings'] = array();
       $sizeGuideImage['bracelets'] = array();
       $sizeGuideImage['necklaces'] = array();
        if($request->segment(2)){

            if($request->segment(2) == 'our-story'){
                $data['page'] = OurStory::where('slug',$request->segment(2))->Active()->first();
                $testimonial = Testimonial::Active()->get();
            }
            else if($request->segment(2) == 'sustainablity'){
                $data['page'] = Sustainablity::where('slug',$request->segment(2))->Active()->first();
            }
            else if($request->segment(2) == 'bonica5bs3'){
                $data['page'] = Bonica5bs3::where('slug',$request->segment(2))->Active()->first();
            }
            else if($request->segment(2) == 'our-team'){
                $data['page'] = ourTeam::where('slug',$request->segment(2))->Active()->first();
                $teams = Team::get();
                $milestones = Milestone::orderBy('year', 'ASC')->get();
            }
            else if($request->segment(2) == 'size-guide'){

                $data['page']  = sizeGuide::where('slug',$request->segment(2))->Active()->first();
                $sizeGuideImageData = sizeGuideImage::get();
                if(count($sizeGuideImageData) > 0){
                    foreach($sizeGuideImageData as $guideImage){
                        if($guideImage->category_type == 'rings'){
                            $sizeGuideImage['rings'][] = array('image' => $guideImage->image,'product_url' => $guideImage->product_url);
                        }
                        if($guideImage->category_type == 'bracelets'){
                            $sizeGuideImage['bracelets'][] = $guideImage->image;
                        }
                        if($guideImage->category_type == 'necklaces'){
                            $sizeGuideImage['necklaces'][] = $guideImage->image;
                        }
                    }
                }
            }
            else{
                $data['page'] = CmsPage::where('slug',$request->segment(2))->Active()->first();
            }
            if(!empty($data['page'])){
                $data['page']['testimonials'] = $testimonial;
                $data['page']['teams'] = $teams;
                $data['page']['milestones'] = $milestones;

                $data['page']['rings'] = $sizeGuideImage['rings'];
                $data['page']['bracelets'] = $sizeGuideImage['bracelets'];
                $data['page']['necklaces'] = $sizeGuideImage['necklaces'];

                return view('frontend.pages.'.$request->segment(2),$data);
            }
        }
        return view('frontend.404');
    }
}
