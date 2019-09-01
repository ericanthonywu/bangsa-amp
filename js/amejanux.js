$(document).ready(function(){
	function ucfirst (str) {
		str += '';
		var f = str.charAt(0).toUpperCase();
		return f + str.substr(1);
	}

	$('ol.sortable').nestedSortable({
        handle: 'div.panel-heading',
        items: 'li',
        toleranceElement: '> div'
    });
	
	$('div.panel').on('click', '#ajaxMenuDel', function(){
		var a = $(this).attr('data-id'),
			z = confirm("Apakah anda ingin menghapus menu ini?");
			if(z==true){
				$.ajax({
					type: 'POST',
					url: 'kelola.php?r=menu/AjaxMenuDelete',
					dataType: 'json',
					data: {ajaxDelMenu: a},
					success: function(data){
						if(!data.z){
							$('#menuModal .modal-title-text').text("Tidak bisa menghapus menu yang masih mempunyai child");
						}
						else{
							$("#list_"+a).remove();
							$('#menuModal .modal-title-text').text("Menu berhasil dihapus");
						}
					},
					beforeSend: function(data){
						$('#menuModal .modal-title-text').text("Data sedang di proses");
						$('#menuModal').modal({show: true});
					}
				});
			}
		return false;
	});
	
	$('#ajaxMenuPost').click(function(){
	var yns = $('div.options ul.nav-tabs li.active').attr('data-id'),
		dxd = $('div.tab-content div.tab-pane.active').attr('data-id'),
		sd = Array(yns, dxd);
		$.ajax({
			type: 'POST',
			url: 'kelola.php?r=menu/AjaxMenuUpdate',
			dataType: 'json',
			data: {ajaxPostMenu: $('div.tab-pane.active ol.sortable').nestedSortable('toArray', {startDepthCount: 0}),
					ajaxPostCompareable: sd},
			success: function(data){
				$('#menuModal .modal-title-text').text("Menu berhasil diperbarui");
				location.reload();
			},
			beforeSend: function(data){
				$('#menuModal .modal-title-text').text("Data sedang di proses");
				$('#menuModal').modal({show: true});
			}
		});
	});
	
	$('#ajaxPostCustomLinks').click(function(){
	var yns = $('div.options ul.nav-tabs li.active').attr('data-id'),
		dxd = $('div.tab-content div.tab-pane.active').attr('data-id'),
		sd = Array(yns, dxd);
		
		if ($('#customLinksTitle').val() == '') {
			$('#customLinksTitle').focus();
		}
		else {
			$.ajax({
				type: 'POST',
				url: 'kelola.php?r=menu/AjaxPostCustomLinks',
				dataType:"json",
				data: {ajaxPostCustomLinks: $('#formAjaxPostCustomLinks').serialize(),
						ajaxPostCompareable: sd},
				success: function(data){
					$('#ajaxLoadingCustomLinks').hide();
					$('#formAjaxPostCustomLinks input').each(function(){
						$(this).prop("disabled",false);
					});
					if(data.z){
						$("<li id='list_"+data.c+"'><div class='panel panel-orange'><div class='panel-heading rounded-bottom' data-id='"+data.c+"'><div class='options'><a href='javascript:;' class='panel-collapse'><i class='icon-chevron-down'></i></a><a>Custom</a></div>"+data.a+"</div><div class='panel-body collapse'><div class='row'><div class='col-md-12' style='margin:0 0 5px 0;'>Url<input class='form-control menu_url' type='text' value='"+data.b+"' /></div><div class='col-md-6'>Judul Menu<input class='form-control menu_title' type='text' value='"+data.a+"' /></div><div class='col-md-6'>Menu Title Atribut<input class='form-control menu_title_attribute' type='text' value='"+data.a+"' /></div></div><a href='javascript:;' data-id='"+data.c+"' id='ajaxMenuDel' class='btn btn-default' style='margin-top:5px;' >Hapus</a></div></div></li>").appendTo("div.tab-pane.active ol.sortable");
					}
					else{
						$('#menuModal .modal-title-text').text("Data tidak bisa diproses");
						$('#menuModal').modal({show: true});
					}
				},
				beforeSend:  function(data){
					$('#ajaxLoadingCustomLinks').show();
					$('#formAjaxPostCustomLinks input').each(function(){
						$(this).prop("disabled",true);
					});
					$('#customLinksTitle').val("");
					$('#customLinksUrl').val("http://");
				}
			});
		}
	});
	
	$('#ajaxPostHalaman').click(function(){
	var yns = $('div.options ul.nav-tabs li.active').attr('data-id'),
		dxd = $('div.tab-content div.tab-pane.active').attr('data-id'),
		sd = Array(yns, dxd);
		$.ajax({
			type: 'POST',
			url: 'kelola.php?r=menu/AjaxPostHalaman',
			dataType: 'json',
			data: {ajaxPostHalaman:	$('#formAjaxPostHalaman').serialize(),
					ajaxPostCompareable: sd},
			success: function(data){
				if(data.z){
					var ctr=0;
					for(ctr=0;ctr<data.d;ctr++){
						$("<li id='list_"+data.c[ctr]+"'><div class='panel panel-orange'><div class='panel-heading rounded-bottom' data-id='"+data.c[ctr]+"'><div class='options'><a href='javascript:;' class='panel-collapse'><i class='icon-chevron-down'></i></a><a>Page</a></div>"+data.a[ctr]+"</div><div class='panel-body collapse'><div class='row'><div class='col-md-6'>Judul Menu<input class='form-control menu_title' type='text' value='"+data.a[ctr]+"' /></div><div class='col-md-6'>Menu Title Atribut<input class='form-control menu_title_attribute' type='text' value='"+data.a[ctr]+"' /></div></div><a href='javascript:;' data-id='"+data.c[ctr]+"' id='ajaxMenuDel' class='btn btn-default' style='margin-top:5px;' >Hapus</a></div></div></li>").appendTo("div.tab-pane.active ol.sortable");
					}

					$('#ajaxLoadingHalaman').hide();
					$('#formAjaxPostHalaman input').each(function(){
						$(this).prop("checked",false);
					});
				}
				else{
					$('#menuModal .modal-title-text').text("Data tidak bisa diproses");
					$('#menuModal').modal({show: true});
				}
			},
			beforeSend:  function(data){
				$('#ajaxLoadingHalaman').show();
				$('#formAjaxPostHalaman input').each(function(){
						$(this).prop({"checked":false, "disabled":false});
				});		
			},
		});
	});
	
	$('#ajaxPostKategori').click(function(){
	var yns = $('div.options ul.nav-tabs li.active').attr('data-id'),
		dxd = $('div.tab-content div.tab-pane.active').attr('data-id'),
		sd = Array(yns, dxd);
		$.ajax({
			type: 'POST',
			url: 'kelola.php?r=menu/AjaxPostKategori',
			dataType: 'json',
			data: {ajaxPostKategori: $('#formAjaxPostKategori').serialize(),
					ajaxPostCompareable: sd},
			success: function(data){
				if(data.z){
					var ctr=0;
					for(ctr=0;ctr<data.d;ctr++){
						$("<li id='list_"+data.c[ctr]+"'><div class='panel panel-orange'><div class='panel-heading rounded-bottom' data-id='"+data.c[ctr]+"'><div class='options'><a href='javascript:;' class='panel-collapse'><i class='icon-chevron-down'></i></a><a>Category</a></div>"+data.a[ctr]+"</div><div class='panel-body collapse'><div class='row'><div class='col-md-6'>Judul Menu<input class='form-control menu_title' type='text' value='"+data.a[ctr]+"' /></div><div class='col-md-6'>Menu Title Atribut<input class='form-control menu_title_attribute' type='text' value='"+data.a[ctr]+"' /></div></div><a href='javascript:;' data-id='"+data.c[ctr]+"' id='ajaxMenuDel' class='btn btn-default' style='margin-top:5px;' >Hapus</a></div></div></li>").appendTo("div.tab-pane.active ol.sortable");
					}
				
					$('#ajaxLoadingKategori').hide();
					$('#formAjaxPostKategori input').each(function(){
						$(this).prop({"checked":false, "disabled": false});
					});
				}
				else{
					$('#menuModal .modal-title-text').text("Data tidak bisa diproses");
					$('#menuModal').modal({show: true});
				}
			},
			beforeSend:  function(data){
				$('#ajaxLoadingKategori').show();
				$('#formAjaxPostKategori input').each(function(){
					$(this).prop("disabled",true);
				});		
			},
		});
	});

});