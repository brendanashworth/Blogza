<?php

$view = new View(BLOG_TEMPLATE);

$view->setTitle("Register");

$posts = Database::getPosts();

$vars = array(
	"1" => $posts[1],
	"2" => $posts[2],
	"3" => $posts[3],
	"errorexists" => ($error != null),
	);

if($error != null) {
	$vars['error'] = $error;
}

$view->setVariable($vars);

$pages = array(
	"header.tpl",
	"navigation.tpl",
	"sidebar.tpl",
	"register.tpl",
	"footer.tpl",
	);

foreach($pages as $page) {
	$view->loadPage($page);
}