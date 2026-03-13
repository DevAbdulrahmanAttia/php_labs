<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List - Employee Management</title>
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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Employee List</h2>
        <a href="index.php?route=employee/create" class="btn btn-success">Add New Employee</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($employees)): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No employees found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($employees as $emp): ?>
                            <tr>
                                <td><?= htmlspecialchars($emp->id) ?></td>
                                <td>
                                    <?php if ($emp->image): ?>
                                        <img src="uploads/<?= htmlspecialchars($emp->image) ?>"
                                             style="width:45px;height:45px;object-fit:cover;"
                                             class="rounded-circle" alt="Profile">
                                    <?php else: ?>
                                        <span class="badge bg-secondary">No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($emp->firstName) ?></td>
                                <td><?= htmlspecialchars($emp->lastName) ?></td>
                                <td><?= htmlspecialchars($emp->email) ?></td>
                                <td><?= htmlspecialchars($emp->address) ?></td>
                                <td>
                                    <a href="index.php?route=employee/view&id=<?= urlencode($emp->id) ?>"
                                       class="btn btn-sm btn-info">View</a>
                                    <a href="index.php?route=employee/edit&id=<?= urlencode($emp->id) ?>"
                                       class="btn btn-sm btn-warning">Edit</a>
                                    <a href="index.php?route=employee/delete&id=<?= urlencode($emp->id) ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
