@extends('layouts.app')

@section('title', 'Persons | BSMRAU')
@section('header', 'Persons')

@section('content')
	<div class="row">
		<div class="col">
			<div class="card shadow">
				<div class="card-header border-0">
					<h3 class="mb-0">Person List <button class="btn btn-primary btn-sm" data-target="#exampleModal" data-toggle="modal" id="addCategory" type="button">Add Person</button></h3>
				</div>
				<div class="card-body">
					<div id="itemsDiv">
						@include('person.person.list_view')
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
					<h5 class="modal-title" id="exampleModalLabel">Add Person</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>
				<form action="/persons/store" id="addForm" method="post" name="addForm" enctype="multipart/form-data">
					@csrf
					<div class="modal-body">
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Name</span>
							</div>
							<input class="form-control" id="" name="name" placeholder="Person Full Name" type="text" required>
						</div>
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Category</span>
							</div>
							<select class="form-control" id="category_id" name="category_id">
								<option value='' selected disabled>Select Category</option>
								@foreach($categories as $category)
								<option value='{{ $category->id }}'>{{ $category->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Sub-Category</span>
							</div>
							<select class="form-control" id="subcategory_id" name="sub_category_id">
								<option selected disabled>Select Sub-Category</option>
							</select>
						</div>
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Sub-Sub-Category</span>
							</div>
							<select class="form-control" id="subsubcategory_id" name="sub_sub_category_id">
								<option selected disabled>Select Sub-Sub-Category</option>
							</select>
						</div>
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Designation</span>
							</div>
							<select class="form-control" id="designation_id" name="designation_id">
								<option selected disabled>Select Designation</option>
								@foreach($designations as $designation)
								<option value='{{ $designation->id }}'>{{ $designation->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Contact</span>
							</div>
							<input class="form-control" id="input_name" name="contact" placeholder="Contact number" type="text">
						</div>
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Email</span>
							</div>
							<input class="form-control" id="input_name" name="email" placeholder="Email Address" type="email">
						</div>
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Image</span>
							</div>
							<input class="form-control" id="image" name="image" type="file">
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
					<h5 class="modal-title" id="editModalLabel">Edit Person</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>
				<form action="/persons/update" id="updateForm" method="post" name="updateForm" enctype="multipart/form-data">
					@csrf
					<div class="modal-body">
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Name</span>
							</div>
							<input class="form-control" id="edit_name" name="name" placeholder="Person Full Name" type="text" required>
						</div>
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Category</span>
							</div>
							<select class="form-control" id="edit_category_id" name="category_id">
								<option selected>Select Category</option>
								@foreach($categories as $category)
								<option value='{{ $category->id }}'>{{ $category->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Sub-Category</span>
							</div>
							<select class="form-control" id="edit_subcategory_id" name="sub_category_id">
								<option selected>Select Sub-Category</option>
							</select>
						</div>
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Sub-Sub-Category</span>
							</div>
							<select class="form-control" id="edit_subsubcategory_id" name="sub_sub_category_id">
								<option selected>Select Sub-Sub-Category</option>
							</select>
						</div>
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Designation</span>
							</div>
							<select class="form-control" id="edit_designation_id" name="designation_id">
								<option selected disabled>Select Designation</option>
								@foreach($designations as $designation)
								<option value='{{ $designation->id }}'>{{ $designation->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Contact</span>
							</div>
							<input class="form-control" id="edit_contact" name="contact" placeholder="Contact number" type="text">
						</div>
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Email</span>
							</div>
							<input class="form-control" id="edit_email" name="email" placeholder="Email Address" type="email">
						</div>
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-bg">Image</span>
							</div>
							<input class="form-control" id="image" name="image" type="file">
						</div>
						<img src="#" style="width: 100px;" id="edit_image">
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
		if($('#category_id').val()){
			var category_id = 1;
		}else{
			var category_id = 0;
			alert('Select Category');
		}
		if($('#designation_id').val()){
			var designation_id = 1;
		}else{
			var designation_id = 0;
			alert('Select Designation');
		}
		if(category_id==1 && designation_id==1){
			$.ajax({
				url: '/persons/store',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: new FormData(this),
				type: 'post',
				success: function(data){
					if(data==1){
		                $('#exampleModal').modal('toggle');
		                $.notifyDefaults({
		                    type: 'success',
		                    allow_dismiss: true
		                });
						$.notify('Person added successfully.');
						var page = $('.pagination').find('.active').children().html();
						getItems('/persons/list?page='+page,'itemsDiv');
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
				},
				error: function(data){
					$('.table-loading').css('display','none');
				}
			});
		}else{
			$('.table-loading').css('display','none');
		}
    });

    function editValue(id){
      $.get('/persons/edit/'+id,function(data){
          $('#edit_name').val(data['person'][0].name);
          $('#edit_category_id').val(data['person'][0].category_id);
          $('#edit_designation_id').val(data['person'][0].designation_id);
          $('#edit_contact').val(data['person'][0].contact);
          $('#edit_email').val(data['person'][0].email);
          $('#edit_id').val(data['person'][0].id);
          $('#edit_image').attr('src',data['person'][0].image);

          var html = '';
		  html += '<option value="" selected>Select Sub-Category</option>';
		  $.each(data['sub_categories'],function(key,value){
			html += '<option value="'+value.id+'">'+value.name+'</option>';
		  });
		  $('#edit_subcategory_id').html(html);
		  $('#edit_subcategory_id').val(data['person'][0].sub_category_id);

		  var html2 = '';
		  html2 += '<option value="" selected>Select Sub-Sub-Category</option>';
		  $.each(data['sub_sub_categories'],function(key,value){
			html2 += '<option value="'+value.id+'">'+value.name+'</option>';
		  });
		  $('#edit_subsubcategory_id').html(html2);
		  $('#edit_subsubcategory_id').val(data['person'][0].sub_sub_category_id);

	  }).fail(function(data){

      });
    }

    function deleteValue(id){
		$('.table-loading').css('display','block');
		var page = $('.pagination').find('.active').children().html();
		ask('/persons/delete/'+id,'Designation deleted successfully','/persons/list?page='+page);
    }

    function active(id){
		$('.table-loading').css('display','block');
		var page = $('.pagination').find('.active').children().html();
		ask('/persons/active/'+id,'Designation activated successfully','/persons/list?page='+page);
    }

    function deactive(id){
		$('.table-loading').css('display','block');
		var page = $('.pagination').find('.active').children().html();
		ask('/persons/deactive/'+id,'Designation deactivated successfully','/persons/list?page='+page);
    }

    $('#updateForm').submit(function(e){
		e.preventDefault();
		$('.table-loading').css('display','block');
		if($('#edit_category_id').val()){
			var category_id = 1;
		}else{
			var category_id = 0;
			alert('Select Category');
		}
		if($('#edit_designation_id').val()){
			var designation_id = 1;
		}else{
			var designation_id = 0;
			alert('Select Designation');
		}
		if(category_id==1 && designation_id==1){
			$.ajax({
				url: '/persons/update',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: new FormData(this),
				type: 'post',
				success: function(data){
					if(data==1){
		                $('#exampleModal').modal('toggle');
		                $.notifyDefaults({
		                    type: 'success',
		                    allow_dismiss: true
		                });
						$.notify('Person Updated successfully.');
						var page = $('.pagination').find('.active').children().html();
						getItems('/persons/list?page='+page,'itemsDiv');
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
				},
				error: function(data){
					$('.table-loading').css('display','none');
				}
			});
		}else{
			$('.table-loading').css('display','none');
		}
    })
</script>
@endsection
