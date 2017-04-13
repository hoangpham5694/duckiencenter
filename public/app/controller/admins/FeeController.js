app.controller('FeeController', function($scope, $http, API,$timeout){	

	var getListMonths = function (id){
		var url= API + 'adminsites/fee/listcoursemonthlys/'+id;
		console.log(url);
		$http.get(url).then(function successCallback (response){
	//	getTotalCourses();
		$scope.months = response.data;
	//	$scope.total = response.data.length;
	//	console.log(response.data.length);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
		
	 };


	 $scope.getlistmonths = function(id){
	 	$scope.courseId = id;
	 	getListMonths(id);
	 }
	 $scope.getStudentInMonth = function(courseMonthlyId){
	 	$scope.courseMonthlyId = courseMonthlyId;
	 	//alert(courseMonthlyId);
	 	var url= API + 'adminsites/fee/liststudentinmonthjson/'+courseMonthlyId;
		console.log(url);
		$http.get(url).then(function successCallback (response){
	//	getTotalCourses();
		$scope.students = response.data;
	//	$scope.total = response.data.length;
	//	console.log(response.data.length);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	 }

	$scope.refreshMonth = function(courseId){
		var url= API + 'adminsites/fee/refreshmonthly/'+courseId;
		console.log(url);
		$http.get(url).then(function successCallback (response){
			alert(response.data);
			getListMonths($scope.courseId);
	//	getTotalCourses();
	//	$scope.students = response.data;
	//	$scope.total = response.data.length;
	//	console.log(response.data.length);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	}
	$scope.refreshStudentMonthly = function(courseId, courseMonthlyId){
		//console.log("courseId: "+ courseId);
		//console.log("courseMonthLyId: "+ courseMonthlyId);
		if(courseId == null || courseMonthlyId== null){
			return false;
		}
		var url= API + 'adminsites/fee/refreshstudentmonthly/'+courseId+'/'+courseMonthlyId;
		console.log(url);
		$http.get(url).then(function successCallback (response){
			alert(response.data);
			getListMonths($scope.courseId);
			 $scope.getStudentInMonth(courseMonthlyId);
	//	getTotalCourses();
	//	$scope.students = response.data;
	//	$scope.total = response.data.length;
	//	console.log(response.data.length);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	}



});