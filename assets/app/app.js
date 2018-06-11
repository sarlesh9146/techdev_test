var app = angular.module('testApp',['ngRoute']).
config(['$routeProvider', function($routeProvider) {
	
	$routeProvider.
	when('/', {templateUrl:BASE_URL+'home/landing'}).
	when('/register', {templateUrl:BASE_URL+'home/register'}).
	when('/simple-user', {templateUrl:BASE_URL+'home/simple_user'}).
	when('/edit-user/:id', {templateUrl:BASE_URL+'home/edit_user'}).
	when('/admin', {templateUrl:BASE_URL+'home/view_user'}).
	when('/customers', {templateUrl:BASE_URL+'home/view_customer'});
	
}]);

app.controller('LoginController', ['$rootScope','$scope', '$http', function($rootScope,$scope,$http) {
	$scope.register = function() {
		 	//console.log($scope.reg);
		 	$scope.path = BASE_URL + 'register/';
		 	$http.post($scope.path, $scope.reg).success(function(data) {
		 		delete $scope.reg;
	            //console.log(data.message);
	            swal("Successfully!", data.message, "success");
	            window.location.href = '#/';
	        });
		 }
		 $scope.loginForm = function() {
		 	var datastr = $.param({
		 		email: $scope.email,
		 		pwd: $scope.pwd
		 	});
		//console.log(datastr);
		var config = {
			headers : {
				'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
			}
		}
		$http.post(BASE_URL+'login/', datastr, config).success(function(data, headers) {
			if (data.status==true) {
				if(data.user.user_type=='admin'){
					window.location.href = '#/admin';
				}
				else{
					window.location.href = '#/simple-user';
				}

			} else {
				swal("Failed !", "Please enter correct username and password", "error");
				$scope.errorMsg = "Username or password is incorrect";
			}
		})
		
	}
	
}]);

//user view controller
app.controller('UserViewController', ['$rootScope','$scope', '$http', function($rootScope,$scope, $http) {	
	var load = function() {
		$http.get(BASE_URL+'login/viewUsers/').success(function(data, headers) {
			$scope.users=data.data;
				//$scope.user_det=$rootScope.user;
			});
	}
	load();
	$scope.active = function(id) {
	    	//console.log(id);
	    	swal({
	    		title: "Are you sure?",
	    		text: "You want to update status",
	    		type: "warning",
	    		showCancelButton: true,
	    		cancelButtonText: "No, cancel !",
	    		confirmButtonColor: "#DD6B55",
	    		confirmButtonText: "Yes, Change it!",
	    		closeOnConfirm: false,
	    		closeOnCancel: false
	    	},
	    	function(isConfirm) {
	    		if (isConfirm) {
	    			$scope.path = BASE_URL + 'dashboard/changestatus/' + id;
	    			$http.post($scope.path).success(function(data) {

	    				load();
	    			});
	    			swal("Updated!", "Your Status Updated.", "success");
	                   // window.location.href = '#/admin';
	                   
	               } else {
	               	swal("Cancelled", "Your Status is safe :)", "error");
	               	window.location.href = '#/admin';
	               }
	           });
	    }
	    
	}]);

//Customer View controller
app.controller('CustomerViewController', ['$rootScope','$scope', '$http', function($rootScope,$scope, $http) {	
	var load = function() {
		$http.get(BASE_URL+'customer/viewCustomers/').success(function(data, headers) {
			$scope.customers=data.data;
				//$scope.user_det=$rootScope.user;
			});
	}
	load();
	/*$scope.active = function(id) {
	    	//console.log(id);
	    	swal({
	    		title: "Are you sure?",
	    		text: "You want to update status",
	    		type: "warning",
	    		showCancelButton: true,
	    		cancelButtonText: "No, cancel !",
	    		confirmButtonColor: "#DD6B55",
	    		confirmButtonText: "Yes, Change it!",
	    		closeOnConfirm: false,
	    		closeOnCancel: false
	    	},
	    	function(isConfirm) {
	    		if (isConfirm) {
	    			$scope.path = BASE_URL + 'dashboard/changestatus/' + id;
	    			$http.post($scope.path).success(function(data) {

	    				load();
	    			});
	    			swal("Updated!", "Your Status Updated.", "success");
	                   // window.location.href = '#/admin';
	                   
	               } else {
	               	swal("Cancelled", "Your Status is safe :)", "error");
	               	window.location.href = '#/admin';
	               }
	           });
	    }*/
	    
	}]);

app.controller('IndexCtrl', function($location, $scope, $http, $rootScope) {
	var load = function() {
		$scope.path = BASE_URL + 'login/userdetails';
		$http.get($scope.path).success(function(data, headers) {
	            //console.log(data);
	            if (data.data) {
	            	$rootScope.user = data.data;
	                //console.log($rootScope.user)
	            } else {
	            	window.location.href = BASE_URL;
	            }
	        }).error(function(data, headers) {});
	};
	load();
	$scope.logout = function() {
		$scope.path = BASE_URL + 'login/logout';
		$http.get($scope.path, $scope.login).success(function(data, headers) {
	                //delete $rootScope.user;
	                window.location.href = BASE_URL;
	            })
		.error(function(data, headers) {
		});
	}
});

app.controller('UpdateUserCtrl', function($location, $scope, $http, $routeParams) {
	$user_id = $routeParams.id;
	$scope.path = BASE_URL + 'dashboard/getuserdetails/'+$user_id;
	$http.get($scope.path).success(function(data, headers) {
            //console.log(data);
            $scope.user=data;
        });
	$scope.updateuser = function() {
	    	//console.log($scope.user);
	    	$scope.path = BASE_URL + 'dashboard/updateUserDetails';
	    	$http.post($scope.path, $scope.user).success(function(data, headers) {
	    		swal("Updated!", "This User Details Updated.", "success");
	    		window.location.href = '#/admin';

	    	});
	    }
	});

