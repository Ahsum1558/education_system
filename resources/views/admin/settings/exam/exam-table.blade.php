<table class="table table-bordered table-hover text-center" id="examList">
	<thead>
		<tr>
			<th>SL</th>
			<th>Exam Name</th>
			<th>Result Type</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	@php($i=1)
	@foreach($exams as $exam)
		<tr>
			<td>{{ $i++ }}</td>
			<td>{{ $exam->exam_name }}</td>
			<td class="text-capitalize">{{ $exam->result_type }}</td>
			<td style="font-size: large">
			@if($exam->status==1)
				<span class="badge badge-success">{{ 'Active' }}</span>
			@else
				<span class="badge badge-danger">{{ 'Inactive' }}</span>
			@endif
			</td>
			<td>
			@if($exam->status==1)
				<button onclick="examDeactivate('{{ $exam->class_id }}','{{ $exam->type_id }}','{{ $exam->id }}')" class="btn btn-sm btn-success" title="Exam Deactivate"><i class="fa fa-arrow-up"></i></button>
			@else
				<button onclick="examActivate('{{ $exam->class_id }}','{{ $exam->type_id }}','{{ $exam->id }}')" class="btn btn-sm btn-warning"><i class="fa fa-arrow-down" title="Exam Activate"></i></button>
			@endif
				<button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
				<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
			</td>
		</tr>
	@endforeach
	@if(count($exams)==0)
		<tr class="text-danger text-center">
			<th colspan="5">No Exam Found !!!</th>
		</tr>
	@endif
	</tbody>
</table>