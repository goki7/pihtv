<?php
require_once '../../assets/config/config.php';
require_once '../../assets/config/session.php';

$data = isset($_GET['id']) ? $_REQUEST : json_decode(file_get_contents('php://input'), true);

$id = intval($_GET['id'] ?? $data['id']);
$data_inizio = mysqli_real_escape_string($db, $data["data_inizio"]);
$data_fine = mysqli_real_escape_string($db, $data["data_fine"]);
$orario_inizio = mysqli_real_escape_string($db, $data['orario_inizio']);
$orario_fine = mysqli_real_escape_string($db, $data['orario_fine']);

$query = "UPDATE eventi SET data_inizio='$data_inizio', data_fine='$data_fine', orario_inizio='$orario_inizio', orario_fine='$orario_fine' WHERE id=$id";
$result = mysqli_query($db, $query);

if(isset($_GET['id']))header("Location: programmazione.php");
?>