<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Student;
use App\Tasks;
use App\Projects;
use DB;
use Mail;


class StaffController extends Controller
{

	//Index function - calls to index.php
    public function Index(Request $request)
    {
		$id=$request->session()->get("id");
		$role=$request->session()->get("role");
		$dept=$request->session()->get("dept");
		$count=0;
		$tcount=0;
		if($role=="Faculty")
		{
			$count=Projects::where('FacultyId',$id)->count();
			$tcount=Tasks::where('FacultyId',$id)->count();
		}
		else if($role=="Admin" || $role=="Dean")
		{
			$count=Projects::count();
			$tcount=Tasks::count();
		}
		else
		{
			$count=Projects::where('Dept',$dept)->count();
			$projects=Projects::where('Dept',$dept);
			foreach($projects as $project)
			{
				$tcount+=Tasks::where('ProjectId',$project->ProjectId)->count();
			}	

			
		}
		$projects=DB::select("select * from Projects");
		$uprojects=array();
		foreach($projects as $project)
		{		
			$t1=Tasks::where('ProjectId',$project->ProjectId)
					  ->where('TaskStatus','Close')
				 	  ->where('Sem',1) ->sum("Weightage");
			if($t1>50)
			$t1=50;
				 
			
			$t2=Tasks::where('ProjectId',$project->ProjectId)
					  ->where('TaskStatus','Close')
				 	  ->where('Sem',2) ->sum("Weightage");
			if($t2>50)
			$t2=50;
				
			
			$t=$t1+$t2;
			$uprojects[]=array(
				"ProjectId"=>$project->ProjectId,
				"ProjectTitle"=>$project->ProjectTitle,
				"Dept"=>$project->Dept,
				"Task"=>$t
			);
		}	
		$depts=array("IT","CSE","MECH","CIVIL","ELECTRICAL","AUTOMOBILE");
		$labels=array("bg-danger","bg-warning","bg-info","bg-success");	
    	return view("staff/index",["projct"=>$count,"taskct"=>$tcount,"projects"=>$uprojects,"labels"=>$labels,"depts"=>$depts]);
	}
	
	//Faculty Registration - Saves Faculty data
	public function Faculty(Request $request)
    {
    	$msg="";

    	if($request->btn)
    	{
			$obj=new User();
			$obj->prnno=$request->prnno;    		
    		$obj->name=$request->name;    					
			$obj->dept=$request->dept;
    		$obj->email=$request->user;
			$obj->password=$request->pass;
			$obj->role=$request->role;    		
    		$obj->save();   
    		$msg="Faculty Registered Successfully";
    		

    	}
    	return view("staff/faculty",["msg"=>$msg]);

	}
	public function EditFaculty(Request $request)
    {
		
		$id=$request->route("id");
		$user=User::find($id);		
    	return view("staff/efaculty",["msg"=>"","id"=>$id,"prnno"=>$user->prnno,"name"=>$user->name,"dept"=>$user->dept,"user"=>$user->email,"pass"=>$user->password,"role"=>$user->role]);

	}
	public function UpdateFaculty(Request $request)
    {    	
		$obj=User::find($request->id);
		$obj->prnno=$request->prnno;    		
		$obj->name=$request->name;    				
		$obj->dept=$request->dept;
		$obj->email=$request->user;
		$obj->password=$request->pass;
		$obj->role=$request->role;
		
		$obj->save();   
		$msg="Faculty Updated Successfully";
		
		return view("staff/efaculty",["msg"=>$msg,"id"=>$request->id,"prnno"=>$request->prnno,"name"=>$request->name,"dept"=>$request->dept,"user"=>$request->user,"pass"=>$request->pass,"role"=>$request->role]);
    	

	}
	public function FacultyList(Request $request)
    {
		$msg="";
    	$facultys=DB::select("select * from Users where Role!='Student'");
    	return view("staff/facultylist",["facultys"=>$facultys,"msg"=>$msg]);

	}

