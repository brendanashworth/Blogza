<?php

/*namespace Blogza;

use Models\ModelManager;*/

/**
* Blogza, the open source, simple to use blogging software.
*
* @author	boboman13 <me@boboman13.net>
* @link 	http://blogza.net
* @version	0.6
**/
class Blogza {

	protected $modelmanager;

	/**
	* Creates the Blogza instance. This class is the Controller class for the entire blog.
	*
	* @access 	public
	**/
	public function __construct() {
		require __DIR__ . "/../models/ModelManager.class.php";
	}

	/**
	* Starts the Blogza web-interface.
	*
	* @access 	public
	* @return 	void
	**/
	public function start() {
		echo "a";
		$this->modelmanager = new ModelManager(); echo "b";
		// Prepare, then launch the ModelManager.
		$this->modelmanager->prepare(); echo "c";
		$this->modelmanager->go(); echo "d";
	}


}