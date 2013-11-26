			<div class="span9">
				<h1>Comments <small>on {$vars.post->title}</small></h1>

				{if $vars.comments == null}
				<p><strong>No comments have been left yet. </strong></p>

				{if $user.user != null}
				<p><strong><a href="#post-comment">Be the first one.</a></strong></p>
				{/if}

				{else}

				{foreach $vars.comments as $comment}
				<div class="comment">
					<a href="{$blog.url}{$comment->author->getLink()}">
						<p class="author">{$comment->author->getUsername()}</p>
					</a>

					<p class="comment-content">{$comment->content}</p>

				</div>
				{/foreach}

				{/if}

				{if $user.user != null}
				<form method="post" id="post-comment">
					<h3>Post a Comment</h3>
					<textarea form="post-comment" name="content" rows="6" cols="500">This post is so...</textarea>
					<br />

					<input type="submit" class="btn btn-primary"> </input>
				</form>
				{/if}
			</div>