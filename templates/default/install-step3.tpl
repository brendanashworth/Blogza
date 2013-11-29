				<div class="span8">
					<h1>Step 3</h1>
					<h4>Admin User Creation</h4>
				</div>
				<div class="span4">
					<p style="text-align: right;">
						<img src="http://www.blogza.tk/templates/default/img/blogza-logo.png" />
					</p>
				</div>

				<div class="span12">
					<hr />

					{if $vars.error != false}
					<div class="alert alert-error">
						{$vars.error}
					</div>
					{/if}

					<form method="post">
						<input type="hidden" name="init" value="true" />
						<input type="text" name="username" placeholder="Admin Username" />
						<input type="password" name="password" placeholder="Password" />
						<input type="password" name="passwordrep" placeholder="Repeat Password" />
						<input type="text" name="email" placeholder="Admin Email" />

						<input type="submit" class="btn btn-success btn-large" />
					</form>

				</div>
			</div>
		</div>
	</body>

</html>