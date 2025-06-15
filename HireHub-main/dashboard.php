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

// Fetch counts for job seekers, employers, jobs, and resumes
$job_seekers_count_query = "SELECT COUNT(*) as total FROM job_seekers";
$employers_count_query = "SELECT COUNT(*) as total FROM employer1";
$jobs_count_query = "SELECT COUNT(*) as total FROM jobs";
$resume1_count_query = "SELECT COUNT(*) as total FROM resume1"; // Assuming a resumes table

$job_seekers_result = $conn->query($job_seekers_count_query);
$employers_result = $conn->query($employers_count_query);
$jobs_result = $conn->query($jobs_count_query);
$resume1_result = $conn->query($resume1_count_query); // Get resume count

$job_seekers_count = $job_seekers_result->fetch_assoc()['total'];
$employers_count = $employers_result->fetch_assoc()['total'];
$jobs_count = $jobs_result->fetch_assoc()['total'];
$resume1_count = $resume1_result->fetch_assoc()['total']; // Store resume count

// Pagination setup
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $limit;

// Fetch job seekers for detailed view
$job_seekers_query = "SELECT * FROM job_seekers LIMIT $start_from, $limit";
$job_seekers = $conn->query($job_seekers_query);

// Fetch employers for detailed view
$employers_query = "SELECT * FROM employer1 LIMIT $start_from, $limit";
$employers = $conn->query($employers_query);

// Fetch jobs for detailed view
$jobs_query = "SELECT * FROM jobs LIMIT $start_from, $limit";
$jobs = $conn->query($jobs_query);

// Fetch resumes for detailed view
$resume1_query = "SELECT * FROM resume1 LIMIT $start_from, $limit"; // Query to fetch resumes
$resume1 = $conn->query($resume1_query); // Fetch resumes

// Fetch total records for pagination
$total_jobs_query = "SELECT COUNT(*) as total FROM jobs";
$total_jobs_result = $conn->query($total_jobs_query);
$total_jobs = $total_jobs_result->fetch_assoc()['total'];
$total_pages = ceil($total_jobs / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            background-image: url('https://thumbs.dreamstime.com/b/handwriting-text-writing-re-hiring-concept-meaning-advertising-employment-workforce-placement-new-job-white-pc-keyboard-161389037.jpg');
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2, h3 {
            text-align: center;
            color: #333;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h3 {
            margin-bottom: 10px;
        }

        .card {
            display: inline-block;
            width: 30%;
            margin: 10px;
            padding: 15px;
            background-color: #fafafa;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        .card a:hover {
            text-decoration: underline;
        }

        .table-container {
            margin-top: 20px;
            display: none; /* Initially hide all tables */
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
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .resume-link {
            color: #007BFF;
            text-decoration: none;
        }

        .resume-link:hover {
            text-decoration: underline;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #007BFF;
            text-decoration: none;
            padding: 8px 12px;
            margin: 0 5px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .pagination a:hover {
            background-color: #f1f1f1;
        }

        .pagination .active {
            background-color: #007BFF;
            color: #fff;
            border: 1px solid #007BFF;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Admin Dashboard</h2>

    <div class="section">
        <h3>Dashboard Overview</h3>
        <div class="card">
            <h4>Job Seekers</h4>
            <p>Total: <?php echo $job_seekers_count; ?></p>
            <a href="javascript:void(0);" onclick="toggleTable('jobSeekersTable')">View Job Seekers</a>
        </div>
        <div class="card">
            <h4>Employers</h4>
            <p>Total: <?php echo $employers_count; ?></p>
            <a href="javascript:void(0);" onclick="toggleTable('employersTable')">View Employers</a>
        </div>
        <div class="card">
            <h4>Jobs</h4>
            <p>Total: <?php echo $jobs_count; ?></p>
            <a href="javascript:void(0);" onclick="toggleTable('jobsTable')">View Jobs</a>
        </div>
        <div class="card">
            <h4>Resumes</h4>
            <p>Total: <?php echo $resume1_count; ?></p>
            <a href="javascript:void(0);" onclick="toggleTable('resumesTable')">View Resumes</a>
        </div>
    </div>

    <div class="table-container" id="jobSeekersTable">
        <h3>Job Seekers</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Designation</th>
                <th>Address</th>
                <th>Created At</th>
            </tr>
            <?php while ($job_seeker = $job_seekers->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $job_seeker['name']; ?></td>
                <td><?php echo $job_seeker['email']; ?></td>
                <td><?php echo $job_seeker['age']; ?></td>
                <td><?php echo $job_seeker['designation']; ?></td>
                <td><?php echo $job_seeker['address']; ?></td>
                <td><?php echo $job_seeker['created_at']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <div class="table-container" id="employersTable">
        <h3>Employers</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Designation</th>
                <th>Created At</th>
            </tr>
            <?php while ($employer = $employers->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $employer['name']; ?></td>
                <td><?php echo $employer['organization']; ?></td>
                <td><?php echo $employer['email']; ?></td>
                <td><?php echo $employer['designation']; ?></td>
                <td><?php echo $employer['created_at']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <div class="table-container" id="jobsTable">
        <h3>Jobs</h3>
        <table>
            <tr>
                <th>Job Title</th>
                <th>Description</th>
                <th>Location</th>
                <th>Experience</th>
                <th>Salary</th>
                <th>Job Type</th>
                <th>Company Name</th>
            </tr>
            <?php while ($job = $jobs->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $job['title']; ?></td>
                <td><?php echo $job['description']; ?></td>
                <td><?php echo $job['location']; ?></td>
                <td><?php echo $job['experience']; ?> years</td>
                <td><?php echo $job['salary']; ?></td>
                <td><?php echo isset($job['jobtype']) ? $job['jobtype'] : 'N/A'; ?></td>
                <td><?php echo $job['company_name']; ?></td>
            </tr>
            <?php } ?>
        </table>
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <a href="?page=<?php echo $i; ?>" class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php } ?>
        </div>
    </div>

    <div class="table-container" id="resumesTable">
        <h3>Resumes</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Qualification</th>
                <th>Domain</th>
                <th>Address</th>
                <th>Experience</th>
                <th>Courses Underwent</th>
                <th>Company Name</th>
            </tr>
            <?php while ($resume = $resume1->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $resume['name']; ?></td>
                <td><?php echo $resume['age']; ?></td>
                <td><?php echo $resume['qualification']; ?></td>
                <td><?php echo $resume['domain']; ?></td>
                <td><?php echo $resume['address']; ?></td>
                <td><?php echo $resume['experience']; ?> years</td>
                <td><?php echo $resume['courses_undergone']; ?></td>
                <td><?php echo $resume['company_name']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

</div>

<script>
    function toggleTable(tableId) {
        const tables = document.querySelectorAll('.table-container');
        tables.forEach(table => {
            table.style.display = 'none'; // Hide all tables
        });

        const tableToShow = document.getElementById(tableId);
        tableToShow.style.display = 'block'; // Show the clicked table
    }
</script>

</body>
</html>




