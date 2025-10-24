<?php

namespace App\Controllers;

use App\Models\EnrollmentModel;
use App\Models\MaterialModel;

class Course extends BaseController
{
    protected $helpers = ['form', 'url'];

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

    public function upload($course_id)
    {
        // Check if user is a teacher
        if (session()->get('role') !== 'teacher') {
            return redirect()->back()->with('error', 'You do not have permission to upload materials.');
        }
        
        $materialModel = new MaterialModel();

        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('material');

            if ($file->isValid() && !$file->hasMoved()) {
                // Ensure the upload directory exists
                $uploadPath = WRITEPATH . 'uploads/materials/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $newName = $file->getRandomName();
                if ($file->move($uploadPath, $newName)) {
                    $materialData = [
                        'course_id' => $course_id,
                        'file_name' => $file->getClientName(),
                        'file_path' => $newName,
                    ];

                    if ($materialModel->insertMaterial($materialData)) {
                        return redirect()->to('teacher/course/' . $course_id)->with('success', 'File uploaded successfully.');
                    } else {
                        return redirect()->to('teacher/course/' . $course_id)->with('error', 'Failed to save material to database.');
                    }
                } else {
                    return redirect()->to('teacher/course/' . $course_id)->with('error', 'Failed to move uploaded file.');
                }
            }

            return redirect()->to('teacher/course/' . $course_id)->with('error', 'File upload failed.');
        }

        // If GET request, redirect to course details page
        return redirect()->to('teacher/course/' . $course_id);
    }

    public function delete($material_id)
    {
        $materialModel = new MaterialModel();
        $material = $materialModel->find($material_id);

        if ($material) {
            $filePath = WRITEPATH . 'uploads/materials/' . $material['file_path'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $materialModel->delete($material_id);
            return redirect()->back()->with('success', 'Material deleted successfully.');
        }

        return redirect()->back()->with('error', 'Material not found.');
    }

    public function download($material_id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'You must be logged in to download materials.');
        }

        $materialModel = new MaterialModel();
        $material = $materialModel->find($material_id);

        if (!$material) {
            return redirect()->back()->with('error', 'File not found.');
        }

        $user_id = session()->get('id');
        $role = session()->get('role');

        if ($role !== 'teacher') { // Teachers have universal access
            $enrollmentModel = new EnrollmentModel();
            if (!$enrollmentModel->isAlreadyEnrolled($user_id, $material['course_id'])) {
                return redirect()->back()->with('error', 'You are not authorized to download this file.');
            }
        }

        $filePath = WRITEPATH . 'uploads/materials/' . $material['file_path'];

        if (file_exists($filePath)) {
            return $this->response->download($filePath, null)->setFileName($material['file_name']);
        }

        return redirect()->back()->with('error', 'File not found on server.');
    }
}