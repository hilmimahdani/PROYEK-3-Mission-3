<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\StudentModel;

class StudentController extends BaseController
{
    public function index()
    {
        if (! session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $builder = $db->table('students');
        $builder->select('students.nim, students.full_name, students.age, students.entry_year, users.username, users.email');
        $builder->join('users', 'users.id = students.user_id');
        $data['students'] = $builder->get()->getResultArray();

        return view('students/index', $data);
    }
}

