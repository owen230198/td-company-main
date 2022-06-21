var uploadMedia = function(){
	$(document).on('change', '.file_input', function(event) {
		event.preventDefault();
		$('.uploadFileForm').submit();
	});
}

var ajaxUploadFile = function(){
	$(document).on('submit', '.uploadFileForm', function(event) {
		event.preventDefault();
		ajax = $(this).data('ajax');
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
        })
		.done(function(data) {
		    var json = data;
		    if((json.code) == 200){
		        if (ajax == 1) {
		        	$('input[name=csrf_test_name]').val(json.token);
		      		toastr['success'](json.message);
		      		parent_id = $('.parent_value').text();
		      		ajaxlistMedia(parent_id);
		        }else{
		        	toastr['success'](json.message);
			        setTimeout(function()
			        {
			        	window.location.reload();
			        },1000);
		        }
		    }
		    else{
		    	$('input[name=csrf_test_name]').val(json.token);
		      	toastr['error'](json.message);
		    }  
	     })
	});
}

var createDirectory = function(){
	$(document).on('submit', '.createDirForm', function(event) {
		event.preventDefault();
		ajax = $(this).data('ajax');
	    $.ajax({
	        url: $(this).attr('action'),
	        type: $(this).attr('method'),
	        data: $(this).serialize(),
	      })
	      .done(function(data) {
		    var json = JSON.parse(data);
		    if((json.code) == 200){
		        if (ajax == 1) {
		        	$('input[name=csrf_test_name]').val(json.token);
		      		toastr['success'](json.message);
		      		parent_id = $('.parent_value').text();
		      		ajaxlistMedia(parent_id);
		        }else{
		        	toastr['success'](json.message);
			        setTimeout(function()
			        {
			        	window.location.reload();
			        },1000);
		        }
		    }
		    else{
			    $('input[name=csrf_test_name]').val(json.token);
		      	toastr['error'](json.message);
		    }  
	    })
	});
}

var getDetailFile = function()
{
	$('#editMediaModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var name = button.data('name');
	  var title = button.data('title');
	  var alt = button.data('alt');
	  var caption = button.data('caption');
	  var description = button.data('description');
	  var modal = $(this);
	  modal.find('input[name=name]').val(name);
	  modal.find('input[name=title]').val(title);
	  modal.find('input[name=alt]').val(alt);
	  modal.find('input[name=caption]').val(caption);
	  modal.find('input[name=description]').val(description);
	})
}

var ajaxlistMedia = function(parent = 0){
	$.ajax({
		url: 'admin/media-ajax/'+parent,
		type: 'GET',
	})
	.done(function(data) {
		$('.list_media_ajax').html(data);
    })
}

var listMedia = function(){
	$(document).on('click', '.brown_btn', function(event) {
		event.preventDefault();
		name = $(this).data('name');
		$('.media_modal').data( "field", name);
		ajaxlistMedia();
	});
	$(document).on('click', '.img_brown_btn', function(event) {
		event.preventDefault();
		$('.list_media').toggleClass('not_photo');
	});
	$(document).on('click', '.close_media_modal', function(event) {
		event.preventDefault();
		$('.list_media').removeClass('not_photo');
	});
	$(document).on('click', '.close_media_modal', function(event) {
		event.preventDefault();
		$('.list_media').removeClass('editor_media');
	});

	$(document).on('click', '.photo_brown_btn', function(event) {
		event.preventDefault();
		$('.list_media').toggleClass('is_photo');
		$('.list_media ').toggleClass('apply_gallery');
	});
	$(document).on('click', '.close_media_modal', function(event) {
		event.preventDefault();
		$('.list_media').removeClass('is_photo');
		$('.list_media ').removeClass('apply_gallery');
	});
	$(document).on('click', '.directory_item', function(event) {
		event.preventDefault();
		parent = $(this).data('id');
		ajaxlistMedia(parent);
	});	
	$(document).on('click', '.ajax_update_list_media', function(event) {
		event.preventDefault();
		parent_id = $('.parent_value').text();
		ajaxlistMedia(parent_id);
	});			
}

var removeImg = function(){
	$(document).on('click', '.remove_img_btn', function(event) {
		event.preventDefault();
		parent = $(this).closest('.img_show');
		input = parent.find('input');
		img = parent.find('img');
		input.val('');
		img.attr('src', 'frontend/base/images/default.webp');
	});
}

var checkMediaFile = function(){
	$(document).on('click', '.list_media.not_photo .media_img', function(event) {
		event.preventDefault();
		$('.media_item').removeClass('active');
		parent = $(this).closest('.media_item');
		parent.toggleClass('active');
		field = $('.media_modal').data('field');
		src = $(this).find('.src_data').attr('src');
		json_src = parent.data('json');
		json_src = JSON.stringify(json_src);
		if (src != null || json_src != null) {
			img = $('.img_'+field);
			input = $("input[name="+field+"]");
			img.attr('src', src);
			input.val(json_src);
		}
	});

	$(document).on('click', '.list_media.is_photo .media_img', function(event) {
		event.preventDefault();
		parent = $(this).closest('.media_item');
		parent.toggleClass('active');
	});				
}

