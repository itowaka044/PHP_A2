<?php
$title = 'Consultar Reservas';
include_once __DIR__ . '/includes/header.php';
?>

<main class="main-content">
    <section>
        <h2 class="section-title">Quadras Disponíveis</h2>
        <div class="quadras-grid">
            <!-- Quadra 1 -->
            <div class="quadra-card">
                <img src="/PHP_A2/views/public/img/quadra1.jpg" alt="Quadra Society Aberto" class="quadra-img">
                <h3 class="quadra-title">Society Aberto</h3>
                <p class="quadra-description">Horário: 08:00 - 18:00</p>
                <div class="quadra-status disponivel">Disponível</div>
            </div>
            <!-- Quadra 2 -->
            <div class="quadra-card">
                <img src="/PHP_A2/views/public/img/quadra2.jpg" alt="Quadra Society Coberto" class="quadra-img">
                <h3 class="quadra-title">Society Coberto</h3>
                <p class="quadra-description">Horário: 10:00 - 22:00</p>
                <div class="quadra-status indisponivel">Indisponível</div>
            </div>
            <!-- Quadra 3 -->
            <div class="quadra-card">
                <img src="/PHP_A2/views/public/img/quadra3.jpg" alt="Quadra Futsal Coberto" class="quadra-img">
                <h3 class="quadra-title">Futsal Coberto</h3>
                <p class="quadra-description">Horário: 14:00 - 23:00</p>
                <div class="quadra-status disponivel">Disponível</div>
            </div>
        </div>
    </section>
</main>

<?php include_once __DIR__ . '/includes/footer.php'; ?>

<style>
.quadras-grid {
    display: flex;
    gap: 2rem;
    justify-content: center;
    margin-top: 2rem;
}
.quadra-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 1rem;
    width: 250px;
    text-align: center;
}
.quadra-img {
    width: 100%;
    height: 140px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 1rem;
}
.quadra-status {
    margin-top: 1rem;
    font-weight: bold;
    padding: 0.5rem;
    border-radius: 5px;
}
.disponivel {
    background: #d4edda;
    color: #155724;
}
.indisponivel {
    background: #f8d7da;
    color: #721c24;
}
</style>
