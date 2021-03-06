<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Course;
use App\Teacher;
use App\Agency;
use App\Student;
use App\CourseStudent;
use App\Http\Requests\CourseAddRequest;
use App\Http\Requests\CourseEditRequest;
class CourseController extends Controller
{
    public function getCourseListAdmin(){
    	return view('admin.courses.list');
    }
    public function getCourseListManager(){
        return view('manager.courses.list');
    }
    public function getListAllCourseStudent($method)
    {
         return view('student.courses.list',['method'=>$method]);
    }
    public function getCourseListIndividualJson(Request $request)
    {
        $user =  Auth::guard('students')->user();
         $keyword = $request->keyword;
        $numberRecord= $request->max;
        $agencyId =$request->agencyid;
        $teacherId = $request->teacherid;
        $page = $request->page;
        if($agencyId == ""){
            $agencyId = null;
        }
        if($teacherId == ""){
            $teacherId = null;
        }
        $vitri =($page -1 ) * $numberRecord;

           $data = Course::
           join('agencies','agencies.id','=','courses.agency_id')
           ->join('teachers','teachers.id','=','courses.teacher_id')
         ->rightJoin('course_student','course_student.course_id','=','courses.id')
           ->select('agencies.name as agency_name','courses.id','courses.name','courses.max_students','courses.fee','courses.status','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname')
            ->where('courses.status','=','active')
            ->where('course_student.student_id','=',$user->id)
        ->where(function($query) use ($keyword){
            $query->where('courses.name','LIKE','%'.$keyword.'%');
            })
           ->where('courses.agency_id','LIKE', $agencyId)
            ->where('courses.teacher_id','LIKE', $teacherId)
            ->orderBy('courses.id','DESC')->limit($numberRecord)->offset($vitri)
           ->groupBy('courses.id')
            ->get();
        
        return $data;


    }
    public function getCourseTotalIndividualJson()
    {
         $user =  Auth::guard('students')->user();
         $data = Course::
           join('teachers','teachers.id','=','courses.teacher_id')
         ->  rightJoin('course_student','course_student.course_id','=','courses.id')
          
            ->where('courses.status','=','active')
            ->where('course_student.student_id','=',$user->id)
       
            ->count();
        return $data;
    }
    public function getCourseListJson(Request $request){
        $keyword = $request->keyword;
    	$numberRecord= $request->max;
        $agencyId =$request->agencyid;
        $teacherId = $request->teacherid;
    	$page = $request->page;
        if($agencyId == ""){
            $agencyId = null;
        }
        if($teacherId == ""){
            $teacherId = null;
        }
        $vitri =($page -1 ) * $numberRecord;
     //   $totalTeacher = Teacher::count();
    //    $numPages = $totalApp / $numberRecord +1;

           $data = Course::join('agencies','agencies.id','=','courses.agency_id')
           ->join('teachers','teachers.id','=','courses.teacher_id')
           ->select('courses.id','courses.name','courses.max_students','courses.fee','agencies.name as agency_name','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname','courses.status')
            ->where('courses.status','=','active')
            ->where(function($query) use ($keyword){
            $query->where('courses.name','LIKE','%'.$keyword.'%');
            })
            ->where('courses.agency_id','LIKE', $agencyId)
            ->where('courses.teacher_id','LIKE', $teacherId)
            ->orderBy('courses.id','DESC')->limit($numberRecord)->offset($vitri)->get();
        
    	return $data;
    }
    public function getCourseTotalJson(){
    	return Course::where('status','=','active')->count();
    }
    public function getCourseAddAdmin(){
        $agencies = Agency::select('id','name')->where('status','=','active')->get();
        //dd($agencies);
        $teachers = Teacher::select('id','name')->where('status','=','active')->get();
    	return view('admin.courses.add',['agencies'=>$agencies, 'teachers' => $teachers]);
    }
    public function postCourseAddAdmin(CourseAddRequest $request){
    	$course = new Course();
    	$course->name= $request->txtName;
		$course->max_students= $request->txtMaxStudent;
		$course->fee = $request->txtFee;
		$course->opening_date = $request->txtOpeningDate;
		$course->agency_id = $request->selectagency;
        $course->description = $request->txtDescription;
		$course->teacher_id = $request->selectTeacher;
		$course->status = "active";
		$course->save();	
		return redirect()->route('getCourseListAdmin')->with(['flash_level'=>'alert-success','flash_message' => 'Thêm lớp học thành công'] );
	
    }
    public function getCourseEditAdmin($id){
        $agencies = Agency::select('id','name')->where('status','=','active')->get();
        //dd($agencies);
        $teachers = Teacher::select('id','name')->where('status','=','active')->get();
        $course = Course::findOrFail($id)->toArray();
        return view('admin.courses.edit',['course'=>$course,'agencies'=>$agencies, 'teachers'=>$teachers]);
    }
    public function postCourseEditAdmin($id, CourseEditRequest $request){
        $course = Course::find($id);
        $course->name= $request->txtName;
        $course->max_students= $request->txtMaxStudent;
        $course->fee = $request->txtFee;
        $course->opening_date = $request->txtOpeningDate;
        $course->agency_id = $request->selectagency;
        $course->teacher_id = $request->selectTeacher;
        $course->description = $request->txtDescription;
        $course->save();    
        return redirect()->route('getCourseListAdmin')->with(['flash_level'=>'alert-success','flash_message' => 'Sửa lớp học thành công'] );

    }
    public function getCourseDelete($id){
         $course = Course::find($id);
         $course->status = "delete";
         $course->save();
    }
    public function getCourseDetailAdmin($id){
        $course = Course::join('agencies','agencies.id','=','courses.agency_id')->join('teachers','teachers.id','=','courses.teacher_id')->select('courses.id','courses.name','courses.max_students','courses.fee','agencies.name as agency_name','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname','courses.status')->where('courses.status','=','active')->find($id);

        return view('admin.courses.detail',['course'=>$course]);
    }
     public function getCourseDetailManager($id){
        $course = Course::join('agencies','agencies.id','=','courses.agency_id')->join('teachers','teachers.id','=','courses.teacher_id')->select('courses.id','courses.name','courses.max_students','courses.fee','agencies.name as agency_name','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname','courses.status')->where('courses.status','=','active')->find($id);

        return view('manager.courses.detail',['course'=>$course]);
    }
    public function getCourseStudentsListJsonAdmin($id){
        $students = CourseStudent::join('students','students.id','=','course_student.student_id')
        ->select('course_student.id','students.username','students.firstname','students.lastname','students.phone','students.parents_phone','course_student.course_id','course_student.student_id','course_student.created_at')
        ->where('course_student.course_id','=',$id)->get();
        return json_encode($students);
    }
    public function getAllStudentsNotInCourseListJsonAdmin($id,Request $request){
        //$students = CourseStudent::join('students','students.id','=','course_student.student_id')->select('course_student.id','students.username','students.name','students.phone','students.parents_phone','course_student.course_id','course_student.student_id','course_student.created_at')->where('course_student.course_id','=',$id)->get();
        $numberRecord= 20;
        $keyword = $request->keyword;
        $students = Student::select('students.username','students.name','students.id')->whereNotIn('id', function($query) use($id){
            $query->select('student_id')->from('course_student')
                        ->where('course_id','=',$id);

        })->where('status','=','active')
        ->where(function($query) use ($keyword){
            $query->where('username','LIKE','%'.$keyword.'%')
            ->orWhere('name','LIKE','%'.$keyword.'%')
            ->orWhere('email','LIKE','%'.$keyword.'%')
            ->orWhere('phone','LIKE','%'.$keyword.'%')
            ->orWhere('parents_phone','LIKE','%'.$keyword.'%');
        })
        ->limit($numberRecord)->get();
        return json_encode($students);
    }
    public function getAddStudentToCourseAdmin($courseid,$studentid){
        $countCourseStudents = CourseStudent::where('course_id','=',$courseid)
        ->where('student_id','=',$studentid)->count();
        if($countCourseStudents >0){
            return "Học viên đang học tại lớp này";
        }
        $course = Course::select('max_students')->where('id','=',$courseid)->first();;

    //    dd(CourseStudent::where('course_id','=',$courseid)->count());
        if(CourseStudent::where('course_id','=',$courseid)->count() >= $course->max_students){
            return "Quá số lượng đăng ký";
        }
        $courseStudent = new CourseStudent();
        $courseStudent->student_id = $studentid;
        $courseStudent->course_id= $courseid;
        $courseStudent->status= "active";
        $courseStudent->save();
        return "Thêm học viên vào lớp học thành công";
    }
    public function getDeleteStudentCourseAdmin($id){
        CourseStudent::where('id','=',$id)->delete();
        return "Xóa học viên khỏi lớp học thành công";
    }

