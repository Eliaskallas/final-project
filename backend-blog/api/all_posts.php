<?php

include '../connection.php';

header("Content-Type: application/json");

//Fetch all posts ordered by most recent
$result = $mysqli->query("SELECT * FROM posts ORDER BY id DESC");

$posts = [];
$row = $result->fetch_assoc();

while ($row) {
    //Count comments for this post
    $postId = $row["id"];
    $countResult = $mysqli->query("SELECT COUNT(*) AS number_of_comments FROM comments WHERE post_id = $postId");
    $countRow = $countResult->fetch_assoc();
    $row["comment_count"] = $countRow["number_of_comments"];

    $posts[] = $row;
    $row = $result->fetch_assoc();
}

echo json_encode([
    "status" => "success",
    "message" => "All blog posts retrieved successfully",
    "data" => $posts
]);