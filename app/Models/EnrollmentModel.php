<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table            = 'enrollments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'course_id', 'enrollment_date', 'status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Insert a new enrollment record.
     * @param array $data
     * @return mixed
     */
    public function enrollUser($data)
    {
        return $this->insert($data);
    }

    /**
     * Fetch all courses a user is enrolled in.
     * @param int $user_id
     * @return array
     */
    public function getUserEnrollments($user_id)
    {
        return $this->select('courses.*')
                    ->join('courses', 'courses.id = enrollments.course_id')
                    ->where('enrollments.user_id', $user_id)
                    ->findAll();
    }

    /**
     * Check if a user is already enrolled in a specific course.
     * @param int $user_id
     * @param int $course_id
     * @return bool
     */
    public function isAlreadyEnrolled($user_id, $course_id)
    {
        return $this->where('user_id', $user_id)
                   ->where('course_id', $course_id)
                   ->countAllResults() > 0;
    }

    /**
     * Count enrolled students for given course IDs.
     * Returns an associative array keyed by course_id => student_count
     * If $courseIds is empty, returns counts for all courses.
     *
     * @param array $courseIds
     * @return array
     */
    public function countStudentsByCourseIds(array $courseIds = [])
    {
        $builder = $this->select('course_id, COUNT(*) AS students')
                        ->where('status', 'enrolled')
                        ->groupBy('course_id');

        if (!empty($courseIds)) {
            $builder->whereIn('course_id', $courseIds);
        }

        $rows = $builder->findAll();

        $result = [];
        foreach ($rows as $row) {
            $result[$row['course_id']] = (int) $row['students'];
        }

        return $result;
    }

    /**
     * Remove an enrollment record for a user in a course.
     * @param int $courseId
     * @param int $userId
     * @return bool
     */
    public function removeEnrollment(int $courseId, int $userId): bool
    {
        return (bool) $this->where('course_id', $courseId)
                           ->where('user_id', $userId)
                           ->delete();
    }
}