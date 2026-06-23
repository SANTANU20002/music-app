<?php

require_once __DIR__ . "/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validation
    if (empty($fullname) || empty($email) || empty($password)) {
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email address.");
    }

    if (strlen($password) < 8) {
        die("Password must be at least 8 characters.");
    }

    // Check email exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();

    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "
        <script>
            alert('Email already exists');
            window.history.back();
        </script>";
        exit;
    }

    $hashedPassword = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    $stmt = $conn->prepare("
        INSERT INTO users
        (fullname,email,password)
        VALUES (?,?,?)
    ");

    $stmt->bind_param(
        "sss",
        $fullname,
        $email,
        $hashedPassword
    );

    if ($stmt->execute()) {

        echo "
        <script>
            alert('Registration Successful');
            window.location.href='../pages/authPage.php';
        </script>";

    } else {

        echo "
        <script>
            alert('Database Error: ".$stmt->error."');
            window.history.back();
        </script>";

    }

    $stmt->close();
    $check->close();
}

$conn->close();

?>