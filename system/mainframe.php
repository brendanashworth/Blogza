<?php

/* Welcome to Blogza! Blogza is an open source blogging software, designed to
 *  1) Allow customization down to the hard HTML
 *  2) Keep blogging simple and easy
 *  3) Keep setup fast and simple
 *
 * We hope you enjoy the software! - boboman13
 */

class Blogza {

	/**
	* The name of the software.
	* @access public
	**/
	public static $name = "Blogza";

	/**
	* The DatabaseManager, used for referencing data from the database storage.
	* @access private
	**/
	private $databasemanager;

	/**
	* The TemplateManager, used to create and manage templates.
	* @access private
	**/
	private $templatemanager;

	/**
	* Starts Blogza.
	* @access public
	**/
	public function start() {
		session_start();

		// Load the database and start load
		require 'dbloader.php';

		$this->databasemanager = new DatabaseManager();

		// Load all the .php structure files
		require 'routes.php';
		require 'templates.php';
		require 'settings.php';
		//require 'caches.php';

		// Start templates
		$this->templatemanager = new TemplateManager($this, "default");
	}

	/**
	* Gets the DatabaseManager instance.
	* @access public
	**/
	public function getDatabaseManager() {
		return $this->databasemanager;
	}


}