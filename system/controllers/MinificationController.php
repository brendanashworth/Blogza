<?php

/**
* HTTPError class for handling HTTP errors.
**/
class MinificationController extends Controller {

	private $mimetypes = array(
		'css' => 'text/css',
		'js' => 'application/javascript',
		'ttf' => 'application/octet-stream',

		'png' => 'image/png',
		'gif' => 'image/gif',
		'jpg' => 'image/jpeg',
		'jpeg' => 'image/jpeg',

		'*' => 'application/octet-stream',
		);

	/**
	* Gets a css website asset.
	*
	* @access 	public
	* @return 	void
	**/
	public function getCSS() {
		$route = BLOGZA_DIR . "/templates/" . BLOG_TEMPLATE . "/css/";
		$filename = $this->matched[1];

		if(file_exists($route . $filename)) {
			header("Content-type: text/css");

			$contents = file_get_contents($route . $filename);
			$minify = new Minify();

			$file = $minify->minifyCSS($contents);
			echo $file;
		} else {
			header("HTTP/1.0 404 Not Found");
			echo "404";
		}
	}

	/**
	* Gets a javascript website asset.
	*
	* @access 	public
	* @return 	void
	**/
	public function getJS() {
		$route = BLOGZA_DIR . "/templates/" . BLOG_TEMPLATE . "/js/";
		$filename = $this->matched[1];

		if(file_exists($route . $filename)) {
			header("Content-type: application/javascript");

			$contents = file_get_contents($route . $filename);
			$minify = new Minify();

			$file = $minify->minifyJS($contents);
			echo $file;
		} else {
			header("HTTP/1.0 404 Not Found");
			echo "404";
		}
	}

	/**
	* Gets a font website asset.
	*
	* @access 	public
	* @return 	void
	**/
	public function getFont() {
		$route = BLOGZA_DIR . "/templates/" . BLOG_TEMPLATE . "/font/";
		$filename = $this->matched[1];

		if(file_exists($route . $filename)) {
			header("Content-type: application/octet-stream");

			$contents = file_get_contents($route . $filename);

			echo $contents;
		} else {
			header("HTTP/1.0 404 Not Found");
			echo "404";
		}
	}

	/**
	* Gets an image website asset.
	*
	* @access 	public
	* @return 	void
	**/
	public function getImg() {
		$route = BLOGZA_DIR . "/templates/" . BLOG_TEMPLATE . "/img/";
		$filename = $this->matched[1];

		if(file_exists($route . $filename)) {
			// Get the mime type
			$parts = explode('.', $filename);
			$filetype = end($parts);
			$mimetype = '';
			foreach($this->mimetypes as $end => $mime) {
				if($end == $filetype) {
					$mimetype = $mime;
					break;
				}
			}
			if(empty($mimetype)) {
				$mimetype = $this->mimetypes['*'];
			}

			// Deliver it.
			header("Content-type: " . $mimetype);

			$contents = file_get_contents($route . $filename);

			echo $contents;
		} else {
			header("HTTP/1.0 404 Not Found");
			echo "404";
		}
	}

}