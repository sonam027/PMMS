@extends("staff/StaffLayout")
@section("content")




<div class="row">
<div class="card shadow mb-4">
<div class="card-header py-3">
	<h6 class="m-0 font-weight-bold text-primary">Task List of Project {{$projectname}}</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	<thead>

	<tr>
		@if(Session::get("role")=="Faculty")
		<th>Actions</th>		        
		@endif
		<th>SrNo</th>		
		<th>Sem</th>
		<th>Task</th>
        <th>StartDate</th>
        <th>ActualStartDate</th>		
		<th>CompletionDate</th>		
        <th>ActualCompletionDate</th>		
		<th>Task Status</th>
		<th>Assigned By</th>
		<th>Documents</th>
		<th>Weightage</th>
		
	</tr>
</thead>
<tbody>
	@if(count($tasks)>0)
	@foreach($tasks as $task)
	<tr>
		@if(Session::get("role")=="Faculty")
		<td style="white-space: nowrap">
		<a href='/updatetask2/{{$task->ProjectId}}_{{$task->SrNo}}' class="btn btn-success btn-circle" title="Update Task">
			<i class="fas fa-pencil-alt"></i>
		</a>
		<a onclick="return confirm('Do you want to remove task entry?');" href="/removetask/{{$task->ProjectId}}_{{$task->SrNo}}" class="btn btn-danger btn-circle" title="Remove Task">
			<i class="fas fa-trash"></i>				
		</td>	
		@endif
		<td>{{$task->SrNo}}</td>
		<td>{{$task->Sem}}</td>
		<td>{{$task->Task}}</td>
		<td>{{$task->StartDate}}</td>
        <td>{{$task->ActualStartDate}}</td>
        <td>{{$task->CompletionDate}}</td>
        <td>{{$task->ActualCompletionDate}}</td>
        <td>{{$task->TaskStatus}}</td>			
		<td>{{$task->Role}}</td>
		<td><a href="/download2/{{$task->document}}">{{$task->document}}</a></td>
		<td>{{$task->Weightage}}</td>
	</tr>	
	@endforeach
	@else
	<tr>
	<td colspan="8" align="center">-- No row(s) found --</td>
	</tr>
	@endif
</tbody>
</table>


</div>
</div>

</div>


</div>


@stop

@section("footer")


@stop