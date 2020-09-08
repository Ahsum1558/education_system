@extends('admin.master')
@section('main-content')
<!--Content Start-->
<section class="container-fluid">
<div class="row content">
    <div class="col-md-8 offset-md-2 pl-0 pr-0">

    @include('admin.includes.alert')

    <div class="form-group">
        <div class="col-sm-12">
            <h4 class="text-center font-weight-bold font-italic mt-3">Paper Add Form</h4>
        </div>
    </div>

    <form action="{{ route('add-paper') }}" method="POST">
        @csrf
        <div class="table-responsive p-1">
            <table id="" class="table table-bordered dt-responsive nowrap text-center" style="width: 100%;">

                 <tr>
                    <td>
                        <div class="form-group row mb-0">
                            <label for="classId" class="col-form-label col-sm-3 text-right">Class Name</label>
                            <div class="col-sm-9">
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
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="form-group row mb-0">
                            <label for="typeId" class="col-form-label col-sm-3 text-right">Course</label>
                            <div class="col-sm-9">
                                <select name="type_id" class="form-control @error('type_id') is-invalid @enderror" id="typeId" required>
                                    <option value="">Select Course</option>
                                </select>
                                @error('type_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <div class="form-group row mb-0">
                            <label for="examId" class="col-form-label col-sm-3 text-right">Exam</label>
                            <div class="col-sm-9">
                                <select name="exam_id" class="form-control @error('exam_id') is-invalid @enderror" id="examId" required>
                                    <option value="">Select Exam</option>
                                </select>
                                @error('exam_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </td>
                </tr>
                 <tr>
                    <td>
                        <div class="form-group row mb-0">
                            <label for="paperName" class="col-form-label col-sm-3 text-right">Paper Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('paper_name') is-invalid @enderror" name="paper_name" value="{{ old('paper_name') }}" id="paperName" placeholder="Write paper name here" required>
                                @error('paper_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group row mb-0">
                            <label for="shortName" class="col-form-label col-sm-3 text-right">Short Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('short_name') is-invalid @enderror" name="short_name" value="{{ old('short_name') }}" id="shortName" placeholder="Write paper short name here" required>
                                @error('short_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group row mb-0">
                            <label for="mark" class="col-form-label col-sm-3 text-right">Mark</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('mark') is-invalid @enderror" name="mark" value="{{ old('mark') }}" id="mark" min="0" placeholder="Write paper mark here" required>
                                @error('mark')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="form-group row mb-0">
                            <label for="weight" class="col-form-label col-sm-3 text-right">Weight (%)</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight') }}" id="weight" min="0" placeholder="Write paper weight here">
                                @error('weight')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </td>
                </tr>
                
                <tr><td><button type="submit" class="btn btn-block my-btn-submit">Save</button></td></tr>
            </table>
        </div>
    </form>
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
</script>

@endsection
