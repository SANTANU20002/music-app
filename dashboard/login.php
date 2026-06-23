<?php require_once "../backend/config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>AURA Admin Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --bg:        #05080f;
    --surface:   #0c1018;
    --border:    rgba(255,255,255,0.07);
    --accent-a:  #00d9ff;
    --accent-b:  #7b5ea7;
    --accent-c:  #ff6b6b;
    --text-hi:   #eef2ff;
    --text-mid:  #8892a4;
    --text-lo:   #3a4255;
    --glow-a:    rgba(0,217,255,0.18);
    --glow-b:    rgba(123,94,167,0.14);
  }

  html, body {
    min-height: 100%;
    background: var(--bg);
    font-family: 'DM Sans', sans-serif;
    color: var(--text-hi);
    overflow: hidden;
  }

  /* ── Animated background ── */
  .bg-scene {
    position: fixed;
    inset: 0;
    z-index: 0;
    background:
      radial-gradient(ellipse 70% 60% at 20% 15%, rgba(0,217,255,0.06) 0%, transparent 70%),
      radial-gradient(ellipse 60% 50% at 80% 80%, rgba(123,94,167,0.10) 0%, transparent 65%),
      radial-gradient(ellipse 40% 40% at 55% 45%, rgba(255,107,107,0.04) 0%, transparent 60%),
      var(--bg);
  }

  /* Grid lines */
  .bg-grid {
    position: fixed;
    inset: 0;
    z-index: 0;
    background-image:
      linear-gradient(rgba(255,255,255,0.018) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255,255,255,0.018) 1px, transparent 1px);
    background-size: 60px 60px;
    mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 30%, transparent 100%);
  }

  /* Floating orbs */
  .orb {
    position: fixed;
    border-radius: 50%;
    filter: blur(80px);
    animation: drift linear infinite;
    pointer-events: none;
    z-index: 0;
  }
  .orb-1 {
    width: 380px; height: 380px;
    background: radial-gradient(circle, rgba(0,217,255,0.12), transparent 70%);
    top: -100px; left: -80px;
    animation-duration: 22s;
  }
  .orb-2 {
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(123,94,167,0.16), transparent 70%);
    bottom: -80px; right: -60px;
    animation-duration: 28s;
    animation-direction: reverse;
  }
  .orb-3 {
    width: 200px; height: 200px;
    background: radial-gradient(circle, rgba(255,107,107,0.10), transparent 70%);
    top: 50%; left: 60%;
    animation-duration: 35s;
  }
  @keyframes drift {
    0%   { transform: translate(0, 0) scale(1); }
    33%  { transform: translate(30px, 20px) scale(1.05); }
    66%  { transform: translate(-20px, 30px) scale(0.95); }
    100% { transform: translate(0, 0) scale(1); }
  }

  /* ── Layout ── */
  .page {
    position: relative;
    z-index: 1;
    min-height: 100vh;
    display: grid;
    grid-template-columns: 1fr 480px 1fr;
    grid-template-rows: 1fr auto 1fr;
    align-items: center;
    justify-items: center;
  }

  /* ── Brand strip (left) ── */
  .brand-strip {
    grid-column: 1;
    grid-row: 2;
    padding: 0 0 0 60px;
    align-self: center;
    justify-self: start;
    opacity: 0;
    animation: fadeUp 0.8s 0.2s ease forwards;
  }
  .brand-wordmark {
    font-family: 'Syne', sans-serif;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--text-mid);
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .brand-wordmark::before {
    content: '';
    display: block;
    width: 28px;
    height: 1.5px;
    background: var(--accent-a);
    opacity: 0.6;
  }
  .brand-headline {
    font-family: 'Syne', sans-serif;
    font-size: clamp(36px, 3.5vw, 56px);
    font-weight: 800;
    line-height: 1.05;
    letter-spacing: -0.02em;
    color: var(--text-hi);
    margin-bottom: 14px;
  }
  .brand-headline em {
    font-style: normal;
    background: linear-gradient(135deg, var(--accent-a), var(--accent-b));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }
  .brand-sub {
    font-size: 14px;
    color: var(--text-mid);
    font-weight: 300;
    letter-spacing: 0.01em;
    line-height: 1.6;
    max-width: 260px;
  }
  .brand-dots {
    display: flex;
    gap: 6px;
    margin-top: 32px;
  }
  .brand-dots span {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--text-lo);
  }
  .brand-dots span:first-child { background: var(--accent-a); }
  .brand-dots span:nth-child(2) { background: var(--accent-b); }

  /* ── Card ── */
  .card-wrap {
    grid-column: 2;
    grid-row: 2;
    width: 100%;
    padding: 0 24px;
    opacity: 0;
    animation: fadeUp 0.8s 0.4s ease forwards;
  }

  .card {
    background: rgba(12,16,24,0.92);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 48px 44px 44px;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    box-shadow:
      0 0 0 1px rgba(255,255,255,0.04) inset,
      0 32px 80px rgba(0,0,0,0.55),
      0 0 60px rgba(0,217,255,0.04);
  }

  /* top accent bar */
  .card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 1.5px;
    background: linear-gradient(90deg, transparent 0%, var(--accent-a) 40%, var(--accent-b) 70%, transparent 100%);
    opacity: 0.7;
  }

  /* inner glow */
  .card::after {
    content: '';
    position: absolute;
    top: -40px; left: 50%;
    transform: translateX(-50%);
    width: 180px; height: 100px;
    background: radial-gradient(ellipse, rgba(0,217,255,0.08), transparent 70%);
    pointer-events: none;
  }

  /* ── Card header ── */
  .card-header-area {
    text-align: center;
    margin-bottom: 36px;
    position: relative;
    z-index: 1;
  }
  .logo-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 52px; height: 52px;
    border-radius: 14px;
    background: linear-gradient(135deg, rgba(0,217,255,0.15), rgba(123,94,167,0.15));
    border: 1px solid rgba(0,217,255,0.2);
    margin-bottom: 18px;
    position: relative;
  }
  .logo-icon svg {
    width: 26px; height: 26px;
  }
  .logo-icon::after {
    content: '';
    position: absolute;
    inset: -1px;
    border-radius: inherit;
    background: linear-gradient(135deg, var(--accent-a), var(--accent-b));
    z-index: -1;
    opacity: 0.2;
    filter: blur(6px);
  }

  .card-title {
    font-family: 'Syne', sans-serif;
    font-size: 22px;
    font-weight: 700;
    letter-spacing: 0.04em;
    color: var(--text-hi);
    margin-bottom: 6px;
  }
  .card-sub {
    font-size: 13px;
    color: var(--text-mid);
    font-weight: 300;
    letter-spacing: 0.01em;
  }

  /* ── Divider ── */
  .divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--border), transparent);
    margin: 0 -44px 32px;
  }

  /* ── Form fields ── */
  .field {
    margin-bottom: 20px;
  }
  .field-label {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 11.5px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--text-mid);
    margin-bottom: 9px;
  }
  .field-label svg {
    width: 12px; height: 12px;
    opacity: 0.7;
  }

  .input-wrap {
    position: relative;
  }
  .input-wrap input {
    width: 100%;
    background: rgba(5,8,15,0.6);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 10px;
    color: var(--text-hi);
    font-family: 'DM Sans', sans-serif;
    font-size: 14.5px;
    font-weight: 400;
    padding: 13px 44px 13px 16px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    -webkit-appearance: none;
  }
  .input-wrap input::placeholder {
    color: var(--text-lo);
    font-weight: 300;
  }
  .input-wrap input:focus {
    border-color: rgba(0,217,255,0.4);
    background: rgba(0,217,255,0.03);
    box-shadow: 0 0 0 3px rgba(0,217,255,0.08), 0 1px 3px rgba(0,0,0,0.3);
  }
  .input-wrap input:focus + .field-icon {
    color: var(--accent-a);
  }
  .field-icon {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-lo);
    transition: color 0.2s;
    pointer-events: none;
    display: flex;
  }
  .field-icon svg {
    width: 16px; height: 16px;
  }

  /* toggle password */
  .toggle-pw {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    color: var(--text-lo);
    display: flex;
    align-items: center;
    padding: 2px;
    transition: color 0.2s;
  }
  .toggle-pw:hover { color: var(--accent-a); }
  .toggle-pw svg { width: 16px; height: 16px; }

  /* ── Options row ── */
  .options-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 4px 0 28px;
  }
  .remember-label {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    font-size: 12.5px;
    color: var(--text-mid);
    user-select: none;
  }
  .remember-label input[type="checkbox"] {
    appearance: none;
    -webkit-appearance: none;
    width: 16px; height: 16px;
    border: 1.5px solid rgba(255,255,255,0.12);
    border-radius: 4px;
    background: rgba(5,8,15,0.6);
    cursor: pointer;
    position: relative;
    transition: border-color 0.2s, background 0.2s;
  }
  .remember-label input[type="checkbox"]:checked {
    background: var(--accent-a);
    border-color: var(--accent-a);
  }
  .remember-label input[type="checkbox"]:checked::after {
    content: '';
    position: absolute;
    left: 3.5px; top: 1px;
    width: 5px; height: 9px;
    border: 2px solid #05080f;
    border-top: none;
    border-left: none;
    transform: rotate(45deg);
  }
  .forgot-link {
    font-size: 12.5px;
    color: var(--accent-a);
    text-decoration: none;
    opacity: 0.8;
    transition: opacity 0.2s;
  }
  .forgot-link:hover { opacity: 1; }

  /* ── Submit button ── */
  .btn-login {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 10px;
    font-family: 'Syne', sans-serif;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #05080f;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, var(--accent-a) 0%, #4dd9f5 50%, var(--accent-b) 100%);
    background-size: 200% 200%;
    animation: gradShift 4s ease infinite;
    transition: transform 0.15s, box-shadow 0.2s;
    box-shadow: 0 4px 24px rgba(0,217,255,0.25), 0 1px 3px rgba(0,0,0,0.4);
  }
  .btn-login::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, transparent 60%);
    border-radius: inherit;
  }
  .btn-login:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 32px rgba(0,217,255,0.35), 0 2px 6px rgba(0,0,0,0.4);
  }
  .btn-login:active { transform: translateY(0); }
  @keyframes gradShift {
    0%, 100% { background-position: 0% 50%; }
    50%       { background-position: 100% 50%; }
  }

  /* Loading spinner inside button */
  .btn-login .btn-text { position: relative; z-index: 1; }
  .btn-login.loading .btn-text::after {
    content: '';
    display: inline-block;
    width: 14px; height: 14px;
    border: 2px solid rgba(5,8,15,0.3);
    border-top-color: #05080f;
    border-radius: 50%;
    animation: spin 0.7s linear infinite;
    vertical-align: middle;
    margin-left: 8px;
  }
  @keyframes spin { to { transform: rotate(360deg); } }

  /* ── Footer ── */
  .card-footer-area {
    text-align: center;
    margin-top: 24px;
    position: relative;
    z-index: 1;
  }
  .status-row {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    font-size: 11px;
    color: var(--text-lo);
    letter-spacing: 0.06em;
  }
  .status-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: #22c55e;
    box-shadow: 0 0 6px #22c55e;
    animation: pulse-dot 2s ease infinite;
  }
  @keyframes pulse-dot {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
  }

  /* ── Right decorative panel ── */
  .deco-panel {
    grid-column: 3;
    grid-row: 2;
    padding-right: 60px;
    align-self: center;
    justify-self: end;
    opacity: 0;
    animation: fadeUp 0.8s 0.6s ease forwards;
    display: flex;
    flex-direction: column;
    gap: 12px;
    max-width: 200px;
  }
  .stat-chip {
    background: rgba(12,16,24,0.7);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 14px 18px;
    backdrop-filter: blur(10px);
  }
  .stat-chip-label {
    font-size: 10px;
    color: var(--text-lo);
    text-transform: uppercase;
    letter-spacing: 0.12em;
    font-weight: 600;
    margin-bottom: 4px;
  }
  .stat-chip-value {
    font-family: 'Syne', sans-serif;
    font-size: 20px;
    font-weight: 700;
    color: var(--text-hi);
  }
  .stat-chip-value.cyan { color: var(--accent-a); }
  .stat-chip-value.violet { color: #a78bfa; }

  /* ── Bottom bar ── */
  .bottom-bar {
    grid-column: 1 / -1;
    grid-row: 3;
    align-self: end;
    padding: 20px 60px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    opacity: 0;
    animation: fadeUp 0.6s 0.8s ease forwards;
  }
  .bottom-copy {
    font-size: 11px;
    color: var(--text-lo);
    letter-spacing: 0.05em;
  }
  .bottom-ver {
    font-size: 11px;
    color: var(--text-lo);
    letter-spacing: 0.05em;
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .ver-badge {
    font-family: 'Syne', sans-serif;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.08em;
    padding: 2px 7px;
    border-radius: 4px;
    border: 1px solid rgba(0,217,255,0.25);
    color: var(--accent-a);
  }

  /* ── Animations ── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* ── Responsive ── */
  @media (max-width: 1100px) {
    .brand-strip, .deco-panel { display: none; }
    .page { grid-template-columns: 1fr; grid-template-rows: auto; }
    .card-wrap { grid-column: 1; grid-row: 1; max-width: 480px; margin: auto; padding: 40px 20px; }
    .bottom-bar { grid-row: 2; padding: 16px 20px; }
    html, body { overflow: auto; }
  }

  @media (max-width: 520px) {
    .card { padding: 36px 28px 32px; }
    .divider { margin: 0 -28px 28px; }
  }
</style>
</head>
<body>

<div class="bg-scene"></div>
<div class="bg-grid"></div>
<div class="orb orb-1"></div>
<div class="orb orb-2"></div>
<div class="orb orb-3"></div>

<div class="page">

  <!-- Left brand -->
  <div class="brand-strip">
    <div class="brand-wordmark">Aura Platform</div>
    <div class="brand-headline">Admin<br><em>Control</em><br>Centre</div>
    <div class="brand-sub">Secure access to your organisation's management dashboard.</div>
    <div class="brand-dots">
      <span></span><span></span><span></span>
    </div>
  </div>

  <!-- Centre card -->
  <div class="card-wrap">
    <div class="card">

      <div class="card-header-area">
        <div class="logo-icon">
          <!-- Shield / lock icon -->
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2L4 6v6c0 5.25 3.5 10.15 8 11.5C16.5 22.15 20 17.25 20 12V6L12 2z" stroke="url(#g1)" stroke-width="1.8" stroke-linejoin="round" fill="none"/>
            <path d="M9 12l2 2 4-4" stroke="url(#g1)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            <defs>
              <linearGradient id="g1" x1="4" y1="2" x2="20" y2="22" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#00d9ff"/>
                <stop offset="100%" stop-color="#7b5ea7"/>
              </linearGradient>
            </defs>
          </svg>
        </div>
        <div class="card-title">Welcome back</div>
        <div class="card-sub">Sign in to AURA Admin Panel</div>
      </div>

      <div class="divider"></div>

      <form action="login_process.php" method="POST" autocomplete="off" id="loginForm">

        <div class="field">
          <label class="field-label" for="emailInput">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2z"/>
              <polyline points="22,6 12,13 2,6"/>
            </svg>
            Email address
          </label>
          <div class="input-wrap">
            <input
              type="email"
              name="email"
              id="emailInput"
              placeholder="admin@yourdomain.com"
              autocomplete="username"
              required>
            <span class="field-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <circle cx="12" cy="12" r="3"/>
                <path d="M12 1a11 11 0 100 22A11 11 0 0012 1z" stroke-dasharray="2 3"/>
              </svg>
            </span>
          </div>
        </div>

        <div class="field">
          <label class="field-label" for="passwordInput">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
              <path d="M7 11V7a5 5 0 0110 0v4"/>
            </svg>
            Password
          </label>
          <div class="input-wrap">
            <input
              type="password"
              name="password"
              id="passwordInput"
              placeholder="Enter your password"
              autocomplete="current-password"
              required>
            <button type="button" class="toggle-pw" id="togglePw" aria-label="Toggle password">
              <svg id="eyeIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>
        </div>

        <div class="options-row">
          <label class="remember-label">
            <input type="checkbox" name="remember"> Keep me signed in
          </label>
          <a href="#" class="forgot-link">Forgot password?</a>
        </div>

        <button type="submit" class="btn-login" id="loginBtn">
          <span class="btn-text">Access Dashboard</span>
        </button>

      </form>

      <div class="card-footer-area">
        <div class="status-row">
          <span class="status-dot"></span>
          All systems operational
        </div>
      </div>

    </div><!-- /card -->
  </div>

  <!-- Right stats -->
  <div class="deco-panel">
    <div class="stat-chip">
      <div class="stat-chip-label">Uptime</div>
      <div class="stat-chip-value cyan">99.9%</div>
    </div>
    <div class="stat-chip">
      <div class="stat-chip-label">Active users</div>
      <div class="stat-chip-value violet">2,841</div>
    </div>
    <div class="stat-chip">
      <div class="stat-chip-label">Requests today</div>
      <div class="stat-chip-value">1.2M</div>
    </div>
  </div>

  <!-- Bottom bar -->
  <div class="bottom-bar">
    <span class="bottom-copy">© 2025 AURA Platform. All rights reserved.</span>
    <span class="bottom-ver">
      <span class="ver-badge">v3.4.1</span>
      Secure connection · TLS 1.3
    </span>
  </div>

</div>

<script>
  // Toggle password visibility
  const togglePw   = document.getElementById('togglePw');
  const pwInput    = document.getElementById('passwordInput');
  const eyeIcon    = document.getElementById('eyeIcon');

  const eyeOpen  = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
  const eyeClosed = `<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`;

  togglePw.addEventListener('click', () => {
    const isHidden = pwInput.type === 'password';
    pwInput.type = isHidden ? 'text' : 'password';
    eyeIcon.innerHTML = isHidden ? eyeClosed : eyeOpen;
  });

  // Button loading state
  document.getElementById('loginForm').addEventListener('submit', function() {
    const btn = document.getElementById('loginBtn');
    btn.classList.add('loading');
    btn.disabled = true;
    btn.querySelector('.btn-text').textContent = 'Authenticating';
  });

  // Subtle input focus highlight on label
  document.querySelectorAll('.input-wrap input').forEach(input => {
    input.addEventListener('focus', () => {
      input.closest('.field').querySelector('.field-label').style.color = '#00d9ff';
    });
    input.addEventListener('blur', () => {
      input.closest('.field').querySelector('.field-label').style.color = '';
    });
  });
</script>
</body>
</html>