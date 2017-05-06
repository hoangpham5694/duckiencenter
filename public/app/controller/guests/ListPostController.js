app.controller('ListPostController', function($scope, $http, API,$timeout){	
	var maxRecord = 20;
	$scope.maxRecord = maxRecord;
	$scope.sltCate= "";

	$scope.txtKeyword = "";
	/* var getTotalNews = function(){
	 	$http.get(API + 'adminsites/news/totaljson').then(function successCallback (response){
	
		$scope.total = response.data /maxRecord +1 ;
		console.log(response.data);
		//return response.data;
		
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	 }*/
	var getListNews = function (max, page){
		var url= API + 'adminsites/news/listjson?max='+max+'&page='+page+'&cateid='+$scope.sltCate+'&keyword='+$scope.txtKeyword;
		console.log(url);
		$http.get(url).then(function successCallback (response){
	//	getTotalNews();
		$scope.total= response.data.length /maxRecord +1;
		$scope.newss = response.data;
		$scope.page = page;
		console.log(response.data);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
		
	 };

	 getListNews(maxRecord,1);
	 $scope.getListNews = function(cateId){
	 	$scope.cateId = cateId;
	 	getListNews(maxRecord,1);
	 }
	 $scope.changePage = function(page){
	 	
	 	getListNews(maxRecord,page);
	 }



	$scope.changeKey = function(){
		getListNews(maxRecord,1);
	}
});