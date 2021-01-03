@extends("staff/StaffLayout")
@section("content")


<div class="container">
<div class="row">
<div class="col-md-5 col-md-offset-3">
<h2>Student Registration</h2>
@if($msg!="")
<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<h4>{{$msg}}</h4>
</div>
@endif
<form name="form1" id="form1" action="/studentreg" method="post">
<input type="hidden" name="_token" value="{{csrf_token()}}"/>
<div class="form-group">
PRN No
<input type="text" name="prnno" id="prnno" class="form-control"/>
</div>
<div class="form-group">
Name
<input type="text" name="name" id="name" class="form-control"/>
</div>
<div class="form-group">
Department
<select class="form-control" name="dept">
<option value="">-- Select Department --</option>
<option value="IT">IT</option>
<option value="CSE">CSE</option>
<option value="MECH">MECH</option>
<option value="CIVIL">CIVIL</option>
<option value="ELECTRICAL">ELECTRICAL</option>
<option value="AUTOMOBILE">AUTOMOBILE</option>
</select>
</div>
<div class="form-group">
Email ID
<input type="text" name="user" id="user" class="form-control"/>
</div>
<div class="form-group">
Password
<input type="password" name="pass" id="pass" class="form-control"/>
</div>
<div class="form-group">
Confirm Password
<input type="password" name="pass1" id="pass1" class="form-control"/>
</div>


<div class="form-group">
<input type="submit" name="btn" id="btn" class="btn btn-primary" value="Submit"/>
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
            },
            user:{
                required:true,
                email:true,
                remote:'/checkstudentexists'
            },
            pass:{
                required:true
            },
            pass1:{
                required:true,
                equalTo:"#pass"
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
            },
            user:{
                required:"UserName/Email ID is Required",
                email:"Wrong format of Email ID",
                remote:"Email ID is registered with System. Please try different Email ID"
            },
            pass:{
                required:"Password is Required"
            },
            pass1:{
                required:"Confirm Password is Required",
                equalTo:"Password and Confirm Password Mismatch"
            }
        },
    });
})

</script>



@stop