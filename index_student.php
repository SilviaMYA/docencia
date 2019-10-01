<?php
include 'header.php';
require 'libs/my_functions.php';
require 'scripts/connect.php';
if (!LOGGED || PROFESSOR) {
    echo "<script>alert('ACCESO DENIED: go home.'); window.location.href='index.php';</script> ";
}
?>

<div class="container">
    <div class="container rm_container">
        <ol class="breadcrumb">
            <li><a href="index.php" title="Go home">Home</a></li>
            <li class="active">Activities</li>
        </ol>
        <?php
        echo whoIam();
        ?>
        <h2>Activities</h2>
        <div class="text-center" >

            <div class="col-md-8 col-md-offset-2"  style="margin-bottom: 100px;">
                <table class="table table-striped">
                    <thead>
                        <tr class="t-header">
                            <th>Activity</th><th>Subject</th><th>Deadline</th><th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //all activites
                        $query = getActivities();
                        $num_rows = mysqli_num_rows($query);
                        if ($num_rows > 0) {
                            while ($actualRegistry = mysqli_fetch_array($query)) {
                                $id = $actualRegistry['id_activity'];
                                //link that shows info about the activity
                                echo '<tr> <td> <a href="details.php?id_activity=' . $actualRegistry['id_activity'] . '"  title="Details">' . $actualRegistry['title'] . '</a></td>';
                                echo '<td>' . $actualRegistry['name'] . '</td>'; //subject name
                                echo '<td>' . showDate($actualRegistry['deadline']) . '</td>';
                                $answers = getAnswer($id);
                                if (mysqli_num_rows($answers) > 0) {
                                    $user_answer = getAnswerUser($id, $_SESSION['id_user']);
                                    $my_answer = mysqli_fetch_array($user_answer);

                                    echo' <td><button id="button_show_answer" role="button" data-toggle="modal" title="My answer" class="btn text-right" data-target="#modal_show_answer" '
                                    . 'data-whatever="' . $actualRegistry['description'] . '" data-hidden="' . $id . '" ><img src="images/my_answer.jpeg"/></button></td>';
                                } else {
                                    echo'<td><a href="details.php?id_activity=' . $actualRegistry['id_activity'] . '"  title="Details"> <b>Details <b/></a></td>';
                                }
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr> <td colspan="3"><div class="alerta text-center"> <h3>No activities</h3> </div><td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>   
        </div>
    </div>

</div>




<!--MODAL TO SHWO MY ANSWER-->
<div class="modal fade" id="modal_show_answer" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-right">
                    <button class="btn btn-danger " data-dismiss="modal" >X</button>
                </div>
                <div>
                    <label  class="col-form-labelv">
                        <?php
                        echo $my_answer['title'];
                        ?>
                    </label>
                    <?php
                    echo'<textarea class="form-control"  readonly="">' . $my_answer['description'] . '</textarea>';
                    ?>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-form-labelv">Your answer:</label>
                    <?php
                    echo'<textarea class="form-control"  readonly="">' . $my_answer['answer'] . '</textarea>';
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <button role="button" data-dismiss="modal" class="btn btn-success">Close</button>
            </div>
        </div>
    </div>
</div>


<?php
include 'footer.php';
?>
