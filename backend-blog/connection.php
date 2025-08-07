<?php

$mysqli = new mysqli("localhost", "root", "??????", "fcs_63");

if ($mysqli->connect_error) {
    http_response_code(500);
    header("Content-Type: application/json");
    echo json_encode([
        "status" => "failed",
        "message" => "Failed to connect to database"
    ]);
    exit;
} else {
    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode([  
        "status" => "success",
        "message" => "Connected to database successfully"
    ]);
}
