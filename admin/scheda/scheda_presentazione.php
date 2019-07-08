<?php
require_once "../../assets/config/config.php";
require_once '../../assets/config/session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Scheda Presentazione</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../assets/images/pi.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css"
          integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css"/>
    <style>
        .card-img-top {
            width: 100%;
            height: 10vw;
            object-fit: cover;
        }
    </style>
</head>
<body style="background-color: #303030">
<?php include("../../assets/include/navbar.php") ?>
<?php
$id_presentazione = $_GET['id_presentazione'];

$sql = "SELECT P.*
            FROM presentazioni AS P
            WHERE P.id = $id_presentazione
            ";
$sql2 = "SELECT S.id, 
              S.titolo,
              S.multimedia
            FROM presentazioni AS P
              JOIN presentazioni_slides AS PS
                ON P.id = PS.id_presentazione
              JOIN slides AS S
                ON PS.id_slide = S.id
            WHERE P.id = $id_presentazione
            ";
$sql3 = "SELECT E.*
            FROM presentazioni AS P
              LEFT JOIN eventi as E
                ON P.id = E.id_presentazione
            WHERE P.id = $id_presentazione
            ";

$rs = mysqli_query($db, $sql);

if (mysqli_num_rows($rs) <= 0) {
    header("location: ../dashboard.php");
    exit;
}

$rs2 = mysqli_query($db, $sql2);
$rs3 = mysqli_query($db, $sql3);

$presentazione = mysqli_fetch_assoc($rs);
$evento = mysqli_fetch_assoc($rs3);
?>

<div class="container text-white">
    <div class="row d-flex align-content-center">
        <div class="col">
            <div class="card shadow-lg border" style="border-color: black !important">
                <div class="card-header text-white" style="background-color:#212121;">
                    <h2 class="card-text">Presentazione</h2>
                    <small class="text-muted">Autore: <b><i><?= $presentazione['username'] ?></i></b></small>
                </div>

                <div class="card-body text-white" style="background-color: #424242">
                    <h3 class="card-title">Titolo:</h3>
                    <p class="card-text"><?= $presentazione['titolo'] ?></p>

                    <h3 class="card-title">Descrizione: </h3>
                    <p class="card-text"><?= $presentazione['descrizione'] ?></p>

                    <a class="btn btn-warning"
                       href="../modifica/modifica_presentazione.php?id_presentazione=<?= $id_presentazione ?>">modifica
                        presentazione</a>
                    <a class="btn btn-warning"
                       href="../eliminazione/elimina_presentazione_action.php?id_presentazione=<?= $id_presentazione ?>">elimina
                        presentazione</a>
                </div>

                <div class="card-footer text-white" style="background-color: #212121">
                    <p class="card-text">
                        <small class="text-muted">Data Creazione:
                            <b><i><?= date('d-m-Y', strtotime($presentazione['data_creazione'])) ?></i></b></small>
                        &nbsp &nbsp
                        <small class="text-muted">Ultima Modifica:
                            <b><i><?= date('H:i:s d-m-Y', strtotime($presentazione['ultima_modifica'])) ?></i></b>
                        </small>
                    </p>
                </div>
            </div>
        </div>

        <div class="col">
            <div id="calendar"></div>
        </div>
    </div>

    <br>

    <div class="row border-bottom border-warning" style="border-width: 4px !important">
        <h2 class="col text-white">Slides</h2>
    </div>
    <br>
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($rs2)): ?>
            <div class="col-sm-2">
                <div class="card">
                    <?php
                    $fileExtensions = ['jpeg', 'jpg', 'png', 'mp4'];
                    $temp = explode('.', $row['multimedia']);
                    $fileExtension = strtolower(end($temp));

                    if (!in_array($fileExtension, $fileExtensions) || !isset($row['multimedia']) || !file_exists("../../assets/uploads/{$row['multimedia']}")) {
                        $image = "images/iisc.png";
                    } else {
                        $image = "uploads/{$row['multimedia']}";
                    }
                    ?>
                    <img class="card-img-top img-fluid" src="../../assets/<?= $image ?>" alt="">
                    <div class="card-body">
                        <a href='./scheda_slide.php?id_slide=<?= $row['id'] ?>' class="card-text stretched-link"
                           style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis;display: inline-block;max-width: 100%;"><?= $row['titolo'] ?></a>
                    </div>
                </div>
                <br>
            </div>
        <?php endwhile ?>
    </div>
</div>
<?php include("../../assets/include/footer.php") ?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
        integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"
        integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.js"></script>
<script src='../../assets/include/programmazione.js'></script>
</body>
</html>
