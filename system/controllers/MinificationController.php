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
	* Set the expires header.
	*
	* @access 	private
	* @param 	int 	$time 	The amount of seconds the object should be locally cached for. This defaults to 7200, or 2 hours.
	* @return 	void
	**/
	private function setExpires($time = 7200) {
		header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + $time));
	}

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
			$this->setExpires(3600);

			$contents = file_get_contents($route . $filename);
			$minify = new Minify();

			$file = $minify->minifyCSS($contents);

			ob_start("ob_gzhandler");
			echo $file;
			ob_end_flush();
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
			$this->setExpires(3600);

			$contents = file_get_contents($route . $filename);
			$minify = new Minify();

			$file = $minify->minifyJS($contents);

			ob_start("ob_gzhandler");
			echo $file;
			ob_end_flush();
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
			$this->setExpires();

			$contents = file_get_contents($route . $filename);

			ob_start("ob_gzhandler");
			echo $contents;
			ob_end_flush();
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
			$this->setExpires();

			$contents = file_get_contents($route . $filename);

			ob_start("ob_gzhandler");
			echo $contents;
			ob_end_flush();
		} else {
			header("HTTP/1.0 404 Not Found");
			echo "404";
		}
	}

}