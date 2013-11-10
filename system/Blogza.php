<?php

/**
* Blogza, the open source, simple to use blogging software.
*
* @author	boboman13 <me@boboman13.net>
* @link 	http://blogza.net
* @version	0.6
**/
class Blogza {

	protected $settings;

	protected $modelmanager;
	protected $errorhandler;
	protected $databasemanager;

	/**
	* Creates the Blogza instance. This class is the controller for the entire blog.
	*
	* @access 	public
	* @return 	Blogza
	**/
	public function __construct() {
		session_start();

		require BLOGZA_DIR . "/system/settings.php";
		require BLOGZA_DIR . "/system/views/View.php";

		require BLOGZA_DIR . "/system/models/ModelManager.class.php";
		require BLOGZA_DIR . "/system/models/Util.php";
		require BLOGZA_DIR . "/system/models/Auth.php";

		require BLOGZA_DIR . "/system/packages/Database.class.php";

		require BLOGZA_DIR . "/system/controllers/ErrorHandler.php";
	}

	/**
	* Starts the Blogza web-interface.
	*
	* @access 	public
	* @return 	void
	**/
	public function start() {
		// Settings
		$this->settings = new Settings();

		// ErrorHandler
		$this->errorhandler = new ErrorHandler();

		// ModelManager
		$this->modelmanager = new ModelManager();
		$this->modelmanager->prepare();
		$this->modelmanager->go();
	}

}