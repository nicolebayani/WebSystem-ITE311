<?php

namespace App\Controllers;

use App\Models\Material;
use App\Models\EnrollmentModel;

class Materials extends BaseController
{
    public function test($course_id)
    {
        // Simple test to verify database connection
        try {
            $materialModel = new Material();
            $testData = [
                'course_id' => $course_id,
                'file_name' => 'test.pdf',
                'file_path' => 'test123.pdf'
            ];
            
            $result = $materialModel->insert($testData);
            
            if ($result) {
                echo "Database test successful! Record inserted with ID: " . $result;
                // Clean up test data
                $materialModel->where('file_name', 'test.pdf')->delete();
                echo "<br>Test data cleaned up.";
            } else {
                echo "Database test failed!";
            }
        } catch (Exception $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function upload($course_id)
    {
        helper(['form', 'url']);
        $data['course_id'] = $course_id;

        if ($this->request->getMethod() === 'post') {
            // Debug: Log that we received a POST request
            log_message('debug', 'POST request received for upload');
            log_message('debug', 'POST data: ' . json_encode($this->request->getPost()));
            log_message('debug', 'Files: ' . json_encode($this->request->getFiles()));
            
            // Check if file was uploaded
            $file = $this->request->getFile('material');
            if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
                session()->setFlashdata('error', 'No file uploaded or upload error: ' . ($file ? $file->getErrorString() : 'No file'));
                return view('materials/upload', $data);
            }
            
            $rules = [
                'material' => 'uploaded[material]|max_size[material,10240]|ext_in[material,pdf,ppt,pptx,doc,docx]',
            ];

            if ($this->validate($rules)) {
                log_message('debug', 'Validation passed');

                if ($file->isValid() && !$file->hasMoved()) {
                    // Ensure the upload directory exists
                    $uploadPath = WRITEPATH . 'uploads/materials/';
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }

                    $newName = $file->getRandomName();
                    if ($file->move($uploadPath, $newName)) {
                        try {
                            $materialModel = new Material();
                            $insertData = [
                                'course_id' => $course_id,
                                'file_name' => $file->getClientName(),
                                'file_path' => $newName,
                            ];
                            log_message('debug', 'Attempting to insert material: ' . json_encode($insertData));
                            
                            $result = $materialModel->insert($insertData);
                            log_message('debug', 'Database insert result: ' . ($result ? 'success' : 'failed'));

                            if ($result) {
                                session()->setFlashdata('success', 'File uploaded successfully.');
                                return redirect()->to('/teacher/course/' . $course_id);
                            } else {
                                session()->setFlashdata('error', 'Failed to save material to database.');
                            }
                        } catch (Exception $e) {
                            log_message('error', 'Database error: ' . $e->getMessage());
                            session()->setFlashdata('error', 'Database error: ' . $e->getMessage());
                        }
                    } else {
                        session()->setFlashdata('error', 'Failed to move uploaded file.');
                    }
                } else {
                    session()->setFlashdata('error', 'File upload failed: ' . $file->getErrorString());
                }
            } else {
                log_message('debug', 'Validation failed: ' . json_encode($this->validator->getErrors()));
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', 'Validation failed. Please check your file.');
            }
        }

        return view('materials/upload', $data);
    }

    public function delete($material_id)
    {
        $materialModel = new Material();
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

        $materialModel = new Material();
        $material = $materialModel->find($material_id);

        if (!$material) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $enrollmentModel = new EnrollmentModel();
        $user_id = session()->get('userID');

        if (session()->get('role') === 'student' && !$enrollmentModel->isEnrolled($user_id, $material['course_id'])) {
            return redirect()->to('/student/courses')->with('error', 'You are not enrolled in this course.');
        }

        $filePath = WRITEPATH . 'uploads/materials/' . $material['file_path'];

        if (file_exists($filePath)) {
            return $this->response->download($filePath, null)->setFileName($material['file_name']);
        }

        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('File not found.');
    }
}