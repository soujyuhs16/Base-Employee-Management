<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

require_once __DIR__ . '/../models/Employee.php';

$employee = new Employee();

// 从URL获取ID
$employee->id = isset($_GET['id']) ? $_GET['id'] : die();

if ($employee->delete()) {
    http_response_code(200);
    echo json_encode(array("message" => "员工删除成功"));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "员工删除失败"));
}