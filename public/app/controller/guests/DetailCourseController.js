app.controller('DetailCourseController', function($scope, $http, API,$timeout){	
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
		var url= API + 'api/listcoursestudentsjson/'+id;
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



	$scope.getListAttendances = function(id){
		var url= API + 'api/listattendancejson/20/1?orderby=id&sort=desc&courseid='+id;
		console.log(url);
		$http.get(url).then(function successCallback (response){
	//	getTotalCourses();
		$scope.attendances = response.data;
		//$scope.total = response.data.length;
	//	console.log(response.data.length);

		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	}



	String.prototype.toDate = function(format)
	{
		var normalized      = this.replace(/[^a-zA-Z0-9]/g, '-');
		var normalizedFormat= format.toLowerCase().replace(/[^a-zA-Z0-9]/g, '-');
		var formatItems     = normalizedFormat.split('-');
		var dateItems       = normalized.split('-');

		var monthIndex  = formatItems.indexOf("mm");
		var dayIndex    = formatItems.indexOf("dd");
		var yearIndex   = formatItems.indexOf("yyyy");
		var hourIndex     = formatItems.indexOf("hh");
		var minutesIndex  = formatItems.indexOf("ii");
		var secondsIndex  = formatItems.indexOf("ss");

		var today = new Date();

		var year  = yearIndex>-1  ? dateItems[yearIndex]    : today.getFullYear();
		var month = monthIndex>-1 ? dateItems[monthIndex]-1 : today.getMonth()-1;
		var day   = dayIndex>-1   ? dateItems[dayIndex]     : today.getDate();

		var hour    = hourIndex>-1      ? dateItems[hourIndex]    : today.getHours();
		var minute  = minutesIndex>-1   ? dateItems[minutesIndex] : today.getMinutes();
		var second  = secondsIndex>-1   ? dateItems[secondsIndex] : today.getSeconds();

		return new Date(year,month,day,hour,minute,second);
	};



});