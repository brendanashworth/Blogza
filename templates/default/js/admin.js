/**
* Blogza Admin Panel Javascript file. Depends on jQuery.
*
* @author 	boboman13
* @copyright
**/

$(document).ready(function() {

	// Post creation editor.
	$('#post-editor').click(function(event) {
		event.preventDefault();
		console.log("clicked");

		$('#post-editor-modal').modal('show');
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

			// Lets OK the post with Ajax.
			$.ajax({
				type: "POST",
				url: "update-comment",
				data: {
					value: "true",
					id: id,
				},

				success: function(result) {
					$("#comment-".concat(id)).fadeOut('slow');

					console.log("Approved a comment: ".concat(id));
					console.log("Log: ".concat(result.responseText));
				}

			});

		} else if (btn.attr('href').indexOf('remove') == 1) {
			var id = btn.attr('href').substring(8, 18);

			// Lets kill the post with Ajax.
			$.ajax({
				type: "POST",
				url: "update-comment",
				data: {
					value: "false",
					id: id,
				},

				success: function(result) {
					$("#comment-".concat(id)).fadeOut('slow');

					console.log("Deleted a comment: ".concat(id));
				}

			});


		}

	});

});