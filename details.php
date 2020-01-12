<?php
include 'header.php';
require 'libs/my_functions.php';
require './scripts/connect.php';

if (!LOGGED) {
    echo "<script>window.location.href='index.php';</script> ";
}
if (isset($_GET['id_activity'])) {
    $id_activity = $_GET['id_activity'];
    $connection = to_connect();
}
?>

<div class="container">
    <div class="rm_container" style=" padding:20px">
       <ol class="breadcrumb">
            <li><a href="index.php" title="Go home">Home</a></li>
            <?php
            if ($_SESSION['role'] == "professor") {
                echo '<li><a href="index_professor.php" title="List activities">Activities</a></li>';
            } else if ($_SESSION['role'] == "student") {
                echo '<li><a href="index_student.php" title="List activities">Activities</a></li>';
            } else {
                echo '<li><a href="index.php" title="List activities">Activities</a></li>';
            }
            ?>

            <li class="active">Details</li>
        <?php
        echo whoIam();
        ?>
        </ol>
        <h2>Details</h2>
        <div class="text-center" style="margin-bottom: 100px;">

            <?php
            echo'<table class="details_table" >';
            echo'<thead><th><tr><td colspan="4" class="text-center"><b>ACTIVITY DETAILS</b></td></tr></th> </thead>';
            $query = consult($connection, "SELECT * FROM activity INNER JOIN subject ON activity.subject_id_subject = subject.id_subject WHERE id_activity = $id_activity");
            $actualRow = mysqli_fetch_array($query);
            $created = $actualRow['date_created'];
            $deadline = $actualRow['deadline'];
            echo'<tbody> <tr><td class="fondo_azul">Title: <br><br>Subject:<br><br>Created:<br><br>Deadline: <br><br>Description:</td>'
            . '<td class="resul_evaluacion">' . $actualRow['title'] . '<br><br>' . $actualRow['name'] . '<br><br><a style="color: #c60ec0;">' . showDate($created) . '</a><br><br><a  style="color: red">' . showDate($deadline) . '</a><br><br>' . $actualRow['description'] . '</td>';
            
            if ($_SESSION['role'] == "student") {
                echo'<td>';
                 ?>
                <form action="scripts/answer_activity.php" method="POST">
                    <div class="panel panel-success">
                        <div class="panel-heading">Answer below</div>
                        <div class="panel-body">
                            <textarea class="form-control" id="show_answer_text" name="answer_text" required></textarea>   
                            <?php
                            echo '<input type="hidden" id="id_activity" name="id_activity" value="' . $id_activity . '">';
                            ?>
                        </div>
                        <div class="text-center" style="margin-bottom: 5px">
                        <button role="reset" class="btn my_button">Clear</button>
                        <button role="submit" class="btn my_button">Send answer</button>
                        </div>
                    </div>
                </form>
                <?php
            echo'</td>'; 
            }
            
            echo' </tr></table>';
            ?>
        </div>
     
    </div>

</div>
<?php
include 'footer.php';
?>