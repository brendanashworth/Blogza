<?php

/* Welcome to Blogza! Blogza is an open source blogging software, designed to
 *  1) Allow customization down to the hard HTML
 *  2) Keep blogging simple and easy
 *  3) Keep setup fast and simple
 *
 * We hope you enjoy the software! - boboman13
 */

class Blogza {

	public static $name = "Blogza";

	private $databasemanager;
	private $templatemanager;
	private $routes;

	/**
	* Starts Blogza.
	* @access	public
	**/
	public function start() {
		session_start();
		ini_set('error_reporting', E_ALL);

		/* Load all the .php files that are critical to the existance of the software:
		* - DatabaseManager, loads and manages the database for us
		* - Router, creates, manages, and handles all URL routes used
		* - TemplateManager, manages and loads all the necessary template files and processes them
		* - settings.php, very generic configuration file, but necessary for all
		*/

		require 'settings.php';

		require 'dbloader.php';
		$this->databasemanager = new DatabaseManager();

		require 'router.php';
		$router = new Router();

		require 'routes.php';
		$this->routes = new Routes(); // This holds all the pages!

		require 'templates.php';
		$this->templatemanager = new TemplateManager($this, "default");

		$router->get('/home', $this->templatemanager->displayPage());

		$router->go();
	}

	/**
	* Gets the DatabaseManager instance.
	* @access	public
	**/
	public function getDatabaseManager() {
		return $this->databasemanager;
	}

	/**
	* Gets the Routes instance.
	* @access	public
	* @return	Routes
	**/
	public function getRoutes() {
		return $this->routes;
	}

}