<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ImportantDate;

class ImportantDateController extends Controller
{
    public function index(Request $request)
    {
        $important_dates = ImportantDate::when(request('q'), function ($query) use ($request) {
            return $query->where('text', 'like', '%'.$request->q.'%');
        })->orderby('id','desc')->get();
        return view('backend.important_dates.index', compact('important_dates'));
    }

    public function add_edit($important_date_id='',Request $request)
    {
        $important_date = "";
        if($important_date_id)
        {
            $important_date = ImportantDate::find($important_date_id);
        }
        return view('backend.important_dates.add_edit', compact('important_date'));                                                               
    }

    public function important_date_save(Request $request)
    {
        
        $this->validate($request,[
            'text' => 'required',
         ]);
        if($request->id)
        {
            $important_date = ImportantDate::find($request->id);
        }
        else
        {
            $important_date = new ImportantDate;
        }
        $important_date->text = isset($request->text)?$request->text:'';
        $important_date->save();
        return redirect()->route('admin.important_dates')->with('success','Important Date add or edit successfully'); 
    }

    public function active_update(Request $request)
    {
        $important_date = ImportantDate::find($request->important_date_id);
        if($request->status == 1){
            $important_date->active = 1;
        }else{
            $important_date->active = 0;
        }
        $important_date->save();
        return response('success','Data Updated successfully!');
    }

    public function delete($important_date_id)
    {
        ImportantDate::where('id',$important_date_id)->delete();
        return redirect()->route('admin.important_dates')->with('success','Important Date deleted successfully'); 
    }
}