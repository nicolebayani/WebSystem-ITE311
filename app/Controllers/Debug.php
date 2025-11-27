<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Debug extends BaseController
{
    public function session()
    {
        $data = [
            'isLoggedIn' => session()->get('isLoggedIn'),
            'userID' => session()->get('userID'),
            'role' => session()->get('role'),
            'name' => session()->get('name'),
            'email' => session()->get('email'),
            'all_session' => session()->get()
        ];
        
        return $this->response->setJSON($data);
    }
    
    public function notifications()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn') || !session()->get('userID')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User not authenticated',
                'debug' => [
                    'isLoggedIn' => session()->get('isLoggedIn'),
                    'userID' => session()->get('userID'),
                    'role' => session()->get('role')
                ]
            ])->setStatusCode(401);
        }

        $userId = session()->get('userID');
        
        try {
            $notificationModel = new \App\Models\NotificationModel();
            $unreadCount = $notificationModel->getUnreadCount($userId);
            $notifications = $notificationModel->getNotificationsForUser($userId, 10);
            
            return $this->response->setJSON([
                'success' => true,
                'unread_count' => $unreadCount,
                'notifications' => $notifications,
                'debug' => [
                    'userId' => $userId,
                    'unreadCount' => $unreadCount,
                    'notificationsCount' => count($notifications)
                ]
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error fetching notifications: ' . $e->getMessage(),
                'debug' => [
                    'userId' => $userId,
                    'error' => $e->getMessage()
                ]
            ])->setStatusCode(500);
        }
    }
}
