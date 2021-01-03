@extends("staff/StaffLayout")
@section("content")


<div class="container">
<div class="row">
<div class="col-md-9 col-md-offset-2">
<h2>Project Details</h2>
<table id="table1" class="table table-bordered">
<thead>
	<tr>
		<th>Project ID</th>
		<th>Project Title</th>
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
		<td>{{$project["ProjectId"]}}</td>
		<td>{{$project["ProjectTitle"]}}</td>
		<td>{{$project["AssignDate"]}}</td>
        <td>{!!$project["GroupMembers"]!!}</td>
        <td>{{$project["Faculty"]}}</td>		
		<td>{{$project["ProjectStatus"]}}</td>		
		<td><a href='/tasknew/{{$project["ProjectId"]}}' class="btn btn-primary">Task List</a></td>		
	</tr>	
	@endforeach
	@else
	<tr>
	<td colspan="7" align="center">-- No row(s) found --</td>
	</tr>
	@endif
</tbody>
</table>


</div>
</div>
</div>




@stop
