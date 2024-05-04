<?php

function register($username, $email, $password, $repassword, $role)
{
   
    if ($password !== $repassword) {
        return json_encode(array('fail' => false, 'message' => 'Xác nhận mật khẩu không khớp với mật khẩu. Vui lòng kiểm tra lại!'));
    }
    $requestData = array(
        'tenDangNhap' => $username,
        'email' => $email,
        'password' => $password,
        'passwordConfirm' => $repassword,
        'phanQuyenId' => $role
    );

    $jsonData = json_encode($requestData);

    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => $jsonData,
            'ignore_errors' => true
        )
    );

    $context = stream_context_create($options);

    $response = @file_get_contents('http://localhost:8085/api/register', false, $context);


    if ($response === false) {
    
        return json_encode(array('success' => false, 'message' => 'Error registering user'));
    }
    return $response;
}
