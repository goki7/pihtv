<?php
require_once '../../assets/config/config.php';
require_once '../../assets/config/session.php';

if (isset($_POST["id"])) {
    $id = $_POST['id'];

    $query = "DELETE FROM eventi WHERE id=$id";
    $result = mysqli_query($db, $query);
}

header("Location: programmazione.php");
?>