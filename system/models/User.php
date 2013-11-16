<?php

/**
* The User class.
**/
class User {

	protected $username;
	protected $password;
	protected $posts;
	protected $rank;
	protected $email;

	/**
	* Creates the BlogzaUser instance.
	*
	* @access	public
	* @param 	$username 	The user's display name.
	* @param 	$password 	The user's password (hashed).
	* @param 	$posts 		The amount of posts the user has made.
	* @param 	$rank 		The user's rank.
	* @return 	mixed
	**/
	public function __construct($username, $password, $posts, $rank, $email) {
		if($username == null || $password == null || $posts == null) {
			throw new Exception("The username, password, or posts cannot be null!");
		}

		$this->username = htmlspecialchars($username);
		$this->password = htmlspecialchars($password);
		$this->posts = htmlspecialchars($posts);
		$this->rank = htmlspecialchars($rank);
		$this->email = htmlspecialchars($email);
	}

	/**
	* Gets the username.
	*
	* @access 	public
	* @return 	string 	The username.
	**/
	public function getUsername() {
		return $this->username;
	}

	/**
	* Gets the hashed password.
	*
	* @access 	public
	* @return 	string 	The hashed password.
	**/
	public function getPassword() {
		return $this->password;
	}

	/**
	* Gets the amount of posts from the user.
	*
	* @access 	public
	* @return 	int 	The amount of posts the user has made.
	**/
	public function getPosts() {
		return $this->posts;
	}

	/**
	* Gets the rank of the user.
	*
	* @access 	public
	* @return 	string 	The string representation of the user's rank.
	**/
	public function getRank() {
		return $this->rank;
	}

	/**
	* Gets the email of the user.
	*
	* @access 	public
	* @return 	string 	The user's email.
	**/
	public function getEmail() {
		return strtolower(trim($this->email));
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

		Database::createUser($username, $password, $email, "Registered");

		// Sends the user an email.
		if ($sendemail) {
			echo "Sending email.";
			require BLOGZA_DIR . "/system/models/Mail.php";

			$mail = new Mail("nobody@troll.tk", "forums@blogza.tk", "A user has registered on your blog!", "Hi there.");
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