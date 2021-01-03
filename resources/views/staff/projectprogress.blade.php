@extends("staff/StaffLayout")
@section("content")


<!-- Content Row -->
<div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

  <!-- Project Card Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Project progress</h6>
    </div>    
    <div class="card-body">
    @if(Session::get('role')=="Admin" || Session::get('role')=="Dean"|| Session::get('role')=="HOD"|| Session::get('role')=="Coordinator"|| Session::get('role')=="Faculty")
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
      @foreach($depts as $dept)
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#{{$dept}}">{{$dept}}</a>
        
      </li>
      @endforeach      
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
    
    @foreach($depts as $dept)
      <div class="tab-pane container"  id="{{$dept}}">
      <br>      
      <?php $i = 0; $flag=false; ?>
      @foreach($projects as $project)
      @if($project["Dept"]==$dept)
      <h4 class="small font-weight-bold">{{$project["ProjectTitle"]}}  <span class="float-right">{{$project["Task"]}}%</span></h4>
      
        <div class="progress mb-4">
          <div class="progress-bar {{$labels[$i]}}" role="progressbar" style="width: {{$project["Task"]}}%" aria-valuenow="{{$project["Task"]}}" aria-valuemin="0" aria-valuemax="100">
          <a href='/projectdetails/{{$project["ProjectId"]}}' class="btn btn-primary"></a>
          </div>
        </div>
        
        <?php       
          $i++; 
          if($i>=count($labels))
          {
            $i=0;
          }
          $flag=true;
        ?>  
       @endif 
      @endforeach
    <?php 
    if($flag==false)        
    {
    ?>
    <h4 align="center">-- No row(s) found --</h4>	
    <?php
    }
    ?>
      
      </div>
      @endforeach
      
    </div>
    @else

    @if(count($projects)>0)
    <?php $i = 0; ?>
	@foreach($projects as $project)
	  <h4 class="small font-weight-bold">{{$project["ProjectTitle"]}}  <span class="float-right">{{$project["Task"]}}%</span></h4>
      <div class="progress mb-4">
        <div class="progress-bar {{$labels[$i]}}" role="progressbar" style="width: {{$project['Task']}}%" aria-valuenow="{{$project['Task']}}" aria-valuemin="0" aria-valuemax="100">
        <a href='/showtask/{{$project["ProjectId"]}}' class="btn btn-primary"></a></div>
     
      </div>
      <?php       
        $i++; 
        if($i>=count($labels))
        {
          $i=0;
        }
      ?>  
    @endforeach



	@else
	
	<h4 align="center">-- No row(s) found --</h4>	
	@endif

    @endif
    
      
    </div>
  </div>
</div> 



@stop
