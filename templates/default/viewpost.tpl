			<div class="span9">
				<div class="post">
					<h1>{$vars.post->title} <small>By <a href="{$blog.url}{$vars.post->author->getLink()}">{$vars.post->author->getUsername()}</a>, {$vars.post->date}</small></h1>
					<hr />

					<p>{$vars.post->content}</p>
				</div>
			</div>