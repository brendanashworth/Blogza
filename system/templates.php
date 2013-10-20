<?php

class TemplateManager {

	public $name;

	public $page;

	/**
	* Creates the TemplateManager instance.
	*
	* @param template The name of the template file to use.
	*
	**/
	public function __construct($template) {
		$this->name = $template;

		$this->loadTemplate();
	}

	/**
	* Loads the template from the files.
	*
	* @access private
	**/
	private function loadTemplate() {
		// First the header
		$this->page = file_get_contents(__DIR__.'/../templates/'.$this->name.'/header.html');

		// Then the sidebar

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