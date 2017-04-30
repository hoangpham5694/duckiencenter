<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Http\Requests;
use App\Teacher;
use App\SalaryLevel;
use DateTime;
use App\Http\Requests\TeacherEditRequest;
use App\Course;
class TeacherController extends Controller
{
    public function getTeacherList(){
    	return view('admin.teachers.list');
    }
    public function getTeacherListJson($max, $page,Request $request){
        $key = $request->key;
        $orderby = $request->orderby;
        $sort = $request->sort;
    	$numberRecord= $max;
        $vitri =($page -1 ) * $numberRecord;
     //   $totalTeacher = Teacher::count();
    //    $numPages = $totalApp / $numberRecord +1;
    	$data = Teacher::select('id','username','email','firstname','lastname','dob','address','phone','status')
        ->where('status','=','active')
        ->where(function($query) use ($key){
            $query->where('username','LIKE','%'.$key.'%')
            ->orWhere('firstname','LIKE','%'.$key.'%')
            ->orWhere('lastname','LIKE','%'.$key.'%')
            ->orWhere('email','LIKE','%'.$key.'%')
            ->orWhere('phone','LIKE','%'.$key.'%');
        })
        ->orderBy($orderby,$sort)
        ->limit($numberRecord)->offset($vitri)->get();
    	return $data;
    }
    public function getTeacherTotalJson(){
    	return Teacher::where('status','=','active')->count();
    }
    public function getTeacherAdd(){
        $salaryLevels = SalaryLevel::select('id','percent')->get();
        //dd($agencies);
    	return view('admin.teachers.add',['salaryLevels'=>$salaryLevels]);
    }
    public function postTeacherAdd(Request $request){
        $teacher = new Teacher();
        $teacher->firstname = $request->txtfirstname;
        $teacher->lastname = $request->txtlastname;
        $teacher->email = $request->txtemail;
        $teacher->phone = $request->txtphone;
        $teacher->dob = $request->txtdob;
        $teacher->address = $request->address;
        $teacher->degree = $request->selectdegree;
      //  $teacher->salary_level_id = $request->selectsalarylevel;
        $teacher->salary_level_id = 1;
        $teacher->diploma = $request->txtdiploma;
        $teacher->skill = $request->txtskill;
        $teacher->work_history = $request->txtworkhistory;
        $teacher->amount = $request->txtamount;
        $file = $request->file('fileimage');
     //   dd(strlen($file));
        if(strlen($file) >0){
            $filename = str_slug($request->txtlasttname, "-").'-'.str_slug($request->txtfirstname, "-").time().'_'.$file->getClientOriginalName();
            $destinationPath = 'upload/teacherimages';
            $file->move($destinationPath,$filename);
            $teacher->image= $filename;
        }
        $teacher->password = Hash::make($request->txtpassword);
        
        $teacher->status= "active";
        $teacher->save();

        //$message = "<strong>Thêm giáo viên thành công</strong><br>Mã GV: "
        return redirect()->route('getTeacherListAdmin')->with(['flash_level'=>'alert-success','flash_message' => 'Thêm giáo viên thành công'] );
    }
    public function getTeacherEdit($id){
     //   $agencies = Agency::select('id','name')->where('status','=','active')->get();
        //dd($agencies);
        $salaryLevels = SalaryLevel::select('id','percent')->get();
        $teacher = Teacher::findOrFail($id)->toArray();
        return view('admin.teachers.edit',['salaryLevels'=>$salaryLevels, 'teacher'=>$teacher]);
    }
    public function postTeacherEdit(TeacherEditRequest $request, $id){
      //  $teacher = new Teacher();
        $teacher = Teacher::find($id);
        $teacher->firstname = $request->txtfirstname;
        $teacher->lastname = $request->txtlastname;
        $teacher->email = $request->txtemail;
        $teacher->phone = $request->txtphone;
        $teacher->dob = $request->txtdob;
        $teacher->address = $request->txtaddress;
        $teacher->degree = $request->selectdegree;
      //  $teacher->salary_level_id = $request->selectsalarylevel;
        $teacher->salary_level_id = 1;
        $teacher->diploma = $request->txtdiploma;
        $teacher->skill = $request->txtskill;
        $teacher->work_history = $request->txtworkhistory;
        $teacher->amount = $request->txtamount;
        $file = $request->file('fileimage');
       // dd(strlen($file));
        if(strlen($file) >0){
            $filename = str_slug($request->txtlasttname, "-").'-'.str_slug($request->txtfirstname, "-").time().'_'.$file->getClientOriginalName();
            $destinationPath = 'upload/teacherimages';
            $file->move($destinationPath,$filename);
            $teacher->image= $filename;
        }


        if($request->txtpassword != null){
            $teacher->password = Hash::make($request->txtpassword);
        }
        
   
       
        $teacher->save();
        //$message = "<strong>Thêm giáo viên thành công</strong><br>Mã GV: "
        return redirect()->route('getTeacherListAdmin')->with(['flash_level'=>'alert-success','flash_message' => 'Sửa giáo viên thành công'] );
    }
    public function getTeacherDelete($id){

        $teacher = Teacher::find($id);
        $teacher->status = "delete";
        $teacher->save();
        $message="Xoá thành công giáo viên ".$teacher->username;
        return $message;
    }
    public function getTeacherDetailAdmin($id){
     //   $agencies = Agency::select('id','name')->where('status','=','active')->get();
        //dd($agencies);
      //  $salaryLevels = SalaryLevel::select('id','percent')->get();
        $teacher = Teacher::join('salary_level','teachers.salary_level_id','=','salary_level.id')->findOrFail($id)->toArray();
        $courses = Course::select('id','name')->where('teacher_id','=',$id)->get();
      //  dd($teacher);
        //  return $teacher;
        return view('admin.teachers.detail',['teacher'=>$teacher,'courses' => $courses]);
    }
}
