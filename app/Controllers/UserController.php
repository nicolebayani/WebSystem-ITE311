<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please login to view your dashboard.');
        }

        $data = [
            'user' => [
                'name' => session()->get('name'),
            ]
        ];

        return view('user/dashboard', $data);
    }
}
