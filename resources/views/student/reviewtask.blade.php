@extends("student/StudLayout")
@section("content")


<div class="row">
<div class="card shadow mb-4">
<div class="card-header py-3">
	<h6 class="m-0 font-weight-bold text-primary">Review of Most Recent Tasks of {{$projectname}}</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	<thead>

	<tr>		
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
	<td colspan="10" align="center">-- No row(s) found --</td>
	</tr>
	@endif
</tbody>
</table>
<a href="/studindex">Back to Home</a>

</div>
</div>

</div>




@stop

@section("footer")


@stop