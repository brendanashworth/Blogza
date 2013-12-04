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

/**
* Gets the Post via Ajax / POST.
**/
function getPost(id, callback) {

	// Gets the post via Ajax.
	$.ajax({
		type: "POST",
		url: "get-post",
		data: {
			id: id,
		},

		complete: function(result) {
			callback(result.responseText);
		}

	});
}

/**
* Updates a comment via AJAX/POST.
**/
function updateComment(id, value) {

	// Ajax time.
	$.ajax({
		type: "POST",
		url: "update-comment",
		data: {
			value: value,
			comment_id: id,
		},

		success: function(result) {
			$("#comment-".concat(id)).fadeOut('slow');
		}
	});
}

/* Updates the post. */
function updatePost(id, content, callback) {

	// Ajax for the win!
	$.ajax({
		type: "POST",
		url: "update-post",
		data: {
			id: id,
			content: content,
		},

		success: function(result) {
			callback(result.responseText);
		}

	});
}

$(document).ready(function() {

	// Post edit listener.
	$(".edit-btn").click(function(event) {
		event.preventDefault();

		var href = $(this).attr('href');
		var id = href.substring(6, 16);
		var title = $("#post-".concat(id));
		var post = getPost(id, function(response) {

			// This is called after Ajax, which is passed $response.
			$(".container-fluid").addClass("body-dark");

			$("#edit-post").removeClass("hide");

			// Load the content.
			$("#edit-post-form .content").val(response);
			$("#edit-post-form h2").html(title);

			$("#edit-post-form input[name=id]").val(id);
		});

		
	});

	// Post creation editor.
	$("#edit-btn").click(function(event) {
		event.preventDefault();

		// Black.
		$(".container-fluid").addClass("body-dark");

		// Show our modal.
		$("#post-editor").removeClass("hide");
	});

	// Closing a modal
	$(".modal .close").click(function(event) {
		event.preventDefault();

		$(".container-fluid").removeClass("body-dark");

		$(".modal").addClass("hide");
	});

	// Submitting via the post editor.
	$('#edit-post-form').submit(function(event) {
		event.preventDefault();

		var content = $("#edit-post-form .content").val();
		var id = $("#edit-post-form input[name=id]").val();

		updatePost(id, content, function(result) {
			//$("#edit-post-form .alert").val(result);

			$("#edit-post").addClass("hide");
			$(".container-fluid").removeClass("body-dark");
		});
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

			// Lets OK the comment with Ajax.
			updateComment(id, 'yes');

		} else if (btn.attr('href').indexOf('remove') == 1) {
			var id = btn.attr('href').substring(8, 18);

			// Lets kill the comment with Ajax.
			updateComment(id, 'delete');

		}

	});

});