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

	if(title === "" || title == "Post title..." || content === "" || content == "Post content...") {

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
	 		content: content
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

/* Gets the Post via Ajax / POST. It returns JSON. */
function getPost(id, callback) {

	// Gets the post via Ajax.
	$.ajax({
		type: "POST",
		url: "get-post",
		data: {
			id: id
		},

		complete: function(result) {
			callback(jQuery.parseJSON(result.responseText));
		}

	});
}

/* Gets the User via Ajax / POST. It returns JSON. */
function getUser(name, callback) {

	// Gets the user via Ajax.
	$.ajax({
		type: "POST",
		url: "get-user",
		data: {
			user: name
		},

		complete: function(result) {
			callback(jQuery.parseJSON(result.responseText));
		}

	});

}

/* Saves the user via Ajax / POST. It returns JSON. */
function saveUser(user, callback) {

	// Saves the user via Ajax.
	$.ajax({
		type: "POST",
		url: "save-user",
		data: {
			user: user
		},

		complete: function(result) {
			callback(jQuery.parseJSON(result.responseText));
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
			comment_id: id
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
			content: content
		},

		success: function(result) {
			callback(result.responseText);
		}

	});
}

/* Creates the user box */
function createUserBox(user) {
	var object = '<div class="box">';
	object = object.concat('<div class="alert" id="view-user-alert"> </div>');
	object = object.concat('<form method="post" action="save-user" class="form-horizontal"><h3>'+user.username+'</h3><a href="#" class="btn btn-admin btn-primary">Return</a><hr />');
	object = object.concat('<div class="control-group"><label class="control-label">Username</label><div class="controls"><input type="text" name="username" value="'+user.username+'" /></div></div>');
	object = object.concat('<div class="control-group"><label class="control-label">Email</label><div class="controls"><input type="text" name="email" value="'+user.email+'" /></div></div>');
	object = object.concat('<div class="control-group"><label class="control-label">Posts</label><div class="controls"><input type="text" readonly="readonly" value="'+user.posts+'" /></div></div>');
	object = object.concat('<div class="control-group"><label class="control-label">Rank</label><div class="controls"><input type="text" name="rank" value="'+user.rank+'" /></div></div>');
	object = object.concat('<div class="control-group"><label class="control-label">Used IPs</label><div class="controls"><input type="text" readonly="readonly" value="'+user.ips+'" /></div></div>');
	object = object.concat('<input type="submit" class="btn btn-admin btn-success" />');
	object = object.concat('</form>');
	//object = object.concat('<img src="'+user.avatar+'" alt="'+user.username+'" />');
	object = object.concat('</div>');

	return object;
}

/* Hides the current page */
function hidePage() {
	var current = $(".content");

	current.hide();
	current.removeClass('content');
}

/* Shows a specified page. */
function showPage(id) {
	var page = $(id);
	var contents = page.contents();

	hidePage();

	page.addClass('content');
	page.show();
}

/* Minimizes the current page */
function minimizePage() {
	$(".content").animate({
		opacity: 0.1
	}, 500, function() {
		//hidePage();
	});
}

// ON PAGE EVENTS
function searchUsers(event) {
	var input = $("#search-user input[name=username]").val().toLowerCase();

	// Iterate over users
	$("#table-users a").children('li').each(function() {
		var username = $(this).attr('id').toLowerCase();

		if(username.indexOf(input) == -1) {
			$(this).hide();
		} else {
			$(this).show();
		}
	});
}

function selectComment(event) {
	event.preventDefault();

	var btn = $(this);

	var id;
	
	if(btn.attr('href').indexOf('ok') == 1) {
		id = btn.attr('href').substring(4, 14);

		// Lets OK the comment with Ajax.
		updateComment(id, 'yes');

	} else if (btn.attr('href').indexOf('remove') == 1) {
		id = btn.attr('href').substring(8, 18);

		// Lets kill the comment with Ajax.
		updateComment(id, 'delete');

	}

}

function returnToUserList(event) {
	event.preventDefault();

	$("#user-main").show();
	$("#user-main").animate({
		opacity: 1
	}, 500, function() {
		$("#user-profile").hide();
	});

}

$(document).ready(function() {

	// Dashboard listener.
	$(".sidebar > li > a").click(function(event) {
		event.preventDefault();

		var page = $(this).attr('href');
		showPage(page);

		$(".sidebar > li > a").removeClass("active");
		$(this).addClass("active");
	});

	// Post edit listener.
	$(".edit-btn").click(function(event) {
		event.preventDefault();

		var href = $(this).attr('href');
		var id = href.substring(6, 16);
		var post = getPost(id, function(response) {

			// This is called after Ajax, which is passed $response.
			$(".container-fluid").addClass("body-dark");

			$("#edit-post").removeClass("hide");

			// Load the content.
			$("#edit-post-form #edit-post-content").val(response.post.content);
			$("#edit-post-form h2").html(response.post.title);

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
	$(".vote-btn")
		.bind('click', function(event) {
			selectComment(event);
		});

	$("#search-user input[name=username]")
		.bind('mouseout keyup', function(event) {
			searchUsers(event);
		})
		.bind('focus', function(event) {
			searchUsers(event);
		})
		.bind('blur', function(event) {
			searchUsers(event);
		});

	$("#table-users a").click(function(event) {
		event.preventDefault();

		var username = $(this).children('li').attr('id');
		var user = getUser(username, function(response) {

			// Called after Ajax is performed.
			$("#user-profile").empty().append(createUserBox(response.user)).show();
			
			$("#user-main").animate({
				opacity: 0.1
			}, 500, function() {
				$("#user-main").hide();
			});

			$("#user-profile a")
				.bind('click', function(event) {
					returnToUserList(event);
				});

			$("#user-profile form")
				.bind('submit', function(event) {
					event.preventDefault();

					var user = {
						username: $("#user-profile form input[name=username]").val(),
						email: $("#user-profile form input[name=email]").val(),
						rank: $("#user-profile form input[name=rank]").val()
					};

					saveUser(JSON.stringify(user), function(response) {
						$("#user-profile #view-user-alert").html(response.message);
					});
				});
		});

	});

});
