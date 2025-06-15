<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HireHub</title>

    <!-- Link to FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: white;
            text-align: center;
            background: url('https://media.licdn.com/dms/image/v2/C4D12AQFi4yZvoIWupw/article-cover_image-shrink_720_1280/article-cover_image-shrink_720_1280/0/1520245690181?e=2147483647&v=beta&t=2GZD-9PURZ9wwrjGSF4HfqI-MIvdze6emgluCtSvUWg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 15px 20px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
        }

        .header-icon {
            display: flex;
            align-items: center;
        }

        .header-img {
            width: 40px;  /* Set the image width */
            height: auto;
            margin-right: 10px;  /* Space between the icon and text */
        }

        .header-nav i {
            font-size: 1.5rem;
            cursor: pointer;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px 30px;
            border-radius: 10px;
            max-width: 600px;
            margin-top: 100px;
        }

        /* Styling for labels that act as buttons */
        .label-btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            margin: 10px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .label-btn:hover {
            background-color: #45a049;
        }

        .label-btn i {
            margin-right: 8px;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 10px 20px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
        }

        .admin-login-btn {
            background-color: #007bff; /* Button background color */
            color: #fff; /* Button text color */
            text-decoration: none; /* Remove underline */
            border: none;
            border-radius: 5px; /* Rounded corners */
            padding: 10px 20px; /* Button padding */
            cursor: pointer; /* Pointer cursor on hover */
            font-size: 16px; /* Font size */
            display: inline-block; /* Ensure block-like button */
        }

        .admin-login-btn:hover {
            background-color: #0056b3; /* Darker background on hover */
        }

    </style>
</head>
<body>
<!-- Header Section -->
<header>
    <div class="header-icon">
        <!-- Image icon for HireHub -->
        <img src="job-img.jpg" alt="HireHub Icon" class="header-img">
        HireHub
    </div>
    <div class="header-nav">
        <!-- Add the menu toggle icon -->
        <i class="fas fa-bars" id="menu-toggle"></i>
        <!-- Admin Login Button -->
        <a href="admin_login.php" class="admin-login-btn">Admin Login</a>
    </div>
</header>



    <!-- Main Content Section -->
    <div class="container">
        <h1>Welcome to HireHub</h1>
        <p>
            EasyJobs is a platform designed to connect job seekers with top employers. 
            Whether you're searching for your dream job or looking to hire the best talent, 
            we are here to make the process smooth, easy, and efficient.
        </p>

        <!-- Links with Labels for Navigation -->
        <a href="userSignin.php" class="label-btn">
            <i class="fas fa-user"></i> Job Seeker
        </a>
        <a href="organizationsignin.php" class="label-btn">
            <i class="fas fa-briefcase"></i> Employer
        </a>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 HireHub. Find Your Next Career Move with Us.</p>
    </footer>
</body>
</html>


