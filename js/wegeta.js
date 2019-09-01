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
				"y": ui.item.context.children[0].textContent,
				"x": ui.item.context.className,
				"w": ui.item.context.attributes[0].value,
				"v": ui.item.context.attributes[3].value,
				"u": ui.item.context.attributes[0].name,
				"t": ui.item.context.attributes[2].value,
				"s": $('ul.nav.nav-tabs li.active').attr('data-id')
			});
			$.ajax({
				type: 'POST',
				url: 'kelola.php?r=widget/AjaxAddItem',
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
	
	$('#ajaxWidgetPost').click(function(){
		var arr = [],
			zet = $('ul.nav.nav-tabs li.active').attr('data-id');
		$('.sortable.active div.strshp').each(function(index){
			var a = $(this).attr('data-kid'),
				b = $(this).prop('class'),
				c = $(this).find('span.text').text(),
				d = zet,
				e = $(this).attr('data-id'),
				f = $(this).attr('data-type'),
				g = $(this).find('input:radio:checked').val();
			arr.push({
				"a":a,
				"b":b,
				"c":c,
				"d":d,
				"e":e,
				"f":f,
				"g":g,
			});
		});
		$.ajax({
			type: 'POST',
			url: 'kelola.php?r=widget/AjaxHomeWidget',
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
		aw = $('ul.nav.nav-tabs li.active').attr('data-id');;
		$.ajax({
			type: 'POST',
			url: 'kelola.php?r=widget/AddSeparator',
			dataType: 'json',
			data: {ajaxPost: aw},
			success: function(data){
				if(!data.a){
					$('#contentModal .modal-title-text').text("Data tidak bisa diproses");
					$('#contentModal').modal({show: true});
					location.reload();
				}
				else{
					$('<div class="alert btn-midnightblue strshp" data-type="separator" data-kid='+data.b+'>Pemisah<div class="block-holder pull-right"><a class="ajaxContentDelete" href="javascript:;"><i class="icon-remove" style="color:white;text-decoration:none;padding:0 3px 0 0;line-height:25px;"></i></a></div></div>').appendTo('.sortable.active');
				}
			},
		});
		
	});
	
	$('div.panel-body').on('click', '.ajaxContentDelete', function(){
		z = $(this).parents('.strshp').attr('data-kid');
		x = $(this).parents('.strshp');
		xs = confirm("Apakah anda ingin menghapus item ini?");
		if(xs){
			$.ajax({
				type: 'POST',
				url: 'kelola.php?r=widget/AjaxRemoveItem',
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
});
