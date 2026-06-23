<?php
session_start();

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="page active" id="page-home">
      <div style="display:flex;align-items:center;justify-content:space-between;padding:20px 32px 0;gap:12px;flex-wrap:wrap">
        <div>
          <?php
            // Make day and date dynamic
            date_default_timezone_set('UTC'); // Change timezone as needed
            $currentDay = strtoupper(date('l'));
            $currentMonth = strtoupper(date('F'));
            $currentYear = date('Y');
            $currentDate = date('j');
            echo "<div style=\"font-family:var(--font-mono);font-size:11px;color:var(--c-text3);margin-bottom:4px\">{$currentDay}, {$currentMonth} {$currentDate}</div>";
          ?>
  
          <?php
            // Set user name
            if (isset($_SESSION['fullname'])) {
                $rawName = htmlspecialchars($_SESSION['fullname']);
                $userName = ucfirst($rawName);
            } else {
                $userName = 'Guest';
            }
       

            // Set greeting based on the hour
            date_default_timezone_set('Asia/Kolkata');

            $hour = (int) date('H');
            
            if ($hour >= 5 && $hour < 12) {
                $greeting = "Good morning";
                $emoji = "🌅";
            } elseif ($hour >= 12 && $hour < 18) {
                $greeting = "Good afternoon";
                $emoji = "🌞";
            } elseif ($hour >= 18 && $hour < 22) {
                $greeting = "Good evening";
                $emoji = "🌙";
            } else {
                $greeting = "Good night";
                $emoji = "💤";
            }
          ?>
          <h1 style="font-family:var(--font-display);font-size:28px;font-weight:800;letter-spacing:-0.5px; color: #ebebeb;">
            <?php echo "{$greeting}, {$userName} {$emoji}"; ?>
          </h1>
        </div>
        <div style="display:flex;gap:8px;align-items:center">
          <button class="btn btn-primary" style="font-size:13px">✦ Upgrade</button>
          <button class="logout_button"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
        </div>
      </div>

      <!-- QUICK PICKS -->
      <div style="padding:16px 32px;display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:10px">
        <div style="background:var(--c-surface);border:1px solid var(--c-border);border-radius:var(--r-md);display:flex;align-items:center;gap:12px;overflow:hidden;cursor:pointer;transition:all var(--trans-fast)" onmouseover="this.style.background='var(--c-surface2)'" onmouseout="this.style.background='var(--c-surface)'">
          <div style="width:52px;height:52px;background:var(--c-grad1);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:22px">🌙</div>
          <span style="font-size:13px;font-weight600; color: #ebebeb;">Late Night Drives</span>
        </div>
        <div style="background:var(--c-surface);border:1px solid var(--c-border);border-radius:var(--r-md);display:flex;align-items:center;gap:12px;overflow:hidden;cursor:pointer;transition:all var(--trans-fast)" onmouseover="this.style.background='var(--c-surface2)'" onmouseout="this.style.background='var(--c-surface)'">
          <div style="width:52px;height:52px;background:linear-gradient(135deg,#06d6a0,#0891b2);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:22px">⚡</div>
          <span style="font-size:13px;font-weight:600; color: #ebebeb;">Workout Beast Mode</span>
        </div>
        <div style="background:var(--c-surface);border:1px solid var(--c-border);border-radius:var(--r-md);display:flex;align-items:center;gap:12px;overflow:hidden;cursor:pointer;transition:all var(--trans-fast)" onmouseover="this.style.background='var(--c-surface2)'" onmouseout="this.style.background='var(--c-surface)'">
          <div style="width:52px;height:52px;background:linear-gradient(135deg,#f43f5e,#ec4899);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:22px">❤️</div>
          <span style="font-size:13px;font-weight:600; color: #ebebeb;">Liked Songs</span>
        </div>
        <div style="background:var(--c-surface);border:1px solid var(--c-border);border-radius:var(--r-md);display:flex;align-items:center;gap:12px;overflow:hidden;cursor:pointer;transition:all var(--trans-fast)" onmouseover="this.style.background='var(--c-surface2)'" onmouseout="this.style.background='var(--c-surface)'">
          <div style="width:52px;height:52px;background:linear-gradient(135deg,#f59e0b,#ef4444);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:22px">🎉</div>
          <span style="font-size:13px;font-weight:600; color: #ebebeb;">Party Bangers 2026</span>
        </div>
      </div>

      <!-- HERO FEATURED -->
      <div class="home-hero">
        <div class="hero-bg"></div>
        <div class="hero-bg-orb"></div>
        <div class="hero-bg-orb2"></div>
        <div class="hero-content">
          <div class="hero-eyebrow">
            <span class="hero-eyebrow-dot"></span>
            Featured Artist of the Week
          </div>
          <h2 class="hero-title">Luna <span>Waves</span></h2>
          <p class="hero-desc">Indie-electronic sensation dominating charts worldwide. Her new album "Neon Dreams" drops this Friday.</p>
          <div class="hero-actions">
            <button class="btn btn-primary" onclick="togglePlay()">▶ Play Now</button>
            <button class="btn" style="background:rgba(255,255,255,0.1);color:#fff;border:1px solid rgba(255,255,255,0.2);backdrop-filter:blur(10px)">+ Follow Artist</button>
          </div>
          <div class="hero-stats">
            <div><div class="hero-stat-val">24.8M</div><div class="hero-stat-label">Monthly Listeners</div></div>
            <div><div class="hero-stat-val">142</div><div class="hero-stat-label">Songs</div></div>
            <div><div class="hero-stat-val">89</div><div class="hero-stat-label">Countries</div></div>
          </div>
        </div>
        <div class="hero-featured-card">
          <div class="hero-album-art">🌊</div>
          <div class="hero-now-playing">
            <div class="now-playing-bars">
              <div class="now-playing-bar"></div>
              <div class="now-playing-bar"></div>
              <div class="now-playing-bar"></div>
              <div class="now-playing-bar"></div>
              <div class="now-playing-bar"></div>
            </div>
            <div class="now-playing-info">
              <div class="now-playing-song">Neon Dreams</div>
              <div class="now-playing-artist">Luna Waves</div>
            </div>
          </div>
        </div>
      </div>

      <!-- TRENDING NOW -->
      <div class="section-header">
        <div class="section-title">🔥 Trending Now</div>
        <a class="section-link">See all</a>
      </div>
      <div class="trending-list">
        <div class="trending-item-wrap">
          <div class="trending-item">
            <div style="width:24px;position:relative">
              <span class="trending-num">1</span>
              <button class="trending-play">▶</button>
            </div>
            <div class="trending-thumb grad-purple" style="border-radius:var(--r-sm);overflow:hidden">🌊</div>
            <div class="trending-info"><div class="trending-title">Neon Dreams</div><div class="trending-artist">Luna Waves · Neon Dreams</div></div>
            <div class="trending-right"><span class="trending-duration">3:58</span><button class="trending-like" onclick="this.classList.toggle('liked')">♥</button></div>
          </div>
        </div>
        <div class="trending-item-wrap">
          <div class="trending-item">
            <div style="width:24px;position:relative"><span class="trending-num">2</span><button class="trending-play">▶</button></div>
            <div class="trending-thumb grad-rose" style="border-radius:var(--r-sm)">🔥</div>
            <div class="trending-info"><div class="trending-title">Electric Soul</div><div class="trending-artist">NOVA · Electric Soul EP</div></div>
            <div class="trending-right"><span class="trending-duration">4:22</span><button class="trending-like" onclick="this.classList.toggle('liked')">♥</button></div>
          </div>
        </div>
        <div class="trending-item-wrap">
          <div class="trending-item">
            <div style="width:24px;position:relative"><span class="trending-num">3</span><button class="trending-play">▶</button></div>
            <div class="trending-thumb grad-teal" style="border-radius:var(--r-sm)">🌿</div>
            <div class="trending-info"><div class="trending-title">Forest Radio</div><div class="trending-artist">The Wanderers · Earth Songs</div></div>
            <div class="trending-right"><span class="trending-duration">5:01</span><button class="trending-like liked" onclick="this.classList.toggle('liked')">♥</button></div>
          </div>
        </div>
        <div class="trending-item-wrap">
          <div class="trending-item">
            <div style="width:24px;position:relative"><span class="trending-num">4</span><button class="trending-play">▶</button></div>
            <div class="trending-thumb grad-amber" style="border-radius:var(--r-sm)">⭐</div>
            <div class="trending-info"><div class="trending-title">Golden Hour</div><div class="trending-artist">Asha Ray · Solstice</div></div>
            <div class="trending-right"><span class="trending-duration">3:44</span><button class="trending-like" onclick="this.classList.toggle('liked')">♥</button></div>
          </div>
        </div>
        <div class="trending-item-wrap">
          <div class="trending-item">
            <div style="width:24px;position:relative"><span class="trending-num">5</span><button class="trending-play">▶</button></div>
            <div class="trending-thumb grad-blue" style="border-radius:var(--r-sm)">🌀</div>
            <div class="trending-info"><div class="trending-title">Spiral Galaxy</div><div class="trending-artist">Cosmos Band · Infinite</div></div>
            <div class="trending-right"><span class="trending-duration">6:12</span><button class="trending-like" onclick="this.classList.toggle('liked')">♥</button></div>
          </div>
        </div>
      </div>

      <!-- NEW RELEASES -->
      <div class="section-header">
        <div class="section-title">✨ New Releases</div>
        <a class="section-link">See all</a>
      </div>
      <div class="scroll-row">
        <div class="music-card">
          <div class="card-art grad-purple"><div class="card-play-btn">▶</div>🌊</div>
          <div class="card-title">Neon Dreams</div><div class="card-sub">Luna Waves</div>
        </div>
        <div class="music-card">
          <div class="card-art grad-rose"><div class="card-play-btn">▶</div>🔥</div>
          <div class="card-title">Electric Soul EP</div><div class="card-sub">NOVA</div>
        </div>
        <div class="music-card">
          <div class="card-art grad-teal"><div class="card-play-btn">▶</div>🌿</div>
          <div class="card-title">Earth Songs</div><div class="card-sub">The Wanderers</div>
        </div>
        <div class="music-card">
          <div class="card-art grad-amber"><div class="card-play-btn">▶</div>⭐</div>
          <div class="card-title">Solstice</div><div class="card-sub">Asha Ray</div>
        </div>
        <div class="music-card">
          <div class="card-art grad-blue"><div class="card-play-btn">▶</div>🌀</div>
          <div class="card-title">Infinite</div><div class="card-sub">Cosmos Band</div>
        </div>
        <div class="music-card">
          <div class="card-art grad-green"><div class="card-play-btn">▶</div>🎸</div>
          <div class="card-title">Raw Signal</div><div class="card-sub">Static Pulse</div>
        </div>
        <div class="music-card">
          <div class="card-art grad-orange"><div class="card-play-btn">▶</div>🌅</div>
          <div class="card-title">Dusk Boulevard</div><div class="card-sub">Mira Lane</div>
        </div>
      </div>
      <!-- POPULAR ARTISTS -->
      <div class="section-header">
        <div class="section-title">🎤 Popular Artists</div>
        <a class="section-link">See all</a>
      </div>
      <div class="scroll-row" style="padding-bottom:24px">
        <div class="artist-card">
          <div class="artist-avatar grad-purple">🌊</div>
          <div class="artist-name">Luna Waves</div><div class="artist-genre">Indie Electronic</div>
        </div>
        <div class="artist-card">
          <div class="artist-avatar grad-rose">🔥</div>
          <div class="artist-name">NOVA</div><div class="artist-genre">Electronic</div>
        </div>
        <div class="artist-card">
          <div class="artist-avatar grad-teal">🌿</div>
          <div class="artist-name">The Wanderers</div><div class="artist-genre">Folk Acoustic</div>
        </div>
        <div class="artist-card">
          <div class="artist-avatar grad-amber">⭐</div>
          <div class="artist-name">Asha Ray</div><div class="artist-genre">R&B Soul</div>
        </div>
        <div class="artist-card">
          <div class="artist-avatar grad-blue">🌀</div>
          <div class="artist-name">Cosmos Band</div><div class="artist-genre">Space Rock</div>
        </div>
        <div class="artist-card">
          <div class="artist-avatar grad-green">🎸</div>
          <div class="artist-name">Static Pulse</div><div class="artist-genre">Alt Rock</div>
        </div>
        <div class="artist-card">
          <div class="artist-avatar grad-orange">🌅</div>
          <div class="artist-name">Mira Lane</div><div class="artist-genre">Indie Pop</div>
        </div>
      </div>
    </div>