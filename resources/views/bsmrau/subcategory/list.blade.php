@extends('layouts.app')

@section('css')

@endsection

@section('content')
  
<div class="row">
		<div class="col">
			<div class="card shadow">
				<div class="card-header border-0">
					<h3 class="mb-0">SubCategory List <button class="btn btn-primary btn-sm" data-target="#exampleModal" data-toggle="modal" id="addSubCategory" type="button">Add SubCategory</button></h3>
				</div>
				<div class="card-body">
					<div id="itemsDiv">
						@include('bsmrau.subcategory.list_view')
					</div>
					<div class="table-loading">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="exampleModal" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-dialog-top" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add SubCategory</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>
				<form action="/subcategory/store" id="addForm" method="post" name="addForm">
					@csrf
					<div class="modal-body">
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">SubCategory Name</span>
							</div>
							<input class="form-control" id="input_name" name="name" placeholder="SubCategory Name" type="text">
						</div>
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Category Name</span>
							</div>
							<select class="form-control" id="category_id" name="category_id">
								<option value='' selected disabled>Select Category</option>
								@foreach($categories as $category)
								<option value='{{ $category->id }}'>{{ $category->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Close</button> <button class="btn btn-primary btn-sm" type="submit">Add</button>
					</div>
				</form>
			</div>
		</div>
  </div>
  <!-- edit modal -->
	<div aria-hidden="true" aria-labelledby="editModalLabel" class="modal fade" id="editModal" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-dialog-top" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editModalLabel">Edit SubCategory</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>
				<form action="/subcategory/update" id="updateForm" method="post" name="updateForm">
					@csrf
					<div class="modal-body">
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">SubCategory Name</span>
							</div>
							<input class="form-control" id="subcategory_name" name="name" placeholder="SubCategory Name" type="text">
            			</div>
            			<input type="hidden" name="id" id="subcategory_id">
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Close</button> <button class="btn btn-primary btn-sm" type="submit">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
   
@endsection

@section('script')
	<script>
		$('#addForm').submit(function(e){
			e.preventDefault();
			$('.table-loading').css('display','block');
			$.post('/subcategory/store', $('#addForm').serialize(), function(data){
				if(data==1){
					$('#exampleModal').modal('toggle');
					$.notifyDefaults({
						type: 'success',
						allow_dismiss: true
					});
					$.notify('SubCategory added successfully.');
					var page = $('.pagination').find('.active').children().html();
					getItems('/subcategory/list?page='+page,'itemsDiv');
				}
				else{
					$('#exampleModal').modal('toggle');
					$.notifyDefaults({
						type: 'danger',
						allow_dismiss: true
					});
					$.notify('Try again.Something wrong.');
					$('.table-loading').css('display','none');
				}
			})
			.fail(function(data){
				$('.table-loading').css('display','none');
			});
		});

		function editValue(id){
		$.get('/subcategory/edit/'+id,function(data){
			$('#subcategory_name').val(data.name);
			$('#subcategory_id').val(data.id);
			// console.log(data.id);
		})
		.fail(function(data){

		})
		}

		function deleteValue(id){
			$('.table-loading').css('display','block');
			$.get('/subcategory/delete/'+id,function(data){
				if(data==1){
					swal({
						title: 'Are you sure?',
						text: "You won't be able to revert this!",
						type: 'warning',
						buttons:{
							confirm: {
								text : 'Yes, delete it!',
								className : 'btn btn-success'
							},
							cancel: {
								visible: true,
								className: 'btn btn-danger'
							}
						}
					})
					.then((Delete) => {
						if (Delete) {
							swal({
								title: 'Deleted!',
								text: 'Your file has been deleted.',
								type: 'success',
								buttons : {
									confirm: {
										className : 'btn btn-success'
									}
								}
							});
							var page = $('.pagination').find('.active').children().html();
							getItems('/subcategory/list?page='+page,'itemsDiv');
						} 
						else{
							swal.close();
							$('.table-loading').css('display','none');
						}
					});
				}
				else{
					$.notifyDefaults({
						type: 'danger',
						allow_dismiss: true
					});
					$.notify('Try again.Something wrong.');
					$('.table-loading').css('display','none');
				}
		})
		.fail(function(data){
			$('.table-loading').css('display','none');
		})
		}

		$('#updateForm').submit(function(e){
			e.preventDefault();
			$('.table-loading').css('display','block');
			$.post('/subcategory/update', $('#updateForm').serialize(), function(data){
				if(data==1){
					$('#editModal').modal('toggle');
					$.notifyDefaults({
						type: 'success',
						allow_dismiss: true
					});
					var page = $('.pagination').find('.active').children().html();
					getItems('/subcategory/list?page='+page,'itemsDiv');
					$.notify('SubCategory updated successfully.');
				}
				else{
					$('#editModal').modal('toggle');
					$.notifyDefaults({
						type: 'danger',
						allow_dismiss: true
					});
					$.notify('Try again.Something wrong.');
					$('.table-loading').css('display','none');
				}
			})
			.fail(function(data){
				$('.table-loading').css('display','none');
			})
		})
	</script>
@endsection
