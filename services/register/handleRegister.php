<?php

$payload = file_get_contents('php://input');

if (!empty($payload)) {
    $requestData = json_decode($payload, true);

    if (isset($requestData["tenDangNhap"]) && isset($requestData["email"]) && isset($requestData["password"]) && isset($requestData["passwordConfirm"]) && isset($requestData["phanQuyenId"])) {

        require_once ("registerRequest.php");

        $result = register($requestData["tenDangNhap"], $requestData["email"], $requestData["password"], $requestData["passwordConfirm"], $requestData["phanQuyenId"]);

        echo $result;
    } else {
        $response = array("code" => "400", "message" => "Incomplete registration data");
        echo json_encode($response);
    }
} else {
    $response = array("code" => "400", "message" => "No data received.");
    echo json_encode($response);
}
?>