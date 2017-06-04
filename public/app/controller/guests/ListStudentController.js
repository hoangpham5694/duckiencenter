app.controller('ListStudentController', function($scope, $http, API,$timeout){	
	var maxRecord = 30;
	$scope.maxRecord = maxRecord;
	$scope.sort = "asc";
	$scope.orderby = "lastname";
	$scope.keyword = "";
	 var getTotalStudents = function(){
	 	$http.get(API + 'api/totalstudentjson').then(function successCallback (response){
	
		$scope.total = response.data /maxRecord +1 ;
		console.log(response.data);
		//return response.data;
		
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	 }
	var getListStudents = function (page){
		$http.get(API + 'api/liststudentjson/'+$scope.maxRecord+'/'+page+"?orderby="+$scope.orderby+"&sort="+$scope.sort+"&key="+$scope.keyword).then(function successCallback (response){
		getTotalStudents();
		$scope.students = response.data;
		$scope.page = page;
		console.log(response.data);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
		
	 };

	
	 $scope.getListStudent = function(){
	 	 getListStudents(1);
	 }
	 $scope.changeOrderBy = function(){
	 	console.log("change");
	 	getListStudents(1);
	 }
	 $scope.changeSort = function(){
	 	getListStudents(1);
	 }
	 $scope.changeKey = function(){
	 	getListStudents(1);
	 }
	 $scope.getliststudent = function(page){
	 	getListStudents(page);
	 }


});