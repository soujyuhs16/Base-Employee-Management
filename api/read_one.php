<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once __DIR__ . '/../models/Employee.php';

$employee = new Employee();

// Get ID from URL
$employee->id = isset($_GET['id']) ? $_GET['id'] : die();

$result = $employee->readOne();

if ($result->rowCount() > 0) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    
    $employee_arr = array(
        'id' => $row['id'],
        'first_name' => $row['first_name'],
        'last_name' => $row['last_name'],
        'email' => $row['email'],
        'phone' => $row['phone'],
        'position' => $row['position'],
        'hire_date' => $row['hire_date']
    );

    http_response_code(200);
    echo json_encode($employee_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Employee not found."));
}