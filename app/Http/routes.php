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

Route::get('/', ['uses'=>'GuestController@getIndex']);
Route::get('bai-viet/{id}/{slug}', ['uses'=>'GuestController@getViewPost']);
Route::get('danh-muc/{id}/{slug}', ['uses'=>'GuestController@getListPost']);
Route::get('hoc-vien', ['uses'=>'GuestController@getListStudents']);
Route::get('thong-tin-hoc-vien/{id}', ['uses'=>'GuestController@getDetailStudent']);
Route::get('giao-vien', ['uses'=>'GuestController@getListTeachers']);
Route::get('thong-tin-giao-vien/{id}', ['uses'=>'GuestController@getDetailTeacher']);
Route::get('lop-hoc', ['uses'=>'GuestController@getListCourses']);
Route::get('thong-tin-lop-hoc/{id}', ['uses'=>'GuestController@getDetailCourse']);
Route::group(['prefix' => 'api'], function(){
	Route::get('listpostjson',[ 'uses' => 'NewsController@getListNewsJson']);
	Route::get('totalpostjson',[ 'uses' => 'NewsController@getTotalNewsJson']);
	Route::get('totalstudentjson',[ 'uses' => 'StudentController@getStudentTotalJson']);
	Route::get('liststudentjson/{max}/{page}',[ 'uses' => 'StudentController@getListStudentJson']);
	Route::get('listcoursesofstudentjson/{studentid}',['uses'=> 'StudentController@getListCoursesOfStudentJson']);
	Route::get('listjson/{max}/{page}',['as' => 'getTeacherListJsonAdmin', 'uses' => 'TeacherController@getTeacherListJson']);
	Route::get('totaljson',['as' => 'getTeacherTotalJsonAdmin', 'uses' => 'TeacherController@getTeacherTotalJson']);
	Route::get('listcoursestudentsjson/{id}',['as' => 'getCourseStudentsListJsonAdmin', 'uses' => 'CourseController@getCourseStudentsListJsonAdmin']);
	Route::get('listcoursejson',[ 'uses' => 'CourseController@getCourseListJson']);
	Route::get('totalcoursejson',[ 'uses' => 'CourseController@getCourseTotalJson']);
	Route::get('listteachersimplejson',['uses' => 'TeacherController@getTeacherListSimpleJson']);

	Route::get('listagencysimplejson',['uses' => 'AgencyController@getAgencyListSimpleJson']);
	Route::get('listattendancejson/{max}/{page}',[ 'uses' => 'AttendanceController@getListAttendanceJson']);


	Route::get('listadsjson',['uses'=>'AdsBannerController@getListAdsBannerJson']);
	Route::get('totaladsjson',['uses'=>'AdsBannerController@getTotalAdsBannerJson']);
});

