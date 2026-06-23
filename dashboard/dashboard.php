<?php require_once "../backend/config.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM music_categories ORDER BY id DESC";
$result = mysqli_query($conn, $query); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SoundWave Admin — Music Streaming Dashboard</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<link rel="stylesheet" href="dashboard.css">
</head>
<body>

<!-- Sidebar -->
<section class="dashboard_container">
<aside class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <div class="brand">
      <div class="logo-mark" style="cursor:pointer">🎵</div>
                <span class="logo-text">AURA</span>
                <!-- <span class="logo-beta">BETA</span> -->
        <!-- <span class="brand-sub">Admin Panel</span> -->
    </div>
    <button class="sidebar-toggle-btn" id="sidebarToggle"><i class="fa fa-bars"></i></button>
  </div>

  <div class="sidebar-search">
    <div class="search-wrap">
      <i class="fa fa-search"></i>
      <input type="text" placeholder="Search anything…" id="globalSearch">
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-section-label">Main</div>
    <a href="#" class="nav-item active" data-page="dashboard">
      <span class="nav-icon"><i class="fa-regular fa-house"></i></span>
      <span class="nav-label">Dashboard</span>
      <span class="nav-badge new">Live</span>
    </a>
    <a href="#" class="nav-item" data-page="categories">
      <span class="nav-icon"><i class="fa fa-layer-group"></i></span>
      <span class="nav-label">Categories</span>
    </a>
    <a href="#" class="nav-item" data-page="songs">
      <span class="nav-icon"><i class="fa fa-music"></i></span>
      <span class="nav-label">Songs</span>
      <span class="nav-badge">2.4k</span>
    </a>
    <a href="#" class="nav-item" data-page="artists">
      <span class="nav-icon"><i class="fa fa-microphone"></i></span>
      <span class="nav-label">Artists</span>
    </a>
    <a href="#" class="nav-item" data-page="albums">
      <span class="nav-icon"><i class="fa fa-record-vinyl"></i></span>
      <span class="nav-label">Albums</span>
    </a>
    <a href="#" class="nav-item" data-page="playlists">
      <span class="nav-icon"><i class="fa-solid fa-list"></i></span>
      <span class="nav-label">Playlists</span>
    </a>
    <div class="nav-section-label">People</div>
    <a href="#" class="nav-item" data-page="users">
      <span class="nav-icon"><i class="fa fa-users"></i></span>
      <span class="nav-label">Users</span>
      <span class="nav-badge">142</span>
    </a>
    <div class="nav-section-label">Insights</div>
    <a href="#" class="nav-item" data-page="analytics">
      <span class="nav-icon"><i class="fa fa-chart-line"></i></span>
      <span class="nav-label">Analytics</span>
    </a>
    <a href="#" class="nav-item" data-page="notifications">
      <span class="nav-icon"><i class="fa fa-bell"></i></span>
      <span class="nav-label">Notifications</span>
      <span class="nav-badge alert">5</span>
    </a>
    <div class="nav-section-label">System</div>
    <a href="#" class="nav-item" data-page="settings">
      <span class="nav-icon"><i class="fa fa-gear"></i></span>
      <span class="nav-label">Settings</span>
    </a>
    <a href="#" class="nav-item" data-page="profile">
      <span class="nav-icon"><i class="fa fa-circle-user"></i></span>
      <span class="nav-label">Profile</span>
    </a>
    <a href="logout.php" class="nav-item logout">
      <span class="nav-icon"><i class="fa fa-arrow-right-from-bracket"></i></span>
      <span class="nav-label">Logout</span>
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="now-playing-mini">
      <div class="np-thumb">
        <img src="https://picsum.photos/seed/track1/40/40" alt="Now Playing">
        <div class="np-play-dot"></div>
      </div>
      <div class="np-info">
        <div class="np-title">Blinding Lights</div>
        <div class="np-artist">The Weeknd</div>
      </div>
      <div class="np-controls">
        <button class="np-btn"><i class="fa fa-backward-step"></i></button>
        <button class="np-btn play"><i class="fa fa-pause"></i></button>
        <button class="np-btn"><i class="fa fa-forward-step"></i></button>
      </div>
    </div>
  </div>
</aside>

