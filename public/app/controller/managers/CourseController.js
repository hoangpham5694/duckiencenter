app.controller('CourseController', function($scope, $http, API,$timeout){	
	var maxRecord = 20;
	$scope.maxRecord = maxRecord;
	$scope.sltTeacher= "";
	$scope.sltAgency = "";
	$scope.txtKeyword = "";
	 var getTotalCourses = function(){
	 	$http.get(API + 'managersites/course/totaljson').then(function successCallback (response){
	
		$scope.total = response.data /maxRecord +1 ;
		console.log(response.data);
		//return response.data;
		
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	 }
	var getListCourses = function (max, page){
		var url= API + 'managersites/course/listjson?max='+max+'&page='+page+'&teacherid='+$scope.sltTeacher+'&agencyid='+$scope.sltAgency+'&keyword='+$scope.txtKeyword;
		console.log(url);
		$http.get(url).then(function successCallback (response){
		getTotalCourses();
		$scope.courses = response.data;
		$scope.page = page;
		console.log(response.data);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
		
	 };

	 getListCourses(maxRecord,1);

	 $scope.getlistcourses = function(page){
	 	
	 	getListTeachers(maxRecord,page);
	 }
	
	$scope.getListTeachers = function(){
		console.log("get teachers");
		var url= API + 'managersites/teacher/listsimplejson';
		console.log(url);
		$http.get(url).then(function successCallback (response){
		
		$scope.teachers = response.data;

		console.log(response.data);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	}
	$scope.getListAgencies = function(){
		console.log("get agencies");

		var url= API + 'managersites/agency/listsimplejson';
		console.log(url);
		$http.get(url).then(function successCallback (response){
		
		$scope.agencies = response.data;

		console.log(response.data);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	}
	$scope.changeTeacher = function(){
		getListCourses(maxRecord,1);
	}
	$scope.changeAgency = function(){
		getListCourses(maxRecord,1);
	}
	$scope.changeKey = function(){
		getListCourses(maxRecord,1);
	}
});