<?php
// Include config file
require_once "commons/db.php";
require "commons/validators.php";
$firstError = null;

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // File details
    $targetDir = 'uploads/';
    $fileName = basename($_FILES["photo"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Check file size
    if ($_FILES["photo"]["size"] > 5000000) {
        $firstError = "Sorry, the file was too large";
        return;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        // File upload error
        $firstError = "Post accepts only jpg, png, jpeg or gif";
        return;
    }
    // Assuming you have received POST data
    $data = $_POST;

    // Create an instance of the validator
    $validator = new Validator($data);

    // Perform validation
    $validator->validateRequired('first_name');
    $validator->validateRequired('last_name');
    $validator->validateEmailRegex('email');
    $validator->validateRequired('password');
    $validator->validateMinLength('password', 8);
    // $asd= $validator->isValid();
    // $err= $validator->getErrors();
    // echo json_encode($asd);
    // echo json_encode($data);
    // echo json_encode($err);
    // Check if the data is valid
    if ($validator->isValid() && move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
        // Data is valid, proceed with further processing
        // Example: Insert the data into the database
        $firstName = $data['first_name'];
        $lastName = $data['last_name'];
        $email = $data['email'];
        $password = $data['password'];

        // Perform database insert or other actions
        // Prepare an insert statement
        // Prepare the SQL insert statement
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, photo) VALUES (?, ?, ?, ?, ?)");
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sssss", $firstName, $lastName, $email, $password, $fileName);

        // Execute the insert statement
        if ($stmt->execute()) {
            // Data inserted successfully
            header('Location: login.php?success=1');
        } else {
            $firstError = 'Oops! Something went wrong. Please try again later.';
        }
    } else {
        // Validation errors occurred, handle them
        $errors = $validator->getErrors();
        // Display errors to the user or take appropriate action
        $firstError = reset($errors);
    }
} else {
    include "commons/redirect_if_auth.php";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'components/default-head.php' ?>
    <title>Register</title>
    <style>
        html,
        body {
            height: 100%;
        }

        .form-signin {
            max-width: 330px;
            padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
    </style>
</head>

<body>
    <?php include 'components/header.php' ?>
    <main class="form-signin w-100 m-auto">
        <form 
            x-data="imageViewer"
            action="register.php" method="POST" enctype="multipart/form-data">
            <h1 class="h3 mb-3 fw-normal">Register</h1>
            <?php if ($firstError): ?>
                <div class="alert alert-danger">
                    <?php
                    echo $firstError;
                    ?>
                </div>
            <?php endif; ?>


            <template x-if="imageUrl">
                <div class="d-flex align-items-center justify-content-center">
                    <img :src="imageUrl" class="object-cover rounded-circle border"
                        style="width: 100px; height: 100px;">
                </div>
            </template>
            <div 
                class="form-floating">
                <input 
                    type="file" 
                    accept="image/png,image/jpg,image/jpeg,image/webp"
                    required
                    name="photo" 
                    @change="fileChosen"
                    class="form-control" id="floatingInput">
                <label for="floatingInput">Photo</label>
            </div>
            <div class="form-floating">
                <input 
                    value="<?php echo $data['first_name']?>"
                    required
                    type="text" name="first_name" class="form-control" id="floatingInput" placeholder="Juan">
                <label for="floatingInput">First Name</label>
            </div>
            <div class="form-floating">
                <input 
                    value="<?php echo $data['last_name']?>"
                    required
                    type="last_name" name="last_name" class="form-control" id="floatingInput"
                    placeholder="Dela Cruz">
                <label for="floatingInput">Last Name</label>
            </div>

            <div class="form-floating">
                <input 
                    value="<?php echo $data['email']?>"
                    required
                    type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input 
                    required
                    type="password" class="form-control" name="password" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Submit</button>
        </form>
    </main>

    <script>
        function imageViewer() {
            return {
                imageUrl: '',
                fileChosen(event) {
                    this.fileToDataUrl(event, src => this.imageUrl = src)
                },
                fileToDataUrl(event, callback) {
                    if (!event.target.files.length) return

                    let file = event.target.files[0],
                        reader = new FileReader()
                    reader.readAsDataURL(file)
                    reader.onload = e => callback(e.target.result)
                },
            }
        }
    </script>
</body>

</html>