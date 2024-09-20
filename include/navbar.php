<!-- include/navbar.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <!-- Navbar brand (empty for spacing) -->
        <a class="navbar-brand" href="#" style="display: none;"></a>
        
        <!-- Navbar toggler for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            
            <!-- Centered Logo and Titles -->
            <div class="navbar-center">
                <img src="img/logo.jpg" alt="Logo" class="navbar-logo">
                <div class="navbar-title">
                    <h2>New Abirem Government Hospital</h2>
                    <p>Attendance Tracking System</p>
                </div>
            </div>
        </di>
    </div>
</nav>
<style>
    /* Navbar styling */
.navbar {
    position: relative;
    overflow: hidden;
}

/* Centered logo and titles */
.navbar-center {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex: 1;
}

/* Circular logo styling */
.navbar-logo {
    height: 50px; /* Adjust the height as needed */
    width: 50px; /* Ensure the width matches the height for a perfect circle */
    border-radius: 50%; /* Makes the image circular */
    object-fit: cover; /* Ensures the image covers the circle without distortion */
    margin-bottom: 10px; /* Space between logo and titles */
}

/* Navbar titles styling */
.navbar-title {
    color: #ffffff; /* White text color */
    text-align: center;
}

.navbar-title h2 {
    margin: 0;
    font-size: 1.5rem;
}

.navbar-title p {
    margin: 0;
    font-size: 1rem;
}

/* Logout button styling */
.logout-btn {
    background-color: #dc3545; /* Bootstrap danger color */
    color: #ffffff;
    border-radius: 0.25rem; /* Slightly rounded corners */
    padding: 0.5rem 1rem; /* Padding inside the button */
    text-align: center; /* Center text */
    font-weight: bold; /* Bold text */
    transition: background-color 0.3s; /* Smooth transition */
}

.logout-btn:hover {
    background-color: #c82333; /* Darker red for hover effect */
}

</style>