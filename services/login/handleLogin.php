<?php

$payload = file_get_contents('php://input');

if (!empty($payload)) {
    $requestData = json_decode($payload, true);

    if ((isset($requestData["email"]) && isset($requestData["password"]))) {

        require_once ("loginRequest.php");

        $result = login($requestData["email"], $requestData["password"]);

        echo $result;
    } else {
        $response = array("code" => "400", "message" => "Login fail");
        echo json_encode($response);
    }
} else {
    $response = array("code" => "400", "message" => "No data received.");
    echo json_encode($response);
}
