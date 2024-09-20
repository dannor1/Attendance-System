# Attendance Tracking System

This project is an attendance tracking system built for New Abirem Government Hospital. It allows employees to check in daily, and the system generates reports for admins to monitor attendance. The project includes features such as employee management, daily check-ins, and reports generation.

---

## Table of Contents

1. [Features](#features)
2. [System Requirements](#system-requirements)
3. [Installation](#installation)
4. [Usage](#usage)
5. [Admin Credentials](#admin-credentials)
6. [Steps for GitHub Setup](#steps-for-github-setup)
7. [Contributions](#contributions)

---

## Features

- **Employee Check-In**: Employees can check in using their employee ID, and the system records the date and time.
- **Attendance Reporting**: Admins can generate attendance reports for selected dates.
- **Real-Time Notifications**: Admins are notified in real time when employees check in.
- **Employee Management**: Admins can add, update, or delete employee information.
- **Graphical Dashboard**: The dashboard displays the number of check-ins, total employees, and a monthly attendance graph.
- **PDF Reports**: Admins can generate and download attendance reports in PDF format.

---

## System Requirements

- **PHP 7.4 or higher**
- **MySQL 5.6 or higher**
- **XAMPP, WAMP, or any server running PHP and MySQL**
- **Web Browser**: Google Chrome, Firefox, or any modern browser

---

## Installation

1. **Clone the Repository**

   Run the following command in your terminal:

   ```bash
   git clone https://github.com/dannor1/Attendance-System.git
2. **Set Up the Database**

- Open phpMyAdmin and create a new database called attendance_system.
- Import the attendance_system.sql file from the db folder located in the repository to create the necessary tables and structure.

3. **Update Configuration**

- Open the config.php file in the project folder.

- Ensure the database connection details match your local setup:
$host = 'localhost';
$db_name = 'attendance_system';
$username = 'root';
$password = '';

4. Start the Server

- If using XAMPP, start the Apache and MySQL modules.
- Navigate to http://localhost/Attendance-System in your browser.


# Usage

### Step 1: Employee Check-In

- Employees can navigate to the check-in page and enter their employee ID to record their attendance for the day.

### Step 2: Attendance Report

- Admins can navigate to the "Attendance Report" section to generate attendance reports for specific dates.
- The report includes employee details, check-in times, and can be downloaded in PDF format.

### Step 3: Dashboard

- The admin dashboard provides an overview of the system, showing real-time check-ins, total employees, and a monthly attendance graph.

### Step 4: Admin Login

- Admins can log in using the admin credentials to manage employees, view check-ins, generate reports, and receive notifications of check-ins.

# Admin Credentials

The system comes with default admin login credentials:

- **Username**: `admin`
- **Password**: `password123`

Once logged in, the admin can manage employee records, view attendance logs, and generate attendance reports.

# Contributions

If you'd like to contribute to this project, follow these steps:

1. **Fork the Repository**: Click the "Fork" button at the top right of this repository on GitHub.
2. **Clone the Repository**: Clone your forked repository to your local machine.
3. **Make Your Changes**: Add or modify features in the codebase.
4. **Push to Your Fork**: Push the changes to your forked repository.
5. **Create a Pull Request**: Submit a pull request to merge your changes into the main project.

---
