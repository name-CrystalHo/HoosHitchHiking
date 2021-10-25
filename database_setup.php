<?php
    $db->query("drop table if exists students;");
    $db->query("create table students (
        id int not null auto_increment,
        email text not null,
        name text not null,
        loc text not null,
        car_desc text not null,
        password text not null,
        contact text not null,
        primary key (id));");
    
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