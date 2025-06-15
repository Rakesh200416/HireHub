<?php
// Database connection details
$host = 'localhost';
$username = 'root';
$password = 'MdR@2004';
$database = 'job_portal';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
    $companyName = $conn->real_escape_string($_POST['companyName']);
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $location = $conn->real_escape_string($_POST['location']);
    $experience = intval($_POST['experience']);
    $salary = floatval($_POST['salary']);
    $jobType = $conn->real_escape_string($_POST['jobType']);

    $query = "INSERT INTO jobs (company_name, title, description, location, experience, salary, jobType) 
              VALUES ('$companyName', '$title', '$description', '$location', '$experience', '$salary', '$jobType')";

    if ($conn->query($query) === TRUE) {
        echo "New job posted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    $query = "DELETE FROM jobs WHERE id = $deleteId";
    if ($conn->query($query) === TRUE) {
        echo "Job deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

$query = "SELECT * FROM jobs";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Posting and Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://media.istockphoto.com/id/918365088/photo/african-american-man-browsing-work-online-using-job-search-computer-app.jpg?s=612x612&w=0&k=20&c=AkT-aylthGQumNMO8aTJG8d5sJdUwNPN4oIp83CE0GY=');
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .navbar {
            background-color: #333;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
            color: #fff;
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
            border-radius: 8px;
        }

        h2, h3 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, textarea, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .job-listing {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 4px;
            background-color: #fff;
        }

        .job-title {
            font-size: 18px;
            font-weight: bold;
        }

        .delete-button {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 12px;
            margin-top: 10px;
        }

        .delete-button:hover {
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
        <a href="resumelist.php"> View-Resumes</a>
        <a href="profile.php">My Profile</a>
        <a href="userlogout.php">Log Out</a>
    </div>
</div>

<div class="container">
    <h2>Job Posting and Management</h2>

    <form method="POST">
        <div class="form-group">
            <label for="companyName">Company Name:</label>
            <input type="text" id="companyName" name="companyName" required>
        </div>
        <div class="form-group">
            <label for="title">Job Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Job Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
        </div>
        <div class="form-group">
            <label for="experience">Experience (years):</label>
            <input type="number" id="experience" name="experience" required>
        </div>
        <div class="form-group">
            <label for="salary">Salary (₹):</label>
            <input type="number" id="salary" name="salary" required>
        </div>
        <div class="form-group">
            <label for="jobType">Job Type:</label>
            <select id="jobType" name="jobType" required>
                <option value="Full-Time">Full-Time</option>
                <option value="Part-Time">Part-Time</option>
                <option value="Contract">Contract</option>
                <option value="Internship">Internship</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Post Job">
        </div>
    </form>

    <h3>Job Listings</h3>
    <div>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($job = $result->fetch_assoc()): ?>
                <div class="job-listing">
                    <div class="job-title"><?php echo htmlspecialchars($job['title']); ?> at <?php echo htmlspecialchars($job['company_name']); ?></div>
                    <div>
                        <p><strong>Description:</strong> <?php echo htmlspecialchars($job['description']); ?></p>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?></p>
                        <p><strong>Experience:</strong> <?php echo htmlspecialchars($job['experience']); ?> years</p>
                        <p><strong>Salary:</strong> ₹<?php echo htmlspecialchars($job['salary']); ?></p>
                        <p><strong>Job Type:</strong> <?php echo htmlspecialchars($job['jobType']); ?></p>
                    </div>
                    <a href="?delete=<?php echo $job['id']; ?>"><button class="delete-button">Delete</button></a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No job postings available.</p>
        <?php endif; ?>
    </div>
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

<?php
$conn->close();
?>



