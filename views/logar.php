<?php

    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION['nomeUsuario'])){
        Header("Location: /PHP_A2/views/selecionar.php");
        die;
    }

?>

<?php
$title = 'Login - FutReserva';
include_once __DIR__ . '/includes/header.php';
?>

<main class="main-content" style="max-width:400px;margin:40px auto 0 auto;">
    <h2 id="login-title" style="text-align:center;color:#207720;margin-bottom:25px;">Acesse sua conta</h2>
    <form id="login-form" method="POST" action="/PHP_A2/usuario/login" style="display:flex;flex-direction:column;gap:18px;">
    <?php
        require_once "C:\\xampp\htdocs\PHP_A2\security\CsrfToken.php";
        use security\CsrfToken;
        echo CsrfToken::hiddenHtml();
    ?>
        <label for="username" style="font-weight:500;">Usuário</label>
        <input type="text" name="nomeUsuario" required style="padding:10px;border-radius:6px;border:1px solid #ccc;">

        <label for="password" style="font-weight:500;">Senha</label>
        <input type="password" name="senhaUsuario" required style="padding:10px;border-radius:6px;border:1px solid #ccc;">

        <button type="submit" style="background:#207720;color:#fff;padding:12px 0;border:none;border-radius:6px;font-size:1.1rem;font-weight:600;cursor:pointer;transition:background 0.3s;">Entrar</button>
    </form>
    <div style="text-align:center;margin-top:18px;">
        <A href=cadastrar.php> cadastrar </A>
        <br>
        <a href="logout.php">logout</a>
    </div>
</main>
<script>
    document.getElementById('show-register').onclick = function() {
        document.getElementById('login-form').style.display = 'none';
        document.getElementById('show-register').style.display = 'none';
        document.getElementById('register-form').style.display = 'flex';
        document.getElementById('login-title').style.display = 'none';
    };
    document.getElementById('show-login').onclick = function() {
        document.getElementById('login-form').style.display = 'flex';
        document.getElementById('show-register').style.display = 'inline-block';
        document.getElementById('register-form').style.display = 'none';
        document.getElementById('login-title').style.display = 'block';
    };
</script>
<?php include_once __DIR__ . '/includes/footer.php'; ?>