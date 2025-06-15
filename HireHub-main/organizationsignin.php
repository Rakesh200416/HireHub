<?php
$host = "localhost"; // Database host
$username = "root"; // Database username
$password = "MdR@2004"; // Database password
$dbname = "job_portal"; // Database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$successMsg = "";
$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $designation = $_POST["designation"];
    $organization = $_POST["organization"];

    // Hash the password using password_hash()
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert data into the 'employer1' table
    $query = "INSERT INTO employer1 (name, email, password, designation, organization) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $name, $email, $hashedPassword, $designation, $organization);

    if ($stmt->execute()) {
        $successMsg = "Registration successful!";
        // Redirect to the Jobposting page after successful registration
        header("Location: Jobposting.php"); 
        exit; // Make sure no further code is executed after the redirection
    } else {
        $errorMsg = "Error: " . $stmt->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer/Recruiter Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .container h2 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 12px;
        }

        .success {
            color: green;
            font-size: 12px;
        }
    </style>
    <script>
        function validateForm() {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirm_password").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Employer/Recruiter Registration</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm();">
        <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" 
            value="<?php echo isset($name) ? htmlspecialchars($name, ENT_QUOTES, 'UTF-8') : ''; ?>" 
            pattern="[A-Za-z\s]+" 
            title="Name should contain only alphabets and spaces." 
            required>
        </div>


        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>

        <div class="form-group">
            <label for="designation">Designation:</label>
            <input type="text" id="designation" name="designation" value="<?php echo isset($designation) ? $designation : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="organization">Organization:</label>
            <input type="text" id="organization" name="organization" value="<?php echo isset($organization) ? $organization : ''; ?>" required>
        </div>

        <div class="form-group">
            <input type="submit" value="Register">
        </div>
    </form>

    <?php if ($successMsg): ?>
        <div class="success"><?php echo $successMsg; ?></div>
    <?php elseif ($errorMsg): ?>
        <div class="error"><?php echo $errorMsg; ?></div>
    <?php endif; ?>
</div>

</body>
</html>