	public function CheckFacultyExists(Request $request)
	{
		$emailid=$request->user;
		$f=DB::select("Select * from Users where Email=?",[$emailid]);
		if(count($f))
		{
			return "false";
		}
		else
		{
			return "true";
		}
	}
	public function Student(Request $request)
    {
    	$msg="";

    	if($request->btn)
    	{
			$obj=new Student();
			$obj->prnno=$request->prnno;    		
    		$obj->name=$request->name;    					
			$obj->dept=$request->dept;
    		$obj->email=$request->user;
			$obj->password=$request->pass;			
    		
    		$obj->save();   
    		$msg="Student Registered Successfully";
    		

    	}
    	return view("staff/student",["msg"=>$msg]);

	}
	public function StudentList(Request $request)
    {
    	$studs=DB::select("select * from Students");
    	return view("staff/studentlist",["studs"=>$studs,"msg"=>""]);

	}
	public function EditStudent(Request $request)
    {
		
		$id=$request->route("id");
		$f=DB::select("Select * from Students where Id=?",[$id]);    	
    	return view("staff/estudent",["msg"=>"","id"=>$id,"prnno"=>$f[0]->prnno,"name"=>$f[0]->name,"dept"=>$f[0]->dept,"user"=>$f[0]->email,"pass"=>$f[0]->password]);

	}
	public function UpdateStudent(Request $request)
    {    	
		$obj=Student::find($request->id);
		$obj->prnno=$request->prnno;    		
		$obj->name=$request->name;    				
		$obj->dept=$request->dept;
		$obj->email=$request->user;
		$obj->password=$request->pass;		
		$obj->save();   
		$msg="Student Updated Successfully";
    	
    	return view("staff/estudent",["msg"=>$msg,"id"=>$request->id,"prnno"=>$request->prnno,"name"=>$request->name,"dept"=>$request->dept,"user"=>$request->user,"pass"=>$request->pass,"role"=>$request->role]);

	}

	public function CheckStudentExists(Request $request)
	{
		$emailid=$request->user;
		$f=DB::select("Select * from Students where Email=?",[$emailid]);
		if(count($f))
		{
			return "false";
		}
		else
		{
			return "true";
		}
	}

	public function RemoveFaculty(Request $request)
    {		
		$id=$request->route("id");
		$faculty = User::find($id);
		$faculty->delete();
    	return redirect()->action("StaffController@FacultyList");

	}
	public function RemoveStudent(Request $request)
    {		
		$id=$request->route("id");
		$stud = Student::find($id);
		$stud->delete();
    	return redirect()->action("StaffController@StudentList");

	}

