<?php

include '_dbconnect.php';  // Include database connection

$username = $_POST["username"];
$password = $_POST["password"];
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username and password are provided
    if (empty($username) || empty($password)) {
        $showError = "Please enter both username and password.";
    } else {
        // Use prepared statement to protect against SQL injection
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Failed to prepare SQL statement: " . $conn->error);  // Debugging DB error
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $num = $result->num_rows;

        if ($num == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // If password matches, set session variables and redirect
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("Location: welcome.php");
                exit;
            } else {
                $showError = "Invalid password.";  // If password doesn't match
            }
        } else {
            $showError = "User does not exist.";  // If username doesn't exist
        }
    }
}
?>

<!-- HTML and Form -->
