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
        <input type="text" name="first_name" required>
    </div>
    <br>

    <div>
        <label>Last Name:</label>
        <input type="text" name="last_name" required>
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

        <input type="checkbox" id="php" name="skills[]" value="PHP">
        <label for="php">PHP</label><br>

        <input type="checkbox" id="mysql" name="skills[]" value="MySQL">
        <label for="mysql">MySQL</label><br>

        <input type="checkbox" id="j2se" name="skills[]" value="J2SE">
        <label for="j2se">J2SE</label><br>

        <input type="checkbox" id="postgresql" name="skills[]" value="PostgreSQL">
        <label for="postgresql">PostgreSQL</label>
    </div>
    <br>

    <div>
        <label>Username:</label>
        <input type="text" name="username" required>
    </div>
    <br>

    <div>
        <label>Password:</label>
        <input type="password" name="password" required>
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