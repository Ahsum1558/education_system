<thead>
	<tr>
		<th>SL</th>
		<th>Batch Name</th>
		<th>Student Capacity</th>
		<th>Action</th>
	</tr>
</thead>
<tbody>
@php($i = 1)
@foreach($batches as $batch)
	<tr>
		<td>{{ $i++ }}</td>
		<td>{{ $batch->batch_name }}</td>
		<td>{{ $batch->student_capacity }}</td>
		<td>
            @if($batch->status == 1)
            <button onclick='unpublished("{{ $batch->id }}","{{ $batch->class_id }}")' class="btn btn-success btn-sm" id="unpublished" title="Unpublish"><span class="fa fa-arrow-alt-circle-up"></span></button>
            @else
            <button onclick='published("{{ $batch->id }}","{{ $batch->class_id }}")' class="btn btn-warning btn-sm" title="Publish"><span class="fa fa-arrow-alt-circle-down"></span></button>
            @endif
            <a href="{{ route('batch-edit', ['id'=>$batch->id]) }}" class="btn btn-info btn-sm" title="Edit" target="_blank"><span class="fa fa-edit"></span></a>
            <button onclick='delbatch("{{ $batch->id }}","{{ $batch->class_id }}")'  class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure !')"><span class="fa fa-trash"></span></button>
        </td>
	</tr>
@endforeach
</tbody>

<script>
	function unpublished(batchId,classId){
		var check = confirm('If you want to unpublish, press OK');
		if(check){
			$.get("{{ route('batch-unpublished') }}", {batch_id:batchId,class_id:classId}, function(data){
				console.log(data);
                $("#batchList").empty().html(data);
            })
		}else{
			return false;
		}
	}
	function published(batchId,classId){
		var check = confirm('If you want to publish, press OK');
		if(check){
			$.get("{{ route('batch-published') }}", {batch_id:batchId,class_id:classId}, function(data){
				console.log(data);
                $("#batchList").empty().html(data);
            })
		}else{
			return false;
		}
	}
	function delbatch(batchId,classId){
		var check = confirm('If you want to delete, press OK');
		if(check){
			$.get("{{ route('batch-delete') }}", {batch_id:batchId,class_id:classId}, function(data){
				console.log(data);
                $("#batchList").empty().html(data);
            })
		}else{
			return false;
		}
	}
</script>