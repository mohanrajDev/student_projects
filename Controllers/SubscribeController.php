<?php 

namespace App\Controller;

use App\Model\Course;
use App\Model\Student;
use App\Model\Report;
use App\Controller as BaseController;

class SubscribeController extends BaseController{

    public function index()
    {
        $studentModel = new Report();
        $student_courses = (object) $studentModel->getStudentCourse();

        $this->view('subscribe_lists', $student_courses);
    }

    public function form()
    {
        $studentModel = new Student();
        $students = $studentModel->select(['id', 'first_name', 'last_name'])->get();

        $courseModel = new Course();
        $courses = $courseModel->select(['id', 'name'])->get();

        $data = [
            'students' => $students, 
            'courses' => $courses
        ];

        $this->view('subscribe_form', $data);
    }

    public function store()
    {
        $student_id = $_POST['student_id'];
        $course_id = $_POST['course_id'];

        $model = new Report();
    
        $result = $model->find($student_id, $course_id);
        if (
            (isset($result->course_id) != $course_id)
            && 
            (isset($result->student_id) != $student_id)            
        ) {
            $result = $model->insert([
                'student_id' => $student_id,
                'course_id' => $course_id
            ]);
        }

        if($result) {
            header("Location: /subscribe");
            exit();
        }
    }
}