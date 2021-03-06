@extends('admin.master')

@section('main-content')

<!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-12 pl-0 pr-0">
            @include('admin.includes.alert')
            <form action="{{ route('student-attendance-update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="col-sm-12">
                        <h4 class="text-center font-weight-bold font-italic mt-3">Batch Wise Student Attendance Edit Form</h4>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col">
                            <select name="class_id" id="classId" class="form-control">
                                <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select name="type_id" id="typeId" class="form-control">
                                <option value="">Select Course</option>
                            </select>
                        </div>
                        <div class="col">
                            <select name="batch_id" id="batchId" class="form-control">
                                <option value="">Select Batch</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row ml-0 mr-0">
                        <div class="col" id="studentList"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!--Content End-->

@include('admin.includes.loader')
<style>
    #overlay .loader{display: none;}
</style>
<script>
    $('#classId').change(function() {
        var classId = $(this).val();
        if (classId) {
            $('#overlay .loader').show();
            $.get("{{ route('class-wise-student-type') }}", {class_id:classId}, function(data){
                console.log(data);
                $('#typeId').empty().html(data);
                $('#overlay .loader').hide();
            })
        }
    });

    $('#typeId').change(function() {
        var classId = $('#classId').val();
        var typeId = $(this).val();
        if (classId && typeId) {
            $('#overlay .loader').show();
            $.get("{{ route('class-and-type-wise-batch-list') }}", {
                class_id:classId,
                type_id:typeId
            }, function(data){
                console.log(data);
                $('#batchId').empty().html(data);
                $('#overlay .loader').hide();
            })
        }
    });

    $('#batchId').change(function() {
        var classId = $('#classId').val();
        var typeId = $('#typeId').val();
        var batchId = $(this).val();
        if (classId && typeId && batchId) {
            $('#overlay .loader').show();
            $.get("{{ route('student-list-for-attendance-edit') }}", {
                class_id:classId,
                batch_id:batchId,
                type_id:typeId
            }, function(data){
                console.log(data);
                $('#studentList').empty().html(data);
                $('#overlay .loader').hide();
            })
        }
    });

</script>

@endsection