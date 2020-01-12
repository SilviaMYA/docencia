<?php
include 'header.php';
require 'libs/my_functions.php';
require 'scripts/connect.php';
if (!LOGGED || !PROFESSOR) {
    echo "<script>alert('ACCESO DENIED: go home.'); window.location.href='index.php';</script> ";
}


if ($_GET) {
    $activity = $_GET['id_activity'];
    $resultActivity = getActivity($activity);
    $actualActivity = mysqli_fetch_array($resultActivity);
} else {
    $activity = "";
}

$students = getStudents();
$total_students = mysqli_num_rows($students);

//get subjects
$subjects = getSubjects();
?>



<div class="container">
    <div class="rm_container">
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="index_professor.php">Activities</a></li>
            <li class="active">New activity</li>
        <?php
        echo whoIam();
        ?>
        </ol>
        <h2>New activity</h2>
        <div class="text-center">
            <form method="post" class="form-horizontal" action="scripts/check_create_activity.php" onsubmit="return check_new_activity(this)" > 
                <b>ACTIVITY</b>
                <br>
                <br>
                <div class="col-sm-6 col-sm-offset-3 bg-success" style="  border-radius: 8px; border: thin solid #c60ec0; margin-bottom: 125px">
                    <div style="padding: 30px">
                    <div class="">
                        <div class="text-left">Title</div>

                        <input class="form-control" type="text" id="title"  name="title" required
                        <?php
                        if ($activity != "")
                            echo 'value="' . $actualActivity['title'] . '"';
                        ?>
                               >
                    </div>
                    <div class="clearfix" style="margin-bottom: 10px"></div>

                    <div class="">
                        <div class="text-left">Subject</div>

                        <select class="form-control" name="subject" id="subject" required="">
                            <option>--Select one subject--</option>
                            <?php
                            $i = 1;

                            while ($row = mysqli_fetch_array($subjects)) {
                                echo '<option value="' . $i . '"';
                                echo' >' . $row['name'] . '</option>';
                                $id = $i;
                                $i++;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="clearfix" style="margin-bottom: 10px"></div>
                    <!--start-->
                    <div class="">
                        <div class="text-left deadline">Deadline</div>
                        <input type="text" id="deadline" name="deadline" required class="form-control"
                        <?php
                        if ($activity != "")
                            echo 'value="' . showDate($actualActivity['deadline']) . '"';
                        else {
                            echo 'placeholder="DD-MM-YYYY HH:mm"';
                        }
                        ?>
                               >
                    </div>
                    <div class="clearfix" style="margin-bottom: 10px"></div>
                    <div class="">
                        <div id="div_deadline" class="text-left">Description</div>

                        <fieldset>
                            <?php
                            echo'<textarea id="description" class="form-control" name="description" required>';
                            if ($activity != "")
                                echo $actualActivity['description'];
                            echo'</textarea>';
                            ?>
                        </fieldset>
                        <?php
                        if ($activity != "")
                            echo '<input type="hidden" id="id_activity_edited" name="id_activity_edited" value="' . $activity . '">';
                        ?>
                    </div>
                    <div class="clearfix" style="margin-bottom: 20px"></div>
                    <div>
                        <button role="submit" class="btn btn_login">Submit</button>
                        <button class="btn btn_login" role="reset"> Cancel </button><br>
                    </div> 
                    </div> 
                </div>
            </form>
        </div>

    </div>
</div>


<?php
include 'footer.php';
?>
<script>
    $(document).ready(function () {
        $('#deadline').datetimepicker({
            format: 'DD-MM-YYYY HH:mm'
        });
    });

</script>