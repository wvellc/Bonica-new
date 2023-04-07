<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use DB;
use Illuminate\Support\Str;
use Auth;
class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->modelObj	= new Blog();
        $this->path = "uploads/blog/";
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function blogs(Request $request)
    {
        $data = array();
        $data['blogCategory']  = BlogCategory::with('blogs')->Active()->get();
        $data['blogs'] = Blog::with('category')->orderByDesc("id")->Active()->paginate(4);
        //dd($data['blogs']);
        return view('frontend.blogs',$data);
    }
    public function categoryBlog(Request $request)
    {
        $data = array();
        $category = BlogCategory::select('id','name')->where('slug',$request->segment(2))->first();
        $data['category_name'] = $category->name;
        $data['blogs'] = Blog::where('category_id',$category->id)->with('category')->orderByDesc("id")->Active()->paginate(4);
        return view('frontend.blogs',$data);
    }

    public function blogDetail(Request $request)
    {
        $data = array();
        if($request->segment(3)){
            $data['blog'] = Blog::with('category','admin')->where('slug',$request->segment(3))->Active()->first();

            /*Checked Content Has a Image*/
            /* $dom = new \DomDocument();
            @$dom->loadHtml($data['blog']['content'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $dom->getElementsByTagName('img');
            $data['blog_has_image'] = $imageFile->length; */
            /*END Checked Content Has a Image*/

            if(!empty($data['blog'])){
                return view('frontend.blog-detail',$data);
            }
        }
        return view('frontend.404');
    }
}
