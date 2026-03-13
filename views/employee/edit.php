<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee - Employee Management</title>
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
                <div class="card-header bg-warning">
                    <h4 class="mb-0">Edit Employee</h4>
                </div>
                <div class="card-body">
                    <form action="index.php?route=employee/update" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($employee->id) ?>">

                        <div class="mb-3">
                            <label for="f_name" class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="f_name" name="f_name"
                                   value="<?= htmlspecialchars($employee->firstName) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="l_name" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="l_name" name="l_name"
                                   value="<?= htmlspecialchars($employee->lastName) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="<?= htmlspecialchars($employee->email) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required><?= htmlspecialchars($employee->address) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Profile Image:</label>
                            <?php if ($employee->image): ?>
                                <div class="mb-2">
                                    <img src="uploads/<?= htmlspecialchars($employee->image) ?>"
                                         class="rounded-circle img-thumbnail"
                                         style="width:80px;height:80px;object-fit:cover;"
                                         alt="Current Image">
                                    <small class="text-muted ms-2">Current image</small>
                                </div>
                            <?php endif; ?>
                            <input type="file" class="form-control" id="image" name="image" accept="image/jpeg,image/png">
                            <small class="form-text text-muted">JPG and PNG, max 2MB. Leave blank to keep current image.</small>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">New Password:</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   pattern="[a-z0-9_]{8}"
                                   title="Password must be exactly 8 characters (a-z, 0-9, _)">
                            <small class="form-text text-muted">Must be exactly 8 characters (a-z, 0-9, _). Leave blank to keep current password.</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="index.php?route=employee/list" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
