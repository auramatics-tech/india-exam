<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Blog;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $announcements = Announcement::orderby('sort','asc')->get();
        
        return view('backend.announcements.index', compact('announcements'));
    }

    public function add_edit($announcement_id='',Request $request)
    {
        $announcement = "";
        if($announcement_id)
        {
            $announcement = Announcement::find($announcement_id);
        }
        // $blogs = array();
        $blogs = Blog::where('active',1)->orderby('id','desc')->get();
        return view('backend.announcements.add_edit', compact('announcement','blogs'));                                                               
    }

    public function announcement_save(Request $request)
    {
        
        $this->validate($request,[
            'blog_id' => 'required',
         ]);
        if($request->id)
        {
            $announcement = Announcement::find($request->id);
        }
        else
        {
            $announcement = new Announcement;
        }
        $announcement->blog_id = $request->blog_id;
        $announcement->title = $request->title;
        $announcement->save();
        return redirect()->route('admin.announcements')->with('success','Announcement add or edit successfully'); 
    }

    public function active_update(Request $request)
    {
        $announcement = Announcement::find($request->announcement_id);
        if($request->status == 1){
            $announcement->active = 1;
        }else{
            $announcement->active = 0;
        }
        $announcement->save();
        return response('success','Data Updated successfully!');
    }

    public function delete($announcement_id)
    {
        Announcement::where('id',$announcement_id)->delete();
        return redirect()->route('admin.announcements')->with('success','Announcement deleted successfully'); 
    }

    
    public function announcement_drag_drop(Request $request)
    {
        $data = $request->page_id_array;
        if (count($data)) {
            foreach ($data as $key => $category) {
                $cat =  Announcement::find($category);
                $cat->sort = $key + 1;
                $cat->save();
            }
        }
        return response()->json(['status' => 1]);
    }

}