<?php
$title = 'FutReserva - Sistema de Reservas';
include_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
        <section class="hero">
            <h2>Sistema de Reservas de Quadras</h2>
            <p>Reserve sua quadra de futebol e futsal de forma rápida e fácil. Quadras modernas com a melhor infraestrutura para seu jogo.</p>
        </section>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Quadras Section -->
            <section>
                <h2 class="section-title">Nossas Quadras</h2>
                
                <div class="quadras-grid">
                    <div class="quadra-card">
                        <div class="quadra-icon">🌞</div>
                        <h3 class="quadra-title">Society Aberto</h3>
                        <p class="quadra-description">Quadra de society com gramado natural, perfeita para jogos ao ar livre.</p>
                        <div class="quadra-features">
                            <span class="feature-tag">Gramado Natural</span>
                            <span class="feature-tag">40m x 30m</span>
                            <span class="feature-tag">14 Jogadores</span>
                        </div>
                        <div class="quadra-price">R$ 80/hora</div>
                    </div>

                    <div class="quadra-card">
                        <div class="quadra-icon">🏟️</div>
                        <h3 class="quadra-title">Society Coberto</h3>
                        <p class="quadra-description">Quadra coberta com gramado sintético de alta qualidade.</p>
                        <div class="quadra-features">
                            <span class="feature-tag">Gramado Sintético</span>
                            <span class="feature-tag">Cobertura</span>
                            <span class="feature-tag">Iluminação LED</span>
                        </div>
                        <div class="quadra-price">R$ 100/hora</div>
                    </div>

                    <div class="quadra-card">
                        <div class="quadra-icon">⚽</div>
                        <h3 class="quadra-title">Futsal Coberto</h3>
                        <p class="quadra-description">Quadra oficial de futsal com piso especializado.</p>
                        <div class="quadra-features">
                            <span class="feature-tag">Piso Oficial</span>
                            <span class="feature-tag">40m x 20m</span>
                            <span class="feature-tag">Arquibancada</span>
                        </div>
                        <div class="quadra-price">R$ 90/hora</div>
                    </div>
                </div>
            </section>

            <!-- Navigation Menu -->
            <section>
                <h2 class="section-title">Acesso Rápido</h2>
                
                <div class="navigation-menu">
                    <a href="/PHP_A2/reserva/marcar" class="menu-item">
                        <div class="menu-icon">📅</div>
                        <div class="menu-title">Nova Reserva</div>
                        <div class="menu-description">Faça sua reserva de forma simples</div>
                    </a>

                    <a href="/PHP_A2/consultar_reserva" class="menu-item">
                        <div class="menu-icon">📋</div>
                        <div class="menu-title">Consultar Reservas</div>
                        <div class="menu-description">Veja todas as reservas ativas</div>
                    </a>
                </div>
            </section>
</main>

<?php include_once __DIR__ . '/includes/footer.php'; ?>