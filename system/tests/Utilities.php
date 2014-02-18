<?php

// Util.php
$test = "an39f_+f' \'~’»¯˘„ÎÅfd";
echo "Util::sanitizeAlphaNumerically($test) -> " . Util::sanitizeAlphaNumerically($test);
$test = "password";
echo "Util::hashPassword($password) -> " . Util::hashPassword($test);
$test = "my.test-email@sub.example.com";
echo "Util::sanitizeEmail($test) -> " . Util::sanitizeEmail($test);

// CAPTCHAHandler.php
echo "CAPTCHAHandler::generate() -> " . CAPTCHAHandler::generate();

// CSRFHandler.php
echo "CSRFHandler::generate() -> " . CSRFHandler::generate();