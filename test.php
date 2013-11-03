<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

require "system/controllers/Blogza.php";

$blogza = new Blogza();

$blogza->start();