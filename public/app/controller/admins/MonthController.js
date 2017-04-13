app.controller('MonthController', function($scope, $http, API,$timeout){	
	var maxRecord = 20;
	$scope.maxRecord = maxRecord;
	 var getTotalMonths = function(){
	 	$http.get(API + 'adminsites/month/totaljson').then(function successCallback (response){
	
		$scope.total = response.data /maxRecord +1 ;
		console.log(response.data);
		//return response.data;
		
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	 }
	var getListMonths = function (max, page){
		$http.get(API + 'adminsites/month/listjson/'+max+'/'+page).then(function successCallback (response){
		//getTotalMonths();
		$scope.months = response.data;
		$scope.page = page;
		console.log(response.data);
		}  , function errorCallback(response) {
			console.log(response);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
		
	 };

	 getListMonths(maxRecord,1);

	 $scope.getlistteacher = function(page){
	 	
	 	getListTeachers(maxRecord,page);
	 }
	$scope.confirmDelete = function(id){
		var isConfirmDelete = confirm('Bạn có chắc muốn xóa giáo viên này không');
		if(isConfirmDelete){
			$http.get(API + 'adminsites/teacher/delete/'+id).then(function successCallback (response){
			console.log(response);
			console.log($scope.page);
			getListTeachers(maxRecord,$scope.page);
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
				$scope.modalTitle = "Thêm tháng";
 				var date = new Date();
		 		var month = date.getMonth();
		 		var year = date.getFullYear();;
				$scope.month = "Tháng "+month+" - Năm "+ year;
				
			break;
			case 'edit':
				$scope.modalTitle = "Sửa tháng " + id;
				$scope.monthId = id;
				//console.log("id: "+id+" name: "+name);
				$scope.month = name;
			break;
		}
		 

		
	}
	$scope.confirmAddMonth = function(state,month){
	//	console.log(month);
		$http.get(API + 'adminsites/month/edit/'+$scope.monthId+"/"+month).then(function successCallback (response){

		//console.log(response.data);
			alert(response.data);
			$("#modalAdd").modal("hide");
			getListMonths(maxRecord,1);
		}  , function errorCallback(response) {
			//alert("Xảy ra lỗi trong khi ");
			console.log(response.data);
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  		}) ;
	}


});