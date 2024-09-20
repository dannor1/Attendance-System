<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php'); // Redirect to login page
    exit();
}
?>

<?php
// check_in.php

// Database connection
include 'config.php'; // Ensure you have the proper database connection here

// Fetch employees for the table
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);

// Handle check-in request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $current_date = date('Y-m-d');
    $check_in_time = date('H:i:s');

    // Check if the employee ID is valid
    $stmt = $conn->prepare("SELECT * FROM employees WHERE employee_id = ?");
    $stmt->bind_param("s", $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Check if the employee has already checked in today
        $stmt = $conn->prepare("SELECT * FROM attendance WHERE employee_id = ? AND date = ?");
        $stmt->bind_param("ss", $employee_id, $current_date);
        $stmt->execute();
        $attendance_result = $stmt->get_result();

        if ($attendance_result->num_rows == 0) {
            // Record the check-in
            $stmt = $conn->prepare("INSERT INTO attendance (employee_id, date, check_in_time) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $employee_id, $current_date, $check_in_time);
            $stmt->execute();

            echo "<script>alert('Check-in successful at $check_in_time!');</script>";
        } else {
            echo "<script>alert('You have already checked in today!');</script>";
        }
    } else {
        echo "<script>alert('Invalid Employee ID!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check In - New Abirem Government Hospital</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <style>
        /* General Styles */
        html, body {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
        }

        .content {
            margin-left: 250px; /* Adjust based on sidebar width */
            padding: 20px;
            flex: 1; /* Allow content to grow */
            transition: margin-left 0.3s;
        }

        .sidebar.collapsed ~ .content {
            margin-left: 80px; /* Adjust based on collapsed sidebar width */
        }

        /* Modal Styles */
        #checkInModal {
            display: none; 
            position: fixed; 
            z-index: 1000; 
            left: 0; 
            top: 0; 
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 300px; /* Set width for the modal */
            text-align: center; /* Center content */
        }

        /* Employee Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #e9ecef;
        }

        /* Center the input for ID */
        .id-input {
            width: 100%;
            margin: 10px 0;
            text-align: center; /* Center text in the input */
        }
    </style>
</head>
<body>
    <?php include 'include/navbar.php'; ?>
    <?php include 'include/sidebar.php'; ?>

    <div class="content">
        <h1 class="mt-4 mb-4">Check In</h1>

        <!-- Employees Table -->
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['department']); ?></td>
                        <td><?php echo htmlspecialchars($row['position']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="openCheckInModal()">
                                Check In
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Check In Modal -->
        <div id="checkInModal" class="modal">
            <div class="modal-content">
                <span class="close-button" onclick="closeCheckInModal()">&times;</span>
                <h2>Enter Your Employee ID</h2>
                <form method="POST">
                    <input type="text" name="employee_id" class="form-control id-input" placeholder="Employee ID" required>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        
    </div>
    
    <?php include 'include/footer.php'; ?>

    <script>
        function openCheckInModal() {
            document.getElementById("checkInModal").style.display = "block";
        }

        function closeCheckInModal() {
            document.getElementById("checkInModal").style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById("checkInModal")) {
                closeCheckInModal();
            }
        }
    </script>
</body>
</html>
