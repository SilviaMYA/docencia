<?php

session_start();
require 'connect.php';

$connection = to_connect();

//check if the user is active
$my_query = 'SELECT * FROM user WHERE nic="' . $_POST['nic'] . '" AND password="' . $_POST['password'] . '"';

//send request to MySQL.
$result = consult($connection, $my_query);


if (mysqli_num_rows($result) == 1) {
    $actualRegistry = mysqli_fetch_array($result);
    // I add user variables of the current user
    $_SESSION['id_user'] = $actualRegistry['id_user'];
    $_SESSION['nic'] = $actualRegistry['nic'];
    $_SESSION['password'] = $actualRegistry['password'];
    $_SESSION['role'] = $actualRegistry['role'];

    if ($_SESSION['role'] == 'professor') {
        echo "<script>window.location.href = '../index_professor.php';</script>";
    } else { //if they are a student 
        echo "<script>window.location.href = '../index_student.php';</script>";
    }
} else {
    echo "<script>alert('Invalid user/password');window.location.href = '../index.php';</script>";
}
disconnect($connection);
?>