<!-- Overlay for mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Main Content -->
<main class="main-content" id="mainContent">

  <!-- Top Bar -->
  <header class="topbar">
    <div class="topbar-left">
      <button class="mobile-toggle" id="mobileToggle"><i class="fa fa-bars"></i></button>
      <div class="page-title" id="pageTitle">
        <h1>Dashboard</h1>
        <div class="breadcrumb-trail"><span>Home</span> <i class="fa fa-chevron-right"></i> <span class="active">Overview</span></div>
      </div>
    </div>
    <div class="topbar-right">
      <div class="topbar-search">
        <i class="fa fa-search"></i>
        <input type="text" placeholder="Search songs, artists…">
      </div>
      <button class="topbar-btn" title="Add New"><i class="fa fa-plus"></i></button>
      <button class="topbar-btn notif-btn" title="Notifications">
        <i class="fa fa-bell"></i>
        <span class="notif-dot"></span>
      </button>
      <div class="topbar-avatar">
        <img src="https://picsum.photos/seed/admin/36/36" alt="Admin">
        <div class="avatar-status"></div>
      </div>
    </div>
  </header>

  <!-- Page Container -->
  <div class="page-container" id="pageContainer">

    <!-- ========== DASHBOARD PAGE ========== -->
    <div class="page active" id="page-dashboard">

      <!-- Stats Grid -->
      <div class="stats-grid">
        <div class="stat-card" data-value="24817">
          <div class="stat-icon songs"><i class="fa fa-music"></i></div>
          <div class="stat-body">
            <div class="stat-value counter" data-target="24817">0</div>
            <div class="stat-label">Total Songs</div>
            <div class="stat-change positive"><i class="fa fa-arrow-trend-up"></i> +12.4% this month</div>
          </div>
          <div class="stat-sparkline" data-type="songs"></div>
        </div>
        <div class="stat-card" data-value="48">
          <div class="stat-icon categories"><i class="fa fa-layer-group"></i></div>
          <div class="stat-body">
            <div class="stat-value counter" data-target="48">0</div>
            <div class="stat-label">Categories</div>
            <div class="stat-change positive"><i class="fa fa-arrow-trend-up"></i> +3 this week</div>
          </div>
          <div class="stat-sparkline" data-type="categories"></div>
        </div>
        <div class="stat-card" data-value="1842">
          <div class="stat-icon artists"><i class="fa fa-microphone"></i></div>
          <div class="stat-body">
            <div class="stat-value counter" data-target="1842">0</div>
            <div class="stat-label">Artists</div>
            <div class="stat-change positive"><i class="fa fa-arrow-trend-up"></i> +87 this month</div>
          </div>
          <div class="stat-sparkline" data-type="artists"></div>
        </div>
        <div class="stat-card" data-value="3294">
          <div class="stat-icon albums"><i class="fa fa-record-vinyl"></i></div>
          <div class="stat-body">
            <div class="stat-value counter" data-target="3294">0</div>
            <div class="stat-label">Albums</div>
            <div class="stat-change neutral"><i class="fa fa-minus"></i> No change</div>
          </div>
          <div class="stat-sparkline" data-type="albums"></div>
        </div>
        <div class="stat-card" data-value="98420">
          <div class="stat-icon users"><i class="fa fa-users"></i></div>
          <div class="stat-body">
            <div class="stat-value counter" data-target="98420">0</div>
            <div class="stat-label">Total Users</div>
            <div class="stat-change positive"><i class="fa fa-arrow-trend-up"></i> +5.8% this month</div>
          </div>
          <div class="stat-sparkline" data-type="users"></div>
        </div>
        <div class="stat-card featured" data-value="4820391">
          <div class="stat-icon plays"><i class="fa fa-headphones"></i></div>
          <div class="stat-body">
            <div class="stat-value counter" data-target="4820391">0</div>
            <div class="stat-label">Total Plays</div>
            <div class="stat-change positive"><i class="fa fa-arrow-trend-up"></i> +28.3% this month</div>
          </div>
          <div class="stat-sparkline" data-type="plays"></div>
        </div>
      </div>

      <!-- Charts Row -->
      <div class="charts-row">
        <div class="chart-card wide">
          <div class="chart-card-header">
            <div>
              <div class="chart-title">Plays Overview</div>
              <div class="chart-sub">Song streams over the last 12 months</div>
            </div>
            <div class="chart-filters">
              <button class="cf-btn active">12M</button>
              <button class="cf-btn">6M</button>
              <button class="cf-btn">30D</button>
              <button class="cf-btn">7D</button>
            </div>
          </div>
          <canvas id="playsChart" height="280"></canvas>
        </div>
        <div class="chart-card">
          <div class="chart-card-header">
            <div>
              <div class="chart-title">Category Split</div>
              <div class="chart-sub">Top categories by plays</div>
            </div>
          </div>
          <canvas id="categoryChart" height="240"></canvas>
          <div class="donut-legend" id="donutLegend"></div>
        </div>
      </div>

      <!-- Bottom Row -->
      <div class="bottom-row">
        <!-- Recent Uploads -->
        <div class="panel">
          <div class="panel-header">
            <div class="panel-title">Recent Uploads</div>
            <a href="#" class="panel-link" data-page="songs">View all <i class="fa fa-arrow-right"></i></a>
          </div>
          <div class="recent-list">
            <div class="recent-item">
              <img src="https://picsum.photos/seed/s1/48/48" alt="">
              <div class="ri-info">
                <div class="ri-title">Starboy</div>
                <div class="ri-meta">The Weeknd · 3:50</div>
              </div>
              <div class="ri-cat"><span class="cat-pill late-night">Late Night</span></div>
              <div class="ri-plays"><i class="fa fa-headphones"></i> 142k</div>
              <button class="ri-action"><i class="fa fa-ellipsis"></i></button>
            </div>
            <div class="recent-item">
              <img src="https://picsum.photos/seed/s2/48/48" alt="">
              <div class="ri-info">
                <div class="ri-title">Levitating</div>
                <div class="ri-meta">Dua Lipa · 3:23</div>
              </div>
              <div class="ri-cat"><span class="cat-pill party">Party Mix</span></div>
              <div class="ri-plays"><i class="fa fa-headphones"></i> 98k</div>
              <button class="ri-action"><i class="fa fa-ellipsis"></i></button>
            </div>
            <div class="recent-item">
              <img src="https://picsum.photos/seed/s3/48/48" alt="">
              <div class="ri-info">
                <div class="ri-title">Heat Waves</div>
                <div class="ri-meta">Glass Animals · 3:58</div>
              </div>
              <div class="ri-cat"><span class="cat-pill chill">Chill Vibes</span></div>
              <div class="ri-plays"><i class="fa fa-headphones"></i> 203k</div>
              <button class="ri-action"><i class="fa fa-ellipsis"></i></button>
            </div>
            <div class="recent-item">
              <img src="https://picsum.photos/seed/s4/48/48" alt="">
              <div class="ri-info">
                <div class="ri-title">Anti-Hero</div>
                <div class="ri-meta">Taylor Swift · 3:20</div>
              </div>
              <div class="ri-cat"><span class="cat-pill romantic">Romantic</span></div>
              <div class="ri-plays"><i class="fa fa-headphones"></i> 317k</div>
              <button class="ri-action"><i class="fa fa-ellipsis"></i></button>
            </div>
            <div class="recent-item">
              <img src="https://picsum.photos/seed/s5/48/48" alt="">
              <div class="ri-info">
                <div class="ri-title">As It Was</div>
                <div class="ri-meta">Harry Styles · 2:37</div>
              </div>
              <div class="ri-cat"><span class="cat-pill workout">Workout</span></div>
              <div class="ri-plays"><i class="fa fa-headphones"></i> 256k</div>
              <button class="ri-action"><i class="fa fa-ellipsis"></i></button>
            </div>
          </div>
        </div>

        <!-- Trending Categories + Quick Actions -->
        <div class="side-panels">
          <div class="panel">
            <div class="panel-header">
              <div class="panel-title">Trending Categories</div>
              <span class="trending-badge"><i class="fa fa-fire"></i> Hot</span>
            </div>
            <div class="trending-cats">
              <div class="trend-cat-item" style="--c:#1DB954">
                <div class="tc-rank">1</div>
                <div class="tc-icon" style="background: linear-gradient(135deg,#0f2027,#203a43)"><i class="fa fa-moon"></i></div>
                <div class="tc-info"><div class="tc-name">Late Night Drives</div><div class="tc-plays">842k plays</div></div>
                <div class="tc-bar"><div class="tc-fill" style="width:92%;background:var(--c)"></div></div>
              </div>
              <div class="trend-cat-item" style="--c:#FF6B35">
                <div class="tc-rank">2</div>
                <div class="tc-icon" style="background: linear-gradient(135deg,#f7971e,#ffd200)"><i class="fa fa-dumbbell"></i></div>
                <div class="tc-info"><div class="tc-name">Workout Hits</div><div class="tc-plays">710k plays</div></div>
                <div class="tc-bar"><div class="tc-fill" style="width:78%;background:var(--c)"></div></div>
              </div>
              <div class="trend-cat-item" style="--c:#7B61FF">
                <div class="tc-rank">3</div>
                <div class="tc-icon" style="background: linear-gradient(135deg,#4776e6,#8e54e9)"><i class="fa fa-cloud"></i></div>
                <div class="tc-info"><div class="tc-name">Chill Vibes</div><div class="tc-plays">598k plays</div></div>
                <div class="tc-bar"><div class="tc-fill" style="width:65%;background:var(--c)"></div></div>
              </div>
              <div class="trend-cat-item" style="--c:#FF3366">
                <div class="tc-rank">4</div>
                <div class="tc-icon" style="background: linear-gradient(135deg,#f953c6,#b91d73)"><i class="fa fa-heart"></i></div>
                <div class="tc-info"><div class="tc-name">Romantic Songs</div><div class="tc-plays">487k plays</div></div>
                <div class="tc-bar"><div class="tc-fill" style="width:53%;background:var(--c)"></div></div>
              </div>
              <div class="trend-cat-item" style="--c:#FFD700">
                <div class="tc-rank">5</div>
                <div class="tc-icon" style="background: linear-gradient(135deg,#f7971e,#ffd200)"><i class="fa fa-champagne-glasses"></i></div>
                <div class="tc-info"><div class="tc-name">Party Mix</div><div class="tc-plays">421k plays</div></div>
                <div class="tc-bar"><div class="tc-fill" style="width:46%;background:var(--c)"></div></div>
              </div>
            </div>
          </div>

          <div class="panel">
            <div class="panel-header">
              <div class="panel-title">Quick Actions</div>
            </div>
            <div class="quick-actions">
              <button class="qa-btn" data-page="add-song"><i class="fa fa-plus"></i><span>Add Song</span></button>
              <button class="qa-btn" data-page="add-category"><i class="fa fa-folder-plus"></i><span>Add Category</span></button>
              <button class="qa-btn" data-page="artists"><i class="fa fa-microphone"></i><span>Artists</span></button>
              <button class="qa-btn" data-page="analytics"><i class="fa fa-chart-bar"></i><span>Analytics</span></button>
              <button class="qa-btn" data-page="users"><i class="fa fa-user-plus"></i><span>Users</span></button>
              <button class="qa-btn" data-page="settings"><i class="fa fa-sliders"></i><span>Settings</span></button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ========== CATEGORIES PAGE ========== -->
    <div class="page" id="page-categories">
      <div class="page-actions-bar">
        <div class="pab-left">
          <div class="search-field"><i class="fa fa-search"></i><input type="text" placeholder="Search categories…"></div>
        </div>
        <div class="pab-right">
          <button class="btn-primary-action" data-page="add-category"><i class="fa fa-plus"></i> Add Category</button>
        </div>
      </div>

      <div class="categories-grid">
      <?php while($row = mysqli_fetch_assoc($result)){

        $color = $row['accent_color'];
        $icon = $row['icon']; ?>
            <div class="cat-card"
            style="--cat-color: <?php echo $color; ?>">

            <div class="cat-bg">
                <div class="cat-bg-glow"
                    style="background:<?php echo $color; ?>">
                </div>
            </div>

            <div class="cat-icon">
                <i class="fa <?php echo $icon; ?>"></i>
            </div>

            <div class="cat-body">

                <div class="cat-name">
                    <?php echo htmlspecialchars($row['c_name']); ?>
                </div>

                <div class="cat-slug">
                    /category/<?php echo htmlspecialchars($row['slug']); ?>
                </div>

                <div class="cat-stats">
                    <span>
                        <i class="fa fa-music"></i>
                        0 songs
                    </span>

                    <span>
                        <i class="fa fa-headphones"></i>
                        0 plays
                    </span>
                </div>

            </div>

            <div class="cat-badge <?php echo $row['status'] == 'published' ? 'active' : 'draft'; ?>">

                <?php echo ucfirst($row['status']); ?>

            </div>

            <div class="cat-actions">

                <button
                    title="View"
                    onclick="window.location.href='category.php?slug=<?php echo $row['slug']; ?>'">
                    <i class="fa fa-eye"></i>
                </button>

                <button
                    title="Edit"
                    onclick="window.location.href='edit_category.php?id=<?php echo $row['id']; ?>'">
                    <i class="fa fa-pen"></i>
                </button>

                <button
                    title="Delete"
                    class="danger"
                    onclick="deleteCategory(<?php echo $row['id']; ?>)">
                    <i class="fa fa-trash"></i>
                </button>

            </div>

        </div>
        <?php } ?>
      </div>
    </div>

    <!-- ========== ADD CATEGORY PAGE ========== -->
    <div class="page" id="page-add-category">
      <div class="form-page-wrap">
        <div class="form-card">
          <div class="form-card-header">
            <div class="fch-icon"><i class="fa fa-folder-plus"></i></div>
            <div>
              <div class="fch-title">Add New Category</div>
              <div class="fch-sub">Categories automatically generate frontend collection pages</div>
            </div>
          </div>
          <form class="form-body" action="save_category.php" method="POST" id="categoryForm">
                <div class="form-group">
                    <label>Category Name <span class="req">*</span></label>
                    <input
                        type="text"
                        class="form-input"
                        id="catNameInput"
                        name="category_name"
                        placeholder="e.g. Late Night Drives"
                        required
                        oninput="updateSlugPreview(this.value)">
                    
                    <input type="hidden" name="slug" id="slugInput">
                    
                    <div class="form-hint">Give it a memorable, descriptive name</div>
                </div>

                <div class="form-group">
                    <label>Auto-generated URL Slug</label>
                    <div class="slug-preview">
                        <span class="slug-base">soundwave.com/category/</span>
                        <span class="slug-val" id="slugPreview">late-night-drives</span>
                    </div>
                    <div class="form-hint success">
                        <i class="fa fa-circle-check"></i> Page will be automatically created at this URL
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Icon</label>
                        <div class="icon-picker" id="iconPicker">
                            <div class="icon-opt selected" data-icon="fa-moon"><i class="fa fa-moon"></i></div>
                            <div class="icon-opt" data-icon="fa-dumbbell"><i class="fa fa-dumbbell"></i></div>
                            <div class="icon-opt" data-icon="fa-cloud"><i class="fa fa-cloud"></i></div>
                            <div class="icon-opt" data-icon="fa-champagne-glasses"><i class="fa fa-champagne-glasses"></i></div>
                            <div class="icon-opt" data-icon="fa-heart"><i class="fa fa-heart"></i></div>
                            <div class="icon-opt" data-icon="fa-fire"><i class="fa fa-fire"></i></div>
                            <div class="icon-opt" data-icon="fa-star"><i class="fa fa-star"></i></div>
                            <div class="icon-opt" data-icon="fa-guitar"><i class="fa fa-guitar"></i></div>
                        </div>
                        <input type="hidden" name="icon" id="iconInput" value="fa-moon">
                    </div>

                    <div class="form-group">
                        <label>Accent Color</label>
                        <div class="color-picker" id="colorPicker">
                        <!-- <div class="cp-swatch selected" style="background: #00270e" data-color="#00270e"></div> -->
                            <!-- <div class="cp-swatch" style="background: #350e00" data-color="#350e00"></div>
                            <div class="cp-swatch" style="background: #07002c" data-color="#07002c"></div>
                            <div class="cp-swatch" style="background: #2b000b" data-color="#2b000b"></div>
                            <div class="cp-swatch" style="background: #292300" data-color="#292300"></div>
                            <div class="cp-swatch" style="background: #00232b" data-color="#00232b"></div> -->
                            <div class="cp-swatch selected" style="background: linear-gradient(135deg, #232526 0%, #1c1e22 100%);" data-color="linear-gradient(135deg, #232526 0%, #1c1e22 100%)"></div>
                            <div class="cp-swatch" style="background: linear-gradient(135deg, #090a0f 0%, #181824 100%);" data-color="linear-gradient(135deg, #090a0f 0%, #181824 100%)"></div>
                            <div class="cp-swatch" style="background: linear-gradient(135deg, #171717 0%, #283E51 100%);" data-color="linear-gradient(135deg, #171717 0%, #283E51 100%)"></div>
                            <div class="cp-swatch" style="background: linear-gradient(135deg, #231a2b 0%, #254251 100%);" data-color="linear-gradient(135deg, #231a2b 0%, #254251 100%)"></div>
                            <div class="cp-swatch" style="background: linear-gradient(135deg, #232526 0%, #1e232b 100%);" data-color="linear-gradient(135deg, #232526 0%, #1e232b 100%)"></div>
                            <div class="cp-swatch" style="background: linear-gradient(135deg, #232526 0%, #00151a 100%);" data-color="linear-gradient(135deg, #232526 0%, #00151a 100%)"></div>
                       
                       
                            <input type="color" class="cp-custom" value="rgb(255, 255, 255)" title="Custom color" id="customColor">
                        </div>
                        <input type="hidden" name="accent_color" id="colorInput" value="rgb(0, 34, 12)">
                    </div>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-input" name="description" rows="3" placeholder="Describe this category…"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-input" name="status">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Featured</label>
                        <div class="toggle-wrap">
                            <label class="toggle">
                                <input type="checkbox" name="featured" value="1" checked>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="toggle-label">Show on homepage</span>
                        </div>
                    </div>
                </div>

                <div class="form-info-box">
                    <i class="fa fa-circle-info"></i>
                    <p>When you name a category <strong>"Late Night Drives"</strong>, the system automatically creates <strong>/category/late-night-drives</strong> — no manual page creation needed.</p>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-cancel" data-page="categories">Cancel</button>
                    <button type="submit" class="btn-save" name="save_category">
                        <i class="fa fa-check"></i> Create Category
                    </button>
                </div>
            </form>
        </div>

        <!-- Preview Card -->
        <div class="preview-card">
          <div class="preview-card-header">Live Preview</div>
          <div class="cat-preview-box">
            <div class="cpb-inner" id="catPreviewBox">
              <div class="cpb-glow" style="background:#1DB954"></div>
              <div class="cpb-icon"><i class="fa fa-moon"></i></div>
              <div class="cpb-name" id="previewName">Late Night Drives</div>
              <div class="cpb-url" id="previewUrl">/category/late-night-drives</div>
              <div class="cpb-meta">0 songs · Just created</div>
            </div>
          </div>
          <div class="preview-note"><i class="fa fa-wand-magic-sparkles"></i> This card is auto-generated. Edit the form to see it update.</div>
        </div>
      </div>
    </div>

    <!-- ========== SONGS PAGE ========== -->
    <div class="page" id="page-songs">
      <div class="page-actions-bar">
        <div class="pab-left">
          <div class="search-field"><i class="fa fa-search"></i><input type="text" placeholder="Search songs, artists…"></div>
          <select class="filter-select">
            <option>All Categories</option>
            <option>Late Night Drives</option>
            <option>Workout Hits</option>
            <option>Chill Vibes</option>
            <option>Party Mix</option>
          </select>
          <select class="filter-select">
            <option>All Status</option>
            <option>Published</option>
            <option>Draft</option>
          </select>
        </div>
        <div class="pab-right">
          <button class="btn-primary-action" data-page="add-song"><i class="fa fa-plus"></i> Add Song</button>
        </div>
      </div>

      <div class="table-card">
        <table class="data-table">
          <thead>
            <tr>
              <th><input type="checkbox" class="check-all"></th>
              <th>Song</th>
              <th>Artist</th>
              <th>Album</th>
              <th>Category</th>
              <th>Duration</th>
              <th>Plays</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          <tbody>
            <?php

            $sql = "SELECT
                        songs.*,
                        music_categories.c_name
                    FROM songs
                    LEFT JOIN music_categories
                    ON songs.category_id = music_categories.id
                    ORDER BY songs.id DESC";

            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){

                while($song = mysqli_fetch_assoc($result)){
                  // Ensure the song file path is relative from dashboard, fallback if missing
                  $audioSrc = isset($song['file_path']) && !empty($song['file_path'])
                      ? (strpos($song['file_path'], '/') === 0 ? ".." . $song['file_path'] : $song['file_path'])
                      : '';
            ?>

            <tr>

                <td>
                    <input type="checkbox" value="<?php echo $song['id']; ?>">
                </td>

                <td>
                    <div class="song-cell">

                        <div class="song-thumb" style="position: relative;">
                            <img src="https://picsum.photos/seed/<?php echo $song['id']; ?>/48/48" alt="">
                            <div class="song-play-overlay"
                                 style="cursor:pointer;"
                                 onclick="playPauseSong('<?php echo $song['id']; ?>', '<?php echo htmlspecialchars($audioSrc, ENT_QUOTES); ?>', this)">
                                <i class="fa fa-play" id="play-icon-<?php echo $song['id']; ?>"></i>
                                <i class="fa fa-pause" id="pause-icon-<?php echo $song['id']; ?>" style="display:none"></i>
                            </div>
                            <?php
                              $audioSrc = htmlspecialchars($song['file_path']);
                              ?>
                              <audio id="audio-<?php echo $song['id']; ?>" preload="metadata">
                                  <source src="<?php echo $audioSrc; ?>" type="audio/mpeg">
                              </audio>
                        </div>

                        <div class="song-meta">

                            <div class="song-title">
                                <?php echo htmlspecialchars($song['title']); ?>
                            </div>

                            <?php if($song['trending_song'] == 1){ ?>
                                <div class="song-feat">
                                    <i class="fa fa-fire-flame-curved text-orange"></i>
                                    Trending
                                </div>
                            <?php } ?>

                            <?php if($song['featured_song'] == 1){ ?>
                                <div class="song-feat">
                                    <i class="fa fa-star text-warning"></i>
                                    Featured
                                </div>
                            <?php } ?>

                            <?php if($song['new_release'] == 1){ ?>
                                <div class="song-feat">
                                    <i class="fa fa-bolt text-success"></i>
                                    New Release
                                </div>
                            <?php } ?>

                        </div>

                    </div>
                </td>

                <td>
                    <div class="artist-cell">
                        <span>
                            <?php echo htmlspecialchars($song['artist']); ?>
                        </span>
                    </div>
                </td>

                <td>
                    <?php echo htmlspecialchars($song['album']); ?>
                </td>

                <td>
                    <span class="cat-pill">
                        <?php echo htmlspecialchars($song['c_name']); ?>
                    </span>
                </td>

                <td>
                    <?php echo htmlspecialchars($song['duration']); ?>
                </td>

                <td>
                    <?php echo number_format($song['popularity']); ?>
                </td>

                <td>
                    <span class="status-badge <?php echo $song['status']; ?>">
                        <?php echo ucfirst($song['status']); ?>
                    </span>
                </td>

                <td>

                    <div class="action-btns">

                        <button type="button"
                                class="ab view"
                                onclick="playPauseSong('<?php echo $song['id']; ?>', '<?php echo htmlspecialchars($audioSrc, ENT_QUOTES); ?>', this)">
                            <i class="fa fa-play" id="action-play-icon-<?php echo $song['id']; ?>"></i>
                            <i class="fa fa-pause" id="action-pause-icon-<?php echo $song['id']; ?>" style="display:none"></i>
                        </button>

                        <a href="edit_song.php?id=<?php echo $song['id']; ?>" class="ab edit">
                            <i class="fa fa-pen"></i>
                        </a>

                        <a href="delete_song.php?id=<?php echo $song['id']; ?>"
                          class="ab del"
                          onclick="return confirm('Delete this song?')">
                            <i class="fa fa-trash"></i>
                        </a>

                    </div>

                </td>

            </tr>

            <?php
                }
            }else{
            ?>

            <tr>
                <td colspan="9" style="text-align:center;padding:40px;">
                    No Songs Found
                </td>
            </tr>

            <?php
            }
            ?>
            </tbody>
            <script>
              let currentAudio = null;

              function playPauseSong(songId) {

                  const audio = document.getElementById('audio-' + songId);

                  const playIcon = document.getElementById('play-icon-' + songId);
                  const pauseIcon = document.getElementById('pause-icon-' + songId);

                  const actionPlayIcon = document.getElementById('action-play-icon-' + songId);
                  const actionPauseIcon = document.getElementById('action-pause-icon-' + songId);

                  // Stop previous song
                  if(currentAudio && currentAudio !== audio){
                      currentAudio.pause();

                      document.querySelectorAll('[id^="play-icon-"]').forEach(el=>{
                          el.style.display = '';
                      });

                      document.querySelectorAll('[id^="pause-icon-"]').forEach(el=>{
                          el.style.display = 'none';
                      });

                      document.querySelectorAll('[id^="action-play-icon-"]').forEach(el=>{
                          el.style.display = '';
                      });

                      document.querySelectorAll('[id^="action-pause-icon-"]').forEach(el=>{
                          el.style.display = 'none';
                      });
                  }

                  if(audio.paused){

                      audio.play()
                      .then(() => {

                          playIcon.style.display = 'none';
                          pauseIcon.style.display = '';

                          if(actionPlayIcon){
                              actionPlayIcon.style.display = 'none';
                              actionPauseIcon.style.display = '';
                          }

                          currentAudio = audio;

                      })
                      .catch(err => {
                          console.log(err);
                          alert('Unable to play audio');
                      });

                  } else {

                      audio.pause();

                      playIcon.style.display = '';
                      pauseIcon.style.display = 'none';

                      if(actionPlayIcon){
                          actionPlayIcon.style.display = '';
                          actionPauseIcon.style.display = 'none';
                      }
                  }

                  audio.onended = () => {

                      playIcon.style.display = '';
                      pauseIcon.style.display = 'none';

                      if(actionPlayIcon){
                          actionPlayIcon.style.display = '';
                          actionPauseIcon.style.display = 'none';
                      }
                  };
              }
              </script>
        </table>
        <div class="table-footer">
          <div class="tf-info">Showing 6 of 2,417 songs</div>
          <div class="tf-pagination">
            <button class="pg-btn"><i class="fa fa-chevron-left"></i></button>
            <button class="pg-btn active">1</button>
            <button class="pg-btn">2</button>
            <button class="pg-btn">3</button>
            <span>…</span>
            <button class="pg-btn">242</button>
            <button class="pg-btn"><i class="fa fa-chevron-right"></i></button>
          </div>
        </div>
      </div>
    </div>

    <!-- ========== ADD SONG PAGE ========== -->
    <div class="page" id="page-add-song">
      <div class="add-song-layout">
        <!-- Form Side -->
        <div class="form-card">

          <div class="form-card-header">
            <div class="fch-icon green"><i class="fa fa-music"></i></div>
            <div>
              <div class="fch-title">Add New Song</div>
              <div class="fch-sub">Upload a track and fill in the details below</div>
            </div>
            <div class="header-waveform">
              <span></span><span></span><span></span><span></span>
              <span></span><span></span><span></span><span></span>
            </div>
          </div>

          <form class="form-body" action="save_song.php" method="POST" enctype="multipart/form-data">

            <!-- File upload -->
            <div class="form-group" style="margin-bottom:0">
              <label><i class="fa fa-upload" style="opacity:.6"></i> Music File <span class="req">*</span></label>
              <div class="file-upload-zone" id="dropZone">
                <input type="file" name="music_file" id="musicFileInput" accept=".mp3,.wav,.flac,.aac,.ogg">
                <div class="upload-icon"><i class="fa fa-cloud-arrow-up"></i></div>
                <div class="upload-title">Drop your track here</div>
                <div class="upload-hint">or <strong>browse files</strong> from your device</div>
                <div class="upload-formats">
                  <span class="fmt-badge">MP3</span>
                  <span class="fmt-badge">WAV</span>
                  <span class="fmt-badge">FLAC</span>
                  <span class="fmt-badge">AAC</span>
                  <span class="fmt-badge">OGG</span>
                </div>
                <div id="fileNameDisplay"></div>
              </div>
            </div>

            <!-- Song details -->
            <div class="section-divider"><span>Track Details</span></div>

            <div class="form-row">
              <div class="form-group">
                <label><i class="fa fa-music" style="opacity:.5"></i> Song Title</label>
                <input type="text" name="title" class="form-input" id="fTitle" placeholder="e.g. Blinding Lights">
              </div>
              <div class="form-group">
                <label><i class="fa fa-microphone" style="opacity:.5"></i> Artist Name</label>
                <input type="text" name="artist" class="form-input" id="fArtist" placeholder="e.g. The Weeknd">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label><i class="fa fa-record-vinyl" style="opacity:.5"></i> Album</label>
                <input type="text" name="album" class="form-input" id="fAlbum" placeholder="e.g. After Hours">
              </div>
              <div class="form-group">
                <label><i class="fa fa-clock" style="opacity:.5"></i> Duration</label>
                <input type="text" name="duration" class="form-input" id="fDuration" placeholder="e.g. 3:22">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label><i class="fa fa-tag" style="opacity:.5"></i> Genre</label>
                <input type="text" name="genre" class="form-input" id="fGenre" placeholder="e.g. Synth-pop">
              </div>
              <div class="form-group">
                <label><i class="fa fa-calendar" style="opacity:.5"></i> Release Date</label>
                <input type="date" name="release_date" class="form-input" id="fRelease">
              </div>
            </div>

            <!-- Popularity -->
            <div class="form-group">
              <label><i class="fa fa-fire" style="opacity:.5"></i> Popularity Score</label>
              <div class="popularity-bar-wrap">
                <div class="pop-bar"><div class="pop-fill" id="popFill"></div></div>
                <span id="popScore" class="pop-score">0</span>
              </div>
              <div class="pop-input-wrap">
                <input type="range" min="0" max="100" value="0" id="popRange" name="popularity">
              </div>
            </div>

            <!-- Category -->
            <div class="section-divider"><span>Classification</span></div>

            <div class="form-group">
              <label><i class="fa fa-folder" style="opacity:.5"></i> Category <span class="req">*</span></label>
              <select class="form-input" name="category_id" required>
                <option value="">Select a category…</option>
                <?php 
                  $cat_query = mysqli_query($conn, "SELECT * FROM music_categories");
                  if ($cat_query) {
                    while($cat = mysqli_fetch_assoc($cat_query)){
                ?>
                <option value="<?php echo htmlspecialchars($cat['id']); ?>">
                  <?php echo htmlspecialchars($cat['c_name']); ?>
                </option>
                <?php 
                    }
                  } 
                ?>
           
                
              </select>
            </div>

            <!-- Toggles -->
            <div class="toggles-row" id="togglesRow">
              <div class="toggle-item" id="ti0">
                <label class="toggle"><input type="checkbox" name="featured_song" value="1" id="chk0"><span class="toggle-slider"></span></label>
                <div class="ti-label"><span>Featured Song</span><small>Show on homepage</small></div>
              </div>
              <div class="toggle-item active" id="ti1">
                <label class="toggle"><input type="checkbox" name="trending_song" value="1" checked id="chk1"><span class="toggle-slider"></span></label>
                <div class="ti-label"><span>Trending</span><small>Mark as trending</small></div>
              </div>
              <div class="toggle-item" id="ti2">
                <label class="toggle"><input type="checkbox" name="new_release" value="1" id="chk2"><span class="toggle-slider"></span></label>
                <div class="ti-label"><span>New Release</span><small>Show in new releases</small></div>
              </div>
            </div>

            <!-- Status -->
            <div class="form-group">
              <label><i class="fa fa-circle-dot" style="opacity:.5"></i> Status</label>
              <div class="status-radio">
                <label class="sr-opt selected" onclick="setStatus(this)">
                  <input type="radio" name="status" value="published" checked>
                  <span class="sr-dot"></span> Published
                </label>
                <label class="sr-opt" onclick="setStatus(this)">
                  <input type="radio" name="status" value="draft">
                  <span class="sr-dot"></span> Draft
                </label>
              </div>
            </div>

            <!-- Actions -->
            <div class="form-actions">
              <button type="button" class="btn-cancel"><i class="fa fa-xmark"></i> Cancel</button>
              <button type="button" class="btn-preview-song" id="previewSongBtn" style="display:none">
                <i class="fa fa-play"></i> Preview
              </button>
              <button type="submit" class="btn-save"><i class="fa fa-check"></i> Save Song</button>
            </div>

          </form>
          </div>

        <!-- Preview Card Side -->
        <div class="song-preview-panel" id="songPreviewPanel">
          <div class="spp-placeholder" id="sppPlaceholder">
            <div class="spp-icon"><i class="fa fa-music"></i></div>
            <div class="spp-msg">Paste a URL and click <strong>Fetch Details</strong> to preview the song card</div>
          </div>
          <div class="song-preview-card" id="songPreviewCard" style="display:none">
            <div class="spc-cover-wrap">
              <img src="" alt="" id="spcCover" class="spc-cover">
              <div class="spc-overlay">
                <button class="spc-play-btn"><i class="fa fa-play"></i></button>
              </div>
            </div>
            <div class="spc-body">
              <div class="spc-badges">
                <span class="spc-badge trending"><i class="fa fa-fire-flame-curved"></i> Trending</span>
                <span class="spc-badge new-rel"><i class="fa fa-bolt"></i> New</span>
              </div>
              <div class="spc-title" id="spcTitle">Song Title</div>
              <div class="spc-artist-row">
                <img src="" alt="" id="spcArtistImg" class="spc-artist-thumb">
                <div>
                  <div class="spc-artist" id="spcArtist">Artist Name</div>
                  <div class="spc-album" id="spcAlbum">Album Name</div>
                </div>
              </div>
              <div class="spc-details">
                <div class="spc-det"><i class="fa fa-clock"></i><span id="spcDuration">—</span></div>
                <div class="spc-det"><i class="fa fa-calendar"></i><span id="spcRelease">—</span></div>
                <div class="spc-det"><i class="fa fa-tag"></i><span id="spcGenre">—</span></div>
              </div>
              <div class="spc-pop-row">
                <span>Popularity</span>
                <div class="spc-pop-bar"><div class="spc-pop-fill" id="spcPopFill"></div></div>
                <span id="spcPopScore">—</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ========== ARTISTS PAGE ========== -->
    <div class="page" id="page-artists">
      <div class="page-actions-bar">
        <div class="pab-left">
          <div class="search-field"><i class="fa fa-search"></i><input type="text" placeholder="Search artists…"></div>
        </div>
      </div>
      <div class="artists-grid">
        <div class="artist-card" style="--ac:#1DB954">
          <div class="artist-card-bg"><div class="acbg-grad" style="background:linear-gradient(160deg,#1DB95440,transparent)"></div></div>
          <div class="artist-img-wrap"><img src="https://picsum.photos/seed/art1/120/120" alt="The Weeknd" class="artist-img"></div>
          <div class="artist-name">The Weeknd</div>
          <div class="artist-genre">R&B · Pop</div>
          <div class="artist-stats-row">
            <div class="as-item"><div class="as-val">48</div><div class="as-key">Songs</div></div>
            <div class="as-item"><div class="as-val">663k</div><div class="as-key">Plays</div></div>
            <div class="as-item"><div class="as-val">2</div><div class="as-key">Albums</div></div>
          </div>
          <div class="artist-actions"><button>View Profile</button><button class="outlined">Edit</button></div>
        </div>
        <div class="artist-card" style="--ac:#FF3366">
          <div class="artist-card-bg"><div class="acbg-grad" style="background:linear-gradient(160deg,#FF336640,transparent)"></div></div>
          <div class="artist-img-wrap"><img src="https://picsum.photos/seed/art2/120/120" alt="Dua Lipa" class="artist-img"></div>
          <div class="artist-name">Dua Lipa</div>
          <div class="artist-genre">Pop · Dance</div>
          <div class="artist-stats-row">
            <div class="as-item"><div class="as-val">32</div><div class="as-key">Songs</div></div>
            <div class="as-item"><div class="as-val">412k</div><div class="as-key">Plays</div></div>
            <div class="as-item"><div class="as-val">3</div><div class="as-key">Albums</div></div>
          </div>
          <div class="artist-actions"><button>View Profile</button><button class="outlined">Edit</button></div>
        </div>
        <div class="artist-card" style="--ac:#7B61FF">
          <div class="artist-card-bg"><div class="acbg-grad" style="background:linear-gradient(160deg,#7B61FF40,transparent)"></div></div>
          <div class="artist-img-wrap"><img src="https://picsum.photos/seed/art3/120/120" alt="Glass Animals" class="artist-img"></div>
          <div class="artist-name">Glass Animals</div>
          <div class="artist-genre">Indie · Alt</div>
          <div class="artist-stats-row">
            <div class="as-item"><div class="as-val">24</div><div class="as-key">Songs</div></div>
            <div class="as-item"><div class="as-val">280k</div><div class="as-key">Plays</div></div>
            <div class="as-item"><div class="as-val">2</div><div class="as-key">Albums</div></div>
          </div>
          <div class="artist-actions"><button>View Profile</button><button class="outlined">Edit</button></div>
        </div>
        <div class="artist-card" style="--ac:#FF69B4">
          <div class="artist-card-bg"><div class="acbg-grad" style="background:linear-gradient(160deg,#FF69B440,transparent)"></div></div>
          <div class="artist-img-wrap"><img src="https://picsum.photos/seed/art4/120/120" alt="Taylor Swift" class="artist-img"></div>
          <div class="artist-name">Taylor Swift</div>
          <div class="artist-genre">Pop · Country</div>
          <div class="artist-stats-row">
            <div class="as-item"><div class="as-val">89</div><div class="as-key">Songs</div></div>
            <div class="as-item"><div class="as-val">1.2M</div><div class="as-key">Plays</div></div>
            <div class="as-item"><div class="as-val">11</div><div class="as-key">Albums</div></div>
          </div>
          <div class="artist-actions"><button>View Profile</button><button class="outlined">Edit</button></div>
        </div>
        <div class="artist-card" style="--ac:#FFD700">
          <div class="artist-card-bg"><div class="acbg-grad" style="background:linear-gradient(160deg,#FFD70040,transparent)"></div></div>
          <div class="artist-img-wrap"><img src="https://picsum.photos/seed/art5/120/120" alt="Harry Styles" class="artist-img"></div>
          <div class="artist-name">Harry Styles</div>
          <div class="artist-genre">Pop · Rock</div>
          <div class="artist-stats-row">
            <div class="as-item"><div class="as-val">21</div><div class="as-key">Songs</div></div>
            <div class="as-item"><div class="as-val">340k</div><div class="as-key">Plays</div></div>
            <div class="as-item"><div class="as-val">3</div><div class="as-key">Albums</div></div>
          </div>
          <div class="artist-actions"><button>View Profile</button><button class="outlined">Edit</button></div>
        </div>
        <div class="artist-card" style="--ac:#00CFFF">
          <div class="artist-card-bg"><div class="acbg-grad" style="background:linear-gradient(160deg,#00CFFF40,transparent)"></div></div>
          <div class="artist-img-wrap"><img src="https://picsum.photos/seed/art6/120/120" alt="Billie Eilish" class="artist-img"></div>
          <div class="artist-name">Billie Eilish</div>
          <div class="artist-genre">Alt Pop · Indie</div>
          <div class="artist-stats-row">
            <div class="as-item"><div class="as-val">36</div><div class="as-key">Songs</div></div>
            <div class="as-item"><div class="as-val">521k</div><div class="as-key">Plays</div></div>
            <div class="as-item"><div class="as-val">3</div><div class="as-key">Albums</div></div>
          </div>
          <div class="artist-actions"><button>View Profile</button><button class="outlined">Edit</button></div>
        </div>
      </div>
    </div>

    <!-- ========== ALBUMS PAGE ========== -->
    <div class="page" id="page-albums">
      <div class="page-actions-bar">
        <div class="pab-left">
          <div class="search-field"><i class="fa fa-search"></i><input type="text" placeholder="Search albums…"></div>
        </div>
      </div>
      <div class="albums-grid">
        <div class="album-card"><img src="https://picsum.photos/seed/alb1/200/200" alt="Starboy" class="album-cover"><div class="album-info"><div class="album-title">Starboy</div><div class="album-artist">The Weeknd</div><div class="album-meta"><span><i class="fa fa-music"></i> 18 songs</span><span><i class="fa fa-calendar"></i> 2016</span></div></div><div class="album-hover-overlay"><button><i class="fa fa-eye"></i> View</button><button><i class="fa fa-pen"></i> Edit</button></div></div>
        <div class="album-card"><img src="https://picsum.photos/seed/alb2/200/200" alt="Future Nostalgia" class="album-cover"><div class="album-info"><div class="album-title">Future Nostalgia</div><div class="album-artist">Dua Lipa</div><div class="album-meta"><span><i class="fa fa-music"></i> 11 songs</span><span><i class="fa fa-calendar"></i> 2020</span></div></div><div class="album-hover-overlay"><button><i class="fa fa-eye"></i> View</button><button><i class="fa fa-pen"></i> Edit</button></div></div>
        <div class="album-card"><img src="https://picsum.photos/seed/alb3/200/200" alt="Dreamland" class="album-cover"><div class="album-info"><div class="album-title">Dreamland</div><div class="album-artist">Glass Animals</div><div class="album-meta"><span><i class="fa fa-music"></i> 10 songs</span><span><i class="fa fa-calendar"></i> 2020</span></div></div><div class="album-hover-overlay"><button><i class="fa fa-eye"></i> View</button><button><i class="fa fa-pen"></i> Edit</button></div></div>
        <div class="album-card"><img src="https://picsum.photos/seed/alb4/200/200" alt="Midnights" class="album-cover"><div class="album-info"><div class="album-title">Midnights</div><div class="album-artist">Taylor Swift</div><div class="album-meta"><span><i class="fa fa-music"></i> 13 songs</span><span><i class="fa fa-calendar"></i> 2022</span></div></div><div class="album-hover-overlay"><button><i class="fa fa-eye"></i> View</button><button><i class="fa fa-pen"></i> Edit</button></div></div>
        <div class="album-card"><img src="https://picsum.photos/seed/alb5/200/200" alt="Harry's House" class="album-cover"><div class="album-info"><div class="album-title">Harry's House</div><div class="album-artist">Harry Styles</div><div class="album-meta"><span><i class="fa fa-music"></i> 13 songs</span><span><i class="fa fa-calendar"></i> 2022</span></div></div><div class="album-hover-overlay"><button><i class="fa fa-eye"></i> View</button><button><i class="fa fa-pen"></i> Edit</button></div></div>
        <div class="album-card"><img src="https://picsum.photos/seed/alb6/200/200" alt="After Hours" class="album-cover"><div class="album-info"><div class="album-title">After Hours</div><div class="album-artist">The Weeknd</div><div class="album-meta"><span><i class="fa fa-music"></i> 14 songs</span><span><i class="fa fa-calendar"></i> 2020</span></div></div><div class="album-hover-overlay"><button><i class="fa fa-eye"></i> View</button><button><i class="fa fa-pen"></i> Edit</button></div></div>
        <div class="album-card"><img src="https://picsum.photos/seed/alb7/200/200" alt="Happier Than Ever" class="album-cover"><div class="album-info"><div class="album-title">Happier Than Ever</div><div class="album-artist">Billie Eilish</div><div class="album-meta"><span><i class="fa fa-music"></i> 16 songs</span><span><i class="fa fa-calendar"></i> 2021</span></div></div><div class="album-hover-overlay"><button><i class="fa fa-eye"></i> View</button><button><i class="fa fa-pen"></i> Edit</button></div></div>
        <div class="album-card"><img src="https://picsum.photos/seed/alb8/200/200" alt="SOS" class="album-cover"><div class="album-info"><div class="album-title">SOS</div><div class="album-artist">SZA</div><div class="album-meta"><span><i class="fa fa-music"></i> 23 songs</span><span><i class="fa fa-calendar"></i> 2022</span></div></div><div class="album-hover-overlay"><button><i class="fa fa-eye"></i> View</button><button><i class="fa fa-pen"></i> Edit</button></div></div>
      </div>
    </div>

    <!-- ========== ANALYTICS PAGE ========== -->
    <div class="page" id="page-analytics">
      <div class="analytics-layout">
        <div class="analytics-charts-col">
          <div class="chart-card full">
            <div class="chart-card-header">
              <div><div class="chart-title">User Growth</div><div class="chart-sub">Monthly active users over the year</div></div>
              <div class="chart-filters">
                <button class="cf-btn active">2026</button>
                <button class="cf-btn">2025</button>
              </div>
            </div>
            <canvas id="userGrowthChart" height="220"></canvas>
          </div>
          <div class="chart-row-2">
            <div class="chart-card">
              <div class="chart-card-header"><div><div class="chart-title">Top Artists</div><div class="chart-sub">By play count</div></div></div>
              <canvas id="topArtistsChart" height="220"></canvas>
            </div>
            <div class="chart-card">
              <div class="chart-card-header"><div><div class="chart-title">Top Albums</div><div class="chart-sub">By play count</div></div></div>
              <canvas id="topAlbumsChart" height="220"></canvas>
            </div>
          </div>
        </div>
        <div class="analytics-side-col">
          <div class="panel">
            <div class="panel-header"><div class="panel-title">Top Songs</div><span class="trending-badge">All Time</span></div>
            <div class="top-songs-list">
              <div class="tsl-item"><span class="tsl-rank">1</span><img src="https://picsum.photos/seed/s6/36/36" alt=""><div class="tsl-info"><div class="tsl-title">Blinding Lights</div><div class="tsl-artist">The Weeknd</div></div><div class="tsl-plays">521k</div></div>
              <div class="tsl-item"><span class="tsl-rank">2</span><img src="https://picsum.photos/seed/s4/36/36" alt=""><div class="tsl-info"><div class="tsl-title">Anti-Hero</div><div class="tsl-artist">Taylor Swift</div></div><div class="tsl-plays">317k</div></div>
              <div class="tsl-item"><span class="tsl-rank">3</span><img src="https://picsum.photos/seed/s5/36/36" alt=""><div class="tsl-info"><div class="tsl-title">As It Was</div><div class="tsl-artist">Harry Styles</div></div><div class="tsl-plays">256k</div></div>
              <div class="tsl-item"><span class="tsl-rank">4</span><img src="https://picsum.photos/seed/s3/36/36" alt=""><div class="tsl-info"><div class="tsl-title">Heat Waves</div><div class="tsl-artist">Glass Animals</div></div><div class="tsl-plays">203k</div></div>
              <div class="tsl-item"><span class="tsl-rank">5</span><img src="https://picsum.photos/seed/s1/36/36" alt=""><div class="tsl-info"><div class="tsl-title">Starboy</div><div class="tsl-artist">The Weeknd</div></div><div class="tsl-plays">142k</div></div>
            </div>
          </div>
          <div class="panel analytics-kpis">
            <div class="panel-header"><div class="panel-title">Key Metrics</div></div>
            <div class="kpi-grid">
              <div class="kpi-item"><div class="kpi-val">4:22</div><div class="kpi-key">Avg Session</div></div>
              <div class="kpi-item"><div class="kpi-val">68%</div><div class="kpi-key">Retention</div></div>
              <div class="kpi-item"><div class="kpi-val">2.8</div><div class="kpi-key">Songs/Session</div></div>
              <div class="kpi-item"><div class="kpi-val">$0.003</div><div class="kpi-key">Rev/Play</div></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ========== SETTINGS PAGE ========== -->
    <div class="page" id="page-settings">
      <div class="settings-layout">
        <div class="settings-nav">
          <button class="sn-btn active" data-tab="general">General</button>
          <button class="sn-btn" data-tab="appearance">Appearance</button>
          <button class="sn-btn" data-tab="integrations">Integrations</button>
          <button class="sn-btn" data-tab="security">Security</button>
          <button class="sn-btn" data-tab="notifications-s">Notifications</button>
        </div>
        <div class="settings-body">
          <div class="settings-tab active" id="tab-general">
            <div class="settings-section">
              <div class="ss-title">Platform Settings</div>
              <div class="form-group"><label>Platform Name</label><input type="text" class="form-input" value="SoundWave"></div>
              <div class="form-group"><label>Platform URL</label><input type="text" class="form-input" value="https://soundwave.example.com"></div>
              <div class="form-group"><label>Admin Email</label><input type="email" class="form-input" value="admin@soundwave.com"></div>
              <div class="form-group"><label>Default Language</label><select class="form-input"><option>English</option><option>Spanish</option><option>French</option></select></div>
              <div class="form-group"><label>Songs per Page</label><input type="number" class="form-input" value="20"></div>
              <div class="settings-toggles">
                <div class="st-item"><div><div class="st-label">Maintenance Mode</div><div class="st-sub">Take the site offline for maintenance</div></div><label class="toggle"><input type="checkbox"><span class="toggle-slider"></span></label></div>
                <div class="st-item"><div><div class="st-label">User Registration</div><div class="st-sub">Allow new users to register</div></div><label class="toggle"><input type="checkbox" checked><span class="toggle-slider"></span></label></div>
                <div class="st-item"><div><div class="st-label">Auto-fetch Metadata</div><div class="st-sub">Automatically fetch song info from URL</div></div><label class="toggle"><input type="checkbox" checked><span class="toggle-slider"></span></label></div>
              </div>
              <button class="btn-save" style="margin-top:1.5rem"><i class="fa fa-check"></i> Save Settings</button>
            </div>
          </div>
          <div class="settings-tab" id="tab-appearance">
            <div class="settings-section">
              <div class="ss-title">Theme & Appearance</div>
              <div class="form-group"><label>Accent Color</label><div class="color-picker"><div class="cp-swatch selected" style="background:#1DB954"></div><div class="cp-swatch" style="background:#FF6B35"></div><div class="cp-swatch" style="background:#7B61FF"></div><div class="cp-swatch" style="background:#FF3366"></div><input type="color" class="cp-custom" value="#1DB954"></div></div>
              <div class="form-group"><label>Theme</label><div class="theme-opts"><button class="to-btn active">Dark</button><button class="to-btn">Light</button><button class="to-btn">System</button></div></div>
              <button class="btn-save" style="margin-top:1.5rem"><i class="fa fa-check"></i> Save Appearance</button>
            </div>
          </div>
          <div class="settings-tab" id="tab-integrations">
            <div class="settings-section">
              <div class="ss-title">API Integrations</div>
              <div class="form-group"><label>Spotify Client ID</label><input type="text" class="form-input" placeholder="Enter Spotify Client ID…"></div>
              <div class="form-group"><label>Spotify Client Secret</label><input type="password" class="form-input" placeholder="••••••••••••••••"></div>
              <div class="form-group"><label>YouTube Data API Key</label><input type="text" class="form-input" placeholder="Enter API Key…"></div>
              <div class="form-group"><label>Deezer App ID</label><input type="text" class="form-input" placeholder="Enter Deezer App ID…"></div>
              <button class="btn-save" style="margin-top:1.5rem"><i class="fa fa-check"></i> Save API Keys</button>
            </div>
          </div>
          <div class="settings-tab" id="tab-security">
            <div class="settings-section">
              <div class="ss-title">Security</div>
              <div class="form-group"><label>Current Password</label><input type="password" class="form-input" placeholder="••••••••"></div>
              <div class="form-group"><label>New Password</label><input type="password" class="form-input" placeholder="••••••••"></div>
              <div class="form-group"><label>Confirm Password</label><input type="password" class="form-input" placeholder="••••••••"></div>
              <div class="settings-toggles"><div class="st-item"><div><div class="st-label">Two-Factor Authentication</div><div class="st-sub">Enable 2FA for extra security</div></div><label class="toggle"><input type="checkbox"><span class="toggle-slider"></span></label></div></div>
              <button class="btn-save" style="margin-top:1.5rem"><i class="fa fa-check"></i> Update Password</button>
            </div>
          </div>
          <div class="settings-tab" id="tab-notifications-s">
            <div class="settings-section">
              <div class="ss-title">Notification Preferences</div>
              <div class="settings-toggles">
                <div class="st-item"><div><div class="st-label">New User Registrations</div><div class="st-sub">Get notified when a user signs up</div></div><label class="toggle"><input type="checkbox" checked><span class="toggle-slider"></span></label></div>
                <div class="st-item"><div><div class="st-label">Song Upload Alerts</div><div class="st-sub">Notify when new songs are added</div></div><label class="toggle"><input type="checkbox" checked><span class="toggle-slider"></span></label></div>
                <div class="st-item"><div><div class="st-label">Play Milestones</div><div class="st-sub">Alert at 100k, 500k, 1M plays</div></div><label class="toggle"><input type="checkbox"><span class="toggle-slider"></span></label></div>
                <div class="st-item"><div><div class="st-label">Weekly Reports</div><div class="st-sub">Receive weekly analytics email</div></div><label class="toggle"><input type="checkbox" checked><span class="toggle-slider"></span></label></div>
              </div>
              <button class="btn-save" style="margin-top:1.5rem"><i class="fa fa-check"></i> Save Preferences</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- PLAYLISTS, USERS, NOTIFICATIONS, PROFILE stubs -->
    <div class="page" id="page-playlists"><div class="placeholder-page"><i class="fa fa-list-music"></i><h2>Playlists</h2><p>Playlist management coming soon</p></div></div>
    <div class="page" id="page-users">
      <div class="page-actions-bar"><div class="pab-left"><div class="search-field"><i class="fa fa-search"></i><input type="text" placeholder="Search users…"></div></div></div>
      <div class="table-card">
        <table class="data-table">
          <thead><tr><th>#</th><th>User</th><th>Email</th><th>Joined</th><th>Plays</th><th>Status</th><th>Actions</th></tr></thead>
          <tbody>
            <tr><td>1</td><td><div class="artist-cell"><img src="https://picsum.photos/seed/u1/28/28" alt=""><span>Alex Rivera</span></div></td><td>alex@email.com</td><td>Jan 5, 2026</td><td>3,410</td><td><span class="status-badge published">Active</span></td><td><div class="action-btns"><button class="ab view"><i class="fa fa-eye"></i></button><button class="ab del"><i class="fa fa-ban"></i></button></div></td></tr>
            <tr><td>2</td><td><div class="artist-cell"><img src="https://picsum.photos/seed/u2/28/28" alt=""><span>Jamie Chen</span></div></td><td>jamie@email.com</td><td>Feb 12, 2026</td><td>1,890</td><td><span class="status-badge published">Active</span></td><td><div class="action-btns"><button class="ab view"><i class="fa fa-eye"></i></button><button class="ab del"><i class="fa fa-ban"></i></button></div></td></tr>
            <tr><td>3</td><td><div class="artist-cell"><img src="https://picsum.photos/seed/u3/28/28" alt=""><span>Morgan Lee</span></div></td><td>morgan@email.com</td><td>Mar 8, 2026</td><td>920</td><td><span class="status-badge draft">Inactive</span></td><td><div class="action-btns"><button class="ab view"><i class="fa fa-eye"></i></button><button class="ab del"><i class="fa fa-ban"></i></button></div></td></tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="page" id="page-notifications"><div class="notifications-list">
      <div class="notif-item unread"><div class="ni-icon green"><i class="fa fa-music"></i></div><div class="ni-body"><div class="ni-msg"><strong>Blinding Lights</strong> reached 500k plays!</div><div class="ni-time">2 hours ago</div></div></div>
      <div class="notif-item unread"><div class="ni-icon blue"><i class="fa fa-user-plus"></i></div><div class="ni-body"><div class="ni-msg"><strong>142 new users</strong> registered today</div><div class="ni-time">5 hours ago</div></div></div>
      <div class="notif-item unread"><div class="ni-icon orange"><i class="fa fa-fire"></i></div><div class="ni-body"><div class="ni-msg"><strong>Late Night Drives</strong> is trending #1</div><div class="ni-time">1 day ago</div></div></div>
      <div class="notif-item"><div class="ni-icon purple"><i class="fa fa-chart-line"></i></div><div class="ni-body"><div class="ni-msg">Weekly analytics report is ready</div><div class="ni-time">3 days ago</div></div></div>
      <div class="notif-item"><div class="ni-icon red"><i class="fa fa-triangle-exclamation"></i></div><div class="ni-body"><div class="ni-msg">API rate limit reached for Spotify</div><div class="ni-time">4 days ago</div></div></div>
    </div></div>
    <div class="page" id="page-profile">
      <div class="profile-page">
        <div class="profile-hero"><div class="ph-cover"></div><div class="ph-avatar-wrap"><img src="https://picsum.photos/seed/admin/100/100" alt="Admin" class="ph-avatar"><div class="ph-avatar-edit"><i class="fa fa-camera"></i></div></div><div class="ph-info"><div class="ph-name">Admin User</div><div class="ph-role">Super Administrator</div></div></div>
        <div class="form-card" style="max-width:600px;margin-top:2rem">
          <div class="form-body">
            <div class="form-row"><div class="form-group"><label>First Name</label><input type="text" class="form-input" value="Admin"></div><div class="form-group"><label>Last Name</label><input type="text" class="form-input" value="User"></div></div>
            <div class="form-group"><label>Email</label><input type="email" class="form-input" value="admin@soundwave.com"></div>
            <div class="form-group"><label>Bio</label><textarea class="form-input" rows="3">Platform administrator for SoundWave music streaming.</textarea></div>
            <div class="form-actions"><button class="btn-save"><i class="fa fa-check"></i> Update Profile</button></div>
          </div>
        </div>
      </div>
    </div>

  </div><!-- /page-container -->
