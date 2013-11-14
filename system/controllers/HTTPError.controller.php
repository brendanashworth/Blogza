<?php

/**
* HTTPError class for handling HTTP errors.
**/
class HTTPError extends Controller {

	/**
	* Displays the 404 error page and gives the header error.
	*
	* @access 	public
	* @return 	void
	**/
	public function display404() {
		Util::header('HTTP/1.0 404 Not Found');

		$view = BLOGZA_DIR . "/system/views/404.view.php";
		require $view;
	}

}