    public function getFeeListCoursesAdmin(){
        return view('admin.fees.list_course');
    }
    public function getListAgenciesJson(){
        $agencies = Agency::select('id','name')->get();
        return $agencies;
    }
    public function getListCourseIndividualTeacher()
    {
        return view('teacher.courses.list-individual');
    }
    public function getListCourseIndividualTeacherJson(Request $request)
    {
        $keyword = $request->keyword;
        $numberRecord= $request->max;
        $agencyId =$request->agencyid;
        $teacher =  Auth::guard('teachers')->user();
        $teacherId = $teacher->id;
        $page = $request->page;
        if($agencyId == ""){
            $agencyId = null;
        }
        if($teacherId == ""){
            $teacherId = null;
        }
        $vitri =($page -1 ) * $numberRecord;
     //   $totalTeacher = Teacher::count();
    //    $numPages = $totalApp / $numberRecord +1;

           $data = Course::join('agencies','agencies.id','=','courses.agency_id')
           ->join('teachers','teachers.id','=','courses.teacher_id')
           ->select('courses.id','courses.name','courses.description','courses.max_students','courses.fee','agencies.name as agency_name','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname','courses.status')
            ->where('courses.status','=','active')
            ->where(function($query) use ($keyword){
            $query->where('courses.name','LIKE','%'.$keyword.'%');
            })
            ->where('courses.agency_id','LIKE', $agencyId)
            ->where('courses.teacher_id','LIKE', $teacherId)
            ->orderBy('courses.id','DESC')->limit($numberRecord)->offset($vitri)->get();
        
        return json_encode($data);
    }
    public function getCourseIndividualTotalJson(){
         $teacher =  Auth::guard('teachers')->user();
        return Course::where('status','=','active')->where('teacher_id','=',$teacher->id)->count();
    }

    public function getCourseDetailTeacher($id)
    {
        $course = Course::join('agencies','agencies.id','=','courses.agency_id')->join('teachers','teachers.id','=','courses.teacher_id')->select('courses.id','courses.name','courses.max_students','courses.description','courses.fee','agencies.name as agency_name','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname','courses.status')->where('courses.status','=','active')->find($id);
        return view('teacher.courses.detail',['course'=>$course]);
    }
    public function getCourseDetailStudent($id)
    {
        $course = Course::join('agencies','agencies.id','=','courses.agency_id')->join('teachers','teachers.id','=','courses.teacher_id')->select('courses.id','courses.name','courses.max_students','courses.description','courses.fee','agencies.name as agency_name','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname','courses.status')->where('courses.status','=','active')->find($id);
        return view('student.courses.detail',['course'=>$course]);
    }

}
