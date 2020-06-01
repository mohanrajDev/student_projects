<?php
     require_once ('header.php')
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-center"> 
                    <div class="mt-4">
                        <h2>Student Course Project</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="d-flex justify-content-center"> 
                    <div class="mt-4">
                    <a href="/student" class="btn btn-primary">Student Lists</a>
                    <a href="/course" class="btn btn-secondary">Course Lists</a>
                    <a href="/subscribe" class="btn btn-success">Reports</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="d-flex justify-content-center"> 
                    <div class="mt-4">
                    <a href="student/form" class="btn btn-primary">Student Form</a>
                    <a href="course/form" class="btn btn-secondary">Course Form</a>
                    <a href="subscribe/form" class="btn btn-warning">Course Subscribe Form</a>
                </div>
                </div>
            </div>
        </div>
    </div>

    <?php
     require_once ('footer.php')
    ?>