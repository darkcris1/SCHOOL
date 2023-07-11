<?php 

require 'commons/db.php';
header('Content-Type: application/json');
session_start();

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a post ID is provided
    if (!isset($_POST["post_id"])) {
        $response = [
            "status" => "error",
            "code" => 400,
            "message" => "Post ID not provided."
        ];
        http_response_code($response['code']);
        echo json_encode($response);
        return;
    }

    // Get the post ID from the request
    $post_id = $_POST["post_id"];

    // Check if the post exists
    $checkPostQuery = "SELECT * FROM posts WHERE id = '$post_id'";
    $checkPostResult = $conn->query($checkPostQuery);

    if ($checkPostResult->num_rows == 0) {
        $response = [
            "status" => "error",
            "code" => 404,
            "message" => "Post not found."
        ];
        http_response_code($response['code']);
        echo json_encode($response);
        return;
    }

    // File details
    $targetDir = 'uploads/';
    $caption = $_POST["caption"];
    $type = $_POST["type"];

    // Check if a new image file is provided
    if (isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Check file size
        if ($_FILES["image"]["size"] > 5000000) {
            // File upload error
            $response = [
                "status" => "error",
                "code" => 400,
                "message" => "Sorry, the file was too large."
            ];
            http_response_code($response['code']);
            echo json_encode($response);
            return;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            // File upload error
            $response = [
                "status" => "error",
                "code" => 400,
                "message" => "Post accepts only jpg, png, jpeg or gif."
            ];
            http_response_code($response['code']);
            echo json_encode($response);
            return;
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // File upload success
            $response = [
                "status" => "success",
                "code" => 200,
                "message" => "File uploaded successfully."
            ];

            // Update file details in the database
            $updateQuery = "UPDATE posts SET image = '$fileName', caption = '$caption', type = '$type' WHERE id = '$post_id'";

            if ($conn->query($updateQuery) === true) {
                $response["database"] = "Post details updated in the database.";
            } else {
                $response["code"] = 400;
                $response["database"] = "Error updating the post.";
            }
        } else {
            // File upload error
            $response = [
                "status" => "error",
                "code" => 400,
                "message" => "Sorry, there was an error uploading your file."
            ];
        }
    } else {
        // No new image file provided, update caption and type only
        $updateQuery = "UPDATE posts SET caption = '$caption', type = '$type' WHERE id = '$post_id'";

        if ($conn->query($updateQuery) === true) {
            $response = [
                "status" => "success",
                "code" => 200,
                "message" => "Post details updated successfully.",
                "database" => "Post details updated in the database."
            ];
        } else {
            $response = [
                "status" => "error",
                "code" => 400,
                "message" => "Error updating the post.",
                "database" => "Error updating the post."
            ];
        }
    }

    // Send JSON response
    http_response_code($response['code']);
    echo json_encode($response);
}


?>