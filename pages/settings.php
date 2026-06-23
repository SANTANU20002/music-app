<div class="page" id="page-settings">
      <div style="padding:28px 32px 24px">
        <h1 style="font-family:var(--font-display);font-size:24px;font-weight:800">Settings</h1>
      </div>
      <div class="settings-grid">
        <div class="settings-nav">
          <div class="settings-nav-item active">Account</div>
          <div class="settings-nav-item">Playback</div>
          <div class="settings-nav-item">Notifications</div>
          <div class="settings-nav-item">Privacy</div>
          <div class="settings-nav-item">Appearance</div>
          <div class="settings-nav-item">Storage</div>
          <div class="settings-nav-item" style="color:var(--c-danger);margin-top:20px">Log Out</div>
        </div>
        <div class="settings-content">
          <div class="settings-section">
            <div class="settings-section-title">Account Information</div>
            <div class="form-group"><label class="form-label">DISPLAY NAME</label><input type="text" class="form-input" value="Jamie Chen" style="max-width:300px"></div>
            <div class="form-group"><label class="form-label">EMAIL</label><input type="email" class="form-input" value="jamie@example.com" style="max-width:300px"></div>
            <div style="margin-top:16px"><button class="btn btn-primary">Save Changes</button></div>
          </div>
          <div class="settings-section">
            <div class="settings-section-title">Playback Preferences</div>
            <div class="settings-row">
              <div><div class="settings-row-label">Crossfade</div><div class="settings-row-desc">Smooth transition between tracks</div></div>
              <div class="toggle on" onclick="this.classList.toggle('on')"></div>
            </div>
            <div class="settings-row">
              <div><div class="settings-row-label">Normalize Volume</div><div class="settings-row-desc">Keep consistent volume across tracks</div></div>
              <div class="toggle on" onclick="this.classList.toggle('on')"></div>
            </div>
            <div class="settings-row">
              <div><div class="settings-row-label">Lossless Audio</div><div class="settings-row-desc">Stream in 24-bit lossless quality (Premium)</div></div>
              <div class="toggle on" onclick="this.classList.toggle('on')"></div>
            </div>
            <div class="settings-row">
              <div><div class="settings-row-label">Auto-Play</div><div class="settings-row-desc">Continue playing similar songs when queue ends</div></div>
              <div class="toggle" onclick="this.classList.toggle('on')"></div>
            </div>
          </div>
          <div class="settings-section">
            <div class="settings-section-title">Appearance</div>
            <div class="settings-row">
              <div><div class="settings-row-label">Dark Mode</div><div class="settings-row-desc">Use dark theme across the app</div></div>
              <div class="toggle on" id="theme-toggle-settings" onclick="toggleTheme();this.classList.toggle('on')"></div>
            </div>
            <div class="settings-row">
              <div><div class="settings-row-label">Reduce Animations</div><div class="settings-row-desc">Minimize motion for accessibility</div></div>
              <div class="toggle" onclick="this.classList.toggle('on')"></div>
            </div>
          </div>
          <div class="settings-section">
            <div class="settings-section-title">Danger Zone</div>
            <div style="display:flex;gap:12px;flex-wrap:wrap">
              <button class="btn btn-ghost" style="border-color:var(--c-danger);color:var(--c-danger)">Delete Account</button>
              <button class="btn btn-ghost">Download My Data</button>
            </div>
          </div>
        </div>
      </div>
    </div>