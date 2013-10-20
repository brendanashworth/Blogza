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
	* Starts Blogza.
	* @access public
	**/
	public function start() {
		// Begin session
		session_start();

		// Load the database and start load
		require 'dbloader.php';

		$databasemanager = new DatabaseManager();

		// Load all the .php structure files
		require 'blog.php';
		require 'routes.php';
		require 'templates.php';
		require 'settings.php';
		require 'caches.php';

		// Start templates
		$templatemanager = new TemplateManager("default");
	}




}