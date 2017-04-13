<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Month;
use App\Course;
use App\CourseStudent;
use App\CourseMonthly;
use App\StudentCourseMonthly;
class MonthController extends Controller
{
    public function getListMonthAdmin(){
    	return view('admin.months.list');
    }
    public function getMonthListJson($max, $page){
    	$numberRecord= $max;
        $vitri =($page -1 ) * $numberRecord;
    	$months = Month::select('name','id','created_at')->where('status','=','active')->orderBy('id','DESC')->limit($numberRecord)->offset($vitri)->get();
    	return json_encode($months);
    }
    public function getAddMonthAdmin(Request $request){
    //	echo $request->month;
    	$month = new Month();
    	$month->name = $request->month;
    	$month->status = "active";
    	$month->save();
    	$lastInsertId = $month->id;
    //	return $lastInsertId;
    	$courses = Course::select('courses.id','courses.name','courses.fee')->where('status','=','active')->get();
    	foreach ($courses as $key1 => $course) {
    		
    		//echo json_encode($value);
    		$courseMonthly = new CourseMonthly();
    		$courseMonthly->month = $month->name;
    		$courseMonthly->course_id = $course->id;
    		$courseMonthly->month_id = $lastInsertId;
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
    	return "Thêm tháng thành công";
    }
    public function getMonthEditAdmin($id, $name){
      //  return "id: ".$id." name: ".$name;
        $month = Month::find($id);
        $month->name = $name;
        $month->save();
        return "Sửa tháng thành công";
        
    }
}
