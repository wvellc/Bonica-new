<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FAQRequest;
use App\Models\Faq;
use App\Models\CategoryFaq;

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

	}

    public function getAllFaq()
    {
        $data = array();
        $data['topics'] = CategoryFaq::with('topics')->get();

        /* if(!empty($data['topics'])){
            $allFAQ = array();
            foreach($data['topics'] as $key => $topics){

                if(count($topics->topics) > 0){
                    foreach($topics->topics as $faq){
                        $allFAQ[] = array('topic_slug' => $topics->slug, 'question' => $faq->question, 'answer' => $faq->answer);
                    }
                }
            }
            //dd($allFAQ);
            $data['allFAQ'] = $allFAQ;
        } */
		return view('frontend.faq',$data);
    }
    public function searchFAQ(Request $request)
    {
        $search_faq_html = '';
        if($request->search_faq){

            $search_faq = Faq::where("question", 'LIKE', '%'.$request->search_faq.'%')->get();
            if(count($search_faq) > 0){
                $count = 1;
                foreach($search_faq as $faq){
                    //$allFAQ[] = array('topic_slug' => $topics->slug, 'question' => $faq->question, 'answer' => $faq->answer);
                    $cls_show = ($count == 1) ? 'show' : '';
                    $search_faq_html .= '<div class="item">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="'.$faq->id.'">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-'.$faq->id.'" aria-expanded="false" aria-controls="accordion-'.$faq->id.'">
                                    '.$faq->question.'
                                </button>
                            </h2>
                            <div id="accordion-'.$faq->id.'" class="accordion-collapse collapse '.$cls_show.' " aria-labelledby="{{$faq->id}}" data-bs-parent="#accordionHoldersearch">
                                <div class="accordion-body">
                                    '.$faq->answer.'
                                </div>
                            </div>
                        </div>
                    </div>';
                    $count++;
                }
            }
        }
        return response(['status' => 200, "search_faq_html" => $search_faq_html]);
    }
}
