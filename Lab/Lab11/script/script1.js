$(function() {
	
	$("span.tooltip").mouseover(function() {
		
		var jsonData = { 'word' : 'test' };
		
		var request = $.ajax({
			url : "script/wordJSON.php",
			type : "post",
			data : { 
				jsonData : JSON.stringify(jsonData)
			},
			contentType : "application/x-www-form-urlencoded"
		});
		
		request.done(function(response, textStatus, jqXHR) {
			var rsp = JSON.parse(response);
			console.log(rsp["definition"]);
			$(".rsp").text(rsp["definition"]);
		}).fail(function(jqXHR, textStatus, errorThrown) {
		}).always(function() {
		});
		
	});
});