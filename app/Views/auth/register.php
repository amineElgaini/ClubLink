<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My MVC App</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        header { margin-bottom: 20px; }
        footer { margin-top: 20px; font-size: 0.9em; color: #555; }
    </style>
</head>
<body>
    <header>
        <h1>My MVC App</h1>
        <nav>
            <a href="/">Home</a> |
            <a href="/user/profile">Profile</a>
        </nav>
    </header>

    <main>
        <?php
        if (isset($viewFile)) {
            include $viewFile;
        } else {
            echo "<p>View not found!</p>";
        }
        ?>
    </main>

    <footer>
        &copy; <?= date('Y') ?> My MVC App
    </footer>
</body>
</html>
