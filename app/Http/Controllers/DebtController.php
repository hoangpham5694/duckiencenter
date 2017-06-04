<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\CourseStudent;
use App\Course;
use App\Attendance;
use App\Student;
use App\Teacher;
use App\Debt;
class DebtController extends Controller
{
    public function getDebtOfStudentJson($studentid)
    {
    	$debts = Debt::join('attendances','attendances.id','=','debts.attendance_id')
    	->join('courses','courses.id','=','attendances.course_id')
    	->select('debts.id','debts.money','attendances.name','attendances.course_id','courses.name as course_name')
    	->where('debts.student_id','=',$studentid)->get();
    	return $debts;
    }
   // public function get
    public function getRemoveDebt($debtid){
    	$debt = Debt::findOrFail($debtid);
    	$attendance = Attendance::findOrFail($debt->attendance_id);
    	$student = Student::findOrFail($debt->student_id);
    	$course = Course::findOrFail($attendance->course_id);
    	$teacher = Teacher::join('salary_level','salary_level.id','=','teachers.salary_level_id')
    	->select('teachers.id','teachers.amount','salary_level.percent')
    	->where('teachers.id','=',$attendance->teacher_id)->first();
      //  dd($teacher);
    	if($student->amount >= $debt->money){
    		$student->amount = $student->amount - $debt->money;
    		$attendance->money = $attendance->money + $debt->money;
    		$teacher->amount += $debt->money * $teacher->percent /100;
            $ducKienAccount = Teacher::findOrFail(0);
            $ducKienAccount->amount += $debt->money * (100 - $teacher->percent) /100;
            $ducKienAccount->save();
    		$debt->delete();
    		$student->save();
    		$teacher->save();
    		$attendance->save();
    		$countDebts = Debt::join('attendances','attendances.id','=','debts.attendance_id')
    		->where('attendances.course_id','=',$course->id)
    		->where('debts.student_id','=',$student->id)
    		->count();
           // echo $countDebts;
    		if($countDebts == 0){
    			$courseStudent = CourseStudent::select('id','status')
    			->where('course_id','=',$course->id)
    			->where('student_id','=',$student->id)
    			->first();
    			$courseStudent->status = "active";
                $courseStudent->save();
    		}
    		return "Thanh toán nợ thành công";
    	}
    	return "Không đủ tiền thanh toán";

    }
}
