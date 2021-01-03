<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use App\User;
use App\Student;


class IndexController extends Controller
{
	
	//Index Action to display index page
    public function Index()
    {
    	return view("index");
	}

	//Login Action
	public function Login(Request $request)
    {		
    	$msg="";

    	if($request->btn)
    	{
			$users=User::whereRaw("email=? and password=? and role!=?",array($request->user,$request->pass,"Student"))->get();			
    		if(count($users)>0)
    		{
				
				$user=$users[0];				
				$request->session()->put("id",$user->id);
				$request->session()->put("prn",$user->prnno);
				$request->session()->put("name",$user->name);
				$request->session()->put("dept",$user->dept);
				$request->session()->put("user",$user->email);
				echo "Role ".$request->role;
				$request->session()->put("role",$user->role);
    			return redirect()->action("StaffController@Index");
    		}
    		else
    		{
    			$msg="Login Failed try again...";
				return view("login",["msg"=>$msg]);
    		}


    	}
    	else
    	{
    		return view("login",["msg"=>$msg]);
    	}
	}	
	//Staff Logout Action
	public function Logout(Request $request)
    {
		$request->session()->forget('id');    	
		$request->session()->forget('user');    	
		$request->session()->forget('prn');
		$request->session()->forget('name');
		$request->session()->forget('dept');
		if($request->session()->get("role")=="Student")		
			return redirect()->action("IndexController@StudentLogin");
		else
			return redirect()->action("IndexController@Login");
	}
	//Student Login Action
	public function StudentLogin(Request $request)
    {		
    	$msg="";

    	if($request->btn)
    	{
    		$users=Student::whereRaw("email=? and password=?",array($request->user,$request->pass))->get();
    		if(count($users)>0)
    		{
				$stud=$users[0];
				$request->session()->put("id",$stud->id);
				$request->session()->put("prn",$stud->prnno);
				$request->session()->put("name",$stud->name);
				$request->session()->put("user",$request->user);
				$request->session()->put("dept",$stud->dept);								
    			return redirect()->action("StudentController@Index");
    		}
    		else
    		{
    			$msg="Login Failed try again...";
				return view("student",["msg"=>$msg]);
    		}


    	}
    	else
    	{
    		return view("student",["msg"=>$msg]);
    	}
	}
	
	

}
