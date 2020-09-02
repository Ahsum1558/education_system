@if(count($studentTypes)>0)
@php($i = 1)
@foreach($studentTypes as $studentType)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $studentType->class_name }}</td>
        <td>{{ $studentType->student_type }}</td>
        <td>{{ $studentType->status == 1 ? 'Active' : 'Inactive' }}</td>
        <td>
            @if($studentType->status == 1)
            <a href="{{ route('school-unpublished', ['id'=>$studentType->id]) }}" class="btn btn-success btn-sm" title="Unpublish"><span class="fa fa-arrow-alt-circle-up"></span></a>
            @else
            <a href="{{ route('school-published', ['id'=>$studentType->id]) }}" class="btn btn-warning btn-sm" title="Publish"><span class="fa fa-arrow-alt-circle-down"></span></a>
            @endif
            <a href="{{ route('school-edit', ['id'=>$studentType->id]) }}" class="btn btn-info btn-sm" title="Edit"><span class="fa fa-edit"></span></a>
            <a href="{{ route('school-delete', ['id'=>$studentType->id]) }}" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure !')"><span class="fa fa-trash"></span></a>
        </td>
    </tr>
@endforeach
@else
<tr class="text-danger font-weight-bolder">
    <td colspan="5">Student Type Not Found !!!</td>
</tr>
@endif