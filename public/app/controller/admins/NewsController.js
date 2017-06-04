app.controller('NewsController', function($scope, $http, API,$timeout){	
	var maxRecord = 20;
	$scope.maxRecord = maxRecord;
	$scope.sltCate= "";

	$scope.txtKeyword = "";
	 var getTotalNews = function(){
	 	$http.get(API + 'adminsites/news/totaljson').then(function successCallback (response){
	
		$scope.total = response.data /maxRecord +1 ;
		console.log(response.data);
		//return response.data;
		
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	 }
	var getListNews = function (max, page){
		var url= API + 'adminsites/news/listjson?max='+max+'&page='+page+'&cateid='+$scope.sltCate+'&keyword='+$scope.txtKeyword;
		console.log(url);
		$http.get(url).then(function successCallback (response){
		getTotalNews();
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

	 $scope.changePage = function(page){
	 	
	 	getListNews(maxRecord,page);
	 }
	$scope.confirmDelete = function(id){
		var isConfirmDelete = confirm('Bạn có chắc muốn xóa bài viết này không');
		if(isConfirmDelete){
			$http.get(API + 'adminsites/news/delete/'+id).then(function successCallback (response){
		//	console.log(response);
			//console.log($scope.page + "--" + maxRecord);
			alert(response.data);
			getListNews(maxRecord,$scope.page);
		//	alert(response.data);
			}  , function errorCallback(response) {
			console.log(response);


			}) ;
		}else{
			return false;
		}
	}
	$scope.getListCates = function(){
		console.log("get teachers");
		var url= API + 'adminsites/cate/listsimplejson';
		console.log(url);
		$http.get(url).then(function successCallback (response){
		
		$scope.cates = response.data;

		console.log(response.data);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	}

	$scope.changeCate = function(){
		getListNews(maxRecord,1);
	}

	$scope.changeKey = function(){
		getListNews(maxRecord,1);
	}
});