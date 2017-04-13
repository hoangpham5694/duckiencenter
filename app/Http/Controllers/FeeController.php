<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use App\Payment;
use App\CourseMonthLy;
use App\CourseStudent;
use App\StudentCourseMonthly;
use App\Month;
class FeeController extends Controller
{
    public function getFeeCourseDetailAdmin($id){
    	$course = Course::join('agencies','agencies.id','=','courses.agency_id')->join('teachers','teachers.id','=','courses.teacher_id')->select('courses.id','courses.name','courses.max_students','courses.fee','agencies.name as agency_name','teachers.name as teacher_name','courses.status')->where('courses.status','=','active')->find($id);

        return view('admin.fees.detail_course',['course'=>$course]);
    }
    public function getFeeListCourseMonthlyAdmin($courseid){
    	$courseMonthly = CourseMonthLy::join('months','course_monthly.month_id','=','months.id')->select('course_monthly.id', 'months.name','course_monthly.course_id')->where('course_monthly.course_id','=',$courseid)->where('course_monthly.status','=','active')->orderBy('course_monthly.id','DESC')->get();
    //	dd($courseMonthly);
    	return json_encode($courseMonthly);
    }
    public function getFeeListStudentCourseMonthly($coursemonthlyid){
    	$student = StudentCourseMonthly::join('students','students.id','=','student_course_monthly.student_id')->select('student_course_monthly.id','students.username','students.id as student_id','students.firstname','students.lastname','student_course_monthly.is_fee')->where('student_course_monthly.month_id','=',$coursemonthlyid)->where('student_course_monthly.status','=','active')->orderBy('students.firstname','ASC')->get();
    	return json_encode($student);
    }
    public function getRefreshMonthly($courseid){
    	$monthly = CourseMonthLy::select('id','course_id','month_id')->where('course_id','=',$courseid)->where('status','=','active')->orderBy('id','DESC')->first();
    	//dd($monthly);
    	$month = Month::select('id','name')->where('status','=','active')->orderBy('id','DESC')->first();
    	//dd($month);
    	$course = Course::find($courseid);
    	if( ($monthly == null) || ($monthly->month_id < $month->id)){
    		$courseMonthly = new CourseMonthly();
    		$courseMonthly->month = $month->name;
    		$courseMonthly->course_id = $courseid;
    		$courseMonthly->month_id = $month->id;
    		$courseMonthly->fee_monthly = $course->fee;
    		$courseMonthly->status ="active";
    		$courseMonthly->save();
    		$lastCourseMonthlyInsertId = $courseMonthly->id;
    		$students = CourseStudent::select('student_id','course_id','status')->where('course_id','=',$course->id)->where('status','=','active')->get();
    	//	echo $students;
    		foreach ($students as $key2 => $student) {
    			# code...
    			$studentCourseMonthly = new StudentCourseMonthly();
    			$studentCourseMonthly->student_id = $student->student_id;
    			$studentCourseMonthly->month_id =$lastCourseMonthlyInsertId;
    			$studentCourseMonthly->is_fee = 0;
    			$studentCourseMonthly->status ="active";
    			$studentCourseMonthly->save();
    		}

    	}
    	return "Cập nhật tháng thành công";
    }
    public function getRefreshStudentMonthly($courseid, $monthlyid){
    	$students = CourseStudent::select('student_id')->where('course_id','=',$courseid)->whereNotIn('student_id', function($query) use($monthlyid){
    		$query->select('student_id')->from('student_course_monthly')->where('month_id','=',$monthlyid);
    	})->where('status','=','active')->get();
    	//return $students;
    	foreach ($students as $key2 => $student) {
    		$studentCourseMonthly = new StudentCourseMonthly();
    		$studentCourseMonthly->student_id = $student->student_id;
    		$studentCourseMonthly->month_id =$monthlyid;
    		$studentCourseMonthly->is_fee = 0;
    		$studentCourseMonthly->status ="active";
    		$studentCourseMonthly->save();
    	}
    	return "Cập nhật học viên thành công";
    }
}
