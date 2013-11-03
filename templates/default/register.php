<?php if (!isset($this->template)) die("You cannot view this page directly!"); ?>

<?php
// Set the $_SESSION['isregistering'] value to true.
$_SESSION['isregistering'] = true;

?>

			<div class="span9">
				<h2>Register</h2>
				<hr />

				<?php
				if(isset($_SESSION['error'])) {
					?>

					<div class="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<h4>Error</h4>
						<p> <?php echo $_SESSION['error']; ?> </p>
					</div>

					<?php
				}
				?>

				<form method="post" action="{blog-url}/">
					<input type="text" name="username" placeholder="Username"> </input>
					<span class="help-block">Must be unique.</span>

					<input type="password" name="password" placeholder="Password"> </input>
					<br />
					<input type="password" name="passwordrepeat" placeholder="Repeat Password"> </input>
					<span class="help-block">Use a secure password!</span>

					<input type="submit" class="btn btn-success"> </input>
				</form>
			</div>
