<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Discussions;
use File;

class DiscussionsController extends Controller
{

    public function index()
    {
        $discussions = Discussions::paginate(20);
        return view('backend.discussions.discussion',compact('discussions'));                                                               
    }
    public function approved(request $request)
    {
        $form = Discussions::find($request->id);
        $form->approved = 1;
        $form->save();
        return back()->with('success','Approved!');
    }

    public function delete(request $request)

    {
        $id = ($request->id);
        $form = Discussions::find($id)->delete();
        return back();
    }
}
