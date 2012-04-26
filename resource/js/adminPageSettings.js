$(document).ready(function() {
	var iSeq = $('#seq').val();
	$('input[name="picasa_view"]').click(function(){
		if($(this).val() == 1){
			$('table tr:last').show();
		
		}else{
			$('table tr:last').hide();
		}
	});

	$('input[name="picasa_showtype"]').click(function(){
		var username = $('#picasa_username');
		var option = "";
		var img = $('<img />').attr('src','/_sdk/img/picasaalbum/settings/loader_small.gif');
		var select = $('<select />').attr('id', 'albumSelect');
		if(!oValidator.formName.getMessage('picasaAlbumSettings')){
			scroll(0,0);
			return false;
		}
		
		if($(this).val() == 1){
			$('#albumSelect_holder').html(img);
				$.ajax({
					url: usbuilder.getUrl('apiPicasaAlbum'),
					dataType: 'json',
					type: 'POST',
					data : {'username':$.trim(username.val())},
					success : function(data){
						if(data){
							username.css('border','');
							$('#albumSelect').show();
							$.each(data.Data,function(k,v){
								option += '<option value="'+v.albumId+'">'+v.albumText+'</option>';
							});
							$('#albumSelect_holder').html(select.html(option));
						}else{
							$('input[name="picasa_showtype"]:first').attr('checked',true);
							username.css('border','2px solid #dc4e22');
							$('#albumSelect_holder').html("");
						}
					}
					
				});		
		}else{
			$('#albumSelect_holder').html("");
		}
	});
	
	$('input[name="picasa_slideSize"]').click(function(){
		if($(this).val() == 3){
			$('.slide_custom_holder').show();
		}else{
			$('.slide_custom_holder').hide().find('input').val('');
			
		}
	});
	
	
	$('#ButtonSave').click(function(){
	
		var username = $('#picasa_username').val();
		var view_type = $('input[name=picasa_view]:checked').val();
		var manage_album = $('input[name=picasa_showtype]:checked').val();
		var album_selected = ($('#albumSelect').val() != undefined)?$('#albumSelect').val() : false;
		var slideshow_size = parseInt($('input[name=picasa_slideSize]:checked').val());
		var width = parseInt($.trim($('#picasa_width').val()));
		var height = parseInt($.trim($('#picasa_height').val())); 
		var size = "";
		var album_ids = [];
		var album_text = [];
		if(!oValidator.formName.getMessage('picasaAlbumSettings')){
			scroll(0,0);
			return false;
		}
		if(isNaN(width))
			width = 288;
		if(isNaN(height))
			height = 192;
		
		if(manage_album == 1){
			$('#albumSelect option').each(function(k,v){
				album_ids.push(v.value);
				album_text.push(v.text);
			});
			
		}
		album_ids = album_ids.toString();
		album_ids = album_ids == "" ? false : album_ids;
		album_text = album_text.toString();
		album_text = album_text == "" ? false : album_text;
		albums = '{"album_text" : "'+album_text+'", "album_ids" : "'+album_ids+'"}';

	
		switch(slideshow_size)
		{
			case 0:
			size = '288|192';
			break;
			
			case 1:
			size = '488|325';
			break;
			
			case 2:
			size = '688|458';
			break;
			
			case 3:
			size = width+'|'+height;
			break;
			
			default:
			size = '288|192';
		}
		size = (view_type == 0)? "" : size;
	
		$.ajax({
			type: "POST",
			dataType: "json",
			url: usbuilder.getUrl('apiSettingsSave'),
			data: {	username:username,
					view_type:view_type,
					manage_album:manage_album,
					album_selected:album_selected,
					picasa_size:size,
					'size_option':slideshow_size,
					iSeq:iSeq,
					albums:albums},
			success: function(data){
				console.log(data);
				if(data !== null){
					oValidator.generalPurpose.getMessage(true, "Saved successfully");				
				}else{	
					oValidator.generalPurpose.getMessage(false, "Failed");
				}
			}
		});
		
	});
	
});
	
