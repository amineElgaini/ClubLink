<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Club Platform' ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #0f172a;
            min-height: 100vh;
        }

        /* Modern Dark Navbar */
        nav {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: #fff;
            padding: 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 24px;
            height: 70px;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
        }

        .nav-brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 32px;
        }

        .nav-links {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-links a.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.15);
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            color: #fff;
        }

        .btn-nav {
            padding: 8px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-login {
            color: rgba(255, 255, 255, 0.9);
            background: rgba(255, 255, 255, 0.1);
        }

        .btn-login:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .btn-logout {
            background: rgba(239, 68, 68, 0.9);
            color: #fff;
        }

        .btn-logout:hover {
            background: #ef4444;
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
        }

        .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: transparent;
            padding: 0;
            border-radius: 0;
            box-shadow: none;
        }

        /* Auth Container (for login/register pages) */
        .auth-container {
            width: 100%;
            max-width: 440px;
            margin: 80px auto;
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Form Styles */
        input,
        button {
            width: 100%;
            padding: 12px 16px;
            margin-top: 8px;
            border-radius: 8px;
            font-size: 15px;
        }

        input {
            border: 2px solid #e2e8f0;
            transition: border-color 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
        }

        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        /* Error Message */
        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 14px 16px;
            margin-bottom: 20px;
            border-radius: 8px;
            border-left: 4px solid #ef4444;
            font-size: 14px;
        }

        .link {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #64748b;
        }

        .link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .link a:hover {
            text-decoration: underline;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .nav-container {
                flex-wrap: wrap;
                height: auto;
                padding: 16px;
            }

            .nav-left {
                width: 100%;
                justify-content: space-between;
                margin-bottom: 12px;
            }

            .nav-links {
                gap: 4px;
            }

            .nav-links a {
                padding: 6px 12px;
                font-size: 14px;
            }

            .nav-right {
                width: 100%;
                justify-content: flex-end;
            }

            .user-info span {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- Modern Dark Navbar -->
    <nav>
        <div class="nav-container">
            <div class="nav-left">
                <a href="<?= url("/clubs") ?>" class="nav-brand">
                    <div class="nav-brand-icon">🎓</div>
                    <span>ClubHub</span>
                </a>
                <div class="nav-links">
                    <a href="<?= url("/clubs") ?>">Clubs</a>
                    <a href="<?= url("/clubs") ?>">Manage Events</a>
                    <a href="<?= url("/admin/users") ?>">Manage Users</a>
                    <a href="<?= url("/admin/clubs") ?>">Manage Clubs</a>
                </div>
            </div>
            <div class="nav-right">
                <?php if (!empty($_SESSION['user'])): ?>
                    <div class="user-info">
                        <div class="user-avatar">
                            <?= strtoupper(substr($_SESSION['user']->fullName(), 0, 1)) ?>
                        </div>
                        <span>Hello, <?= htmlspecialchars($_SESSION['user']->fullName()) ?></span>
                    </div>
                    <a href="./logout" class="btn-nav btn-logout">Logout</a>
                <?php else: ?>
                    <a href="./login" class="btn-nav btn-login">Login</a>
                    <a href="./register" class="btn-nav btn-register">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>


    <!-- Main Container -->
    <div class="container">
        <?php if (!empty($_SESSION['error'])): ?>
            <div style="max-width: 1200px; margin: 20px auto; padding: 0 20px;">
                <div class="error">
                    <?= $_SESSION['error'];
                    unset($_SESSION['error']); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php require $viewFile; ?>
    </div>

</body>

</html>