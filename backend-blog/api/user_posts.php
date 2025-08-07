<?php

include '../connection.php';

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
// $data = ["user_id" => 1]; //this line is for testing purposes: i tried other user_ids (even negative ones) that are not in the database

// Validation (user_id is required and > 0)
if (!isset($data["user_id"]) || $data["user_id"] <= 0) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "User ID is required and must be greater than 0"
    ]);
    exit;
}

$userId = (int)$data["user_id"];

// Fetch latest 10 posts for the user
$result = $mysqli->query("SELECT * FROM posts WHERE user_id = $userId ORDER BY id DESC LIMIT 10"); // look at 3school.com for using order by, DESC and LIMIT

$posts = [];
$row = $result->fetch_assoc();

while ($row) {
    $posts[] = $row;
    $row = $result->fetch_assoc();
}

echo json_encode([
    "status" => "success",
    "message" => "User posts retrieved successfully",
    "data" => $posts
]);
