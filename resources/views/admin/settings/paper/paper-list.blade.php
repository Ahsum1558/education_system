@extends('admin.master')
@section('main-content')
<!--Content Start-->
<section class="container-fluid">
<div class="row content">
    <div class="col-md-12 pl-0 pr-0">

        @include('admin.includes.alert')

        <div class="form-group">
            <div class="col-sm-12">
                <h4 class="text-center font-weight-bold font-italic mt-3">Exam Wise Paper List</h4>
            </div>
        </div>
         <div class="table-responsive p-1">
            <table id="" class="table table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group row mb-0">
                            <label for="classId" class="col-form-label col-sm-4 text-right">Class Name</label>
                            <div class="col-sm-8">
                                <select name="class_id" class="form-control @error('class_id') is-invalid @enderror" id="classId" required autofocus>
                                    <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                @endforeach
                                </select>
                                @error('class_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                          </div>
                            <div class="col-md">
                                <div class="form-group row mb-0">
                                <label for="typeId" class="col-form-label col-sm-4 text-right">Course</label>
                                <div class="col-sm-8">
                                    <select name="type_id" class="form-control @error('type_id') is-invalid @enderror" id="typeId" required>
                                        <option value="">Select Coures</option>
                                    </select>
                                    @error('type_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                                </div>
                                <div class="col-md">
                                <div class="form-group row mb-0">
                                <label for="examId" class="col-form-label col-sm-4 text-right">Exam</label>
                                <div class="col-sm-8">
                                <select name="exam_id" class="form-control @error('exam_id') is-invalid @enderror" id="examId" required>
                                    <option value="">Select Exam</option>
                                </select>
                                @error('exam_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            </div>
                                </div>
                        </div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div class="table-responsive" id="paperList">
        </div>
    </div>
</div>
</section>
<!--Content End-->

@include('admin.includes.loader')
<style>#overlay .loader{display: none;} </style>
<script>
     $('#classId').change(function() {
        var classId = $(this).val();
        if(classId){
            $('#overlay .loader').show();
            $.get("{{ route('class-wise-student-type') }}", {class_id:classId}, function(data){
                $('#overlay .loader').hide();
                console.log(data);
                $('#typeId').empty().html(data);
            });
        }else{
            $('#typeId').empty().html('<option value="">Select Type</option>');
        }
    });

    $('#typeId').change(function() {
        var classId = $('#classId').val();
        var typeId = $(this).val();
        if(classId && typeId){
            $('#overlay .loader').show();
            $.get("{{ route('course-wise-exam-list') }}", {class_id:classId, type_id:typeId}, function(data){
                $('#overlay .loader').hide();
                console.log(data);
                $('#examId').empty().html(data);
            });
        }else{
            $('#examId').empty().html('<option value="">Select Exam</option>');
        }
    });

    $('#examId').change(function() {
        var classId = $('#classId').val();
        var typeId = $('#typeId').val();
        var examId = $(this).val();
        if(classId && typeId && examId){
            $('#overlay .loader').show();
            $.get("{{ route('exam-wise-paper-list') }}", {class_id:classId, type_id:typeId, exam_id:examId}, function(data){
                $('#overlay .loader').hide();
                console.log(data);
                $('#paperList').empty().html(data);
            });
        }else{
            $('#paperList').empty();
        }
    });

    function examDeactivate(classId, typeId, examId){
        $('#overlay .loader').show();
        $.get("{{ route('exam-deactivate') }}", {
            class_id:classId,
            type_id:typeId,
            exam_id:examId,
        }, function(data){
             $('#overlay .loader').hide();
                // console.log(data);
                $("#examList").empty().html(data);
        });
     };

     function examActivate(classId, typeId, examId){
        $('#overlay .loader').show();
        $.get("{{ route('exam-activate') }}", {
            class_id:classId,
            type_id:typeId,
            exam_id:examId,
        }, function(data){
             $('#overlay .loader').hide();
                // console.log(data);
                $("#examList").empty().html(data);
        });
     }
</script>

@endsection
