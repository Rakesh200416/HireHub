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

// Fetch job listings from the database
$sql = "SELECT * FROM jobs";
$result = $conn->query($sql);

// Array to store job data
$jobs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Search and Filter</title>
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
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .search-filter {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-filter input, .search-filter select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            width: 100%;
        }

        .job-listing {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 4px;
            background-color: #fff;
            position: relative;
        }

        .job-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .job-details {
            font-size: 14px;
            color: #666;
            margin-right: 80px;
        }

        .apply-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .apply-btn:hover {
            background-color: #45a049;
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
    <h2>Job Search and Filter</h2>
    
    <div class="search-filter">
        <input type="text" id="searchInput" placeholder="Search by job title or company name">
        <select id="locationFilter">
            <option value="">Filter by location</option>
            <option value="Bangalore">Bangalore</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Delhi">Delhi</option>
            <option value="Hyderabad">Hyderabad</option>
            <option value="Manglore">Mangalore</option>
        </select>
        <select id="experienceFilter">
            <option value="">Filter by experience</option>
            <option value="0-2">0-2 years</option>
            <option value="3-5">3-5 years</option>
            <option value="6-10">6-10 years</option>
        </select>
    </div>

    <div id="jobContainer">
        <?php
        // Display job listings
        foreach ($jobs as $job) {
            echo '
            <div class="job-listing" data-location="' . htmlspecialchars($job['location']) . '" data-experience="' . htmlspecialchars($job['experience']) . '">
                <div class="job-title">' . htmlspecialchars($job['title']) . '</div>
                <div class="job-details">Location: ' . htmlspecialchars($job['location']) . ' | Experience: ' . htmlspecialchars($job['experience']) . ' years | Salary: ₹' . number_format($job['salary'], 2) . ' | Job Type: ' . htmlspecialchars($job['jobType']) . '</div>
                <a href="resume.php?job_id=' . htmlspecialchars($job['id']) . '" class="apply-btn">Apply</a>
            </div>
            ';
        }
        ?>
    </div>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const locationFilter = document.getElementById('locationFilter');
    const experienceFilter = document.getElementById('experienceFilter');
    const jobContainer = document.getElementById('jobContainer');
    const jobListings = jobContainer.getElementsByClassName('job-listing');

    function filterJobs() {
        const searchQuery = searchInput.value.toLowerCase();
        const locationValue = locationFilter.value;
        const experienceValue = experienceFilter.value;

        Array.from(jobListings).forEach(job => {
            const title = job.getElementsByClassName('job-title')[0].textContent.toLowerCase();
            const details = job.getElementsByClassName('job-details')[0].textContent.toLowerCase();
            const jobLocation = job.getAttribute('data-location');
            const jobExperience = job.getAttribute('data-experience');

            const matchesSearch = title.includes(searchQuery) || details.includes(searchQuery);
            const matchesLocation = !locationValue || jobLocation === locationValue;
            const matchesExperience = !experienceValue || jobExperience === experienceValue;

            if (matchesSearch && matchesLocation && matchesExperience) {
                job.style.display = 'block';
            } else {
                job.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('input', filterJobs);
    locationFilter.addEventListener('change', filterJobs);
    experienceFilter.addEventListener('change', filterJobs);
</script>

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


