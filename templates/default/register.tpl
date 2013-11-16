<div class="span9">
	<h2>Register</h2>
	<hr />

	{if $vars.errorexists}

	<div class="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Error</h4>
		<p> {$vars.error} </p>
	</div>

	{/if}

	<form method="post">
		<input type="text" name="username" placeholder="Username"> </input>
		<span class="help-block">Must be unique.</span>

		<input type="text" name="email" placeholder="Email"> </input>
		<span class="help-block">Your email address - make sure to check this regularly.</span>

		<input type="password" name="password" placeholder="Password"> </input>
		<br />
		<input type="password" name="passwordrepeat" placeholder="Repeat Password"> </input>
		<span class="help-block">Use a secure password!</span>

		<input type="submit" class="btn btn-success"> </input>
	</form>
</div>