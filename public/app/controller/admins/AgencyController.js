app.controller('AgencyController', function($scope, $http, API,$timeout){	
	var maxRecord = 20 	;
	$scope.maxRecord = maxRecord;
	 var getTotalAgencies = function(){
	 	$http.get(API + 'adminsites/agency/totaljson').then(function successCallback (response){
	
		$scope.total = response.data /maxRecord +1 ;
		console.log(response.data);
		//return response.data;
		
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	 }
	var getListAgencies = function (max, page){
		$http.get(API + 'adminsites/agency/listjson/'+max+'/'+page).then(function successCallback (response){
		getTotalAgencies();
		$scope.agencies = response.data;
		$scope.page = page;
		console.log(response.data);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
		
	 };

	getListAgencies(maxRecord,1);
	$scope.changePage = function(page){
		getListAgencies(maxRecord,page);
	}
	$scope.delete = function(id){
		var isConfirmDelete = confirm('Bạn có chắc muốn xóa nhóm này không');
		if(isConfirmDelete){
			$http.get(API + 'adminsites/agency/delete/'+id).then(function successCallback (response){
			console.log(response);
			console.log($scope.page);
			getListAgencies(maxRecord,$scope.page);
		//	alert(response.data);
			}  , function errorCallback(response) {
			console.log(response);

			}) ;
		}else{
			return false;
		}
	}
	$scope.modal = function(state,id,name){
		//console.log(state);
		$("#modalAdd").modal("show");
		$scope.state = state;
		switch(state){
			case 'add':
				$scope.modalTitle = "Thêm nhóm";
				
				
			break;
			case 'edit':
				$scope.modalTitle = "Sửa nhóm " + id;
				$scope.agencyId= id;
				$scope.agencyName = name;

			break;
		}
		 

		
	}
	$scope.confirm = function(state){
		switch(state){
			case 'add':
				var url= API + 'adminsites/agency/add/'+ $scope.agencyName;
			break;
			case 'edit':
				var url= API + 'adminsites/agency/edit/'+ $scope.agencyId+'/'+$scope.agencyName;
			break;

		}
		console.log(url);
		$http.get(url).then(function successCallback (response){

		//console.log(response.data);
			alert(response.data);
			$("#modalAdd").modal("hide");
			getListAgencies(maxRecord,1);
		}  , function errorCallback(response) {
			//alert("Xảy ra lỗi trong khi ");
			console.log(response.data);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	}


});