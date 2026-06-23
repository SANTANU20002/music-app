
// ═══════════════════════════════════════════
// PLAYER
// ═══════════════════════════════════════════
function togglePlay() {
    isPlaying = !isPlaying;
    const icon = document.getElementById('play-icon');
    const btn = document.getElementById('play-btn');
    
    if(isPlaying) {
      icon.textContent = '⏸';
      btn.style.background = 'var(--c-accent)';
      btn.style.color = '#fff';
      startProgress();
    } else {
      icon.textContent = '▶';
      btn.style.background = 'var(--c-text)';
      btn.style.color = 'var(--c-bg)';
      stopProgress();
    }
  }
  
  function startProgress() {
    stopProgress();
    progressInterval = setInterval(() => {
      progressPercent = Math.min(progressPercent + 0.1, 100);
      updateProgressUI();
      if(progressPercent >= 100) {
        progressPercent = 0;
        stopProgress();
        isPlaying = false;
        document.getElementById('play-icon').textContent = '▶';
      }
    }, 100);
  }
  
  function stopProgress() {
    if(progressInterval) clearInterval(progressInterval);
  }
  
  function updateProgressUI() {
    const fill = document.getElementById('progress-fill');
    if(fill) fill.style.width = progressPercent + '%';
  }
  
  function seekTrack(e, el) {
    const rect = el.getBoundingClientRect();
    const pct = ((e.clientX - rect.left) / rect.width) * 100;
    progressPercent = Math.max(0, Math.min(100, pct));
    updateProgressUI();
  }
  
  function setVolume(e, el) {
    const rect = el.getBoundingClientRect();
    const pct = ((e.clientX - rect.left) / rect.width) * 100;
    const vol = document.getElementById('vol-fill');
    if(vol) vol.style.width = Math.max(0, Math.min(100, pct)) + '%';
  }
  
  // ═══════════════════════════════════════════
  // THEME
  // ═══════════════════════════════════════════
//   function toggleTheme() {
//     isDark = !isDark;
//     document.documentElement.setAttribute('data-theme', isDark ? 'dark' : 'light');
//     const btn = document.getElementById('theme-toggle');
//     if(btn) btn.textContent = isDark ? '🌙' : '☀️';
//   }
  
  // ═══════════════════════════════════════════
  // PRICING TOGGLE
  // ═══════════════════════════════════════════
  document.querySelectorAll('.pricing-toggle-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.pricing-toggle-btn').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
    });
  });
  
  // ═══════════════════════════════════════════
  // SETTINGS NAV
  // ═══════════════════════════════════════════
  document.querySelectorAll('.settings-nav-item').forEach(item => {
    item.addEventListener('click', function() {
      document.querySelectorAll('.settings-nav-item').forEach(i => i.classList.remove('active'));
      this.classList.add('active');
    });
  });
  
  // ═══════════════════════════════════════════
  // MOOD CHIPS
  // ═══════════════════════════════════════════
  document.querySelectorAll('.mood-chip').forEach(chip => {
    chip.addEventListener('click', function() {
      this.classList.toggle('active');
    });
  });
  
  // ═══════════════════════════════════════════
  // INIT
  // ═══════════════════════════════════════════
  // Auto-start progress at 38%
  updateProgressUI();
  
  // Add hover effects to trending items
  document.querySelectorAll('.trending-item').forEach(item => {
    item.addEventListener('mouseenter', function() {
      const num = this.querySelector('.trending-num');
      const play = this.querySelector('.trending-play');
      if(num) num.style.opacity = '0';
      if(play) play.style.opacity = '1';
    });
    item.addEventListener('mouseleave', function() {
      const num = this.querySelector('.trending-num');
      const play = this.querySelector('.trending-play');
      if(num) num.style.opacity = '1';
      if(play) play.style.opacity = '0';
    });
  });