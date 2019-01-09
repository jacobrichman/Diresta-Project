<?php
session_start();
 
$dbhost = "localhost"; // this will ususally be 'localhost', but can sometimes differ
$dbname = "Diresta"; // the name of the database that you are going to use for this project
$dbuser = "diresta"; // the username that you created, or were given, to access your database
$dbpass = "Tf#@21wLKo9b2c86"; // the password that you created, or were given, to access your database
 
mysql_connect($dbhost, $dbuser, $dbpass) or die("MySQL Error: " . mysql_error());
mysql_select_db($dbname) or die("MySQL Error: " . mysql_error());
?>