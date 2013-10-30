<?php

/* Prestart is simply a bunch of PHP code. It is no class, it follows no rules. It is used to handle stuff, especially forms and
redirects. */

// Is the user logged in or guest?
if(isset($_SESSION['username'])) {
	echo "Logged in. <br />";
	
} else {
	/* They could be logging in or they could be issuing a password change. */
	echo "Not logged in. <br />";
}