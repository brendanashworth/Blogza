		<div class="span9">
			{foreach $vars.posts as $post name=temp}

			{* Limits the front page posts to 5. *}
			{if $smarty.foreach.temp.index == 5}
				{break}
			{/if}
			<div class="post">
				<h2><a href="{$blog.url}{$post->link}">{$post->title}</a> <small>By <a href="{$blog.url}{$post->author->getLink()}">{$post->author->getUsername()}</a>, on {$post->date}</small></h2>
				<hr />

				<p>{$post->content}</p>
				<br />
			</div>

			{/foreach}
		</div>