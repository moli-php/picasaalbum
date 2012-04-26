$(document).ready(function() {

	$('input[name="fshowtype"]').click(function(){
		if($(this).val() == "per_album"){
			$('.albumSelect').show();
		
		}else{
			$('.albumSelect').hide().children().remove();
		}
	});
	
	$('input[name="fslideSize"]').click(function(){
		if($(this).val() == "size_custom"){
			$('.slide_custom_holder').show();
		}else{
			$('.slide_custom_holder').hide().find('input').val('');
			
		}
	});
	
});
	
