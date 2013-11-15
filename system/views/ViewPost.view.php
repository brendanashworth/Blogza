<?php

$view = new View(BLOG_TEMPLATE);

$vars = array(
	"1" => $posts[1],
	"2" => $posts[2],
	"3" => $posts[3],
	
	"post" => $post,
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