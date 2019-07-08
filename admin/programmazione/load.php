<?php
require_once '../../assets/config/config.php';
require_once '../../assets/config/session.php';

$id = intval($_GET['id_presentazione']);

$query = "SELECT P.titolo, E.id, data_inizio, data_fine, orario_inizio, orario_fine FROM eventi AS E JOIN presentazioni AS P ON P.id = E.id_presentazione";
if ($id) {
    $query = $query . " WHERE id_presentazione=$id";
}

$result = mysqli_query($db, $query);

foreach ($result as $row) {
    $data[] = array(
        'id' => $row["id"],
        'title' => $row['titolo'],
        'start' => $row["data_inizio"] . ($row["orario_inizio"] !== "00:00:00" ? "T" . $row["orario_inizio"] : ""),
        'end' => $row["data_fine"] . ($row["orario_fine"] !== "00:00:00" ? "T" . $row["orario_fine"] : "")
    );
}

echo json_encode($data);

?>