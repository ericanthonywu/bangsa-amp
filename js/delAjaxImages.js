$(document).ready(function(){

	$('.edit-caption').on('click', function(){
		zx = $(this).parents('.row').find('.caption-title').attr('data-text');
		zc = $(this).parents('.row').find('.caption-desc').attr('data-text');
		zxzcc = $(this).attr('data-id');
		$('.modal .modal-title').text("Edit Caption");
		$('.modal .save-caption').attr('data-id',zxzcc);
		$('.modal .caption-title').val(zx);
		$('.modal .caption-desc').val(zc);
		$('.modal').modal({show: true});
	});
	
	$('.save-caption').click(function(){
		a = $(this).attr('data-id'),
		ss = $(this).attr('data-modul'),
		b = $('.modal .caption-title').val(),
		c = $('.modal .caption-desc').val();
		$.ajax({
			type:"POST",
			url: 'AjaxEditCaption',
			dataType: 'json',
			data: {editCaption: a, editCaptions: b, editCaptionss: c },
			success: function(data){
				if(data.a){
					$('div.col-md-12 [data-diff='+a+']').find('.caption-title').text(b);
					$('div.col-md-12 [data-diff='+a+']').find('.caption-title').attr('data-text', b);
					$('div.col-md-12 [data-diff='+a+']').find('.caption-desc').text(c);
					$('div.col-md-12 [data-diff='+a+']').find('.caption-desc').attr('data-text', c);
					alert("Edit Caption Berhasil");
					$('.modal').modal("hide");
				}
				else{
					$('.modal .modal-title').text("Ada yang salah");
					$('.modal').modal({show: true});
				}
			},
		});
	});
	
	$('.delete-caption').click(function(){
		zx = confirm("Apakah anda ingin menghapus gambar ini?");
		if(zx){
			a = $(this).attr('data-id'),
			ss = $(this).attr('data-modul'),
			b = $('.teenage-journalism.just-once');
			asx = $('.just-once').length;
			$.ajax({
				type:"POST",
				url: 'AjaxEditCaption',
				dataType: 'json',
				data: {deleteAjax: a},
				success: function(data){
					if(data){
						b.remove();
						if(asx == 1){
							$('.btn.btn-success.fileinput-button').removeClass('disabled');
							$('.btn.btn-success.fileinput-button input').attr('disabled',false);
						}
					}
					else{
						$('.modal .modal-title').text("Ada yang salah");
						$('.modal').modal({show: true});
					}
				},
			});
		}
	});
	
	if($('.just-once').length > 0){
		$('.btn.btn-success.fileinput-button input').attr('disabled',true);
	}
	
});