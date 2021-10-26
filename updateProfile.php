<?php //Process the profile update
include("database_credentials.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($dbhost, $dbusername, $dbpasswd, $dbname);
echo $_POST["email"];
//Check if atleast one field was updated
if ($_POST["name"] != "" || $_POST["contact"] != "" || $_POST["loc"] != "" || $_POST["car_desc"] != "" ) {
    $stmt = $mysqli->prepare("update students set
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

    header("Location:home?success=$success");
?>