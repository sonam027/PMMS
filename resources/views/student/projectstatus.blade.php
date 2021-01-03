@extends("student/StudLayout")
@section("content")


<div class="card shadow mb-4">
<div class="card-header py-3">
	<h6 class="m-0 font-weight-bold text-primary">Assigned Projects</h6>
</div>
<div class="card-body">
	<div class="table-responsive">
	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		<thead>	
		<tr>
		<th>Project ID</th>
		<th>Project Title</th>
		<th>Assigned Date</th>
        <th>Group Members</th>
        <th>Faculty Details</th>		
		<th>Project Status</th>		
		<th>Project Tasks</th>		
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
		<td>
		<a href='/sshowtask/{{$project["ProjectId"]}}' class="btn btn-success btn-circle" title="Show Tasks">
            <i class="fas fa-check"></i>
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


</div>
</div>
</div>




@stop
