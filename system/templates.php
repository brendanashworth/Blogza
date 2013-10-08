<?php

class TemplateManager {

	public $name;

	function __construct($template = "default") {
		$this->name = $template;

		loadTemplate();
	}

	function loadTemplate() {
		// First the header
		include __DIR__.'/../templates/'.$this->name.'/header.html';

		// Then the sidebar

		// Then the body

		// Lastly, the footer
	}
	
}