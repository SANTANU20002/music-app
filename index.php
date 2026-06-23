<?php include 'components/header.php'?>

<div class="landing-view active" id="landing-page">
    <section class="landing-hero">
      <div class="landing-hero-bg"></div>
      <div class="landing-hero-grid"></div>
      <div class="landing-hero-content">
        <div class="landing-eyebrow">
          <span style="width:6px;height:6px;border-radius:50%;background:var(--c-accent3);display:inline-block;animation:pulse2 2s infinite"></span>
          Now streaming 100M+ songs worldwide
        </div>
        <h1 class="landing-title">
          Music that<br>moves your <span class="grad">soul</span>
        </h1>
        <p class="landing-desc">Discover, stream, and share music like never before. AI-powered playlists, lossless audio, and real-time collaboration — all in one beautiful app.</p>
        <div class="landing-cta">
          <?php
            // Start session to check login status
            if (session_status() === PHP_SESSION_NONE) {
              session_start();
            }
          ?>
          <button 
            class="btn btn-primary" 
            style="font-size:15px;padding:14px 32px" 
            onclick="
              <?php if(isset($_SESSION['user_id'])): ?>
                window.location.href='pages/musi_dashboard.php?page=home';
              <?php else: ?>
                window.location.href='pages/authPage.php';
              <?php endif; ?>
            "
          >🎧 Start Listening Free</button>
  
          <button class="btn btn-ghost" style="font-size:15px;padding:14px 32px">▶ Watch Demo</button>
     
     
     
        </div>
        <div class="landing-social-proof">
          <div class="avatar-stack">
            <div class="avatar-stack-item" style="background:var(--c-grad1)">A</div>
            <div class="avatar-stack-item" style="background:linear-gradient(135deg,#06d6a0,#3b82f6)">B</div>
            <div class="avatar-stack-item" style="background:linear-gradient(135deg,#f43f5e,#ec4899)">C</div>
            <div class="avatar-stack-item" style="background:linear-gradient(135deg,#f59e0b,#ef4444)">D</div>
          </div>
          <div>
            <div style="font-size:13px;font-weight:600; color: #ebebeb">12M+ listeners</div>
            <div style="font-size:12px;color:var(--c-text3)">Joined this month</div>
          </div>
          <div style="display:flex;gap:2px;color:var(--c-warn)">★★★★★</div>
          <span style="font-size:13px;color:var(--c-text2)">4.9/5 rating</span>
        </div>
      </div>
  
      <!-- Phone Mockup -->
      <div class="landing-hero-visual">
        <div class="mockup-phone">
          <div class="mockup-phone-notch"></div>
          <div class="mockup-player">
            <div class="mockup-album">🎸</div>
            <div class="mockup-song">Neon Dreams</div>
            <div class="mockup-artist">Luna Waves</div>
            <div class="mockup-progress"><div class="mockup-progress-fill"></div></div>
            <div style="display:flex;justify-content:space-between;font-size:11px;color:var(--c-text3);font-family:var(--font-mono);margin-bottom:12px">
              <span>1:42</span><span>3:58</span>
            </div>
            <div class="mockup-controls">
              <button class="btn-icon" style="width:32px;height:32px;font-size:14px">⏮</button>
              <button style="width:48px;height:48px;border-radius:50%;background:var(--c-text);color:var(--c-bg);font-size:18px;display:flex;align-items:center;justify-content:center;border:none;cursor:pointer">⏸</button>
              <button class="btn-icon" style="width:32px;height:32px;font-size:14px">⏭</button>
            </div>
          </div>
        </div>
      </div>
    </section>
  
    <!-- FEATURES -->
    <section class="features-section">
      <div style="text-align:center;max-width:540px;margin:0 auto">
        <div style="font-family:var(--font-mono);font-size:12px;font-weight:600;color:var(--c-accent);letter-spacing:2px;text-transform:uppercase;margin-bottom:12px">WHY AURA</div>
        <h2 style="font-family:var(--font-display);font-size:40px;font-weight:800;letter-spacing:-1.5px;margin-bottom:12px; color: #ebebeb;">Built for <span style="background:var(--c-grad1);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">music lovers</span></h2>
        <p style="color:var(--c-text2);font-size:16px;line-height:1.6">Every feature crafted with the listener in mind. From AI curation to social listening rooms.</p>
      </div>
      <div class="features-grid">
        <div class="feature-card">
          <div class="feature-icon">🤖</div>
          <div class="feature-title">AI Music Intelligence</div>
          <div class="feature-desc">Our AI learns your taste in real-time and generates personalized playlists for every mood, activity, and moment.</div>
        </div>
        <div class="feature-card">
          <div class="feature-icon">🎵</div>
          <div class="feature-title">Lossless Audio Quality</div>
          <div class="feature-desc">Experience music the way artists intended with 24-bit lossless streaming up to 192kHz sample rate.</div>
        </div>
        <div class="feature-card">
          <div class="feature-icon">🌐</div>
          <div class="feature-title">Social Listening Rooms</div>
          <div class="feature-desc">Host virtual listening parties with friends worldwide. Sync playback, chat, and share reactions in real-time.</div>
        </div>
        <div class="feature-card">
          <div class="feature-icon">🎙️</div>
          <div class="feature-title">Artist Direct</div>
          <div class="feature-desc">Exclusive content, early releases, and behind-the-scenes access. Connect directly with your favorite artists.</div>
        </div>
        <div class="feature-card">
          <div class="feature-icon">📊</div>
          <div class="feature-title">Deep Listening Analytics</div>
          <div class="feature-desc">Beautiful insights about your listening habits, mood trends, and musical journey over time.</div>
        </div>
        <div class="feature-card">
          <div class="feature-icon">🎛️</div>
          <div class="feature-title">Studio-Grade EQ</div>
          <div class="feature-desc">Fine-tune your sound with a 10-band parametric equalizer and professional audio presets from sound engineers.</div>
        </div>
      </div>
    </section>
  
    <!-- TESTIMONIALS -->
    <section class="testimonials-section">
      <div style="text-align:center;max-width:540px;margin:0 auto">
        <div style="font-family:var(--font-mono);font-size:12px;font-weight:600;color:var(--c-accent);letter-spacing:2px;text-transform:uppercase;margin-bottom:12px">TESTIMONIALS</div>
        <h2 style="font-family:var(--font-display);font-size:36px;font-weight:800;letter-spacing:-1px; color: #ebebeb;">What our listeners say</h2>
      </div>
      <div class="testimonials-grid" style="margin-top:40px">
        <div class="testimonial-card">
          <div class="testimonial-stars">★★★★★</div>
          <p class="testimonial-text">"AURA completely changed how I discover music. The AI recommendations are eerily perfect — it feels like having a DJ who knows me better than I know myself."</p>
          <div class="testimonial-author">
            <div class="testimonial-avatar grad-purple">🎧</div>
            <div><div class="testimonial-name">Sarah K.</div><div class="testimonial-handle">@sarahbeats</div></div>
          </div>
        </div>
        <div class="testimonial-card">
          <div class="testimonial-stars">★★★★★</div>
          <p class="testimonial-text">"The listening party feature is a game changer. My friends and I host weekly sessions and the real-time sync is flawless. Best music app of 2026."</p>
          <div class="testimonial-author">
            <div class="testimonial-avatar grad-teal">🎸</div>
            <div><div class="testimonial-name">Marcus R.</div><div class="testimonial-handle">@marcusvibes</div></div>
          </div>
        </div>
        <div class="testimonial-card">
          <div class="testimonial-stars">★★★★★</div>
          <p class="testimonial-text">"As a producer, I love how AURA connects me directly with fans. The analytics dashboard shows me exactly what resonates. Truly built for artists."</p>
          <div class="testimonial-author">
            <div class="testimonial-avatar grad-rose">🎹</div>
            <div><div class="testimonial-name">Zara M.</div><div class="testimonial-handle">@zaraproduces</div></div>
          </div>
        </div>
      </div>
    </section>
  
    <!-- FOOTER -->
    
  </div>
  <?php include 'components/footer.php'; ?>