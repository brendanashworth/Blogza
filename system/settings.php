<?php

/**
* The settings file for the Blogza application.
*
* You can fill these settings out according to the wiki:
* @link 	https://github.com/boboman13/Blogza/wiki/Setting-up-the-configuration-file	
* @author 	boboman13
**/
class Settings {

	/**
	* Defines all the settings for Blogza.
	*
	* @access 	public
	* @return 	Settings
	**/
	public function __construct() {
		define("BLOG_NAME", "My Blog");
		define("BLOG_DESC", "This is a blog powered by the Blogza blog framework.");

		define("BLOG_TEMPLATE", "default");
		define("BLOG_URL", "http://myblog.com");

		define("MYSQL_HOST", "localhost");
		define("MYSQL_USER", "dbuser");
		define("MYSQL_PASSWORD", "dbpassword");
		define("MYSQL_DATABASE", "blogza_database");
	}

}