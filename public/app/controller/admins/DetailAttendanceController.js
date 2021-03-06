app.controller('DetailAttendanceController', function($scope, $http, API,$timeout){	

	$scope.getAttendance = function(id){
		$scope.attendanceId = id;
		var url= API + 'adminsites/check-attendance/detailattendancejson/'+id;
		console.log(url);
		$http.get(url).then(function successCallback (response){
	
			$scope.attendance = response.data;
		
	//	console.log(response.data.length);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	}
	$scope.getCourseStudentList = function(id){
		var url = API + 'adminsites/check-attendance/coursestudentslistjson/'+id;
		console.log(url);
		$http.get(url).then(function successCallback (response){
	
			$scope.courseStudents = response.data;
			$scope.totalCourseStudents = response.data.length;
	//	console.log(response.data.length);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	}
	$scope.lockAttendance = function(id){
		var url = API + '/adminsites/check-attendance/lockattendancejson/'+id;
		console.log(url);
		var isConfirmLock = confirm("Bạn có chắc chắn khuốn khóa buổi học này");
		if(isConfirmLock){
			$http.get(url).then(function successCallback (response){	
				alert(response.data);
				$scope.getListStudentDebts($scope.attendanceId);
				$scope.getCourseStudentList($scope.attendanceId);
				$scope.getAttendance($scope.attendanceId);
			}  , function errorCallback(response) {
				console.log(response);
  			}) ;
		}else{
			return false;
		}
	}
	$scope.getListStudentDebts = function(id){
		var url = API + 'adminsites/check-attendance/liststudentsdebtjson/'+id;
		console.log(url);
		$http.get(url).then(function successCallback (response){
	
			$scope.studentDebts = response.data;
			$scope.totalStudentDebts = response.data.length;
	//	console.log(response.data.length);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	}
	var detailStudent = function(id){
		var url = API + 'adminsites/student/detailjson/'+id;
		var url;
		console.log(url);
		$http.get(url).then(function successCallback (response){
	
			$scope.studentDetail = response.data;
	
	//	console.log(response.data.length);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	}

	var getListDebtOfStudent = function(studentId){
		var url = API + 'adminsites/debt/debtofstudentjson/'+studentId;
		console.log(url);
		$scope.studentId = studentId;
		detailStudent(studentId);
		$http.get(url).then(function successCallback (response){
	
			$scope.debtOfStudents = response.data;
			$scope.totaldebtOfStudents = response.data.length;
	//	console.log(response.data.length);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	}
	$scope.modalStudentDebt = function(studentId){
		$("#modalDebt").modal("show");
		getListDebtOfStudent(studentId);
	}
	$scope.removeDebt = function(debtId){
		var url = API + "adminsites/debt/removedebt/"+debtId;
		console.log(url);
		detailStudent($scope.studentId);


		$http.get(url).then(function successCallback (response){
			alert(response.data);
					$scope.getAttendance($scope.attendanceId);
		$scope.getCourseStudentList($scope.attendanceId);
		$scope.getListStudentDebts($scope.attendanceId);
		getListDebtOfStudent($scope.studentId);

		}  , function errorCallback(response) {
			console.log(response);

  		}) ;
	}
});