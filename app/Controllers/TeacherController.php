<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TeacherController extends BaseController
{
    public function dashboard()
    {
        // Check if user is logged in and has teacher role
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'teacher') {
            session()->setFlashdata('error', 'You do not have permission to access this page.');
            return redirect()->to('/login');
        }

        // Prepare data for teacher dashboard
        $data = [
            'user' => [
                'id' => session()->get('userID'),
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ],
            'courses' => [], // Will be populated with teacher's courses
            'notifications' => [], // Will be populated with notifications
            'recent_activity' => [] // Will be populated with recent activity
        ];

        return view('teacher/dashboard', $data);
    }
}
