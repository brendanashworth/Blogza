/**
* Blogza Admin Panel Javascript file. Depends on jQuery.
*
* @author 	boboman13
* @copyright
**/

/**
* Gets the selection from the user.
**/
function getSelection() {
	return (!!document.getSelection) ? document.getSelection() :
			(!!window.getSelection) ? window.getSelection() :
			document.selection.getRange().text;
}

$(document).ready(function() {

	// Tools for the editor.
	$(".edit-tools a").click(function(event) {
		console.log(window.getSelection());


	});

	// Post creation editor.
	$("#edit-btn").click(function(event) {
		event.preventDefault();

		// Black.
		$(".container-fluid").addClass("body-dark");

		// Show our modal.
		$("#post-editor").removeClass("hide");
	});

	$("#post-editor .close").click(function(event) {
		event.preventDefault();

		// Remove blackness.
		$(".container-fluid").removeClass("body-dark");

		// Hide our modal.
		$("#post-editor").addClass("hide");

	});

	// Post creation event.
	$('#create-post').submit(function(event) {
		event.preventDefault();

		$("#create-post .loader").addClass("show");

		// Run the ajax.
		$.ajax({
			type: "POST",
		 	url: "create-post",
		 	data: {
		 		title: $("#create-post #title").val(),
		 		content: $("#create-post #content").val(),
		 	},

			complete: function(result) {
				$("#create-post .loader").removeClass("show");

				$("#create-post .msg").fadeIn('slow');
				$("#create-post .msg").html(result.responseText);

				setTimeout(function() {
					$("#create-post .msg").fadeOut('slow');
				}, 5000);
			}
		});

	});

	// Comment approval event.
	$(".vote-btn").click(function(event) {
		event.preventDefault();

		var btn = $(this);

		if(btn.attr('href').indexOf('ok') == 1) {
			var id = btn.attr('href').substring(4, 14);

			console.log(id);

			// Lets OK the comment with Ajax.
			$.ajax({
				type: "POST",
				url: "update-comment",
				data: {
					value: "true",
					comment_id: id,
				},

				complete: function(result) {
					$("#comment-".concat(id)).fadeOut('slow');

					console.log("Approved a comment: ".concat(id));
					console.log("Log: ".concat(result.responseText));
				}

			});

		} else if (btn.attr('href').indexOf('remove') == 1) {
			var id = btn.attr('href').substring(8, 18);

			// Lets kill the comment with Ajax.
			$.ajax({
				type: "POST",
				url: "update-comment",
				data: {
					value: "false",
					comment_id: id,
				},

				complete: function(result) {
					$("#comment-".concat(id)).fadeOut('slow');

					console.log("Deleted a comment: ".concat(id));
					console.log("Log: ".concat(result.responseText));
				}

			});


		}

	});

});