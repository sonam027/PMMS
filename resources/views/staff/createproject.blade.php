@extends("staff/StaffLayout")
@section("content")
<style>
[data-role="dynamic-fields"] > .form-inline + .form-inline {
    margin-top: 0.5em;
}

[data-role="dynamic-fields"] > .form-inline [data-role="add"] {
    display: none;
}

[data-role="dynamic-fields"] > .form-inline:last-child [data-role="add"] {
    display: inline-block;
}

[data-role="dynamic-fields"] > .form-inline:last-child [data-role="remove"] {
    display: none;
}
</style>


<div class="container">
<div class="row">
<div class="col-md-6 col-md-offset-3">
<h2>Create Project</h2>
@if($msg!="")
<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<h4>{{$msg}}</h4>
</div>
@endif
<form name="form1" id="form1" action="/createproject" method="post">
<input type="hidden" name="_token" value="{{csrf_token()}}"/>
<div class="form-group">
Project Title
<input type="text" name="title" id="title" class="form-control"/>
</div>
<div class="form-group">
Project Assigned Date
<input type="date" name="adate" id="adate" class="form-control"/>
</div>
<div class="form-group">
Group Members
<div data-role="dynamic-fields">
    <div class="form-inline">
        <div class="form-group">
            <label class="sr-only" for="field-name">Field Name</label>
            <input type="text" class="form-control" name="fieldname[]" id="field-name" placeholder="PRN No">
        </div>
        <span>-</span>
        <div class="form-group">
            <label class="sr-only" for="field-value">Field Value</label>
            <input type="text" class="form-control" name="fieldvalue[]" id="field-value" placeholder="Student Name">
        </div>
        <button type="button" class="btn btn-danger" data-role="remove">
            <span>-</span>
        </button>
        <button type="button" class="btn btn-primary" data-role="add">
            <span>+</span>
        </button>
    </div>  <!-- /div.form-inline -->
</div>  <!-- /div[data-role="dynamic-fields"] -->

</div>

<div class="form-group">
<input type="submit" name="btn" id="btn" class="btn btn-primary" value="Submit"/>
</div>

</form>


</div>
</div>
</div>

@stop

@section("footer")
<script type="text/javascript">
$(function() {
    // Remove button click
    $(document).on(

        'click',

        '[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',

        function(e) {

            e.preventDefault();

            $(this).closest('.form-inline').remove();

        }

    );

    // Add button click

    $(document).on(

        'click',

        '[data-role="dynamic-fields"] > .form-inline [data-role="add"]',

        function(e) {

            e.preventDefault();

            var container = $(this).closest('[data-role="dynamic-fields"]');

            new_field_group = container.children().filter('.form-inline:first-child').clone();

            new_field_group.find('input').each(function(){

                $(this).val('');

            });

            container.append(new_field_group);

        }

    );

});


</script>

@stop