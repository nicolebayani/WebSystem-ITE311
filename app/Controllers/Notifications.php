<?php

namespace App\Controllers;

use App\Models\NotificationModel;
use CodeIgniter\HTTP\ResponseInterface;

class Notifications extends BaseController
{
    protected $notificationModel;

    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
    }

    // Get notifications for the logged-in user
    public function get()
    {
        $userId = session()->get('userID');
        $isLoggedIn = session()->get('isLoggedIn');
        
        // Log debug information
        log_message('debug', 'Notifications::get - UserID: ' . $userId . ', IsLoggedIn: ' . ($isLoggedIn ? 'true' : 'false'));
        
        if (!$userId || !$isLoggedIn) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User not authenticated',
                'debug' => [
                    'userID' => $userId,
                    'isLoggedIn' => $isLoggedIn
                ]
            ])->setStatusCode(401);
        }

        try {
            $unreadCount = $this->notificationModel->getUnreadCount($userId);
            $notifications = $this->notificationModel->getNotificationsForUser($userId, 10);

            // Normalize notifications so the front-end always receives predictable fields
            $normalized = [];
            foreach ($notifications as $n) {
                $normalized[] = [
                    'id' => isset($n['id']) ? (int) $n['id'] : null,
                    'message' => isset($n['message']) ? $n['message'] : '',
                    // Ensure is_read is numeric 0/1
                    'is_read' => isset($n['is_read']) ? (int) $n['is_read'] : 0,
                    // Convert created_at to ISO 8601 which JS Date() reliably parses
                    'created_at' => isset($n['created_at']) && $n['created_at'] ? date('c', strtotime($n['created_at'])) : date('c')
                ];
            }

            log_message('debug', 'Notifications::get - UnreadCount: ' . $unreadCount . ', NotificationsCount: ' . count($normalized));

            return $this->response->setJSON([
                'success' => true,
                'unread_count' => $unreadCount,
                'notifications' => $normalized
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Notifications::get - Error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error fetching notifications: ' . $e->getMessage(),
                'debug' => [
                    'userId' => $userId,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]
            ])->setStatusCode(500);
        }
    }

    // Mark a single notification as read
    public function mark_as_read($id)
    {
        $userId = session()->get('userID');
        if (!$userId || !session()->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User not authenticated'
            ])->setStatusCode(401);
        }

        try {
            $notification = $this->notificationModel->find($id);

            if (!$notification || $notification['user_id'] != $userId) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Notification not found or access denied'
                ])->setStatusCode(404);
            }

            $this->notificationModel->markAsRead($id);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Notification marked as read'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error updating notification: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    // Mark all notifications as read
    public function mark_all_read()
    {
        $userId = session()->get('userID');
        if (!$userId || !session()->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User not authenticated'
            ])->setStatusCode(401);
        }

        try {
            $this->notificationModel->markAllAsRead($userId);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'All notifications marked as read'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error updating notifications: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}
