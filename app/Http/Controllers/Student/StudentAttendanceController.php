<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ClassName;
use App\Model\Year;
use App\Model\StudentAttendance;
use DB;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceController extends Controller
{
    public function batchSelectionFormForAttendanceAdd(){
    	$classes = ClassName::where('status','=',1)->get();
    	$years = Year::where('status','=',1)->get();
        return view('admin.student.attendance.batch-selection-form-for-attendance-add', [
            'classes'=>$classes,
            'years'=>$years
        ]);
    }

    public function batchWiseStudentListForAttendance(Request $request){
        $today = date('Y-m-d');
        $checkAttendance = StudentAttendance::where([
            'class_id'=>$request->class_id,
            'type_id'=>$request->type_id,
            'batch_id'=>$request->batch_id,
        ])->whereDate('created_at', $today)->get();

        if (count($checkAttendance)>0) {
            return view('admin.student.attendance.attendance-error');
        }else{
            $students = DB::table('students')
        ->join('schools','students.school_id','=','schools.id')
        ->join('student_type_details','student_type_details.student_id','=','students.id')
        ->join('batches','student_type_details.batch_id','=','batches.id')
        ->select('students.*','schools.school_name','student_type_details.roll_no','batches.batch_name')
        ->where([
            'students.status'=>1,
            'students.class_id'=>$request->class_id,
            'student_type_details.type_id'=>$request->type_id,
            'student_type_details.batch_id'=>$request->batch_id,
            'student_type_details.type_status'=>1
        ])->orderBy('student_type_details.roll_no','ASC')->get();

        return view('admin.student.attendance.student-list-for-attendance-add', [
            'students'=>$students
        ]);
        }

    }

    public function saveStudentAttendance(Request $request){
    	$today = date('Y-m-d');
        $checkAttendance = StudentAttendance::where([
            'class_id'=>$request->class_id,
            'type_id'=>$request->type_id,
            'batch_id'=>$request->batch_id,
        ])->whereDate('created_at', $today)->get();

        if (count($checkAttendance)>0) {
             return back()->with('error_message', 'Attendance Already Submitted !!!');
        }else{
            $this->saveAttendance($request);
            return back()->with('message', 'Attendance Submitted Successfully.');
        }
    }

    protected function saveAttendance($request){
        $session = $request->academic_session;
        $classId = $request->class_id;
        $typeId = $request->type_id;
        $batchId = $request->batch_id;
        $attendances = $request->attendance;
        $userId = Auth::user()->id;

        foreach ($attendances as $studentId => $attendance) {
            $data = new StudentAttendance();
            $data->academic_session = $session;
            $data->class_id = $classId;
            $data->type_id = $typeId;
            $data->batch_id = $batchId;
            $data->student_id = $studentId;
            $data->attendance = $attendance;
            $data->user_id = $userId;
            $data->save();
        }
    }

    public function viewAttendance(){
        $classes = ClassName::where('status','=',1)->get();
        return view('admin.student.attendance.batch-selection-form-for-attendance-view', [
            'classes'=>$classes
        ]);
    }

    public function batchWiseStudentAttendanceView(Request $request){
        $date = $request->date;
        $check = $this->attendanceCheck($request, $date);
        if (count($check)>0) {
         $attendances = $this->getAttendance($request, $date);
        
        return view('admin.student.attendance.batch-wise-attendance', [
            'attendances'=>$attendances
        ]);
    }else{
        $error_message = 'Attendance does not submitted yet...!!!';
            return view('admin.student.attendance.alert', [
                'error_message'=>$error_message
            ]);
    }
    }

    public function editAttendance(){
         $classes = ClassName::where('status','=',1)->get();
        return view('admin.student.attendance.batch-selection-form-for-attendance-edit', [
            'classes'=>$classes
        ]);
    }

    public function studentListForAttendanceEdit(Request $request){
        $date = date('Y-m-d');
        $check = $this->attendanceCheck($request, $date);
        if (count($check)>0) {
           $attendances = $this->getAttendance($request, $date);
        
        return view('admin.student.attendance.attendance-update-form', [
            'attendances'=>$attendances
        ]);
        }else{
            $error_message = 'Attendance does not submitted yet...!!!';
            return view('admin.student.attendance.alert', [
                'error_message'=>$error_message
            ]);
        }
         
    }

    public function studentAttendanceUpdate(Request $request){
        $attendances = $request->attendance;

        foreach ($attendances as $id => $attendance) {
            $data = StudentAttendance::find($id);
            $data->attendance = $attendance;
            $data->save();
        }

        return back()->with('message', 'Attendance updated successfully.');
    }

    protected function attendanceCheck($request, $date){
         $check = StudentAttendance::where([
             'class_id'=>$request->class_id,
            'type_id'=>$request->type_id,
            'batch_id'=>$request->batch_id,
        ])->whereDate('created_at', $date)->get();

         return $check;
    }

    protected function getAttendance($request, $date){
         $attendances = DB::table('student_attendances')
        ->join('students','student_attendances.student_id','=','students.id')
        ->join('schools','students.school_id','=','schools.id')
        ->join('student_type_details','student_type_details.student_id','=','students.id')
        ->select('student_attendances.*','students.student_name','students.sms_mobile','schools.school_name','student_type_details.roll_no')
        ->where([
            'student_attendances.class_id'=>$request->class_id,
            'student_attendances.type_id'=>$request->type_id,
            'student_attendances.batch_id'=>$request->batch_id,
            'student_type_details.type_id'=>$request->type_id,
        ])->whereDate('student_attendances.created_at', $date)->orderBy('student_type_details.roll_no','ASC')->get();

        return $attendances;
    }
}