var galleryAction = function(){
	$(document).on('click', '.list_media.apply_gallery .close_media_modal', function(event) {
		event.preventDefault();
		field = $('.media_modal').data('field');
		groupitem = $(".list_media");
		item = groupitem.find(".media_item");
		for (var i = 0; i < item.length; i++){
			media_active = $('.media_item.active');
			media = media_active.find('.media_img ');
			media = media.toggleClass('photo_item');
			media = media.prepend('<i class="remove_photo_gall fa fa-times"></i>');
			if(media_active.length>0){
				$('.list_galeey_'+field).append(media);
			}
		}
	});

	$(document).on('click', '.remove_photo_gall ', function(event) {
		event.preventDefault();
		item = $(this).closest('.photo_item');
		item.remove();
	});

	$(document).on('click', '.apply_photo ', function(event) {
		event.preventDefault();
		field = $(this).data('name');
		group_photo = $('.list_galeey_'+field);
		photo = group_photo.find('.photo_item');
		var data = [];
		for (var i = 0; i < photo.length; i++){
			item = $(photo[i]);
			img = item.find('img');
			json = img.data('media');
			json = JSON.stringify(json);
			data[i] = json;
		}
		input = $("input[name="+field+"]");
		input.val(JSON.stringify(data));
		toastr['success']('Tạo thành công bộ sưu tập ảnh !');
	});

}

var clickEditMedia = function(){
	$(document).on('click', '.edit_media_btn', function(event) {
		event.preventDefault();
		id = $(this).data('id');
		$('.edit_media_modal').toggleClass('active');
		$('.edit_media_form').data('id', id);
	});	
}

var updateMedia = function(){
	$('.edit_media_form').submit(function(e) {
      e.preventDefault();
      id = $(this).data('id');
      ajax = $(this).data('ajax');
      $.ajax({
        url: 'admin/do-update/medias/'+id,
        type: 'POST',
        data: $(this).serialize(),
        
      })
      .done(function(data) {
	    var json = JSON.parse(data);
	    if((json.code) == 200){
	    	if (ajax == 1) {
		    	$('input[name=csrf_test_name]').val(json.token);
		        toastr['success'](json.message);
	        }else{
	        	toastr['success'](json.message);
		        setTimeout(function()
		        {
		        	window.location.reload();
		        },1000);	
	        }
	    }
	    else{
	      	toastr['error'](json.message);
	    }  
      })
    });
}

var confirmRemoveDataFile = function()
{
	$(document).on('click', '.delete_media_btn', function(event) {
		event.preventDefault();
		var id = $(this).data('id');
		$( ".confirmRemoveFileForm input[name=remove_id]" ).val(id);
	});
}

var removeDataFile = function()
{ 
	$('.confirmRemoveFileForm').submit(function(event) {
		event.preventDefault();
		ajax = $(this).data('ajax');
		$.ajax({
			url: 'admin/remove',
			type: 'POST',
			data: $(this).serialize(),
		})
		.done(function(data) {
			var json = JSON.parse(data);
		    if((json.code) == 200){
		        if (ajax == 1) {
		        	$('input[name=csrf_test_name]').val(json.token);
			      	toastr['success'](json.message);
			      	$('#deleteMediaModal').modal('toggle');
			      	parent_id = $('.parent_value').text(); 
			      	ajaxlistMedia(parent_id);
		        }else{
		        	toastr['success'](json.message);
			        setTimeout(function()
			        {
			        	window.location.reload();
			        },1000);	
		        }
		    }
		    else{
		    	$('input[name=csrf_test_name]').val(json.token);
		      	toastr['error'](json.message);
		    } 
	    })
	});
}

var loadMoreMedia = function(){
	var loading = false;
	var track_page = 0;
	var finish = false;
	var loadpage = function(index) {	
	    if (loading == false && !finish) {
	        loading = true;
	        var a = $('.list_media_ajax').parent().find('.te-pagination .active').next();
	        var a = a.find('a');
	        if(a.length>0){
	            $('<div style="width: 100%;text-align: center;" class="spinner-loadmore"></div>').insertBefore($('.te-pagination').last());
	            $.ajax({
	                url: a.attr('href'),
	                type: 'GET',
	                global:false,
	                dataType: 'html',
	            })
	            .done(function(data) {
	            	loading = false;
	                $('.te-pagination').remove();
	                $('.list_media_ajax').append(data);
	            })
	            .always(function() {
	                $('.spinner-loadmore').remove();
	            });
	            
	        }
	        else{
	        	loading = false;
	            finish = true;
	        }
	    }
	}
    $( ".media_modal .modal-dialog .modal-content" ).scroll(function() {
        if (!loading && $( ".media_modal .modal-dialog .modal-content" ).scrollTop() + $( ".media_modal .modal-dialog .modal-content" ).height() >= $('.list_media_ajax').height() - 20) {
            track_page++;
            loadpage(track_page);
        }
    });
    $(document).on('click', '.close_media_modal', function(event) {
		event.preventDefault();
		loading = false;
		finish = false;
	});

	$(document).ajaxComplete(function(event, xhr, settings) {
		loading = false;
		finish = false;
	});
}

var filterMedia = function()
{ 
	$(document).on('change', '.media_select_order', function(event) {
		event.preventDefault();
		$('.filterMediaForm').submit();
	});
	$(document).on('submit', '.filterMediaForm', function(event) {
		event.preventDefault();
		$.ajax({
			url: $(this).attr('action'),
			type: 'GET',
			data: $(this).serialize(),
		})
		.done(function(data) {
			$('.list_media_ajax').html(data);
	    });
	});
}

$(function(){
	uploadMedia();
	ajaxUploadFile();
	createDirectory();
	getDetailFile();
	listMedia();
	loadMoreMedia();
	removeImg();
	checkMediaFile();
	galleryAction();
	clickEditMedia();
	updateMedia();
	confirmRemoveDataFile();
	removeDataFile();
	filterMedia();
});