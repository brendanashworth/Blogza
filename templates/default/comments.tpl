			<div class="span9">
				<h1>Comments <small>on {$vars.post->title}</small></h1>

				{if $vars.comments == null}
				<p><strong>No comments have been left yet. </strong></p>

				{if $user.user != null}
				<p><strong><a href="#post-comment">Be the first one.</a></strong></p>
				{/if}

				<hr />
				{else}

				{foreach $vars.comments as $comment}
				<div class="comment">
					<a href="{$blog.url}{$comment->author->getLink()}">
						<img src="{$comment->author->getAvatar()}" width="46px" height="46px" class="avatar left"> </img>
						<p class="author">{$comment->author->getUsername()}</p>
					</a>

					<p class="comment-content">{$comment->content}</p>

				</div>
				{/foreach}

				{/if}

				{if $vars.msg != false}
				<br />
				<div class="alert">
					<p>{$vars.msg}</p>
				</div>
				{/if}
				{if $vars.error != false}
				<br />
				<div class="alert alert-error">
					<p>{$vars.error}</p>
				</div>
				{/if}

				{if $user.user != null}
				<form method="post" id="post-comment" class="form-fill">
					<h3>Post a Comment</h3>
					<textarea form="post-comment" name="content" rows="4" cols="500"></textarea>
					<br />

					<input type="hidden" name="csrf_token" value="{$protect.csrf_token}"> </input>

					<input type="submit" class="btn btn-primary"> </input>
				</form>
				{/if}
			</div>