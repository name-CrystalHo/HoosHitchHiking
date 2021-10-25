<?php 
    if (isset($_POST["name"]) || isset($_POST["name"]) || isset($_POST["contact"]) || isset($_POST["loc"]) || isset($_POST["car_desc"])) {
        $this->db->query("update student set
                            name = ?,
                            contact = ?,
                            loc = ?,
                            car_desc = ?
                            where email = ?;", "is", 
                            $_POST["name"], $_POST["contact"], $_POST["loc"], $_POST["car_desc"], $_SESSION["email"]);
        }
?>