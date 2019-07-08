<?php
require_once '../../assets/config/config.php';
require_once '../../assets/config/session.php';

header("location: ../dashboard.php");

$id = intval($_GET['id_slide'] ?? 0);

// eliminazione slide
$sql = "DELETE FROM slides WHERE id=$id";
mysqli_query($db, $sql);

if (mysqli_affected_rows($db) <= 0) {
    exit;
}

if (mysqli_error($db)) {
    echo mysqli_error($db);
}
?>