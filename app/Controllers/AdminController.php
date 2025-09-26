<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'You do not have permission to access this page.');
        }

        // Get database connection
        $db = \Config\Database::connect();
        
        // Get total users count
        $totalUsers = $db->table('users')->countAllResults();
        
        // Get active teachers count (users with role 'teacher')
        $activeTeachers = $db->table('users')
            ->where('role', 'teacher')
            ->countAllResults();
        
        // Get active students count (users with role 'student')
        $activeStudents = $db->table('users')
            ->where('role', 'student')
            ->countAllResults();
        
        // Get total courses count (if courses table exists)
        $totalCourses = 0;
        if ($db->tableExists('courses')) {
            $totalCourses = $db->table('courses')->countAllResults();
        }
        
        // Get recent activity (recent user registrations)
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
}
