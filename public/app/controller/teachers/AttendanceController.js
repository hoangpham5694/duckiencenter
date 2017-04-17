app.controller('AttendanceController', function($scope, $http, API,$timeout){	

	var getListCourses = function (){
		var url= API + 'teachersites/attendance/listcoursesofteacherjson';
		console.log(url);
		$http.get(url).then(function successCallback (response){
	//	getTotalCourses();
		$scope.courses = response.data;
	//	$scope.total = response.data.length;
	//	console.log(response.data.length);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
		
	 };
	// $scope.name="hoang";
	// console.log('sdfdf');
	 getListCourses();

	 $scope.getMonthlyIncourse = function(courseId){
	 	$scope.courseId = courseId;
	 	$scope.monthlyId = null;
	 	//alert(courseMonthlyId);
	 	var url= API + 'teachersites/attendance/listmonthlyofcoursejson/'+courseId;
		console.log(url);
		$http.get(url).then(function successCallback (response){
	//	getTotalCourses();
		$scope.monthlys = response.data;
	//	$scope.total = response.data.length;
	//	console.log(response.data.length);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	 }
	$scope.getAttendanceInMonthly = function(monthlyId){
	 //	$scope.courseId = courseId;
	 	$scope.monthlyId = monthlyId;
	 	console.log($scope.monthlyId);
	 	//alert(courseMonthlyId);
	/* 	var url= API + 'teachersites/attendance/listmonthlyofcoursejson/'+courseId;
		console.log(url);
		$http.get(url).then(function successCallback (response){
	//	getTotalCourses();
		$scope.monthlys = response.data;
	//	$scope.total = response.data.length;
	//	console.log(response.data.length);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
*/
	 }

	$scope.addAttendace = function(monthlyId){
		//console.log(monthlyId);
		$scope.modalAddAttendanceTitle = "Thêm buổi học";
		$("#modalAttdance").modal("show");
		var date = new Date();
		var date = date.getDate();
		var month = date.getMonth();
		$scope.attendanceName = "Buổi học: Tháng "+month+" - Năm "+ year;
	}



});