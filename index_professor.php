<?php
include 'header.php';
require 'libs/my_functions.php';
require 'scripts/connect.php';
if (!LOGGED || !PROFESSOR) {
    echo "<script>alert('ACCESO DENIED: go home.'); window.location.href='index.php';</script> ";
}
?>

<div class="container">
    <div class="rm_container">
        <ol class="breadcrumb">
            <li><a href="index.php" title="Go home">Home</a></li>
            <li class="active">Activities</li>
        <?php
        echo whoIam();
        ?>
        </ol>
        <h2>Activities</h2>
        <div class="text-center">
            <div class="col-md-12 text-center">
                <a class="btn btn_login" href="create_activity.php" role="button"><span class="glyphicon glyphicon-plus"></span> <b>new activity</b></a> <br><br>
            </div>
            <!--<form  id="form_score" role="form" action="scripts/answer_activity.php" method="POST">-->
            <!--<form  id="form_score" role="form" method="POST">-->
                <div class="col-md-8 col-md-offset-2"  style="margin-bottom: 100px;">
                    <table class="table table-striped">
                        <thead>
                            <tr class="t-header">
                                <th>Activity</th><th>Subject</th><th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //all activies
                            $query = getActivities();
                            $num_rows = mysqli_num_rows($query);
                            if ($num_rows > 0) {
                                while ($actualRegistry = mysqli_fetch_array($query)) {
                                    $id = $actualRegistry['id_activity'];
                                    //link that shows info about the activity
                                    echo '<tr> <td> <a href="details.php?id_activity=' . $actualRegistry['id_activity'] . '"  title="Details"><span class="glyphicon glyphicon-hand-right"></span>   ' . $actualRegistry['title'] . '</a></td>';
                                    echo '<td>' . $actualRegistry['name'] . '</td>'; //subject name
                                    echo'<td>';
                                    $answers = getAnswer($id);
                                    if (mysqli_num_rows($answers) > 0) {
                                        echo '<button role="button" class="text-right" data-toggle="modal" data-target="#modal_show_answers" title="Show answers">'
                                        . '<img src="images/show_answers.png" class="img-responsive"/></button>';
                                        ?>
                                        <!--MODAL-->
                                    <div class="modal fade" id="modal_show_answers" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="text-right" style="margin-bottom: 10px">
                                                        <button class="btn btn-danger " data-dismiss="modal" >Close</button>
                                                    </div>
                                                    <div class="panel panel-success">
                                                        <div class="panel-heading"><b>Activity </b> </div>
                                                        <div class="panel-body ">
                                                            <?php
                                                            $description = mysqli_fetch_array($answers);
                                                            echo'<h4 style="font-family: Arial">' . $description['description'] . '</h4>';
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
//                                                                                                               echo mysqli_num_rows($answers);
                                                    while ($actualAnswer = mysqli_fetch_array($answers)) {
                                                        ?>

                                                        <div class="panel panel-info">
                                                            <div class="panel-heading"><b>Student: </b>
                                                                <?php
                                                                echo $actualAnswer['nic'];
                                                                ?>
                                                            </div>
                                                            <div class="panel-body">
                                                                <b>Answer: </b><br>
                                                                <?php
                                                                echo '<span style="margin-left:30px">' . $actualAnswer['answer'] . '</span>';
                                                                ?>
                                                            </div>

                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    echo '<a href="scripts/delete_activity.php?id_activity=' . $actualRegistry['id_activity'] . '" title="Delete activity" rol>'
                                    . '<span class="glyphicon glyphicon-trash" style="margin-right: 30px"></span></a> '
                                    . '<a href="create_activity.php?id_activity=' . $actualRegistry['id_activity'] . '" title="Edit activity" rol>'
                                    . '<span class="glyphicon glyphicon-pencil" style="margin-right: 30px"></span></a><span style="color: red"> No answers </span>';
                                }
                                echo '</td></tr>';
                            }
                        } else {
                            echo '<tr> <td colspan="3"><div class="text-center"> <h3>No activities</h3> </div></td></tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            <!--</form>-->

            <br>
        </div>
    </div>
</div>


<?php
include 'footer.php';
?>
