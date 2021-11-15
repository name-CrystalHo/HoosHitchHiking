<!--
Sources used: https://cs4640.cs.virginia.edu, https://www.w3schools.com/
Resources: https://www.w3jar.com/login-with-google-account-using-php-mysqli-source-code/
-->

<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function($classname){
    include "classes/$classname.php";
});
$path = parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);
$path = str_replace("/HoosHitchHiking/","",$path);
$parts = explode("/",$path);

session_start(); 

if(!isset($_SESSION["email"])){
    //need to login 
    $parts=["signin"];   
}

echo $parts[0];
$HH = new HHController();
$HH->run($parts[0]);?>