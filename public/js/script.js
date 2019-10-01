$('#editModal').on('hide.bs.modal',function(e){
	$('#updateForm').trigger('reset');
});

$('#exampleModal').on('hide.bs.modal',function(e){
	$('#addForm').trigger('reset');
});

$(document).on('click','.pagination a',function(e){
	e.preventDefault();
	$('.table-loading').css('display','block');
	var url = $(this).attr('href');
    getItems(url);
});

function getItems(url,divId='itemsDiv'){
	$.get(url,function(data){
        $('#'+divId).html(data);
        $('.table-loading').css('display','none');
	}).fail(function(data){
        errorAlert('Something is wrong. Please try again');
        $('.table-loading').css('display','none');
	});
}

$('#category_id').change(function(){
	$.get('/subsubcategory/getSubCategory/'+$('#category_id').val(),function(data){
		var html = '';
		html += '<option value="" selected disabled>Select Sub-Category</option>';
		$.each(data,function(key,value){
			html += '<option value="'+value.id+'">'+value.name+'</option>';
		});
		$('#subcategory_id').html(html);
		
	}).fail(function(data){

	});
});

$('#subcategory_id').change(function(){
	$.get('/subsubcategory/getSubSubCategory/'+$('#subcategory_id').val(),function(data){
		var html = '';
		html += '<option value="" selected disabled>Select Sub-Sub-Category</option>';
		$.each(data,function(key,value){
			html += '<option value="'+value.id+'">'+value.name+'</option>';
		});
		$('#subsubcategory_id').html(html);
		
	}).fail(function(data){

	});
});

$('#edit_category_id').change(function(){
	$.get('/subsubcategory/getSubCategory/'+$('#edit_category_id').val(),function(data){
		var html = '';
		html += '<option value="" selected disabled>Select Sub-Category</option>';
		$.each(data,function(key,value){
			html += '<option value="'+value.id+'">'+value.name+'</option>';
		});
		$('#edit_subcategory_id').html(html);
		
	}).fail(function(data){

	});
});

$('#edit_subcategory_id').change(function(){
	$.get('/subsubcategory/getSubSubCategory/'+$('#edit_subcategory_id').val(),function(data){
		var html = '';
		html += '<option value="" selected disabled>Select Sub-Sub-Category</option>';
		$.each(data,function(key,value){
			html += '<option value="'+value.id+'">'+value.name+'</option>';
		});
		$('#edit_subsubcategory_id').html(html);
		
	}).fail(function(data){

	});
});

function ask(url,successMsg,successUrl){
	swal({
		title: 'Are you sure?',
		// text: "You won't be able to revert this!",
		type: 'warning',
		buttons:{
			confirm: {
				text : 'Confirm',
				className : 'btn btn-success'
			},
			cancel: {
				visible: true,
				className: 'btn btn-danger'
			}
		}
	}).then((Delete) => {
		if (Delete) {
			$.get(url,function(data){
	          	if(data==1){
	            	$.notifyDefaults({
	                    type: 'success',
	                    allow_dismiss: true
					});
					$.notify(successMsg);
					getItems(successUrl,'itemsDiv');
	          	}
	          	else{
	                $.notifyDefaults({
	                    type: 'danger',
	                    allow_dismiss: true
	                });
					$.notify('Try again.Something wrong.');
					$('.table-loading').css('display','none');
	            }
			}).fail(function(data){
				$.notifyDefaults({
                    type: 'danger',
                    allow_dismiss: true
                });
				$.notify('Try again.Something wrong.');
				$('.table-loading').css('display','none');
		    });
		}
		else{
			swal.close();
			$('.table-loading').css('display','none');
		}
	});
}