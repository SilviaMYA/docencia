
<html>
    <head>
        <title>Docencia</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <meta charset="UTF-8" />
        <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" type="text/css" href="css/style.css" />

        <style type="text/css">
            <!--
            body {
                background-image: url(images/bg.jpg);
                background-repeat: repeat;
            }
            .conectado {
                margin-left: 25px;
            }
            -->
        </style>
    </head>
    <body>

        <header>      
            <logo>            
                <a href="index.php">
                    <img src="images/logo.png" title="Go home"/>
                </a>
            </logo>
        </header>
        <?php
        require './scripts/connect.php';
        include './libs/my_functions.php';

        if (isset($_GET['role'])) {
            $role = $_GET['role'];
            $connection = to_connect();
            if ($role == 'professor') {
                $professor = getUser("professor");
                $num_rows = mysqli_num_rows($professor);
                $actualRegistry = mysqli_fetch_array($professor);
            } else {
                $students = getUser("student");
                $num_rows = mysqli_num_rows($students);
                $actualRegistry = mysqli_fetch_array($students);
            }
            $nic = $actualRegistry['nic'];
            $pass = $actualRegistry['password'];
            $role = $actualRegistry['role'];
        } else {
            header("location: index.php");
        }
        ?>


        <div class="container">
            <div class="container rm_container">

                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Login</li>
                </ol>
                <h2>Get access</h2>


                <div class="clearfix div_login"> 
                    <div class="col-sm-4 col-sm-offset-4 bg-success " style=" padding:20px;">  
                        <span style="float: left; margin-left: 55px;">
                            <img src="images/invitado.png" class="img-circle img-responsive"/>
                        </span>
                        <span style="float: right; margin-right: 78px;  padding-top:10px;">
                            <?php
                            echo'<p><b>Nic: </b>  <i>' . $nic . '</i> </p>';
                            echo'<p><b>Passw: </b>  <i>' . $pass . '</i> </p>';
                            echo'<p>(' . $role . ') </p>';
                            ?>
                        </span>


                    </div>
                </div>

                <!-- form to login fill in nic and password -->
                <form class="login" action="scripts/check_login.php" method="POST">
                    <div class="form-group  col-sm-4 col-sm-offset-4">
                        <input type="nic" class="form-control" placeholder="Nic" id="nic" name="nic" required autofocus>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group  col-sm-4 col-sm-offset-4">
                        <input type="password" class="form-control" placeholder="Password"  id="password" name="password" required>
                        <br>    
                        <button class="btn btn-lg btn-primary btn-block" role="submit">Log in</button>
                    </div>

                </form>

            </div>

        </div>
        <?php
        include 'footer.php';
        ?>