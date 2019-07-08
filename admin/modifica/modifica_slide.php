<?php
require_once "../../assets/config/config.php";
require_once '../../assets/config/session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modifica Slide</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../assets/images/pi.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css"
          integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
</head>
<body style="background-color: #303030">
<?php include("../../assets/include/navbar.php") ?>
<?php
$id = $_GET['id_slide'];
$sql = "SELECT * FROM slides WHERE id=$id";  # query

$rs = mysqli_query($db, $sql); # query effettiva

if (mysqli_num_rows($rs) <= 0) {
    header("location: ../dashboard.php");
    exit;
}

$slide = mysqli_fetch_assoc($rs);
$date1 = new DateTime(date('Y-m-d H:i:s'));
$date2 = new DateTime($slide['ultima_modifica']);
$temp = $date1->diff($date2)->format('%d');
$temp2 = $date1->diff($date2)->format('%h');
$time_diff = ($temp == "0" ? "" : $temp . " giorni e ");
$time_diff2 = $date1->diff($date2)->format('%i') . ' minuti fa';

$ultimo_accesso = $time_diff . $time_diff2;
?>

<div class="container">
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="card shadow-lg border" style="border-color:black !important">
                <div class="card-header text-white" style="background-color:#212121;">
                    <h2>Modifica Slide</h2>
                    <small class="text-secondary">Autore: <b><i><?= $slide['username'] ?></i></b></small>
                </div>

                <div class="card-body text-white" style="background-color:#424242">
                    <form class="" action="modifica_slide_action.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $id ?>"/>
                        <div class="form-group">
                            <h4>Titolo</h4>
                            <input class="form-control form-control-md col-md-8" name="titolo" type="text"
                                   value="<?= $slide['titolo'] ?>" maxlength="128" size="50" autofocus/>
                        </div>
                        <div class="form-group">
                            <h4>Descrizione</h4>
                            <textarea class="form-control form-control-md col-md-8" name="testo" type="text"
                                      maxlength="255" rows="6"><?= $slide['testo'] ?></textarea>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="form-group col-sx-2">
                                <label for="durata">Durata</label>
                                <input class="form-control" id="durata" name="durata" type="time"
                                       value="<?= $slide['durata'] ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="multimedia">Multimedia</label>
                                <input class="form-control-file" id="multimedia" name="multimedia" type="file"/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sx-2">
                                <button class="btn btn-warning" name="submit" type="submit">Modifica</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-white" style="background-color:#212121">
                    <p class="card-text">
                        <small class="text-secondary">Data Creazione: <b><i><?= $slide['data_creazione'] ?></i></b>
                        </small>
                        &nbsp &nbsp
                        <small class="text-secondary">Ultima Modifica: <b><i><?= $ultimo_accesso ?></i></b></small>
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
