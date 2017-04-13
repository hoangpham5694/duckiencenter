<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('login',['as' => 'getLogin', 'uses' => 'LoginController@getLogin']);
Route::post('login',['as' => 'postLogin', 'uses' => 'LoginController@postLogin']);
Route::group(['middleware'=>'isteacher'], function(){
	Route::group(['prefix' => 'teachersites'], function(){
		//Route::get('/',['as' => 'getStatistics', 'uses' => 'AdminController@getStatistics']);
		Route::get('/', function(){
    		return view('teacher.dashboard.main');
    	});

	});
});
Route::group(['middleware'=>'isstudent'], function(){
	Route::group(['prefix' => 'studentsites'], function(){
		//Route::get('/',['as' => 'getStatistics', 'uses' => 'AdminController@getStatistics']);
		Route::get('/', function(){
    		return view('student.dashboard.main');
    	});

	});
});
Route::group(['middleware'=>'isroleadmin'], function(){
	Route::group(['prefix' => 'adminsites'], function(){
		//Route::get('/',['as' => 'getStatistics', 'uses' => 'AdminController@getStatistics']);
		Route::get('/', function(){
    		return view('admin.dashboard.main');
    	});
		Route::group(['prefix' => 'teacher'], function(){
			Route::get('list',['as' => 'getTeacherListAdmin', 'uses' => 'TeacherController@getTeacherList']);
			Route::get('listjson/{max}/{page}',['as' => 'getTeacherListJsonAdmin', 'uses' => 'TeacherController@getTeacherListJson']);
			Route::get('totaljson',['as' => 'getTeacherTotalJsonAdmin', 'uses' => 'TeacherController@getTeacherTotalJson']);
			Route::get('add',['as' => 'getTeacherAddAdmin', 'uses' => 'TeacherController@getTeacherAdd']);
			Route::post('add',['as' => 'postTeacherAddAdmin', 'uses' => 'TeacherController@postTeacherAdd']);
			Route::get('edit/{id}',['as' => 'getTeacherEditAdmin', 'uses' => 'TeacherController@getTeacherEdit']);
			Route::post('edit/{id}',['as' => 'postTeacherEditAdmin', 'uses' => 'TeacherController@postTeacherEdit']);
			Route::get('delete/{id}',['as' => 'getTeacherDeleteAdmin', 'uses' => 'TeacherController@getTeacherDelete']);

		});
		Route::group(['prefix' => 'course'], function(){
			Route::get('list',['as' => 'getCourseListAdmin', 'uses' => 'CourseController@getCourseListAdmin']);
			Route::get('listjson',['as' => 'getCourseListJsonAdmin', 'uses' => 'CourseController@getCourseListJson']);
			Route::get('totaljson',['as' => 'getCourseTotalJsonAdmin', 'uses' => 'CourseController@getCourseTotalJson']);
			Route::get('add',['as' => 'getCourseAddAdmin', 'uses' => 'CourseController@getCourseAddAdmin']);
			Route::post('add',['as' => 'postCourseAddAdmin', 'uses' => 'CourseController@postCourseAddAdmin']);
			Route::get('edit/{id}',['as' => 'getCourseEditAdmin', 'uses' => 'CourseController@getCourseEditAdmin']);
			Route::post('edit/{id}',['as' => 'postCourseEditAdmin', 'uses' => 'CourseController@postCourseEditAdmin']);
			Route::get('delete/{id}',['as' => 'getCourseDeleteAdmin', 'uses' => 'CourseController@getCourseDelete']);
			Route::get('detail/{id}',['as' => 'getCourseDetailAdmin', 'uses' => 'CourseController@getCourseDetailAdmin']);
			Route::get('listcoursestudentsjson/{id}',['as' => 'getCourseStudentsListJsonAdmin', 'uses' => 'CourseController@getCourseStudentsListJsonAdmin']);
			Route::get('listallstudentsjson/{id}',['as' => 'getAllStudentsNotInCourseListJsonAdmin', 'uses' => 'CourseController@getAllStudentsNotInCourseListJsonAdmin']);
			Route::get('addstudenttosourse/{courseid}/{studentid}',['as' => 'getAddStudentToCourseAdmin', 'uses' => 'CourseController@getAddStudentToCourseAdmin']);
			Route::get('deletestudentcourse/{id}',['as' => 'getDeleteStudentCourseAdmin', 'uses' => 'CourseController@getDeleteStudentCourseAdmin']);


		});
		Route::group(['prefix' => 'fee'],function(){
			Route::get('listcourses',['as' => 'getFeeListCoursesAdmin', 'uses' => 'CourseController@getFeeListCoursesAdmin']);
			Route::get('coursedetail/{id}',['as' => 'getFeeCourseDetailAdmin', 'uses' => 'FeeController@getFeeCourseDetailAdmin']);
			Route::get('listcoursemonthlys/{courseid}',['as' => 'getFeeListCourseMonthlyAdmin', 'uses' => 'FeeController@getFeeListCourseMonthlyAdmin']);
			Route::get('liststudentinmonthjson/{coursemonthlyid}',['as' => 'getFeeListStudentCourseMonthly', 'uses' => 'FeeController@getFeeListStudentCourseMonthly']);
			Route::get('refreshmonthly/{courseid}',['as' => 'getRefreshMonthly', 'uses' => 'FeeController@getRefreshMonthly']);
			Route::get('refreshstudentmonthly/{courseid}/{monthlyid}',['as' => 'getRefreshStudentMonthly', 'uses' => 'FeeController@getRefreshStudentMonthly']);

		});
		Route::group(['prefix' => 'month'],function(){
			Route::get('list',['as' => 'getListMonthAdmin', 'uses' => 'MonthController@getListMonthAdmin']);
			Route::get('listjson/{max}/{page}',['as' => 'getMonthListJsonAdmin', 'uses' => 'MonthController@getMonthListJson']);
			Route::get('totaljson',['as' => 'getMonthTotalJsonAdmin', 'uses' => 'MonthController@getMonthTotalJson']);
			Route::get('add',['as' => 'getAddMonthAdmin', 'uses' => 'MonthController@getAddMonthAdmin']);
			Route::get('edit/{id}/{name}',['as' => 'getMonthEditAdmin', 'uses' => 'MonthController@getMonthEditAdmin']);

		});

	});
});
Route::group(['middleware'=>'isrolemanager'], function(){
	Route::group(['prefix' => 'managersites'], function(){
		//Route::get('/',['as' => 'getStatistics', 'uses' => 'AdminController@getStatistics']);
		Route::get('/', function(){
    		return view('manager.dashboard.main');

    	});
	/*	Route::group(['prefix' => 'course'], function(){
			Route::get('list',['as' => 'getCourseListAdmin', 'uses' => 'CourseController@getCourseList']);
			Route::get('listjson',['as' => 'getCourseListJsonAdmin', 'uses' => 'CourseController@getCourseListJson']);
			Route::get('totaljson',['as' => 'getCourseTotalJsonAdmin', 'uses' => 'CourseController@getCourseTotalJson']);
			Route::get('add',['as' => 'getCourseAddAdmin', 'uses' => 'CourseController@getCourseAdd']);
			Route::post('add',['as' => 'postCourseAddAdmin', 'uses' => 'CourseController@postCourseAdd']);
			Route::get('edit/{id}',['as' => 'getCourseEditAdmin', 'uses' => 'CourseController@getCourseEdit']);
			Route::post('edit/{id}',['as' => 'postCourseEditAdmin', 'uses' => 'CourseController@postCourseEdit']);
			Route::get('delete/{id}',['as' => 'getCourseDeleteAdmin', 'uses' => 'CourseController@getCourseDelete']);

		});
		*/
	});
});