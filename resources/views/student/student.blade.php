@extends("student/StudLayout")
@section("content")


<div class="container">
<div class="row">
<div class="col-md-5 col-md-offset-3">
<h2>Your Profile</h2>
@if($msg!="")
<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<h4>{{$msg}}</h4>
</div>
@endif
<form name="form1" id="form1" action="/suprofile" method="post">
<input type="hidden" name="_token" value="{{csrf_token()}}"/>
<input type="hidden" name="id" value="{{$id}}"/>
<div class="form-group">
PRN No
<input type="text" name="prnno" id="prnno" class="form-control" value="{{$prnno}}" />
</div>
<div class="form-group">
Name
<input type="text" name="name" id="name" class="form-control" value="{{$name}}"/>
</div>
<div class="form-group">
Department
<input type="text" name="dept" id="dept" class="form-control" value="{{$dept}}" readonly/>
</div>
<div class="form-group">
EmailID
<input type="text" name="user" id="user" class="form-control" value="{{$user}}" readonly/>
</div>
<div class="form-group">
Password
<input type="password" name="pass" id="pass" class="form-control" value="{{$pass}}" readonly/>
<a href="/schangepass">Change Password</a>
</div>

<div class="form-group">
<input type="submit" name="btn" id="btn" class="btn btn-primary" value="Update"/>
</div>

</form>


</div>
</div>
</div>

@stop

@section("vald")
<script>
$(function(){
    $("#form1").validate({
        rules:{
            prnno:{
                required:true,
                pattern:/^\d{10}$/
            },
            name:{
                required:true,
                pattern:/^[A-Za-z ]+$/
            }
        },
        messages:{
            prnno:{
                required:"PRNNo is Required",
                pattern:"PRNNo must be of 10 digits"
            },
            name:{
                required:"Faculty Name is Required",
                pattern:"Faculty Name allows only characters and spaces"
            }
        }
    });
})

</script>



@stop