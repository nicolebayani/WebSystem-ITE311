<nav id="sidebar" class="sidebar-container">
    <?php helper('url'); ?>
    <?php 
    $role = session()->get('role');
    $dashboardRoute = 'user/dashboard';
    if ($role === 'admin') {
        $dashboardRoute = 'admin/dashboard';
    } elseif ($role === 'teacher') {
        $dashboardRoute = 'teacher/dashboard';
    } elseif ($role === 'student') {
        $dashboardRoute = 'student/dashboard';
    }
    $dashboardUrl = site_url($dashboardRoute);
    $isDashboardActive = url_is($dashboardRoute);
    ?>

    <div class="sidebar-brand">
        <div class="brand-icon">
            <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" aria-hidden="true"><path d="M12 2l9 6v8l-9 6-9-6V8l9-6zm0 2.2L5 8v6l7 4.7 7-4.7V8l-7-3.8z"/></svg>
        </div>
        <span class="brand-text">Learnify</span>
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
            <a class="nav-link" href="#">
                <span class="icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-4 0-8 2-8 6v2h16v-2c0-4-4-6-8-6z"/></svg>
                </span>
                <span class="link-text">Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M12 8a4 4 0 100 8 4 4 0 000-8zm8 3h-1.09a7.006 7.006 0 00-1.27-3.06l.77-.77 1.41-1.41-2.83-2.83-1.41 1.41-.77.77A7.006 7.006 0 0013 3.09V2h-2v1.09a7.006 7.006 0 00-3.06 1.27l-.77-.77-1.41-1.41L2.93 5.01l1.41 1.41.77.77A7.006 7.006 0 003.09 11H2v2h1.09a7.006 7.006 0 001.27 3.06l-.77.77-1.41 1.41 2.83 2.83 1.41-1.41.77-.77A7.006 7.006 0 0011 20.91V22h2v-1.09a7.006 7.006 0 003.06-1.27l.77.77 1.41 1.41 2.83-2.83-1.41-1.41-.77-.77A7.006 7.006 0 0020.91 13H22v-2h-1z"/></svg>
                </span>
                <span class="link-text">Settings</span>
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
