-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 19-Maio-2021 às 17:56
-- Versão do servidor: 8.0.21
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `aviii_desenvweb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`id`, `nome`) VALUES
(1, 'Administrador'),
(2, 'Gerente de Comunidade'),
(3, 'Usuario');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos`
--

DROP TABLE IF EXISTS `projetos`;
CREATE TABLE IF NOT EXISTS `projetos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `valor` float NOT NULL,
  `banner` varchar(100) NOT NULL,
  `criado_por` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `projetos`
--

INSERT INTO `projetos` (`id`, `titulo`, `descricao`, `valor`, `banner`, `criado_por`) VALUES
(1, 'Blue Protocol', '&#34;O mundo está à beira da devastação, agora é a hora de se unir. Marche com amigos e estranhos para derrotar inimigos que não podem ser destruídos sozinhos. Viaje através do espaço e do tempo para mudar o futuro!&#34;', 250, 'assets/f3db166f48166864093ff5024bd86684.jpg', 1),
(2, 'God Eater: Ressurection', '&#34;Num mundo apocalíptico, a tua equipa especial de God Eaters terá de neutralizar os monstros que estão a destruir o mundo. Uma história épica, personagens únicas e God Arcs/Aragami únicos: bem-vindo ao patamar seguinte dos jogos de AÇÃO!&#34;', 350, 'assets/bb752a59c2db858072c2f48399a9efd5.jpg', 1),
(4, 'Code Vein', '&#34;Diante da morte certa, nos erguemos. Monte sua equipe e embarque numa jornada aos confins do inferno para revelar o seu passado e escapar desse pesadelo vivo em CODE VEIN.&#34;', 150, 'assets/3d66049d46957d7cb02b118236f1d392.jpg', 1),
(3, 'Tales of Arise', '&#34;Tales of ARISE segue a história de Alphen, um indivíduo com uma máscara de ferro cujo planeta natal, Dahna, tem sido escravizado e despojado de seus recursos naturais pelos últimos 300 anos por Rena, seu planeta vizinho. Conforme luta para libertar seu povo, Alphen se depara com Shionne, uma garota de Rena que está fugindo de seus compatriotas.&#34;', 200, 'assets/1fd332483424cb80edb07f0bc00450b8.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `perfil` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `perfil`) VALUES
(1, 'Admin', 'admin@animetic.com.br', 'b4e883efe3b956d74d28f520dbf4a6f8', 'Administrador'),
(2, 'David Li Zhao', 'cm@animetic.com.br', 'b4e883efe3b956d74d28f520dbf4a6f8', 'Gerente de Comunidade'),
(3, 'David Li Zhao', 'cm2@animetic.com.br', 'b4e883efe3b956d74d28f520dbf4a6f8', 'Gerente de Comunidade'),
(4, 'David Li Zhao', 'david@gmail.com', 'b4e883efe3b956d74d28f520dbf4a6f8', 'Usuario'),
(5, 'David Li Zhao', 'david2@gmail.com', 'b4e883efe3b956d74d28f520dbf4a6f8', 'Usuario');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
