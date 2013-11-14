<?php

/**
* The abstract Controller class, which all Controllers must extend.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
abstract class Controller {

	protected $matched;

	public function __construct($matched) {
		$this->matched = $matched;
	}

}