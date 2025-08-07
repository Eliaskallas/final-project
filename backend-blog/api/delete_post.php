<?php

include '../connection.php';

header("Content-Type: application/json");

// Only allow DELETE method
if ($_SERVER["REQUEST_METHOD"] !== "DELETE") {
    http_response_code(405);
    echo json_encode([
        "status" => "error",
        "message" => "Only DELETE method is allowed"
    ]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
// $data = ["id" => -6]; //this line is for testing purposes: i tried other ids (even negative ones) that are not in the database

// Validation (id is required and > 0)
if (!isset($data["id"]) || $data["id"] <= 0) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Post ID is required and must be greater than 0"
    ]);
    exit;
}

$postId = (int)$data["id"];

// Check if post exists for the given ID
$result = $mysqli->query("SELECT * FROM posts WHERE id = $postId");
if ($result->num_rows === 0) {
    http_response_code(404);
    echo json_encode([
        "status" => "error",
        "message" => "Post not found for ID: $postId"
    ]);
    exit;
}


// Delete related comments
// Must manually delete comments first, or you'll get a foreign key constraint error
$delComments = $mysqli->prepare("DELETE FROM comments WHERE post_id = ?");
$delComments->bind_param("i", $postId);
$delComments->execute();

// Delete the post
$delPost = $mysqli->prepare("DELETE FROM posts WHERE id = ?");
$delPost->bind_param("i", $postId);
$delPost->execute();

echo json_encode([
    "status" => "success",
    "message" => "Post and related comments deleted successfully"
]);