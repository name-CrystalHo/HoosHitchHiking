<?php spl_autoload_register(function($classname){
    include "$classname.php";
});
$path = parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);
$path = str_replace("/HoosHitchHiking/","",$path);
$parts = explode("/",$path);
session_start(); 

if(!isset($_SESSION["email"])){
    //need to login 
    $parts=["signin"];   
}
else{
    $parts=["home"];  
}
$HH = new HHController();
$HH->run($parts[0]);?>