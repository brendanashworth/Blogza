<?php

/* Welcome to Blogza! Blogza is an open source blogging software, designed to
 *  1) Allow customization down to the hard HTML
 *  2) Keep blogging simple and easy
 *  3) Keep setup fast and simple
 *
 * We hope you enjoy the software! - boboman13
 */

/* Load 'mainframe.php'
 *
 * Includes basic mainframe code
 */

require('system/Blogza.php');

/* Creates Blogza object.
 *
 * Used for creating the blog.
 */
$blogza = new Blogza();

/* Start $blogza.
 *
 * No more functions are needed in this file.
 */
$blogza->start();