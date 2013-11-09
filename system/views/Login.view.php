<?php

$view = new View(BLOG_TEMPLATE);

$vars = array(
	"error" => $error,
	);

$view->setVariable($vars);

$pages = array(
	"header.tpl",
	"navigation.tpl",
	"sidebar.tpl",
	"login.tpl",
	"footer.tpl",
	);

foreach($pages as $page) {
	$view->loadPage($page);
}