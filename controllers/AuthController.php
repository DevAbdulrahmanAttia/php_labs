<?php

namespace Controllers;

use Core\Controller;
use Core\Session;
use Models\Employee;
use Repositories\EmployeeRepository;

class AuthController extends Controller
{
    private EmployeeRepository $repo;

    public function __construct()
    {
        $this->repo = new EmployeeRepository();
    }

    public function login(): void
    {
        if (Session::has('user_id')) {
            $this->redirect('index.php?route=employee/list');
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            $row = $this->repo->findByUsername($username);

            if ($row && password_verify($password, $row['password'])) {
                Session::regenerate();
                Session::set('user_id', $row['id']);
                Session::set('username', $row['username']);
                $this->redirect('index.php?route=employee/list');
            } else {
                $error = 'Invalid username or password.';
            }
        }

        $this->render('auth/login', ['error' => $error]);
    }

    public function logout(): void
    {
        Session::destroy();
        $this->redirect('index.php?route=auth/login');
    }

    public function register(): void
    {
        if (Session::has('user_id')) {
            $this->redirect('index.php?route=employee/list');
        }

        $this->render('auth/register', ['error' => '']);
    }

    public function store(): void
    {
        $firstName  = trim($_POST['first_name'] ?? '');
        $lastName   = trim($_POST['last_name']  ?? '');
        $email      = trim($_POST['email']       ?? '');
        $address    = trim($_POST['address']     ?? '');
        $country    = $_POST['country']    ?? '';
        $gender     = $_POST['gender']     ?? '';
        $skills     = $_POST['skills']     ?? [];
        $department = $_POST['department'] ?? 'OpenSource';
        $username   = trim($_POST['username']    ?? '');
        $password   = $_POST['password']   ?? '';

        // Validate password
        if (!preg_match('/^[a-z0-9_]{8}$/', $password)) {
            $this->render('auth/register', ['error' => 'Password must be exactly 8 characters (a-z, 0-9, _).']);
            return;
        }

        // Handle image upload
        $imageName = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $finfo    = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($_FILES['image']['tmp_name']);
            $allowed  = ['image/jpeg', 'image/png'];
            $maxSize  = 2 * 1024 * 1024;

            if (!in_array($mimeType, $allowed, true)) {
                $this->render('auth/register', ['error' => 'Only JPG and PNG images are allowed.']);
                return;
            }

            if ($_FILES['image']['size'] > $maxSize) {
                $this->render('auth/register', ['error' => 'Image size must be less than 2MB.']);
                return;
            }

            $ext       = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imageName = uniqid() . '.' . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../uploads/' . $imageName);
        }

        $title = ($gender === 'Male') ? 'Mr' : 'Miss';

        $employee = new Employee(
            firstName: $firstName,
            lastName:  $lastName,
            email:     $email,
            address:   $address,
            username:  $username,
            image:     $imageName
        );

        $this->repo->create($employee, $password);

        $this->render('auth/register_success', [
            'employee'   => $employee,
            'title'      => $title,
            'country'    => $country,
            'gender'     => $gender,
            'skills'     => $skills,
            'department' => $department,
        ]);
    }
}
