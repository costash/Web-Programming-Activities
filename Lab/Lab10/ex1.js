console.log("Sa încărcat fișierul js");

$(document).ready(function($) {
	console.log("S-a încărcat pagina");

	var click = 0;
	var dbclick = 0;
	$("#clicks").text(click);
	$("#dbclicks").text(dbclick);

	var DELAY = 2000;
	var timeout = setTimeout(function() {
		var cookieValue = $.cookie("hideDialog");
		if (!cookieValue) {
			$("#dialog").dialog();
		}
	}, DELAY);

	$("#btn").click(function() {
		click++;
		$("#clicks").text(click);
	});

	$("#btn").dblclick(function() {
		click -= 2;
		dbclick++;
		$("#dbclicks").text(dbclick);

		if (click === dbclick) {
			alert("You cached me!");
		}
	});

	$("#hide").click(function() {
		$.cookie("hideDialog", "1", {
			expires : 30
		});
		$("#dialog").hide();
	});

	function validateEmail(email) {
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}
	
	$("#submit").click(function() {
		if (validateEmail($("#email").val())) {
			$("#dialog").hide();
			$("#newdialog").dialog();
			$("#succes").text("successss");
			$("#newdialog").show();
			console.log($("#email").val());
		} else {
			$("#error").text("EROARE email");
			$("#dialog").show();
		}
	});

}); 