<?php

/**
* The User class.
**/
class User {

	public $username;
	public $password;
	public $posts;
	public $rank;
	public $email;
	public $id;
	protected $ips = array();

	public $avatar;

	/**
	* Creates the BlogzaUser instance.
	*
	* @access	public
	* @param 	$username 	The user's display name.
	* @param 	$password 	The user's password (hashed).
	* @param 	$posts 		The amount of posts the user has made.
	* @param 	$rank 		The user's rank.
	* @param 	$email 		The user's email to send emails to.
	* @param 	$id 		The user's ID.
	* @return 	mixed
	**/
	public function __construct($username, $password, $posts, $rank, $email, $id, $ips) {
		if($username == null || $password == null || $posts == null) {
			throw new Exception("The username, password, or posts cannot be null!");
		}

		$this->username = htmlentities($username);
		$this->password = htmlentities($password);
		$this->posts = htmlentities($posts);
		$this->rank = htmlentities($rank);
		$this->email = htmlentities(stripslashes($email));
		$this->id = htmlentities($id);
		for($i = 0; $i < count(explode(',', $ips)); $i++) {
			$this->ips[] = explode(',', $ips)[$i];
		}

		$this->avatar = $this->generateAvatar($email);
	}

	/**
	* Generates the link used for Gravatar.
	*
	* @access 	public
	* @param 	string 	$email 	The unhashed email.
	* @param 	int 	$size 	The size of the image.
	* @return 	string 	The URL for the gravatar image.
	**/
	private function generateAvatar($email, $size = '128') {
		$url = 'http://www.gravatar.com/avatar/';
		$url .= md5( strtolower( trim( $email ) ) );
		$url .= "?s=".$size;

		return $url;
	}


	/**
	* Gets the username.
	*
	* @access 	public
	* @deprecated
	* @return 	string 	The username.
	**/
	public function getUsername() {
		return $this->username;
	}

	/**
	* Gets the hashed password.
	*
	* @access 	public
	* @deprecated
	* @return 	string 	The hashed password.
	**/
	public function getPassword() {
		return $this->password;
	}

	/**
	* Sets the user's new password.
	*
	* @access 	public
	* @param 	string 	$password 	The user's new password.
	* @return 	void
	**/
	public function setPassword($password) {
		$password = Util::sanitizeAlphaNumerically($password);

		Database::updateUserPassword($this->getUsername(), $password);
	}

	/**
	* Gets the amount of posts from the user.
	*
	* @access 	public
	* @deprecated
	* @return 	int 	The amount of posts the user has made.
	**/
	public function getPosts() {
		return $this->posts;
	}

	/**
	* Gets the rank of the user.
	*
	* @access 	public
	* @deprecated
	* @return 	string 	The string representation of the user's rank.
	**/
	public function getRank() {
		return $this->rank;
	}

	/**
	* Gets the email of the user.
	*
	* @access 	public
	* @deprecated
	* @return 	string 	The user's email.
	**/
	public function getEmail() {
		return strtolower(trim($this->email));
	}

	/**
	* Gets the user's ID from the database.
	*
	* @access 	public
	* @deprecated
	* @return 	int 	The user's ID.
	**/
	public function getID() {
		return $this->id;
	}

	/**
	* Gets the user's access link.
	*
	* @access 	public
	* @return 	string 	The link to the users profile.
	**/
	public function getLink() {
		return "/members/" . $this->getUsername() . "." . $this->getID() . "/";
	}

	/**
	* Gets the user's avatar link.
	*
	* @access 	public
	* @param 	int 	$size 	The size of the avatar.
	* @return 	string
	**/
	public function getAvatar($size = '') {
		if(!empty($size)) {
			$this->avatar = $this->generateAvatar($this->email, $size);
		}

		return $this->avatar;
	}

	/**
	* Gets the user's logged-in IPs.
	*
	* @access 	public
	* @return 	array
	**/
	public function getIPs() {
		return implode(', ', $this->ips);
	}

	/**
	* Registers a user in the database.
	*
	* @access 	public
	* @param 	string 	$username 	The requested username of the new user.
	* @param 	string 	$password 	The user's password.
	* @param 	string 	$passwordrep 	The user's password repeated.
	* @param 	string 	$email 		The user's email.
	* @param 	boolean $sendemail 	Whether or not to send an email to the user.
	* @return 	void
	**/
	public static function register($username, $password, $passwordrep, $email, $sendemail) {
		// Checks if the user was missing any fields.
		if(!isset($username) || !isset($password) || !isset($passwordrep) || !isset($email)) {
			throw new Exception("All forms must be filled out.");
		}

		// Checks if the user was missing the secret token. TODO

		// Checks if both passwords are equal
		if($password != $passwordrep) {
			throw new Exception("Your passwords do not match.");
		}

		// Do sanitization on the fields. This helps us prevent against shortening in the below process.
		$username    = Util::sanitizeAlphaNumerically($username);
		$password    = Util::sanitizeAlphaNumerically($password);
		$passwordrep = Util::sanitizeAlphaNumerically($passwordrep);
		$ip = $_SERVER['REMOTE_ADDR'];

		if(!Util::sanitizeEmail($email)) {
			throw new Exception("Your email is not a real email.");
		}

		// Checks if the username is already taken.
		$user = Database::getUser($username);
		if($user != null) {
			throw new Exception("That username is already in use.");
		}

		// Checks if there exists an email in the database that is the same email.
		$users = Database::getUsers();
		foreach($users as $user) {
			if($user->getEmail() === $email) {
				throw new Exception("That email is already in use.");
			}
		}

		// Checks if the username and password are of the correct size
		if( !(strlen($password) > 5 && strlen($password) < 21) ) {
			throw new Exception("Your password must be within 6 and 20 characters");
		}

		if( !(strlen($username) > 5 && strlen($username) < 17) ) {
			throw new Exception("Your username must be between 6 and 16 characters.");
		}

		Database::createUser($username, $password, $email, "Registered", $ip);

		// Sends the user an email.
		if ($sendemail) {
			$content = '
			<html><body><h1>Thanks for registering on ' . BLOG_NAME . '!</h1>
			<p>Dear ' . $username . ', </p>
			<p>This email is to remind you of your registration on ' . BLOG_NAME . '. If you did not register on the website, please notify one of our administrators.</p>
			<p>Check back for the latest posts at <a href="' . BLOG_URL . '">our site</a>.</p></body></html>
			';

			$mail = new Mail($email, "noreply@blogza.tk", "Welcome to " . BLOG_NAME . ".", $content);
			$mail->setHTML(true);
			$mail->send();
		}

		Auth::login($username);

		Util::redirect(BLOG_URL);
	}

	/**
	* Logs in a user.
	*
	* @access 	public
	* @param 	string 	$username 	User's username.
	* @param 	string 	$password 	Unhashed given password.
	* @return 	void
	**/
	public static function login($username, $password) {
		// Checks if the user was missing any fields.
		if( !(isset($username) && isset($password)) ) {
			throw new Exception("You didn't include both username and password.");
		}

		// Checks if the user was missing the secret token, TODO

		// Sanitizes the variables
		$username = Util::sanitizeAlphaNumerically($username);
		$password = Util::sanitizeAlphaNumerically($password);

		$password = Util::hashPassword($password);

		$user = Database::getUser($username);
		if($user == null) {
			throw new Exception("Username and/or password incorrect.");
		}

		if($user->getPassword() != $password) {
			throw new Exception("Username and/or password incorrect.");
		}

		Auth::login($username);

		Util::redirect(BLOG_URL);
	}

}