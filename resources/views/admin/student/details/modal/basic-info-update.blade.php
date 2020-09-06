
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="studentBasicInfoUpdate" tabindex="-1" aria-labelledby="studentBasicInfoUpdateTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="studentBasicInfoUpdateTitle">Student's Basic Info update Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{ route('student-basic-info-update') }}" method="POST" id="studentBasicInfoUpdate" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
        
        <div class="form-group row">
            <label for="studentName" class="col-form-label col-sm-3 text-right">Student Name</label>
            <div class="col-sm-9">
               <input type="text" name="student_name" class="form-control" placeholder="Student Name" value="{{ $students[0]->student_name }}" id="studentName" required>
               <span class="text-danger"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="school" class="col-form-label col-sm-3 text-right">School Name</label>
            <div class="col-sm-9">
               <select name="school_id" class="form-control" id="school" required>
                 <option value="">Select School</option>
                 @foreach($schools as $school)
                 <option value="{{ $school->id }}" {{ $students[0]->school_id == $school->id ? 'selected' : '' }}>{{ $school->school_name }}</option>
                 @endforeach
               </select>
               <span class="text-danger"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="fatherName" class="col-form-label col-sm-3 text-right">Father's Name</label>
            <div class="col-sm-9">
               <input type="text" name="father_name" class="form-control" placeholder="Father's Name" value="{{ $students[0]->father_name }}" id="fatherName" required>
               <span class="text-danger"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="fatherMobile" class="col-form-label col-sm-3 text-right">Father's Mobile</label>
            <div class="col-sm-9">
               <input type="text" name="father_mobile" class="form-control" placeholder="Father's Mobile" value="{{ $students[0]->father_mobile }}" id="fatherMobile" required>
               <span class="text-danger"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="fatherProfession" class="col-form-label col-sm-3 text-right">Father's Profession</label>
            <div class="col-sm-9">
               <input type="text" name="father_profession" class="form-control" placeholder="Father's Profession" value="{{ $students[0]->father_profession }}" id="fatherProfession" required>
               <span class="text-danger"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="motherName" class="col-form-label col-sm-3 text-right">Mother's Name</label>
            <div class="col-sm-9">
               <input type="text" name="mother_name" class="form-control" placeholder="Mother's Name" value="{{ $students[0]->mother_name }}" id="motherName" required>
               <span class="text-danger"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="motherMobile" class="col-form-label col-sm-3 text-right">Mother's Mobile</label>
            <div class="col-sm-9">
               <input type="text" name="mother_mobile" class="form-control" placeholder="Mother's Mobile" value="{{ $students[0]->mother_mobile }}" id="motherMobile" required>
               <span class="text-danger"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="motherProfession" class="col-form-label col-sm-3 text-right">Mother's Profession</label>
            <div class="col-sm-9">
               <input type="text" name="mother_profession" class="form-control" placeholder="Mother's Profession" value="{{ $students[0]->mother_profession }}" id="motherProfession" required>
               <span class="text-danger"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="emailAddress" class="col-form-label col-sm-3 text-right">Email Address</label>
            <div class="col-sm-9">
               <input type="text" name="email_address" class="form-control" placeholder="Email Address" value="{{ $students[0]->email_address }}" id="emailAddress" required>
               <span class="text-danger"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="smsMobile" class="col-form-label col-sm-3 text-right">SMS Mobile</label>
            <div class="col-sm-9">
               <input type="text" name="sms_mobile" class="form-control" placeholder="SMS Mobile" value="{{ $students[0]->sms_mobile }}" id="smsMobile" required>
               <span class="text-danger"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-form-label col-sm-3 text-right"></label>
            <div class="col-sm-9">
               <img class="shadow d-block img-thumbnail" src="@if(isset($students[0]->student_photo)) {{ asset($students[0]->student_photo) }} @else {{ asset('public/admin/assets/images/avatar.png') }} @endif" id="studentPhoto" alt="Profile Photo" style="width: 200px; height: 200px;">
               <span class="text-danger"></span>
            </div>
        </div>

        {{-- <div class="form-group row">
            <label for="" class="col-form-label col-sm-3 text-right"></label>
            <div class="col-sm-9">
               <img class="shadow d-block img-thumbnail" src="@if(isset($students[0]->student_photo)) {{ asset('') }}/public/admin/assets/students/{{ $students[0]->student_photo }} @else {{ asset('public/admin/assets/images/avatar.png') }} @endif" id="studentPhoto" alt="Profile Photo" style="width: 200px; height: 200px;">
               <span class="text-danger"></span>
            </div>
        </div> --}}

        <div class="form-group row">
            <label for="photo" class="col-form-label col-sm-3 text-right">Student Photo</label>
            <div class="col-sm-9">
               <input type="file" name="student_photo" class="form-control" placeholder="Student Name" value="" id="photo" onchange="showImage(this, 'studentPhoto')">
               <span class="text-danger"></span>
            </div>
        </div>


        <div class="form-group row">
            <label for="address" class="col-form-label col-sm-3 text-right">Address</label>
            <div class="col-sm-9">
               <input type="text" name="address" class="form-control" placeholder="Details Address" value="{{ $students[0]->address }}" id="address" required>
               <span class="text-danger"></span>
            </div>
        </div>
        <input type="hidden" name="student_id" value="{{ $students[0]->id }}">
      </div>     
        <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="update">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>