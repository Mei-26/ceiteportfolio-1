<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Departments</title>
    <!-- Link to a CSS stylesheet for styling -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            text-align: center;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 400px;
            width: 90%;
        }
        h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }
        .links {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .links a {
            text-decoration: none;
            color: #3498db;
            background-color: #e3f2fd;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .links a:hover {
            background-color: #bbdefb;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>University Departments</h1>
        <div class="links">
            <a href="college_dean/departments.php">College Dean</a>
            <a href="college_secretary/departments.php">College Secretary</a>
            <a href="college_chairperson/dashboard.php">College Chairperson</a>
            <a href="department_secretary/dashboard.php">Department Secretary</a>
            <a href="faculty_members/profile.php">Faculty Members</a>
        </div>
    </div>
</body>
</html>
