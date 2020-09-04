<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentType;
use App\Model\ClassName;
Use DB;

class StudentTypeController extends Controller
{
    public function index(){
    	$studentTypes = $this->getStudentType();
    	$classes = ClassName::all();
    	return view('admin.settings.student-type.student-type-list', [
    		'studentTypes'=>$studentTypes,
    		'classes'=>$classes
    	]);
    }

    public function studentTypeAdd(Request $request){
    	if ($request->ajax()) {
    		$data = new StudentType();
    		$data->class_id = $request->class_id;
    		$data->student_type = $request->student_type;
    		$data->status = 1;
    		$data->save();
    	}
    }

    public function studentTypeList(){
    	$studentTypes = $this->getStudentType();
    	$classes = ClassName::all();
    	return view('admin.settings.student-type.student-type-table', [
    		'studentTypes'=>$studentTypes,
    		'classes'=>$classes
    	]);
    }

    public function studentTypeUnpublish(Request $request){
        $data = StudentType::find($request->type_id);
        $data->status = 2;
        $data->save();

        $studentTypes = $this->getStudentType();
        $classes = ClassName::all();
        return view('admin.settings.student-type.student-type-table', [
            'studentTypes'=>$studentTypes,
            'classes'=>$classes
        ]);
    }

    public function studentTypePublish(Request $request){
        $data = StudentType::find($request->type_id);
        $data->status = 1;
        $data->save();

        $studentTypes = $this->getStudentType();
        $classes = ClassName::all();
        return view('admin.settings.student-type.student-type-table', [
            'studentTypes'=>$studentTypes,
            'classes'=>$classes
        ]);
    }

     public function studentTypeUpdate(Request $request){
        $data = StudentType::find($request->type_id);
        $data->student_type = $request->student_type;
        $data->save();

        $studentTypes = $this->getStudentType();
        $classes = ClassName::all();
        return view('admin.settings.student-type.student-type-table', [
            'studentTypes'=>$studentTypes,
            'classes'=>$classes
        ]);
     }

     public function studentTypeDelete(Request $request){
        $data = StudentType::find($request->type_id);
        $data->status = 3;
        $data->save();

        $studentTypes = $this->getStudentType();
        $classes = ClassName::all();
        return view('admin.settings.student-type.student-type-table', [
            'studentTypes'=>$studentTypes,
            'classes'=>$classes
        ]);
     }

    protected function getStudentType(){
        $studentTypes = DB::table('student_types')
        ->join('class_names','student_types.class_id','=','class_names.id')
        ->select('student_types.*','class_names.class_name')
        ->where('student_types.status','!=',3)
        ->get();

        return $studentTypes;
    }

}
