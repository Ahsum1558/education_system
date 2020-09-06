@extends('admin.master')

@section('main-content')

<!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-12 pl-0 pr-0">

             @include('admin.includes.alert')

            <div class="form-group">
                {{-- <div class="col-sm-12">
                   
                </div> --}}
                <div class="row ml-0 mr-0">
                    <div class="col-md-3">
                         <h4 class="text-center font-weight-bold font-italic mt-3 mb-3">Profile Of {{ $students[0]->student_name }}</h4>
                        @if(isset($students[0]->student_photo))
                       {{--  <img class="shadow d-block m-auto img-thumbnail" src="{{ asset('') }}/public/admin/assets/students/{{ $students[0]->student_photo }}" alt="Profile Picture" style="border-radius: 50%; height: 200px; width: 200px; border: 2px solid #fff;"> --}}
                        <img class="shadow d-block m-auto img-thumbnail" src="{{ asset($students[0]->student_photo) }}" alt="Profile Picture" style="border-radius: 50%; height: 200px; width: 200px; border: 2px solid #fff;">
                        @else
                         <img class="shadow d-block m-auto img-thumbnail" src="{{ asset('public/admin/assets/images/avatar.png') }}" alt="Profile Picture" style="border-radius: 50%; border: 2px solid #fff; height: 200px; width: 200px;">
                        @endif
                        <hr>
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <button data-toggle="modal" data-target="#studentBasicInfoUpdate" class="btn btn-block my-btn-submit">Edit Profile</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-9">
                    @include('admin.student.details.basic-info')

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Content End-->

{{-- Modal --}}
@include('admin.student.details.modal.basic-info-update')

@endsection