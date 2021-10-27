<?php
<<<<<<< Updated upstream
=======
    include("database_credentials.php");
    /**SETUP**/
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $db = new mysqli($dbhost, $dbusername, $dbpasswd, $dbname);
>>>>>>> Stashed changes
    $db->query("drop table if exists students;");
    $db->query("create table students (
        id int not null auto_increment,
        email text not null,
        name text not null,
        loc text not null,
        car_desc text not null,
        password text not null,
        contact text not null,
        primary key (email));");
    
    $db->query("drop table if exists post;");
    $db->query("create table post (
        id int not null auto_increment,
        poster varchar(25) not null,
        destination text not null,
        datetime text not null,
        description text not null,
        primary key (id));");

?>