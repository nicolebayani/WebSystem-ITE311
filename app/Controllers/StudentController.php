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
        $user_id = session()->get('userID');

        $enrolled_courses = $enrollmentModel->getUserEnrollments($user_id);
        $all_courses = $courseModel->findAll();

        $enrolled_course_ids = array_map(function($course) { return $course['id']; }, $enrolled_courses);

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
            'upcoming_deadlines' => [],
            'recent_grades' => [],
            'notifications' => []
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
        $user_id = session()->get('userID');

        // Get courses the student is enrolled in, including course description and instructor name
        // We'll join courses -> enrollments -> users (instructor)
        $builder = $enrollmentModel->select('courses.id as id, courses.title, courses.description, courses.instructor_id, users.name as instructor_name')
                               ->join('courses', 'courses.id = enrollments.course_id')
                               ->join('users', 'users.id = courses.instructor_id', 'left')
                               ->where('enrollments.user_id', $user_id)
                               ->where('enrollments.status', 'enrolled');

        $enrolled_with_instructor = $builder->findAll();

        // Also compute available courses (courses the student is not enrolled in)
        $all_courses = $courseModel->findAll();
        $enrolled_course_ids = array_map(function($course) { return $course['id']; }, $enrolled_with_instructor);

        $available_courses = array_filter($all_courses, function($course) use ($enrolled_course_ids) {
            return !in_array($course['id'], $enrolled_course_ids);
        });

        $data = [
            'user' => [
                'id' => $user_id,
                'name' => session()->get('name'),
            ],
            'available_courses' => $available_courses,
            'enrolled_courses' => $enrolled_with_instructor,
        ];

        return view('student/courses', $data);
    }

    /**
     * Handle course enrollment
     */
    public function enroll()
    {
        log_message('info', 'Enrollment request received');
        
        try {
            // Check if user is logged in and has student role
            if (!session()->get('isLoggedIn') || session()->get('role') !== 'student') {
                $message = 'You must be logged in as a student to enroll in courses.';
                log_message('error', 'Unauthorized enrollment attempt - User not logged in or not a student');
                return $this->response->setJSON([
                    'success' => false,
                    'message' => $message
                ])->setStatusCode(401);
            }

            $course_id = $this->request->getPost('course_id');
            $user_id = session()->get('userID');
            
            log_message('debug', 'Enrollment attempt - User ID: ' . $user_id . ', Course ID: ' . $course_id);

            if (empty($course_id)) {
                $message = 'Course ID is required.';
                log_message('error', 'Enrollment failed - ' . $message);
                return $this->response->setJSON([
                    'success' => false,
                    'message' => $message
                ])->setStatusCode(400);
            }

            $db = \Config\Database::connect();
            $enrollmentModel = new EnrollmentModel();
            
            // Check if already enrolled
            if ($enrollmentModel->isAlreadyEnrolled($user_id, $course_id)) {
                $message = 'You are already enrolled in this course.';
                log_message('info', 'Enrollment failed - ' . $message . ' (User: ' . $user_id . ', Course: ' . $course_id . ')');
                return $this->response->setJSON([
                    'success' => false,
                    'message' => $message
                ]);
            }

            // Get course details
            $courseModel = new CourseModel();
            $course = $courseModel->find($course_id);
            if (!$course) {
                $message = 'Invalid course.';
                log_message('error', 'Enrollment failed - ' . $message . ' (Course ID: ' . $course_id . ')');
                return $this->response->setJSON([
                    'success' => false,
                    'message' => $message
                ])->setStatusCode(404);
            }

            // Start transaction
            $db->transStart();

            try {
                // Enroll the student
                // Note: some environments may have an older enrollments table without
                // the `enrollment_date` column. To be defensive, don't include the
                // field in the insert payload so the query won't fail in that case.
                $enrollmentData = [
                    'user_id' => $user_id,
                    'course_id' => $course_id,
                    'status' => 'enrolled'
                ];

                log_message('debug', 'Prepared enrollment data (without enrollment_date) for insert');

                // Use the model's insert method directly
                $enrollmentId = $enrollmentModel->insert($enrollmentData);
                
                if ($enrollmentId) {
                    $db->transCommit();
                    log_message('info', 'Successfully enrolled user ' . $user_id . ' in course ' . $course_id);
                    return $this->response->setJSON([
                        'success' => true,
                        'message' => 'Successfully enrolled in ' . $course['title'],
                        'course' => [
                            'id' => $course_id,
                            'title' => $course['title']
                        ]
                    ]);
                } else {
                    throw new \Exception('Failed to insert enrollment record');
                }
            } catch (\Exception $e) {
                $db->transRollback();
                throw $e;
            }
            
        } catch (\Exception $e) {
            log_message('error', 'Error in enroll(): ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'An error occurred while processing your request: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    public function search_courses()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405, 'Method Not Allowed');
        }

        $query = $this->request->getPost('query');
        $userId = session()->get('userID');

        if (empty($query)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Search term is required.']);
        }

        $courseModel = new CourseModel();
        $enrollmentModel = new EnrollmentModel();

        // Get IDs of courses the user is already enrolled in
        $enrolled_course_ids = $enrollmentModel->where('user_id', $userId)->findColumn('course_id') ?? [];

        // Find courses that match the query and are not already enrolled
        $builder = $courseModel->like('title', $query);
        if (!empty($enrolled_course_ids)) {
            $builder->whereNotIn('id', $enrolled_course_ids);
        }
        $courses = $builder->findAll();

        return $this->response->setJSON(['success' => true, 'courses' => $courses]);
    }
}