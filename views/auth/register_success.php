<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful - Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-success">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Registration Successful!</h4>
                </div>
                <div class="card-body p-4">

                    <?php if (!empty($employee->image)): ?>
                        <div class="text-center mb-3">
                            <img src="uploads/<?= htmlspecialchars($employee->image) ?>"
                                 class="rounded-circle img-thumbnail"
                                 style="width:120px;height:120px;object-fit:cover;"
                                 alt="Profile Image">
                        </div>
                    <?php endif; ?>

                    <table class="table table-bordered">
                        <tr>
                            <th>Title</th>
                            <td><?= htmlspecialchars($title) ?></td>
                        </tr>
                        <tr>
                            <th>First Name</th>
                            <td><?= htmlspecialchars($employee->firstName) ?></td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td><?= htmlspecialchars($employee->lastName) ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= htmlspecialchars($employee->email) ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?= htmlspecialchars($employee->address) ?></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><?= htmlspecialchars($employee->username) ?></td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td><?= htmlspecialchars($country) ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?= htmlspecialchars($gender) ?></td>
                        </tr>
                        <tr>
                            <th>Skills</th>
                            <td><?= htmlspecialchars(implode(', ', $skills)) ?></td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td><?= htmlspecialchars($department) ?></td>
                        </tr>
                    </table>

                    <div class="d-grid gap-2 mt-3">
                        <a href="index.php?route=auth/login" class="btn btn-primary">Go to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
