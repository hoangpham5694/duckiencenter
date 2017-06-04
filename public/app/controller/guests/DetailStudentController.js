app.controller('DetailStudent', function($scope, $http, API,$timeout){	
	var maxRecord = 20;
	$scope.getListCoursesOfStudent = function(idStudent){
		$scope.studentId = idStudent;
		var url = API + "api/listcoursesofstudentjson/"+idStudent;
		$http.get(url).then(function successCallback (response){
			console.log(url);
			$scope.courses = response.data ;

		
		}  , function errorCallback(response) {
			console.log(response);

  		}) ;
	}



});