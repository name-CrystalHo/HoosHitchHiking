<?php

class HHController {

    private $db;
    
    private $url = "/HoosHitchHiking";
    
    //will have instance of database object
    public function __construct() {
        $this->db = new Database();
    }
    //handles logic of methods
    public function run($command) {
        switch($command) {
            // case "updateProfile":
            //     $this->updateProfile();
            case "logout":
                $this->destroySession();
                break;
            case "signin":
            default:
                $this->signin();
                break;
        }
            
    }
    
    //destroy and restart
    private function destroySession() {          
        session_destroy();
        session_start();
    }
    
    
    public function signin() {
        // our login code from index.php last time!
        $error_msg = ""; 
        // header("Location:signup.php");
        // exit();
        $_SESSION["email"] ="sdfs";
        header("Location:home.php");
        return;
        include("signin.php");
    }

    // public function updateProfile() {
    //     if (isset($_POST["name"]) || isset($_POST["name"]) || isset($_POST["contact"]) || isset($_POST["loc"]) || isset($_POST["car_desc"])) {
    //     $this->db->query("update student set
    //                         name = ?,
    //                         contact = ?,
    //                         loc = ?,
    //                         car_desc = ?
    //                         where email = ?;", "is", 
    //                         $_POST["name"], $_POST["contact"], $_POST["loc"], $_POST["car_desc"], $_SESSION["email"]);
    // }
    
    
    // }
}