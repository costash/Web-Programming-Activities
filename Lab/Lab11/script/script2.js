$(function() {
	
	$("span.tooltip").mouseover(function() {
		
		var jsonData = { 'word' : 'test' };
		
		var request = $.ajax({
			url : "script/wordXML.php",
			type : "post",
			dataType : "XML",
			data : "<content><word>test</word></content>",
			contentType : "application/x-www-form-urlencoded"
		});
		
		request.done(function(response, textStatus, jqXHR) {
			var rsp = response.firstChild.firstChild.textContent;
			console.log(rsp);
			$(".rsp").text(rsp);
		}).fail(function(jqXHR, textStatus, errorThrown) {
		}).always(function() {
		});
		
	});
});