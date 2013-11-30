/**
* Blogza Admin Panel Javascript file. Depends on jQuery.
*
* @author 	boboman13
* @copyright
**/

/**
* Creates a post via AJAX/POST.
**/
function createPost(title, content, box) {
	$(box.concat(" .loader")).addClass("show");

	if(title == "" || title == "Post title..."
		|| content == "" || content == "Post content...") {

		$(box.concat(" .loader")).removeClass("show");

		$(box.concat(" .msg")).fadeIn('slow');
		$(box.concat(" .msg")).html("Try being original.");

		setTimeout(function() {
			$(box.concat(" .msg")).fadeOut('slow');
		}, 5000);

		return;
	}

	// Run the ajax.
	$.ajax({
		type: "POST",
	 	url: "create-post",
	 	data: {
	 		title: title,
	 		content: content,
	 	},

		complete: function(result) {
			$(box.concat(" .loader")).removeClass("show");

			$(box.concat(" .msg")).fadeIn('slow');
			$(box.concat(" .msg")).html(result.responseText);

			setTimeout(function() {
				$(box.concat(" .msg")).fadeOut('slow');
			}, 5000);
		}
	});

}

$(document).ready(function() {

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

	// Submitting via the post editor.
	$('#post-editor-form').submit(function(event) {
		event.preventDefault();

		var title = $("#post-editor input[name=title]").val(),
		content = $("#post-editor textarea[name=content]").val();

		createPost(title, content, "#post-editor");
	});

	// Post creation event.
	$('#create-post').submit(function(event) {
		event.preventDefault();

		var title = $("#create-post #title").val(),
		content = $("#create-post #content").val();

		createPost(title, content, "#create-post");
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
					value: "yes",
					comment_id: id,
				},

				success: function(result) {
					$("#comment-".concat(id)).fadeOut('slow');
				}

			});

		} else if (btn.attr('href').indexOf('remove') == 1) {
			var id = btn.attr('href').substring(8, 18);

			// Lets kill the comment with Ajax.
			$.ajax({
				type: "POST",
				url: "update-comment",
				data: {
					value: "delete",
					comment_id: id,
				},

				success: function(result) {
					$("#comment-".concat(id)).fadeOut('slow');
				}

			});


		}

	});

});