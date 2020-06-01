<?php
     require_once ('header.php')
?>
<div class="container">

             <div class="row">
        <div class="col-md-12 m-4">
            <a href="/" class="btn btn-primary">Home</a>
            <a href="/subscribe/form" class="btn btn-secondary">Subscribe Form</a>
        </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <h2>Report (<?php echo $data->total; ?>)</h2>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Course</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                   $students = $data->data; 
                   foreach($students as $student) { 
                       $student = (object) $student;              
                   ?>  
                    <tr>
                        <td><?php echo $student->student_first_name .' '. $student->student_last_name;?></td>
                        <td><?php echo $student->course_name;?></td>
                    </tr>  
                <?php } ?>                
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="<?php echo $data->prev_page_url; ?>">Previous</a></li>
                    <?php                        
                        for( $page = 1 ;$page <= $data->last_page; $page++ ) {
                    ?>
                    <li class="page-item <?php echo ($page == $data->current_page) ? ' active' :  ''; ?>"><a class="page-link" href="<?php echo $data->path . '?page=' . $page; ?>"><?php echo $page;?></a></li>
                    <?php } ?>
                    <li class="page-item"><a class="page-link" href="<?php echo $data->next_page_url; ?>">Next</a></li>
                </ul>
            </nav>
            </div>
        </div>
    </div>

<?php
    require_once ('footer.php')
?>