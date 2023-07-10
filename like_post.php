<?php

require_once 'commons/db.php';
session_start();

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // User ID - Assuming this comes from the authenticated user
    $userID = $_SESSION['id'];
    
    // Post ID - Assuming this is provided as a parameter or variable
    $postID = $_GET['post'];
    
    // Check if the user has already liked the post
    $checkLikeQuery = "SELECT * FROM posts_reacts WHERE post = '$postID' AND user = '$userID'";
    $checkLikeResult = $conn->query($checkLikeQuery);
    
    if ($checkLikeResult) {
        if ($checkLikeResult->num_rows > 0) {
            // User has already liked the post, so remove the like
            $deleteLikeQuery = "DELETE FROM posts_reacts WHERE post = '$postID' AND user = '$userID'";
            $deleteLikeResult = $conn->query($deleteLikeQuery);
    
            if ($deleteLikeResult) {
                $response = [
                    "status" => "success",
                    "isLiked" => false,
                    "code" => 200,
                    "message" => "Like removed successfully"
                ];
            } else {
                $response = [
                    "status" => "error",
                    "code" => 400,
                    "message" => "Error removing like: " . $conn->error
                ];
            }
        } else {
            // User has not liked the post, so add the like
            $addLikeQuery = "INSERT INTO posts_reacts (post, user) VALUES ('$postID', '$userID')";
            $addLikeResult = $conn->query($addLikeQuery);
    
            if ($addLikeResult) {
                $response = [
                    "status" => "success",
                    "isLiked" => true,
                    "code" => 200,
                    "message" => "Like added successfully"
                ];
            } else {
                $response = [
                    "status" => "error",
                    "code" => 400,
                    "message" => "Error adding like: " . $conn->error
                ];
            }
        }
    } else {
        $response = [
            "status" => "error",
            "code" => 400,
            "message" => "Error checking like: " . $conn->error
        ];
    }
    // Send JSON response
    http_response_code($response['code']);
    echo json_encode($response);
}

?>