<?php

$view = new View(BLOG_TEMPLATE);

$posts = Database::getPosts();

$vars = array(
	"1" => array(
		"title" => $posts[1]["title"],
		"link" => $posts[1]["link"],
		"author" => $posts[1]["author"],
		"content" => $posts[1]["content"],
		"date" => $posts[1]["date"],
		),
	"2" => array(
		"title" => $posts[2]["title"],
		"link" => $posts[2]["link"],
		"author" => $posts[2]["author"],
		"content" => $posts[2]["content"],
		"date" => $posts[2]["date"],
		),
	"3" => array(
		"title" => $posts[3]["title"],
		"link" => $posts[3]["link"],
		"author" => $posts[3]["author"],
		"content" => $posts[3]["content"],
		"date" => $posts[3]["date"],
		),
	);

$pages = array(
	"header.tpl",
	"navigation.tpl",
	"sidebar.tpl",
	"homebody.tpl",
	"footer.tpl",
	);

$view->setVariable($vars);

foreach($pages as $page) {
	$view->loadPage($page);
}