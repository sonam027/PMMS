@extends("layout2")
@section("content")


<div class="container" style="margin-top:100px">
<div class="row">
<div class="col-md-5 col-md-offset-3">
<h2>Student Login</h2>
<form name="form1" id="form1" action="/studlogin" method="post">
<input type="hidden" name="_token" value="{{csrf_token()}}"/>
<div class="form-group">
Email ID
<input type="text" name="user" id="user" class="form-control" placeholder="Email ID"/>
</div>
<div class="form-group">
Password
<input type="password" name="pass" id="pass" class="form-control" placeholder="Password"/>
</div>
<div class="form-group">
<input type="submit" name="btn" id="btn" class="btn btn-primary" value="Login"/>
</div>
{{$msg}}
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
            user:{
                required:true,
                email:true
            },
            pass:{
                required:true
            }
        },
        messages:{
            user:{
                required:"Email ID is Required",
                email:"Please provide valid email ID"
            },
            pass:{
                required:"Password is Required"
            }
        },
    });
})

</script>


@stop