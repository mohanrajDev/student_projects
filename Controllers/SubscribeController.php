<?php 

namespace App\Controller;

use App\Model\Course;
use App\Model\Student;
use App\Model\Report;
use App\Controller as BaseController;

class SubscribeController extends BaseController{

    /**
     * Report Lists
     */
    public function index()
    {
        $studentModel = new Report();
        $student_courses = (object) $studentModel->getStudentCourse();

        $this->view('subscribe_lists', $student_courses);
    }

    /**
     * Subscribe Form
     */
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

    /**
     * Save the subscription info
     * @param $subscribe
     */
    public function store()
    {
        $student_id = $_POST['student_id'];
        $course_id = $_POST['course_id'];

        $model = new Report();

        $result = $model->select(['course_id'])->where('student_id', '=', $student_id)->get();

         $course_exists = [];
         foreach($result as $data) {
            $course_exists[] = (int) $data['course_id'];
         }

         if (!in_array($course_id ,$course_exists )) {
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