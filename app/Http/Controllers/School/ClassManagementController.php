<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ClassName;

class ClassManagementController extends Controller
{
    public function addClassForm(){
    	return view('admin.settings.class.add-class-form');
    }

    public function classSave(Request $request){
    	$this->validate($request, [
    		'class_name'=>'required|string'
    	]);

    	$data = new ClassName();
    	$data->class_name = $request->class_name;
    	$data->status = 1;
    	$data->save();

    	return back()->with('message', 'Class name added successfully');
    }

    public function classList(){
    	$classes = ClassName::all();

    	return view('admin.settings.class.class-list', ['classes'=>$classes]);
    }

    public function classUnpublished($id){
    	$class = ClassName::find($id);
    	$class->status = 2;
    	$class->save();

    	return redirect('/class/list')->with('error_message', 'Class name unpublished successfully');
    }

    public function classPublished($id){
    	$class = ClassName::find($id);
    	$class->status = 1;
    	$class->save();

    	return redirect('/class/list')->with('message', 'Class name published successfully');
    }

    public function classEditForm($id){
    	$class = ClassName::find($id);

    	return view('admin.settings.class.class-edit-form', ['class'=>$class]);
    }

    public function classUpdate(Request $request){
    	$this->validate($request, [
    		'class_name'=>'required|string'
    	]);

    	$class = ClassName::find($request->class_id);
    	$class->class_name = $request->class_name;
    	$class->save();

    	return redirect('/class/list')->with('message', 'Class name updated successfully');
    }

    public function classDelete($id){
    	$class = ClassName::find($id);
    	$class->delete();

    	return redirect('/class/list')->with('error_message', 'Class name deleted successfully');
    }
}
