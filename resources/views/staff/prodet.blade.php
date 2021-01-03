@extends("staff/StaffLayout")
@section("content")



<div class="row">
<div class="card shadow mb-4">
<div class="card-header py-3">
	<h6 class="m-0 font-weight-bold text-primary">{{$projectname}}</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	<thead>

	<tr>
		@if(Session::get("role")=="Faculty")
		<th>Actions</th>		        
		@endif
		<th>Project ID</th>
		<th>Project Title</th>
		<th>Department</th>	
		<th>Assigned Date</th>
        <th>Group Members</th>
        <th>Faculty Details</th>
		<th>Project Status</th>		
		<th>Project Progress</th>	
	</tr>
</thead>
<tbody>
    @if(count($projects)>0)
    @foreach($projects as $project)
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
		<td>{{$project["ProjectId"]}}</td>
		<td>{{$project["ProjectTitle"]}}</td>
		<td>{{$project["Dept"]}}</td>	
		<td>{{$project["AssignDate"]}}</td>
        <td>{!!$project["GroupMembers"]!!}</td>
        <td>{{$project["Faculty"]}}</td>	
		<td>{{$project["ProjectStatus"]}}</td>		
		<td><a href='/showtask/{{$project["ProjectId"]}}' class="btn btn-primary">Progress</a></td>		
	</tr>	
	@endforeach
	@else
	<tr>
	<td colspan="8" align="center">-- No row(s) found --</td>
	</tr>
	@endif
</tbody>
</table>
<a href="/projectstatuslist">Back to Project List</a>

</div>
</div>

</div>




@stop

@section("footer")


@stop