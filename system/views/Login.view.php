<?php

$view = new View(BLOG_TEMPLATE);

$view->setTitle("Login");

$posts = Database::getPosts();

$vars = array(
	"1" => $posts[1],
	"2" => $posts[2],
	"3" => $posts[3],
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