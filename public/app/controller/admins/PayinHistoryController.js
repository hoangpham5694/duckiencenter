app.controller('PayinHistoryController', function($scope, $http, API,$timeout){	
	var maxRecord = 30;
	$scope.maxRecord = maxRecord;

	$scope.keyword = "";
	 var getTotalPayins = function(){
	 	$http.get(API + 'adminsites/payin/api/totalpayin').then(function successCallback (response){
	
		$scope.total = response.data /maxRecord +1 ;
		console.log(response.data);
		//return response.data;
		
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	 }
	var getListPayins = function (page){
		$http.get(API + 'adminsites/payin/api/listpayin/'+$scope.maxRecord+'/'+page+"?orderby="+$scope.orderby+"&sort="+$scope.sort+"&key="+$scope.keyword).then(function successCallback (response){
		getTotalPayins();
		$scope.payins = response.data;
		$scope.page = page;
		console.log(response.data);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
		
	 };

	
	 $scope.getListPayins = function(){
	 	 getListPayins(1);
	 }
	 $scope.changeDateBegin = function(){
	 	console.log("change");
	 	 getListPayins(1);
	 }
	 $scope.changeDateEnd = function(){
	 	 getListPayins(1);
	 }
	 $scope.changeKey = function(){
	 	 getListPayins(1);
	 }
	 $scope.changePage = function(page){
	 	 getListPayins(page);
	 }
	

});