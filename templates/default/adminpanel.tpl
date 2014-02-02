<html>

	<head>
		<title>{$blog.name} :: Admin Panel</title>

		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Fenix">

		<link rel="stylesheet" href="{$blog.folder}/asset/css/bootstrap.min.css">
		<link rel="stylesheet" href="{$blog.folder}/asset/css/blog.css">
		<link rel="stylesheet" href="{$blog.folder}/asset/css/admin.css">
		<meta name="description" content="{$blog.description}" />
		<meta name="author" content="boboman13" />
	</head>

	<body class="admin">
		<div class="body-hold">
			<div class="container-fluid content" id="dashboard">
				<div class="row-fluid admin-body">
					<div class="span12 block">
						<h3>{$vars.time}</h3>
						<img src="{$vars.admin->getAvatar()}" width="64px" height="64px" class="avatar right" />
						<p>Hello, {$user.user}.</p>
						<br />
						<a class="btn btn-admin" href="{$blog.url}/"><i class="icon-chevron-left"></i> Return</a>
					</div>
				</div>
				<div class="row-fluid admin-body">
					<div class="span4 block">
						<form method="post" action="{$blog.url}/admin/create-post" class="form-fill" id="create-post">
							<div class="alert msg"> </div>

							<h3>New Post <img class="loader" src="{$blog.folder}/asset/img/ajax-loader.gif" width="16px" height="16px" /></h3>

							<input id="title" type="text" name="title" value="Post title..."> </input>
							<textarea id="content" name="content" rows="5">Post content...</textarea>

							<div class="row-fluid">
								<div class="span3">
									<a href="#" class="btn btn-primary btn-block btn-admin" id="edit-btn"><i class="icon-align-left"></i> Editor</a>
								</div>
								<div class="span9">
									<input type="submit" value="Create Post" class="btn btn-admin btn-success btn-block"> </input>
								</div>
							</div>
						</form>
					</div>
					<div class="span4 block">
						<h3>Posts Status</h3>

						<div class="posts-breakdown">
							<p><strong class="done">6</strong> Finished</p>
							<p><strong class="draft">2</strong> Drafts</p>
							<p><strong class="trash">3</strong> Trashed</p>
						</div>

					</div>

				</div>
				<div class="row-fluid admin-body">
					<div class="span4 block">
						<h3>Edit Posts</h3>

						<table class="table table-bordered table-hold">
							<thead>
								<tr>
									<th>Action</th>
									<th>Author</th>
									<th>Title</th>
								</tr>
							</thead>
							<tbody>
								{foreach $vars.posts as $post name=posts}
								{if $smarty.foreach.posts.index == 5}
									{break}
								{/if}
								<tr>
									<td>
										<a href="#edit.{$post->id}" class="edit-btn btn btn-admin btn-fill btn-success">
											<i class="icon-pencil"> </i>
										</a>
									</td>
									<td>{$post->author->getUsername()}</td>
									<td id="post-{$post->id}">{$post->title}</td>
								</tr>
								{/foreach}
							</tbody>
						</table>

					</div>
				</div>
			</div>

			<div class="container-fluid hide" id="posts">
				<div class="row-fluid">
					<div class="span12 block">
						<h3>Posts</h3>
						
						<table class="table table-bordered table-hold">
							<thead>
								<tr>
									<th>Action</th>
									<th>Post ID</th>
									<th>Author</th>
									<th>Title</th>
									<th>Date</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								{foreach $vars.posts as $post name=posts}
								{if $smarty.foreach.posts.index == 5}
									{break}
								{/if}
								<tr>
									<td>
										<a href="#edit.{$post->id}" class="edit-btn btn btn-admin btn-fill btn-success">
											<i class="icon-pencil"> </i>
										</a>
									</td>
									<td>{$post->id}</td>
									<td>{$post->author->getUsername()}</td>
									<td id="post-{$post->id}">{$post->title}</td>
									<td>{$post->date}</td>
									<td>{$post->status}</td>
								</tr>
								{/foreach}
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="container-fluid hide" id="users">
				<div class="row-fluid">
					<div class="span12 block">
						<div id="user-main">
							<h3>Users</h3>

							<div id="search-user" class="padded-item">
								<input type="text" name="username" placeholder="Username" class="no-margin" autocomplete="off" />
							</div>

							<ol class="table-list" id="table-users">
								{foreach $vars.users as $nerp => $user}
								<a href="#">
									<li id="{$user->getUsername()}">
										<img class="avatar-small" src="{$user->getAvatar(22)}" alt="{$user->getUsername()}" />
										<p>{$user->getUsername()} <small>{$user->getEmail()}</small></p>
									</li>
								</a>
								{/foreach}
							</ol>
						</div>

						<div id="user-profile">



						</div>

					</div>
				</div>
			</div>

			<div class="container-fluid hide" id="comments">
				<div class="row-fluid">
					<div class="span12 block">
						<h3>Comments</h3>

						<table class="table table-bordered table-hold">
							<thead>
								<tr>
									<th>ID</th>
									<th>Author</th>
									<th>Content</th>
									<th>Date</th>
									<th>Vote</th>
								</tr>
							</thead>
							<tbody>
								{foreach $vars.comments as $comment}

								<tr id="comment-{$comment->id}">
									<td>{$comment->id}</td>
									<td>{$comment->author->getUsername()}</td>
									<td>{$comment->content}</td>
									<td>{$comment->date}</td>
									<td>
										<a href="#ok.{$comment->id}" class="vote-btn btn btn-admin btn-large btn-success">
											<i class="icon-ok"> </i>
										</a>
										<a href="#remove.{$comment->id}" class="vote-btn btn btn-admin btn-large btn-danger">
											<i class="icon-remove"> </i>
										</a>
									</td>
								</tr>

								{/foreach}
							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>

		<div class="container-sidebar">
			<ul class="sidebar">
				<li><a class="active" href="#dashboard">Dashboard</a></li>
				<li><a href="#posts">Posts</a></li>
				<li><a href="#users">Users</a></li>
				<li><a href="#comments">Comments <span class="badge badge-inverse">{$vars.comments_amount}</span></a></li>
			</ul>
		</div>

		<div class="modal hide" id="edit-post">
			<form method="post" action="{$blog.url}/admin/update-post" class="form-fill" id="edit-post-form">
				<div class="modal-header">
					<button type="button" class="close">&times;</button>
					<h3>Edit Post <img class="loader" src="{$blog.folder}/asset/img/ajax-loader.gif" width="16px" height="16px" /><h3>
				</div>
				<div class="modal-body">
					<div class="alert msg"> </div>
					<h2 name="title">Title</h2>

					<input type="hidden" value="" name="id" />

					<textarea id="edit-post-content" rows="15"></textarea>

				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-admin btn-success btn-block" value="Update Post"> </input>

				</div>

			</form>
		</div>	

		<div class="modal hide" id="post-editor">

			<form method="post" action="{$blog.url}/admin/create-post" class="form-fill" id="post-editor-form">
				<div class="modal-header">
					<button type="button" class="close">&times;</button>
					<h3>Post Creation <img class="loader" src="{$blog.folder}/asset/img/ajax-loader.gif" width="16px" height="16px" /></h3>

				</div>
				<div class="modal-body form-fill">
					<div class="alert msg"> </div>

					<input type="text" placeholder="Title" name="title"> </input>

					<div class="edit-tools">
						<a href="#"> <i class="icon-bold"> </i> </a>
						<a href="#"> <i class="icon-italic"> </i> </a>
						<a href="#"> <i class="icon-text-height"> </i> </a>

						<div class="separator"> </div>

						<a href="#"> <i class="icon-align-left"> </i> </a>
						<a href="#"> <i class="icon-align-center"> </i> </a>
						<a href="#"> <i class="icon-align-right"> </i> </a>
					</div>
					<textarea name="content" rows="15"></textarea>

				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-admin btn-success btn-block" value="Create Post"> </input>


				</div>
			</form>
		</div>

		<noscript>
			<style> .container-fluid { opacity: 0.2; } body { background: #222 !important; } </style>
			<div class="alert alert-error popup">
				<h3>Error!</h3>

				<p>Your browser is not running Javascript. You must be running Javascript to use the admin panel. <a href="http://enable-javascript.com" target="_blank">Learn how here.</a></p>
			</div>
		</noscript>

		<script src="//code.jquery.com/jquery-1.10.2.min.js"> </script>
		<script src="{$blog.folder}/asset/js/admin.js"> </script>

	</body>

</html>