$(document).ready(function(){
	$('a.doComments').click(function(){
		var	azx = $(this).attr('data-id');
			azr = $(this).attr('data-sts'),
			azz = $(this);
				if(azr == 0){
					azz.attr('data-sts', '1');
					azz.text("Tidak Setuju (Sudah Disetujui)");
				}
				else if(azr == 1){
					azz.attr('data-sts', '0');
					azz.text("Setuju (Belum Disetujui)");
				}
		$.ajax({
			type: 'POST',
			url: 'kelola.php?r=comments/AjaxApproveThis',
			dataType: 'json',
			data: {approve: azx, thisthat: azr },
			success: function(data){
			},
		});
	});
});