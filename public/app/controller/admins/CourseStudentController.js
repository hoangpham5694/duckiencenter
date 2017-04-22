app.controller('CourseStudentController', function($scope, $http, API,$timeout){	
//	var maxRecord = 30;
//	$scope.maxRecord = maxRecord;
/*	 var getTotalCourses = function(){
	 	$http.get(API + 'adminsites/course/totaljson').then(function successCallback (response){
	
		$scope.total = response.data /maxRecord +1 ;
		console.log(response.data);
		//return response.data;
		
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	 }
	 */
	var getListStudent = function (id){
		var url= API + 'adminsites/course/listcoursestudentsjson/'+id;
		console.log(url);
		$http.get(url).then(function successCallback (response){
	//	getTotalCourses();
		$scope.students = response.data;
		$scope.total = response.data.length;
	//	console.log(response.data.length);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
		
	 };

	 $scope.getliststudents = function(id){
	 	$scope.studentCourseId = id;
	 	getListStudent(id);
	 }

	 $scope.confirmDelete = function(id){
		var isConfirmDelete = confirm('Bạn có chắc muốn xóa học viên này khỏi lớp không');
		if(isConfirmDelete){
			$http.get(API + 'adminsites/course/deletestudentcourse/'+id).then(function successCallback (response){
				alert(response.data);
				getListStudent($scope.studentCourseId);

			}  , function errorCallback(response) {
			console.log(response);

			}) ;
		}else{
			return false;
		}
	}
	$scope.searchallstudents = function(id, keyword){
	//	console.log('id:'+id+'; keyword: '+keyword);
		var url= API + 'adminsites/course/listallstudentsjson/'+id+'?keyword='+keyword;
		console.log(url);
		$http.get(url).then(function successCallback (response){
	//	getTotalCourses();
		$scope.studentNotIns = response.data;
		//$scope.total = response.data.length;
	//	console.log(response.data.length);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	//console.log('aa');
	}
	$scope.addStudentToCourse = function(courseId, studentId){
		var url= API + 'adminsites/course/addstudenttosourse/'+courseId+'/'+studentId;
		console.log(url);
		$http.get(url).then(function successCallback (response){
			//$('#modal-add').modal('hide');
			alert(response.data);
			getListStudent(courseId);
			$scope.searchallstudents(courseId, $scope.keyword);
	
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	}
		$scope.getListAttendances = function(id){
		var url= API + 'adminsites/attendance/listjson/20/1?orderby=id&sort=desc&courseid='+id;
		console.log(url);
		$http.get(url).then(function successCallback (response){
	//	getTotalCourses();
		$scope.attendances = response.data;
		//$scope.total = response.data.length;
	//	console.log(response.data.length);

		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	}
	$scope.setName = function(){
		var fulldate = $scope.studyDate;
		var date = fulldate.getDate();
		var month = fulldate.getMonth()+1;
		var year = fulldate.getFullYear();;
		$scope.nameAttendance = "Buổi "+date+"-"+month+"-"+ year;
	}

	$scope.confirmAddAttendance = function(name, studyDate, state){
		studyDateDay = studyDate.getDate();
		studyDateMonth = studyDate.getMonth();
		studyDateYear = studyDate.getFullYear();
		switch(state){
			case 'add':
				var url = API+ 'adminsites/attendance/addjson?courseid='+$scope.studentCourseId+'&name='+name+'&date='+studyDateYear+'-'+studyDateMonth+'-'+studyDateDay;

			break;
			case 'edit':
				var url = API+ 'adminsites/attendance/editjson?attendanceid='+$scope.idAttendance+'&name='+name+'&date='+studyDateYear+'-'+studyDateMonth+'-'+studyDateDay;

			break;
		}
				console.log(url);
		$http.get(url).then(function successCallback (response){
			//$('#modal-add').modal('hide');
			alert(response.data);
			//getListStudent(courseId);
		//	$scope.searchallstudents(courseId, $scope.keyword);
			$("#modal-attendance").modal('hide');
			$scope.getListAttendances($scope.studentCourseId);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	}

	String.prototype.toDate = function(format)
	{
		var normalized      = this.replace(/[^a-zA-Z0-9]/g, '-');
		var normalizedFormat= format.toLowerCase().replace(/[^a-zA-Z0-9]/g, '-');
		var formatItems     = normalizedFormat.split('-');
		var dateItems       = normalized.split('-');

		var monthIndex  = formatItems.indexOf("mm");
		var dayIndex    = formatItems.indexOf("dd");
		var yearIndex   = formatItems.indexOf("yyyy");
		var hourIndex     = formatItems.indexOf("hh");
		var minutesIndex  = formatItems.indexOf("ii");
		var secondsIndex  = formatItems.indexOf("ss");

		var today = new Date();

		var year  = yearIndex>-1  ? dateItems[yearIndex]    : today.getFullYear();
		var month = monthIndex>-1 ? dateItems[monthIndex]-1 : today.getMonth()-1;
		var day   = dayIndex>-1   ? dateItems[dayIndex]     : today.getDate();

		var hour    = hourIndex>-1      ? dateItems[hourIndex]    : today.getHours();
		var minute  = minutesIndex>-1   ? dateItems[minutesIndex] : today.getMinutes();
		var second  = secondsIndex>-1   ? dateItems[secondsIndex] : today.getSeconds();

		return new Date(year,month,day,hour,minute,second);
	};
	$scope.modalAttendance = function(state,id){
		$scope.attendanceState = state;
		$("#modal-attendance").modal('show');
		switch(state){
			case 'add':
				$scope.modalAttendanceTitle ="Thêm buổi học";
			break;
			case 'edit':
			$scope.modalAttendanceTitle ="Sửa buổi học";
			var url= API + 'adminsites/attendance/attendancejson/'+id;
			console.log(url);
			$http.get(url).then(function successCallback (response){
				var attendance = response.data;
				$scope.nameAttendance = attendance.name;
				var studyDate = attendance.study_date;
				//var part = 
				$scope.studyDate = studyDate.toDate("yyyy-mm-dd");
				$scope.idAttendance = attendance.id;
				}  , function errorCallback(response) {
					console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
			}) ;
			break;
		}
	}
		$scope.deleteAttendance = function(id){
		var isConfirmDelete = confirm('Bạn có chắc muốn buổi học này không');
		if(isConfirmDelete){
			$http.get(API + 'adminsites/attendance/deletejson/'+id).then(function successCallback (response){
				console.log(response);
				alert(response.data);
				$scope.getListAttendances($scope.studentCourseId);
		//	
			}  , function errorCallback(response) {
				console.log(response);

			}) ;
		}else{
			return false;
		}
	}

});