<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\CourseMonthLy;
use App\CourseStudent;
use App\StudentCourseMonthly;
use App\Month;
use App\Course;
use App\Attendance;
use App\Debt;
use App\Student;
use App\Teacher;
class CheckAttendanceController extends Controller
{
    public function indexAdmin(){
    	return view('admin.checkattendance.index');
    }
    public function indexManager(){
        return view('manager.checkattendance.index');
    }
    public function getListAttendancesOfDateJson(Request $request){
    	$date = $request->date;
    	//$date = "2017-03-19";
    	$isTaught = $request->istaught;
    	if($isTaught != null){
    		$attendances = Attendance::join('courses','courses.id','=','attendances.course_id')
    		->join('teachers','teachers.id','=','courses.teacher_id')
    		->select('attendances.id','attendances.name','attendances.is_taught','attendances.course_id','courses.name as course_name','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname')
    		->where('attendances.status','=','active')
    		->where('attendances.study_date','=',$date)
    		->where('attendances.is_taught','=',$isTaught)
    		->get();
    	}else{
    		$attendances = Attendance::join('courses','courses.id','=','attendances.course_id')
    		->join('teachers','teachers.id','=','courses.teacher_id')
    		->select('attendances.id','attendances.name','attendances.is_taught','attendances.course_id','courses.name as course_name','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname')
    		->where('attendances.status','=','active')
    		->where('attendances.study_date','=',$date)
    		->get();
    	}

    	//dd($attendances);
    	return $attendances;
    }
    public function getDetailAttendanceAdmin($id){
        $attendance = Attendance::join('courses','courses.id','=','attendances.course_id')
        ->join('teachers','teachers.id','=','courses.teacher_id')
        ->select('attendances.id','attendances.name','attendances.study_date','courses.fee','courses.name as course_name', 'attendances.total_students','attendances.is_taught','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname')
        ->where('attendances.id','=',$id)->first();
      //  dd($attendance);
        return view('admin.checkattendance.detail',['attendance' => $attendance]);
    }
    public function getDetailAttendanceManager($id){
        $attendance = Attendance::join('courses','courses.id','=','attendances.course_id')
        ->join('teachers','teachers.id','=','courses.teacher_id')
        ->select('attendances.id','attendances.name','attendances.study_date','courses.fee','courses.name as course_name', 'attendances.total_students','attendances.is_taught','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname')
        ->where('attendances.id','=',$id)->first();
      //  dd($attendance);
        return view('manager.checkattendance.detail',['attendance' => $attendance]);
    }
    public function getDetailAttdanceJson($id){
        $attendance = Attendance::join('courses','courses.id','=','attendances.course_id')
        ->join('teachers','teachers.id','=','courses.teacher_id')
        ->select('attendances.id','attendances.money','attendances.name','attendances.study_date','courses.fee','courses.name as course_name', 'attendances.total_students','attendances.is_taught','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname')
        ->where('attendances.id','=',$id)->first();
        return $attendance;
    }
    public function getCourseStudentsListJson($id){
        $attendance = Attendance::findOrFail($id);
        $students = CourseStudent::join('students','students.id','=','course_student.student_id')
        ->select('students.firstname','students.amount','students.lastname','students.phone','course_student.student_id','students.username','course_student.status','course_student.id')
        ->where('course_student.course_id','=',$attendance->course_id)
        ->orderBy('students.firstname','ASC')
        ->get();
        return json_encode($students);
    }
    public function getLockAttendanceJson($id){
        
        try{
            DB::beginTransaction();

            $attendance = Attendance::findOrFail($id);
            if($attendance->is_taught == 1){
                return "Xin lỗi! Buổi học này đã được khóa trước đó";
            }
            $course = Course::findOrFail($attendance->course_id);
            $students = CourseStudent::join('students','students.id','=','course_student.student_id')
    //    ->join('courses','courses.id','=','course_student.course_id')
            ->select('course_student.id','course_student.student_id','students.amount','course_student.status')
            ->where('course_student.course_id','=',$attendance->course_id)->get();
            $money = $attendance->money;
          //  dd($students);
            $stdNum = 0;
            $teacher = Teacher::join('salary_level','salary_level.id','=','teachers.salary_level_id')
        ->select('teachers.id','teachers.amount','salary_level.percent')
        ->where('teachers.id','=',$course->teacher_id)->first();
        //dd($attendance);
        //dd($teacher);
            foreach ($students as $key => $student) {
                $stdNum++;
            # code...
              //  echo $student->student_id;
                $std = Student::findOrFail($student->student_id);
           //     dd($std);
                if($student->status == "active"){
                    if($std->amount >= $course->fee){
                        $std->amount = $std->amount - $course->fee;
                        $money += $course->fee;
                     //   echo "money: ".$money;
                        $teacher->amount = $teacher->amount+ $course->fee * $teacher->percent /100;
                        $std->save();
                    }else{
                        $debt = new Debt();
                        $debt->student_id = $student->student_id;
                        $debt->attendance_id = $attendance->id;
                        $debt->money = $course->fee;
                        $debt->save();
                  //  $courseStudent= CourseStudent::findOrFail($student->student_id);
                        $student->status ="deactive";

                     //   echo "dsfds";
                    }
                    $student->save();
                }

            }
            $attendance->total_students = $stdNum;
            $attendance->teacher_id = $course->teacher_id;
            $attendance->is_taught=1;
            $attendance->money = $money;
            $attendance->save();
            $teacher->save();
            DB::commit();
        }catch(Exception $e){
             DB::rollback();
             return "Lỗi trong quá trình thực hiện";
        }

        return "Khóa buổi học thành công";

    }
    public function getListStudentDebtJson($id){
        $studentDebts = Debt::join('students','students.id','=','debts.student_id')
        ->select('students.username','students.firstname','students.amount','students.lastname','debts.money','debts.attendance_id')
        ->where('debts.attendance_id','=',$id)->get();
        return json_encode($studentDebts);
    }

}
