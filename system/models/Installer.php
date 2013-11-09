<?php

/**
* Installer Model.
**/
class Installer extends Model {

	/**
	* The default configuration file.
	*
	* @var 	array
	**/
	protected $config = array(
			"BLOG_NAME" => "My Blog",
			"BLOG_DESC" => "This is a blog powered by the Blogza blog framework.",

			"BLOG_TEMPLATE" => "default",
			"BLOG_URL" => "http://myblog.com",
			"BLOG_TIMEZONE" => "America/New_York",

			"MYSQL_HOST" => "localhost",
			"MYSQL_USER" => "dbuser",
			"MYSQL_PASSWORD" => "dbpassword",
			"MYSQL_DATABASE" => "blogza_database",
			);

	/**
	* Creates an Installer.
	*
	* @access 	public
	* @return 	Installer
	**/
	public function __construct() {
		
	}

	/**
	* Overwrites the settings.php with the given settings.
	*
	* @access 	public
	* @param 	array 	$settings 	The settings for the new settings.php.
	* @return 	void
	**/
	public function overwriteConfiguration($settings) {
		if(!is_array($settings)) {
			throw new Exception("An array is necessary for overwriting a configuration.");
		}

		/* Merge the default config and the new config. */
		foreach($this->config as $key => $value) {
			if(array_key_exists($key, $settings)) {
				continue;
			}

			$settings[$key] = $value;
		}

		$this->generateNewConfiguration($settings);
	}

	/**
	* Generates a new configuration file with the given settings.
	*
	* @access 	private
	* @param 	array 	$settings 	Array of settings to put in the settings.php.
	* @return 	void
	**/
	private function generateNewConfiguration($settings) {
		$prefile = 
'
<?php
class Settings {
public function __construct() {
// All the settings for the blog. ';
		$endfile=
'
date_default_timezone_set(BLOG_TIMEZONE);
}
}
';
		// Now we have our file.
		foreach($settings as $key => $value) {
			$prefile .= "\ndefine('$key', '$value');";
		}

		file_put_contents(BLOGZA_DIR . "/system/settings.php", $prefile . $endfile);
	}

}