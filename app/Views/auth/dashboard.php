<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Authentication System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            transition: all 300ms ease;
            box-sizing: border-box;
        }
        *:focus {
            outline: 2px solid rgba(128, 0, 32, .3);
            outline-offset: 2px;
        }
        html, body {
            color: rgba(33, 37, 41, 1);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
            font-size: 16px;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
            background: linear-gradient(135deg, rgba(128, 0, 32, 0.08) 0%, rgba(102, 0, 26, 0.05) 50%, rgba(76, 0, 20, 0.08) 100%);
            min-height: 100vh;
        }
        .navbar {
            background: linear-gradient(135deg, rgba(128, 0, 32, .95) 0%, rgba(128, 0, 32, 1) 100%);
            padding: 1.2rem 0;
            box-shadow: 0 2px 15px rgba(128, 0, 32, .25);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h1 {
            color: white;
            margin: 0;
            font-size: 1.6rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .navbar h1 i {
            font-size: 1.8rem;
            animation: rotate 3s linear infinite;
        }
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            color: white;
            font-weight: 500;
        }
        .user-details {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, .2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            border: 2px solid rgba(255, 255, 255, .3);
        }
        .user-name {
            font-size: 1rem;
            font-weight: 600;
        }
        .user-role {
            background: rgba(255, 255, 255, .2);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            text-transform: capitalize;
            border: 1px solid rgba(255, 255, 255, .2);
        }
        .navbar-brand {
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .navbar-brand:hover {
            color: rgba(255, 255, 255, .9);
            transform: scale(1.05);
        }
        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .navbar-text {
            color: rgba(255, 255, 255, .9);
            font-weight: 500;
        }
        .btn {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            border: 2px solid;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: all 300ms ease;
            position: relative;
            overflow: hidden;
        }
        .btn-outline-light {
            border-color: rgba(255, 255, 255, .8);
            color: white;
            background: transparent;
        }
        .btn-outline-light:hover {
            background: white;
            color: rgba(221, 72, 20, 1);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, .3);
        }
        .btn-logout {
            background: rgba(255, 255, 255, .15);
            color: white;
            border: 2px solid rgba(255, 255, 255, .3);
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 300ms ease;
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-logout:hover {
            background: rgba(255, 255, 255, .25);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(128, 0, 32, .3);
            color: white;
        }
        .main-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }
        .welcome-section {
            text-align: center;
            margin-bottom: 4rem;
        }
        .welcome-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: rgba(128, 0, 32, 1);
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(128, 0, 32, 0.1);
            animation: text-focus-in 0.8s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
        }
        .welcome-section p {
            font-size: 1.2rem;
            color: rgba(108, 117, 125, 1);
            margin-bottom: 0;
            animation: fadeInUp 0.8s ease-out 0.4s;
            animation-fill-mode: both;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        .dashboard-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(128, 0, 32, 0.08);
            border: 1px solid rgba(128, 0, 32, 0.1);
            transition: all 300ms ease;
            animation: fadeInUp 0.8s ease-out;
            animation-fill-mode: both;
        }
        .dashboard-card:nth-child(1) { animation-delay: 0.1s; }
        .dashboard-card:nth-child(2) { animation-delay: 0.2s; }
        .dashboard-card:nth-child(3) { animation-delay: 0.3s; }
        .dashboard-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(128, 0, 32, 0.15);
            border-color: rgba(128, 0, 32, 0.2);
        }
        .dashboard-card:hover .card-icon i {
            animation: icon-pulse 0.6s ease-in-out;
        }
        .card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(128, 0, 32, 0.1) 0%, rgba(128, 0, 32, 0.2) 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: rgba(128, 0, 32, 1);
            margin-bottom: 1.5rem;
        }
        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: rgba(33, 37, 41, 1);
            margin-bottom: 0.8rem;
        }
        .card-description {
            color: rgba(108, 117, 125, 1);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        .card-action {
            background: linear-gradient(135deg, rgba(128, 0, 32, 0.9) 0%, rgba(128, 0, 32, 1) 100%);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 500;
            transition: all 300ms ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .card-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(128, 0, 32, 0.3);
            color: white;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes text-focus-in {
            0% {
                filter: blur(12px);
                opacity: 0;
            }
            100% {
                filter: blur(0px);
                opacity: 1;
            }
        }
        @keyframes icon-pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
        .welcome-section h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: rgba(33, 37, 41, .9);
            margin-bottom: 0.5rem;
        }
        .welcome-section p {
            font-size: 1.2rem;
            color: rgba(108, 117, 125, 1);
            margin: 0;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-top: 2rem;
        }
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
            overflow: hidden;
            transition: all 300ms ease;
            animation: slideInLeft 0.6s ease-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
        }
        .sidebar-card {
            animation: slideInRight 0.6s ease-out;
        }
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(242, 242, 242, 1);
            position: relative;
        }
        .card-header.primary {
            background: linear-gradient(135deg, rgba(128, 0, 32, .1) 0%, rgba(128, 0, 32, .05) 100%);
            color: rgba(128, 0, 32, 1);
        }
        .card-header.secondary {
            background: linear-gradient(135deg, rgba(108, 117, 125, .1) 0%, rgba(108, 117, 125, .05) 100%);
            color: rgba(108, 117, 125, 1);
        }
        .card-header.warning {
            background: linear-gradient(135deg, rgba(255, 193, 7, .1) 0%, rgba(255, 193, 7, .05) 100%);
            color: rgba(255, 193, 7, .8);
        }
        .card-header h5, .card-header h6 {
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .card-body {
            padding: 1.5rem;
        }
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border: 1px solid;
            animation: slideDown 0.4s ease-out;
        }
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .alert-success {
            background-color: rgba(40, 167, 69, .1);
            border-color: rgba(40, 167, 69, .2);
            color: rgba(25, 135, 84, 1);
        }
        .feature-list {
            list-style: none;
            padding: 0;
            margin: 1rem 0;
        }
        .feature-list li {
            padding: 1rem;
            margin-bottom: 0.5rem;
            background: rgba(247, 248, 249, .5);
            border-radius: 8px;
            border-left: 4px solid rgba(128, 0, 32, .3);
            transition: all 300ms ease;
            animation: fadeIn 0.6s ease-out;
            animation-delay: calc(var(--delay) * 0.1s);
        }
        .feature-list li:hover {
            background: rgba(128, 0, 32, .05);
            border-left-color: rgba(128, 0, 32, .8);
            transform: translateX(5px);
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .user-table {
            width: 100%;
            border-collapse: collapse;
        }
        .user-table td {
            padding: 0.75rem;
            border-bottom: 1px solid rgba(242, 242, 242, 1);
            transition: all 300ms ease;
        }
        .user-table tr:hover {
            background: rgba(128, 0, 32, .02);
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .badge.admin {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
        }
        .badge.user {
            background: linear-gradient(135deg, rgba(128, 0, 32, .8), rgba(128, 0, 32, 1));
            color: white;
        }
        .btn-warning {
            background: linear-gradient(135deg, #ffc107, #e0a800);
            color: #212529;
            border: none;
        }
        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 193, 7, .3);
        }
        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            .navbar .container {
                padding: 0 1rem;
            }
            .main-container {
                padding: 1rem;
            }
            .welcome-section h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <?= $this->include('partials/sidebar') ?>
        <div id="content" class="dashboard-content">
            <div class="main-container">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="welcome-section">
            <h2>Welcome to your Learning Dashboard, <?= esc($user['name']) ?>!</h2>
            <p>Your central hub for courses, assignments, and progress.</p>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="card-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <div class="card-title">Courses</div>
                <div class="card-description">
                    Access your enrolled courses, view course materials, and track your learning progress.
                </div>
                <a href="#" class="card-action">
                    <i class="fas fa-arrow-right"></i> View Courses
                </a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="card-title">Assignments & Quizzes</div>
                <div class="card-description">
                    Check upcoming deadlines, submit your assignments, and take quizzes to test your knowledge.
                </div>
                <a href="#" class="card-action">
                    <i class="fas fa-arrow-right"></i> View Assignments
                </a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="card-title">Grades & Progress</div>
                <div class="card-description">
                    Review your grades, track your performance, and see your overall progress in each course.
                </div>
                <a href="#" class="card-action">
                    <i class="fas fa-arrow-right"></i> View Grades
                </a>
            </div>
        </div>
            </div>
        </div>
    </div>

    <script>
        // Add smooth hover effects to cards
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            <style>
                .dashboard-content {
                    margin-left: 240px; /* sidebar width */
                    min-height: 100vh;
                    background: #f8f9fa;
                }
                @media (max-width: 768px) {
                    .dashboard-content {
                        margin-left: 0;
                    }
                }
                .main-container {
                    max-width: 1000px;
                    margin: 0 auto;
                    padding: 3rem 2rem;
                }
                .welcome-section {
                    text-align: center;
                    margin-bottom: 4rem;
                }
                .welcome-section h2 {
                    font-size: 2.5rem;
                    font-weight: 700;
                    color: rgba(128, 0, 32, 1);
                    margin-bottom: 1rem;
                    text-shadow: 0 2px 4px rgba(128, 0, 32, 0.1);
                    animation: text-focus-in 0.8s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
                }
                .welcome-section p {
                    font-size: 1.2rem;
                    color: rgba(108, 117, 125, 1);
                    margin-bottom: 0;
                    animation: fadeInUp 0.8s ease-out 0.4s;
                    animation-fill-mode: both;
                }
                .dashboard-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                    gap: 2rem;
                    margin-bottom: 3rem;
                }
                .dashboard-card {
                    background: white;
                    border-radius: 16px;
                    padding: 2rem;
                    box-shadow: 0 4px 20px rgba(128, 0, 32, 0.08);
                    border: 1px solid rgba(128, 0, 32, 0.1);
                    transition: all 300ms ease;
                    animation: fadeInUp 0.8s ease-out;
                    animation-fill-mode: both;
                }
                .dashboard-card:nth-child(1) { animation-delay: 0.1s; }
                .dashboard-card:nth-child(2) { animation-delay: 0.2s; }
                .dashboard-card:nth-child(3) { animation-delay: 0.3s; }
                .dashboard-card:hover {
                    transform: translateY(-8px);
                    box-shadow: 0 12px 40px rgba(128, 0, 32, 0.15);
                    border-color: rgba(128, 0, 32, 0.2);
                }
                .dashboard-card:hover .card-icon i {
                    animation: icon-pulse 0.6s ease-in-out;
                }
                .card-icon {
                    width: 60px;
                    height: 60px;
                    background: linear-gradient(135deg, rgba(128, 0, 32, 0.1) 0%, rgba(128, 0, 32, 0.2) 100%);
                    border-radius: 16px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1.8rem;
                    color: rgba(128, 0, 32, 1);
                    margin-bottom: 1.5rem;
                }
                .card-title {
                    font-size: 1.3rem;
                    font-weight: 600;
                    color: rgba(33, 37, 41, 1);
                    margin-bottom: 0.8rem;
                }
                .card-description {
                    color: rgba(108, 117, 125, 1);
                    line-height: 1.6;
                    margin-bottom: 1.5rem;
                }
                .card-action {
                    background: linear-gradient(135deg, rgba(128, 0, 32, 0.9) 0%, rgba(128, 0, 32, 1) 100%);
                    color: white;
                    padding: 0.8rem 1.5rem;
                    border-radius: 10px;
                    text-decoration: none;
                    font-weight: 500;
                    transition: all 300ms ease;
                    display: inline-flex;
                    align-items: center;
                    gap: 0.5rem;
                }
                .card-action:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 8px 25px rgba(128, 0, 32, 0.3);
                    color: white;
                }
                @keyframes fadeInUp {
                    from {
                        opacity: 0;
                        transform: translateY(30px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
                @keyframes text-focus-in {
                    0% {
                        filter: blur(12px);
                        opacity: 0;
                    }
                    100% {
                        filter: blur(0px);
                        opacity: 1;
                    }
                }
                @keyframes icon-pulse {
                    0% {
                        transform: scale(1);
                    }
                    50% {
                        transform: scale(1.1);
                    }
                    100% {
                        transform: scale(1);
                    }
                }
                .welcome-section h1 {
                    font-size: 2.5rem;
                    font-weight: 600;
                    color: rgba(33, 37, 41, .9);
                    margin-bottom: 0.5rem;
                }
                .welcome-section p {
                    font-size: 1.2rem;
                    color: rgba(108, 117, 125, 1);
                    margin: 0;
                }
                .dashboard-grid {
                    display: grid;
                    grid-template-columns: 2fr 1fr;
                    gap: 2rem;
                    margin-top: 2rem;
                }
                .card {
                    background: white;
                    border-radius: 12px;
                    box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
                    overflow: hidden;
                    transition: all 300ms ease;
                    animation: slideInLeft 0.6s ease-out;
                }
                .card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
                }
                .sidebar-card {
                    animation: slideInRight 0.6s ease-out;
                }
                @keyframes slideInLeft {
                    from {
                        opacity: 0;
                        transform: translateX(-30px);
                    }
                    to {
                        opacity: 1;
                        transform: translateX(0);
                    }
                }
                @keyframes slideInRight {
                    from {
                        opacity: 0;
                        transform: translateX(30px);
                    }
                    to {
                        opacity: 1;
                        transform: translateX(0);
                    }
                }
                .card-header {
                    padding: 1.5rem;
                    border-bottom: 1px solid rgba(242, 242, 242, 1);
                    position: relative;
                }
                .card-header.primary {
                    background: linear-gradient(135deg, rgba(128, 0, 32, .1) 0%, rgba(128, 0, 32, .05) 100%);
                    color: rgba(128, 0, 32, 1);
                }
                .card-header.secondary {
                    background: linear-gradient(135deg, rgba(108, 117, 125, .1) 0%, rgba(108, 117, 125, .05) 100%);
                    color: rgba(108, 117, 125, 1);
                }
                .card-header.warning {
                    background: linear-gradient(135deg, rgba(255, 193, 7, .1) 0%, rgba(255, 193, 7, .05) 100%);
                    color: rgba(255, 193, 7, .8);
                }
                .card-header h5, .card-header h6 {
                    margin: 0;
                    font-weight: 600;
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                }
                .card-body {
                    padding: 1.5rem;
                }
                .alert {
                    padding: 1rem;
                    border-radius: 8px;
                    margin-bottom: 1.5rem;
                    border: 1px solid;
                    animation: slideDown 0.4s ease-out;
                }
                @keyframes slideDown {
                    from {
                        opacity: 0;
                        transform: translateY(-10px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
                .alert-success {
                    background-color: rgba(40, 167, 69, .1);
                    border-color: rgba(40, 167, 69, .2);
                    color: rgba(25, 135, 84, 1);
                }
                .feature-list {
                    list-style: none;
                    padding: 0;
                    margin: 1rem 0;
                }
                .feature-list li {
                    padding: 1rem;
                    margin-bottom: 0.5rem;
                    background: rgba(247, 248, 249, .5);
                    border-radius: 8px;
                    border-left: 4px solid rgba(128, 0, 32, .3);
                    transition: all 300ms ease;
                    animation: fadeIn 0.6s ease-out;
                    animation-delay: calc(var(--delay) * 0.1s);
                }
                .feature-list li:hover {
                    background: rgba(128, 0, 32, .05);
                    border-left-color: rgba(128, 0, 32, .8);
                    transform: translateX(5px);
                }
                @keyframes fadeIn {
                    from { opacity: 0; }
                    to { opacity: 1; }
                }
                .user-table {
                    width: 100%;
                    border-collapse: collapse;
                }
                .user-table td {
                    padding: 0.75rem;
                    border-bottom: 1px solid rgba(242, 242, 242, 1);
                    transition: all 300ms ease;
                }
                .user-table tr:hover {
                    background: rgba(128, 0, 32, .02);
                }
                .badge {
                    display: inline-block;
                    padding: 0.25rem 0.75rem;
                    border-radius: 20px;
                    font-size: 0.875rem;
                    font-weight: 500;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                }
                .badge.admin {
                    background: linear-gradient(135deg, #dc3545, #c82333);
                    color: white;
                }
                .badge.user {
                    background: linear-gradient(135deg, rgba(128, 0, 32, .8), rgba(128, 0, 32, 1));
                    color: white;
                }
                .btn-warning {
                    background: linear-gradient(135deg, #ffc107, #e0a800);
                    color: #212529;
                    border: none;
                }
                .btn-warning:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 5px 15px rgba(255, 193, 7, .3);
                }
                @media (max-width: 768px) {
                    .dashboard-grid {
                        grid-template-columns: 1fr;
                        gap: 1.5rem;
                    }
                    .main-container {
                        padding: 1rem;
                    }
                    .welcome-section h1 {
                        font-size: 2rem;
                    }
                }
            </style>