</main>
</section>

<!-- Toast Notification -->
<div class="toast-container" id="toastContainer"></div>

<!-- Delete Confirm Modal -->
<div class="modal-overlay" id="deleteModal" style="display:none">
  <div class="modal-box">
    <div class="modal-icon danger"><i class="fa fa-trash"></i></div>
    <div class="modal-title">Delete Category?</div>
    <div class="modal-msg">Are you sure you want to delete <strong id="deleteTarget"></strong>? This action cannot be undone.</div>
    <div class="modal-actions">
      <button class="btn-cancel" onclick="closeModal('deleteModal')">Cancel</button>
      <button class="btn-danger" onclick="closeModal('deleteModal');showToast('Category deleted','error')">Delete</button>
    </div>
  </div>
</div>

<!-- Edit Category Modal -->
<div class="modal-overlay" id="editCategoryModal" style="display:none">
  <div class="modal-box wide">
    <div class="modal-header"><div class="modal-title">Edit Category</div><button class="modal-close" onclick="closeModal('editCategoryModal')"><i class="fa fa-xmark"></i></button></div>
    <div class="form-body">
      <div class="form-group"><label>Category Name</label><input type="text" class="form-input" id="editCatName"></div>
      <div class="form-group"><label>Status</label><select class="form-input"><option>Published</option><option>Draft</option></select></div>
      <div class="form-actions"><button class="btn-cancel" onclick="closeModal('editCategoryModal')">Cancel</button><button class="btn-save" onclick="closeModal('editCategoryModal');showToast('Category updated','success')"><i class="fa fa-check"></i> Save Changes</button></div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/script.js"></script>

