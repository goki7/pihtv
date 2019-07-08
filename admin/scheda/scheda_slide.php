<?php
require_once "../../assets/config/config.php";
require_once '../../assets/config/session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Scheda Slide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../assets/images/pi.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css"
          integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
</head>
<body style="background-color: #303030">
<?php include("../../assets/include/navbar.php") ?>
<?php
$id_slide = $_GET['id_slide'];
$sql = "SELECT * FROM slides WHERE id=$id_slide";  # query

$rs = mysqli_query($db, $sql); # query effettiva

if (mysqli_num_rows($rs) <= 0) {
    header("location: ../dashboard.php");
    exit;
}

$slide = mysqli_fetch_assoc($rs);
// $date1 = new DateTime(date('Y-m-d H:i:s'));
// $date2 = new DateTime($slide['ultima_modifica']);
// $temp = $date1->diff($date2)->format('%d');
// $temp2 = $date1->diff($date2)->format('%h');
// $time_diff = ($temp == "0" ? "" : $temp . " giorni e ");
// $time_diff2 = $date1->diff($date2)->format('%i') . ' minuti fa';

// $ultimo_accesso = $time_diff .$time_diff2;
if (!$rs) {
    die(mysqli_error($db));
}
?>
<div class="container">
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="card shadow-lg border" style="border-color:black !important">
                <div class="card-header text-white" style="background-color:#212121;">
                    <h2>Slide</h2>
                    <small class="text-muted">Autore: <b><i><?= $slide['username'] ?></i></b></small>
                </div>

                <div class="card-body text-white" style="background-color:#424242">
                    <h3 class="card-title">Titolo:
                        <small><?= $slide['titolo'] ?></small>
                    </h3>

                    <h4 class="card-title">Descrizione</h4>
                    <p class="card-text"><?= $slide['testo'] ?></p>

                    <h4 class="card-title">Multimedia</h4>
                    <p class="card-text"><?= $slide['multimedia'] ?></p>

                    <h4 class="card-title">Durata</h4>
                    <p class="card-text"><?= $slide['durata'] ?> ore</p>

                    <br>
                    <a class="btn btn-warning" href="../modifica/modifica_slide.php?id_slide=<?= $id_slide ?>">modifica
                        slide</a>
                    <a class="btn btn-warning"
                       href="../eliminazione/elimina_slide_action.php?id_slide=<?= $id_slide ?>">elimina slide</a>
                </div>

                <div class="card-footer text-white" style="background-color:#212121">
                    <p class="card-text">
                        <small class="text-muted">Data Creazione:
                            <b><i><?= date('d-m-Y', strtotime($slide['data_creazione'])) ?></i></b></small>
                        &nbsp &nbsp
                        <small class="text-muted">Ultima Modifica:
                            <b><i><?= date('H:i:s d-m-Y', strtotime($slide['ultima_modifica'])) ?></i></b></small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("../../assets/include/footer.php") ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"
        integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp"
        crossorigin="anonymous"></script>
</body>
</html>
