<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Requests\StudentEditRequest;
use App\Student;
use App\Course;
use App\CourseStudent;
use App\Nation;
use App\Http\Requests\AddStudentRequest;
use Hash;
class StudentController extends Controller
{
    public function getListStudentAdmin(){
    	return view('admin.students.list');
    }
    public function getListStudentJson($max, $page, Request $request){
    	$numberRecord= $max;
        $vitri =($page -1 ) * $numberRecord;
        $key = $request->key;
        $orderby = $request->orderby;
        $sort = $request->sort;
    	$students = Student::select('id','username','firstname','lastname','gender','phone')
    	->where('status','=','active')
    	->where(function($query) use ($key){
            $query->where('username','LIKE','%'.$key.'%')
            ->orWhere('firstname','LIKE','%'.$key.'%')
            ->orWhere('lastname','LIKE','%'.$key.'%')
            ->orWhere('email','LIKE','%'.$key.'%')
            ->orWhere('phone','LIKE','%'.$key.'%')
            ->orWhere('parents_phone','LIKE','%'.$key.'%');
        })
        ->orderBy($orderby,$sort)->limit($numberRecord)->offset($vitri)->get();
        return $students;
    }
    public function getStudentTotalJson(){
    	return Student::where('status','=','active')->count();
    }
    public function getAddStudentAdmin(){
        $nations = Nation::select('id','name')->orderBy('name','ASC')->get();
        return view('admin.students.add', ['nations'=> $nations]);
    }
    public function getCheckUnique($username = ""){
        if($username == "") return "false";
        $students = Student::where('username','=',$username)->count();
        if($students >0){
            return 'false';
        }
        return 'true';
    }
    public function postAddStudentAdmin(AddStudentRequest $request){
        $student = new Student();
        $student->firstname = $request->txtfirstname;
        $student->lastname = $request->txtlastname;
        $student->name = $request->txtlastname.' '.$request->txtfirstname;
        $student->username = $request->txtusername;
        $student->gender = $request->selectgender;
        $student->username = $request->txtusername;
        $student->nation_id = $request->selectnation;
        $student->email = $request->txtemail;
        $student->phone = $request->txtphone;
        $student->parents_phone = $request->txtparentphone;
        $student->dob = $request->txtdob;
        $student->address = $request->txtaddress;
        $student->password = Hash::make($request->txtusername);
        $student->status= 'active';
        $student->save();
        $lastInsertId =  $student->id;
        $url = "adminsites/student/detail/".$lastInsertId;
       // $url = "adminsites/student/detail/7";
        return redirect($url)
        ->with(['flash_level'=>'alert-success','flash_message' => 'Thêm học viên thành công'] );

    }
    public function getStudentDetailAdmin($id){
        $student = Student::join('nations','nations.id','=','students.nation_id')
        ->select('students.firstname','students.lastname','students.id','students.phone','students.dob','students.gender','students.email','students.address','students.parents_phone','students.amount','nations.name')
        ->where('students.status','=','active')->findOrFail($id);
        $courses = CourseStudent::join('courses','courses.id','=','course_student.course_id')->join('teachers','teachers.id','=','courses.teacher_id') 
        ->select('courses.id','courses.name','courses.fee','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname')->where('courses.status','=','active')
        ->where('course_student.student_id','=',$id)->get();
        //dd($courses);
        return view('admin.students.detail',['student'=>$student,'courses'=>$courses]);
    }
    public function getStudentEditlAdmin($id){
        $student = Student::join('nations','nations.id','=','students.nation_id')->where('students.status','=','active')->findOrFail($id);
        $nations = Nation::select('id','name')->orderBy('name','ASC')->get();
        return view('admin.students.edit',['student'=>$student, 'nations'=>$nations]);

    }
    public function postStudentEditAdmin($id,StudentEditRequest $request){
        $student = Student::findOrFail($id);
        $student->firstname = $request->txtfirstname;
        $student->lastname = $request->txtlastname;
        $student->name = $request->txtlastname.' '.$request->txtfirstname;
        $student->username = $request->txtusername;
        $student->gender = $request->selectgender;

        $student->nation_id = $request->selectnation;
        $student->email = $request->txtemail;
        $student->phone = $request->txtphone;
        $student->parents_phone = $request->txtparentphone;
        $student->dob = $request->txtdob;
        $student->address = $request->txtaddress;

        if($request->txtpassword != null){
            $student->password = Hash::make($request->txtpassword);
        }
       
        $student->save();
        $url = "adminsites/student/detail/".$student->id;
       // $url = "adminsites/student/detail/7";
        return redirect($url)
        ->with(['flash_level'=>'alert-success','flash_message' => 'Sửa học viên thành công'] );

    }
    public function getStudentDelete($id){
        $student = Student::findOrFail($id);
        $student->status = "delete";
        $student->save();
    }
    public function getStudentDetailJson($id){
         $student = Student::findOrFail($id);
         return $student;
    }
    public function getListCoursesOfStudentJson($studentid){
         $courses = CourseStudent::join('courses','courses.id','=','course_student.course_id')->join('teachers','teachers.id','=','courses.teacher_id') 
        ->select('courses.id','courses.name','courses.fee','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname')->where('courses.status','=','active')
        ->where('course_student.student_id','=',$studentid)->get();
        return $courses;
    }

}
