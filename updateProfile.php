<?php //Process the profile update
include("database_credentials.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($dbhost, $dbusername, $dbpasswd, $dbname);
//Check if atleast one field was updated
if ($_POST["name"] != "" || $_POST["contact"] != "" || $_POST["loc"] != "" || $_POST["car_desc"] != "" ) {
    $stmt = $mysqli->prepare("update student set
                        name = ?,
                        contact = ?,
                        loc = ?,
                        car_desc = ?
                        where email = 'jtk2rw@virginia.edu';");
                        //TODO: Use session email
    $stmt->bind_param("ssss", $_POST["name"], $_POST["contact"], $_POST["loc"], $_POST["car_desc"]);
    if ($stmt->execute()) {
        $success = True;
    }
}
    else {
        $success = False;
    }

    header("Location:index.php?success=$success");
?>