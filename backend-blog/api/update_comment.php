<?php

include '../connection.php';

header("Content-Type: application/json");

// Only allow PUT requests
if ($_SERVER["REQUEST_METHOD"] !== "PUT") {
    http_response_code(405);
    echo json_encode([
        "status" => "error",
        "message" => "Only PUT method is allowed"
    ]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
// $data = ["id" => 20, "content" => "Updated comment for the new post"]; //this line is for testing purposes: i tried other ids that are not in the database

// Validate input (id and content are required)
if (!isset($data["id"])) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Comment ID is required"
    ]);
    exit;
}

if (!isset($data["content"])) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Comment content is required"
    ]);
    exit;
}

$commentId = (int)$data["id"];
$content = $data["content"];

$result = $mysqli->query("SELECT * FROM comments WHERE id = $commentId"); // Check if the comment exists for the given ID
if ($result->num_rows === 0) {
    http_response_code(404);
    echo json_encode([
        "status" => "error",
        "message" => "ID: $commentId not found in the database"
    ]);
    exit;
}

// Update the comment
$statement = $mysqli->prepare("UPDATE comments SET content = ? WHERE id = ?");
$statement->bind_param("si", $content, $commentId);
$statement->execute();

echo json_encode([
    "status" => "success",
    "message" => "Comment updated successfully"
]);