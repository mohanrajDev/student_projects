<?php 

namespace App\Controller;

use App\Controller as BaseController;
use App\Model\Course;

class CourseController extends BaseController {

    public function index()
    {
        $model = new Course();
        $courses = (object) $model->paginate(5);
        $this->view('course_lists', $courses);
    }

    public function form()
    {
        $this->view('course_form');
    }

    public function store()
    {        
        $name = $_POST['name'];
        $details = $_POST['details'];  

        $model = new Course();
        $course_result = $model->insert([
            'name' => $name,
            'details' => $details,
        ]);

        if($course_result) {   
            header("Location: /course");
            exit();
        }
    }

    public function edit($id)
    {
        $model = new Course();
        $course = $model->find($id);
        $this->view('course_edit', $course);
    }

    public function update($id)
    {
        $name = $_POST['name'];
        $details = $_POST['details'];

        $model = new Course();
        $course_result = $model->update($id, [
            'name' => $name,
            'details' => $details,
        ]);

        if($course_result) {   
            header("Location: /course");
            exit();
        }
    }

    public function delete($id)
    {
        $model = new Course();
        $course_result = $model->delete($id);

        if($course_result) {   
            header("Location: /course");
            exit();
        }
    }
}