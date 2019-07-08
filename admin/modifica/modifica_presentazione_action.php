<?php
require_once '../../assets/config/config.php';
require_once '../../assets/config/session.php';

$id = intval($_POST['id']);
header("location: ../scheda/scheda_presentazione.php?id_presentazione=$id");

$username = mysqli_real_escape_string($db, $_SESSION['username'] ?? '');
$titolo = mysqli_real_escape_string($db, $_POST['titolo'] ?? '');
$descrizione = mysqli_real_escape_string($db, $_POST['descrizione'] ?? '');
$id_slides = $_POST['id_slide'];
print_r($id_slides);

$sql = "UPDATE presentazioni SET titolo='$titolo', descrizione='$descrizione', ultima_modifica=CURRENT_TIMESTAMP() WHERE id=$id";

if (!empty($id_slides)) {
    mysqli_query($db, "DELETE FROM presentazioni_slides WHERE id_presentazione=$id");
    foreach ($id_slides as $i => $v) {
        $v = intval($v);
        if ($v > 0) {
            $slides = "INSERT INTO presentazioni_slides VALUES ($id, $v)";
            mysqli_query($db, $slides);
        }
    }
}

$rs = mysqli_query($db, $sql);

if (mysqli_error($db)) {
    echo mysqli_error($db);
}
