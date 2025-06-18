<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'FutReserva - Sistema de Reservas' ?></title>
    <link rel="stylesheet" href="/PHP_A2/views/public/css/style.css">
    <link rel="stylesheet" href="/PHP_A2/views/public/css/style2.css">
    <style>
        header.site-header {
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 0 0 10px 10px;
        }
        .site-logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
            letter-spacing: 1px;
        }
        .login-link {
            margin-left: 30px;
            padding: 7px 18px;
            background: #207720;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s;
        }
        .login-link:hover {
            background: #145214;
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="site-logo"><a style="text-decoration: none; color: black;" href="home.php">FutReserva</a></div>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/PHP_A2/views/logout.php" class="login-link">Logout</a>
        <?php else: ?>
            <a href="/PHP_A2/views/logar.php" class="login-link">Login</a>
        <?php endif; ?>
    </header>
    <div class="container">