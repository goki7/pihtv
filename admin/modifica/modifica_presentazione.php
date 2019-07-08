<?php
require_once "../../assets/config/config.php";
require_once '../../assets/config/session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modifica Presentazione</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../assets/images/pi.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css"
          integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css"/>

    <style>
        .nopad {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        /*image gallery*/
        .image-checkbox {
            cursor: pointer;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            border: 4px solid transparent;
            margin-bottom: 0;
            outline: 0;
        }

        .image-checkbox input[type="checkbox"] {
            display: none;
        }

        .image-checkbox-checked {
            border-color: #4783B0;
        }

        .image-checkbox .fa {
            position: absolute;
            color: #4A79A3;
            background-color: #fff;
            padding: 10px;
            top: 0;
            right: 0;
        }

        .image-checkbox-checked .fa {
            display: block !important;
        }

        .card-img-top {
            width: 100%;
            height: 10vw;
            object-fit: cover;
        }
    </style>
</head>
<body style="background-color: #303030">
<?php
$id = $_GET['id_presentazione'];

$sql = "SELECT * FROM presentazioni WHERE id=$id";
$sql2 = "SELECT id, titolo, multimedia FROM slides";

$rs = mysqli_query($db, $sql);
$rs2 = mysqli_query($db, $sql2);

if (mysqli_num_rows($rs) <= 0) {
    header("location: ../dashboard.php");
    exit;
}

$presentazione = mysqli_fetch_assoc($rs);
?>

<?php include("../../assets/include/navbar.php") ?>

<div class="container text-white">
    <form action="modifica_presentazione_action.php" method="POST">
        <input type="hidden" name="id" value="<?= $id ?>"/>
        <div class="row d-flex align-content-center">
            <div class="col">
                <div class="card shadow-lg border" style="border-color: black !important">
                    <div class="card-header text-white" style="background-color:#212121;">
                        <h2 class="card-text">Modifica Presentazione</h2>
                        <small class="text-muted">Autore: <b><i><?= $_SESSION['username'] ?></i></b></small>
                    </div>

                    <div class="card-body text-white" style="background-color:#424242">
                        <div class="form-group">
                            <h4>Titolo</h4>
                            <input class="form-control form-control-md col-md-8" name="titolo" type="text"
                                   maxlength="128" value="<?= $presentazione['titolo'] ?>" autofocus/>
                        </div>
                        <div class="form-group">
                            <h4>Descrizione</h4>
                            <textarea class="form-control form-control-md col-md-8" name="descrizione" type="text"
                                      maxlength="255" rows="6"><?= $presentazione['descrizione'] ?></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sx-2">
                                <button class="btn btn-warning" type="submit">Modifica</button>
                            </div>
                        </div>
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
                    <div class="card nopad">
                        <label class="image-checkbox">
                            <?php
                            $fileExtensions = ['jpeg', 'jpg', 'png', 'mp4'];
                            $temp = explode('.', $row['multimedia']);
                            $fileExtension = strtolower(end($temp));

                            if (!in_array($fileExtension, $fileExtensions) || !isset($row['multimedia']) || !file_exists("../../assets/uploads/{$row['multimedia']}")) {
                                $image = "images/pi.jpg";
                            } else {
                                $image = "uploads/{$row['multimedia']}";
                            }
                            ?>
                            <img class="card-img-top img-fluid" src="../../assets/<?= $image ?>" alt="">
                            <div class="card-body">
                                <input type="checkbox" name="id_slide[]" value="<?= $row['id'] ?>"/>
                                <i class="fa fa-check" hidden></i>
                                <p class="card-text stretched-link"
                                   style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis;display: inline-block;max-width: 100%;color:black"><?= $row['titolo'] ?></p>
                            </div>
                        </label>
                    </div>
                    <br>
                </div>
            <?php endwhile ?>
        </div>
    </form>
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
<script>
    // image gallery
    // init the state from the input
    $(".image-checkbox").each(function () {
        if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
            $(this).addClass('image-checkbox-checked');
        } else {
            $(this).removeClass('image-checkbox-checked');
        }
    });

    // sync the state to the input
    $(".image-checkbox").on("click", function (e) {
        $(this).toggleClass('image-checkbox-checked');
        var $checkbox = $(this).find('input[type="checkbox"]');
        $checkbox.prop("checked", !$checkbox.prop("checked"));

        e.preventDefault();
    });

</script>
<script src='../../assets/include/programmazione.js'></script>
</body>
</html>
