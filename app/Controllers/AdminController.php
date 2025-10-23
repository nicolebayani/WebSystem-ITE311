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
        $courseModel = new CourseModel();

        $totalUsers = $db->table('users')->countAllResults();
        $activeTeachers = $db->table('users')->where('role', 'teacher')->countAllResults();
        $activeStudents = $db->table('users')->where('role', 'student')->countAllResults();
        $totalCourses = $courseModel->countAllResults();

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
            'recentActivity' => $recentActivity
        ];

                return view('admin/dashboard', $data);
    }

    public function users()
    {
        return '<h1>Users page under construction.</h1>';
    }

    public function courses()
    {
        return '<h1>Courses page under construction.</h1>';
    }

    public function createCourse()
    {
        return '<h1>Create Course page under construction.</h1>';
    }

    public function storeCourse()
    {
        return '<h1>Store Course page under construction.</h1>';
    }

    public function analytics()
    {
        return '<h1>Analytics page under construction.</h1>';
    }

    public function reports()
    {
        return '<h1>Reports page under construction.</h1>';
    }

    public function settings()
    {
        return '<h1>Settings page under construction.</h1>';
    }

    public function profile()
    {
        return '<h1>Profile page under construction.</h1>';
    }
}