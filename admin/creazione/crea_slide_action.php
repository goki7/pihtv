<?php
require_once '../../assets/config/config.php';
require_once '../../assets/config/session.php';

header("location: ../elenco/elenco_slides.php");

// setup per upload file
$uploadDirectory = "../../assets/uploads/";
$errors = []; // Store all foreseen and unforseen errors here
$fileExtensions = ['jpeg', 'jpg', 'png', 'mp4']; // Get all the file extensions
$fileName = $_FILES['multimedia']['name'];
$fileSize = $_FILES['multimedia']['size'];
$fileTmpName = $_FILES['multimedia']['tmp_name'];
$fileType = $_FILES['multimedia']['type'];
$fileExtension = strtolower(end(explode('.', $fileName)));
$uploadPath = $uploadDirectory . basename($fileName);

$username = mysqli_real_escape_string($db, $_SESSION['username'] ?? '');
$titolo = mysqli_real_escape_string($db, $_POST['titolo'] ?? '');
$testo = mysqli_real_escape_string($db, $_POST['testo'] ?? '');
$multimedia = mysqli_real_escape_string($db, $fileName ?? '');
$durata = date("H:i:s", strtotime($_POST['durata']));

$sql = "INSERT INTO slides VALUES (NULL, '$titolo', '$testo', '$multimedia', NULL, CURRENT_TIMESTAMP(), '$durata', '$username')";

$rs = mysqli_query($db, $sql);

// upload dei file

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