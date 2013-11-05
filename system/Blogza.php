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
	* Creates the Blogza instance. This class is the controller for the entire blog.
	*
	* @access 	public
	* @return 	Blogza
	**/
	public function __construct() {
		require __DIR__ . "/settings.php";

		require __DIR__ . "/models/ModelManager.class.php";
		require __DIR__ . "/models/Util.class.php";

		require __DIR__ . "/packages/Database.class.php";

		require __DIR__ . "/controllers/ErrorHandler.php";
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

		// ModelManager
		$this->modelmanager = new ModelManager();
		$this->modelmanager->prepare();
		$this->modelmanager->go();
	}


}