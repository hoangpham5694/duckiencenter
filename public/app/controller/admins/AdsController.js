app.controller('AdsController', function($scope, $http, API,$timeout){	
	var maxRecord = 20;
	$scope.maxRecord = maxRecord;


	$scope.txtKeyword = "";
	 var getTotalAds = function(){
	 	$http.get(API + 'adminsites/ads/totaljson').then(function successCallback (response){
	
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
		var url= API + 'adminsites/ads/listjson?max='+max+'&page='+page+'&keyword='+$scope.txtKeyword;
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

	 getListAds(maxRecord,1);

	 $scope.changePage = function(page){
	 	
	 	getListAds(maxRecord,page);
	 }
	$scope.confirmDelete = function(id){
		var isConfirmDelete = confirm('Bạn có chắc muốn xóa Banner này không');
		if(isConfirmDelete){
			$http.get(API + 'adminsites/ads/delete/'+id).then(function successCallback (response){
		//	console.log(response);
			//console.log($scope.page + "--" + maxRecord);
			getListAds(maxRecord,$scope.page);
		//	alert(response.data);
			}  , function errorCallback(response) {
			console.log(response);

			}) ;
		}else{
			return false;
		}
	}



	$scope.changeKey = function(){
		getListAds(maxRecord,1);
	}
});