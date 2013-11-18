			<div class="span12">
				<h1>Members</h1>

				{foreach $vars.users as $user}
				<div class="member">
					<div class="img">
						<img src="https://minotar.net/helm/boboman13/64.png" />
					</div>
					<h3>{$user->getUsername()}</h3>
				</div>
				{/foreach}
				
			</div>