<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;

class AdminController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'You do not have permission to access this page.');
        }

        $db = \Config\Database::connect();
        $courseModel = new \App\Models\CourseModel();

        $totalUsers = $db->table('users')->countAllResults();
        $activeTeachers = $db->table('users')->where('role', 'teacher')->countAllResults();
        $activeStudents = $db->table('users')->where('role', 'student')->countAllResults();
        $totalCourses = $courseModel->countAllResults();
        $courses = $courseModel->findAll();

        $recentActivity = $db->table('users')
            ->select('name, email, role, created_at')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $data = [
            'user' => [
                'id' => session()->get('userID'),
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ],
            'totalUsers' => $totalUsers,
            'totalCourses' => $totalCourses,
            'activeTeachers' => $activeTeachers,
            'activeStudents' => $activeStudents,
            'recentActivity' => $recentActivity,
            'courses' => $courses
        ];

        return view('admin/dashboard', $data);
    }

    public function createCourse()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'You do not have permission to access this page.');
        }

        return view('admin/create_course');
    }

    public function storeCourse()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'You do not have permission to access this page.');
        }

        $courseModel = new CourseModel();

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'instructor_id'  => session()->get('userID'), // Use instructor_id to match DB
        ];

        if ($courseModel->save($data)) {
            return redirect()->to('/admin/dashboard')->with('success', 'Course created successfully.');
        } else {
            return redirect()->back()->withInput()->with('errors', $courseModel->errors());
        }
    }
}