<!-- Add SPA Page Navigation Script -->
<script>
/**
 * SPA Page Navigation for sidebar/topbar/quick actions.
 * Shows the relevant .page and hides others based on data-page attribute.
 * Handles active nav highlighting and page title/breadcrumb updates.
 * Works on all elements that have data-page attribute.
 */
(function() {
  function showPage(pageId) {
    // Hide all pages
    document.querySelectorAll('.page').forEach(pg => pg.classList.remove('active'));
    // Show the selected page
    var target = document.getElementById('page-' + pageId);
    if(target) {
      target.classList.add('active');
    } else if(pageId === "dashboard") {
      // fallback
      document.getElementById('page-dashboard').classList.add('active');
    }
  }

  function updateNavState(pageId) {
    // Remove 'active' from all nav-items
    document.querySelectorAll('.sidebar-nav .nav-item').forEach(it => it.classList.remove('active'));
    // Highlight the nav for the page if present
    document.querySelectorAll('.sidebar-nav .nav-item[data-page="' + pageId + '"]').forEach(it => it.classList.add('active'));
    // For sub-page buttons (quick actions/add/etc), remove active from other navs
    // No-op for subpages.
  }

  function updatePageTitle(pageId) {
    var titleMap = {
      dashboard: "Dashboard",
      categories: "Categories",
      'add-category': "Add Category",
      songs: "Songs",
      'add-song': "Add Song",
      artists: "Artists",
      albums: "Albums",
      analytics: "Analytics",
      settings: "Settings",
      playlists: "Playlists",
      users: "Users",
      notifications: "Notifications",
      profile: "Profile"
      // Extend as needed
    };
    var title = titleMap[pageId] || "Dashboard";
    var pageTitleEl = document.getElementById('pageTitle');
    if(pageTitleEl) {
      var h1 = pageTitleEl.querySelector('h1');
      if(h1) h1.textContent = title;
      // Optionally update breadcrumb as well if needed
      var bread = pageTitleEl.querySelector('.breadcrumb-trail .active');
      if(bread) bread.textContent = title === 'Dashboard' ? "Overview" : title;
    }
    document.title = title + " — SoundWave Admin";
  }

  // Universal click event for navigation
  document.addEventListener('click', function(e) {
    // Find closest clickable element with a data-page attribute
    let target = e.target;
    while(target && !target.hasAttribute?.('data-page') && target !== document) {
      target = target.parentElement;
    }
    if(target && target.hasAttribute?.('data-page')) {
      const pageId = target.getAttribute('data-page');
      if(pageId) {
        e.preventDefault();
        showPage(pageId);
        updateNavState(pageId);
        updatePageTitle(pageId);
        // Optionally close sidebar for mobile
        if(window.innerWidth < 992) {
          document.getElementById('sidebar').classList.remove('open');
          document.getElementById('sidebarOverlay').classList.remove('active');
        }
      }
    }
  });

  // By default, show dashboard on load
  document.addEventListener('DOMContentLoaded', function() {
    showPage('dashboard');
    updateNavState('dashboard');
    updatePageTitle('dashboard');
  });
})();

