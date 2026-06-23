<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require_once('../api/spotify.php');

if (!defined('SPOTIFY_CLIENT_ID')) {
    die(json_encode([
        'success' => false,
        'message' => 'SPOTIFY_CLIENT_ID not found'
    ]));
}


if (!isset($_POST['url']) || empty($_POST['url'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Spotify URL is required'
    ]);
    exit;
}

$url = trim($_POST['url']);

if (!preg_match('/track\/([a-zA-Z0-9]+)/', $url, $matches)) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid Spotify Track URL'
    ]);
    exit;
}

$trackId = $matches[1];


// STEP 1: Get Access Token

$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => 'https://accounts.spotify.com/api/token',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
    CURLOPT_HTTPHEADER => [
        'Authorization: Basic ' .
        base64_encode(
            SPOTIFY_CLIENT_ID .
            ':' .
            SPOTIFY_CLIENT_SECRET
        ),
        'Content-Type: application/x-www-form-urlencoded'
    ]
]);

$tokenResponse = curl_exec($ch);

curl_close($ch);

$tokenData = json_decode($tokenResponse, true);

// echo json_encode($tokenData);
// exit;

if (!isset($tokenData['access_token'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Unable to generate Spotify token'
    ]);
    exit;
}

$accessToken = $tokenData['access_token'];


// STEP 2: Fetch Track

$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => "https://api.spotify.com/v1/tracks/$trackId",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer $accessToken"
    ]
]);

// $response = curl_exec($ch);

// curl_close($ch);

// $track = json_decode($response, true);
$response = curl_exec($ch);

curl_close($ch);

echo $response;
exit;
// echo "<pre>";
// echo "<h1 style="color: red;">hllow</h1>"
// print_r($track);
// echo "</pre>";
// exit;


if (!isset($track['id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Track not found'
    ]);
    exit;
}


// ARTISTS

$artists = [];

foreach ($track['artists'] as $artist) {
    $artists[] = $artist['name'];
}


// DURATION

$seconds = floor($track['duration_ms'] / 1000);

$duration = sprintf(
    "%02d:%02d",
    floor($seconds / 60),
    $seconds % 60
);


echo json_encode([
    'success' => true,

    'spotify_track_id' => $track['id'],

    'title' => $track['name'],

    'artist' => implode(', ', $artists),

    'album' => $track['album']['name'],

    'cover' => $track['album']['images'][0]['url'] ?? '',

    'release_date' => $track['album']['release_date'],

    'duration' => $duration,

    'popularity' => $track['popularity']
]);