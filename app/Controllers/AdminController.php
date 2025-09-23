<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function index()
    {
        
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            
            return redirect()->to('/login')->with('error', 'You do not have permission to access this page.');
        }

        $data = [
            'user' => [
                'name' => session()->get('name'),
            ]
        ];

        return view('admin/dashboard', $data);
    }
}
