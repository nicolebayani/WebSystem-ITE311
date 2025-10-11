<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EnrollmentModel;
use App\Models\CourseModel;

class StudentController extends BaseController
{
    public function dashboard()
    {
        // Check if user is logged in and has student role
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'student') {
            session()->setFlashdata('error', 'You do not have permission to access this page.');
            return redirect()->to('/login');
        }

        $enrollmentModel = new EnrollmentModel();
        $courseModel = new CourseModel();
        $user_id = session()->get('id');

        $enrolled_courses = $enrollmentModel->getUserEnrollments($user_id);
        $all_courses = $courseModel->findAll();

        $enrolled_course_ids = array_column($enrolled_courses, 'id');

        $available_courses = array_filter($all_courses, function($course) use ($enrolled_course_ids) {
            return !in_array($course['id'], $enrolled_course_ids);
        });

        // Prepare data for student dashboard
        $data = [
            'user' => [
                'id' => $user_id,
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ],
            'enrolled_courses' => $enrolled_courses, 
            'available_courses' => $available_courses,
            'upcoming_deadlines' => [], // Will be populated with upcoming deadlines
            'recent_grades' => [], // Will be populated with recent grades/feedback
            'notifications' => [] // Will be populated with notifications
        ];

        return view('student/dashboard', $data);
    }

    public function courses()
    {
        // Check if user is logged in and has student role
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'student') {
            session()->setFlashdata('error', 'You do not have permission to access this page.');
            return redirect()->to('/login');
        }

        $enrollmentModel = new EnrollmentModel();
        $courseModel = new CourseModel();
        $user_id = session()->get('id');

        $enrolled_courses = $enrollmentModel->getUserEnrollments($user_id);
        $all_courses = $courseModel->findAll();

        $enrolled_course_ids = array_column($enrolled_courses, 'id');

        $available_courses = array_filter($all_courses, function($course) use ($enrolled_course_ids) {
            return !in_array($course['id'], $enrolled_course_ids);
        });

        $data = [
            'user' => [
                'id' => $user_id,
                'name' => session()->get('name'),
            ],
            'available_courses' => $available_courses,
        ];

        return view('student/courses', $data);
    }
}