<?php
     require_once ('header.php')
?>
  
  <div class="container">
    <div class="col-md-12 m-4">
            <a href="/" class="btn btn-primary">Home</a>
            <a href="/student" class="btn btn-secondary">Students Lists</a>
        </div>
        <div class="row">
            <div class="col-md-12">
            <h2>Students Form</h2>
              <div class="col-md-6">
                <form method="post" action="/student/store">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label for="dob">DOB</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="form-group">
                        <label for="contact_no">Contact No</label>
                        <input type="number" class="form-control" id="contact_no" name="contact_no" required>
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