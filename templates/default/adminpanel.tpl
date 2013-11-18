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

				</div>
				<div class="span4 block">

				</div>
			</div>
			<div class="row-fluid">
				<div class="span4 block">
					<form method="post" action="{$blog.url}/admin/create-post" class="form-fill" id="create-post">
						<h3>create a post <img class="loader" src="{$blog.folder}/templates/{$template.name}/img/ajax-loader.gif" width="16px" height="16px" /></h3>

						<input type="hidden" name="form" value="create-post"> </input>
						<input type="text" name="title" placeholder="Post title..."> </input>
						<textarea name="content" placeholder="Post content..." rows="5"> </textarea>

						<input type="submit" value="Create Post" class="btn btn-info btn-block"> </input>
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
								<td>{$post->author}</td>
								<td>{$post->title}</td>
							</tr>
							{/foreach}
						</tbody>
					</table>

				</div>
				<div class="span4 block">
					<h3>new comments</h3>

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

		<script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js"> </script>
		<script src="{$blog.folder}/templates/{$template.name}/js/admin.js"> </script>

	</body>

</html>