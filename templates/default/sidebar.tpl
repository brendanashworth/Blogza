			<div class="span3">

				<div class="block sidebar-block">
					<center>
						<h5>Latest Posts</h5>
					</center>

					<ul class="nav nav-pills nav-stacked">
					{foreach $vars.posts as $post name=temp}

					{* Limits sidebar to 3 posts. *}
					{if $smarty.foreach.temp.index == 3}
						{break}
					{/if}

					<li><a href="{$blog.url}{$post->link}">{$post->title}</a></li>

					{/foreach}
					</ul>

				</div>

				<div class="block sidebar-block">
					<center>
						<h5>Blog Statistics</h5>
					</center>

					<dl>
						<dt>Online Users</dt>
						<dd>10</dd>
					</dl>
					<dl>
						<dt>Posts</dt>
						<dd>3</dd>
					</dl>
					<dl>
						<dt>Comments</dt>
						<dd>4</dd>
					</dl>

				</div>

			</div>