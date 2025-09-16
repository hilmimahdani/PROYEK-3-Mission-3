<?php
namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\EnrollmentModel;

class CourseController extends BaseController
{
    public function index()
    {
        $model = new CourseModel();
        $data['courses'] = $model->findAll();

        return view('courses/index', $data);
    }

    public function detail($id)
    {
        $model = new CourseModel();
        $data['course'] = $model->find($id);

        return view('courses/detail', $data);
    }

    public function enroll($course_id)
    {
        $session = session();
        $user_id = $session->get('user_id');

        if (!$user_id) {
            return redirect()->to('/login');
        }

        $enrollModel = new EnrollmentModel();
        $exists = $enrollModel->where('user_id', $user_id)->where('course_id', $course_id)->first();

        if (!$exists) {
            $enrollModel->save([
                'user_id' => $user_id,
                'course_id' => $course_id
            ]);
            return redirect()->to('/courses')->with('success', 'Berhasil enroll course!');
        } else {
            return redirect()->to('/courses')->with('error', 'Sudah terdaftar di course ini!');
        }
    }

    public function myCourses()
    {
        if (! session()->get('logged_in') || session()->get('role') !== 'student') {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');

        $db = \Config\Database::connect();
        $builder = $db->table('takes'); // kalau sudah rename ke takes, ganti di sini
        $builder->select('courses.id, courses.name, courses.description');
        $builder->join('courses', 'courses.id = takes.course_id');
        $builder->where('takes.user_id', $userId);

        $query = $builder->get();
        $data['courses'] = $query->getResultArray();

        return view('courses/mycourses', $data);
    }


    //CRUD Course - Admin Only

        public function create()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/home');
        }
        return view('courses/create');
    }

    public function store()
    {
        $model = new CourseModel();
        $model->save([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to('/courses')->with('success', 'Course berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/home');
        }

        $model = new CourseModel();
        $data['course'] = $model->find($id);

        return view('courses/edit', $data);
    }

    public function update($id)
    {
        $model = new CourseModel();
        $model->update($id, [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to('/courses')->with('success', 'Course berhasil diperbarui!');
    }

    public function delete($id)
    {
        $model = new CourseModel();
        $model->delete($id);

        return redirect()->to('/courses')->with('success', 'Course berhasil dihapus!');
    }


}
