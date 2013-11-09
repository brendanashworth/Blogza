			<div class="span9">
				<h2>Login</h2>
				<hr />

				{if $vars.error != false}

				<div class="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<h4>Error</h4>
					<p> {$vars.error} </p>
				</div>

				{/if}

				<form method="post">
					<input type="text" name="username" placeholder="Username"> </input>
					<br />
					<input type="password" name="password" placeholder="Password"> </input>
					<span class="help-block">Forgot your password? <a href="{$blog.url}/reset-password/">Reset your password.</a></span>
					<br />

					<input type="submit" name="submit" class="btn btn-success"> </input>
				</form>
			</div>