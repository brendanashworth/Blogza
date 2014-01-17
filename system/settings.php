
<?php
class Settings {
public function __construct() {
// All the settings for the blog. 
define('BLOG_NAME', 'BlogzaDev');
define('BLOG_DESC', 'Development Test Blog * Blogza is an open source blogging framework.');
define('BLOG_URL', 'http://blogza.tk');
define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', 'egKrR8Zqa,N5_vQ');
define('MYSQL_DATABASE', 'blogza');
define('BLOG_TEMPLATE', 'default');
define('BLOG_TIMEZONE', 'America/New_York');
date_default_timezone_set(BLOG_TIMEZONE);
define("BLOG_NICE_URLS", !empty($_SERVER['BLOGZA_HTACCESS']) );
}
}