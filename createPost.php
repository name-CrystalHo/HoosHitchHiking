<?php
// REQUIRED HEADERS FOR CORS
// Allow access to our development server, localhost:4200
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT");

include("database_credentials.php"); // define variables

/** SETUP **/
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($dbhost, $dbusername, $dbpasswd, $dbname);


$request = file_get_contents("php://input");
$data = json_decode($request, true);


$stmt=$mysqli->prepare("insert into post (email,destination, datetime, description, type) values (?,?,?,?,?);");
$stmt->bind_param("sssss",$data["email"],$data["destination"],$data["datetime"],$data["description"],$data["requestOrOffer"]);
$stmt->execute();

echo json_encode($data, JSON_PRETTY_PRINT);
?>