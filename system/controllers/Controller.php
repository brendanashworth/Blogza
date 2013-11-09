<?php

/**
* The abstract Controller class, which all Controllers must extend.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
abstract class Controller {

	/**
	* Creates the Model.
	*
	* This function creates the model. This means that if the model needs setup, database queries, etc, it all needs to happen here.
	*
	* @access 	public
	* @return 	Model
	**/
	abstract public function __construct();

}