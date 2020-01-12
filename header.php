<?php
    session_start();

    //If is logged
    if (isset($_SESSION['nic']) && !empty($_SESSION['nic']) && isset($_SESSION['role']) && !empty($_SESSION['role'])) {
        define('LOGGED', true);
        //I check if is logged as PROFESSOR
        if (($_SESSION['role']) == 'professor') {
            define('PROFESSOR', true);
        } else {
            define('PROFESSOR', false);
        }
    } else {
        define('LOGGED', false);
    }

    function whoIam() {
        $result = '<span style="float: right"><a href="scripts/end_session.php"><span class="glyphicon glyphicon-log-out"></span> Exit</a></b> <b>' . $_SESSION['role'] . ' </b>' . $_SESSION['nic'] . '</span>';
        return $result;
    }
?>



<html>
    <head>
        <title>Docencia</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <meta charset="UTF-8" />
        <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>

        <header>      
            <logo>            
                <a href="index.php">
                    <img src="images/logo.png" title="Go home"/>
                </a>
            </logo>
        </header>
