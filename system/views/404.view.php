<?php

$view = new View(BLOG_TEMPLATE);

$view->setTitle("Page Not Found");

$pages = array(
	"header.tpl",
	"navigation.tpl",
	"404.tpl",
	"footer.tpl",
	);

foreach($pages as $page) {
	$view->loadPage($page);
}