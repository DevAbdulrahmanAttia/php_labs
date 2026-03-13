<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employee - Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php?route=employee/list">Employee Management</a>
        <div class="navbar-nav ms-auto">
            <span class="navbar-text me-3">Welcome, <?= htmlspecialchars($username) ?></span>
            <a class="btn btn-outline-light btn-sm" href="index.php?route=auth/logout">Logout</a>
        </div>
    </div>
</nav>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">Employee Details</h4>
                </div>
                <div class="card-body">
                    <?php if ($employee->image): ?>
                        <div class="text-center mb-4">
                            <img src="uploads/<?= htmlspecialchars($employee->image) ?>"
                                 class="rounded-circle img-thumbnail"
                                 style="width:120px;height:120px;object-fit:cover;"
                                 alt="Profile Image">
                        </div>
                    <?php endif; ?>

                    <table class="table table-bordered">
                        <tr><th>ID</th><td><?= htmlspecialchars($employee->id) ?></td></tr>
                        <tr><th>First Name</th><td><?= htmlspecialchars($employee->firstName) ?></td></tr>
                        <tr><th>Last Name</th><td><?= htmlspecialchars($employee->lastName) ?></td></tr>
                        <tr><th>Email</th><td><?= htmlspecialchars($employee->email) ?></td></tr>
                        <tr><th>Address</th><td><?= htmlspecialchars($employee->address) ?></td></tr>
                        <tr><th>Username</th><td><?= htmlspecialchars($employee->username) ?></td></tr>
                    </table>

                    <div class="d-flex gap-2 mt-3">
                        <a href="index.php?route=employee/edit&id=<?= urlencode($employee->id) ?>"
                           class="btn btn-warning">Edit</a>
                        <a href="index.php?route=employee/list" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
