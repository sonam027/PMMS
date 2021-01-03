@extends("student/StudLayout")
@section("content")

<div class="card shadow mb-4">
<div class="card-header py-3">
	<h6 class="m-0 font-weight-bold text-primary">Task List of Project - {{$projectname}}</h6>
</div>
<div class="card-body">
	<div class="table-responsive">
	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	<thead>

	<tr>
		<th>Sr.No</th>		
		<th>Task</th>
        <th>Start Date</th>
        <th>Actual Start Date</th>		
		<th>Completion Date</th>		
        <th>Actual Completion Date</th>		
		<th>Task Status</th>
		<th>Documents</th>			
		<th>Actions</th>	
	</tr>
</thead>
<tbody>
	@if(count($tasks)>0)
	@foreach($tasks as $task)
	<tr>
		<td>{{$task->SrNo}}</td>
		<td>{{$task->Task}}</td>
		<td>{{$task->StartDate}}</td>
        <td>{{$task->ActualStartDate}}</td>
        <td>{{$task->CompletionDate}}</td>
        <td>{{$task->ActualCompletionDate}}</td>
        <td>{{$task->TaskStatus}}</td>	
		<td><a href="/download/{{$task->document}}">{{$task->document}}</a></td>								
		<td>
		<a href='/updatetask/{{$task->ProjectId}}_{{$task->SrNo}}' class="btn btn-success btn-circle" title="Update Task">
			<i class="fas fa-pencil-alt"></i>
		</a>	
		</td>			        
	</tr>	
	@endforeach
	@else
	<tr>
	<td colspan="7" align="center">-- No row(s) found --</td>
	</tr>
	@endif
</tbody>
</table>
<a href="/sprojectstatuslist">Back to Project List</a>

</div>
</div>

</div>




@stop

@section("footer")


@stop