<?php

error_reporting(E_ALL);

echo '1';

require "system/controllers/Blogza.php";

echo '2';

$blogza = new Blogza();

echo '3';

$blogza->start();

echo '4';