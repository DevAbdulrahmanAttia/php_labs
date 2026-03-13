<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>

<h2>Registration Form</h2>

<form action="done.php" method="POST">

    <div>
        <label>First Name:</label>
        <input type="text" name="first_name" pattern="[A-Za-z]+" title="Only letters allowed" required>
    </div>
    <br>

    <div>
        <label>Last Name:</label>
        <input type="text" name="last_name" pattern="[A-Za-z]+" title="Only letters allowed" required>
    </div>
    <br>

    <div>
        <label>Address:</label><br>
        <textarea name="address" required></textarea>
    </div>
    <br>

    <div>
        <label>Country:</label>
        <select name="country" required>
            <option value="">Select Country</option>
            <option value="Egypt">Egypt</option>
            <option value="USA">KSA</option>
            <option value="UK">UK</option>
        </select>
    </div>
    <br>

    <div>
        <label>Gender:</label>
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female"> Female
    </div>
    <br>

    <div>
        <p>Skills:</p>

        <input type="checkbox" name="skills[]" value="PHP"> PHP <br>
        <input type="checkbox" name="skills[]" value="MySQL"> MySQL <br>
        <input type="checkbox" name="skills[]" value="J2SE"> J2SE <br>
        <input type="checkbox" name="skills[]" value="PostgreSQL"> PostgreSQL
    </div>
    <br>

    <div>
        <label>Username:</label>
        <input type="text" name="username" required>
    </div>
    <br>

    <div>
        <label>Password:</label>
        <input type="password" name="password" 
               pattern="[a-z0-9_]{8}" 
               title="Password must be exactly 8 characters (a-z,0-9,_)" 
               required>
    </div>
    <br>

    <div>
        <label>Department:</label>
        <input type="text" name="department" value="OpenSource" readonly>
    </div>
    <br>

    <div>
        <label>Code Verification:</label>
        <input type="text" name="code" required>
    </div>
    <br>

    <input type="submit" value="Submit">
    <input type="reset" value="Reset">

</form>

</body>
</html>