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
 | $this->router->method('/path/to/page', 'ControllerClass@methodForRoute');
 |           The ^METHOD^ is the HTTP request type.
 */

// NOTICE: After installation, comment out these lines. (Put a // in front of both)
$this->router->get('/install/', 'InstallerController@start');
$this->router->get('/install/step/([1-3])', 'InstallerController@step');

// PostController
$this->router->get('/', 'PostController@index');
$this->router->get('/posts/', 'PostController@index');
$this->router->get('/posts/{number}/', 'PostController@viewPost');

// AuthenticationController
$this->router->any('/register/', 'AuthenticationController@register');
$this->router->any('/login/', 'AuthenticationController@login');
$this->router->get('/logout/', 'AuthenticationController@logout');

// MemberController
$this->router->get('/members/', 'MemberController@index');
$this->router->get('/members/{alphanumeric}.{number}/', 'MemberController@viewMember');

// AdminController
$this->router->get('/admin/', 'AdminController@index');
$this->router->get('/admin/create-post', 'AdminController@createPost');

// Errorz
$this->router->any('404', 'HTTPErrorController@display404');