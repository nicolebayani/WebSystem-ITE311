<?php

namespace App\Controllers;

use App\Models\EnrollmentModel;

class Course extends BaseController
{
    public function enroll()
    {
        // Check if the user is logged in.
        if (!session()->get('isLoggedIn')) {
            return $this->response->setJSON(['success' => false, 'message' => 'You must be logged in to enroll.']);
        }

        // Check user role. Students are not allowed to enroll themselves.
        if (session()->get('role') === 'student') {
            return $this->response->setJSON(['success' => false, 'message' => 'You do not have permission to enroll in courses.']);
        }

        $enrollmentModel = new EnrollmentModel();
        $user_id = session()->get('id');
        $course_id = $this->request->getPost('course_id');

        // Check if the user is already enrolled.
        if ($enrollmentModel->isAlreadyEnrolled($user_id, $course_id)) {
            return $this->response->setJSON(['success' => false, 'message' => 'You are already enrolled in this course.']);
        }

        // If not, insert the new enrollment record.
        $data = [
            'user_id' => $user_id,
            'course_id' => $course_id,
            'enrollment_date' => date('Y-m-d H:i:s')
        ];

        if ($enrollmentModel->enrollUser($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Enrollment successful!']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to enroll.']);
        }
    }
}