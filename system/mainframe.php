<?php

/* Welcome to Blogza! Blogza is an open source blogging software, designed to
 *  1) Allow customization down to the hard HTML
 *  2) Keep blogging simple and easy
 *  3) Keep setup fast and simple
 *
 * We hope you enjoy the software! - boboman13
 */

function start() {
	// Load all the .php structure files
	require __DIR__.'/blog.php';
	require __DIR__.'/routes.php';
	require __DIR__.'/templates.php';


}


