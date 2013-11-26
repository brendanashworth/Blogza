			<div class="span12">
				<h1>Members</h1>

				<ol>
					{foreach $vars.users as $user}
					<li class="member">
						<a class="avatar" href="{$blog.url}/members/{$user->getUsername()}.{$user->getID()}/">
							<img width="64px" height="64px" src="{$user->getAvatar()}" />
						</a>

						<a href="{$blog.url}/members/{$user->getUsername()}.{$user->getID()}/">
							<span class="label label-info rank">{$user->getRank()}</span> <h3 class="name">{$user->getUsername()}</h3>
						</a>
						<h2 class="info"><small>Posts: <strong>{$user->getPosts()}</strong> </small></h2>
					</li>
					{/foreach}
				</ol>
				
			</div>