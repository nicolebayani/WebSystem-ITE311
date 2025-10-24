<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;

class TeacherController extends BaseController
{
    protected $courseModel;
    protected $enrollmentModel;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->enrollmentModel = new EnrollmentModel();
    }

    public function dashboard()
    {
        // Check if user is logged in and has teacher role
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'teacher') {
            session()->setFlashdata('error', 'You do not have permission to access this page.');
            return redirect()->to('/login');
        }

        $teacherId = session()->get('userID');
        
        // Get teacher's courses
        $courses = $this->courseModel->where('instructor_id', $teacherId)->findAll();

        // Attach number of enrolled students per course (default 0)
        $courseIds = array_map(function ($c) { return $c['id']; }, $courses);
        $studentCounts = [];
        if (!empty($courseIds)) {
            $studentCounts = $this->enrollmentModel->countStudentsByCourseIds($courseIds);
        }

        foreach ($courses as &$course) {
            $course['students'] = $studentCounts[$course['id']] ?? 0;
        }
        unset($course);

        // Prepare data for teacher dashboard
        $data = [
            'user' => [
                'id' => session()->get('userID'),
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ],
            'courses' => $courses,
            'notifications' => [],
            'recent_activity' => []
        ];

        return view('teacher/dashboard', $data);
    }

    public function createCourse()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'teacher') {
            return redirect()->to('/login')->with('error', 'You do not have permission to access this page.');
        }

        return view('teacher/create_course');
    }

    /**
     * Show course details including enrolled students.
     * @param int $id Course ID
     */
    public function courseDetails($id = null)
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'teacher') {
            return redirect()->to('/login')->with('error', 'You do not have permission to access this page.');
        }

        $teacherId = session()->get('userID');

        // Ensure the course belongs to this teacher
        $course = $this->courseModel->where('id', $id)->where('instructor_id', $teacherId)->first();
        if (!$course) {
            return redirect()->to('/teacher/dashboard')->with('error', 'Course not found or access denied.');
        }

        // Get enrolled students for this course (join users)
        $enrollmentModel = $this->enrollmentModel;
        $students = $enrollmentModel->select('users.id, users.name, users.email, enrollments.enrollment_date')
                                    ->join('users', 'users.id = enrollments.user_id')
                                    ->where('enrollments.course_id', $id)
                                    ->where('enrollments.status', 'enrolled')
                                    ->orderBy('enrollments.enrollment_date', 'DESC')
                                    ->findAll();
        $data = [
            'user' => [
                'id' => session()->get('userID'),
                'name' => session()->get('name'),
            ],
            'course' => $course,
            'students' => $students,
        ];

        return view('teacher/course_details', $data);
    }

    /**
     * Unenroll a student from a course (POST).
     * Expects 'user_id' in POST data.
     * @param int $courseId
     */
    public function unenrollStudent($courseId = null)
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->back();
        }

        if (!session()->get('isLoggedIn') || session()->get('role') !== 'teacher') {
            return redirect()->to('/login')->with('error', 'You do not have permission to perform this action.');
        }

        $teacherId = session()->get('userID');

        // Ensure the course belongs to this teacher
        $course = $this->courseModel->where('id', $courseId)->where('instructor_id', $teacherId)->first();
        if (!$course) {
            return redirect()->to('/teacher/dashboard')->with('error', 'Course not found or access denied.');
        }

        $userId = (int) $this->request->getPost('user_id');
        if (empty($userId)) {
            return redirect()->back()->with('error', 'Invalid student selected.');
        }

        $removed = $this->enrollmentModel->removeEnrollment($courseId, $userId);
        if ($removed) {
            return redirect()->to('/teacher/course/' . $courseId)->with('success', 'Student has been unenrolled.');
        }

        return redirect()->back()->with('error', 'Failed to unenroll student.');
    }

    public function courses()
    {
        return '<h1>Courses page under construction.</h1>';
    }

    public function students()
    {
        return '<h1>Students page under construction.</h1>';
    }

    public function assignments()
    {
        return '<h1>Assignments page under construction.</h1>';
    }

    public function gradebook()
    {
        return '<h1>Gradebook page under construction.</h1>';
    }

    public function announcements()
    {
        return '<h1>Announcements page under construction.</h1>';
    }

    public function analytics()
    {
        return '<h1>Analytics page under construction.</h1>';
    }

    public function profile()
    {
        return '<h1>Profile page under construction.</h1>';
    }

    public function storeCourse()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'teacher') {
            return redirect()->to('/login')->with('error', 'You do not have permission to access this page.');
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'instructor_id' => session()->get('userID')
        ];

        if ($this->courseModel->save($data)) {
            return redirect()->to('/teacher/dashboard')->with('success', 'Course created successfully.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->courseModel->errors());
        }
    }
}
