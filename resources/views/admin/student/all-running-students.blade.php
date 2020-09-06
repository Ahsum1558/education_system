@extends('admin.master')

@section('main-content')

<!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-12 pl-0 pr-0">

             @include('admin.includes.alert')

            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">All Running Student List</h4>
                </div>
            </div>

            <div class="table-responsive p-1">
                <table id="example" class="table table-striped table-bordered dt-responsive text-center" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>School</th>
                        <th>Father's Name</th>
                        <th>Father's Mobile</th>
                        <th>Mother's Name</th>
                        <th>Mother's Mobile</th>
                        <th>SMS Mobile</th>
                        <th>Student ID</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $student->student_name }}</td>
                        <td>{{ $student->class_name }}</td>
                        <td>{{ $student->school_name }}</td>
                        <td>{{ $student->father_name }}</td>
                        <td>{{ $student->father_mobile }}</td>
                        <td>{{ $student->mother_name }}</td>
                        <td>{{ $student->mother_mobile }}</td>
                        <td>{{ $student->sms_mobile }}</td>
                        <td>{{ $student->id }}</td>
                        
                        
                        {{-- <td><img src="{{ asset('/') }}{{ $slide->slide_image }}" style="width: 150px;" alt="Slide Image"></td> --}}
                        
                        <td>
                            <a href="{{ route('student-details',['id'=>$student->id]) }}" class="btn btn-sm btn-dark" target="_blank"><i class="fa fa-eye" title="Details"></i></a>
                            <a href="" class="btn btn-sm btn-info fa fa-edit" title="Edit"></a>
                            <a href="" onclick="return confirm('Are you sure !')" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--Content End-->

@endsection