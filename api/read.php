<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once __DIR__ . '/../models/Employee.php';

$employee = new Employee();
$result = $employee->read();
$num = $result->rowCount();

if ($num > 0) {
    $employees_arr = array();
    $employees_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $employee_item = array(
            'id' => $id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'position' => $position,
            'hire_date' => $hire_date
        );

        array_push($employees_arr['data'], $employee_item);
    }

    http_response_code(200);
    echo json_encode($employees_arr);
} else {
    http_response_code(404);
    echo json_encode(array('message' => '未找到员工记录'));
}