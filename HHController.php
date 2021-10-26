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
            case "home":
                header("Location:home.php");
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
        require 'google-api/vendor/autoload.php';
       
        // Creating new google client instance
        $client = new Google_Client();
        // Enter your Client ID
        $client->setClientId($this->db->clientID);
        // Enter your Client Secrect
        $client->setClientSecret($this->db->clientSecret);
        // Enter the Redirect URL
        $client->setRedirectUri($this->db->redirectUri);
       
        // Adding those scopes which we want to get (email & profile Information)
        $client->addScope("email");
        $client->addScope("profile");
       if(isset($_GET['code'])){
        
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        echo $token["error"];
        if(!isset($token["error"])){
            $db_connection=$this->db->mysqli;
            $client->setAccessToken($token['access_token']);

            // getting profile information
            $google_oauth = new Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();
            
            // Storing data into database
            $full_name = mysqli_real_escape_string($db_connection, trim($google_account_info->name));
            $email = mysqli_real_escape_string($db_connection, $google_account_info->email);
            // $profile_pic = mysqli_real_escape_string($db_connection, $google_account_info->picture);
            
            // checking user already exists or not
            $get_user = mysqli_query($db_connection, "SELECT `email` FROM `students` WHERE `email`='$email'");
            if(mysqli_num_rows($get_user) > 0){

                $_SESSION['email'] = $email; 
                header('Location: /HoosHitchHiking/');
                return;

            }
            else{

                // if user not exists we will insert the user
                $insert = mysqli_query($db_connection, "INSERT INTO `students`(`name`,`email`) VALUES('$full_name','$email')");

                if($insert){
                    $_SESSION['email'] = $email; 
                    header('Location: /HoosHitchHiking/');
                    exit;
                }
                else{
                    echo "Sign up failed!(Something went wrong).";
                }

            }

        }
    }

    public function updateProfile() {
        // if (isset($_POST["name"]) || isset($_POST["name"]) || isset($_POST["contact"]) || isset($_POST["loc"]) || isset($_POST["car_desc"])) {
        //     $stmt = $mysqli->prepare("update student set
        //                         name = ?,
        //                         contact = ?,
        //                         loc = ?,
        //                         car_desc = ?
        //                         where email = 'jtk2rw@virginia.edu';");
        //                         //TODO: Use session email
        //     $stmt->bind_param("ssss", $_POST["name"], $_POST["contact"], $_POST["loc"], $_POST["car_desc"]);
        //     $stmt->execute(); 
        // }
    }
}