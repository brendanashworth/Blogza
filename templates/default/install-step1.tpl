				<div class="span8">
					<h1>Step 1</h1>
					<h4>Config & MySQL Database Setup</h4>
				</div>
				<div class="span4">
					<p style="text-align: right;">
						<img src="http://www.blogza.tk/templates/default/img/blogza-logo.png" />
					</p>
				</div>

				<div class="span12">
					<hr />

					<form method="post" class="form-horizontal">
						{* Blog Name *}
						<div class="control-group">
							<label class="control-label" for="blogname">Blog Name</label>
							<div class="controls">
								<input name="blogname" type="text" id="blogname" placeholder="My Blog"> </input>
							</div>
						</div>

						{* Blog Description *}
						<div class="control-group">
							<label class="control-label" for="blogdesc">Blog Description</label>
							<div class="controls">
								<input name="blogdesc" type="text" id="blogdesc" placeholder="This is a blog powered by the Blogza blog framework."> </input>
							</div>
						</div>

						{* Blog URL *}
						<div class="control-group">
							<label class="control-label" for="blogurl">Blog URL</label>
							<div class="controls">
								<input name="blogurl" type="text" id="blogurl" placeholder="http://myblog.com/blog"> </input>
							</div>
						</div>

						<br />

						{* Database Host *}
						<div class="control-group">
							<label class="control-label" for="host">Database Host</label>
							<div class="controls">
								<input name="host" type="text" id="host" placeholder="127.0.0.1"> </input>
							</div>
						</div>

						{* Database User *}
						<div class="control-group">
							<label class="control-label" for="user">Database User</label>
							<div class="controls">
								<input name="user" type="text" id="user" placeholder="root"> </input>
							</div>
						</div>

						{* Database Password *}
						<div class="control-group">
							<label class="control-label" for="password">Database Password</label>
							<div class="controls">
								<input name="password" type="text" id="password" placeholder="db_password"> </input>
							</div>
						</div>

						{* Database Name *}
						<div class="control-group">
							<label class="control-label" for="dbname">Database Name</label>
							<div class="controls">
								<input name="dbname" type="text" id="dbname" placeholder="blogza_db"> </input>
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
								<input type="submit" id="submit" class="btn btn-success btn-large"> </input>
							</div>
						</div>

					</form>

				</div>
			</div>
		</div>
	</body>

</html>