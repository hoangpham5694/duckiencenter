<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function getCourseListJson(Request $request){
        $keyword = $request->keyword;
    	$numberRecord= $request->max;
    	$page = $request->page;
        $vitri =($page -1 ) * $numberRecord;
     //   $totalTeacher = Teacher::count();
    //    $numPages = $totalApp / $numberRecord +1;
    	$data = Course::join('agencies','agencies.id','=','courses.agency_id')->join('teachers','teachers.id','=','courses.teacher_id')->select('courses.id','courses.name','courses.max_students','courses.fee','agencies.name as agency_name','teachers.name as teacher_name','courses.status')->where('courses.status','=','active')
        ->where(function($query) use ($keyword){
            $query->where('courses.name','LIKE','%'.$keyword.'%');

        })
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

        $course->save();    
        return redirect()->route('getCourseListAdmin')->with(['flash_level'=>'alert-success','flash_message' => 'Sửa lớp học thành công'] );

    }
    public function getCourseDelete($id){
         $course = Course::find($id);
         $course->status = "delete";
         $course->save();
    }
    public function getCourseDetailAdmin($id){
        $course = Course::join('agencies','agencies.id','=','courses.agency_id')->join('teachers','teachers.id','=','courses.teacher_id')->select('courses.id','courses.name','courses.max_students','courses.fee','agencies.name as agency_name','teachers.name as teacher_name','courses.status')->where('courses.status','=','active')->find($id);

        return view('admin.courses.detail',['course'=>$course]);
    }
    public function getCourseStudentsListJsonAdmin($id){
        $students = CourseStudent::join('students','students.id','=','course_student.student_id')->select('course_student.id','students.username','students.name','students.phone','students.parents_phone','course_student.course_id','course_student.student_id','course_student.created_at')->where('course_student.course_id','=',$id)->get();
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

}
