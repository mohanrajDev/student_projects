<?php
     require_once ('header.php')
?>
<div class="container">
        <div class="col-md-12 m-4">
            <a href="/" class="btn btn-primary">Home</a>
            <a href="/subscribe" class="btn btn-secondary">Reports</a>
        </div>
        <div class="row">
            <div class="col-md-12">
            <h2>Course  Subscribe Form</h2>
              <div class="col-md-6">
                <form method="post" action="/subscribe/store">
                    <div class="form-group">
                        <label for="student_id">Select Student</label>
                        <select class="form-control" id="student_id" name="student_id" required>
                        <?php 
                        foreach($data['students'] as $student) {
                            $student = (object) $student;
                        ?>
                        <option value="<?php echo $student->id;?>">
                             <?php echo ucwords($student->first_name . ' ' . $student->last_name);?>
                        </option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="course_id">Select Course</label>
                        <select class="form-control" id="course_id" name="course_id" required>
                        <?php 
                        foreach($data['courses'] as $course) {
                            $course = (object) $course;
                        ?>
                        <option value="<?php echo $course->id;?>">
                             <?php echo ucwords($course->name);?>
                        </option>
                        <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
        </div>
    </div>

<?php
    require_once ('footer.php')
?>