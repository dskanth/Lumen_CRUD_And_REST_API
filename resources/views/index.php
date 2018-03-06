<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>The Amazing PHP - AngularJS Single-page Application with Lumen CRUD Services</title>
	
	<!-- Load Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div ng-app="myApp" ng-controller="productsCtrl">

<!-- Table-to-load-the-data Part -->
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Description</th>
				<th>Date Created</th>
				<th>Date Updated</th>
				<th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add',0)">Add New Product</button></th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="product in products">
				<td>{{ product.id }}</td>
				<td>{{ product.name }}</td>
				<td>{{ product.description }}</td>
				<td>{{ product.created_at }}</td>
				<td>{{ product.updated_at }}</td>
				<td>
					<button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit',product.id)">Edit</button>
					<button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(product)">Delete</button>
				</td>
			</tr>
		</tbody>
	</table>
<!-- End of Table-to-load-the-data Part -->
<!-- Modal (Pop up when detail button clicked) -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">{{state}}</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal">
			
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label">Name</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" id="inputEmail3" placeholder="Product Full Name" value="{{name}}" ng-model="formData.name">
				</div>
			  </div>
			
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label">Description</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" id="inputEmail3" placeholder="Product Description" value="{{email}}" ng-model="formData.description">
				</div>
			  </div>

			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate,product_id)">Save changes</button>
		  </div>
		</div>
	  </div>	
	  </div>
</div>

<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<!-- AngularJS Application Script Part -->
<script>
	function showModal(){
				console.log('modal');
	}
	var app = angular.module('myApp', []);
	app.controller('productsCtrl', function($scope, $http) {
		$http.get("read-products")
		.success(function(response) {
			//console.log(response);
			$scope.products = response;
		});

			$scope.toggle = function(modalstate,id) {
				$scope.modalstate = modalstate;
				switch(modalstate){
					case 'add':
									$scope.state = "Add New Product";
									$scope.product_id = 0;
									$scope.name = '';
									$scope.description = '';
									break;
					case 'edit':
									$scope.state = "Product Detail";
									$scope.product_id = id;
									$http.get("read-product/" + id)
									.success(function(response) {
										//console.log(response);
										$scope.formData = response;
									});
									break;
					default: break;
				}
				
				//console.log(id);
				$('#myModal').modal('show');
			}
			
			$('#myModal').on('hidden.bs.modal', function () {
				if($scope.formData) {
					$scope.formData.name = '';
					$scope.formData.description = '';
				}
			});
			
			/* The -C- and -U- part */
			$scope.save = function(modalstate,product_id){
				switch(modalstate){
					case 'add': var url = "create-product"; break;
					case 'edit': var url = "edit-product/"+product_id; break;
					default: break;
				}
				$http({
					method  : 'POST',
					url     : url,
					data    : $.param($scope.formData),  // pass in data as strings
					headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
				}).
				success(function(response){
					//console.log(response);
					var scope_products = $scope.products;
					//console.log(scope_products);
					if(modalstate == 'edit') {
						for (var i = 0; i < scope_products.length; i++) {
							if (scope_products[i].id === response.id) {
								//console.log("Updated: "+response.id);
								scope_products[i] = response;
							}
						}
						$scope.products = scope_products;
					}
					else {
						$scope.products.push(response);
					}
					//console.log($scope.products);
					//var product_arr = {id: response.id, name: response.name, description: response.desc};
					// created_at: response.created_at | date:'Y-m-d', updated_at: response.updated_at | date:'Y-m-d'
					//$scope.products.push(product_arr);
					//$scope.products.push(response);
					//location.reload();
					$('#myModal').modal('hide');
				}).
				error(function(response){
					console.log(response);
					alert('Incomplete Form!');
				});
			}
			/* End of the -C- and -U- part */

			/* The -D- Part */
			$scope.confirmDelete = function(product){
				var isOkDelete = confirm('Is it ok to delete this?');
				if(isOkDelete){
					$http.post('delete-product', {id:product.id}).
					success(function(data){
						$scope.products.splice($scope.products.indexOf(product), 1);
						//location.reload();
					}).
					error(function(data) {
						console.log(data);
						alert('Unable to delete');
					});
				} else {
					return false;
				}
			}
			/* End of the -D- Part */

	});
</script>
<!-- End of AngularJS Application Script Part -->

</body>
</html>