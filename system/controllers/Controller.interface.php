<?php

/**
* The Controller interface, which all Controllers must implement.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
interface Controller {

	/**
	* Creates the Model.
	*
	* This function creates the model. This means that if the model needs setup, database queries, etc, it all needs to happen here.
	*
	* @access 	public
	* @return 	Model
	**/
	public function __construct();

	/**
	* Gets the route/s for this model.
	*
	* The Model can either return an array of routes (strings) or one route (string).
	*
	* @access 	public
	* @return 	array|string
	**/
	public function getRoute();

}