<?php

$view = new View(BLOG_TEMPLATE);

$vars = array(
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