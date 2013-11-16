<?php

$view = new View(BLOG_TEMPLATE);

$view->setTitle("Members");

$vars = array(
	"users" => $users,

	);

$view->setVariable($vars);

$pages = array(
	"header.tpl",
	"navigation.tpl",
	"members.tpl",
	"footer.tpl",
	);

foreach($pages as $page) {
	$view->loadPage($page);
}