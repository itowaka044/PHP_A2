<?php
// setup.php

// Inclua a classe de configuração do banco de dados
require_once __DIR__ . "/DbConfig.php";

use PDO; // Para usar constantes PDO
use PDOException; // Para capturar exceções específicas do PDO

echo "<h1>Configuração Automática do Banco de Dados</h1>";
echo "<p>Este script irá criar o banco de dados e as tabelas necessárias, e popular dados iniciais.</p>";

// --- Configurações do Banco de Dados (as mesmas do DbConfig) ---
$host = 'localhost';
$port = 3307; // Sua porta customizada
$user = 'root';
$pass = '123'; // Sua senha do root
$databaseName = 'reservador_fut'; // O nome do seu banco de dados

try {
    // --- PASSO 1: Conectar ao MySQL/MariaDB sem especificar um banco de dados ---
    // Isso é necessário para poder criar o banco de dados se ele não existir
    $conn = new PDO("mysql:host=$host;port=$port", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color: green;'>1. Conexão com o servidor MySQL/MariaDB estabelecida com sucesso.</p>";

    // --- PASSO 2: Criar o banco de dados específico se ele não existir ---
    $sqlCreateDb = "CREATE DATABASE IF NOT EXISTS `$databaseName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
    $conn->exec($sqlCreateDb);
    echo "<p style='color: green;'>2. Banco de dados '<strong>$databaseName</strong>' verificado/criado com sucesso.</p>";

    // --- PASSO 3: Conectar AGORA ao banco de dados específico para criar tabelas ---
    // É importante reconectar para garantir que estamos no DB certo.
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$databaseName", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color: green;'>3. Conectado ao banco de dados '<strong>$databaseName</strong>' para criar tabelas.</p>";

    // --- PASSO 4: Criar as tabelas se elas não existirem ---
    // a) Tabela 'quadras' (baseado nas propriedades da sua classe Quadra)
    // **ATENÇÃO: Mantenha a consistência nos nomes das colunas e propriedades!**
    // Mudei para 'id', 'nome', 'tipo', 'reservado' para espelhar sua classe.
    $sqlQuadras = "
        CREATE TABLE IF NOT EXISTS `quadras` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `nome` VARCHAR(255) NOT NULL,
            `tipo` VARCHAR(100), -- Coluna para 'society', 'futsal', etc.
            `reservado` BOOLEAN DEFAULT FALSE, -- Para indicar se a quadra está reservada
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ";
    $conn->exec($sqlQuadras);
    echo "<p style='color: green;'>4. Tabela '<strong>quadras</strong>' verificada/criada com sucesso.</p>";

    // b) Tabela 'clientes' (baseado nas propriedades da sua classe Cliente)
    // Você não forneceu a classe Cliente, então este é um exemplo comum. Ajuste conforme sua classe Cliente.
    $sqlClientes = "
        CREATE TABLE IF NOT EXISTS `clientes` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `nome` VARCHAR(255) NOT NULL,
            `cpf` VARCHAR(14) UNIQUE NOT NULL, -- CPF geralmente é único
            `telefone` VARCHAR(20),
            `email` VARCHAR(255) UNIQUE,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ";
    $conn->exec($sqlClientes);
    echo "<p style='color: green;'>5. Tabela '<strong>clientes</strong>' verificada/criada com sucesso.</p>";

    // c) Tabela 'reservas' (baseado nas propriedades da sua classe Reserva)
    $sqlReservas = "
        CREATE TABLE IF NOT EXISTS `reservas` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `cliente_id` INT NOT NULL, -- Chave estrangeira para a tabela 'clientes'
            `quadra_id` INT NOT NULL,  -- Chave estrangeira para a tabela 'quadras'
            `data_reserva` DATE NOT NULL,
            `hora_inicio` TIME NOT NULL,
            `hora_fim` TIME NOT NULL,
            `status` VARCHAR(50) DEFAULT 'confirmada', -- Ex: 'confirmada', 'cancelada', 'pendente'
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`cliente_id`) REFERENCES `clientes`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`quadra_id`) REFERENCES `quadras`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ";
    $conn->exec($sqlReservas);
    echo "<p style='color: green;'>6. Tabela '<strong>reservas</strong>' verificada/criada com sucesso.</p>";

    // --- PASSO 5: Inserir dados iniciais (se as tabelas estiverem vazias) ---
    // Apenas para 'quadras' por exemplo
    $stmtCheckQuadrasData = $conn->query("SELECT COUNT(*) FROM quadras");
    if ($stmtCheckQuadrasData->fetchColumn() == 0) {
        $sqlInsertQuadras = "
            INSERT INTO quadras (id, nome, tipo, reservado) VALUES
            (1, 'society aberto', 'society', FALSE),
            (2, 'society coberto', 'society', FALSE),
            (3, 'futsal coberto', 'futsal', FALSE);
        ";
        $conn->exec($sqlInsertQuadras);
        echo "<p style='color: green;'>7. Dados iniciais na tabela '<strong>quadras</strong>' inseridos com sucesso.</p>";
    } else {
        echo "<p style='color: blue;'>7. Tabela '<strong>quadras</strong>' já contém dados, pulando inserção inicial.</p>";
    }

    echo "<h2 style='color: green;'>Configuração do banco de dados concluída com sucesso!</h2>";
    echo "<p>Você pode agora testar sua aplicação principal.</p>";

} catch (PDOException $e) {
    echo "<h2 style='color: red;'>Erro Fatal na Configuração do Banco de Dados!</h2>";
    echo "<p style='color: red;'>Por favor, verifique os seguintes pontos:</p>";
    echo "<ul>";
    echo "<li><strong>1. MySQL/MariaDB está rodando?</strong> Verifique no XAMPP Control Panel se o MySQL está verde ('Running').</li>";
    echo "<li><strong>2. Porta correta?</strong> Confirme se a porta 3307 no 'DbConfig.php' e neste 'setup.php' é a mesma que o MySQL/MariaDB está realmente usando (verifique no 'my.ini' do XAMPP).</li>";
    echo "<li><strong>3. Senha do 'root' correta?</strong> A senha '123' está correta para o usuário 'root' do MySQL?</li>";
    echo "<li><strong>Detalhes do Erro:</strong> " . $e->getMessage() . "</li>";
    echo "</ul>";
    echo "<p>Após corrigir, tente acessar este 'setup.php' novamente.</p>";
}

?>