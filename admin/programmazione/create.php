<?php
require_once '../../assets/config/config.php';
require_once '../../assets/config/session.php';

$data = json_decode(file_get_contents("php://input"), true);

$id_presentazione = intval($data['id_presentazione']);
$start = $data['start'];
$end = $data['end'];
$orario_inizio = $data['orario_inizio'];
$orario_fine = $data['orario_fine'];

$query = "INSERT INTO eventi VALUES (NULL, '$start', '$end', '$orario_inizio', '$orario_fine', $id_presentazione)";
$result = mysqli_query($db, $query);
?>
