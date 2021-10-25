<?php
    include("database_credentials.php"); // define variables

    /** SETUP **/
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $db = new mysqli($dbhost, $dbusername, $dbpasswd, $dbname);
    
    $db->query("create table students (
        email text not null,
        name text not null,
        loc text not null,
        car_desc text not null,
        password text not null,
        contact text not null,
        primary key (email));");
    
    /* TOOO
    $db->query("drop table if exists post;");
    $db->query("create table post (
        id int not null auto_increment,
        question text not null,
        answer text not null,
        points int not null,
        category text not null,
        primary key (id));");
    */

?>