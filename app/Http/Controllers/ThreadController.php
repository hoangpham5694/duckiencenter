<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Thread;
use App\ThreadComment;
use Illuminate\Support\Facades\Auth;
class ThreadController extends Controller
{
	public function getCreateThreadTeacher($courseid)
	{
		return view('teacher.threads.create');
	}
	public function postCreateThreadTeacher($courseid, Request $request)
	{
		$thread = new Thread();
		$thread->title= $request->txtTitle;
		$thread->slug = str_slug($request->txtTitle, "-");
		$thread->content = $request->txtContent;
		$thread->teacher_id = Auth::guard('teachers')->user()->id;
		$thread->course_id = $courseid;
		$thread->type = "t";
		$thread->status = "active";
		$thread->save();
	}
	public function getListThreadJson($courseid, $max, $page, Request $request)
	{
		$key = $request->key;
        $orderby = $request->orderby;
        $sort = $request->sort;
    	$numberRecord= $max;
        $vitri =($page -1 ) * $numberRecord;
		$threads = Thread::leftJoin('teachers','teachers.id','=','threads.teacher_id')
		->leftJoin('students','students.id','=','threads.student_id')
		->select('threads.id','threads.title','threads.slug','threads.created_at','threads.type','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname','students.firstname as student_firstname','students.lastname as student_lastname')
		->where('threads.course_id','=',$courseid)
		->orderby('threads.id','DESC')
		->limit($numberRecord)->offset($vitri)->get();
		return $threads;
	}
	public function getTotalThreadJson($courseid)
	{
		return Thread::where('course_id','=',$courseid)->count();
	}
	public function getDetailThreadTeacher($threadid)
	{
		$thread = Thread::leftJoin('teachers','teachers.id','=','threads.teacher_id')
		->leftJoin('students','students.id','=','threads.student_id')
		->select('threads.id','threads.title','threads.slug','threads.created_at','threads.type','teachers.firstname as teacher_firstname','teachers.lastname as teacher_lastname','students.firstname as student_firstname','students.lastname as student_lastname','threads.content')
		->where('threads.id','=',$threadid)
		->first();
		
		return view('teacher.threads.detail',['thread'=>$thread]);
	}
}
