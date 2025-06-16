______________________________________________________
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Tempo de geração: 16/06/2025 às 06:10
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- start --
-- Banco de dados: `reservador_fut`
--
CREATE DATABASE IF NOT EXISTS `reservador_fut` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `reservador_fut`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `horario`
--

CREATE TABLE `horario` (
  `idHorario` int(11) NOT NULL,
  `idQuadra` int(11) NOT NULL,
  `dataHorario` date NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFim` time NOT NULL,
  `statusDisp` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `horario`
--

INSERT INTO `horario` (`idHorario`, `idQuadra`, `dataHorario`, `horaInicio`, `horaFim`, `statusDisp`) VALUES
(2, 1, '2025-06-01', '09:00:00', '10:00:00', 1),
(3, 1, '2025-06-01', '10:00:00', '11:00:00', 1),
(4, 1, '2025-06-01', '11:00:00', '12:00:00', 1),
(5, 1, '2025-06-01', '12:00:00', '13:00:00', 1),
(6, 1, '2025-06-01', '13:00:00', '14:00:00', 1),
(7, 1, '2025-06-01', '14:00:00', '15:00:00', 1),
(8, 1, '2025-06-01', '15:00:00', '16:00:00', 1),
(9, 1, '2025-06-01', '16:00:00', '17:00:00', 1),
(10, 1, '2025-06-01', '17:00:00', '18:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `quadra`
--

CREATE TABLE `quadra` (
  `idQuadra` int(11) NOT NULL,
  `nomeQuadra` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `valorHora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `quadra`
--

INSERT INTO `quadra` (`idQuadra`, `nomeQuadra`, `tipo`, `valorHora`) VALUES
(1, 'quadra A', 'society', 7000),
(2, 'quadra B', 'futsal', 6000),
(3, 'quadra C', 'areia', 10000);

-- --------------------------------------------------------

--
-- Estrutura para tabela `reserva`
--

CREATE TABLE `reserva` (
  `idReserva` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idHorario` int(11) NOT NULL,
  `idQuadra` int(11) NOT NULL,
  `dataReserva` date NOT NULL,
  `statusReserva` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reserva`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(255) NOT NULL,
  `senhaUsuario` varchar(255) NOT NULL,
  `cpfUsuario` varchar(255) NOT NULL,
  `telefoneUsuario` varchar(255) DEFAULT NULL,
  `emailUsuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`idHorario`),
  ADD UNIQUE KEY `uq_horario_quadra_data_inicio` (`idQuadra`,`dataHorario`,`horaInicio`);

--
-- Índices de tabela `quadra`
--
ALTER TABLE `quadra`
  ADD PRIMARY KEY (`idQuadra`);

--
-- Índices de tabela `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`idReserva`),
  ADD UNIQUE KEY `uq_reserva_horario_unico` (`idHorario`),
  ADD KEY `fk_reserva_usuario` (`idUsuario`),
  ADD KEY `fk_reserva_quadra` (`idQuadra`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `horario`
--
ALTER TABLE `horario`
  MODIFY `idHorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `quadra`
--
ALTER TABLE `quadra`
  MODIFY `idQuadra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `fk_horario_quadra` FOREIGN KEY (`idQuadra`) REFERENCES `quadra` (`idQuadra`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_reserva_horario` FOREIGN KEY (`idHorario`) REFERENCES `horario` (`idHorario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reserva_quadra` FOREIGN KEY (`idQuadra`) REFERENCES `quadra` (`idQuadra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reserva_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON UPDATE CASCADE;

  -- --end-- --
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;