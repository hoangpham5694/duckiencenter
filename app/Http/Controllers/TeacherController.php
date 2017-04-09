<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Http\Requests;
use App\Teacher;
use App\Agency;
use DateTime;
use App\Http\Requests\TeacherEditRequest;
class TeacherController extends Controller
{
    public function getTeacherList(){
    	return view('admin.teachers.list');
    }
    public function getTeacherListJson($max, $page){
    	$numberRecord= $max;
        $vitri =($page -1 ) * $numberRecord;
     //   $totalTeacher = Teacher::count();
    //    $numPages = $totalApp / $numberRecord +1;
    	$data = Teacher::select('id','username','email','name','dob','address','phone','status')->where('status','=','active')->orderBy('name','ASC')->limit($numberRecord)->offset($vitri)->get();
    	return $data;
    }
    public function getTeacherTotalJson(){
    	return Teacher::where('status','=','active')->count();
    }
    public function getTeacherAdd(){
        $agencies = Agency::select('id','name')->where('status','=','active')->get();
        //dd($agencies);
    	return view('admin.teachers.add',['agencies'=>$agencies]);
    }
    public function postTeacherAdd(Request $request){
        $teacher = new Teacher();
        $teacher->name = $request->txtname;
        $teacher->email = $request->txtemail;
        $teacher->phone = $request->txtphone;
        $teacher->dob = $request->txtdob;
        $teacher->address = $request->address;
        $teacher->password = Hash::make($request->txtpassword);
        $teacher->agency_id = $request->selectagency;
        $teacher->status= "active";
        $teacher->save();
        //$message = "<strong>Thêm giáo viên thành công</strong><br>Mã GV: "
        return redirect()->route('getTeacherListAdmin')->with(['flash_level'=>'alert-success','flash_message' => 'Thêm giáo viên thành công'] );
    }
    public function getTeacherEdit($id){
        $agencies = Agency::select('id','name')->where('status','=','active')->get();
        //dd($agencies);
        $teacher = Teacher::findOrFail($id)->toArray();
        return view('admin.teachers.edit',['agencies'=>$agencies, 'teacher'=>$teacher]);
    }
    public function postTeacherEdit(TeacherEditRequest $request, $id){
      //  $teacher = new Teacher();
        $teacher = Teacher::find($id);
        $teacher->name = $request->txtname;
        $teacher->email = $request->txtemail;
        $teacher->phone = $request->txtphone;
        $teacher->dob = $request->txtdob;
        $teacher->address = $request->address;
        if($request->txtpassword != null){
            $teacher->password = Hash::make($request->txtpassword);
        }
        
        $teacher->agency_id = $request->selectagency;
       
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
}
