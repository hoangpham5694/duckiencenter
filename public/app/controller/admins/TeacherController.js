app.controller('TeacherController', function($scope, $http, API,$timeout){	
	var maxRecord = 20;
	$scope.maxRecord = maxRecord;
	 var getTotalTeachers = function(){
	 	$http.get(API + 'adminsites/teacher/totaljson').then(function successCallback (response){
	
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
		$http.get(API + 'adminsites/teacher/listjson/'+max+'/'+page).then(function successCallback (response){
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

	 getListTeachers(maxRecord,1);

	 $scope.getlistteacher = function(page){
	 	
	 	getListTeachers(maxRecord,page);
	 }
	 	$scope.confirmDelete = function(id){
		var isConfirmDelete = confirm('Bạn có chắc muốn xóa giáo viên này không');
		if(isConfirmDelete){
			$http.get(API + 'adminsites/teacher/delete/'+id).then(function successCallback (response){
			console.log(response);
			console.log($scope.page);
			getListTeachers(maxRecord,$scope.page);
		//	alert(response.data);
			}  , function errorCallback(response) {
			console.log(response);

			}) ;
		}else{
			return false;
		}
	}

});