	public function CreateProject(Request $request)
    {
    	$msg="";

    	if($request->btn)
    	{
    		$obj=new Projects();
    		$obj->projecttitle=$request->title;    		
			$obj->assigndate=$request->adate;			
			$prns=$request->fieldname;
			$names=$request->fieldvalue;
			$data=array();
			$i=0;
			foreach($prns as $prn)
			{
				$data[$prn]=$names[$i];
				$i++;
			}
			$obj->groupmembers=serialize($data);
			$obj->facultyid=$request->session()->get("id");
			$obj->facultyname=$request->session()->get("name");
			$obj->projectstatus="Assigned";
			$obj->dept=$request->session()->get("dept");;
    		
    		$obj->save();   
    		$msg="Project Created Successfully";    		

    	}
    	return view("staff/createproject",["msg"=>$msg]);

	}
	public function ProjectStatusList(Request $request)
    {

		$id=$request->session()->get("id");		
		$name=$request->session()->get("name");	
		$role=$request->session()->get("role");	
		$dept=$request->session()->get("dept");	

		if($role=="Faculty")
			$projects=DB::select("select * from Projects where FacultyId=$id");
		else if($role=="Admin" || $role=="Dean")
			$projects=DB::select("select * from Projects");
		else
			$projects=DB::select("select * from Projects where dept='$dept'");
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
				"ProjectStatus"=>$project->ProjectStatus,
				"Dept"=>$project->Dept
			);

			
		}		
    	return view("staff/projectstatus",["projects"=>$uprojects]);
	}
	public function ProjectProgress(Request $request)
    {
		$id=$request->session()->get("id");		
		$name=$request->session()->get("name");	
		$role=$request->session()->get("role");	
		$dept=$request->session()->get("dept");	

		if($role=="Faculty")
			$projects=DB::select("select * from Projects where FacultyId=$id");
		else if($role=="Admin" || $role=="Dean")
			$projects=DB::select("select * from Projects");
		else
			$projects=DB::select("select * from Projects where dept='$dept'");
		$uprojects=array();

		foreach($projects as $project)
		{		
			$t1=Tasks::where('ProjectId',$project->ProjectId)
					  ->where('TaskStatus','Close')
				 	  ->where('Sem',1) ->sum("Weightage");
			if($t1>50)
			$t1=50;
				 
			
			$t2=Tasks::where('ProjectId',$project->ProjectId)
					  ->where('TaskStatus','Close')
				 	  ->where('Sem',2) ->sum("Weightage");
			if($t2>50)
			$t2=50;
				
			
			$t=$t1+$t2;
			$uprojects[]=array(
				"ProjectId"=>$project->ProjectId,
				"ProjectTitle"=>$project->ProjectTitle,
				"Dept"=>$project->Dept,
				"Task"=>$t				
			);
		}	
		$depts=array("IT","CSE","MECH","CIVIL","ELECTRICAL","AUTOMOBILE");
		$labels=array("bg-danger","bg-warning","bg-info","bg-success");	
    	return view("staff/projectprogress",["projects"=>$uprojects,"labels"=>$labels,"depts"=>$depts]);
	}
	
	public function ProjectDetails(Request $request)
    {
		$projectid=$request->route("id");

		$projects=DB::select("select * from Projects where ProjectId=:projectid",array("projectid"=>$projectid));
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
    	return view("staff/projectdetails",["projects"=>$uprojects]);
	}
	public function TaskNew(Request $request)
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
    	return view("staff/taskdetail",["msg"=>$msg,"tasks"=>$tasks,"pid"=>$projectid,"projectname"=>$projectname]);

	}
	
	
	//Define Task Module
	public function CreateTask(Request $request)
    {
		$msg="";
		$pid="";

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

			$srno=Tasks::where("projectid",$request->pid)->max("srno")+1;
			$obj=new Tasks();
			$obj->projectid=$request->pid;    		
			$pid=$request->pid;    		
			$obj->srno=$srno;    		
			$obj->task=$request->task;    		
			$obj->startdate=$request->startdate;			
			$obj->actualstartdate=$request->astartdate;
			$obj->completiondate=$request->cdate;			
			$obj->actualcompletiondate=$request->acdate;						
			$obj->taskstatus="Open";			
			$obj->additionalinfo=$request->ainfo;
			$obj->FacultyId=$request->session()->get("id");			
			$obj->sem=$request->sem;
			$obj->Role=$request->session()->get("role");
			$obj->document=$fname;
			$obj->weightage=$request->weight;;								
			$obj->save();  
			//Send Mail to Student 
			$proj=Projects::find($request->pid);			
			$members=unserialize($proj->GroupMembers);
			$emails=array();
			foreach($members as $key=>$value)
			{
				$studs=DB::select("select * from Students where PRNNo=?",array($key));
				$emails[]=$studs[0]->email;								
			}			
			$subject="New Task Assigned";
			$data=array("task"=>$request->task,"subject"=>$subject,"completiondate"=>$request->cdate);		
			
			$this->SendMail($emails,$data);
    		$msg="Task Created Successfully"; 
		}		
		
    	return redirect()->action("StaffController@ShowTask",["id"=>$pid])->with("msg",$msg);

	}
	//Send mail to given emailIDs
	public function SendMail($emails,$data)
	{
		$to_name = $emails;
		$to_email = $emails;		
		Mail::send("emails.mail", $data, function($message) use ($to_name, $to_email,$data) {
			$message->to($to_email, $to_name)->subject($data["subject"]);
			$message->from("pmmsrit20@gmail.com",$data["subject"]);
		});	

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
    	return view("staff/task",["msg"=>$msg,"tasks"=>$tasks,"pid"=>$projectid,"projectname"=>$projectname]);

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
				$fname=$request->ffname;
			}
			$arr=[$request->task,$request->startdate,$request->astartdate,$request->cdate,$request->acdate,$request->ainfo,$request->status,$fname,$request->weight,$request->pid,$request->srno];
			//print_r($arr);
			//exit(0);
			DB::update("Update Tasks set Task=?,StartDate=?,ActualStartDate=?,CompletionDate=?,ActualCompletionDate=?,AdditionalInfo=?,TaskStatus=?,document=?,weightage=? where ProjectID=? and SrNo=?",$arr);
			$msg="Task Updated Successfully";
			return redirect()->action("StaffController@ShowTask",["id"=>$request->pid]);

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
			return view("staff/updatetask",["sno"=>$tasks->SrNo,"msg"=>$msg,"task"=>$tasks->Task,"sdate"=>$tasks->StartDate,"asdate"=>$tasks->ActualStartDate,"cdate"=>$tasks->CompletionDate,"acdate"=>$tasks->ActualCompletionDate,"ainfo"=>$tasks->AdditionalInfo,"pid"=>$projectid,"projectname"=>$projectname,"status"=>$tasks->TaskStatus,"doc"=>$tasks->document,"weight"=>$tasks->Weightage]);
		}

	}
	public function RemoveTask(Request $request)
    {		
		$id=$request->route("id");		
		$str=explode("_",$id);
		$projectid=$str[0];
		$srno=$str[1];
		//echo $projectid." ".$srno;
		//exit(0);
		DB::delete("delete from Tasks where ProjectId=? and SrNo=?",array($projectid,$srno));
		
    	return redirect()->action("StaffController@ShowTask",["id"=>$projectid]);

	}
	//Review Tasks
	public function ReviewTask(Request $request)
    {
		$id=$request->session()->get("id");				
		$role=$request->session()->get("role");	
		$dept=$request->session()->get("dept");	
		
		$projects=DB::select("select * from Projects where FacultyId=$id");
		$str="";
		$projs=array();
		foreach($projects as $project)
		{	
			$str.=$project->ProjectId.",";
			$projs[$project->ProjectId]=$project->ProjectTitle;
		}
		if($str!="")
		{
			$str=substr($str,0,strlen($str)-1);
		}
		$projectid=$request->route("id");
		$tasks=DB::select("select * from Tasks where TaskStatus='Close' and ProjectId in ($str) order by CompletionDate desc limit 5");
		
		return view("staff/reviewtask",["tasks"=>$tasks,"projs"=>$projs]);

	}
	
	public function ChangePass(Request $request)
    {
    	$msg="";

    	if($request->btn)
    	{
			$id=$request->session()->get("id");
			$user=User::find($id);
			if($user->password==$request->pass)
			{
				$user->password=$request->pass1;
				$user->save();
				$msg="Your Password has been reset successfully...";
			}    		
    		else
    		{
    			$msg="Sorry! Wrong Old Password...";
				
			}			
			
    	}
    	return view("staff/changepass",["msg"=>$msg]);

	}

	public function ImportCSV(Request $request)
    {
		$msg="";
		$file=$request->file("file1");
		if($file!=null)
        {
            $fname=$file->getClientOriginalName();
			$file->move("uploads",$fname);
			$fp=fopen("uploads/$fname","r");
			while(!feof($fp))
			{
				$arr=fgetcsv($fp);
				if(!empty($arr[0]))
				{
					$f=DB::select("Select * from Users where Email=?",[$arr[4]]);
					if(count($f)==0)
					{
						DB::insert("Insert into Users (Prnno,Name,Dept,Email,Password,Role) values(?,?,?,?,?,?)",[$arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5]]);
					}
				}
			}
			fclose($fp);
    		$msg="Faculty CSV file is imported successfully";

		}		
		return redirect()->action("StaffController@FacultyList")->with('msg', 'Data imported!');;
		
	}
	public function ImportSCSV(Request $request)
    {
		$msg="";
		$file=$request->file("file1");
		if($file!=null)
        {
            $fname=$file->getClientOriginalName();
			$file->move("uploads",$fname);
			$fp=fopen("uploads/$fname","r");
			while(!feof($fp))
			{
				$arr=fgetcsv($fp);
				if(!empty($arr[0]))
				{
					$f=DB::select("Select * from Students where Email=?",[$arr[4]]);
					if(count($f)==0)
					{
						DB::insert("Insert into Students (Prnno,Name,Dept,Email,Password) values(?,?,?,?,?)",[$arr[0],$arr[1],$arr[2],$arr[3],$arr[4]]);
					}
				}
			}
			fclose($fp);
    		$msg="Student CSV file is imported successfully";

		}		
		return redirect()->action("StaffController@StudentList")->with('msg', 'Data imported!');;
		
	}
	public function FacultyProfile(Request $request)
    {
		$msg="";
		$name="";
		$prnno="";
		$dept="";
		$user="";
		$role="";
		$id=$request->session()->get("id");
		$obj=User::find($id);		
    	if($request->btn)
    	{
			$prnno=$request->prnno;
			$name=$request->name;			
			$dept=$request->dept;
			$user=$request->user;
			$role=$request->role;
			$pass=$request->pass;
			
			$obj->prnno=$prnno;    		
    		$obj->name=$name;    					
			$obj->dept=$dept;
			$obj->email=$user;
			$obj->role=$role;
			$obj->password=$pass;
    		
    		$obj->save();   
    		$msg="Faculty Profile Updated Successfully";    		

		}
		else
		{
			
			$msg="";			
			$prnno=$obj->prnno;
			$name=$obj->name;			
			$dept=$obj->dept;
			$user=$obj->email;
			$pass=$obj->password;
			$role=$obj->role;
		}
    	return view("staff/profile",["msg"=>$msg,"id"=>$id,"prnno"=>$prnno,"name"=>$name,"dept"=>$dept,"user"=>$user,"pass"=>$pass,"role"=>$role]);
	}
	public function DownloadFile($fname)
	{
		return response()->download(public_path("uploads/".$fname));
	}	

}
