@extends("student/StudLayout")
@section("content")

<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Project Title - {{$projectname}}/ Update Task</h6>
</div>
<div class="card-body">
@if($msg!="")
<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<h4>{{$msg}}</h4>
</div>
@endif
<form name="form1" id="form1" action="/supdatetask" method="post" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}"/>
<input type="hidden" name="pid" value="{{$pid}}"/>
<input type="hidden" name="srno" value="{{$sno}}"/>
<div class="form-group">
Task
<textarea name="task" id="task" class="form-control">{{$task}}</textarea>
</div>
<div class="form-group">
Start Date
<input type="date" name="startdate" id="startdate" class="form-control" value="{{$sdate}}" readonly/>
</div>
<div class="form-group">
Actual Start Date
<input type="date" min="{{$sdate}}" name="astartdate" id="astartdate" class="form-control" value="{{$asdate}}" />
</div>
<div class="form-group">
Completion Date
<input type="date"  name="cdate" id="cdate" class="form-control" value="{{$cdate}}" readonly/>
</div>
<div class="form-group">
Actual Completion Date
<input type="date" min="{{$acdate}}" name="acdate" id="acdate" class="form-control" value="{{$acdate}}"/>
</div>
<div class="form-group">
Additional Information
<textarea name="ainfo" id="ainfo" class="form-control">{{$ainfo}}</textarea>
</div>
<div class="form-group">
Upload Document if any..
<input type="file" name="file1" class="form-control"/>
{{$doc}}	
</div>
<div class="form-group">
Task Status
<select name="status" class="form-control" {{$status=="Close"?"disabled":""}}>
<option {{$status=="Open"?"selected":""}} value="Open">Open</option>
<option {{$status=="Close"?"selected":""}} value="Close">Close</option>
</select>
</div>

<div class="form-group">
<input type="submit" name="btn" id="btn" class="btn btn-primary" value="Update Task" {{$status=="Close"?"disabled":""}}/>
</div>

</form>
</div>





<a href="/sshowtask/{{$pid}}">Back to Task List</a>



</div>




@stop

@section("footer")


@stop