// Slug generator
function updateSlugPreview(value) {
    const slugPreview = document.getElementById('slugPreview');
    const slugInput = document.getElementById('slugInput');
    
    let slug = value.trim()
        .toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')     // remove special chars
        .replace(/\s+/g, '-')             // spaces to dashes
        .replace(/-+/g, '-')              // multiple dashes
        .replace(/^-|-$/g, '');           // trim dashes

    slugPreview.textContent = slug || 'auramusic.com';
    slugInput.value = slug;
}

// Icon selection
document.querySelectorAll('.icon-opt').forEach(opt => {
    opt.addEventListener('click', () => {
        document.querySelectorAll('.icon-opt').forEach(o => o.classList.remove('selected'));
        opt.classList.add('selected');
        document.getElementById('iconInput').value = opt.dataset.icon;
    });
});

// Color selection
document.querySelectorAll('.cp-swatch').forEach(swatch => {
    swatch.addEventListener('click', () => {
        document.querySelectorAll('.cp-swatch').forEach(s => s.classList.remove('selected'));
        swatch.classList.add('selected');
        document.getElementById('colorInput').value = swatch.dataset.color;
    });
});

document.getElementById('customColor').addEventListener('input', function() {
    document.getElementById('colorInput').value = this.value;
});
// ------------------------------------------------------------------
// File upload display
const fileInput = document.getElementById('musicFileInput');
const fileNameDisplay = document.getElementById('fileNameDisplay');
const dropZone = document.getElementById('dropZone');

