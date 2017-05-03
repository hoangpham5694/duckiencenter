app.controller('DetailStudent', function($scope, $http, API,$timeout){	
	var maxRecord = 20;
	$scope.getListCoursesOfStudent = function(idStudent){
		$scope.studentId = idStudent;
		var url = API + "adminsites/student/listcoursesofstudentjson/"+idStudent;
		$http.get(url).then(function successCallback (response){
			console.log(url);
			$scope.courses = response.data ;

		
		}  , function errorCallback(response) {
			console.log(response);

  		}) ;
	}
	$scope.modalAdd = function(){
		$("#modalCourse").modal("show");
		var url = API + "adminsites/course/listagenciesjson";
		$http.get(url).then(function successCallback (response){
			console.log(url);
			$scope.agencies = response.data ;

		
		}  , function errorCallback(response) {
			console.log(response);

  		}) ;
	}
	$scope.agencyId = "";
	$scope.teacherId = "";
	var getListAllCourse = function(max,page){
		var url = API + "adminsites/course/listjson?max="+max+"&page="+page+"&agencyid="+$scope.agencyId;
		console.log(url);
		$http.get(url).then(function successCallback (response){
			$scope.allCourses = response.data;
		}  , function errorCallback(response) {
			console.log(response);

  		}) ;
	}
	$scope.changeAgency = function(agencyId){
		console.log(agencyId);
		$scope.agencyId = agencyId;
		getListAllCourse(maxRecord,1);
	}
	$scope.acceptCourse = function(courseId, studentId){
		var confirmAcceptCourse = confirm("Bạn chắc chắn muốn đăng kí lớp học này?");
		if(confirmAcceptCourse){
			var url = API + "adminsites/course/addstudenttosourse/"+courseId+"/"+studentId;
			$http.get(url).then(function successCallback (response){
				alert(response.data);
				$scope.getListCoursesOfStudent(studentId);
			//$scope.allCourses = response.data;
			}  , function errorCallback(response) {
			console.log(response);
  			}) ;
		}
	}
	$scope.deleteCourseStudent = function(courseStudentId){
		var confirmAcceptCourse = confirm("Bạn chắc chắn muốn rời lớp học này?");
		if(confirmAcceptCourse){
			var url = API + 'adminsites/course/deletestudentcourse/'+courseStudentId;
			$http.get(url).then(function successCallback (response){
				alert(response.data);
				$scope.getListCoursesOfStudent($scope.studentId);
			//$scope.allCourses = response.data;
			}  , function errorCallback(response) {
			console.log(response);
  			}) ;
		}
	}
});