<?php

/**
* Blogza, the open source, simple to use blogging software.
*
* @author	boboman13 <me@boboman13.net>
* @link 	http://blogza.net
* @version	0.6
**/
class Blogza {

	protected $modelmanager;
	protected $errorhandler;
	protected $databasemanager;

	/**
	* Creates the Blogza instance. This class is the Controller class for the entire blog.
	*
	* @access 	public
	**/
	public function __construct() {
		require __DIR__ . "/../settings.php";

		require __DIR__ . "/ErrorHandler.php";
		require __DIR__ . "/Util.class.php";

		require __DIR__ . "/../models/ModelManager.class.php";
		require __DIR__ . "/../packages/Database.class.php";
	}

	/**
	* Starts the Blogza web-interface.
	*
	* @access 	public
	* @return 	void
	**/
	public function start() {
		// ErrorHandler
		$this->errorhandler = new ErrorHandler();

		// DatabaseManager
		$this->databasemanager = new Database();

		// ModelManager
		$this->modelmanager = new ModelManager();
		$this->modelmanager->prepare();
		$this->modelmanager->go();
	}


}