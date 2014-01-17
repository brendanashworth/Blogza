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
						{if $user.rank == 'Admin'}
						<li><a href="{$blog.url}/admin/">Admin Area</a></li>
						{/if}
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
								<!--<li><a href="{$blog.url}/member/{$user.user}/">View Profile</a></li>-->
								<li><a href="{$blog.url}/account/edit/">Edit Account</a></li>
								<li class="divider"></li>
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