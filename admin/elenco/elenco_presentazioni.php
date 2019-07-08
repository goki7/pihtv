<?php
require_once "../../assets/config/config.php";
require_once '../../assets/config/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Archivio Presentazioni</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../assets/images/pi.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css"
          integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
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
// pagination
$max_presentazioni = 12;
$pag = intval($_GET['pag'] ?? 0);
$offset = $pag * $max_presentazioni;

$sql = "SELECT * FROM presentazioni";
$search = mysqli_real_escape_string($db, $_GET['search'] ?? null);

if ($search) {
  $sql .= " WHERE titolo COLLATE UTF8_GENERAL_CI LIKE '%$search%'";
}

$sql .= " LIMIT $offset, $max_presentazioni";

$rs = mysqli_query($db, $sql);

$rs2 = mysqli_query($db, "SELECT FOUND_ROWS()");
$max_pag = mysqli_fetch_assoc($rs2)['FOUND_ROWS()'] / $max_presentazioni;
?>

<div class="container">
    <div class="row border-bottom border-warning" style="border-width: 4px !important">
        <h2 class="col text-white">Archivio Presentazioni</h2>
        <form action="elenco_presentazioni.php" method="GET">
          <input type="text" name="search" placeholder="Cerca per nome" style="margin-top:15px; margin-right: 10px">
        </form>
        <a href="../creazione/crea_presentazione.php"><i style="padding-top:23px;" class="text-warning fas fa-plus"></i></a>
    </div>
    <br>
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($rs)): ?>
            <div class="col-sm-2">
                <div class="card">
                    <img class="card-img-top img-fluid" src="../../assets/images/pi.jpg" alt="">
                    <div class="card-body">
                        <a href='../scheda/scheda_presentazione.php?id_presentazione=<?= $row['id'] ?>'
                           class="card-text stretched-link"
                           style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis;display: inline-block;max-width: 100%;"><?= $row['titolo'] ?></a>
                    </div>
                </div>
                <br>
            </div>
        <?php endwhile ?>
    </div>
    <div class="row d-flex justify-content-center">
        <ul class="pagination">
          <?php for ($i=0; $i <= $max_pag; $i++): ?>
            <?php if($i != $pag): ?>
                <li class="page-item"><a class="page-link" href="elenco_presentazioni.php?pag=<?=$i?>"><?=$i+1?></a></li>
            <?php else: ?>
                <li class="page-item"><a class="page-link"><?=$i+1?></a></li>
            <?php endif ?>
          <?php endfor ?>
        </ul>
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
