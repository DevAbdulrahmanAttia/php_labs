<?php

namespace Controllers;

use Core\Controller;
use Core\Session;
use Models\Employee;
use Repositories\EmployeeRepository;

class EmployeeController extends Controller
{
    private EmployeeRepository $repo;

    public function __construct()
    {
        if (!Session::has('user_id')) {
            $this->redirect('index.php?route=auth/login');
        }
        $this->repo = new EmployeeRepository();
    }

    public function index(): void
    {
        $employees = $this->repo->findAll();
        $this->render('employee/list', [
            'employees' => $employees,
            'username'  => Session::get('username'),
        ]);
    }

    public function view(): void
    {
        $id       = (int) ($_GET['id'] ?? 0);
        $employee = $this->repo->findById($id);

        if (!$employee) {
            http_response_code(404);
            echo '<h2>Employee not found.</h2>';
            return;
        }

        $this->render('employee/view', [
            'employee' => $employee,
            'username' => Session::get('username'),
        ]);
    }

    public function edit(): void
    {
        $id       = (int) ($_GET['id'] ?? 0);
        $employee = $this->repo->findById($id);

        if (!$employee) {
            http_response_code(404);
            echo '<h2>Employee not found.</h2>';
            return;
        }

        $this->render('employee/edit', [
            'employee' => $employee,
            'username' => Session::get('username'),
        ]);
    }

    public function update(): void
    {
        $id = (int) ($_POST['id'] ?? 0);

        // Load current record so we can fall back to existing image
        $current = $this->repo->findById($id);
        if (!$current) {
            $this->redirect('index.php?route=employee/list');
        }

        // Handle optional image upload
        $imageName = $current->image;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $finfo    = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($_FILES['image']['tmp_name']);
            $allowed  = ['image/jpeg', 'image/png'];
            $maxSize  = 2 * 1024 * 1024;

            if (in_array($mimeType, $allowed, true) && $_FILES['image']['size'] <= $maxSize) {
                $ext       = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $imageName = uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../uploads/' . $imageName);
            }
        }

        $employee = new Employee(
            id:        $id,
            firstName: trim($_POST['f_name']  ?? ''),
            lastName:  trim($_POST['l_name']  ?? ''),
            email:     trim($_POST['email']   ?? ''),
            address:   trim($_POST['address'] ?? ''),
            image:     $imageName
        );

        $this->repo->update($employee);

        // Handle optional password change
        $newPassword = $_POST['password'] ?? '';
        if ($newPassword !== '') {
            $this->repo->updatePassword($id, password_hash($newPassword, PASSWORD_BCRYPT));
        }

        $this->redirect('index.php?route=employee/list');
    }

    public function delete(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $this->repo->delete($id);
        $this->redirect('index.php?route=employee/list');
    }

    public function create(): void
    {
        $this->render('employee/create', [
            'error'    => '',
            'username' => Session::get('username'),
        ]);
    }

    public function store(): void
    {
        $firstName  = trim($_POST['first_name'] ?? '');
        $lastName   = trim($_POST['last_name']  ?? '');
        $email      = trim($_POST['email']      ?? '');
        $address    = trim($_POST['address']    ?? '');
        $username   = trim($_POST['username']   ?? '');
        $password   = $_POST['password']        ?? '';

        if (!preg_match('/^[a-z0-9_]{8}$/', $password)) {
            $this->render('employee/create', [
                'error'    => 'Password must be exactly 8 characters (a-z, 0-9, _).',
                'username' => Session::get('username'),
            ]);
            return;
        }

        $imageName = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $finfo    = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($_FILES['image']['tmp_name']);
            $allowed  = ['image/jpeg', 'image/png'];
            $maxSize  = 2 * 1024 * 1024;

            if (!in_array($mimeType, $allowed, true)) {
                $this->render('employee/create', [
                    'error'    => 'Only JPG and PNG images are allowed.',
                    'username' => Session::get('username'),
                ]);
                return;
            }

            if ($_FILES['image']['size'] > $maxSize) {
                $this->render('employee/create', [
                    'error'    => 'Image size must be less than 2MB.',
                    'username' => Session::get('username'),
                ]);
                return;
            }

            $ext       = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imageName = uniqid() . '.' . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../uploads/' . $imageName);
        }

        $employee = new Employee(
            firstName: $firstName,
            lastName:  $lastName,
            email:     $email,
            address:   $address,
            username:  $username,
            image:     $imageName
        );

        $this->repo->create($employee, $password);
        $this->redirect('index.php?route=employee/list');
    }
}
