<?php

class TemplateManager {

	public $page;

	/**
	* Creates the TemplateManager instance.
	*
	* @param template The name of the template file to use.
	*
	**/
	public function __construct($template = "default") {

		$this->loadTemplate($template);
	}

	/**
	* Loads the template from the files.
	*
	* @access private
	**/
	private function loadTemplate($template) {
		$location = __DIR__.'/../templates/'.$template.'/';

		// First the header
		$this->page = $this->page . file_get_contents($location.'header.html');

		// Then the sidebar
		$this->page = $this->page . file_get_contents($location.'sidebar.html');

		// Then the body

		// Lastly, the footer

		$this->processPage();
	}

	/**
	* Processes the page. This includes changing all variables to their specified values.
	*
	* @access private
	**/
	private function processPage() {
		$this->page = str_replace("{blog-name}", BLOG_NAME, $this->page);

		$this->displayPage();
	}

	/**
	* Displays the page.
	*
	* @access private
	**/
	private function displayPage() {
		echo $this->page;
	}
	
}