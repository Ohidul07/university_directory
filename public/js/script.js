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
		console.log(data);
		var html = '';
		html += '<option value="" selected disabled>Select Subcategory</option>';
		$.each(data,function(key,value){
			html += '<option value="'+value.id+'">'+value.name+'</option>';
		});
		$('#subcategory_id').html(html);
		
	}).fail(function(data){

	});
});
