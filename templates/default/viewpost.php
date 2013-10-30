<?php if (!isset($this->template)) die("You cannot view this page directly!"); ?>

<?php
$posts = $this->blogza->getDatabaseManager()->getPosts();
// Get the post number.
$route = Router::getPath();
$number = substr($route, 6);

$title = $posts[$number]['title'];
$author = $posts[$number]['author'];
$date = $posts[$number]['date'];
$content = $posts[$number]['content'];

?>
			<div class="span9">
				<div class="post">
					<h2><?php echo $title; ?> <small>By <?php echo $author; ?>, <?php echo $date; ?></small></h2>
					<hr />

					<p><?php echo $content; ?></p>
				</div>
			</div>