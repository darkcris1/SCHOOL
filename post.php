<?php
require 'commons/db.php';
header('Content-Type: application/json');
session_start();

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // File details
    $targetDir = 'uploads/';
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $caption = $_POST["caption"];
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Check file size
    if ($_FILES["image"]["size"] > 5000000) {
        // File upload error
        $response = [
            "status" => "error",
            "code" => 400,
            "message" => "Sorry, the file was too large"
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
            "message" => "Post accepts only jpg, png, jpeg or gif"
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

        // Insert file details into the database
        $user_id = $_SESSION['id'];
        $sql = "INSERT INTO posts (image, caption, user) VALUES ('$fileName', '$caption','$user_id')";

        if ($conn->query($sql) === true) {
            $response["database"] = "File details saved in the database.";
        } else {
            $response["code"] = 400;
            $response["database"] = "Error on posting";
        }
    } else {
        // File upload error
        $response = [
            "status" => "error",
            "err" => move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath),
            "code" => 400,
            "message" => "Sorry, there was an error uploading your file."
        ];
    }

    // Send JSON response
    http_response_code($response['code']);
    echo json_encode($response);
} else {

    $user_id = $_SESSION['id'];
    // Fetch data from the "post" table with user details
    $sql = "SELECT p.*, u.id AS user_id, u.first_name, u.last_name, u.photo,
    (SELECT COUNT(*) FROM posts_reacts WHERE post = p.id) AS likes_count,
    (SELECT COUNT(*) FROM posts_reacts WHERE post = p.id AND user = '$user_id') AS is_liked
    FROM posts p
    INNER JOIN users u ON p.user = u.id
    ORDER BY p.updated_at DESC";
    $result = $conn->query($sql);

    if ($result) {
        $posts = [];

        // Loop through each row of the result
        while ($row = $result->fetch_assoc()) {
             // Create a separate "user" object within each post
             $user = [
                "first_name" => $row["first_name"],
                "last_name" => $row["last_name"],
                "photo" => $row["photo"],
                "id" => $row["user_id"]
            ];

            // Convert is_liked to boolean
            $row["is_liked"] = boolval($row["is_liked"]);
            $row["likes_count"] = intval($row["likes_count"]);
            // Remove user-related fields from the post row
            unset($row["first_name"], $row["last_name"], $row["photo"]);

            // Add the user object to the post row
            $row["user"] = $user;

            // Add the modified post row to the posts array
            $posts[] = $row;
        }

        $response = [
            "status" => "success",
            "data" => $posts
        ];
    } else {
        $response = [
            "status" => "error",
            "message" => "Error retrieving data: " . $conn->error
        ];
    }
    // Send JSON response
    echo json_encode($response);

}
?>