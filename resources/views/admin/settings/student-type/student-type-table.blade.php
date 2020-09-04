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
            <button onclick="studentTypeUnpublished('{{ $studentType->id }}')" class="btn btn-success btn-sm" title="Unpublish"><span class="fa fa-arrow-alt-circle-up"></span></button>
            @else
            <button onclick="studentTypePublished('{{ $studentType->id }}')" class="btn btn-warning btn-sm" title="Publish"><span class="fa fa-arrow-alt-circle-down"></span></button>
            @endif
            <button onclick="studentTypeEdit('{{ $studentType->id }}','{{ $studentType->student_type }}')" class="btn btn-info btn-sm" title="Edit"><span class="fa fa-edit"></span></button>
            <button onclick="studentTypeDelete('{{ $studentType->id }}')" class="btn btn-danger btn-sm" title="Delete"><span class="fa fa-trash"></span></button>
        </td>
    </tr>
@endforeach
@else
<tr class="text-danger font-weight-bolder">
    <td colspan="5">Student Type Not Found !!!</td>
</tr>
@endif

