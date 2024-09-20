
<?php
include 'config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM employees WHERE employee_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

echo json_encode($data);
?>
