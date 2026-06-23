<?php

$page = $_GET['page'] ?? 'home';

$allowedPages = [
    'home',
    'search',
    'ai',
    'pricing',
    'profile',
    'notifications',
    'settings'
];

if (!in_array($page, $allowedPages)) {
    $page = 'home';
}

switch ($page) {

    case 'home':
        include __DIR__ . '/home.php';
        break;

    case 'search':
        include __DIR__ . '/search.php';
        break;

    case 'ai':
        include __DIR__ . '/Ai.php';
        break;

    case 'pricing':
        include __DIR__ . '/pricing.php';
        break;

    case 'profile':
        include __DIR__ . '/profile.php';
        break;

    case 'notifications':
        include __DIR__ . '/notifications.php';
        break;

    case 'settings':
        include __DIR__ . '/settings.php';
        break;

    default:
        include __DIR__ . '/home.php';
}
?>