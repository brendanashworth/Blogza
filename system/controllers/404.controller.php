<?php

class NotFound extends Controller {

	public function __construct() {
		
	}

	public function start() {
		$view = BLOGZA_DIR . "/system/views/404.view.php";


		require $view;
	}

	public function getRoute() {
		return "404";
	}

}