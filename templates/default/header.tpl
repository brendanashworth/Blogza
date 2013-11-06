<html>

<head>
	<title>{$blog.name}</title>

	<link rel="stylesheet" href="{$blog.url}/templates/{$template.name}/css/bootstrap.min.css">
	<link rel="stylesheet" href="{$blog.url}/templates/{$template.name}/css/blog.css">
	<meta name="description" content="{$blog.description}" />
	<meta name="author" content="boboman13" />

	<style>
	body {
		margin-top: 40px;
	}
	</style>

	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="{$blog.url}/templates/{$template.name}/js/bootstrap.min.js"></script>

</head>

<body>
	<div class="container">
		<div class="navbar">
			<div class="navbar-inner">
				<a class="brand" href="{$blog.url}/">{$blog.name}</a>
				<ul class="nav">
					<li><a href="{$blog.url}/">Blog</a></li>
				</ul>

				<!-- Floated right section of the nav bar -->
				<ul class="nav pull-right">
					<li class="dropdown">
						<a data-toggle="dropdown" href="#">
							Account
							<b class="caret"></b>
						</a>

						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<li><a href="{$blog.url}/register/">Register</a></li>
							<li><a href="{$blog.url}/login/">Login</a></li>
						</ul>
					</li>
				</ul>

			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">