@extends("staff/StaffLayout")
@section("content")


<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Registered Faculty List</h6>
</div>
<div class="card-body">
<form name="form1" method="post" action="/importfcsv" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}"/>
<div class="col-md-5">
	<input type="file" name="file1" accept=".csv" class="form-control"/>
	<h4>{{session('msg')}}</h4>
</div>
<div class="col-md-3">
	<input type="submit" value="Import Faculty CSV Data" class="btn btn-primary"/>	
</div>
</form>
<br>
<br>
<a href="assets2/facultytemplate.csv" download-CSV>Download Template</a>
<br>
<br>
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
	<tr>		
		<th>PRNNo</th>
		<th>Faculty Name</th>		
        <th>Department</th>
        <th>EmailID</th>
		<th>Role</th>
		<th>Actions</th>		
	</tr>
</thead>
<tbody>
	@foreach($facultys as $faculty)
	<tr>
		<td>{{$faculty->prnno}}</td>
		<td>{{$faculty->name}}</td>
		<td>{{$faculty->dept}}</td>
        <td>{{$faculty->email}}</td>
        <td>{{$faculty->role}}</td>		
		<td>
		<a href="/efaculty/{{$faculty->id}}" class="btn btn-info btn-circle" title="Edit Faculty">
            <i class="fas fa-info-circle"></i>
        </a>
		<a onclick="return confirm('Do you want to remove faculty entry?');" href="/removefaculty/{{$faculty->id}}" class="btn btn-danger btn-circle" title="Remove Faculty">
			<i class="fas fa-trash"></i>
		</a>			
		</td>		
	</tr>	
	@endforeach
</tbody>
</table>


</div>
</div>
</div>

@stop
