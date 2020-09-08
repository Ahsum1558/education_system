<table class="table table-bordered table-hover text-center">
	<thead>
		<tr>
			<th>SL</th>
			<th>Paper Name</th>
			<th>Short Name</th>
			<th>Mark</th>
			<th>Weight</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	@php($i=1)
	@foreach($papers as $paper)
	<tr>
		<td>{{ $i++ }}</td>
		<td>{{ $paper->paper_name }}</td>
		<td>{{ $paper->short_name }}</td>
		<td>{{ $paper->mark }}</td>
		<td>{{ $paper->weight }}</td>
		<td style="font-size: large">
		@if($paper->status==1)
			<span class="badge badge-success">{{ 'Active' }}</span>
		@else
			<span class="badge badge-danger">{{ 'Inactive' }}</span>
		@endif
		</td>
		<td>
		@if($paper->status==1)
			<button class="btn btn-sm btn-success"><i class="fa fa-arrow-up"></i></button>
		@else
			<button class="btn btn-sm btn-warning"><i class="fa fa-arrow-down"></i></button>
		@endif
			<button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
			<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
		</td>
	</tr>
	@endforeach
	@if(count($papers)==0)
		<tr class="text-danger text-center">
			<th colspan="7">No Paper Found !!!</th>
		</tr>
	@endif
	</tbody>
</table>