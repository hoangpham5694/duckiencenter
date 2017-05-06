app.controller('UserController', function($scope, $http, API,$timeout){	
	var maxRecord = 30;
	$scope.maxRecord = maxRecord;
	$scope.sort = "asc";
	$scope.orderby = "lastname";
	$scope.keyword = "";
	 var getTotalUsers = function(){
	 	$http.get(API + 'adminsites/user/totaljson').then(function successCallback (response){
	
		$scope.total = response.data /maxRecord +1 ;
		console.log(response.data);
		//return response.data;
		
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	 }
	var getListUsers = function (page){
		$http.get(API + 'adminsites/user/listjson/'+$scope.maxRecord+'/'+page+"?orderby="+$scope.orderby+"&sort="+$scope.sort+"&key="+$scope.keyword).then(function successCallback (response){
		getTotalUsers();
		$scope.users = response.data;
		$scope.page = page;
		console.log(response.data);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
		
	 };

	
	 $scope.getlistuser = function(){
	 	 getListUsers(1);
	 }
	 $scope.changeOrderBy = function(){
	 	console.log("change");
	 	getListUsers(1);
	 }
	 $scope.changeSort = function(){
	 	getListUsers(1);
	 }
	 $scope.changeKey = function(){
	 	getListUsers(1);
	 }
	 $scope.getlistuserspage = function(page){
	 	getListUsers(page);
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