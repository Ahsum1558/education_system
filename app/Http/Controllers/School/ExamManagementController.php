<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ClassName;
use App\Model\Exam;

class ExamManagementController extends Controller
{
    public function addExamForm(){
    	$classes = ClassName::where('status','=',1)->get();
    	return view('admin.settings.exam.exam-add-form', [
    		'classes'=>$classes
    	]);
    }

    public function addExam(Request $request){
    	if ($request->post()) {
    		$data = new Exam();
            $data->class_id = $request->class_id;
            $data->type_id = $request->type_id;
            $data->exam_name = $request->exam_name;
            $data->result_type = $request->result_type;
            $data->status = 1;
            $data->save();

            return back()->with('message', 'Exam added successfully');
    	}
    }

    public function examList(){
        $classes = ClassName::where('status','=',1)->get();
        return view('admin.settings.exam.exam-list', [
            'classes'=>$classes
        ]);
    }

    public function examListByAjax(Request $request){
        if ($request->ajax()) {
            $exams = Exam::where([
                'class_id'=>$request->class_id,
                'type_id'=>$request->type_id,
            ])->get();

             return view('admin.settings.exam.exam-table', [
            'exams'=>$exams
        ]);
        }
    }

    public function examDeactivate(Request $request){
        if ($request->ajax()){
            $exam = Exam::find($request->exam_id);
            $exam->status = 2;
            $exam->save();

            return $this->examListByAjax($request);
        }
    }

    public function examActivate(Request $request){
        if ($request->ajax()){
            $exam = Exam::find($request->exam_id);
            $exam->status = 1;
            $exam->save();

            return $this->examListByAjax($request);
        }
    }
}
