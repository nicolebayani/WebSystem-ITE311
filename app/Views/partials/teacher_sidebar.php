<nav id="sidebar" class="sidebar-container">
    <?php helper('url'); ?>
    <?php 
    $role = session()->get('role');
    $dashboardRoute = 'teacher/dashboard';
    $dashboardUrl = site_url($dashboardRoute);
    $isDashboardActive = url_is($dashboardRoute);
    ?>

    <div class="sidebar-brand">
        <div class="brand-icon">
            <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" aria-hidden="true"><path d="M12 2l9 6v8l-9 6-9-6V8l9-6zm0 2.2L5 8v6l7 4.7 7-4.7V8l-7-3.8z"/></svg>
        </div>
        <span class="brand-text">Learnify Teacher</span>
    </div>

    <ul class="nav flex-column components">
        <li class="nav-item <?= $isDashboardActive ? 'active' : '' ?>">
            <a class="nav-link" href="<?= esc($dashboardUrl) ?>">
                <span class="icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M12 3l9 8h-3v9h-5v-6H11v6H6v-9H3l9-8z"/></svg>
                </span>
                <span class="link-text">Dashboard</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('teacher/courses') ?>">
                <span class="icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </span>
                <span class="link-text">My Courses</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('teacher/create-course') ?>">
                <span class="icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                </span>
                <span class="link-text">Create Course</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('teacher/students') ?>">
                <span class="icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A1.5 1.5 0 0018.54 7H17c-.8 0-1.54.37-2.01.99L14 9.5 12.01 7.99A2.5 2.5 0 0010 7H8.46c-.8 0-1.54.37-2.01.99L4 9.5 2.01 7.99A2.5 2.5 0 000 7v2h2v12h2v-6h2v6h2v-6h2v6h2z"/></svg>
                </span>
                <span class="link-text">My Students</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('teacher/assignments') ?>">
                <span class="icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 2 2h8c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 10H7v-2h6v2zm0-3H7V7h6v2z"/></svg>
                </span>
                <span class="link-text">Assignments</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('teacher/gradebook') ?>">
                <span class="icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                </span>
                <span class="link-text">Gradebook</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('teacher/announcements') ?>">
                <span class="icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/></svg>
                </span>
                <span class="link-text">Announcements</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('teacher/analytics') ?>">
                <span class="icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"/></svg>
                </span>
                <span class="link-text">Course Analytics</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('teacher/profile') ?>">
                <span class="icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-4 0-8 2-8 6v2h16v-2c0-4-4-6-8-6z"/></svg>
                </span>
                <span class="link-text">Profile</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('logout') ?>">
                <span class="icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M10 17v-2h4v-6h-4V7H5v10h5zm7-6l-3-3v2h-4v2h4v2l3-3z"/></svg>
                </span>
                <span class="link-text">Logout</span>
            </a>
        </li>
    </ul>
    
    <style>
        .sidebar-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
            height: 100vh;
            background: #fff;
            box-shadow: 2px 0 12px rgba(0,0,0,0.07);
            z-index: 100;
            display: flex;
            flex-direction: column;
        }
        .sidebar-brand {
            padding: 1.5rem 1rem 1rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            border-bottom: 1px solid #eee;
        }
        .brand-icon {
            color: #8B0000;
        }
        .brand-text {
            font-weight: 700;
            font-size: 1.2rem;
            color: #8B0000;
        }
        .components {
            margin-top: 1.5rem;
        }
        .nav-item {
            margin-bottom: 0.5rem;
        }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.75rem 1.5rem;
            color: #333;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.2s;
        }
        .nav-link:hover, .nav-item.active .nav-link {
            background: #f2e6e6;
            color: #8B0000;
        }
        .icon {
            display: flex;
            align-items: center;
            color: #8B0000;
        }
        @media (max-width: 768px) {
            .sidebar-container {
                position: static;
                width: 100%;
                height: auto;
                box-shadow: none;
            }
        }
    </style>
</nav>
