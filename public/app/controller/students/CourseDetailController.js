app.controller('CourseDetailController', function($scope, $http, API,$timeout){	
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
		var url= API + 'studentsites/course/ajax/listcoursestudents/'+id;
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

	
	
	
	
	
	
	

});