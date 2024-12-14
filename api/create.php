<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

require_once __DIR__ . '/../models/Employee.php';
require_once __DIR__ . '/../utils/Validator.php';

$employee = new Employee();

// 获取POST数据
$data = json_decode(file_get_contents("php://input"));

// 验证数据
$errors = Validator::validateEmployee($data);

if (empty($errors)) {
    $employee->first_name = $data->first_name;
    $employee->last_name = $data->last_name;
    $employee->email = $data->email;
    $employee->phone = $data->phone ?? '';
    $employee->position = $data->position;
    $employee->hire_date = date('Y-m-d');

    if ($employee->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "员工添加成功"));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "员工添加失败"));
    }
} else {
    http_response_code(400);
    echo json_encode(array(
        "message" => "数据验证失败",
        "errors" => $errors
    ));
}