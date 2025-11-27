<?php

namespace App\Controllers;

use App\Models\NotificationModel;
use CodeIgniter\Controller;

class Notifications extends Controller
{
    protected $notificationModel;

    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
    }

    /**
     * Get unread notification count and list for the current user.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function get()
    {
        if (!session()->get('isLoggedIn')) {
            return $this->response->setStatusCode(401, 'Unauthorized');
        }

        $userId = session()->get('id');
        $unreadCount = $this->notificationModel->getUnreadCount($userId);
        $notifications = $this->notificationModel->getNotificationsForUser($userId);

        return $this->response->setJSON([
            'unreadCount' => $unreadCount,
            'notifications' => $notifications,
        ]);
    }

    /**
     * Mark a notification as read.
     *
     * @param int $id
     * @return \CodeIgniter\HTTP\Response
     */
    public function mark_as_read($id)
    {
        if (!session()->get('isLoggedIn')) {
            return $this->response->setStatusCode(401, 'Unauthorized');
        }

        $notification = $this->notificationModel->find($id);

        if (!$notification || $notification['user_id'] != session()->get('id')) {
            return $this->response->setStatusCode(403, 'Forbidden');
        }

        if ($this->notificationModel->markAsRead($id)) {
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false], 500);
    }
}