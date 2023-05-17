<?php
    require 'database.php';
?>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contacts (name, email, message)
VALUES ('$name', '$email', '$message')";
    

    if (mysqli_query($con, $sql)) {
        echo "<script> alert('Created successfully') </script>";
        header('Location: '.$_SERVER["PHP_SELF"], true, 303);
      } else {
        echo "<script> alert('Error upon saving') </script>";
        header('Location: '.$_SERVER["PHP_SELF"], true, 303);
      }
  }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divider Template</title>

    <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./bootstrap.min.css">
</head>

<body style="padding-top: 80px;">

    <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
        <div class="container">
            <a href="./index.php" class="navbar-brand">
                YesSir
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-md-auto">
                    <li class="nav-item">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <form action="contact.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Message</label>
                <textarea
                    name="message"
                    class="form-control"
                    ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Message</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                // printing column name above the data
                $sql = "SELECT * FROM `contacts`";
                // sql query to fetch all the data
                // mysql_query will execute the query to fetch data
                $result = mysqli_query($con, $sql);
                // LOOP TILL END OF DATA
                while ($rows = $result->fetch_assoc()) {
                ?>
                <?php $rows['id'] ?>
                    <tr>
                        <th scope="row"><?php echo $rows['id']; ?> </th>
                        <td><?php echo $rows['name']; ?></td>
                        <td><?php echo $rows['email']; ?></td>
                        <td><?php echo $rows['message']; ?></td>
                        <td>
                            <a class="btn btn-primary" href="edit_contact.php?id=<?php echo $rows['id']; ?>">Edit</a>
                            <a class="btn btn-danger" href="delete_contact.php?id=<?php echo $rows['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>

    <footer class="d-flex align-items-center justify-content-center mt-auto">
        Copyright 2023
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>