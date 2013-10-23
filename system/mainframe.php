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
	private $router;
	private $routes;

	/**
	* Starts Blogza.
	* @access	public
	* @return	void
	**/
	public function start() {
		session_start();

		/* Load all the .php files that are critical to the existance of the software:
		* - DatabaseManager, loads and manages the database for us
		* - Router, creates, manages, and handles all URL routes used
		* - Routes, which holds and stores all the pages necessary to build the template files per URL
		* - TemplateManager, manages and loads all the necessary template files and processes them
		* - settings.php, very generic configuration file, but necessary for all
		*/

		require 'settings.php';
		require 'dbloader.php';
		require 'router.php';
		require 'routes.php';
		require 'templates.php';

		$this->databasemanager = new DatabaseManager();

		$this->router = new Router("/home");
		$this->routes = new Routes($this);

		$this->templatemanager = new TemplateManager($this);

		$this->routes->prepareRouter();
		
		/* Display the generated info. */
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
	* Gets the Router instance.
	* @access	public
	**/
	public function getRouter() {
		return $this->router;
	}

	/**
	* Gets the TemplateManager instance.
	* @access	public
	**/
	public function getTemplateManager() {
		return $this->templatemanager;
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