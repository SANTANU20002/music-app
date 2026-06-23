<?php
// save_category.php

require_once "../backend/config.php";

// Debugging: display errors in development (disable in production)
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

// The field in the form (dashboard.php) seems to post category_name, slug, icon, accent_color.
// Make sure the form in dashboard.php uses <input type="hidden" name="save_category" value="1">
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Not a POST request
    header("Location: dashboard.php?error=invalid_request");
    exit;
}

// No save_category check here because the posted form (from dashboard.php) does not set save_category, the action just goes to save_category.php

// Make sure $conn (mysqli) is used, based on config.php and the rest of dashboard code
if (!isset($conn) || !$conn instanceof mysqli) {
    echo "Database connection error.";
    exit;
}

// Get and sanitize the POST variables
$category_name = isset($_POST['category_name']) ? trim($_POST['category_name']) : '';
$slug = isset($_POST['slug']) ? trim($_POST['slug']) : '';
$icon = isset($_POST['icon']) ? trim($_POST['icon']) : 'fa-moon';
$accent_color = isset($_POST['accent_color']) ? trim($_POST['accent_color']) : '#1DB954';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';
$status = (isset($_POST['status']) && in_array($_POST['status'], ['published','draft'])) ? $_POST['status'] : 'draft';
$featured = isset($_POST['featured']) ? 1 : 0;

// Basic validation
if (empty($category_name) || empty($slug)) {
    header("Location: dashboard.php?error=missing_fields");
    exit;
}

// Check if slug already exists in categories
$stmt = $conn->prepare("SELECT id FROM music_categories WHERE slug = ?");
if (!$stmt) {
    header("Location: dashboard.php?error=prep_error1");
    exit;
}
$stmt->bind_param("s", $slug);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->close();
    header("Location: dashboard.php?error=slug_exists");
    exit;
}
$stmt->close();

// Insert new category
$stmt = $conn->prepare("INSERT INTO music_categories (c_name, slug, icon, accent_color, description, status, featured, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
if (!$stmt) {
    header("Location: dashboard.php?error=prep_error2");
    exit;
}

$stmt->bind_param(
    "ssssssi",
    $category_name,
    $slug,
    $icon,
    $accent_color,
    $description,
    $status,
    $featured
);

if ($stmt->execute()) {
    $newId = $stmt->insert_id;
    $stmt->close();
    header("Location: dashboard.php?success=1&category_id=$newId");
    exit;
} else {
    $stmt->close();
    header("Location: dashboard.php?error=database_error");
    exit;
}
?>