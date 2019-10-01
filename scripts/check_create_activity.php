<?php

session_start();
require '../libs/my_functions.php';
require './connect.php';

//check if the user logged as a professor

if (!isset($_SESSION['nic']) || $_SESSION['role'] != 'professor') {
    echo "<script>alert('ACCESO DENIED: go home.'); window.location.href='index.php';</script> ";
}

$connection = to_connect();

$idUser = $_SESSION['id_user'];
if ($_POST) {
    $edit = $_POST['id_activity_edited'];
}

date_default_timezone_set('Australia/Melbourne');
$now = date('Y-m-d H:i:s');
$new_date = date_create($_POST['deadline']);
$deadline = date_format($new_date, 'Y-m-d H:i:s');

$title = $_POST['title'];
$description = $_POST['description'];
$deadline = $_POST['deadline'];
$subject = $_POST['subject'];

$result = createActivity($title, $description, $now, $deadline, $subject, $idUser, $edit);

if ($result) {
    echo "<script>alert('Activity created successfully.');</script>";
} else {
    echo "<script>alert('Error: occurred creating activity');</script>";
}
echo "<script>window.location.href='../index_professor.php';</script> ";


disconnect($connection);
?>
