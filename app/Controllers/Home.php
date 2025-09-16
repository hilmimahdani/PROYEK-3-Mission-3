<?php

namespace App\Controllers;

use App\Models\StudentModel;

class Home extends BaseController
{
    public function index()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data = [
            'role'     => session()->get('role'),
            'username' => session()->get('username')
        ];

        // Kalau role student → ambil identitas dari tabel students
        if ($data['role'] === 'student') {
            $studentModel = new StudentModel();
            $student = $studentModel->where('user_id', session()->get('user_id'))->first();
            $data['student'] = $student;
        }

        return view('dashboard', $data);
    }
}

