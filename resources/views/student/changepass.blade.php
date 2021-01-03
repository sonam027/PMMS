@extends("student/StudLayout")
@section("content")


<div class="container">
<div class="row">
<div class="col-md-5 col-md-offset-3">
<h2>Change your password ::</h2>
@if($msg!="")
<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<h4>{{$msg}}</h4>
</div>
@endif
<form name="form1" id="form1" action="/schangepass" method="post">
<input type="hidden" name="_token" value="{{csrf_token()}}"/>
<div class="form-group">
Old Password
<input type="password" name="pass" id="pass" class="form-control"/>
</div>
<div class="form-group">
New Password
<input type="password" name="pass1" id="pass1" class="form-control"/>
</div>
<div class="form-group">
Confirm New Password
<input type="password" name="pass2" id="pass2" class="form-control"/>
</div>

<div class="form-group">
<input type="submit" name="btn" id="btn" class="btn btn-primary" value="Submit"/>
</div>

</form>


</div>
</div>
</div>




@stop
