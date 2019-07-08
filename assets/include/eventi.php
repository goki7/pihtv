<?php
require_once "../config/config.php";

$date = date('Y-m-d');
$query = "SELECT
            E.data_inizio, 
            E.data_fine, 
            E.orario_inizio, 
            E.orario_fine,
            E.id,
            S.multimedia, 
            S.durata
          FROM presentazioni AS P 
            JOIN eventi AS E 
              ON P.id = E.id_presentazione
            JOIN presentazioni_slides AS PS 
              ON P.id = PS.id_presentazione
            JOIN slides AS S 
              ON PS.id_slide = S.id
          WHERE E.data_inizio = '$date' OR E.data_fine = '$date'";

$result = mysqli_query($db, $query);

while($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>