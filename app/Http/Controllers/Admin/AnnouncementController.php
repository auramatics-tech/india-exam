<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $announcements = Announcement::when(request('q'), function ($query) use ($request) {
            return $query->where('text', 'like', '%'.$request->q.'%');
        })->orderby('id','desc')->get();
        return view('backend.announcements.index', compact('announcements'));
    }

    public function add_edit($announcement_id='',Request $request)
    {
        $announcement = "";
        if($announcement_id)
        {
            $announcement = Announcement::find($announcement_id);
        }
        return view('backend.announcements.add_edit', compact('announcement'));                                                               
    }

    public function announcement_save(Request $request)
    {
        
        $this->validate($request,[
            'text' => 'required',
         ]);
        if($request->id)
        {
            $announcement = Announcement::find($request->id);
        }
        else
        {
            $announcement = new Announcement;
        }
        $announcement->text = isset($request->text)?$request->text:'';
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
}