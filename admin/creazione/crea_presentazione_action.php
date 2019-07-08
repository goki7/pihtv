<?php
require_once "../../assets/config/config.php";
require_once '../../assets/config/session.php';

header("location: ../elenco/elenco_presentazioni.php");

$username = mysqli_real_escape_string($db, $_SESSION['username'] ?? '');
$titolo = mysqli_real_escape_string($db, $_POST['titolo'] ?? '');
$descrizione = mysqli_real_escape_string($db, $_POST['descrizione'] ?? '');
$data_inizio = date("Y:m:d", strtotime($_POST['data_inizio']));
$data_fine = date("Y:m:d", strtotime($_POST['data_fine']));
$orario_inizio = date("H:i:s", strtotime($_POST['orario_inizio']));
$orario_fine = date("H:i:s", strtotime($_POST['orario_fine']));
$id_slides = $_POST['id_slide'];

$sql = "INSERT INTO presentazioni VALUES (NULL, '$titolo', '$descrizione', NULL, CURRENT_TIMESTAMP(), '$username')";
$rs = mysqli_query($db, $sql);

$id = intval(mysqli_insert_id($db));

foreach ($id_slides as $i => $v) {
    $v = intval($v);
    if ($v > 0) {
        $slides = "INSERT INTO presentazioni_slides VALUES ($id, $v)";
        mysqli_query($db, $slides);
    }
}

$evento = "INSERT INTO eventi VALUES (NULL, '$data_inizio', '$data_fine', '$orario_inizio', '$orario_fine', $id)";
$rs2 = mysqli_query($db, $evento);

if (mysqli_error($db)) {
    echo mysqli_error($db);
}
?>