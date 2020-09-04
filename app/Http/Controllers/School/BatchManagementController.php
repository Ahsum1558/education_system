<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ClassName;
use App\Model\Batch;
use App\Model\StudentType;

class BatchManagementController extends Controller
{
    public function addBatchForm(){
    	$classes = ClassName::all();
    	return view('admin.settings.batch.add-batch-form', [
    		'classes'=>$classes
    	]);
    }

    public function batchSave(Request $request){
    	$this->validate($request, [
            'class_id'=>'required',
    		'type_id'=>'required',
    		'batch_name'=>'required|string',
    		'student_capacity'=>'required',
    		
    	]);

    	$data = new Batch();
        $data->class_id = $request->class_id;
    	$data->student_type_id = $request->type_id;
    	$data->batch_name = $request->batch_name;
    	$data->student_capacity = $request->student_capacity;
    	$data->status = 1;
    	$data->save();

    	return back()->with('message', 'Batch name added successfully');
    }

    public function classWiseStudentType(Request $request){
        $types = StudentType::where([
            'class_id'=>$request->class_id
        ])->where('status','!=',3)->get();
        return view('admin.settings.batch.class-wise-student-type', ['types'=>$types]);
    }

    public function batchList(){
    	$classes = ClassName::all();
    	return view('admin.settings.batch.batch-list', [
    		'classes'=>$classes
    	]);
    }

    public function batchListByAjax(Request $request){
    	$batches = Batch::where([
            'class_id'=>$request->class_id,
            'student_type_id'=>$request->type_id,
        ])->where('status','!=',3)->get();

    	if (count($batches)>0) {
    		return view('admin.settings.batch.batch-list-by-ajax', [
    		'batches'=>$batches
    	]);
    	}else{
    		return view('admin.settings.batch.batch-empty-error');
    	}
    }

    public function batchUnpublished(Request $request){
    	$batch = Batch::find($request->batch_id);
    	$batch->status = 2;
    	$batch->save();

    	$batches = Batch::where(['class_id'=>$request->class_id])->get();

    	return view('admin.settings.batch.batch-list-by-ajax', [
    		'batches'=>$batches
    	]);
    }

    public function batchPublished(Request $request){
    	$batch = Batch::find($request->batch_id);
    	$batch->status = 1;
    	$batch->save();

    	$batches = Batch::where(['class_id'=>$request->class_id])->get();

    	return view('admin.settings.batch.batch-list-by-ajax', [
    		'batches'=>$batches
    	]);
    }

    public function batchEdit($id){
    	$batch = Batch::find($id);
    	$classes = ClassName::all();
    	return view('admin.settings.batch.batch-edit-form', [
    		'classes'=>$classes,
    		'batch'=>$batch
    	]);
    }

    public function batchUpdate(Request $request){
    	$this->validate($request, [
    		'class_id'=>'required',
    		'batch_name'=>'required|string',
    		'student_capacity'=>'required',
    	]);
    	$batch = Batch::find($request->batch_id);
    	$batch->class_id = $request->class_id;
    	$batch->batch_name = $request->batch_name;
    	$batch->student_capacity = $request->student_capacity;
    	$batch->save();

    	return redirect('/batch/list')->with('message', 'Batch info updated successfully');
    }

    public function batchDelete(Request $request){
    	$batch = Batch::find($request->batch_id);
    	$batch->delete();

    	$batches = Batch::where(['class_id'=>$request->class_id])->get();

    	if (count($batches)>0) {
    		return view('admin.settings.batch.batch-list-by-ajax', [
    		'batches'=>$batches
    	]);
    	}else{
    		return view('admin.settings.batch.batch-empty-error');
    	}
    }
}
