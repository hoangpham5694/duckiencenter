app.controller('CheckAttendanceController', function($scope, $http, API,$timeout){	
	
	$scope.isTaught = "";
	$scope.studyDate = new Date();

	
	var getListAttendances = function (){
		var date = $scope.studyDate;
		var dateDay = date.getDate();
		var dateMonth = date.getMonth();
		dateMonth++;
		var dateYear = date.getFullYear();
		var url = API + 'managersites/check-attendance/listattendancesofdatejson?date='+dateYear+'-'+dateMonth+'-'+dateDay+'&istaught='+$scope.isTaught;
		console.log(url);
		$http.get(url).then(function successCallback (response){
	
		$scope.attendances = response.data;
		
		console.log(response.data);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
		
	 };

	
	 $scope.getListAttendances = function(){
	 	 getListAttendances();
	 }
	 $scope.changeIsTaught = function(){
	 	console.log("change");
	 	getListAttendances();
	 }
	 $scope.changeStudyDate = function(){
	 	getListAttendances();
	 }



});