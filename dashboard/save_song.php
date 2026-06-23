<?php
require_once "../backend/config.php";

// Turn on basic error reporting (optional: remove in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Upload directory
    $uploadDir = __DIR__ . '/uploads/music/';

    echo "<pre>";
    echo "Path: " . $uploadDir . "\n";
    echo "Exists: " . (file_exists($uploadDir) ? 'YES' : 'NO') . "\n";
    echo "Writable: " . (is_writable($uploadDir) ? 'YES' : 'NO') . "\n";
    echo "</pre>";

    // Ensure upload dir exists and is writable
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            die("Upload directory is not writable.");
        }
    }
    if (!is_writable($uploadDir)) {
        die("Upload directory is not writable.");
    }

    // Check file upload
    if (!isset($_FILES['music_file']) || $_FILES['music_file']['error'] != 0) {
        die("Please select a music file.");
    }

    $allowed = ['mp3', 'wav', 'flac', 'aac', 'ogg'];

    $fileName = $_FILES['music_file']['name'];
    $fileTmp  = $_FILES['music_file']['tmp_name'];
    $fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($fileExt, $allowed)) {
        die("Invalid file format.");
    }

    // Generate unique filename
    $newFileName = time() . "_" . uniqid() . "." . $fileExt;
    $filePath = $uploadDir . $newFileName;

    if (!move_uploaded_file($fileTmp, $filePath)) {
        die("File upload failed.");
    }

    // Form data
    $title = isset($_POST['title']) ? mysqli_real_escape_string($conn, $_POST['title']) : '';
    $artist = isset($_POST['artist']) ? mysqli_real_escape_string($conn, $_POST['artist']) : '';
    $album = isset($_POST['album']) ? mysqli_real_escape_string($conn, $_POST['album']) : '';
    $duration = isset($_POST['duration']) ? mysqli_real_escape_string($conn, $_POST['duration']) : '';
    $genre = isset($_POST['genre']) ? mysqli_real_escape_string($conn, $_POST['genre']) : '';
    $release_date = isset($_POST['release_date']) ? $_POST['release_date'] : 'NULL';
    $popularity = isset($_POST['popularity']) ? (int)$_POST['popularity'] : 0;
    $category_id = isset($_POST['category_id']) ? (int)$_POST['category_id'] : 0;

    $featured_song = isset($_POST['featured_song']) ? 1 : 0;
    $trending_song = isset($_POST['trending_song']) ? 1 : 0;
    $new_release = isset($_POST['new_release']) ? 1 : 0;

    $status = isset($_POST['status']) ? mysqli_real_escape_string($conn, $_POST['status']) : 'published';

    // Insert into database
    $sql = "INSERT INTO songs (
                title,
                artist,
                album,
                duration,
                genre,
                release_date,
                popularity,
                category_id,
                featured_song,
                trending_song,
                new_release,
                status,
                file_path
            ) VALUES (
                '$title',
                '$artist',
                '$album',
                '$duration',
                '$genre',
                '$release_date',
                '$popularity',
                '$category_id',
                '$featured_song',
                '$trending_song',
                '$new_release',
                '$status',
                '$filePath'
            )";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Song uploaded successfully!');
                window.location.href='dashboard.php';
              </script>";
        exit;
    } else {
        echo "Database Error: " . mysqli_error($conn);
        exit;
    }
}
?>