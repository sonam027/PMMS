@extends("staff/StaffLayout")
@section("content")


<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Registered Student List</h6>
</div>
<div class="card-body">
<form name="form1" method="post" action="/importscsv" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}"/>
<div class="col-md-5">
	<input type="file" name="file1" accept=".csv" class="form-control"/>
	<h4>{{session('msg')}}</h4>
</div>
<div class="col-md-3">
	<input type="submit" value="Import Student CSV Data" class="btn btn-primary"/>	
</div>
</form>
<br>
<br><a href="assets2/studenttemplate.csv" download-CSV>Download Template</a>
<br>
<br>
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
	<tr>
		<th>PRNNo</th>
		<th>Student Name</th>		
        <th>Department</th>
		<th>Email ID</th>		
		<th>Actions</th>		
	</tr>
</thead>
<tbody>
	@foreach($studs as $stud)
	<tr>
		<td>{{$stud->prnno}}</td>
		<td>{{$stud->name}}</td>		
        <td>{{$stud->dept}}</td>
		<td>{{$stud->email}}</td>		
		<td>
		<a href="/estudent/{{$stud->id}}" class="btn btn-info btn-circle" title="Edit Student">
            <i class="fas fa-info-circle"></i>
        </a>			
		<a onclick="return confirm('Do you want to remove student entry?');" href="/removestudent/{{$stud->id}}" class="btn btn-danger btn-circle" title="Remove Student">
			<i class="fas fa-trash"></i>
		</a>
	</tr>	
	@endforeach
</tbody>
</table>


</div>
</div>
</div>




@stop
