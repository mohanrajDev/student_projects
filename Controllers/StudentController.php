<?php 

namespace App\Controller;

use App\Controller as BaseController;
use App\Model\Student;

class StudentController extends BaseController {

    public function index()
    {
        $model = new Student();
        $students = (object) $model->paginate(5);
        $this->view('student_lists', $students);
    }

    public function form()
    {
        $this->view('student_form');
    }

    public function store()
    {        
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $dob = $_POST['dob'];
        $dob = date("Y-m-d", strtotime($dob));
        $contact_no = $_POST['contact_no'];
        
        $model = new Student();
        $student_result = $model->insert([
        'first_name' => $first_name,
        'last_name' => $last_name,
        'dob' => $dob,
        'contact_no' => $contact_no,
        ]);
        
        if($student_result) {   
            header("Location: /student");
            exit();
        }
    }


    public function edit($id)
    {
        $model = new Student();
        $student = $model->find($id);
        $this->view('student_edit', $student);
    }

    public function update($id)
    {            
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $dob = $_POST['dob'];
        $dob = date("Y-m-d", strtotime($dob));
        $contact_no = $_POST['contact_no'];
        
        $model = new Student();
        $student_result = $model->update($id, [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'dob' => $dob,
        'contact_no' => $contact_no,
        ]);
            
        if($student_result) {   
            header("Location: /student");
            exit();
        }
    }

    public function delete($id)
    {
        $model = new Student();
        $student_result = $model->delete($id);
        if($student_result) {   
            header("Location: /student");
            exit();
        }
    }
}