<?php

/* Prestart is simply a bunch of PHP code. It is no class, it follows no rules. It is used to handle stuff, especially forms and
redirects. */

// Is the user registering?
if(isset($_SESSION['isregistering']) && $_SESSION['isregistering'] === true) {
	// The user is officially registering.
	// Start the registration.
	unset($_SESSION['isregistering']);

	$username = $_POST['username'];
	$password = $_POST['password'];
	$passwordrep = $_POST['passwordrepeat'];
	$url = BLOG_URL;

	// If the passwords don't match, or the size of the password is 0.
	if($password !== $passwordrep || strlen($password) === 0) {
		$url = BLOG_URL . "/register/";
		$_SESSION['error'] = "The passwords are not the same!";
	// If the username is already taken.
	} else if($this->getDatabaseManager()->getUser($username) !== null) {
		$url = BLOG_URL . "/register/";
		$_SESSION['error'] = "That username is already in use!";
	// Passed the two tests, we can now register.
	} else {
		$user = $this->getDatabaseManager()->createUser($username, $password);

		// Encountered an odd error while registering.
		if($user == false) {
			$url = BLOG_URL . "/register/";
			$_SESSION['error'] = "An error has occurred while registering.";
		} else {
			$url = BLOG_URL;
			unset($_SESSION['isregistering']);
		}

	}
	// Now that we're done handling that, we can now redirect the user.
	Blogza::redirect($url);
}



// Is the user logged in or guest?
if(isset($_SESSION['username'])) {
	echo "Logged in. <br />";
	
} else {
	/* They could be logging in or they could be issuing a password change. */
	echo "Not logged in. <br />";
}