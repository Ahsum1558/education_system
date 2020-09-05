@extends('admin.master')
@section('main-content')
<!--Content Start-->
<section class="container-fluid">
<div class="row content">
    <div class="col-md-8 offset-md-2 pl-0 pr-0">

        @include('admin.includes.alert')

        <div class="form-group">
            <div class="col-sm-12">
                <h4 class="text-center font-weight-bold font-italic mt-3">Student Type List  <button class="bg-success text-light" data-toggle="modal" data-target="#studentTypeAddModal"> Add New</button></h4>
            </div>
        </div>
        <div class="table-responsive p-1">
            <table id="" class="table table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Class Name</th>
                        <th>Student Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="studentTypeTable">
                @include('admin.settings.student-type.student-type-table')
                </tbody>
            </table>
        </div>

    </div> 
</div>
</section>
<!--Content End-->

<!-- Button trigger modal -->
@include('admin.settings.student-type.modal.add-form')
@include('admin.settings.student-type.modal.edit-form')

<script>
    $('#studentTypeInsert').submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize();
        var method = $(this).attr('method');
        $('#studentTypeAddModal').click();
        $('#studentTypeAddModal').modal('hide');
        $.ajax({ 
            type: method,
            url: url,
            data: data,
            success: function(){
                $.get("{{ route('student-type-list') }}", function(data){
                    $('#studentTypeTable').empty().html(data);
                })
            }
        })
    });

    function studentTypeUnpublished(id){
        $.get("{{ route('student-type-unpublish') }}", {type_id:id}, function(data){
            console.log(data);
            $('#studentTypeTable').empty().html(data);
        });
    }

    function studentTypePublished(id){
        $.get("{{ route('student-type-publish') }}", {type_id:id}, function(data){
            console.log(data);
            $('#studentTypeTable').empty().html(data);
        });
    }

    function studentTypeEdit(id,name){
        $('#studentTypeEditModal').find('#studentType').val(name);
        $('#studentTypeEditModal').find('#typeId').val(id);
        $('#studentTypeEditModal').modal('show');
    }
    $('#studentTypeUpdate').submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize();
        var method = $(this).attr('method');
        $('#studentTypeEditModal').click();
        $('#studentTypeEditModal').modal('hide');
        $.ajax({ 
            type: method,
            url: url,
            data: data,
            success: function(data){
                $('#studentTypeTable').empty().html(data);
            }
        })
    });

    function studentTypeDelete(id){
        var msg = 'Are you sure !';
        if(confirm(msg)){
            $.get("{{ route('student-type-delete') }}", {type_id:id}, function(data){
            console.log(data);
            $('#studentTypeTable').empty().html(data);
        });
        }
    }

</script>


@endsection
