@extends('layouts.app')

@section('title', 'Categories | BSMRAU')
@section('header', 'Categories')

@section('content')
  
	<div class="row">
		<div class="col">
			<div class="card shadow">
				<div class="card-header border-0">
					<h3 class="mb-0">Category List <button class="btn btn-primary btn-sm" data-target="#exampleModal" data-toggle="modal" id="addCategory" type="button">Add Category</button></h3>
				</div>
				<div class="card-body">
					<div id="itemsDiv">
						@include('bsmrau.category.list_view')
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
					<h5 class="modal-title" id="exampleModalLabel">Add Category</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>
				<form action="/category/store" id="addForm" method="post" name="addForm">
					@csrf
					<div class="modal-body">
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Category Name</span>
							</div><input class="form-control" id="input_name" name="name" placeholder="Category Name" type="text">
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
					<h5 class="modal-title" id="editModalLabel">Edit Category</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>
				<form action="/category/update" id="updateForm" method="post" name="updateForm">
					@csrf
					<div class="modal-body">
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Category Name</span>
							</div>
							<input class="form-control" id="category_name" name="name" placeholder="Category Name" type="text">
            			</div>
            				<input type="hidden" name="id" id="category_id">
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
        $.post('/category/store', $('#addForm').serialize(), function(data){
            if(data==1){
                $('#exampleModal').modal('toggle');
                $.notifyDefaults({
                    type: 'success',
                    allow_dismiss: true
                });
				$.notify('Category added successfully.');
				var page = $('.pagination').find('.active').children().html();
				getItems('/category/list?page='+page,'itemsDiv');
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
      $.get('/category/edit/'+id,function(data){
          $('#category_name').val(data[0].name);
          $('#category_id').val(data[0].id);
	  }).fail(function(data){

      });
    }

    function deleteValue(id){
		$('.table-loading').css('display','block');
		ask('/category/delete/'+id,'Category deleted successfully','/category/list');
    }

    function active(id){
		$('.table-loading').css('display','block');
		ask('/category/active/'+id,'Category activated successfully','/category/list');
    }

    function deactive(id){
		$('.table-loading').css('display','block');
		ask('/category/deactive/'+id,'Category deactivated successfully','/category/list');
    }

    $('#updateForm').submit(function(e){
		e.preventDefault();
		$('.table-loading').css('display','block');
        $.post('/category/update', $('#updateForm').serialize(), function(data){
            if(data==1){
                $('#editModal').modal('toggle');
                $.notifyDefaults({
                    type: 'success',
                    allow_dismiss: true
				});
				getItems('/category/list','itemsDiv');
                $.notify('Category updated successfully.');
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
