<?php

$view = new View(BLOG_TEMPLATE);

$vars = array(
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