Route::get('logout',['as' => 'getLogin', 'uses' => 'LoginController@getLogout']);
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
    	Route::group(['prefix'=>'course'],function(){
    		Route::get('/',['uses' => 'CourseController@getListCourseIndividualTeacher']);
    		Route::get('detail/{id}',[ 'uses' => 'CourseController@getCourseDetailTeacher']);
		
    		Route::group(['prefix'=>'ajax'],function(){
    			Route::get('listcourseindividual',['uses' => 'CourseController@getListCourseIndividualTeacherJson']);
    			Route::get('totalcourseindividual',['uses' => 'CourseController@getCourseIndividualTotalJson']);
				Route::get('listcoursestudents/{id}',[ 'uses' => 'CourseController@getCourseStudentsListJsonAdmin']);

    		});
    	});
    	Route::group(['prefix'=>'thread'],function(){
    		Route::get('create/{courseid}',[ 'uses' => 'ThreadController@getCreateThreadTeacher']);
    		Route::post('create/{courseid}',[ 'uses' => 'ThreadController@postCreateThreadTeacher']);
    		Route::get('detail/{threadid}',[ 'uses' => 'ThreadController@getDetailThreadTeacher']);
    		Route::group(['prefix'=>'api'],function(){
    			Route::get('list/{courseid}/{max}/{page}',[ 'uses' => 'ThreadController@getListThreadJson']);
    			Route::get('total/{courseid}',[ 'uses' => 'ThreadController@getTotalThreadJson']);
    		});
    	});
    	Route::group(['prefix'=>'student'],function(){
    	//	Route::get('/',['uses' => 'StudentController@getListStudentsTeacher']);
    		Route::get('detail/{id}',['uses' => 'StudentController@getDetailStudentTeacher']);
		
    		Route::group(['prefix'=>'ajax'],function(){
    			Route::get('listcourseindividual',['uses' => 'CourseController@getListCourseIndividualTeacherJson']);
    			Route::get('totalcourseindividual',['uses' => 'CourseController@getCourseIndividualTotalJson']);
				Route::get('listcoursestudents/{id}',[ 'uses' => 'CourseController@getCourseStudentsListJsonAdmin']);
				Route::get('listcoursesofstudent/{studentid}',['uses'=> 'StudentController@getListCoursesOfStudentJson']);

    		});
    	});
    	Route::group(['prefix' => 'account'], function(){
			Route::get('profile',['uses'=>'AccountController@getProfileTeacher']);
			Route::get('edit',['uses'=>'AccountController@getEditTeacher']);
			Route::post('edit',['uses'=>'AccountController@postEditTeacher']);

		});

	});
});
Route::group(['middleware'=>'isstudent'], function(){
	Route::group(['prefix' => 'studentsites'], function(){
		//Route::get('/',['as' => 'getStatistics', 'uses' => 'AdminController@getStatistics']);
		Route::get('/', function(){
    		return view('student.dashboard.main');
    	});

    	Route::group(['prefix' => 'course'], function(){
    		Route::get('list/{method}',['uses'=>'CourseController@getListAllCourseStudent']);
			Route::get('listalljson',[ 'uses' => 'CourseController@getCourseListJson']);
			Route::get('totaljson',[ 'uses' => 'CourseController@getCourseTotalJson']);
			Route::get('listindividualjson',[ 'uses' => 'CourseController@getCourseListIndividualJson']);
			Route::get('totalindividualjson',[ 'uses' => 'CourseController@getCourseTotalIndividualJson']);
			Route::get('detail/{id}',[ 'uses' => 'CourseController@getCourseDetailStudent']);
		
    		Route::group(['prefix'=>'ajax'],function(){
    			Route::get('listcourseindividual',['uses' => 'CourseController@getListCourseIndividualTeacherJson']);
    			Route::get('totalcourseindividual',['uses' => 'CourseController@getCourseIndividualTotalJson']);
				Route::get('listcoursestudents/{id}',[ 'uses' => 'CourseController@getCourseStudentsListJsonAdmin']);

    		});
    	});
    	Route::group(['prefix' => 'teacher'], function(){
			Route::get('listsimplejson',['uses' => 'TeacherController@getTeacherListSimpleJson']);
	
		});
		Route::group(['prefix' => 'agency'], function(){
    		Route::get('listsimplejson',['uses' => 'AgencyController@getAgencyListSimpleJson']);
    	
    	});
    	Route::group(['prefix' => 'account'], function(){
			Route::get('profile',['uses'=>'AccountController@getProfileStudent']);
			Route::get('edit',['uses'=>'AccountController@getEditStudent']);
			Route::post('edit',['uses'=>'AccountController@postEditStudent']);

		});

	});
});
Route::group(['middleware'=>'isroleadmin'], function(){
	Route::group(['prefix' => 'adminsites'], function(){
		//Route::get('/',['as' => 'getStatistics', 'uses' => 'AdminController@getStatistics']);
		Route::get('/', function(){
    		return view('admin.dashboard.main');
    	});
    	Route::group(['prefix' => 'history'], function(){

    	});
    	Route::group(['prefix' => 'agency'], function(){
    		Route::get('listsimplejson',['uses' => 'AgencyController@getAgencyListSimpleJson']);
    		Route::get('list',['uses'=>'AgencyController@getAgencyList']);
    		Route::get('listjson/{max}/{page}',['uses'=>'AgencyController@getAgencyListJson']);
    		Route::get('totaljson',['uses'=>'AgencyController@getAgencyTotalJson']);
    		Route::get('add/{agencyname}',['uses'=>'AgencyController@getAgencyAdd']);
    		Route::get('edit/{agencyid}/{agencyname}',['uses'=>'AgencyController@getAgencyEdit']);
    		Route::get('delete/{id}',['uses'=> 'AgencyController@getAgencyDelete']);
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
			Route::get('listsimplejson',['uses' => 'TeacherController@getTeacherListSimpleJson']);
	
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
			Route::get('listagenciesjson',['uses' => 'CourseController@getListAgenciesJson']);
			

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
			Route::get('detailjson/{id}',['uses'=> 'StudentController@getStudentDetailJson']);
			Route::get('listcoursesofstudentjson/{studentid}',['uses'=> 'StudentController@getListCoursesOfStudentJson']);

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
		Route::group(['prefix' => 'payin'], function(){
			Route::get('index',['uses'=>'PayinController@getIndexPayinAdmin']);
			Route::get('add/{studentid}',['uses'=>'PayinController@getAddPayinAdmin']);
			Route::post('add/{studentid}',['uses'=>'PayinController@postAddPayinAdmin']);
			Route::get('addtrial/{studentid}',['uses'=>'PayinController@getAddTrialAdmin']);
			Route::post('addtrial/{studentid}',['uses'=>'PayinController@postAddTrialAdmin']);

			Route::get('detail/{id}',['uses'=>'PayinController@getDetailPayinAdmin']);
			Route::get('bill/{id}',['uses'=>'PayinController@getBillPayinAdmin']);
			Route::get('history',['uses'=>'PayinController@getHistoryPayinAdmin']);

			Route::group(['prefix' => 'api'], function(){
				Route::get('listpayin/{max}/{page}',['uses'=>'PayinController@getListPayinJson']);
				Route::get('totalpayin',['uses'=>'PayinController@getTotalPayinJson']);

			});
		});
		Route::group(['prefix' => 'payout'], function(){
			Route::get('index',['uses'=>'PayoutController@getIndexPayoutAdmin']);
			Route::get('add/{teacherid}',['uses'=>'PayoutController@getAddPayoutAdmin']);
			Route::post('add/{studentid}',['uses'=>'PayoutController@postAddPayoutAdmin']);
			Route::get('detail/{id}',['uses'=>'PayoutController@getDetailPayoutAdmin']);
			Route::get('bill/{id}',['uses'=>'PayoutController@getBillPayoutAdmin']);
			Route::get('history',['uses'=>'PayoutController@getHistoryPayoutAdmin']);

			Route::group(['prefix' => 'api'], function(){
				Route::get('listpayout/{max}/{page}',['uses'=>'PayoutController@getListPayoutJson']);
				Route::get('totalpayout',['uses'=>'PayoutController@getTotalPayoutJson']);
				
			});
		});
		Route::group(['prefix' => 'user'], function(){
			Route::get('list',['uses'=>'UserController@getListUser']);
			Route::get('listjson/{max}/{page}',[ 'uses' => 'UserController@getListStudentJson']);
			Route::get('totaljson',[ 'uses' => 'UserController@getStudentTotalJson']);
			Route::get('add',[ 'uses' => 'UserController@getAddUserAdmin']);
			Route::get('checkunique/{username?}',[ 'uses' => 'UserController@getCheckUnique']);
			Route::post('add',[ 'uses' => 'UserController@postAddUserAdmin']);
			Route::get('edit/{id}',['uses' => 'UserController@getEditUserAdmin']);
			Route::post('edit/{id}',['uses' => 'UserController@postEditUserAdmin']);
			Route::get('delete/{id}',['uses' => 'UserController@getDeleteUser']);
		});
		Route::group(['prefix' => 'account'], function(){
			Route::get('profile',['uses'=>'AccountController@getProfileAdmin']);
			Route::get('edit',['uses'=>'AccountController@getEditAdmin']);
			Route::post('edit',['uses'=>'AccountController@postEditAdmin']);

		});
		Route::group(['prefix' => 'news'], function(){
			Route::get('list',['uses'=>'NewsController@getListNewsAdmin']);
			Route::get('detail/{id}',['uses'=>'NewsController@getDetailNewsAdmin']);
			Route::get('add',['uses'=>'NewsController@getAddNewsAdmin']);
			Route::post('add',['uses'=>'NewsController@postAddNewsAdmin']);
			Route::get('listjson',['uses'=>'NewsController@getListNewsJson']);
			Route::get('totaljson',['uses'=>'NewsController@getTotalNewsJson']);
			Route::get('edit/{id}',['uses'=>'NewsController@getEditNewsAdmin']);
			Route::post('edit/{id}',['uses'=>'NewsController@postEditNewsAdmin']);
			Route::get('delete/{id}',['uses'=>'NewsController@getDeleteNews']);
		});
		Route::group(['prefix' => 'cate'], function(){
			Route::get('listsimplejson',['uses'=>'CateController@getListCatesSimpleJson']);

		});
		Route::group(['prefix' => 'ads'], function(){
			Route::get('list',['uses'=>'AdsBannerController@getListAdsBannerAdmin']);
			Route::get('add',['uses'=>'AdsBannerController@getAddAdsBannerAdmin']);
			Route::post('add',['uses'=>'AdsBannerController@postAddAdsBannerAdmin']);
			Route::get('listjson',['uses'=>'AdsBannerController@getListAdsBannerJson']);
			Route::get('totaljson',['uses'=>'AdsBannerController@getTotalAdsBannerJson']);
			Route::get('delete/{id}',['uses'=>'AdsBannerController@getDeleteAdsBannerAdmin']);
			Route::get('edit/{id}',['uses'=>'AdsBannerController@getEditAdsBannerAdmin']);
			Route::post('edit/{id}',['uses'=>'AdsBannerController@postEditAdsBannerAdmin']);

		});
		Route::group(['prefix' => 'history'], function(){
			Route::get('index',['uses'=>'HistoryController@getIndex']);
			Route::get('withdrawal',['uses'=>'HistoryController@getWithdrawal']);
			Route::post('withdrawal',['uses'=>'HistoryController@postWithdrawal']);
			Route::get('detailwithdrawal/{id}',['uses'=>'HistoryController@getDetailWithdrawal']);
			Route::get('withdrawalbill/{id}',['uses'=>'HistoryController@getWithdrawalBill']);
		

		});
	});
});
Route::group(['middleware'=>'isrolemanager'], function(){
	Route::group(['prefix' => 'managersites'], function(){
		//Route::get('/',['as' => 'getStatistics', 'uses' => 'AdminController@getStatistics']);
		Route::group(['prefix' => 'debt'], function(){
			Route::get('debtofstudentjson/{studentid}',['uses'=>'DebtController@getDebtOfStudentJson']);
			Route::get('removedebt/{debtid}',['uses'=>'DebtController@getRemoveDebt']);


		});
		Route::group(['prefix' => 'account'], function(){
			Route::get('profile',['uses'=>'AccountController@getProfileManager']);
			Route::get('edit',['uses'=>'AccountController@getEditManager']);
			Route::post('edit',['uses'=>'AccountController@postEditManager']);

		});
		Route::get('/', function(){
    		return view('manager.dashboard.main');

    	});
    	Route::group(['prefix' => 'agency'], function(){
    		Route::get('listsimplejson',['uses' => 'AgencyController@getAgencyListSimpleJson']);

    	});
    	Route::group(['prefix' => 'teacher'], function(){
			Route::get('list',['as' => 'getTeacherListManager', 'uses' => 'TeacherController@getTeacherListManager']);
			Route::get('listjson/{max}/{page}',['as' => 'getTeacherListJsonAdmin', 'uses' => 'TeacherController@getTeacherListJson']);
			Route::get('totaljson',['as' => 'getTeacherTotalJsonAdmin', 'uses' => 'TeacherController@getTeacherTotalJson']);
			Route::get('detail/{id}',['as' => 'getTeacherDetailManager', 'uses' => 'TeacherController@getTeacherDetailManager']);
			Route::get('listsimplejson',['uses' => 'TeacherController@getTeacherListSimpleJson']);

		});
		Route::group(['prefix' => 'student'],function(){
			Route::get('list',['as' => 'getListStudentManager', 'uses' => 'StudentController@getListStudentManager']);
			Route::get('listjson/{max}/{page}',['as' => 'getListStudentJsonAdmin', 'uses' => 'StudentController@getListStudentJson']);
			Route::get('totaljson',['as' => 'getStudentTotalJsonAdmin', 'uses' => 'StudentController@getStudentTotalJson']);
			Route::get('detail/{id}',['as' => 'getStudentDetailManager', 'uses' => 'StudentController@getStudentDetailManager']);
			Route::get('detailjson/{id}',['uses'=> 'StudentController@getStudentDetailJson']);
			Route::get('listcoursesofstudentjson/{studentid}',['uses'=> 'StudentController@getListCoursesOfStudentJson']);
			Route::get('delete/{id}',['as' => 'getStudentDeleteAdmin', 'uses' => 'StudentController@getStudentDelete']);
			Route::get('edit/{id}',['as' => 'getStudentEditManager', 'uses' => 'StudentController@getStudentEditManager']);
			Route::post('edit/{id}',['as' => 'postStudentEditManager', 'uses' => 'StudentController@postStudentEditManager']);
			Route::get('add',['as' => 'getAddStudentManager', 'uses' => 'StudentController@getAddStudentManager']);
			Route::get('checkunique/{username?}',[ 'uses' => 'StudentController@getCheckUnique']);
			Route::post('add',['as' => 'postAddStudentManager', 'uses' => 'StudentController@postAddStudentManager']);

		});
		Route::group(['prefix' => 'course'], function(){
			Route::get('list',['as' => 'getCourseListManager', 'uses' => 'CourseController@getCourseListManager']);
			Route::get('listjson',['as' => 'getCourseListJsonAdmin', 'uses' => 'CourseController@getCourseListJson']);
			Route::get('totaljson',['as' => 'getCourseTotalJsonAdmin', 'uses' => 'CourseController@getCourseTotalJson']);

			Route::get('detail/{id}',['as' => 'getCourseDetailAdmin', 'uses' => 'CourseController@getCourseDetailManager']);
			Route::get('listcoursestudentsjson/{id}',['as' => 'getCourseStudentsListJsonAdmin', 'uses' => 'CourseController@getCourseStudentsListJsonAdmin']);
			Route::get('listallstudentsjson/{id}',['as' => 'getAllStudentsNotInCourseListJsonAdmin', 'uses' => 'CourseController@getAllStudentsNotInCourseListJsonAdmin']);
			Route::get('addstudenttosourse/{courseid}/{studentid}',['as' => 'getAddStudentToCourseAdmin', 'uses' => 'CourseController@getAddStudentToCourseAdmin']);
			Route::get('deletestudentcourse/{id}',['as' => 'getDeleteStudentCourseAdmin', 'uses' => 'CourseController@getDeleteStudentCourseAdmin']);
			Route::get('listagenciesjson',['uses' => 'CourseController@getListAgenciesJson']);
			

		});
		Route::group(['prefix' => 'attendance'],function(){
			Route::get('addjson',[ 'uses' => 'AttendanceController@getAddAttendanceJson']);
			Route::get('listjson/{max}/{page}',[ 'uses' => 'AttendanceController@getListAttendanceJson']);
			Route::get('attendancejson/{id}',[ 'uses' => 'AttendanceController@getAttendanceJson']);
			Route::get('editjson',[ 'uses' => 'AttendanceController@getEditAttendanceJson']);
			Route::get('deletejson/{id}',[ 'uses' => 'AttendanceController@getDeleteAttendanceJson']);

		});
		Route::group(['prefix' => 'check-attendance'], function(){
			Route::get('index',['as'=> 'checkAttendanceIndexManager','uses'=>'CheckAttendanceController@indexManager']);
			Route::get('listattendancesofdatejson',['uses'=>'CheckAttendanceController@getListAttendancesOfDateJson']);
			Route::get('detail/{id}',['uses'=>'CheckAttendanceController@getDetailAttendanceManager']);
			Route::get('detailattendancejson/{id}',['uses'=>'CheckAttendanceController@getDetailAttdanceJson']);
			Route::get('coursestudentslistjson/{courseid}',['uses'=>'CheckAttendanceController@getCourseStudentsListJson']);
			Route::get('lockattendancejson/{id}',['uses'=>'CheckAttendanceController@getLockAttendanceJson']);
			Route::get('liststudentsdebtjson/{id}',['uses'=>'CheckAttendanceController@getListStudentDebtJson']);
	
		});
		Route::group(['prefix' => 'payin'], function(){
			Route::get('index',['uses'=>'PayinController@getIndexPayinManager']);
			Route::get('add/{studentid}',['uses'=>'PayinController@getAddPayinManager']);
			Route::post('add/{studentid}',['uses'=>'PayinController@postAddPayinManager']);
			Route::get('detail/{id}',['uses'=>'PayinController@getDetailPayinManager']);
			Route::get('bill/{id}',['uses'=>'PayinController@getBillPayinManager']);
		});
		Route::group(['prefix' => 'payout'], function(){
			Route::get('/',['uses'=>'PayoutController@getIndexPayoutManager']);
			Route::get('index',['uses'=>'PayoutController@getIndexPayoutManager']);
			Route::get('add/{teacherid}',['uses'=>'PayoutController@getAddPayoutManager']);
			Route::post('add/{studentid}',['uses'=>'PayoutController@postAddPayoutManager']);
			Route::get('detail/{id}',['uses'=>'PayoutController@getDetailPayoutManager']);
			Route::get('bill/{id}',['uses'=>'PayoutController@getBillPayoutManager']);
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