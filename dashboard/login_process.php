<?php

require_once "../backend/config.php";

// Start a session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if (empty($email) || empty($password)) {
    echo "
    <script>
    alert('Email and Password are required');
    history.back();
    </script>
    ";
    exit();
}

$stmt = $conn->prepare("
SELECT *
FROM admins
WHERE email=?
");

$stmt->bind_param("s", $email);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "
    <script>
    alert('Email Not Found');
    history.back();
    </script>
    ";
    exit();
}

$admin = $result->fetch_assoc();

if (md5($password) === $admin['password']) {

    // Ensure session is started and regenerate ID before setting session vars
    session_regenerate_id(true);

    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['admin_name'] = $admin['fullname'];
    $_SESSION['admin_email'] = $admin['email'];
    $_SESSION['admin_role'] = $admin['role'];

    $update = $conn->prepare("
    UPDATE admins
    SET last_login=NOW()
    WHERE id=?
    ");

    $update->bind_param("i", $admin['id']);

    $update->execute();
    header("Location: dashboard.php");
    exit();

} else {
    echo "
    <script>
    alert('Invalid Password');
    history.back();
    </script>
    ";
    exit();
}