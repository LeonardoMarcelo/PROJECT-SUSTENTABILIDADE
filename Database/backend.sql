-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Set-2022 às 00:26
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `backend`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `calendario_comida`
--

CREATE TABLE `calendario_comida` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `lanche_manha` varchar(200) NOT NULL,
  `almoco` varchar(200) NOT NULL,
  `lanche_tarde` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `calendario_comida`
--

INSERT INTO `calendario_comida` (`id`, `data`, `lanche_manha`, `almoco`, `lanche_tarde`) VALUES
(1, '2022-08-31', 'café com leite e pão', 'frango frito, arroz e feijão', 'bolo de chocolate com suco'),
(2, '2022-09-23', 'cuzcuz com ovo', 'arroz com galinha', 'bolacha'),
(3, '2022-09-23', 'cachorro quente', 'macarrao com strogonof', 'sucrilhos'),
(4, '2022-09-01', 'pão com ovo', 'macarão com carne', 'bolacha salgada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_log_tentativa`
--

CREATE TABLE `tab_log_tentativa` (
  `id` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `origem` varchar(300) NOT NULL,
  `bloqueado` char(3) NOT NULL,
  `data_hora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tab_log_tentativa`
--

INSERT INTO `tab_log_tentativa` (`id`, `ip`, `email`, `origem`, `bloqueado`, `data_hora`) VALUES
(66, '::1', 'leozimcelo007@gmail.com', 'http://localhost/project-backend/login.php', 'NAO', '2022-05-06 15:04:54'),
(67, '::1', 'admin@admin.com', 'http://localhost/project-backend/login.php', 'NAO', '2022-05-06 15:20:00'),
(70, '::1', 'admin@admin.com', 'http://localhost/project-backend/login.php', 'NAO', '2022-05-06 15:52:07'),
(71, '::1', 's@gmail.com', 'http://localhost/project-backend/login.php', 'NAO', '2022-05-06 16:04:15'),
(72, '::1', 's@gmail.com', 'http://localhost/project-backend/login.php', 'NAO', '2022-05-06 16:04:20'),
(73, '::1', 's@gmail.com', 'http://localhost/project-backend/login.php', 'NAO', '2022-05-06 16:04:23'),
(74, '::1', 's@gmail.com', 'http://localhost/project-backend/login.php', 'NAO', '2022-05-06 16:04:27'),
(75, '::1', 's@gmail.com', 'http://localhost/project-backend/login.php', 'SIM', '2022-05-06 16:04:31'),
(76, '::1', 's@gmail.com', 'http://localhost/project-backend/login.php', 'NAO', '2022-05-06 17:57:24'),
(77, '::1', 'admib@admin.com', 'http://localhost/project-backend/login.php', 'NAO', '2022-05-24 18:37:53'),
(78, '::1', 's@gmail.com3', 'http://localhost/project-backend/login.php', 'NAO', '2022-05-24 18:51:24'),
(79, '::1', 's@gmail.com', 'http://localhost/project-backend/login.php', 'NAO', '2022-05-24 18:51:27'),
(80, '::1', 's@gmail.com', 'http://localhost/project-backend/login.php', 'NAO', '2022-05-24 18:51:39'),
(81, '::1', 's@gmail.com2', 'http://localhost/project-backend/login.php', 'NAO', '2022-05-24 18:52:01'),
(82, '::1', 's@gmail.com', 'http://localhost/project-backend/login.php', 'SIM', '2022-05-24 18:52:07'),
(83, '::1', 's@gmail.comeeeeeeee', 'http://localhost/project-geografia/', 'NAO', '2022-08-30 21:10:51'),
(84, '::1', 's@gmail.com', 'http://localhost/project-geografia/', 'NAO', '2022-08-30 21:10:56'),
(85, '::1', 's@gmail.com', 'http://localhost/project-geografia/', 'NAO', '2022-08-30 21:54:24'),
(86, '::1', 's@gmail.com', 'http://localhost/project-geografia/', 'NAO', '2022-08-30 21:56:43'),
(87, '::1', 's@gmail.com', 'http://localhost/project-geografia/index.php', 'NAO', '2022-08-30 21:56:49'),
(88, '::1', 'admin@admin.com', 'http://localhost/project-geografia/index.php', 'NAO', '2022-08-31 11:04:53'),
(89, '::1', 'admin@admin.com', 'http://localhost/project-geografia/index.php', 'NAO', '2022-08-31 11:10:01'),
(90, '::1', 'admin@admin.com', 'http://localhost/project-geografia/index.php', 'NAO', '2022-08-31 11:10:35'),
(91, '::1', 'sss', 'http://localhost/project-geografia/index.php', 'NAO', '2022-08-31 11:35:56'),
(92, '::1', 'admin@admin.com', 'http://localhost/project-geografia/index.php', 'NAO', '2022-08-31 19:25:37'),
(93, '::1', 'admin@admin.com', 'http://localhost/project-geografia/index.php', 'NAO', '2022-08-31 21:02:47'),
(94, '::1', 'admin@admin.com', 'http://localhost/project-geografia/', 'NAO', '2022-09-01 16:28:04'),
(95, '::1', 'elk@gmail.com', 'http://localhost/project-geografia/index.php', 'NAO', '2022-09-01 17:15:46'),
(96, '::1', 's@gmail.com', 'http://localhost/project-sustentabilidade-main/index.php', 'NAO', '2022-09-02 22:06:45'),
(97, '::1', 's@gmail.com', 'http://localhost/project-sustentabilidade-main/index.php', 'NAO', '2022-09-02 22:06:48'),
(98, '::1', 's@gmail.com', 'http://localhost/project-sustentabilidade-main/index.php', 'NAO', '2022-09-02 22:06:53'),
(99, '::1', 's@gmail.com', 'http://localhost/project-sustentabilidade-main/index.php', 'NAO', '2022-09-02 22:06:57'),
(100, '::1', 's@gmail.com', 'http://localhost/project-sustentabilidade-main/index.php', 'SIM', '2022-09-02 22:07:01'),
(101, '::1', 's@gmail.com', 'http://localhost/project-sustentabilidade-main/index.php', 'NAO', '2022-09-02 22:25:41'),
(102, '::1', 's@gmail.com', 'http://localhost/project-sustentabilidade-main/index.php', 'NAO', '2022-09-02 22:26:27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas`
--

CREATE TABLE `turmas` (
  `id` int(11) NOT NULL,
  `nome_serie` varchar(11) NOT NULL,
  `sala` int(11) NOT NULL,
  `lanche_manha` int(11) NOT NULL,
  `almoco` int(11) NOT NULL,
  `lanche_tarde` int(11) NOT NULL,
  `data` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `turmas`
--

INSERT INTO `turmas` (`id`, `nome_serie`, `sala`, `lanche_manha`, `almoco`, `lanche_tarde`, `data`) VALUES
(1, '1°A', 1, 29, 34, 33, '2022-08-31'),
(2, '1°B', 2, 26, 23, 34, '2022-08-31'),
(3, '1°C', 3, 54, 35, 15, '2022-08-31'),
(4, ' 1ºD', 4, 12, 14, 17, '2022-08-23'),
(23, '2ºA', 5, 23, 20, 10, '2022-09-01'),
(29, '1°B', 6, 22, 10, 10, '2022-09-02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_token` int(11) NOT NULL,
  `user_level` varchar(255) NOT NULL,
  `user_turma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_email`, `user_password`, `user_token`, `user_level`, `user_turma_id`) VALUES
(1, 'Jeferson', 'admin@admin.com', '$2y$10$b1tfQvUCDAri4AVFKSSr.eJy4hJEi1FKWKW0XYvph8vTKtimc38cm', 1234567890, '10', 0),
(13, 'elksandro', 'elk@gmail.com', '$2y$10$b1tfQvUCDAri4AVFKSSr.eJy4hJEi1FKWKW0XYvph8vTKtimc38cm', 1212121212, '8', 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `calendario_comida`
--
ALTER TABLE `calendario_comida`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tab_log_tentativa`
--
ALTER TABLE `tab_log_tentativa`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_turma_id` (`user_turma_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `calendario_comida`
--
ALTER TABLE `calendario_comida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tab_log_tentativa`
--
ALTER TABLE `tab_log_tentativa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_turma_id`) REFERENCES `turmas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
