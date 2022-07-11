<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogLink;

class BlogController extends Controller
{

    public function index(Request $request)
    {
        $blogs = Blog::when(request('q'), function ($query) use ($request) {
            return $query->where('title', 'like', '%'.$request->q.'%');
        })->orderby('id','desc')->get();
        return view('backend.blogs.index', compact('blogs'));                                                               
    }

    public function add_edit($blog_id='',Request $request)
    {
        $blog = "";
        if($blog_id)
        {
            $blog = Blog::find($blog_id);
        }
        return view('backend.blogs.add_edit', compact('blog'));                                                               
    }

    public function blog_save(Request $request)
    {
        
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'thumbnail_description' => 'required',
            'blog_pdf' => 'max:10000|mimes:doc,docx,pdf',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
         ]);
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
        if(isset($request->link_title))
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
}
