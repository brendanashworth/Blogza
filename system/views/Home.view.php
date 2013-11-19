<?php

$view = new View(BLOG_TEMPLATE);

$vars = array(
	"posts" => $posts,

	"1" => $posts[2],
	"2" => $posts[1],
	"3" => $posts[0],
	);

$pages = array(
	"header.tpl",
	"navigation.tpl",
	"sidebar.tpl",
	"homebody.tpl",
	"footer.tpl",
	);

$view->setVariable($vars);

foreach($pages as $page) {
	$view->loadPage($page);
}