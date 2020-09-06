<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\School;
use App\Model\ClassName;
use App\Model\StudentType;
use App\Model\Batch;
use App\Model\Student;
use App\Model\StudentTypeDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Image;
use DB;

class StudentController extends Controller
{
    public function studentRegistrationForm(){
    	$schools = School::where('status','=',1)->get();
    	$classes = ClassName::where('status','=',1)->get();
    	return view('admin.student.registration.student-registration-form', [
    		'schools'=>$schools,
    		'classes'=>$classes
    	]);
    }

    public function bringStudentType(Request $request){
    	$types = StudentType::where('class_id','=',$request->class_id)->where('status','=',1)->get();
    	$classes = ClassName::where('status','=',1)->get();
    	return view('admin.student.registration.student-types', [
    		'types'=>$types,
    		'classes'=>$classes,
    		'data'=>$request
    	]);
    }

    public function batchRollForm(Request $request){
    	$batches = Batch::where([
    		'class_id'=>$request->class_id,
    		'student_type_id'=>$request->type_id
    	])->get();
    	$type = StudentType::find($request->type_id);
    	return view('admin.student.registration.batch-roll-form', [
    		'batches'=>$batches,
    		'type'=>$type,
    ]);
    }

    public function studentSave(Request $request){
        $student = new Student();

        // if ( $request -> hasFile('student_photo') ) {
        //     $img = $request -> file('student_photo');
        //     $unique_file_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();
        //     $img -> move(public_path('admin/assets/students/') , $unique_file_name);
        // }

        $file = $request->file('student_photo');
         $imageName = $file->getClientOriginalName();
         $directory = 'public/admin/assets/students/';
         $imageUrl = $directory.$imageName;
         Image::make($file)->resize(300, 300)->save($imageUrl);
         $student->student_photo = $imageUrl;

        $student->student_name          = $request->student_name;
        $student->school_id             = $request->school_id;
        $student->class_id              = $request->class_id;
        $student->father_name           = $request->father_name;
        $student->father_mobile         = $request->father_mobile;
        $student->father_profession     = $request->father_profession;
        $student->mother_name           = $request->mother_name;
        $student->mother_mobile         = $request->mother_mobile;
        $student->mother_profession     = $request->mother_profession;
        $student->email_address         = $request->email_address;
        $student->sms_mobile            = $request->sms_mobile;
        $student->date_of_admission     = $request->date_of_admission;
        // $student->student_photo         = $unique_file_name;
        $student->address               = $request->address;
        $student->status                = 1;
        $student->password              = $request->sms_mobile;
        $student->encrypted_password    = Hash::make($request->sms_mobile);
        $student->user_id               = Auth::user()->id;
        $student->save();


        

                

        $studentId = $student->id;
        $batches = $request->batch_id;
        $rolls = $request->roll;

        $studentTypes = $request->student_type;
        foreach($studentTypes as $key => $studentType){
            $data = new StudentTypeDetails();
            $data->student_id = $studentId;
            $data->class_id = $request->class_id;
            $data->type_id = $key;
            $data->batch_id = $batches[$key];
            $data->roll_no = $rolls[$key];
            $data->type_status = 1;
            $data->save();
        }
        return back()->with('message', 'Registration Successful');
    }

    public function allRunningStudentLsit(){
        $students = DB::table('students')
        ->join('schools','students.school_id','=','schools.id')
        ->join('class_names','students.class_id','=','class_names.id')
        ->select('students.*','schools.school_name','class_names.class_name')
        ->where([
            'students.status'=>1
        ])->orderBy('students.class_id','ASC')->get();
        return view('admin.student.all-running-students', ['students'=>$students]);
    }

    public function classSelectionForm(){
        $classes = ClassName::where('status','=',1)->get();
        return view('admin.student.class.class-selection-form', [
            'classes'=>$classes
        ]);
    }

    public function classWiseStudentType(Request $request){
        $classId = $request->class_id;
        $types = StudentType::where([
            'class_id'=>$classId,
            'status'=>1
        ])->get();
        return view('admin.student.class.student-type', [
            'types'=>$types
        ]);
    }

    public function classAndTypeWiseStudent(Request $request){
        $students = DB::table('students')
        ->join('schools','students.school_id','=','schools.id')
        ->join('student_type_details','student_type_details.student_id','=','students.id')
        // ->join('student_types','student_type_details.student_type_id','=','student_types.id')
        ->join('batches','student_type_details.batch_id','=','batches.id')
        ->select('students.*','schools.school_name','student_type_details.roll_no','batches.batch_name')
        ->where([
            'students.status'=>1,
            'students.class_id'=>$request->class_id,
            'student_type_details.type_id'=>$request->type_id,
            'student_type_details.type_status'=>1
        ])->orderBy('student_type_details.roll_no','ASC')->get();

        return view('admin.student.class.student-list', [
            'students'=>$students
        ]);
    }

    public function studentDetails($id){
        $students = $this->getSingleStundent($id);
        $schools = School::all(); 

        return view('admin.student.details.profile', [
            'students'=>$students,
            'schools'=>$schools
        ]);
       
    }

    public function studentBasicInfoUpdate(Request $request){
        $student = Student::find($request->student_id);
        $student->student_name      = $request->student_name;
        $student->school_id         = $request->school_id;
        $student->father_name       = $request->father_name;
        $student->father_mobile     = $request->father_mobile;
        $student->father_profession = $request->father_profession;
        $student->mother_name       = $request->mother_name;
        $student->mother_mobile     = $request->mother_mobile;
        $student->mother_profession = $request->mother_profession;
        $student->email_address     = $request->email_address;
        $student->sms_mobile        = $request->sms_mobile;
        if (isset($request->student_photo)) {
            $this->updateStudentPhoto($request);
        }
        $student->address           = $request->address;
        $student->password          = $request->sms_mobile;
        $student->save();

        return $this->studentDetails($request->student_id);
    }

    protected function getSingleStundent($id){
         $students = DB::table('students')
        ->join('schools','students.school_id','=','schools.id')
        ->join('class_names','students.class_id','=','class_names.id')
        ->join('student_type_details','student_type_details.student_id','=','students.id')
        ->join('student_types','student_type_details.type_id','=','student_types.id')
        ->join('batches','student_type_details.batch_id','=','batches.id')
        ->select('students.*','schools.school_name','student_type_details.roll_no','batches.batch_name','class_names.class_name','student_types.student_type')
        ->where([
            'students.status'=>1,
            'students.id'=>$id,
            
        ])->orderBy('student_type_details.type_id','ASC')->get();
         return $students;
    }

    protected function updateStudentPhoto($request){
        $student = Student::find($request->student_id);
        if (isset($student->student_photo)) {
           unlink($student->student_photo);
           $this->uploadPhoto($request, $student);
        }else{
            $this->uploadPhoto($request, $student);
        }
    }

    protected function uploadPhoto($request, $student){
        $file = $request->file('student_photo');
         $imageName = $file->getClientOriginalName();
         $directory = 'public/admin/assets/students/';
         $imageUrl = $directory.$imageName;
         Image::make($file)->resize(300, 300)->save($imageUrl);
         $student->student_photo = $imageUrl;
         $student->save();
    }
}
