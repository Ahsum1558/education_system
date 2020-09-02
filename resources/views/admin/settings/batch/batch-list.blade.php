@extends('admin.master')
@section('main-content')
<!--Content Start-->
<section class="container-fluid">
<div class="row content">
    <div class="col-md-8 offset-md-2 pl-0 pr-0">

        @if(Session::get('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success : </strong> {{ Session::get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(Session::get('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error: </strong> {{ Session::get('error_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            @endif

        <div class="form-group">
            <div class="col-sm-12">
                <h4 class="text-center font-weight-bold font-italic mt-3">Class Wise Batch List</h4>
            </div>
        </div>
         <div class="table-responsive p-1">
            <table id="" class="table table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                <tr>
                    <td>
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
<script>
    $('#classId').change(function(){
        var id = $(this).val();
        if(id){
            $.get("{{ route('batch-list-by-ajax') }}", {id:id}, function(data){
                $("#batchList").html(data);
            })
        }
    })
</script>

@endsection
