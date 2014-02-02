<?php
	/**
	* All the settings for the blog.
	**/
	class Settings {
		public function __construct() {
		// All the settings for the blog. 
		define('BLOG_NAME', 'Blogza');
		define('BLOG_DESC', 'Edit your settings.php file to add a description!');
		define('BLOG_URL', 'http://example.com'); // such as http://example.com - no trailing slash.

		define('MYSQL_HOST', 'localhost');
		define('MYSQL_USER', 'blogza');
		define('MYSQL_PASSWORD', 'password');
		define('MYSQL_DATABASE', 'blogza');

		define('BLOG_TEMPLATE', 'default');
		define('BLOG_TIMEZONE', 'America/New_York');

		// Don't touch the following.
		date_default_timezone_set(BLOG_TIMEZONE);
		define("BLOG_NICE_URLS", !empty($_SERVER['BLOGZA_HTACCESS']) );
	}
}