fileInput.addEventListener('change', () => {
  if (fileInput.files[0]) {
    fileNameDisplay.textContent = '✓ ' + fileInput.files[0].name;
    fileNameDisplay.style.display = 'block';
  }
});

['dragover','dragenter'].forEach(e => dropZone.addEventListener(e, ev => {
  ev.preventDefault(); dropZone.classList.add('dragover');
}));
['dragleave','drop'].forEach(e => dropZone.addEventListener(e, ev => {
  ev.preventDefault(); dropZone.classList.remove('dragover');
}));

// Popularity slider
const popRange = document.getElementById('popRange');
const popFill  = document.getElementById('popFill');
const popScore = document.getElementById('popScore');
popRange.addEventListener('input', () => {
  popFill.style.width  = popRange.value + '%';
  popScore.textContent = popRange.value;
});

// Toggle card active state
[0,1,2].forEach(i => {
  const chk = document.getElementById('chk'+i);
  const ti  = document.getElementById('ti'+i);
  chk.addEventListener('change', () => {
    ti.classList.toggle('active', chk.checked);
  });
  ti.addEventListener('click', e => {
    if (e.target === chk || e.target.closest('label.toggle')) return;
    chk.checked = !chk.checked;
    chk.dispatchEvent(new Event('change'));
  });
});

// Status radio
function setStatus(el) {
  document.querySelectorAll('.sr-opt').forEach(o => o.classList.remove('selected'));
  el.classList.add('selected');
}
</script>



</body>
</html>