<?php
// Start the session (optional, if you're using session variables)
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - HireHub</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your custom CSS if needed -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://t4.ftcdn.net/jpg/08/00/86/91/360_F_800869143_c7y2zCaMKUVqcM2cwwwRmMqwAyeduJLa.jpg'); /* Add your background image here */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .header {
            background-color: plum; /* Semi-transparent background */
            color: blue;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.8); /* White background with opacity */
        }

        h2 {
            text-align: center;
            color: #333;
        }

        p {
            color: #555;
            line-height: 1.6;
            font-size: 18px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .footer {
            background-color: #007BFF;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        a {
            color: #007BFF;
            text-decoration: none;
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

    <div class="header">
        <h1>Contact Us - HireHub</h1>
        <p>We'd love to hear from you! Feel free to reach out to us anytime.</p>
    </div>

    <div class="container">
        <h2>Get in Touch</h2>
        <p>If you have any questions, suggestions, or need assistance, don't hesitate to contact us. Our team is ready to assist you with any inquiries.</p>

        <form action="contact_form_submit.php" method="POST">
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit">Send Message</button>
        </form>

        <h3>Contact Details</h3>
        <p>You can also reach us through the following methods:</p>
        <ul>
            <li>Email: support@hirehub.com</li>
            <li>Phone: +1 (555) 123-4567</li>
            <li>Address: 1234 Job Street, City, Country</li>
        </ul>
    </div>

    <!-- <div class="footer">
        <p>&copy; 2024 HireHub. All rights reserved.</p>
    </div> -->


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
