<?php

$view = new View(BLOG_TEMPLATE);

$view->setTitle($user->getUsername());

$vars = array(
	"user" => $user,
	);

$view->setVariable($vars);

$pages = array(
	"header.tpl",
	"navigation.tpl",
	"viewmember.tpl",
	"footer.tpl",
	);

foreach($pages as $page) {
	$view->loadPage($page);
}