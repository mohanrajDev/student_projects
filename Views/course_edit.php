<?php
    require_once ('header.php')
?>
   
   <div class="container">
    <div class="col-md-12 m-4">
            <a href="/" class="btn btn-primary">Home</a>
            <a href="/course" class="btn btn-secondary">Course Lists</a>
        </div>
        <div class="row">
            <div class="col-md-12">
            <h2>Course Form</h2>
              <div class="col-md-6">
                <form method="post" action="/course/update/<?php echo $data->id; ?>">
                    <div class="form-group">
                        <label for="name">Course Name</label>
                        <input type="text" class="form-control" 
                        value="<?php echo $data->name;?>"
                        id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="details">course Details</label>
                        <textarea class="form-control" 
                        id="details" name="details" required> <?php echo $data->details;?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
              </div>
            </div>
        </div>
    </div>
<?php
    require_once ('footer.php')
?>