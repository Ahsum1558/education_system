<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\School;
use DB;

class SchoolManagementController extends Controller
{
    public function addSchoolForm(){
    	return view('admin.settings.school.add-form');
    }

    public function schoolSave(Request $request){
    	$this->validate($request, [
    		'school_name'=>'required|string'
    	]);

    	$data = new School();
    	$data->school_name = $request->school_name;
    	$data->status = 1;
    	$data->save();

    	return back()->with('message', 'School name added successfully');
    }

    public function schoolList(){
    	$schools = School::all();

    	return view('admin.settings.school.school-list', ['schools'=>$schools]);
    }

    public function schoolUnpublished($id){
    	$school = School::find($id);
    	$school->status = 2;
    	$school->save();

    	return redirect('/school/list')->with('error_message', 'School name unpublished successfully');
    }

    public function schoolPublished($id){
    	$school = School::find($id);
    	$school->status = 1;
    	$school->save();

    	return redirect('/school/list')->with('message', 'School name published successfully');
    }

    public function schoolEditForm($id){
    	$school = School::find($id);

    	return view('admin.settings.school.edit-form', ['school'=>$school]);
    }

    public function schoolUpdate(Request $request){
    	$this->validate($request, [
    		'school_name'=>'required|string'
    	]);

    	$school = School::find($request->school_id);
    	$school->school_name = $request->school_name;
    	$school->save();

    	return redirect('/school/list')->with('message', 'School name updated successfully');
    }

    public function schoolDelete($id){
    	$school = School::find($id);
    	$school->delete();

    	return redirect('/school/list')->with('error_message', 'School name deleted successfully');
    }
}
