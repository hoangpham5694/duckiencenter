<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\CourseMonthLy;
use App\CourseStudent;
use App\StudentCourseMonthly;
use App\Month;
use App\Course;
use App\Attendance;
class AttendanceController extends Controller
{
    public function getListCourseOfTeacherJson(){
    	$teacherId = Auth::guard('teachers')->user()->id;
    	//echo $teacherId;
    	$courses = Course::select('name','id')->where('status','=','active')->where('teacher_id','=',$teacherId)->get();
    	return $courses;
    }
    public function getListMonthlyOfCourseJson($courseid){
    
    	//echo $teacherId;
    	$monthlys = CourseMonthLy::join('months','months.id','=','course_monthly.month_id')->select('months.name','course_monthly.id')->where('course_monthly.status','=','active')->where('course_id','=',$courseid)->orderBy('id','DESC')->get();
    	return $monthlys;
    }
    public function getListAttendancesOfMonthlyJson($monthlyid){
    	$attendances= Attendance::select('id','name')->where('status','=','active')->where('month_id','=',$monthlyid)->orderBy('id','DESC')->get();
    	return $attendances;
    }
}
