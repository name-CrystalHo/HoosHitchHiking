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
            case "updateProfile":
                $this->updateProfile();
                break;
            case "home":
                include("home.php");
                break;
            case "myposts":
                include("my-posts.php");
                break;
            case "all":
                include("all.php");
                break;
            case "faq":
                include("faq.php");
                break;
            case "create":
                include("create.php");
                break;
            case "logout":
                $this->destroySession();           
            case "signin":
            default:
                $this->signin();
                break;
        }
            
    }

    //destroy and restart
    public function destroySession() {          
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
                $_SESSION['name'] = $full_name; 
                header('Location: /HoosHitchHiking/home');
                return;

            }
            else{

                // if user not exists we will insert the user
                $insert = mysqli_query($db_connection, "INSERT INTO `students`(`name`,`email`) VALUES('$full_name','$email')");

                if($insert){
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $full_name;  
                    header('Location: /HoosHitchHiking/');
                    return;
                }
                else{
                    echo "Sign up failed!(Something went wrong).";
                }

            }
        }
        }
        include("signin.php");
    }
        
    
    public function updateProfile() {
        if ($_POST["name"] != "" || $_POST["contact"] != "" || $_POST["loc"] != "" || $_POST["car_desc"] != "" ) {
            $stmt = $this->db->mysqli->prepare("update students set
                                name = ?,
                                contact = ?,
                                loc = ?,
                                car_desc = ?
                                where email = ?;");
                                //TODO: Use session email
            $stmt->bind_param("sssss", $_POST["name"], $_POST["contact"], $_POST["loc"], $_POST["car_desc"],$_POST["email"]);
            if ($stmt->execute()) {
                $success = True;
            }
        }
            else {
                $success = False;
            }
            header("Location:home");
    }

}