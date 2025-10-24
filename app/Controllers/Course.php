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
        $materialModel = new MaterialModel();
        $data['course_id'] = $course_id;

        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('material');

            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(WRITEPATH . 'uploads', $newName);

                $materialData = [
                    'course_id' => $course_id,
                    'file_name' => $file->getClientName(),
                    'file_path' => $newName,
                ];

                $materialModel->insertMaterial($materialData);

                return redirect()->back()->with('success', 'File uploaded successfully.');
            }

            return redirect()->back()->with('error', 'File upload failed.');
        }

        return view('materials/upload', $data);
    }

    public function delete($material_id)
    {
        $materialModel = new MaterialModel();
        $material = $materialModel->find($material_id);

        if ($material) {
            $filePath = WRITEPATH . 'uploads/' . $material['file_path'];
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

        $filePath = WRITEPATH . 'uploads/' . $material['file_path'];

        if (file_exists($filePath)) {
            return $this->response->download($filePath, null)->setFileName($material['file_name']);
        }

        return redirect()->back()->with('error', 'File not found on server.');
    }
}