<?php
require_once "../../assets/config/config.php";
require_once "../../assets/config/session.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Programmazione</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../assets/images/pi.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css"
          integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css"/>
</head>
<body>
<?php
$max_presentazioni = 15;
$pag = intval($_GET['pag'] ?? 0);
$offset = $pag * $max_presentazioni;

$search = mysqli_real_escape_string($db, $_GET['search'] ?? null);

$query = "SELECT id, titolo FROM presentazioni";

if ($search) {
    $query .= " WHERE titolo COLLATE UTF8_GENERAL_CI LIKE '%$search%'";
}

$query .= " LIMIT $offset, $max_presentazioni";

$result = mysqli_query($db, $query);
$rs2 = mysqli_query($db, "SELECT FOUND_ROWS()");
$max_pag = mysqli_fetch_assoc($rs2)['FOUND_ROWS()'] / $max_presentazioni;
?>
<?php include("../../assets/include/navbar.php") ?>
<div class="container">
    <div class="row d-flex align-content-center">
        <div class="col border border-dark" id="external-events" style="max-width:20%">
            <p>
                <strong>Presentazioni</strong>
            </p>
            <form method="GET" action="programmazione.php">
                <label for="search">Cerca</label>
                <input type="text" id="search" name="search" placeholder="per nome">
            </form>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="fc-event" id="<?= $row['id'] ?>"
                     style="margin: 1em 0; cursor: move;"><?= $row["titolo"] ?></div>
            <?php endwhile ?>

            <ul class="pagination justify-content-center">
                <?php for ($i=0; $i <= $max_pag; $i++): ?>
                    <?php if($i != $pag): ?>
                        <li class="page-item"><a class="page-link" href="programmazione.php?pag=<?=$i?>"><?=$i+1?></a></li>
                    <?php else: ?>
                        <li class="page-item"><a class="page-link"><?=$i+1?></a></li>
                    <?php endif ?>
                <?php endfor ?>
            </ul>
        </div>

        <div class="col">
            <div id="calendar"></div>
        </div>
    </div>


</div>

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
<script src="../../assets/include/programmazione.js"></script>
</body>
</html>
