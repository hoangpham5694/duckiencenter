app.controller('TeacherController', function($scope, $http, API,$timeout){	
	var maxRecord = 20;
	$scope.maxRecord = maxRecord;
	$scope.sort = "asc";
	$scope.orderby = "lastname";
	$scope.keyword = "";
	 var getTotalTeachers = function(){
	 	$http.get(API + 'managersites/teacher/totaljson').then(function successCallback (response){
	
		$scope.total = response.data /maxRecord +1 ;
		console.log(response.data);
		//return response.data;
		
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	 }
	var getListTeachers = function (max, page){
		var url =API + 'managersites/teacher/listjson/'+max+'/'+page+"?orderby="+$scope.orderby+"&sort="+$scope.sort+"&key="+$scope.keyword;
		$http.get(url).then(function successCallback (response){
		getTotalTeachers();
		$scope.teachers = response.data;
		$scope.page = page;
		console.log(response.data);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
		
	 };

	 //getListTeachers(maxRecord,1);

	 $scope.getlistteacher = function(page){
	 	
	 	getListTeachers(maxRecord,page);
	 }


	 $scope.changeOrderBy = function(){
	 	console.log("change");
	 	getListTeachers($scope.maxRecord,1);
	 }
	 $scope.changeSort = function(){
	 	getListTeachers($scope.maxRecord,1);
	 }
	 $scope.changeKey = function(){
	 	getListTeachers($scope.maxRecord,1);
	 }


});