<?php

session_start();
include '../libs/my_functions.php';
require 'connect.php';

//Must be a professor to be able to delete an activity
if (!isset($_SESSION['nic']) || ($_SESSION['role'] != "professor")) {
    echo "<script>alert('ERROR: Ypu must be a professor.')</script>";
    header('location: ../login.php');
}

$connection = to_connect();
if (isset($_GET['id_activity'])) {

    //activity to delete
    $activity_to_detele = $_GET['id_activity'];
    $withAnswer = getAnswer($activity_to_detele);
    if (mysqli_num_rows($withAnswer) > 0) {
        echo "<script>alert('Have answer No DELETED');</script>";
    } else {

        //delete
        $deleted = "DELETE FROM activity WHERE id_activity='" . $activity_to_detele . "'";
        $result = consult($connection, $deleted);
        disconnect($connection);

        if (!$result) {
            echo "<script>alert('Error occurred deleting activity');</script>";
        }
    }
echo "<script>window.location.href='../index_professor.php';</script> ";
}
?>
