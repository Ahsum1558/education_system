@extends('admin.master')
@section('main-content')
<!--Content Start-->
<section class="container-fluid">
<div class="row content">
    <div class="col-md-8 offset-md-2 pl-0 pr-0">

        @include('admin.includes.alert')

        <div class="form-group">
            <div class="col-sm-12">
                <h4 class="text-center font-weight-bold font-italic mt-3">Class List</h4>
            </div>
        </div>
        <div class="table-responsive p-1">
            <table id="" class="table table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Class Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @php($i = 1)
                @foreach($classes as $class)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $class->class_name }}</td>
                        <td>{{ $class->status == 1 ? 'Published' : 'Unpublished' }}</td>
                        <td>
                            @if($class->status == 1)
                            <a href="{{ route('class-unpublished', ['id'=>$class->id]) }}" class="btn btn-success btn-sm" title="Unpublish"><span class="fa fa-arrow-alt-circle-up"></span></a>
                            @else
                            <a href="{{ route('class-published', ['id'=>$class->id]) }}" class="btn btn-warning btn-sm" title="Publish"><span class="fa fa-arrow-alt-circle-down"></span></a>
                            @endif
                            <a href="{{ route('class-edit', ['id'=>$class->id]) }}" class="btn btn-info btn-sm" title="Edit"><span class="fa fa-edit"></span></a>
                            <a href="{{ route('class-delete', ['id'=>$class->id]) }}" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure !')"><span class="fa fa-trash"></span></a>
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
