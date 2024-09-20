<head>
<link rel="stylesheet" href="assets/css/all.css">
</head>
<!-- include/sidebar.php -->
<div id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <img src="img/logo.jpg" alt="Logo" class="sidebar-logo">
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i> <!-- Font Awesome icon for toggle -->
        </button>
    </div>
    <ul class="sidebar-nav">
        <li class="nav-item">
            <a href="index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                <i class="fas fa-home"></i> <!-- Home Icon -->
                <span class="nav-text">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="manage_employees.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage_employees.php' ? 'active' : ''; ?>">
                <i class="fas fa-users-cog"></i> <!-- Manage Employees Icon -->
                <span class="nav-text">Manage Employees</span>
            </a>
        </li>
        <li class="nav-item">
        <a href="check_in.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'check_in.php' ? 'active' : ''; ?>">
                <i class="fas fa-calendar-check"></i> <!-- Attendance Icon -->
                <span class="nav-text">Attendance</span>
            </a>
        </li>
        <li class="nav-item">
        <a href="report.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'report.php' ? 'active' : ''; ?>">
                <i class="fas fa-file-alt"></i> <!-- Reports Icon -->
                <span class="nav-text">Reports</span>
            </a> 
        </li>
        <li class="nav-item">
            <a href="admin_logout.php" class="nav-link">
                <i class="fas fa-sign-out-alt"></i> <!-- Logout Icon -->
                <span class="nav-text">Logout</span>
            </a>
        </li>
    </ul>
</div>


<style>
 /* Sidebar styling */
.sidebar {
    height: 100vh;
    width: 250px; /* Default width */
    position: fixed;
    top: 0;
    left: 0;
    background-color: #343a40; /* Dark background */
    color: #ffffff;
    transition: width 0.3s;
    overflow: hidden;
}

/* Sidebar collapsed state */
.sidebar.collapsed {
    width: 80px; /* Collapsed width */
}

/* Sidebar header */
.sidebar-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem;
    background-color: #495057; /* Slightly lighter background */
}

/* Sidebar logo */
.sidebar-logo {
    height: 40px;
    width: 40px;
    border-radius: 50%;
}

/* Sidebar toggle button */
.sidebar-toggle {
    background: none;
    border: none;
    color: #ffffff;
    font-size: 1.5rem;
    cursor: pointer;
}

/* Navigation items */
.sidebar-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.nav-item {
    border-bottom: 1px solid #6c757d;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 1rem;
    color: #ffffff;
    text-decoration: none;
    transition: background-color 0.3s, transform 0.2s;
}

.nav-link:hover {
    background-color: #495057; /* Highlight on hover */
    transform: scale(1.05); /* Slight scale effect on hover */
}

.nav-link.active {
    background-color: #007bff; /* Active link background color */
}

/* Icon styling */
.nav-link i {
    margin-right: 1rem;
    font-size: 1.25rem; /* Adjust icon size as needed */
}

/* Text for navigation items */
.nav-text {
    display: inline;
}

/* Hide text when collapsed */
.sidebar.collapsed .nav-text {
    display: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .sidebar {
        width: 50px; /* Collapsed width */
    }
}


</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');

    toggleButton.addEventListener('click', function () {
        sidebar.classList.toggle('collapsed');
    });
});
</script>

