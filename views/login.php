<?php
$title = 'Login - FutReserva';
include_once __DIR__ . '/includes/header.php';
?>

<main class="main-content" style="max-width:400px;margin:40px auto 0 auto;">
    <h2 id="login-title" style="text-align:center;color:#207720;margin-bottom:25px;">Acesse sua conta</h2>
    <form id="login-form" method="POST" action="" style="display:flex;flex-direction:column;gap:18px;">
        <label for="username" style="font-weight:500;">Usuário</label>
        <input type="text" id="username" name="username" required style="padding:10px;border-radius:6px;border:1px solid #ccc;" value="<?php echo isset($_COOKIE['futreserva_user']) ? htmlspecialchars($_COOKIE['futreserva_user']) : ''; ?>">

        <label for="password" style="font-weight:500;">Senha</label>
        <input type="password" id="password" name="password" required style="padding:10px;border-radius:6px;border:1px solid #ccc;">

        <button type="submit" name="login" style="background:#207720;color:#fff;padding:12px 0;border:none;border-radius:6px;font-size:1.1rem;font-weight:600;cursor:pointer;transition:background 0.3s;">Entrar</button>
    </form>
    <div style="text-align:center;margin-top:18px;">
        <button id="show-register" style="background:none;border:none;color:#207720;font-weight:600;font-size:1rem;cursor:pointer;text-decoration:underline;">Cadastre-se</button>
    </div>
    <form id="register-form" method="POST" action="" style="display:none;flex-direction:column;gap:18px;margin-top:30px;">
        <h2 style="text-align:center;color:#207720;margin-bottom:15px;">Crie sua conta</h2>
        <label for="reg_username" style="font-weight:500;">Usuário</label>
        <input type="text" id="reg_username" name="reg_username" style="padding:10px;border-radius:6px;border:1px solid #ccc;">

        <label for="reg_password" style="font-weight:500;">Senha</label>
        <input type="password" id="reg_password" name="reg_password" style="padding:10px;border-radius:6px;border:1px solid #ccc;">

        <label for="reg_cpf" style="font-weight:500;">CPF</label>
        <input type="text" id="reg_cpf" name="reg_cpf" style="padding:10px;border-radius:6px;border:1px solid #ccc;">

        <label for="reg_data_nascimento" style="font-weight:500;">Data de Nascimento</label>
        <input type="date" id="reg_data_nascimento" name="reg_data_nascimento" style="padding:10px;border-radius:6px;border:1px solid #ccc;">

        <button type="submit" name="register" style="background:#207720;color:#fff;padding:12px 0;border:none;border-radius:6px;font-size:1.1rem;font-weight:600;cursor:pointer;transition:background 0.3s;">Cadastrar</button>
        <div style="text-align:center;margin-top:10px;">
            <button id="show-login" type="button" style="background:none;border:none;color:#207720;font-weight:600;font-size:1rem;cursor:pointer;text-decoration:underline;">Já tem conta? Fazer login</button>
        </div>
    </form>
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
