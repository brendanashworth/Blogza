<html>

	<head>
		<title>{$blog.name} :: Admin Panel</title>

		<link rel="stylesheet" href="{$blog.folder}/templates/{$template.name}/css/bootstrap.min.css">
		<link rel="stylesheet" href="{$blog.folder}/templates/{$template.name}/css/blog.css">
		<link rel="stylesheet" href="{$blog.folder}/templates/{$template.name}/css/admin.css">
		<meta name="description" content="{$blog.description}" />
		<meta name="author" content="boboman13" />

		<style>
		body {
			padding-top: 40px;
			background-image: url({$blog.folder}/templates/{$template.name}/img/tweed.png);
		}
		</style>

	</head>

	<body class="admin">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span4 block">
					<h3>{$vars.time}</h3>
					<p>Hello, {$user.user}.</p>
					<br />
					<a class="btn btn-block" href="{$blog.url}/">Return to Blog</a>
				</div>
				<div class="span4 block">
					<h3>Updates</h3>
					<p>You are running <strong>1.4.2</strong>.</p>
					<p>The latest is <strong>1.4.3</strong>.</p>
				</div>
				<div class="span4 block">

				</div>
			</div>
			<div class="row-fluid">
				<div class="span4 block">
					<form method="post" action="{$blog.url}/admin/create-post" class="form-fill" id="create-post">
						<div class="alert msg"> </div>

						<h3>create a post <img class="loader" src="{$blog.folder}/templates/{$template.name}/img/ajax-loader.gif" width="16px" height="16px" /></h3>

						<input id="title" type="text" name="title" placeholder="Post title..."> </input>
						<textarea id="content" name="content" rows="5">Post content...</textarea>

						<div class="row-fluid">
							<div class="span3">
								<a href="#" data-toggle="modal" data-target="#post-editor-modal" class="btn btn-info btn-block"> <i class="icon-align-left"> </i> Editor</a>
							</div>
							<div class="span9">
								<input type="submit" value="Create Post" class="btn btn-success btn-block"> </input>
							</div>
						</div>
					</form>
				</div>
				<div class="span4 block">
					<h3>new posts</h3>
					<table class="table table-bordered table-hold">
						<thead>
							<tr>
								<th>Author</th>
								<th>Title</th>
							</tr>
						</thead>
						<tbody>
							{foreach $vars.posts as $post}
							<tr>
								<td>{$post->author->getUsername()}</td>
								<td>{$post->title}</td>
							</tr>
							{/foreach}
						</tbody>
					</table>

				</div>
				<div class="span4 block">
					<h3>new comments</h3>

					<table class="table table-bordered table-hold">
						<thead>
							<tr>
								<th>Poster</th>
								<th>Content</th>
								<th>Vote</th>
							</tr>
						</thead>
						<tbody>
							{foreach $vars.comments as $comment}

							<tr id="comment-{$comment->id}">
								<td>{$comment->author->getUsername()}</td>
								<td>{$comment->content}</td>
								<td>
									<a href="#ok.{$comment->id}" class="vote-btn btn btn-fill btn-success">
										<i class="icon-ok"> </i>
									</a>
									<a href="#remove.{$comment->id}" class="vote-btn btn btn-fill btn-danger">
										<i class="icon-remove"> </i>
									</a>
								</td>
							</tr>

							{/foreach}
						</tbody>
					</table>

				</div>
			</div>
			<div class="row-fluid">
				<div class="span4 block">
					<h3>manage users</h3>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Username</th>
								<th>Rank</th>
							</tr>
						</thead>
						<tbody>
							{foreach $vars.users as $nerp => $user}
							<tr>
								<td>{$user->getUsername()}</td>
								<td>{$user->getRank()}</td>
							</tr>
							{/foreach}
						</tbody>
					</table>

				</div>
				<div class="span4 block">

				</div>
				<div class="span4 block">

				</div>
			</div>
		</div>

		<div class="modal hide fade" id="post-editor-modal">
			<div class="modal-header">
				<h3>Post Creation</h3>


			</div>
			<div class="modal-body">


			</div>
			<div class="modal-footer">



			</div>
		</div>

		<noscript>
			<style> .container-fluid { opacity: 0.2; } body { background: #222 !important; } </style>
			<div class="alert alert-error popup">
				<h3>Error!</h3>

				<p>Your browser does not support Javascript. You must be running Javascript to use the admin panel. <a href="http://enable-javascript.com" target="_blank">Learn how here.</a></p>
			</div>
		</noscript>

		<script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js"> </script>
		<script src="{$blog.folder}/templates/{$template.name}/js/bootstrap.min.js"> </script>
		<script src="{$blog.folder}/templates/{$template.name}/js/admin.js"> </script>

	</body>

</html>