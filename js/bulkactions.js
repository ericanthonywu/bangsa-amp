$(document).ready(function(){
	function getValueUsingClass(){
		var chkArray = [];
		/* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
		$(".bulk-act input[type=checkbox]:checked").each(function() {
			chkArray.push($(this).val());
		});
		/* we join the array separated by the comma */
		var selected;
		selected = chkArray.join(',') + ",";
		return selected;
	}
	
	$('#applyBulk').click(function(){
		z = $(this).attr('data-id');
		if($('select[name=mass_act]').val() == 'del'){
			$.ajax({
				type: 'POST',
				url: 'kelola.php?r='+z+'/DelActAjax',
				data: {ajaxCall: getValueUsingClass},
				beforeSend:  function(data){
					window.location.reload(true); //here
				}
			});
		}
		else{}
	});
});