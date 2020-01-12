<?php
include 'header.php';
?>


<div class="container">
    <br>

    <div class="col-md-6">
        <div class="flip-card center-block">

            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <!--if I logged before as a professor I redirect to professor home
                                other case, I redirect to login as a professor-->
                    <?php
                    if (!LOGGED || !PROFESSOR)
                        echo '<a href ="login.php?role=professor">';
                    else
                        echo '<a href="index_professor.php">';
                    ?>
                    <img src="images/avatar_professor.jpg" alt="professor" class="img-rounded" style="width:300px;height:300px;">
                    <div class="" >
                        <span class="span_role bg-success">Professor site... <span></span></span>
                    </div>
                </div>
                <div class="flip-card-back">
                    <p>Access to the system as </p>
                    <h1>Professor</h1>
                    <p>You will be able to create and see activities of your students</p>
                </div>
            </div>
        </div>
    </div>

    <!--students option-->
    <div class="col-md-6">
        <div class=" flip-card center-block">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <!-- if I logged before as a student I redirect to student home
                other case, I redirect to login as a student-->
                    <?php
                    if (!LOGGED || PROFESSOR)
                        echo '<a href ="login.php?role=student">';
                    else
                        echo '<a href="index_student.php">';
                    ?>
                    <img src="images/avatar_student.jpg" alt="student" class="img-rounded" style="width:300px;height:300px;">
                    <div class="" >
                        <span class="span_role bg-success">Students site... <span></span></span>
                    </div>
                </div>
               <div class="flip-card-back">
                    <p>Access to the system as </p>
                    <h1>Student</h1>
                    <p>You will be able to answer and see your activities</p>
                </div>
            </div>
        </div>
    </div>
    

</div>
