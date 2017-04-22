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
    public function getAddAttendanceJson(Request $request){
        $courseId = $request->courseid;
        $name = $request->name;
        $studyDate = $request->date;
        $attendances = new Attendance();
        $attendances->course_id = $courseId;
      //  $attendances->study_date =  date_format($studyDate, 'Y-m-d H:i:s');
        $attendances->study_date = $studyDate;
        $attendances->name = $name;
        $attendances->money = 0;
        $attendances->status = "active";
        $attendances->is_taught =0;
        $attendances->save();
       // echo  $attendances->study_date;
        return "Thêm ".$name." thành công";
       // return $attendances->study_date;
    }
    public function getListAttendanceJson($max,$page,Request $request){
        $numberRecord= $max;
        $vitri =($page -1 ) * $numberRecord;
        $key = $request->key;
        $orderby = $request->orderby;
        $sort = $request->sort;
        $courseId = $request->courseid;
        $attendances = Attendance::leftjoin('teachers','teachers.id','=','attendances.teacher_id')
        ->select('attendances.id','attendances.name','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname','attendances.is_taught')
        ->where('attendances.status','=','active')
        ->where('attendances.course_id','=',$courseId)
        ->orderBy($orderby,$sort)->limit($numberRecord)->offset($vitri)->get();
        return $attendances;
    }
    public function getAttendanceJson($id){
        $attendance = Attendance::findOrFail($id);
        return $attendance;
    }
    public function getEditAttendanceJson(Request $request){
        $attendanceId = $request->attendanceid;
        $name = $request->name;
        $studyDate = $request->date;
        $attendance = Attendance::findOrFail($attendanceId);
        
      //  $attendances->study_date =  date_format($studyDate, 'Y-m-d H:i:s');
        $attendance->study_date = $studyDate;
        $oldName = $attendance->name;
        $attendance->name = $name;

        $attendance->save();
       // echo  $attendances->study_date;
        return "Sửa ".$oldName." thành ".$attendance->name." thành công";
       // return $attendances->study_date;
    }
    public function getDeleteAttendanceJson($id){
         $attendance = Attendance::findOrFail($id);
         if($attendance->is_taught ==0){
            $oldName = $attendance->name;
            $attendance->status = "delete";
            $attendance->save();
            return "Xóa ".$oldName." thành công";
         }
         return "Không được xóa";
         
    }
}
