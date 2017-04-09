<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Course;
use App\Http\Teacher;
use App\Http\Agency;
class CourseController extends Controller
{
    public function getCourseList(){
    	return view('admin.courses.list');
    }
}
