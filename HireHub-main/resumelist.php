<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "MdR@2004";
$database = "job_portal";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch company names for the dropdown
$companyQuery = "SELECT DISTINCT company_name FROM resume1";
$companyResult = $conn->query($companyQuery);

if (!$companyResult) {
    die("Error fetching company names: " . $conn->error);
}

// Initialize filter query
$filter = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['company_name'])) {
    $filter = "WHERE company_name = '" . $conn->real_escape_string($_POST['company_name']) . "'";
}

// Fetch resumes based on the filter
$sql = "SELECT * FROM resume1 $filter";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching resumes: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Resumes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .filter-form {
            text-align: center;
            margin-bottom: 20px;
        }

        .filter-form select, .filter-form button {
            padding: 10px;
            font-size: 16px;
            margin: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
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
    <h1>All Resumes</h1>

    <!-- Filter Form -->
    <div class="filter-form">
        <form method="POST" action="">
            <label for="company_name">Filter by Company:</label>
            <select id="company_name" name="company_name">
                <option value="">--Select Company--</option>
                <?php
                if ($companyResult->num_rows > 0) {
                    while ($row = $companyResult->fetch_assoc()) {
                        $selected = (!empty($_POST['company_name']) && $_POST['company_name'] == $row['company_name']) ? "selected" : "";
                        echo "<option value='" . htmlspecialchars($row['company_name']) . "' $selected>" . htmlspecialchars($row['company_name']) . "</option>";
                    }
                }
                ?>
            </select>
            <button type="submit">Filter</button>
        </form>
    </div>

    <!-- Display Resumes -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Qualification</th>
                <th>Domain</th>
                <th>Address</th>
                <th>Experience</th>
                <th>Courses Undertaken</th>
                <th>Company Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['age']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['qualification']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['domain']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['experience']) . " years</td>";
                    echo "<td>" . htmlspecialchars($row['courses_undergone']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['company_name']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No resumes found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Close the database connection
    $conn->close();
    ?>

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


