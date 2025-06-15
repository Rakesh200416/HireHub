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

// Handle form submission
if (isset($_POST['submit'])) {
    // Collect form data
    $name = $_POST['name'];
    $age = $_POST['age'];
    $qualification = $_POST['qualification'];
    $domain = $_POST['domain'];
    $address = $_POST['address'];
    $experience = $_POST['experience'];
    $courses = $_POST['courses'];
    $company_name = $_POST['company_name'];

    // Insert data into the database
    $sql = "INSERT INTO resume1 (name, age, qualification, domain, address, experience, courses_undergone, company_name) 
            VALUES ('$name', '$age', '$qualification', '$domain', '$address', '$experience', '$courses', '$company_name')";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            color: #fff;
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .navbar .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .navbar .nav-links {
            display: flex;
            gap: 15px;
        }

        .navbar .nav-links a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            text-align: center;
        }

        .navbar .nav-links a:hover {
            background-color: #575757;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        textarea {
            height: 100px;
        }

        .button-container {
            text-align: center;
        }

        .button-container input {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button-container input:hover {
            background-color: #45a049;
        }

        .button-container input[type="button"] {
            background-color: #f44336;
        }

        .button-container input[type="button"]:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="index.php" class="logo">
        <img src="job-img.jpg" alt="HireHub Logo">
        HireHub
    </a>
    <div class="nav-links">
        <a href="aboutUs.php">About Us</a>
        <a href="ContactUs.php">Contact Us</a>
        <a href="profile.php">My Profile</a>
        <a href="userlogout.php">Log Out</a>
    </div>
</div>

<div class="container">
    <h2>Resume Form</h2>
    <form method="POST" action="resume.php">
        <!-- Name -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <!-- Age -->
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
        </div>

        <!-- Qualification -->
        <div class="form-group">
            <label for="qualification">Qualification:</label>
            <input type="text" id="qualification" name="qualification" required>
        </div>

        <!-- Domain -->
        <div class="form-group">
            <label for="domain">Domain:</label>
            <select id="domain" name="domain" required>
                <option value="Web">Web</option>
                <option value="AIMl">AI/ML</option>
                <option value="Data Analytics">Data Analytics</option>
                <option value="Cyber Security">Cyber Security</option>
                <option value="Java Developer">Java Developer</option>
                <option value="Python based">Python based</option>
                <option value="AI">AI</option>
            </select>
        </div>

        <!-- Company Name -->
        <div class="form-group">
            <label for="company_name">Company Name:</label>
            <input type="text" id="company_name" name="company_name" required>
        </div>

        <!-- Address -->
        <div class="form-group">
            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>
        </div>

        <!-- Experience -->
        <div class="form-group">
            <label for="experience">Experience (in years):</label>
            <input type="number" id="experience" name="experience" required>
        </div>

        <!-- Courses undergone -->
        <div class="form-group">
            <label for="courses">Courses Underwent:</label>
            <textarea id="courses" name="courses" required></textarea>
        </div>

        <!-- Submit and Reset Buttons -->
        <div class="button-container">
            <input type="submit" name="submit" value="Submit">
            <input type="button" value="Edit" onclick="window.location.href='edit_resume.php'">
        </div>
    </form>
</div>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<footer style="background-color: #333; color: #fff; padding: 20px 0; text-align: left;">
    <div style="display: flex; flex-wrap: wrap; justify-content: space-between; max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <!-- About Section -->
        <div style="flex: 1; margin: 10px; min-width: 200px;">
            <h3 style="border-bottom: 2px solid #f4f4f4; padding-bottom: 5px; margin-bottom: 10px;">About HireHub</h3>
            <p style="font-size: 14px; line-height: 1.6;">
                HireHub is your trusted platform for finding the best job opportunities and connecting with top employers. We are committed to helping you build your career and achieve your professional goals.
            </p>
        </div>

        <!-- Quick Links Section -->
        <div style="flex: 1; margin: 10px; min-width: 200px;">
            <h3 style="border-bottom: 2px solid #f4f4f4; padding-bottom: 5px; margin-bottom: 10px;">Quick Links</h3>
            <ul style="list-style: none; padding: 0; font-size: 14px; line-height: 1.6;">
                <li style="margin-bottom: 8px;"><a href="index.php" style="color: #fff; text-decoration: none; transition: color 0.3s;">Home</a></li>
                <li style="margin-bottom: 8px;"><a href="about_us.php" style="color: #fff; text-decoration: none; transition: color 0.3s;">About Us</a></li>
                <li style="margin-bottom: 8px;"><a href="job_posting.php" style="color: #fff; text-decoration: none; transition: color 0.3s;">Post Jobs</a></li>
                <li style="margin-bottom: 8px;"><a href="contact_us.php" style="color: #fff; text-decoration: none; transition: color 0.3s;">Contact</a></li>
                <li style="margin-bottom: 8px;"><a href="faq.php" style="color: #fff; text-decoration: none; transition: color 0.3s;">FAQ</a></li>
            </ul>
        </div>

        <!-- Contact Section -->
        <div style="flex: 1; margin: 10px; min-width: 200px;">
            <h3 style="border-bottom: 2px solid #f4f4f4; padding-bottom: 5px; margin-bottom: 10px;">Contact Us</h3>
            <p style="font-size: 14px; line-height: 1.6;"><strong>Email:</strong> support@hirehub.com</p>
            <p style="font-size: 14px; line-height: 1.6;"><strong>Phone:</strong> +91 9876543210</p>
            <p style="font-size: 14px; line-height: 1.6;"><strong>Address:</strong> 123, DD Hills😂, Tumkur, India</p>
        </div>

        <!-- Social Media Section -->
        <div style="flex: 1; margin: 10px; min-width: 200px;">
            <h3 style="border-bottom: 2px solid #f4f4f4; padding-bottom: 5px; margin-bottom: 10px;">Follow Us</h3>
            <div style="display: flex; gap: 15px; font-size: 24px;">
                <a href="#" style="color: #fff; text-decoration: none;"><i class="fab fa-facebook-f"></i></a>
                <a href="#" style="color: #fff; text-decoration: none;"><i class="fab fa-twitter"></i></a>
                <a href="#" style="color: #fff; text-decoration: none;"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" style="color: #fff; text-decoration: none;"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div style="text-align: center; margin-top: 20px; font-size: 14px;">
        <p>© 2024 HireHub. All rights reserved. Designed with ❤️ in India.</p>
    </div>
</footer>


</body>
</html>

