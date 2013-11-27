			<div class="span9">
				<h1>Edit Account</h1>
				<hr />

				{if $vars.error != false}
				<div class="alert alert-error">
					{$vars.error}
				</div>
				{/if}

				{if $vars.msg != false}
				<div class="alert alert-success">
					{$vars.msg}
				</div>
				{/if}

				<form method="post">
					<input type="text" name="email" placeholder="Email"> </input>
					<span class="help-block">Your email address - make sure to check this regularly.</span>

					<input type="password" name="password" placeholder="Password"> </input> <br />
					<input type="password" name="passwordrep" placeholder="Password Repeat"> </input>
					<span class="help-block">Use a secure password!</span>

					<input type="submit" class="btn btn-success"> </input>
				</form>
			</div>
			<div class="span3">
				<h2>Current Avatar</h2>
				<hr />

				<p class="center">
					<img class="avatar" src="{$vars.user->getAvatar()}" width="128px" height="128px">
				</p>

				<p>We utilize Gravatar for avatars. Please visit <a href="http://en.gravatar.com/support/how-to-sign-up/">their website</a> for how to change your avatar.</p>

			</div>