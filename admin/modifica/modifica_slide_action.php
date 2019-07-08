<?php
require_once '../../assets/config/config.php';
require_once '../../assets/config/session.php';

$id = intval($_POST['id']);
header("location: ../scheda/scheda_slide.php?id_slide=$id");

$uploadDirectory = "../../assets/uploads/";
$errors = []; // Store all foreseen and unforseen errors here
$fileExtensions = ['jpeg', 'jpg', 'png', 'mp4']; // Get all the file extensions
$fileName = $_FILES['multimedia']['name'];
$fileSize = $_FILES['multimedia']['size'];
$fileTmpName = $_FILES['multimedia']['tmp_name'];
$fileType = $_FILES['multimedia']['type'];
$fileExtension = strtolower(end(explode('.', $fileName)));
$uploadPath = $uploadDirectory . basename($fileName);

$titolo = mysqli_real_escape_string($db, $_POST['titolo'] ?? '');
$testo = mysqli_real_escape_string($db, $_POST['testo'] ?? '');
$multimedia = mysqli_real_escape_string($db, $fileName ?? '');
$durata = date("H:i:s", strtotime($_POST['durata']));

if (!empty($multimedia)) {
    $sql = "UPDATE slides SET titolo='$titolo', testo='$testo', multimedia='$multimedia', durata='$durata', ultima_modifica=CURRENT_TIMESTAMP() WHERE id=$id";
} else {
    $sql = "UPDATE slides SET titolo='$titolo', testo='$testo', durata='$durata', ultima_modifica=CURRENT_TIMESTAMP() WHERE id=$id";
}

$rs = mysqli_query($db, $sql);

if (isset($_POST['submit'])) {
    if (!in_array($fileExtension, $fileExtensions)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG or MP4 file";
    }

    if ($fileSize > 2000000) {
        $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
    }
    if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
        if ($didUpload) {
            echo "The file " . basename($fileName) . " has been uploaded";
        } else {
            echo "An error occurred somewhere. Try again or contact the admin";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";
        }
    }
}

if (mysqli_error($db)) {
    echo mysqli_error($db);
}
