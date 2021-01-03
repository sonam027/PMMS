@extends("staff/StaffLayout")
@section("content")


<div class="container">
<div class="row">
<div class="col-md-5 col-md-offset-3">
<h2>Edit Student Information</h2>
@if($msg!="")
<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<h4>{{$msg}}</h4>
</div>
@endif
<form name="form1" id="form1" action="/estudentupdate" method="post">
<input type="hidden" name="_token" value="{{csrf_token()}}"/>
<input type="hidden" name="id" value="{{$id}}"/>

<div class="form-group">
PRN No
<input type="text" name="prnno" id="prnno" class="form-control" value="{{$prnno}}" readonly/>
</div>
<div class="form-group">
Name
<input type="text" name="name" id="name" class="form-control" value="{{$name}}"/>
</div>
<div class="form-group">
Department
<select class="form-control" name="dept">
<option value="">-- Select Department --</option>
<option {{$dept=="IT"?"selected":""}} value="IT">IT</option>
<option {{$dept=="CSE"?"selected":""}} value="CSE">CSE</option>
<option {{$dept=="MECH"?"selected":""}} value="MECH">MECH</option>
<option {{$dept=="CIVIL"?"selected":""}} value="CIVIL">CIVIL</option>
<option {{$dept=="ELECTRICAL"?"selected":""}} value="ELECTRICAL">ELECTRICAL</option>
<option {{$dept=="AUTOMOBILE"?"selected":""}} value="AUTOMOBILE">AUTOMOBILE</option>
</select>
</div>
<div class="form-group">
EmailID
<input type="text" name="user" id="user" class="form-control" value="{{$user}}" readonly/>
</div>
<div class="form-group">
Password
<input type="password" name="pass" id="pass" class="form-control" value="{{$pass}}" readonly/>
</div>


<div class="form-group">
<input type="submit" name="btn" id="btn" class="btn btn-primary" value="Update"/>
<a href="/studentlist" class="btn btn-info">Student List</a>
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
            },
            dept:{
                required:true
            }
        },
        messages:{
            prnno:{
                required:"PRNNo is Required",
                pattern:"PRNNo must be of 10 digits"
            },
            name:{
                required:"Student Name is Required",
                pattern:"Student Name allows only characters and spaces"
            },
            dept:{
                required:"Please select department"
            }
        },
    });
})

</script>



@stop
