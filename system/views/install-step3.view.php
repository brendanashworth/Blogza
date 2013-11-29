<?php

$view = new View(BLOG_TEMPLATE);

$vars = array(
	"step" => $step,
	"error" => $error,
	);

$pages = array(
	"install-header.tpl",
	"install-step3.tpl",
	);

$view->setVariable($vars);

foreach($pages as $page) {
	$view->loadPage($page);
}