<?php

$view = new View(BLOG_TEMPLATE);

$view->setTitle("Register");

$vars = array(
	"posts" => $posts,
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