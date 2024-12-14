<?php
class Validator {
    /**
     * 验证员工数据
     */
    public static function validateEmployee($data) {
        $errors = [];
        
        if (empty($data->first_name)) {
            $errors[] = "名字不能为空";
        }
        
        if (empty($data->last_name)) {
            $errors[] = "姓氏不能为空";
        }
        
        if (empty($data->email)) {
            $errors[] = "邮箱不能为空";
        } elseif (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "邮箱格式不正确";
        }
        
        if (empty($data->position)) {
            $errors[] = "职位不能为空";
        }
        
        return $errors;
    }

    /**
     * 清理输入数据
     */
    public static function sanitize($data) {
        return htmlspecialchars(strip_tags($data));
    }
}