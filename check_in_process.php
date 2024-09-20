<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $employee_id = $data['employee_id'];
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

            echo json_encode(['success' => true, 'message' => "Check-in successful at $check_in_time!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "You have already checked in today!"]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => "Invalid Employee ID!"]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "Invalid request!"]);
}
?>
