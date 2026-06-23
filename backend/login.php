<?php
session_start();
require_once __DIR__ . "/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        die("Email and Password are required.");
    }

    $stmt = $conn->prepare(
        "SELECT id, fullname, email, password
         FROM users
         WHERE email = ?"
    );

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 0) {

        echo "
        <script>
            alert('Email not found');
            window.history.back();
        </script>";
        exit;
    }

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['email'] = $user['email'];
    //     echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";
    // exit;

        echo "
        <script>
            alert('Login Successful');
            
        </script>";
        header("Location: ../pages/musi_dashboard.php?page=home");

    } else {

        echo "
        <script>
            alert('Invalid Password');
            window.history.back();
        </script>";

    }

    $stmt->close();
}

$conn->close();
?>