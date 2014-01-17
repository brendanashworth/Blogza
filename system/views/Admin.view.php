<?php

$view = new View(BLOG_TEMPLATE);

$vars = array(
	"time" => date("g:i A", time()),
	"users" => $users,
	"posts" => $posts,
	"comments" => $comments,
	"comments_amount" => $commentsAmount,
	"admin" => $admin,
	);

$view->setVariable($vars);

$pages = array(
	"adminpanel.tpl",
	);

foreach($pages as $page) {
	$view->loadPage($page);
}