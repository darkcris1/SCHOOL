<?php
    require 'database.php';
?>
<?php 
    // collect value of input field
    $contactId = $_GET['id'];
 
    // sql to delete a record
    $sql = "DELETE FROM contacts WHERE id=$contactId";

    if (mysqli_query($con,$sql)) {
        echo "<script> alert('Deleted the contact successfully') </script>";

    } else {
        echo "<script> alert('error on deleteting the contact') </script>";
    }

    header("location: contact.php")
?>