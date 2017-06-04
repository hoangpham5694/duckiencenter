app.controller('CourseDetailController', function($scope, $http, API,$timeout){	
	var maxRecord = 30;
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
		var url= API + 'teachersites/course/ajax/listcoursestudents/'+id;
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

	 $scope.getListThreads = function(courseId, page){
	 	var url= API + 'teachersites/thread/api/list/'+courseId+'/'+maxRecord+'/'+page;
		console.log(url);
		$http.get(url).then(function successCallback (response){
	//	getTotalCourses();
		$scope.threads = response.data;
	//	$scope.total = response.data.length;
	//	console.log(response.data.length);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	 }

	$scope.confirmDelete = function(id){
		var isConfirmDelete = confirm('Bạn có chắc muốn xóa nhân viên này không');
		if(isConfirmDelete){
			$http.get(API + 'adminsites/user/delete/'+id).then(function successCallback (response){
			alert(response.data);
			//console.log(response);
			//console.log($scope.page);
			getListUsers($scope.page);
		//	alert(response.data);
			}  , function errorCallback(response) {
			console.log(response);

			}) ;
		}else{
			return false;
		}
	}

	
	
	
	
	
	
	

});