app.controller('CourseStudentController', function($scope, $http, API,$timeout){	
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
		var url= API + 'adminsites/course/listcoursestudentsjson/'+id;
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

	 $scope.confirmDelete = function(id){
		var isConfirmDelete = confirm('Bạn có chắc muốn xóa học viên này khỏi lớp không');
		if(isConfirmDelete){
			$http.get(API + 'adminsites/course/deletestudentcourse/'+id).then(function successCallback (response){
				alert(response.data);
				getListStudent($scope.studentCourseId);

			}  , function errorCallback(response) {
			console.log(response);

			}) ;
		}else{
			return false;
		}
	}
	$scope.searchallstudents = function(id, keyword){
	//	console.log('id:'+id+'; keyword: '+keyword);
		var url= API + 'adminsites/course/listallstudentsjson/'+id+'?keyword='+keyword;
		console.log(url);
		$http.get(url).then(function successCallback (response){
	//	getTotalCourses();
		$scope.studentNotIns = response.data;
		//$scope.total = response.data.length;
	//	console.log(response.data.length);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	//console.log('aa');
	}
	$scope.addStudentToCourse = function(courseId, studentId){
		var url= API + 'adminsites/course/addstudenttosourse/'+courseId+'/'+studentId;
		console.log(url);
		$http.get(url).then(function successCallback (response){
			//$('#modal-add').modal('hide');
			alert(response.data);
			getListStudent(courseId);
			$scope.searchallstudents(courseId, $scope.keyword);
	
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	}

});