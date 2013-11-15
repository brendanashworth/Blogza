	{if $user.rank == 'Admin'}
	<div class="admin-box">
		<a href="{$blog.url}/admin/">Admin Panel</a>
	</div>
	<style>
		body { margin-top: 60px !important; }
	</style>
	{/if}

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

	<div class="container">
		<div class="row">