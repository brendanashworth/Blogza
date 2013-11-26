			<div class="span9">
				<div class="post">
					<h1>{$vars.post->title} <small>By <a href="{$blog.url}{$vars.post->author->getLink()}">{$vars.post->author->getUsername()}</a>, {$vars.post->date}</small></h1>
					<hr />

					<p>{$vars.post->content}</p>

					{if $user.user != null}
					<a class="comment-link" href="{$blog.url}{$vars.post->link}comments/">Create Comment</a>
					{/if}
					<a class="comment-link" href="{$blog.url}{$vars.post->link}comments/">View Comments</a>
				</div>
			</div>