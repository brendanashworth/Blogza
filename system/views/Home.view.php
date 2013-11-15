<?php

$view = new View(BLOG_TEMPLATE);

$vars = array(
	"1" => $posts[1],
	"2" => $posts[2],
	"3" => $posts[3],
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