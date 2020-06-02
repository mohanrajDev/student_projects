<?php 

namespace App\Controller;

use App\Controller as BaseController;
use App\Model\Course;

class CourseController extends BaseController {

    /**
     * Courses list
     */
    public function index()
    {
        $model = new Course();
        $courses = (object) $model->paginate(5);
        $this->view('course_lists', $courses);
    }

    /**
     * New Course Form
     */
    public function form()
    {
        $this->view('course_form');
    }

    /**
     * Course Store
     * @param $course
     */
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

    /**
     * Edit Course 
     * @param $id
     */
    public function edit($id)
    {
        $model = new Course();
        $course = $model->find($id);
        $this->view('course_edit', $course);
    }

    /**
     * Update Course
     * @param $id
     * @param $course
     */
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

    /**
     * Delete the Course
     * @param $id
     */
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