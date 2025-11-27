<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Learnify' ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --maroon: #800000;
            --maroon-dark: #5a0000;
            --maroon-light: #a13c3c;
        }
        
        .notification-badge {
            position: absolute;
            top: 0;
            right: -5px;
            padding: 3px 6px;
            border-radius: 50%;
            background-color: red;
            color: white;
            font-size: 10px;
        }
        
        .notification-icon {
            position: relative;
            display: inline-block;
            margin-right: 15px;
        }
        
        .nav-link.notification-btn {
            color: white !important;
            padding: 8px 12px;
            position: relative;
        }
    </style>
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg" style="background-color: #800000;">
        <div class="container">
            <a class="navbar-brand text-white" href="#">
                <i class="fas fa-graduation-cap me-2"></i>Learnify Student
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= base_url('student/dashboard') ?>">
                            <i class="fas fa-home me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= base_url('student/enrollment') ?>">
                            <i class="fas fa-book me-1"></i> Enrollment
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" href="#" id="learningDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-graduation-cap me-1"></i> Learning
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Courses</a></li>
                            <li><a class="dropdown-item" href="#">Assignments</a></li>
                            <li><a class="dropdown-item" href="#">Resources</a></li>
                        </ul>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <!-- Notifications -->
                    <li class="nav-item">
                        <a class="nav-link notification-btn text-white" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="notification-icon">
                                <i class="fas fa-bell"></i>
                                <?php if (isset($unreadNotifications) && $unreadNotifications > 0): ?>
                                <span class="notification-badge"><?= $unreadNotifications ?></span>
                                <?php endif; ?>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
                            <li><h6 class="dropdown-header">Notifications</h6></li>
                            <?php if (isset($notifications) && !empty($notifications)): ?>
                                <?php foreach ($notifications as $notification): ?>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <?= esc($notification['message']) ?>
                                            <small class="text-muted d-block">
                                                <?= date('M d, Y h:i A', strtotime($notification['created_at'])) ?>
                                            </small>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li><span class="dropdown-item">No new notifications</span></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    
                    <!-- User Account -->
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container-fluid py-4">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>