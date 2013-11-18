	{if $user.rank == 'Admin'}
	<div class="admin-box">
		<a href="{$blog.url}/admin/">Admin Panel</a>
	</div>
	<style>
		body { margin-top: 60px !important; }
	</style>
	{/if}

	<div class="blogza-header">
		<div class="container">
			<a href="{$blog.url}">
				<h1>{$blog.name}</h1>
			</a>
		</div>

		<div class="navbar">
			<div class="navbar-inner blogza-navbar">
				<div class="container container-regular">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>

					<ul class="nav nav-collapse collapse">
						<li><a href="{$blog.url}/">Home</a></li>
						<li><a href="{$blog.url}/members/">Members</a></li>
					</ul>

					<!-- Floated right section of the nav bar -->
					<ul class="nav pull-right">
						<li class="dropdown">
							{if $user.user == false}
							{* If the user isn't logged in. *}
							<a data-toggle="dropdown" href="#">
								Account
								<b class="caret"></b>
							</a>

							<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
								<li><a href="{$blog.url}/register/">Register</a></li>
								<li><a href="{$blog.url}/login/">Login</a></li>
							</ul>
							{else}
							{* If the user is logged in. *}
							<a data-toggle="dropdown" href="#">
								{$user.user}
								<b class="caret"></b>
							</a>

							<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
								<li><a href="{$blog.url}/logout/">Logout</a></li>
							</ul>
							{/if}
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="container main-content">
		<div class="row">