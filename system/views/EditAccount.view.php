<?php

$view = new View(BLOG_TEMPLATE);

$view->setTitle("Edit Account");

$vars = array(
	"error" => isset($error) ? $error : false,
	"msg" => isset($msg) ? $msg : false,
	"user" => $user,
	);

$view->setVariable($vars);

$pages = array(
	"header.tpl",
	"navigation.tpl",
	"editaccount.tpl",
	"footer.tpl",
	);

foreach($pages as $page) {
	$view->loadPage($page);
}