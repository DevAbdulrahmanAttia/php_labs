<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4">Registration Form</h2>

                    <form action="done.php" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" pattern="[A-Za-z]+" title="Only letters allowed" required>
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" pattern="[A-Za-z]+" title="Only letters allowed" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="country" class="form-label">Country:</label>
                            <select class="form-select" id="country" name="country" required>
                                <option value="">Select Country</option>
                                <option value="Egypt">Egypt</option>
                                <option value="KSA">KSA</option>
                                <option value="UK">UK</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="gender" value="Male" required>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="female" name="gender" value="Female" required>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Skills:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="php" name="skills[]" value="PHP">
                                <label class="form-check-label" for="php">PHP</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="mysql" name="skills[]" value="MySQL">
                                <label class="form-check-label" for="mysql">MySQL</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="j2se" name="skills[]" value="J2SE">
                                <label class="form-check-label" for="j2se">J2SE</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="postgresql" name="skills[]" value="PostgreSQL">
                                <label class="form-check-label" for="postgresql">PostgreSQL</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" 
                                   pattern="[a-z0-9_]{8}" 
                                   title="Password must be exactly 8 characters (a-z,0-9,_)" 
                                   required>
                            <small class="form-text text-muted">Must be exactly 8 characters (a-z, 0-9, _)</small>
                        </div>

                        <div class="mb-3">
                            <label for="department" class="form-label">Department:</label>
                            <input type="text" class="form-control" id="department" name="department" value="OpenSource" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="code" class="form-label">Code Verification:</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label">Profile Image:</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                            <small class="form-text text-muted">JPG and PNG allowed, max 2MB</small>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>

                    <hr class="my-4">
                    <p class="text-center text-muted">Already have an account?
                        <a href="login.php" class="text-decoration-none">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>