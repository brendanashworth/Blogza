<?php

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
 | $this->router->get('/path/to/page', 'FileName.controller.php@ControllerClass@methodForRoute');
 */

// NOTICE: After installation, comment out these lines. (Put a // in front of both)
$this->router->get('/install/', 'Installer.controller.php@InstallerController@start');
$this->router->get('/install/step/([1-3])', 'Installer.controller.php@InstallerController@step');


$this->router->get('/', 'Home.controller.php@Home@start');

$this->router->get('/register/', 'Authentication.controller.php@AuthenticationController@register');
$this->router->get('/login/', 'Authentication.controller.php@AuthenticationController@login');
$this->router->get('/logout/', 'Authentication.controller.php@AuthenticationController@logout');

$this->router->get('/post/([0-9]+)', 'Post.controller.php@PostController@viewPost');

$this->router->get('/admin/', 'Admin.controller.php@AdminController@index');
$this->router->get('/admin/create-post', 'Admin.controller.php@AdminController@createPost');

$this->router->any('404', 'HTTPError.controller.php@HTTPError@display404');