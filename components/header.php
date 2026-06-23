<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"> -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
  <title>Header</title>
</head>
<body>
  <header>
    <nav class="landing-nav">
        <div style="display:flex;align-items:center;gap:10px">
          <div class="logo-mark">🎵</div>
          <span style="font-family:var(--font-display);font-size:22px;font-weight:800">AURA</span>
        </div>
        <div style="display:flex;gap:28px;align-items:center">
          <a href="#" class="footer-link" style="font-size:14px">Features</a>
          <a href="#" class="footer-link" style="font-size:14px">Pricing</a>
          <a href="#" class="footer-link" style="font-size:14px">Artists</a>
          <a href="#" class="footer-link" style="font-size:14px">Blog</a>
        </div>
        <div style="display:flex;gap:10px">
          <button class="btn btn-ghost" onclick="window.location.href='./pages/authpage.php'">Sign In</button>
     
          <button class="btn btn-primary" onclick="showAuth('signup')">Get Started Free</button>
     
        </div>
      </nav>
  </header>
