<?php

include '../connection.php';

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
// $data = ["id" => -1]; //this line is for testing purposes: i tried other ids (even negative ones) that are not in the database

// Validation (id is required and > 0)
if (!isset($data["id"]) || $data["id"] <= 0) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Post ID is required and must be greater than 0"
    ]);
    exit;
}

$postId = (int)$data["id"];

// Fetch post
$result = $mysqli->query("SELECT * FROM posts WHERE id = $postId");
$post = $result->fetch_assoc();

if (!$post) { // if the id does not exist in the database
    http_response_code(404); 
    echo json_encode([
        "status" => "error",
        "message" => "Post not found"
    ]);
    exit;
}

// Fetch latest 15 comments
$commentsResult = $mysqli->query("SELECT * FROM comments WHERE post_id = $postId ORDER BY id DESC LIMIT 15"); // look at 3school.com for using order by, DESC and LIMIT

$comments = [];
$row = $commentsResult->fetch_assoc();

while ($row) {
    $comments[] = $row;
    $row = $commentsResult->fetch_assoc();
}

$post["comments"] = $comments;

echo json_encode([
    "status" => "success",
    "message" => "Post retrieved successfully",
    "data" => $post
]);