<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class StudentController extends BaseController
{
    public function dashboard()
    {
        // Check if user is logged in and has student role
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'student') {
            session()->setFlashdata('error', 'You do not have permission to access this page.');
            return redirect()->to('/login');
        }

        // Prepare data for student dashboard
        $data = [
            'user' => [
                'id' => session()->get('userID'),
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ],
            'enrolled_courses' => [], // Will be populated with student's enrolled courses
            'upcoming_deadlines' => [], // Will be populated with upcoming deadlines
            'recent_grades' => [], // Will be populated with recent grades/feedback
            'notifications' => [] // Will be populated with notifications
        ];

        return view('student/dashboard', $data);
    }
}
