$(function() {
	console.log("Document ready!");

	var getComments = function() {
		$.ajax({
			url : 'comments.php',
			success : function(data) {
				$("#comments").html(data);
			}
		});
	};
	getComments();
	setInterval(getComments, 4000);

	// variable to hold request
	var request;
	// bind to the submit event of post comments form
	$("#postcomm").submit(function(event) {
		// abort any pending request
		if (request) {
			request.abort();
		}

		// Cache all the fields
		var $form = $(this);
		var $inputs = $form.find("input, textarea");
		// serialize the data in the form
		var serializedData = $form.serialize();

		// disable the inputs for the duration of the ajax request
		// Note: we disable elements AFTER the form data has been serialized.
		// Disabled form elements will not be serialized.
		$inputs.prop("disabled", true);

		// Make the request
		request = $.ajax({
			url : "comments.php",
			type : "post",
			data : serializedData
		});

		request.done(function(response, textStatus, jqXHR) {
			// log a message to the console
			if (response === 'name') {
				alert("Name empty or exceeds length of 64 char.");
				return;
			}
			if (response === 'email') {
				alert("Email is invalid.");
				return;
			}
			if (response === 'comment') {
				alert("Comment empty or exceeds 100 char.");
				return;
			}
			if (response !== 'ok') {
				alert("Unknown status.");
				return;
			}
			getComments();
			console.log("Hooray, it worked!");
		}).fail(function(jqXHR, textStatus, errorThrown) {
			// log the error to the console
			console.error("The following error occured: " + textStatus, errorThrown);
		}).always(function() {
			// reenable the inputs
			$inputs.prop("disabled", false);
			$("#name, #email, #comment").val("");
		});

		// prevent default posting of form
		event.preventDefault();
	});

});
