<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

# IndexController Mapping
Route::get("/","IndexController@Index");
Route::any("/login","IndexController@Login");
Route::any("/studlogin","IndexController@StudentLogin");
Route::any("/logout","IndexController@Logout");


# StaffController Mapping
Route::any("/staffindex","StaffController@Index");
Route::any("/facultyreg","StaffController@Faculty");
Route::any("/facultylist","StaffController@FacultyList");
Route::any("/efaculty/{id}","StaffController@EditFaculty");
Route::any("/efacultyupdate","StaffController@UpdateFaculty");
Route::any("/studentreg","StaffController@Student");
Route::any("/studentlist","StaffController@StudentList");
Route::any("/estudent/{id}","StaffController@EditStudent");
Route::any("/estudentupdate","StaffController@UpdateStudent");
Route::any("/removestudent/{id}","StaffController@RemoveStudent");
Route::any("/removefaculty/{id}","StaffController@RemoveFaculty");

Route::any("/createproject","StaffController@CreateProject");
Route::any("/projectstatuslist","StaffController@ProjectStatusList");
Route::any("/projectprogress","StaffController@ProjectProgress");
Route::any("/projectdetails/{id}","StaffController@ProjectDetails");
Route::any("/tasknew/{id}","StaffController@taskNew");
Route::any("/createtask","StaffController@CreateTask");
Route::any("/showtask/{id}","StaffController@ShowTask");
Route::any("/updatetask2/{id}","StaffController@UpdateTask");
Route::any("/fupdatetask","StaffController@UpdateTask");
Route::any("/removetask/{id}","StaffController@RemoveTask");
Route::any("/freview","StaffController@ReviewTask");

Route::any("/changepass","StaffController@ChangePass");
Route::any("/importfcsv","StaffController@ImportCSV");
Route::any("/importscsv","StaffController@ImportSCSV");
Route::any("/checkfacultyexists","StaffController@CheckFacultyExists");
Route::any("/checkstudentexists","StaffController@CheckStudentExists");
Route::any("/profile","StaffController@FacultyProfile");
Route::any("/download2/{fname}","StaffController@DownloadFile");


# StudentController Mapping
Route::any("/studindex","StudentController@Index");
Route::any("/sprojectstatuslist","StudentController@ProjectStatusList");
Route::any("/sprojectdetails/{id}","StudentController@ProjectDetails");
Route::any("/sshowtask/{id}","StudentController@ShowTask");
Route::any("/updatetask/{id}","StudentController@UpdateTask");
Route::any("/supdatetask","StudentController@UpdateTask");
Route::any("/schangepass","StudentController@ChangePass");
Route::any("/suprofile","StudentController@StudentProfile");
Route::any("/download/{fname}","StudentController@DownloadFile");
Route::any("/sreview","StudentController@ReviewTask");

Route::get('/home', 'HomeController@index')->name('home');
