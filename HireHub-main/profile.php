<?php
// Database connection (adjust with your credentials)
$servername = "localhost";
$username = "root";
$password = "MdR@2004";
$dbname = "job_portal"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming the user_id is passed in from the session or URL (or set manually for this case)
$user_id = $_SESSION['user_id'] ?? 1; // You can hardcode the user ID or get it dynamically based on your needs

// Fetch the current user's data
$sql = "SELECT * FROM job_seekers WHERE id = '$user_id'";
$result = $conn->query($sql);

// If user data is found, fetch it
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found!";
    exit();
}

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'] ?? '';
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $qualification = $_POST['qualification'];
    $experience = $_POST['experience'];
    $interestedField = $_POST['interestedField'];

    // Update profile (password change logic omitted for brevity)
    $sql = "UPDATE job_seekers SET name='$name', email='$email', age='$age', contact='$contact', qualification='$qualification', experience='$experience', interested_field='$interestedField' WHERE id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        // If password is provided, update it
        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password='$hashedPassword' WHERE id='$user_id'";
            $conn->query($sql);
        }

        $_SESSION['success_message'] = "Profile updated successfully!";
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        /* Basic styles for header, footer, and profile page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        /* Profile Picture */
        .profile-pic {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-pic img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-pic input[type="file"] {
            margin-top: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 14px;
            color: #333;
        }

        input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 4px;
            margin-top: 20px;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Header and Footer */
        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
        }

        header .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        header nav ul {
            list-style: none;
            padding: 0;
        }

        header nav ul li {
            display: inline;
            margin-left: 20px;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        header nav ul li a:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            margin-top: 20px;
        }

        /* Navbar styles */
.navbar {
    background-color: #333;
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar .logo {
    color: white;
    font-size: 24px;
    font-weight: bold;
    text-decoration: none;
    display: flex;
    align-items: center;
}

.navbar .logo img {
    width: 30px; /* Adjust logo size */
    height: 30px; /* Adjust logo size */
    margin-right: 10px;
}

.navbar .nav-links {
    display: flex;
    gap: 20px;
}

.navbar .nav-links a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    padding: 10px;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.navbar .nav-links a:hover {
    background-color: #555;
}

.navbar .nav-links a:active {
    background-color: #777;
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

<!-- Profile Page Container -->
<div class="container">
    <h2>User Profile</h2>
    
    <!-- Profile Picture -->
<div class="profile-pic">
    <?php 
        // Check if user has a profile picture, otherwise use default
        $profilePic = isset($user['profile_picture']) && !empty($user['profile_picture']) ? $user['profile_picture'] : 'default-profile.png';
    ?>
    <img src="<?php echo $profilePic; ?>" alt="Profile Picture" id="profileImage">
    <input type="file" id="profilePicInput" onchange="previewProfilePic()" />
</div>
    
    <!-- Profile Information Form -->
    <form id="profileForm" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo isset($user['name']) ? htmlspecialchars($user['name']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($user['email']) ? htmlspecialchars($user['email']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Change Password:</label>
            <input type="password" id="password" name="password" placeholder="New Password">
        </div>
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?php echo isset($user['age']) ? htmlspecialchars($user['age']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="contact">Contact Number:</label>
            <input type="tel" id="contact" name="contact" value="<?php echo isset($user['contact']) ? htmlspecialchars($user['contact']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="qualification">Qualification:</label>
            <input type="text" id="qualification" name="qualification" value="<?php echo isset($user['qualification']) ? htmlspecialchars($user['qualification']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="experience">Experience (in years):</label>
            <input type="number" id="experience" name="experience" value="<?php echo isset($user['experience']) ? htmlspecialchars($user['experience']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="interestedField">Interested Field:</label>
            <input type="text" id="interestedField" name="interestedField" value="<?php echo isset($user['interested_field']) ? htmlspecialchars($user['interested_field']) : ''; ?>" required>
        </div>
        
        <!-- Save Changes Button -->
        <button type="submit">Save Changes</button>
    </form>
</div>

<script>
    // Function to preview profile picture
    function previewProfilePic() {
        const file = document.getElementById("profilePicInput").files[0];
        const reader = new FileReader();
        
        reader.onloadend = function() {
            document.getElementById("profileImage").src = reader.result;
        };
        
        if (file) {
            reader.readAsDataURL(file);
        }
    }
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

<?php
// Close the database connection
$conn->close();
?>
