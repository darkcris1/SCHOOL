<?php
// Include config file
session_start();
require "commons/db.php";
require "commons/validators.php";
$firstError = null;

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have received POST data
    $data = $_POST;

    // Create an instance of the validator
    $validator = new Validator($data);
    $validator->validateRequired('email');
    $validator->validateEmailRegex('email');
    $validator->validateRequired('password');


    // Check if the data is valid
    if ($validator->isValid()) {
        // Data is valid, proceed with further processing
        // Example: Insert the data into the database
        $email = $data['email'];
        $password = $data['password'];

        // Perform database insert or other actions
        // Prepare an insert statement
        // Prepare the SQL insert statement
        // Check user is exist in the database
        // Check if the username and password are valid
        // Example: Fetch the user from the database based on the username
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $row["password"])) {
                // Login successful, redirect to a protected page
                $_SESSION["id"] = $row['id'];
                $_SESSION["email"] = $row['email'];
                $_SESSION["first_name"] = $row['first_name'];
                $_SESSION["last_name"] = $row['last_name'];
                $_SESSION["displayName"] = $row['first_name'] . ' ' . $row['last_name'];
                $_SESSION["isAuth"] = true;
                header("Location: newsfeed.php");
                exit();
            } else {
                $firstError = "Invalid username or password.";
            }
        } else {
            $firstError = "Invalid username or password.";
        }
    } else {
        // Validation errors occurred, handle them
        $errors = $validator->getErrors();
        // Display errors to the user or take appropriate action
        $firstError = reset($errors);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'components/default-head.php' ?>
    <title>Login</title>
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
    </style>
</head>

<body>
    <?php include 'components/header.php' ?>
    <main class="form-signin w-100 m-auto">
        <form action="" method="POST">
            <h1 class="h3 mb-3 fw-normal">Sign in</h1>

            <?php if ($_GET['success']): ?>
                <div class="alert alert-success alert-dismissible">
                    Successfully registered
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <?php if ($firstError): ?>
                <div class="alert alert-danger">
                    <?= $firstError ?>
                </div>
            <?php endif; ?>

            <div class="form-floating">
                <input value="<?= $data['email'] ?>" type="email" name="email" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Sign in</button>
            <div class="mt-3">
                <a href="/register.php">Don't have an account yet?</a>
            </div>
        </form>
    </main>

</body>

</html>