$(document).ready(function(){
	
	$( ".draggable" ).draggable({
		connectToSortable: ".sortable",
		helper: "clone",
		revert: "invalid",
	});
	
	$( ".sortable" ).sortable({
		tolerance: "touch",
		connectWith:'.draggable',
		receive: function (event, ui) {
			qwer = [];
			qwer.push({
				"z": ui.item.context.attributes[1].value,
				"y": ui.item.context.children[1].textContent,
				"x": ui.item.context.className,
				"w": ui.item.context.attributes[0].value,
				"v": ui.item.context.attributes[3].value,
				"u": ui.item.context.attributes[0].name,
				"t": ui.item.context.attributes[2].value
			});
			$.ajax({
				type: 'POST',
				url: 'kelola.php?r=content/AjaxAddItem',
				dataType: 'json',
				data: {addItem: qwer},
				success: function(data){
					if(!data.a){
						$('#contentModal .modal-title-text').text("Data tidak bisa diproses");
						$('#contentModal').modal({show: true});
						location.reload();
					}
					else if(data.b == null){
						$('#contentModal .modal-title-text').text("Data tidak bisa diproses");
						$('#contentModal').modal({show: true});
						location.reload();
					}
					else{
						$('.sortable div[data-id='+data.c+'][data-type='+data.d+']').each(function(){
							if($(this).attr('data-kid') == ''){
								$(this).attr('data-kid', data.b);
								$(this).find('input:radio').attr('name', 'jenisBlok['+data.b+']');
								$(this).find('input:radio:first').attr('checked','checked');
							}
						});
					}
				},
			});
		},
		axis: 'y',
	});
	
	$('div.panel-body').on('click', '.ajaxContentDelete', function(){
		z = $(this).parents('.strshp').attr('data-kid');
		x = $(this).parents('.strshp');
		xs = confirm("Apakah anda ingin menghapus item ini?");
		if(xs){
			$.ajax({
				type: 'POST',
				url: 'kelola.php?r=content/AjaxRemoveItem',
				dataType: 'json',
				data: {removeItem: z},
				success: function(data){
					if(!data){
						$('#contentModal .modal-title-text').text("Data tidak bisa diproses");
						$('#contentModal').modal({show: true});
						location.reload();
					}
					else{
						x.remove();
					}
				},
			});
		}
	});
	
	$('#ajaxMenuPost').click(function(){
		var arr = [];
		$('.sortable div.strshp').each(function(index){
			var a = $(this).attr('data-id'),
				b = $(this).attr('data-kid'),
				c = $(this).prop('class'),
				d = $(this).find('input:radio:checked').val(),
				e = $(this).find('span.text').text(),
				f = $(this).attr('data-type');
			arr.push({
				"a":a,
				"b":b,
				"c":c,
				"d":d,
				"e":e,
				"f":f
			});
		});
		$.ajax({
			type: 'POST',
			url: 'kelola.php?r=content/AjaxHomeBlock',
			dataType: 'json',
			data: {ajaxPost: arr},
			success: function(data){
				if(!data){
					$('#contentModal .modal-title-text').text("Data tidak bisa diproses");
					$('#contentModal').modal({show: true});
					location.reload();
				}
				else{
					$('#contentModal .modal-title-text').text("Posisi berhasil diperbarui");
					$('#contentModal').modal({show: true});
				}
			},
		});
	});
	
	$('#addSeparator').click(function(){
		$.ajax({
			type: 'POST',
			url: 'kelola.php?r=content/AddSeparator',
			dataType: 'json',
			data: {ajaxPost: "Aw"},
			success: function(data){
				if(!data.a){
					$('#contentModal .modal-title-text').text("Data tidak bisa diproses");
					$('#contentModal').modal({show: true});
					location.reload();
				}
				else{
					$('<div class="alert btn-midnightblue strshp" data-type="separator" data-kid='+data.b+'>Pemisah<div class="block-holder pull-right"><a class="ajaxContentDelete" href="javascript:;"><i class="icon-remove" style="color:white;text-decoration:none;padding:0 3px 0 0;line-height:25px;"></i></a></div></div>').appendTo('.panel-body.sortable');
				}
			},
		});
		
	});
	
});
