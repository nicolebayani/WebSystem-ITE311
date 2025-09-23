<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Authentication System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            transition: all 300ms ease;
            box-sizing: border-box;
        }
        *:focus {
            outline: 2px solid rgba(128, 0, 32, .3);
            outline-offset: 2px;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
            background: linear-gradient(135deg, rgba(128, 0, 32, 0.9) 0%, rgba(102, 0, 26, 0.8) 50%, rgba(76, 0, 20, 0.9) 100%);
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        html {
            color: rgba(33, 37, 41, 1);
            font-size: 16px;
            -webkit-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
            background: linear-gradient(135deg, rgba(128, 0, 32, 0.9) 0%, rgba(102, 0, 26, 0.8) 50%, rgba(76, 0, 20, 0.9) 100%);
            background-attachment: fixed;
            min-height: 100vh;
            height: 100%;
        }
        .auth-container {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .auth-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, .1);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
            animation: slideUp 0.6s ease-out;
        }
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .auth-header {
            background: linear-gradient(135deg, rgba(128, 0, 32, .8) 0%, rgba(128, 0, 32, 1) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            border-radius: 12px 12px 0 0;
        }
        .auth-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, .1) 0%, transparent 70%);
            animation: pulse 3s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
        .auth-header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }
        .auth-header .icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
            animation: bounce 2s ease-in-out infinite;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
        .auth-body {
            padding: 2.5rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: rgba(33, 37, 41, .8);
        }
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid rgba(242, 242, 242, 1);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 300ms ease;
            background: rgba(247, 248, 249, .5);
        }
        .form-control:focus {
            border-color: rgba(128, 0, 32, .6);
            background: white;
            box-shadow: 0 0 0 3px rgba(128, 0, 32, .1);
            transform: translateY(-2px);
        }
        .form-control:hover {
            border-color: rgba(128, 0, 32, .3);
            transform: translateY(-1px);
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: all 300ms ease;
            position: relative;
            overflow: hidden;
        }
        .btn-primary {
            background: linear-gradient(135deg, rgba(128, 0, 32, .8) 0%, rgba(128, 0, 32, 1) 100%);
            color: white;
            width: 100%;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(128, 0, 32, .3);
        }
        .btn-primary:active {
            transform: translateY(0);
        }
        .btn-secondary {
            background: transparent;
            color: rgba(128, 0, 32, 1);
            border: 2px solid rgba(128, 0, 32, 0.3);
            width: 100%;
            margin-top: 1rem;
        }
        .btn-secondary:hover {
            background: rgba(128, 0, 32, 0.1);
            border-color: rgba(128, 0, 32, 0.6);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(128, 0, 32, .15);
            color: rgba(128, 0, 32, 1);
        }
        .divider {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
        }
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: rgba(242, 242, 242, 1);
        }
        .divider span {
            background: white;
            padding: 0 1rem;
            color: rgba(108, 117, 125, 1);
            font-size: 0.9rem;
        }
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .2), transparent);
            transition: left 0.5s;
        }
        .btn:hover::before {
            left: 100%;
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
        .alert-danger {
            background-color: rgba(128, 0, 32, 0.8);
            border-color: rgba(220, 53, 69, .2);
            color: rgba(255, 255, 255, 1);
        }
        .auth-footer {
            text-align: center;
            padding: 1.5rem;
            background: rgba(247, 248, 249, .5);
            border-top: 1px solid rgba(242, 242, 242, 1);
        }
        .auth-footer a {
            color: rgba(128, 0, 32, 1);
            text-decoration: none;
            font-weight: 500;
            transition: all 300ms ease;
        }
        .auth-footer a:hover {
            color: rgba(128, 0, 32, .8);
            text-decoration: underline;
        }
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(108, 117, 125, .6);
            transition: all 300ms ease;
        }
        .form-control:focus + .input-icon {
            color: rgba(128, 0, 32, .8);
        }
        .has-icon .form-control {
            padding-left: 3rem;
        }
        @media (max-width: 480px) {
            .auth-card {
                margin: 1rem;
                border-radius: 8px;
            }
            .auth-header {
                padding: 1.5rem;
            }
            .auth-body {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
<?= $this->include('partials/navbar') ?>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="icon">
                    <i class="fas fa-sign-in-alt"></i>
                </div>
                <h1>Welcome Back</h1>
                <p style="margin: 0; opacity: 0.9;">Sign in to your account</p>
            </div>
            <div class="auth-body">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <ul style="margin: 0.5rem 0 0 0; padding-left: 1.5rem;">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= base_url('login') ?>">
                    <div class="form-group has-icon">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i> Email Address
                        </label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= old('email') ?>" required placeholder="Enter your email">
                    </div>

                    <div class="form-group has-icon">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <input type="password" class="form-control" id="password" name="password" 
                               required placeholder="Enter your password">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Sign In
                    </button>
                </form>

                <div class="divider">
                    <span>or</span>
                </div>

                <a href="<?= base_url('register') ?>" class="btn btn-secondary">
                    <i class="fas fa-user-plus"></i> Create Account
                </a>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
       
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

       
        document.querySelector('form').addEventListener('submit', function() {
            const btn = this.querySelector('.btn-primary');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing In...';
            btn.disabled = true;
        });
    </script>
</body>
</html>
