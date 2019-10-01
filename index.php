<?php
    include 'header.php';
?>


<div class="container">
    <div class="container rm_container">
        <h2>Docencia</h2>
        <br>
        <div class="row" style="margin-bottom: 80px">
            <!--professor option-->
            <div class="col-sm-6">  
                <div>
                    <br/>

                    <!--if I logged before as a professor I redirect to professor home
                    other case, I redirect to login as a professor-->
                    <?php
                    if (!LOGGED || !PROFESSOR)
                        echo '<a href ="login.php?role=professor">';
                    else
                        echo '<a href="index_professor.php">';
                    ?>

                    <img class="img-responsive center-block" src="images/avatar_professor.jpg"/>
                    <div class="" >
                        <span class="span_role bg-success">Professor site...</span>
                    </div>
                    </a>
                </div>
                <br/>

            </div>

            <!--students option-->

            <div class="col-sm-6"> 
                <div>
                    <br/>
                    <!--if I logged before as a student I redirect to student home
                    other case, I redirect to login as a student-->
                    <?php
                    if (!LOGGED || PROFESSOR)
                        echo '<a href ="login.php?role=student">';
                    else
                        echo '<a href="index_student.php">';
                    ?>
                    <img class="img-responsive center-block" src="images/avatar_student.jpg"/>
                    <div class="" >
                        <span class="span_role bg-success">Students site... <span></span></span>
                    </div>
                    </a>
                </div>
                <br/>
            </div>

        </div>
    </div>
