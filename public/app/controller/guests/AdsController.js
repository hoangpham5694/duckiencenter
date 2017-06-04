app.controller('AdsController', function($scope, $http, API,$timeout){	
	var maxRecord = 40;
	$scope.maxRecord = maxRecord;


	$scope.txtKeyword = "";
	 var getTotalAds = function(){
	 	$http.get(API + 'api/totaladsjson').then(function successCallback (response){
	
		$scope.total = response.data /maxRecord +1 ;
		console.log(response.data);
		//return response.data;
		
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	 }
	var getListAds = function (max, page){
		var url= API + 'api/listadsjson?max='+max+'&page='+page+'&keyword='+$scope.txtKeyword;
		console.log(url);
		$http.get(url).then(function successCallback (response){
		getTotalAds();
		$scope.adss = response.data;
		$scope.page = page;
		console.log(response.data);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
		
	 };
	 
	 $scope.getListAds = function(){
	 	getListAds(maxRecord,1);
	 }
	 

});