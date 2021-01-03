<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Student;
use App\Projects;
use DB;


class StudentController extends Controller
{

    public function Index()
    {
    	return view("student/index");
	}
	public function StudentProfile(Request $request)
    {
		$msg="";
		$name="";
		$prnno="";
		$dept="";
		$user="";
		$role="";
		$id=$request->session()->get("id");
		$obj=Student::find($id);		
    	if($request->btn)
    	{
			$prnno=$request->prnno;
			$name=$request->name;			
			$dept=$request->dept;
			$user=$request->user;			
			$pass=$request->pass;
			
			$obj->prnno=$prnno;    		
    		$obj->name=$name;    					
			$obj->dept=$dept;
			$obj->email=$user;			
			$obj->password=$pass;
    		
    		$obj->save();   
    		$msg="Student Profile Updated Successfully";    		

		}
		else
		{
			
			$msg="";			
			$prnno=$obj->prnno;
			$name=$obj->name;			
			$dept=$obj->dept;
			$user=$obj->email;
			$pass=$obj->password;			
		}
    	return view("student/student",["msg"=>$msg,"id"=>$id,"prnno"=>$prnno,"name"=>$name,"dept"=>$dept,"user"=>$user,"pass"=>$pass]);
	}
	
	public function ProjectStatusList(Request $request)
    {
		$prn=$request->session()->get("prn");
		$name=$request->session()->get("name");
		//$str=$prn." - ".$name;
		$projects=DB::select("select * from Projects where GroupMembers like '%$prn%' and GroupMembers like '%$name%'");
		$uprojects=array();
		foreach($projects as $project)
		{
			$members=unserialize($project->GroupMembers);
			$strmembers="";
			foreach($members as $key=>$value)
			{
				$strmembers.=$key. " - ".$value."<br>";
			}
			$strfaculty=$project->FacultyId." - ".$project->FacultyName;
			$uprojects[]=array(
				"ProjectId"=>$project->ProjectId,
				"ProjectTitle"=>$project->ProjectTitle,
				"AssignDate"=>$project->AssignDate,
				"GroupMembers"=>$strmembers,
				"Faculty"=>$strfaculty,
				"ProjectStatus"=>$project->ProjectStatus
			);
			
		}		
    	return view("student/projectstatus",["projects"=>$uprojects]);
	}

	public function ProjectDetails(Request $request)
    {
		$projectid=$request->route("id");
		$fid=$request->session()->get("fid");		
		$projects=DB::select("select * from Projects where FacultyId=? and ProjectId=?",array($fid,$projectid));
		$uprojects=array();
		foreach($projects as $project)
		{
			$members=unserialize($project->GroupMembers);
			$strmembers="";
			foreach($members as $key=>$value)
			{
				$strmembers.=$key. " - ".$value."<br>";
			}
			$strfaculty=$project->FacultyId." - ".$project->FacultyName;
			$uprojects[]=array(
				"ProjectId"=>$project->ProjectId,
				"ProjectTitle"=>$project->ProjectTitle,
				"AssignDate"=>$project->AssignDate,
				"GroupMembers"=>$strmembers,
				"Faculty"=>$strfaculty,
				"ProjectStatus"=>$project->ProjectStatus
			);
			
		}
    	return view("student/projectdetails",["projects"=>$uprojects]);
	}
	public function ShowTask(Request $request)
    {
		$projectid=$request->route("id");
		$tasks=DB::select("select * from Tasks where ProjectId=?",array($projectid));
		if($request->msg)
		{
			$msg=$request->msg;
		}
		else
		{
			$msg="";
		}
		$projects=DB::select("select * from Projects where ProjectId=?",array($projectid));
		$projectname=$projects[0]->ProjectTitle;				
    	return view("student/task",["msg"=>$msg,"tasks"=>$tasks,"pid"=>$projectid,"projectname"=>$projectname]);

	}
	public function UpdateTask(Request $request)
    {
		$msg="";
		if($request->btn)
    	{
			$file=$request->file("file1");
			if($file!=null)
			{
				$fname=$file->getClientOriginalName();
				$file->move("uploads",$fname);
			}
			else
			{
				$fname="";
			}
			$arr=[$request->task,$request->startdate,$request->astartdate,$request->cdate,$request->acdate,$request->ainfo,$request->status,$fname,$request->pid,$request->srno];
			//print_r($arr);
			//exit(0);
			DB::update("Update Tasks set Task=?,StartDate=?,ActualStartDate=?,CompletionDate=?,ActualCompletionDate=?,AdditionalInfo=?,TaskStatus=?,document=? where ProjectID=? and SrNo=?",$arr);
			$msg="Task Updated Successfully";
			return redirect()->action("StudentController@ShowTask",["id"=>$request->pid]);

		}
		else
		{
			$id=$request->route("id");
			$str=explode("_",$id);
			$projectid=$str[0];
			$srno=$str[1];
			//echo $projectid." ".$srno;
			//exit(0);
			$tasks=DB::select("select * from Tasks where ProjectId=? and SrNo=?",array($projectid,$srno));
			$tasks=$tasks[0];
			$projects=DB::select("select * from Projects where ProjectId=?",array($projectid));
			$projectname=$projects[0]->ProjectTitle;				
			return view("student/updatetask",["sno"=>$tasks->SrNo,"msg"=>$msg,"task"=>$tasks->Task,"sdate"=>$tasks->StartDate,"asdate"=>$tasks->ActualStartDate,"cdate"=>$tasks->CompletionDate,"acdate"=>$tasks->ActualCompletionDate,"ainfo"=>$tasks->AdditionalInfo,"pid"=>$projectid,"projectname"=>$projectname,"status"=>$tasks->TaskStatus,"doc"=>$tasks->document]);
		}

	}
	//Review Tasks
	public function ReviewTask(Request $request)
    {		
		$prn=$request->session()->get("prn");
		$name=$request->session()->get("name");
		//$str=$prn." - ".$name;
		$projects=DB::select("select * from Projects where GroupMembers like '%$prn%' and GroupMembers like '%$name%'");
		$projectid=$projects[0]->ProjectId;				
		$projectname=$projects[0]->ProjectTitle;

		$tasks=DB::select("select * from Tasks where TaskStatus='Close' and ProjectId=? order by CompletionDate desc limit 5",array($projectid));
		
		return view("student/reviewtask",["tasks"=>$tasks,"projectname"=>$projectname]);

	}
	public function ChangePass(Request $request)
    {
    	$msg="";

    	if($request->btn)
    	{
			$prn=$request->session()->get("prn");
			$login=Student::find($prn);
			if($login->Password==$request->pass)
			{
				$login->Password=$request->pass1;
				$login->save();
				$msg="Your Password has been reset successfully...";
			}    		
    		else
    		{
    			$msg="Sorry! Wrong Old Password...";
				
			}			
			
    	}
    	return view("student/changepass",["msg"=>$msg]);

	}
	public function DownloadFile($fname)
	{
		return response()->download(public_path("uploads/".$fname));
	}

}
