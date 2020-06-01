<?php
     require_once ('header.php')
?>
    <div class="container">
        <div class="row">
        <div class="col-md-12 m-4">
            <a href="/" class="btn btn-primary">Home</a>
            <a href="/student/form" class="btn btn-secondary">Student Form</a>
        </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <h2>Students List (<?php echo $data->total; ?>)</h2>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">DOB</th>
                    <th scope="col">Contact No</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                   <?php 
                   $students = $data->data;            
                   foreach($students as $student) { 
                       $student = (object) $student;                  
                   ?>  
                    <tr>
                        <th scope="row"><?php echo $student->id;?></th>
                        <td><?php echo $student->first_name;?></td>
                        <td><?php echo $student->last_name;?></td>
                        <td><?php echo $student->dob;?></td>
                        <td><?php echo $student->contact_no;?></td>
                        <td>
                            <a href="student/edit/<?php echo $student->id?>" class="btn btn-info">Edit</a>
                        </td>
                        <td>
                            <form  method="post" action="student/delete/<?php echo $student->id; ?>">
                                <button href="button" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
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