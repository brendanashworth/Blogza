<html>

	<head>
		<title>{$blog.name} :: Admin Panel</title>

		<link rel="stylesheet" href="{$blog.url}/templates/{$template.name}/css/bootstrap.min.css">
		<link rel="stylesheet" href="{$blog.url}/templates/{$template.name}/css/blog.css">
		<link rel="stylesheet" href="{$blog.url}/templates/{$template.name}/css/admin.css">
		<meta name="description" content="{$blog.description}" />
		<meta name="author" content="boboman13" />

		<style>
		body {
			padding-top: 40px;
			background-image: url({$blog.url}/templates/{$template.name}/img/tweed.png);
		}
		</style>

	</head>

	<body class="admin">
		<div class="container">
			<div class="row">
				<div class="span4 block">
					<h3>{$vars.time}</h3>
				</div>
				<div class="span4 block">

				</div>
				<div class="span4 block">

				</div>
			</div>
			<div class="row">
				<div class="span4 block">
					<h3>create a post</h3>

					<form method="post" action="{$blog.url}/admin/create-post" class="form-fill">
						<input type="hidden" name="form" value="create-post"> </input>
						<input type="text" name="title" placeholder="Post title..."> </input>
						<textarea name="content" placeholder="Post content..." rows="5"> </textarea>

						<input type="submit" value="Create Post" class="btn btn-info btn-block"> </input>
					</form>
				</div>
				<div class="span4 block">
					<h3>posts w/o approval</h3>

				</div>
				<div class="span4 block">

				</div>
			</div>
			<div class="row">
				<div class="span4 block">
					<h3>manage users</h3>

				</div>
				<div class="span4 block">

				</div>
				<div class="span4 block">

				</div>
			</div>
		</div>

	</body>

</html>