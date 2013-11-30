<?php

$view = new View(BLOG_TEMPLATE);

$vars = array(
	"posts" => $posts,
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