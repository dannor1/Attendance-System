<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php'); // Redirect to login page
    exit();
}
?>

<?php
// index.php

// Database connection
include 'config.php';

// Fetch today's check-ins
$current_date = date('Y-m-d');
$stmt = $conn->prepare("SELECT COUNT(*) as check_in_count FROM attendance WHERE date = ?");
$stmt->bind_param("s", $current_date);
$stmt->execute();
$result = $stmt->get_result();
$today_check_ins = $result->fetch_assoc()['check_in_count'];

// Fetch total employees
$result = $conn->query("SELECT COUNT(*) as total_employees FROM employees");
$total_employees = $result->fetch_assoc()['total_employees'];

// Fetch attendance data for the graph
$attendance_data = [];
$stmt = $conn->prepare("SELECT MONTH(date) as month, COUNT(*) as count FROM attendance GROUP BY MONTH(date)");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $attendance_data[$row['month']] = $row['count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Attendance System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* General Styles */
        html, body {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .content {
            margin-left: 250px; /* Adjust based on sidebar width */
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .sidebar.collapsed ~ .content {
            margin-left: 80px; /* Adjust based on collapsed sidebar width */
        }

        /* Widget Styles */
        .widget {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }

        .widget:hover {
            transform: scale(1.05);
        }

        /* Canvas for Graph */
        .graph-container {
            width: 100%;
            height: 400px;
        }

        /* Table Styles */
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
    </style>
</head>
<body>
    <?php include 'include/navbar.php'; ?>
    <?php include 'include/sidebar.php'; ?>

    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="widget">
                    <h4>Today's Check-Ins</h4>
                    <p><?php echo $today_check_ins; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="widget">
                    <h4>Total Employees</h4>
                    <p><?php echo $total_employees; ?></p>
                </div>
            </div>
        </div>

        <h2>Attendance Chart</h2>
        <div class="graph-container">
            <canvas id="attendanceChart"></canvas>
        </div>

        <h2>Check-In Records</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Check-In Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch today's check-in records
                $stmt = $conn->prepare("SELECT employees.employee_id, employees.name, employees.department, attendance.check_in_time FROM attendance JOIN employees ON attendance.employee_id = employees.employee_id WHERE attendance.date = ?");
                $stmt->bind_param("s", $current_date);
                $stmt->execute();
                $attendance_result = $stmt->get_result();
                while ($row = $attendance_result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['employee_id']) . "</td>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['department']) . "</td>
                            <td>" . htmlspecialchars($row['check_in_time']) . "</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include 'include/footer.php'; ?>

    <script>
        // Prepare data for the graph
        const attendanceData = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Attendance",
                data: [
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        echo isset($attendance_data[$i]) ? $attendance_data[$i] : 0;
                        if ($i < 12) echo ", ";
                    }
                    ?>
                ],
                backgroundColor: "rgba(75, 192, 192, 0.6)",
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 1
            }]
        };

        // Create the graph
        const ctx = document.getElementById("attendanceChart").getContext("2d");
        const attendanceChart = new Chart(ctx, {
            type: "bar",
            data: attendanceData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
