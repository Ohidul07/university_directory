@extends('layouts.app')

@section('title', 'Designations | BSMRAU')
@section('header', 'Designations')

@section('content')
  
	<div class="row">
		<div class="col">
			<div class="card shadow">
				<div class="card-header border-0">
					<h3 class="mb-0">Designation List <button class="btn btn-primary btn-sm" data-target="#exampleModal" data-toggle="modal" id="addCategory" type="button">Add Designation</button></h3>
				</div>
				<div class="card-body">
					<div id="itemsDiv">
						@include('person.designation.list_view')
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
					<h5 class="modal-title" id="exampleModalLabel">Add Designation</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>
				<form action="/designations/store" id="addForm" method="post" name="addForm">
					@csrf
					<div class="modal-body">
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Name</span>
							</div><input class="form-control" id="input_name" name="name" placeholder="Designation Name" type="text">
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
					<h5 class="modal-title" id="editModalLabel">Edit Designation</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>
				<form action="/designations/update" id="updateForm" method="post" name="updateForm">
					@csrf
					<div class="modal-body">
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Name</span>
							</div>
							<input class="form-control" id="edit_name" name="name" placeholder="Designation Name" type="text">
            			</div>
            			<input type="hidden" name="id" id="edit_id">
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
        $.post('/designations/store', $('#addForm').serialize(), function(data){
            if(data==1){
                $('#exampleModal').modal('toggle');
                $.notifyDefaults({
                    type: 'success',
                    allow_dismiss: true
                });
				$.notify('Designation added successfully.');
				var page = $('.pagination').find('.active').children().html();
				getItems('/designations/list?page='+page,'itemsDiv');
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
      $.get('/designations/edit/'+id,function(data){
          $('#edit_name').val(data[0].name);
          $('#edit_id').val(data[0].id);
	  }).fail(function(data){

      });
    }

    function deleteValue(id){
		$('.table-loading').css('display','block');
		var page = $('.pagination').find('.active').children().html();
		ask('/designations/delete/'+id,'Designation deleted successfully','/designations/list?page='+page);
    }

    function active(id){
		$('.table-loading').css('display','block');
		var page = $('.pagination').find('.active').children().html();
		ask('/designations/active/'+id,'Designation activated successfully','/designations/list?page='+page);
    }

    function deactive(id){
		$('.table-loading').css('display','block');
		var page = $('.pagination').find('.active').children().html();
		ask('/designations/deactive/'+id,'Designation deactivated successfully','/designations/list?page='+page);
    }

    $('#updateForm').submit(function(e){
		e.preventDefault();
		$('.table-loading').css('display','block');
        $.post('/designations/update', $('#updateForm').serialize(), function(data){
            if(data==1){
                $('#editModal').modal('toggle');
                $.notifyDefaults({
                    type: 'success',
                    allow_dismiss: true
				});
				var page = $('.pagination').find('.active').children().html();
				getItems('/designations/list?page='+page,'itemsDiv');
                $.notify('Designation updated successfully.');
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
