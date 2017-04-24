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
    	Route::group(['prefix' => 'attendance'], function(){
    		Route::get('/', function(){
    			return view('teacher.attendances.index');
    		});
    		Route::get('listcoursesofteacherjson',['as' => 'getListCourseOfTeacherJson', 'uses' => 'AttendanceController@getListCourseOfTeacherJson']);
			Route::get('listmonthlyofcoursejson/{courseid}',['as' => 'getListMonthlyOfCourseJson', 'uses' => 'AttendanceController@getListMonthlyOfCourseJson']);
			Route::get('listattendancesofmonthlyjson/{monthlyid}',['as' => 'getListAttendancesOfMonthlyJson', 'uses' => 'AttendanceController@getListMonthlyOfCourseJson']);

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
			Route::get('detail/{id}',['as' => 'getTeacherDetailAdmin', 'uses' => 'TeacherController@getTeacherDetailAdmin']);

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
		Route::group(['prefix' => 'student'],function(){
			Route::get('list',['as' => 'getListStudentAdmin', 'uses' => 'StudentController@getListStudentAdmin']);
			Route::get('listjson/{max}/{page}',['as' => 'getListStudentJsonAdmin', 'uses' => 'StudentController@getListStudentJson']);
			Route::get('totaljson',['as' => 'getStudentTotalJsonAdmin', 'uses' => 'StudentController@getStudentTotalJson']);
			Route::get('add',['as' => 'getAddStudentAdmin', 'uses' => 'StudentController@getAddStudentAdmin']);
			Route::get('checkunique/{username?}',['as' => 'getCheckUniqueAdmin', 'uses' => 'StudentController@getCheckUnique']);
			Route::post('add',['as' => 'postAddStudentAdmin', 'uses' => 'StudentController@postAddStudentAdmin']);
			Route::get('detail/{id}',['as' => 'getStudentDetailAdmin', 'uses' => 'StudentController@getStudentDetailAdmin']);
			Route::get('edit/{id}',['as' => 'getStudentEditAdmin', 'uses' => 'StudentController@getStudentEditlAdmin']);
			Route::post('edit/{id}',['as' => 'postStudentEditAdmin', 'uses' => 'StudentController@postStudentEditAdmin']);
			Route::get('delete/{id}',['as' => 'getStudentDeleteAdmin', 'uses' => 'StudentController@getStudentDelete']);

		});
		Route::group(['prefix' => 'attendance'],function(){
			Route::get('addjson',[ 'uses' => 'AttendanceController@getAddAttendanceJson']);
			Route::get('listjson/{max}/{page}',[ 'uses' => 'AttendanceController@getListAttendanceJson']);
			Route::get('attendancejson/{id}',[ 'uses' => 'AttendanceController@getAttendanceJson']);
			Route::get('editjson',[ 'uses' => 'AttendanceController@getEditAttendanceJson']);
			Route::get('deletejson/{id}',[ 'uses' => 'AttendanceController@getDeleteAttendanceJson']);

		});
		Route::group(['prefix' => 'check-attendance'], function(){
			Route::get('index',['as'=> 'checkAttendanceIndexAdmin','uses'=>'CheckAttendanceController@indexAdmin']);
			Route::get('listattendancesofdatejson',['uses'=>'CheckAttendanceController@getListAttendancesOfDateJson']);
			Route::get('detail/{id}',['uses'=>'CheckAttendanceController@getDetailAttendanceAdmin']);
			Route::get('detailattendancejson/{id}',['uses'=>'CheckAttendanceController@getDetailAttdanceJson']);
			Route::get('coursestudentslistjson/{courseid}',['uses'=>'CheckAttendanceController@getCourseStudentsListJson']);
			Route::get('lockattendancejson/{id}',['uses'=>'CheckAttendanceController@getLockAttendanceJson']);
			Route::get('liststudentsdebtjson/{id}',['uses'=>'CheckAttendanceController@getListStudentDebtJson']);
	
		});
		Route::group(['prefix' => 'debt'], function(){
			Route::get('debtofstudentjson/{studentid}',['uses'=>'DebtController@getDebtOfStudentJson']);
			Route::get('removedebt/{debtid}',['uses'=>'DebtController@getRemoveDebt']);


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