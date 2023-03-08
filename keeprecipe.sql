-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Mar-2023 às 07:54
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `keeprecipe`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `recipe`
--

CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `modo_preparo` varchar(255) NOT NULL,
  `ingredient` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `recipe`
--

INSERT INTO `recipe` (`id`, `title`, `modo_preparo`, `ingredient`, `id_user`, `created_at`) VALUES
(8, 'Brownie', 'Misture os ovos e o açúcar.  Em seguida, agregue todos os outros ingredientes até formar um creme uniforme.  Despeje em uma assadeira, forrada com papel-manteiga e leve ao forno médio por 40 minutos.  O brownie estará pronto quando a parte de cima estiver', '6 colheres (sopa) bem cheias, de margarina sem sal 3/4 xícara (chá) achocolatado 1/2 xícara (chá) chocolate em pó 1 e 1/4 xícara (chá) farinha de trigo 2 xícaras (chá) açúcar 4 ovos 2 pitadas de sal 1 colheres (chá) de extrato ou essência de baunilha 1 ta', 4, '2023-03-02 03:31:27'),
(9, 'Pudim', '1 Numa forma para pudim, de 20 centímetros de diâmetro, coloque 6 colheres de sopa de açúcar e leve ao fogo médio até virar uma calda caramelada, por mais ou menos 3 minutos. 2 Retire do fogo e vá virando a fôrma, de modo que a calda forre todo o fundo e ', '6 colheres de sopa de açúcar 1 lata de leite condensado 1 lata de leite, use a mesma medida do leite condensado 3 ovos', 5, '2023-03-02 03:33:45'),
(12, 'Miojo', 'Por no microondas', 'agua e miojo', 5, '2023-03-02 03:47:22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `coment` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_recipe` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `scores`
--

INSERT INTO `scores` (`id`, `score`, `coment`, `id_user`, `id_recipe`, `created_at`) VALUES
(6, 10, 'Muito deliciosa', 4, 8, '2023-03-02 03:31:59'),
(7, 10, 'Amei muito', 5, 9, '2023-03-02 03:36:18'),
(10, 8, 'bom mas não é saudável', 5, 12, '2023-03-02 03:47:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(4, 'loisv', '$2y$10$kDR0J0QOXqNDXKxwdEpCKeacWXqOiZzkac77im.DnI7QrrOeC0FVu', '0000-00-00 00:00:00'),
(5, 'test', '$2y$10$WIA8Oh1F8LpPr5vGjLEWieAQlfjBYl1cINQwLYTlgSh0tbS8zl8wO', '0000-00-00 00:00:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recipe_users` (`id_user`);

--
-- Índices para tabela `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_scores_recipe` (`id_recipe`),
  ADD KEY `fk_scores_users` (`id_user`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `fk_recipe_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `fk_scores_recipe` FOREIGN KEY (`id_recipe`) REFERENCES `recipe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_scores_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
