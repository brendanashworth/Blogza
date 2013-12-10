<?php

$view = new View(BLOG_TEMPLATE);

$view->setTitle($post->title . " | Comments");

$vars = array(
	"posts" => $posts,
	"post" => $post,
	"comments" => $comments,
	"msg" => $msg,
	"error" => $error,
	);

$view->setVariable($vars);

$pages = array(
	"header.tpl",
	"navigation.tpl",
	"sidebar.tpl",
	"comments.tpl",
	"footer.tpl",
	);

foreach($pages as $page) {
	$view->loadPage($page);
}