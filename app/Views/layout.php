<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Club Platform' ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
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
