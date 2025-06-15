<?php
// Start the session (optional, if you're using session variables)
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - HireHub</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your custom CSS if needed -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://st4.depositphotos.com/2249091/19933/i/450/depositphotos_199333444-stock-photo-friends-working-computer-night-surrounded.jpg'); /* Add your background image here */
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

        .team {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .team-member {
            text-align: center;
            width: 30%;
        }

        .team-member img {
            width: 100%;
            border-radius: 50%;
            max-width: 150px;
            margin-bottom: 15px;
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
</head>

<body>
<div class="navbar">
    <a href="index.php" class="logo">
        <img src="job-img.jpg" alt="HireHub Logo" style="height: 40px; vertical-align: middle; margin-right: 10px;">
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
        <h1>Welcome to HireHub</h1>
        <p>Your trusted partner for finding jobs and hiring talent.</p>
    </div>

    <div class="container">
        <h2>About Us</h2>
        <p>Welcome to HireHub, the ultimate job portal connecting employers with skilled job seekers. At HireHub, we strive to make the recruitment process easy, efficient, and transparent. Whether you are an employer looking for the perfect candidate or a job seeker searching for your next big opportunity, we are here to help you every step of the way.</p>

        <p>Our platform offers a seamless user experience, where employers can post job listings and review resumes, while job seekers can apply for positions, upload resumes, and manage their profiles. Our goal is to bridge the gap between employers and talented professionals by providing a platform that makes finding and hiring talent easier than ever.</p>

        <p>With a team of dedicated professionals and advanced technology, we continuously improve our platform to meet the evolving needs of both job seekers and employers. Join us at HireHub and take the next step in your career or recruitment process.</p>

        <h3>Our Mission</h3>
        <p>Our mission is to provide a user-friendly platform that connects the right talent with the right employers. We aim to simplify the hiring process and help individuals achieve their career goals while enabling businesses to find the best candidates for their teams.</p>

        <h3>Our Team</h3>
        <div class="team">
            <div class="team-member">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAKyOfgDJ5x1CbZ67vikG5z6edPVasKWyoiuvHIdHFzbSXfc85PUeUGqUAG22xzgeAkWk&usqp=CAU" alt="Team Member 1">
                <h4>John Doe</h4>
                <p>Founder & CEO</p>
            </div>
            <div class="team-member">
                <img src="https://www.shutterstock.com/image-photo/happy-woman-phone-coffee-tea-260nw-2229533383.jpg" alt="Team Member 2">
                <h4>Jane Smith</h4>
                <p>Co-Founder & CTO</p>
            </div>
            <div class="team-member">
                <img src="https://img.freepik.com/premium-photo/businessman-drinking-coffee-social-media-break-tablet-internet-connection-browsing-male-person-professional-laughing-funny-meme-conversation-app-humor-technology_590464-260458.jpg?w=360" alt="Team Member 3">
                <h4>Michael Johnson</h4>
                <p>Marketing Manager</p>
            </div>
        </div>

        <h3>Contact Us</h3>
        <p>If you have any questions or need support, feel free to <a href="contact.php">contact us</a>. We're here to assist you!</p>
    </div>
<!-- 
    <div class="footer">
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
