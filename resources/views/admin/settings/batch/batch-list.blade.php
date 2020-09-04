@extends('admin.master')
@section('main-content')
<!--Content Start-->
<section class="container-fluid">
<div class="row content">
    <div class="col-md-8 offset-md-2 pl-0 pr-0">

        @include('admin.includes.alert')

        <div class="form-group">
            <div class="col-sm-12">
                <h4 class="text-center font-weight-bold font-italic mt-3">Class Wise Batch List</h4>
            </div>
        </div>
         <div class="table-responsive p-1">
            <table id="" class="table table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group row mb-0">
                            <label for="classId" class="col-form-label col-sm-3 text-right">Batch Name</label>
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
                          </div>
                        <div class="col-md">
                            <div class="form-group row mb-0">
                            <label for="typeId" class="col-form-label col-sm-3 text-right">Student Type</label>
                            <div class="col-sm-9">
                                <select name="type_id" class="form-control @error('type_id') is-invalid @enderror" id="typeId" required>
                                    <option value="">Select Coures</option>
                                </select>
                                @error('type_id')
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
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" id="batchList"></table>
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

     $('#typeId').change(function(){
        var studentTypeId = $(this).val();
        var classId = $('#classId').val();
        if(classId && studentTypeId){
            $('#overlay .loader').show();
            $.get("{{ route('batch-list-by-ajax') }}", {
                class_id:classId,
                type_id:studentTypeId,
            }, function(data){
                $('#overlay .loader').hide();
                console.log(data);
                $("#batchList").html(data);
            })
        }else{
            $("#batchList").empty();
        }
    })
</script>

@endsection
