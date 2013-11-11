<?php

$routes = array(

/* ----------------------------------------
 | This file contains the file routes.
 | ----------------------------------------
 | If you want to create your own pages,
 | or modify the controller for a page,
 | this is the place. Here is a list of
 | every page for the simplicity of users.
 */

/*
 | Route style:
 | "/path/to/page" => "FileName.controller.php@ControllerClass@methodForRoute",
 */

"/" => "Home.controller.php@Home@start",

// NOTICE: After installation, comment out these lines. (Put a // in front of both)
"/install/" => "Installer.controller.php@InstallerController@start",
"/install/step/([1-3])" => "Installer.controller.php@InstallerController@step",

"/register/" => "Authentication.controller.php@AuthenticationController@register",
"/login/" => "Authentication.controller.php@AuthenticationController@login",
"/logout/" => "Authentication.controller.php@AuthenticationController@logout",

"/post/([0-9]+)" => "Post.controller.php@PostController@viewPost",

);