<?php
$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php';
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $exists = false;

    // Check if username already exists
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $numExistRows = mysqli_num_rows($result);
    
    if ($numExistRows > 0) {
        $exists = true;
        $showError = "Username already taken.";
    }

    // Ensure password fields are not empty
    if (empty($username) || empty($password) || empty($cpassword)) {
        $showError = "Please fill out all fields.";
    } elseif (($password == $cpassword) && !$exists) {
        // Hash the password before inserting into the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `user` (`username`, `password`, `dt`) VALUES ('$username', '$hashedPassword', current_timestamp())";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $showAlert = true;
        } else {
            $showError = "Error in registration, please try again.";
        }
    } else {
        if ($password !== $cpassword) {
            $showError = "Passwords do not match.";
        }
    }
} 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        
        <?php
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your account is now created, and you can log in.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                  </div>';
        }
        if ($showError) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> ' . $showError . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                  </div>';
        }
        ?>
        
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
