<?php
// Include config file
require_once "commons/db.php";
require "commons/validators.php";
$firstError = null;

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    if ($validator->isValid()) {
        // Data is valid, proceed with further processing
        // Example: Insert the data into the database
        $firstName = $data['first_name'];
        $lastName = $data['last_name'];
        $email = $data['email'];
        $password = $data['password'];

        // Perform database insert or other actions
        // Prepare an insert statement
        // Prepare the SQL insert statement
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ssss", $firstName, $lastName, $email, $password);

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
        <form action="" method="POST" enctype="multipart/form-data">
            <h1 class="h3 mb-3 fw-normal">Register</h1>
            <?php if ($firstError): ?>
                <div class="alert alert-danger">
                    <?php
                    echo $firstError;
                    ?>
                </div>
            <?php endif; ?>


            <div class="form-floating">
                <input 
                    value="<?php echo $data['first_name']?>"
                    type="text" name="first_name" class="form-control" id="floatingInput" placeholder="Juan">
                <label for="floatingInput">First Name</label>
            </div>
            <div class="form-floating">
                <input 
                    value="<?php echo $data['last_name']?>"
                    type="last_name" name="last_name" class="form-control" id="floatingInput"
                    placeholder="Dela Cruz">
                <label for="floatingInput">Last Name</label>
            </div>

            <div class="form-floating">
                <input 
                    value="<?php echo $data['email']?>"
                    type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input 
                    type="password" class="form-control" name="password" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Submit</button>
        </form>
    </main>

</body>

</html>