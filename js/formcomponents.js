$(function() {
    //Populate all select boxes with from select#source
    var opts=$("#source").html(), opts2="<option></option>"+opts;
    $("select.populate").each(function() { var e=$(this); e.html(e.hasClass("placeholder")?opts2:opts); });
	
	var lastResults = [];
	$("#azm12").select2({
		tags:[],
		multiple: true,
		placeholder: "Tag",
		width:'resolve',
		tokenSeparators: [","],
		minimumInputLength: 2,
		ajax: {
			multiple: true,
			url: "kelola.php?r=news/TagAjax",
			dataType: "json",
			type: "POST",
			data: function (term, page) {
				return {
					q: term
				};
			},
			results: function(data, page){
				if(data){
					return { results: data };
				}
				else{
					return { results: data };
				}
				
			}
		},
		createSearchChoice: function (term) {
			var text = term + (lastResults.some(function(r) { return r.text == term }) ? "" : " (baru)");
			return { id: term, text: text };
		},
		initSelection: function(element, callback) {
			var data = [];
			$(element.val().split(",")).each(function () {
				data.push({id: this, text: this});
			});
			callback(data);
		},
	});
	
	$("#azm1").select2({
		tags:[],
		maximumSelectionSize: 1,
		multiple: true,
		placeholder: "Running Berita",
		tokenSeparators: [","],
		minimumInputLength: 2,
		ajax: {
			multiple: true,
			url: "kelola.php?r=news/RunningAjax",
			dataType: "json",
			type: "POST",
			data: function (term) {
				return {
					q: term
				};
			},
			results: function(data){
				if(data){
					return { results: data };
				}
				else{
					return { results: data };
				}
			}
		},
		createSearchChoice: function (term) {
			var text = term + (lastResults.some(function(r) { return r.text == term }) ? "" : " (baru)");
			return { id: term, text: text };
		},
		initSelection: function(element, callback) {
			var data = [];
			$(element.val().split(",")).each(function () {
				data.push({id: this, text: this});
			});
			callback(data);
		},
	});
	
	$("#azm11").select2({
		tags:[],
		multiple: true,
		placeholder: "Tag Berita",
		tokenSeparators: [","],
		minimumInputLength: 2,
		ajax: {
			multiple: true,
			url: "kelola.php?r=news/TagAjax",
			dataType: "json",
			type: "POST",
			data: function (term) {
				return {
					q: term
				};
			},
			results: function(data){
				if(data){
					return { results: data };
				}
				else{
					return { results: data };
				}
			}
		},
		createSearchChoice: function (term) {
			var text = term + (lastResults.some(function(r) { return r.text == term }) ? "" : " (baru)");
			return { id: term, text: text };
		},
		initSelection: function(element, callback) {
			var data = [];
			$(element.val().split(",")).each(function () {
				data.push({id: this, text: this});
			});
			callback(data);
		},
	});
});