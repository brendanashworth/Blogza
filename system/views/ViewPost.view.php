<?php

$view = new View(BLOG_TEMPLATE);

$view->setTitle($post->title);

$vars = array(
	"post" => $post,
	"posts" => $posts,
	);

$view->setVariable($vars);

$pages = array(
	"header.tpl",
	"navigation.tpl",
	"sidebar.tpl",
	"viewpost.tpl",
	"footer.tpl",
	);

foreach($pages as $page) {
	$view->loadPage($page);
}