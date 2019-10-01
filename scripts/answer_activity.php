<?php

session_start();
require './connect.php';
include '../libs/my_functions.php';
$connection = to_connect();

//check if the user logged in as a student
if (!isset($_SESSION['nic']) || ($_SESSION['role'] != "student")) {
    echo "<script>alert('ERROR: you must be a student.')</script>";
    header('location: ../login.php');
}

$idUser = $_SESSION['id_user'];
$id_activity = $_POST['id_activity'];
$answer = $_POST['answer_text'];

$insertion = "INSERT INTO activity_done (score,	answer,	user_id_user, activity_id_activity)";
$insertion .= " VALUES (0, '" . $answer . "'," . $idUser . "," . $id_activity . ")";

$result = consult($connection, $insertion);

if ($result) { //if the answer has been inserted correctly, redirect to student home
    echo "<script>alert('Answer created successfully.');</script>";
} else {
    echo "<script>alert('Error: occurred creating answer');</script>";
}
echo "<script>window.location.href='../index_student.php';</script> ";

disconnect($connection);
?>


