<?php

$view = new View(BLOG_TEMPLATE);

$vars = array(
	"step" => $step,
	);

$pages = array(
	"install-header.tpl",
	"install-step2.tpl",
	);

$view->setVariable($vars);

foreach($pages as $page) {
	$view->loadPage($page);
}