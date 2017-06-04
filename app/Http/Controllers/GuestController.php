<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\News;
use App\Student;
use App\Course;
use App\Teacher;
use App\CourseStudent;
use App\NewsCategories;
class GuestController extends Controller
{
    public function getIndex()
    {
    	$lastNews = News::join('news_categories','news_categories.id','=','news.cate_id')
           ->select('news.id','news.slug','news.description','news_categories.name','news.title','news.created_at','news.image')
           ->where('news.status','=','active')
           ->where('news.cate_id','!=',1)
           ->orderBy('id','DESC')
           ->first();
      //  dd($firstNews);
        $listLastNews = News::join('news_categories','news_categories.id','=','news.cate_id')
           ->select('news.id','news.slug','news.description','news_categories.name','news.title','news.created_at','news.image')
           ->where('news.status','=','active')
           ->where('news.cate_id','!=',1)
           ->orderBy('id','DESC')
           ->limit(7)->offset(1)->get();
        $listPostNewCorses = News::join('news_categories','news_categories.id','=','news.cate_id')
           ->select('news.id','news.slug','news.description','news_categories.name','news.title','news.created_at','news.image')
           ->where('news.status','=','active')
           ->where('news.cate_id','=',2)
           ->orderBy('id','DESC')
           ->limit(7)->offset(0)->get();
        $listPostActivities = News::join('news_categories','news_categories.id','=','news.cate_id')
           ->select('news.id','news.slug','news.description','news_categories.name','news.title','news.created_at','news.image')
           ->where('news.status','=','active')
           ->where('news.cate_id','=',3)
           ->orderBy('id','DESC')
           ->limit(7)->offset(0)->get();
        $listPostNews = News::join('news_categories','news_categories.id','=','news.cate_id')
           ->select('news.id','news.slug','news.description','news_categories.name','news.title','news.created_at','news.image')
           ->where('news.status','=','active')
           ->where('news.cate_id','=',4)
           ->orderBy('id','DESC')
           ->limit(7)->offset(0)->get();
    	return view('guest.index',
        ['lastNews'=>$lastNews,
        'listLastNews'=>$listLastNews,
        'listPostNewCourses'=>$listPostNewCorses,
        'listPostActivities' =>$listPostActivities,
        'listPostNews' => $listPostNews
        ]);

    }
    public function getViewPost($id, $slug)
    {
        $post = News::where('status','=','active')->findOrFail($id);
        return view('guest.viewpost',['post'=>$post]);
    }
    public function getListPost($id, $slug)
    {
        //$posts = News::where('status','=','active')->where('cate_id','=',$id)->get();
        $cate = NewsCategories::findOrFail($id);
        return view('guest.listpost',['cate'=>$cate]);
    }

    function getListStudents()
    {
        return view('guest.liststudent');
    }
     function getListTeachers()
    {
        return view('guest.listteacher');
    }
    function getListCourses()
    {
        return view('guest.listcourse');
    }

    public function getDetailStudent($id)
    {
        $student = Student::join('nations','nations.id','=','students.nation_id')
        ->select('students.firstname','students.username','students.lastname','students.id','students.phone','students.dob','students.gender','students.email','students.address','students.parents_phone','students.amount','nations.name')
        ->where('students.status','=','active')->findOrFail($id);
        $courses = CourseStudent::join('courses','courses.id','=','course_student.course_id')->join('teachers','teachers.id','=','courses.teacher_id') 
        ->select('courses.id','courses.name','courses.fee','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname')->where('courses.status','=','active')
        ->where('course_student.student_id','=',$id)->get();
        //dd($courses);
        return view('guest.detailstudent',['student'=>$student,'courses'=>$courses]);

    }
    public function getDetailTeacher($id)
    {
        $teacher = Teacher::join('salary_level','teachers.salary_level_id','=','salary_level.id')->findOrFail($id)->toArray();
        $courses = Course::select('id','name','fee','max_students')->where('status','=','active')->where('teacher_id','=',$id)->get();
      //  dd($teacher);
        //  return $teacher;
        return view('guest.detailteacher',['teacher'=>$teacher,'courses' => $courses]);

    }
    public function getDetailCourse($id)
    {
        $course = Course::join('agencies','agencies.id','=','courses.agency_id')
        ->join('teachers','teachers.id','=','courses.teacher_id')
        ->select('courses.id','courses.description','courses.name','courses.max_students','courses.fee','agencies.name as agency_name','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname','courses.status')
        ->where('courses.status','=','active')->find($id);

        return view('guest.detailcourse',['course'=>$course]);
    }

}
