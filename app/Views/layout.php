<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Club Platform' ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
        }

        /* Navbar */
        nav {
            background: #2563eb;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-right: 15px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            width: 400px;
            margin: 80px auto;
            background: #fff;
            padding: 25px;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,.1);
        }

        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        button {
            background: #2563eb;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px;
            margin-bottom: 10px;
        }

        .link {
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Simple Navbar -->
<nav>
    <div class="nav-left">
        <a href="./clubs">Clubs</a>
        <a href="./events">Events</a>
    </div>
    <div class="nav-right">
        <?php if (!empty($_SESSION['user'])): ?>
            Hello, <?= htmlspecialchars($_SESSION['user']->fullName()) ?>
            <a href="./logout">Logout</a>
        <?php else: ?>
            <a href="./login">Login</a>
            <a href="./register">Register</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container">

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="error">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <?php require $viewFile; ?>

</div>

</body>
</html>
