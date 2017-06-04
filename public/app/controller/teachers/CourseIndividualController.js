app.controller('CourseIndividualController', function($scope, $http, API,$timeout){	
	var maxRecord = 20;
	$scope.maxRecord = maxRecord;
	
	$scope.sltAgency = "";
	$scope.txtKeyword = "";
	 var getTotalCourses = function(){
	 	$http.get(API + 'teachersites/course/ajax/totalcourseindividual').then(function successCallback (response){
	
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
		var url= API + 'teachersites/course/ajax/listcourseindividual?max='+max+'&page='+page+'&agencyid='+$scope.sltAgency+'&keyword='+$scope.txtKeyword;
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
	 	$scope.confirmDelete = function(id){
		var isConfirmDelete = confirm('Bạn có chắc muốn xóa lớp học này không');
		if(isConfirmDelete){
			$http.get(API + 'adminsites/course/delete/'+id).then(function successCallback (response){
			console.log(response);
			console.log($scope.page + "--" + maxRecord);
			getListCourses(maxRecord,$scope.page);
		//	alert(response.data);
			}  , function errorCallback(response) {
			console.log(response);

			}) ;
		}else{
			return false;
		}
	}

	$scope.getListAgencies = function(){
		console.log("get agencies");

		var url= API + 'api/listagencysimplejson';
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