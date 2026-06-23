<?php session_start(); 
  if (isset($_SESSION['fullname'])) {
    $rawName = htmlspecialchars($_SESSION['fullname']);
    $userName = ucfirst($rawName);
} else {
    $userName = 'Guest';
}
?>
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

<div class=" container-fluid app-view p-0" id="app-page">
    <div class="row">
        <aside class="col-md-2 sidebar">
            <div class="sidebar-logo">
                <div class="logo-mark" style="cursor:pointer">🎵</div>
                <span class="logo-text">AURA</span>
                <span class="logo-beta">BETA</span>
            </div>

            <div class="sidebar-search">
                <div class="search-input-wrap">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    <input placeholder="Quick search...">
                </div>
            </div>
            <?php $page = $_GET['page'] ?? 'home'; ?>
            <div class="sidebar-section">
                <div class="sidebar-section-label">Menu</div>
                <a href="?page=home" class="nav-item <?= $page=='home' ? 'active' : '' ?>">
                <svg class="nav-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Home
                </a>

                <a href="?page=search" class="nav-item <?= $page=='search' ? 'active' : '' ?>">
                <svg class="nav-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    Discover
                </a>

                <a href="?page=ai" class="nav-item <?= $page=='ai' ? 'active' : '' ?>">
                <svg class="nav-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a10 10 0 1 0 10 10"/><path d="M12 6v6l4 2"/></svg>
                    AI Studio
                    <span class="nav-badge">NEW</span>
                </a>

                <a href="?page=pricing" class="nav-item <?= $page=='pricing' ? 'active' : '' ?>">
                <svg class="nav-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                Premium
                </a>
            </div>

            <div class="sidebar-section" style="margin-top:8px">
                <div class="sidebar-section-label">Library</div>
                <a href="?page=profile" class="nav-item <?= $page=='profile' ? 'active' : '' ?>">
                <svg class="nav-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Profile
                </a>

                <a href="?page=notifications" class="nav-item <?= $page=='notifications' ? 'active' : '' ?>">
                <svg class="nav-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                Notifications
                <span class="nav-badge">5</span>
                </a>
                <a href="?page=settings" class="nav-item <?= $page=='settings' ? 'active' : '' ?>">
                <svg class="nav-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                Settings
                </a>
            </div>

            <div class="sidebar-section" style="margin-top:8px">
                <div class="sidebar-section-label" style="display:flex;align-items:center;justify-content:space-between;padding-right:8px">
                    Playlists
                    <button style="color:var(--c-accent);font-size:18px;line-height:1;padding:0 8px;font-weight:300">+</button>
                </div>
            </div>

            <div class="sidebar-playlist-list">
                <div class="playlist-item">
                    <div class="playlist-thumb-gradient grad-purple" style="border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:16px">🌙</div>
                    <div class="playlist-info"><div class="playlist-name">Late Night Drives</div><div class="playlist-meta">42 songs · Your playlist</div></div>
                </div>
                <div class="playlist-item">
                    <div class="playlist-thumb-gradient grad-teal" style="border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:16px">⚡</div>
                    <div class="playlist-info"><div class="playlist-name">Workout Beast Mode</div><div class="playlist-meta">28 songs · Your playlist</div></div>
                </div>
                <div class="playlist-item">
                    <div class="playlist-thumb-gradient grad-rose" style="border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:16px">☕</div>
                    <div class="playlist-info"><div class="playlist-name">Morning Coffee Vibes</div><div class="playlist-meta">35 songs · Your playlist</div></div>
                </div>
                <div class="playlist-item">
                    <div class="playlist-thumb-gradient grad-amber" style="border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:16px">🎉</div>
                    <div class="playlist-info"><div class="playlist-name">Party Bangers 2026</div><div class="playlist-meta">67 songs · Collaborative</div></div>
                </div>
                <div class="playlist-item">
                    <div class="playlist-thumb-gradient grad-blue" style="border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:16px">🎹</div>
                    <div class="playlist-info"><div class="playlist-name">Study Focus Deep</div><div class="playlist-meta">19 songs · Your playlist</div></div>
                </div>
            </div>

            <div class="sidebar-user">
                <div class="user-avatar">
                    <?php
                        // Get initials: first letter of each word in user's name, up to two initials
                        $initials = '';
                        if (!empty($userName)) {
                            $nameParts = explode(' ', trim($userName));
                            // Get first letter of first two words
                            foreach (array_slice($nameParts, 0, 2) as $part) {
                                if (!empty($part)) {
                                    $initials .= strtoupper(mb_substr($part, 0, 1));
                                }
                            }
                        }
                        echo htmlspecialchars($initials ?: 'G');
                    ?>
                </div>
     
                <div style="overflow:hidden;flex:1">
                    <div class="user-name"><?php echo "$userName" ?></div>
                    <div class="user-plan">✦ PREMIUM</div>
                </div>
                <button class="user-settings-btn" onclick="loadPage('settings', this)">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                </button>
            </div>
        </aside>
        <main class="col-md-10 main-content p-0">

            <?php

            $page = $_GET['page'] ?? 'home.php';

            switch($page){

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

        </main>

    
    </div>

    <div class="player-bar" id="player-bar">
    <!-- TRACK INFO -->
    <div class="player-track">
      <div class="player-thumb" id="player-thumb">🌊</div>
      <div class="player-track-info">
        <div class="player-track-name" id="player-track-name">Neon Dreams</div>
        <div class="player-track-artist" id="player-track-artist">Luna Waves</div>
      </div>
      <button class="player-love" id="love-btn" onclick="this.classList.toggle('active')" style="margin-left:12px">♥</button>
    </div>

    <!-- CONTROLS -->
    <div class="player-controls">
      <div class="player-btns">
        <button class="player-btn active tooltip-wrap" title="Shuffle">
          <span class="tooltip">Shuffle</span>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 3 21 3 21 8"/><line x1="4" y1="20" x2="21" y2="3"/><polyline points="21 16 21 21 16 21"/><line x1="4" y1="4" x2="9" y2="9"/></svg>
        </button>
        <button class="player-btn">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><polygon points="19 20 9 12 19 4 19 20"/><line x1="5" y1="19" x2="5" y2="5" stroke="currentColor" stroke-width="2"/></svg>
        </button>
        <button class="player-btn-play" id="play-btn" onclick="togglePlay()">
          <span id="play-icon">▶</span>
        </button>
        <button class="player-btn">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 4 15 12 5 20 5 4"/><line x1="19" y1="5" x2="19" y2="19" stroke="currentColor" stroke-width="2"/></svg>
        </button>
        <button class="player-btn tooltip-wrap" title="Repeat">
          <span class="tooltip">Repeat</span>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg>
        </button>
      </div>
      <div class="player-progress">
        <span class="player-time">1:42</span>
        <div class="progress-track" onclick="seekTrack(event,this)">
          <div class="progress-fill" id="progress-fill"></div>
        </div>
        <span class="player-time">3:58</span>
      </div>
    </div>

    <!-- EXTRAS -->
    <div class="player-extras">
      <button class="player-btn tooltip-wrap" title="Lyrics">
        <span class="tooltip">Lyrics</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
      </button>
      <button class="player-btn tooltip-wrap" title="Queue">
        <span class="tooltip">Queue</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
      </button>
      <div class="volume-wrap">
        <button class="player-btn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"/></svg>
        </button>
        <div class="volume-slider" onclick="setVolume(event,this)">
          <div class="volume-fill" id="vol-fill"></div>
        </div>
      </div>
      <button class="player-btn tooltip-wrap" title="Full Screen">
        <span class="tooltip">Expand</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
      </button>
    </div>
  </div>
</div>
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/script.js"></script>

