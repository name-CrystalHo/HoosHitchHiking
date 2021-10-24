<?php
    include("database_credentials.php"); // define variables

    /** SETUP **/
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $db = new mysqli($dbhost, $dbusername, $dbpasswd, $dbname);
    
    $db->query("drop table if exists question;");
    $db->query("create table question (
        id int not null auto_increment,
        question text not null,
        answer text not null,
        points int not null,
        category text not null,
        primary key (id));");
    
    $db->query("drop table if exists user;");
    $db->query("create table user (
        id int not null auto_increment,
        username text not null,
        password text not null,
        score int not null,
        primary key (id));");


    $db->query("drop table if exists user_question;");
    $db->query("create table user_question (
        user_id int not null,
        question_id int not null,
        score int not null);");
        


    #Computers
    $data = json_decode(file_get_contents("https://opentdb.com/api.php?amount=30&category=18"), true);
    $points = 10;
    $stmt = $db->prepare("insert into question (question, answer, points, category) values (?,?,?,?);");
    foreach($data["results"] as $qn) {
        $stmt->bind_param("ssis", $qn["question"], $qn["correct_answer"], $points, $qn["category"] );
        if (!$stmt->execute()) {
            echo "Could not add question: {$qn["question"]}\n";
        }
    }
