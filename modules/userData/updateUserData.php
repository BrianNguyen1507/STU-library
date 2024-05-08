<?php
function updateUsers($payload)
{
   
    $payloadData = json_decode($payload, true);

    if ($payloadData === null) {
        return json_encode(array("error" => "Invalid JSON payload"));
    }

    if (empty($payloadData['token'])) {
        return json_encode(array("error" => "Token not provided"));
    }



    $api_url = 'http://localhost:8085/api/NguoiDung/updateNguoiDung';

    $jsonData = $payloadData['updateData'];
    $token = $payloadData['token'];

    $options = array(
        'http' => array(
            'method' => 'PUT',
            'header' => "Content-Type: application/json\r\n" .
                "Authorization: Bearer " . $token,
            'content' => json_encode($jsonData),
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($api_url, false, $context);

    if ($result === false) {
        return json_encode(array("error" => "Failed to communicate with the API"));
    } else {
        return $result;
    }
}

$payload = file_get_contents('php://input');

echo updateUsers($payload);
