<?php
function login($email, $password)
{
    $requestData = array(
        'email' => $email,
        'password' => $password
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

    $response = file_get_contents('http://localhost:8085/api/login', false, $context);

    return $response;

}




