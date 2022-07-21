<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogLink;
use App\Models\States;
use App\Models\BlogCategory;

class BlogController extends Controller
{

    public function index(Request $request)
    {
        $blogs = Blog::when(request('q'), function ($query) use ($request) {
            return $query->where('title', 'like', '%'.$request->q.'%');
        })->orderby('sort','asc')->paginate(10);
        return view('backend.blogs.index', compact('blogs'));                                                               
    }

    public function add_edit($blog_id='',Request $request)
    {
        $blog = "";
        if($blog_id)
        {
            $blog = Blog::find($blog_id);
        }
        $states= States::all();
        
        $blog_categories = BlogCategory::get();
        return view('backend.blogs.add_edit', compact('blog','states','blog_categories'));                                                               
    }

    public function blog_save(Request $request)
    {
        if($request->id){
            $this->validate($request,[
                'title' => 'required',
                'slug' => 'required',
                'thumbnail_description' => 'required',
             ]);
        }else{
            $this->validate($request,[
                'title' => 'required',
                'thumbnail_description' => 'required',
                'slug' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
             ]);
        }
        
       
        if($request->id)
        {
            $blog = Blog::find($request->id);
        }
        else
        {
            $blog = new Blog;
        }
        $blog->title = isset($request->title)?$request->title:'';
        $blog->thumbnail_description = isset($request->thumbnail_description)?$request->thumbnail_description:'';
        $blog->description = isset($request->description)?$request->description:'';
        $blog->state = isset($request->state)?$request->state:'';
        $blog->slug = isset($request->slug)?$request->slug:'';
        $blog->blog_cat_id = isset($request->blog_cat_id)?$request->blog_cat_id:'';
        if($request->hasFile('blog_pdf'))
        {
            $pdfName = time().'.'.$request->blog_pdf->getClientOriginalExtension();
            $request->blog_pdf->move(public_path('/blog/pdf'), $pdfName);
            $blog->blog_pdf = $pdfName;
        }
        if($request->hasFile('image'))
        {
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/blog/images'), $imageName);
            $blog->image = $imageName;
        }
        $blog->save();
        BlogLink::where('blog_id',$blog->id)->delete();
        if(isset($request->link_title[0]) && $request->link_title[0] != '' && count($request->link_title))
        {
            foreach($request->link_title as $key => $link_title)
            {
                $blog_links = new BlogLink;
                $blog_links->blog_id = $blog->id;
                $blog_links->title = isset($link_title)?$link_title:'';
                $blog_links->link = isset($request->link[$key])?$request->link[$key]:'';
                $blog_links->save();
            }
        }
        return redirect()->route('admin.blogs')->with('success',' Blog add or edit successfully'); 
    }

    public function active_update(Request $request)
    {
        $blog = Blog::find($request->blog_id);
        if($request->status == 1){
            $blog->active = 1;
        }else{
            $blog->active = 0;
        }
        $blog->save();
        return response('success','Data Updated successfully!');
    }

    public function delete($blog_id)
    {
        Blog::where('id',$blog_id)->delete();
        BlogLink::where('blog_id',$blog_id)->delete();
        return redirect()->route('admin.blogs')->with('success','Blog deleted successfully'); 
    }
    public function delete_blog_img($blog_id){
        // echo "here";die;
        $blog = Blog::find($blog_id);
        $blog->image = Null;
        $blog->save();
        return redirect()->route('admin.blogs.add_edit',$blog->id)->with('success','Blog deleted successfully'); 

    }
    public function blog_category_list(Request $request)
    {
        $blog_categories = BlogCategory::when(request('q'), function ($query) use ($request) {
            return $query->where('name', 'like', '%'.$request->q.'%');
        })->orderby('id','desc')->get();
        
        return view('backend.blogs.categories.list', compact('blog_categories'));
    }

    public function blog_category_add_edit($blog_category_id='',Request $request)
    {
        $blog_category = "";
        if($blog_category_id)
        {
            $blog_category = BlogCategory::find($blog_category_id);
        }
        return view('backend.blogs.categories.add_edit', compact('blog_category'));                                                               
    }

    public function blog_category_save(Request $request)
    {
        
        $this->validate($request,[
            'name' => 'required',
         ]);
        if($request->id)
        {
            $blog_category = BlogCategory::find($request->id);
        }
        else
        {
            $blog_category = new BlogCategory;
        }
        $blog_category->name = $request->name;
        $blog_category->save();
        return redirect()->route('admin.blog_category_list')->with('success','Blog Category add or edit successfully'); 
    }

    public function blog_category_delete($blog_category_id)
    {
        BlogCategory::where('id',$blog_category_id)->delete();
        return redirect()->route('admin.blog_category_list')->with('success','Blog Category deleted successfully'); 
    }

    
    public function blog_drag_drop(Request $request)
    {
        $data = $request->page_id_array;
        if (count($data)) {
            foreach ($data as $key => $category) {
                $cat =  Blog::find($category);
                $cat->sort = $key + 1;
                $cat->save();
            }
        }
        return response()->json(['status' => 1]);
    }
}
