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
    $validator->validateRequired('subject');
    $validator->validateRequired('message');
    $validator->validateEmailRegex('email');
    $validator->validateRequired('email');
    // $asd= $validator->isValid();
    // $err= $validator->getErrors();
    // echo json_encode($asd);
    // echo json_encode($data);
    // echo json_encode($err);
    // Check if the data is valid
    if ($validator->isValid()) {
        // Data is valid, proceed with further processing
        // Example: Insert the data into the database
        $email = $data['email'];
        $subject = $data['subject'];
        $message = $data['message'];
        // Perform database insert or other actions
        // Prepare an insert statement
        // Prepare the SQL insert statement
        $stmt = $conn->prepare("INSERT INTO contact (subject, message, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $subject, $message, $email);

        // Execute the insert statement
        if ($stmt->execute()) {
            // Data inserted successfully
            header('Location: contact.php?success=1', true);
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
    <title>Contact</title>
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
            action="" method="POST" enctype="multipart/form-data">
            <h1 class="h3 mb-3 fw-normal">Contact</h1>
            <?php if ($_GET['success'] == 1): ?>
                <div class="alert alert-success">
                  Successfully sent
                </div>
            <?php endif; ?>
            <?php if ($firstError): ?>
                <div class="alert alert-danger">
                    <?php
                    echo $firstError;
                    ?>
                </div>
            <?php endif; ?>
            <div class="form-floating">
                <input 
                    value="<?php echo $data['email'] ?? '' ?>"
                    type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input 
                    value="<?php echo $data['subject']?>"
                    type="text" name="subject" class="form-control" id="floatingInput" placeholder="Juan">
                <label for="floatingInput">Subject</label>
            </div>
            <div class="form-floating">
                <textarea 
                    value="<?php echo $data['message'] ?? '' ?>"
                    class="form-control"
                    name="message" id="" cols="30" rows="6"></textarea>
                <label for="floatingPassword">Message</label>
            </div>
            <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Submit</button>
        </form>
    </main>

    <script>
    </script>
</body>

</html>