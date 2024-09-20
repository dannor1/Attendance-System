<?php
session_start();
include 'config.php';

// Redirect if not logged in as admin
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

// Handle form submission and actions (add, edit, delete) here

// Fetch employees for the table
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employees - New Abirem Government Hospital</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/all.css"> <!-- Font Awesome CSS -->
    <style>
        /* General Styles */
        html, body {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            padding: 20px;
        }
        .nav-link{
            height: 50px;

        }
        /* Sidebar and Navbar adjustments */
        .sidebar {
            position: fixed;
            width: 250px; /* Sidebar width */
            height: 100%;
            top: 0;
            left: 0;
            background: #343a40;
            color: #fff;
            transition: width 0.3s;
            overflow: auto;
        }

        .sidebar.collapsed {
            width: 80px; /* Collapsed sidebar width */
        }

        .sidebar .nav-link {
            color: #fff;
            padding: 10px;
            display: block;
        }

        .sidebar .nav-link:hover {
            background: #495057;
        }

        .content {
            margin-left: 250px; /* Adjust based on sidebar width */
            padding: 20px;
            transition: margin-left 0.3s;
            min-height: 100vh; /* Ensure content area fills height */
        }

        .sidebar.collapsed ~ .content {
            margin-left: 80px; /* Adjust based on collapsed sidebar width */
        }

       

        /* Table Styles */
        .table-container {
            margin-bottom: 20px;
            overflow-x: auto; /* Allow horizontal scrolling */
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table th, .table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #dee2e6;
        }

        .table th {
            background-color: #e9ecef;
        }

        .table td {
            border-top: 1px solid #dee2e6;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
            }

            .content {
                margin-left: 80px;
            }
        }
    </style>
</head>
<body>
    <?php include 'include/navbar.php'; ?>
    <?php include 'include/sidebar.php'; ?>

    <div class="content">
        <div class="container">
            <h1 class="mt-4 mb-4">Manage Employees</h1>

            <!-- Display message -->
            <?php if (isset($message)) { ?>
                <div class="alert alert-info">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <!-- Button to open modal -->
            <button class="btn btn-primary mb-4" id="openModal">
                <i class="fas fa-plus"></i> Add Employee
            </button>

            <!-- Employees Table -->
            <div class="table-container">
                <table class="table">
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
                                    <button class="btn btn-warning btn-sm" onclick="editEmployee(<?php echo $row['employee_id']; ?>)">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteEmployee(<?php echo $row['employee_id']; ?>)">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add/Edit Employee Modal -->
        <div id="customModal" class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <h2 id="modalTitle">Add New Employee</h2>
                <form method="POST" id="employeeForm">
                    <input type="hidden" name="employee_id" id="employeeId">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" class="form-control" name="department" id="department" required>
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" name="position" id="position" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <button type="submit" name="add_employee" id="submitButton" class="btn btn-primary">Add Employee</button>
                </form>
            </div>
        </div>

        
    </div>
    <?php include 'include/footer.php'; ?>
    <script>
        // Get the modal and form elements
        var modal = document.getElementById("customModal");
        var btn = document.getElementById("openModal");
        var span = document.getElementsByClassName("close-button")[0];
        var form = document.getElementById("employeeForm");
        var modalTitle = document.getElementById("modalTitle");
        var submitButton = document.getElementById("submitButton");

        // Open the modal
        btn.onclick = function() {
            modal.style.display = "block";
            form.reset(); // Reset form when opening modal
            modalTitle.textContent = "Add New Employee";
            submitButton.setAttribute('name', 'add_employee');
        }

        // Close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Edit Employee Function
        function editEmployee(id) {
            modal.style.display = "block";
            modalTitle.textContent = "Edit Employee";
            submitButton.setAttribute('name', 'edit_employee');
            document.getElementById("employeeId").value = id;

            // Fetch current data for the employee
            fetch(`get_employee.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("name").value = data.name;
                    document.getElementById("department").value = data.department;
                    document.getElementById("position").value = data.position;
                    document.getElementById("email").value = data.email;
                });
        }

        // Delete Employee Function
        function deleteEmployee(id) {
            if (confirm("Are you sure you want to delete this employee?")) {
                window.location.href = `manage_employees.php?delete_employee=${id}`;
            }
        }
    </script>
</body>
</html>
