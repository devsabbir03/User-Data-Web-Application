<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "userdata";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "DELETE FROM users WHERE id=$id";
    $conn->query($sql);

    header("Location: ./index.php");
    exit;
}
?>