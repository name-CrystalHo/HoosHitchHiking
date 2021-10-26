<?php //Process the profile update
include("database_credentials.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($dbhost, $dbusername, $dbpasswd, $dbname);
//Check if atleast one field was updated
if ($_POST["destination"] != "" && $_POST["datetime"] != "" && $_POST["description"] != "") {
    /*
    $stmt = $mysqli->prepare("update students set
                        name = ?,
                        contact = ?,
                        loc = ?,
                        car_desc = ?
                        where email = 'jtk2rw@virginia.edu';");
                        //TODO: Use session email
    */
    $post_details = array('destination' => $_POST["destination"], 
                            'datetime' => $_POST["datetime"], 
                            'description' => $_POST["description"],
                            'requestOrOffer' => $_POST['requestOrOffer']
                        );
    echo json_encode($post_details);
}
?>