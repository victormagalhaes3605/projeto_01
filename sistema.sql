-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/03/2024 às 23:36
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_adm.online`
--

CREATE TABLE `tb_adm.online` (
  `id` int(11) NOT NULL,
  `ip` int(11) NOT NULL,
  `ultima_acao` datetime NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_adm.online`
--

INSERT INTO `tb_adm.online` (`id`, `ip`, `ultima_acao`, `token`) VALUES
(79, 0, '2024-03-08 15:13:14', '65eb474396642'),
(80, 0, '2024-03-08 19:35:14', '65eb92a2a177f');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_adm.usuarios`
--

CREATE TABLE `tb_adm.usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_adm.usuarios`
--

INSERT INTO `tb_adm.usuarios` (`id`, `user`, `password`, `img`, `nome`, `cargo`) VALUES
(1, 'admin', 'admin', '65d3b1ffa9e76.png', 'magal', 2),
(3, 'bene', '12345', 'caes.jpg', 'pablo mendes', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.clientes`
--

CREATE TABLE `tb_admin.clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `cpf_cnpj` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.clientes`
--

INSERT INTO `tb_admin.clientes` (`id`, `nome`, `email`, `tipo`, `cpf_cnpj`, `imagem`) VALUES
(22, 'Cafeteria LUPI', 'lupi@lupi.com', 'juridico', '12.312.312/3123-12', '65c26c0f7954a.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.empreendimentos`
--

CREATE TABLE `tb_admin.empreendimentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `preco` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.empreendimentos`
--

INSERT INTO `tb_admin.empreendimentos` (`id`, `nome`, `tipo`, `preco`, `imagem`, `slug`, `order_id`) VALUES
(11, 'Centro empresarial São Goncalo', 'residencial', '2.000,00', '65e90ed774851.png', 'centro-empresarial-sao-goncalo', 11);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.estoque`
--

CREATE TABLE `tb_admin.estoque` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `largura` int(11) NOT NULL,
  `altura` int(11) NOT NULL,
  `comprimento` int(11) NOT NULL,
  `peso` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.estoque`
--

INSERT INTO `tb_admin.estoque` (`id`, `nome`, `descricao`, `largura`, `altura`, `comprimento`, `peso`, `quantidade`) VALUES
(12, 'Tenis Nike Air Jordan 1 Mid Gs', 'asdasdas', 0, 0, 0, 0, 0),
(13, 'All star branco', '', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.estoque_imagens`
--

CREATE TABLE `tb_admin.estoque_imagens` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.estoque_imagens`
--

INSERT INTO `tb_admin.estoque_imagens` (`id`, `produto_id`, `imagem`) VALUES
(1, 2, '65c55c8649a0f.png'),
(2, 2, '65c55c8649b33.jpg'),
(3, 3, '65c562dd1b7c8.png'),
(4, 3, '65c562dd1b8d1.png'),
(5, 4, '65c564fc65657.png'),
(6, 4, '65c564fc65723.png'),
(28, 12, '65d7939e9f0e5.png'),
(29, 13, '65d7ab1b53206.png'),
(30, 12, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.financeiro`
--

CREATE TABLE `tb_admin.financeiro` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `vencimento` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.financeiro`
--

INSERT INTO `tb_admin.financeiro` (`id`, `cliente_id`, `nome`, `valor`, `vencimento`, `status`) VALUES
(128, 22, 'Agencia', '1.000,00', '2024-02-05', 1),
(129, 22, 'Agencia', '1.000,00', '2024-02-17', 1),
(130, 22, 'Agencia', '1.000,00', '2024-02-27', 1),
(131, 22, 'Agencia', '10.000,00', '2024-02-07', 1),
(132, 22, 'Agencia', '10.000,00', '2024-02-17', 1),
(133, 22, 'Agencia', '2.000,00', '2024-02-15', 0),
(134, 22, 'Agencia', '2.000,00', '2024-02-17', 0),
(135, 22, 'Agencia', '2.000,00', '2024-02-19', 0),
(136, 22, 'Agencia', '600,00', '2024-02-06', 0),
(139, 22, 'alugel', '2.000,00', '2024-02-09', 1),
(140, 22, 'alugel', '2.000,00', '2024-02-29', 0),
(141, 22, 'academia', '900,00', '2024-02-15', 1),
(142, 22, 'academia', '900,00', '2024-02-25', 0),
(143, 22, 'academia', '900,00', '2024-03-06', 0),
(144, 22, 'academia', '900,00', '2024-03-16', 0),
(145, 22, 'academia', '900,00', '2024-03-26', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.imagens_imoveis`
--

CREATE TABLE `tb_admin.imagens_imoveis` (
  `id` int(11) NOT NULL,
  `imovel_id` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.imagens_imoveis`
--

INSERT INTO `tb_admin.imagens_imoveis` (`id`, `imovel_id`, `imagem`) VALUES
(5, 6, '65ea16ff47cd9.png'),
(6, 7, '65ea171c52ea3.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.imoveis`
--

CREATE TABLE `tb_admin.imoveis` (
  `id` int(11) NOT NULL,
  `empreend_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `area` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.imoveis`
--

INSERT INTO `tb_admin.imoveis` (`id`, `empreend_id`, `nome`, `preco`, `area`, `order_id`) VALUES
(6, 11, 'Victor Magalhães', 222222.22, 2222222, 0),
(7, 11, 'Victor Magalhães', 222222.22, 2222222, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.visitas`
--

CREATE TABLE `tb_admin.visitas` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `dia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.visitas`
--

INSERT INTO `tb_admin.visitas` (`id`, `ip`, `dia`) VALUES
(4, '::1', '2023-10-03'),
(5, '::1', '2023-10-03'),
(6, '::1', '2023-10-03'),
(7, '::1', '2023-10-11'),
(8, '::1', '2023-10-23'),
(9, '::1', '2023-10-30'),
(10, '::1', '2023-11-06'),
(11, '::1', '2023-11-07'),
(12, '::1', '2023-11-08'),
(13, '::1', '2023-11-08'),
(14, '::1', '2023-11-08'),
(15, '::1', '2023-11-16'),
(16, '::1', '2023-11-22'),
(17, '::1', '2023-12-12'),
(18, '::1', '2023-12-21'),
(19, '::1', '2024-01-02'),
(20, '::1', '2024-01-09'),
(21, '::1', '2024-01-09'),
(22, '::1', '2024-01-30'),
(23, '::1', '2024-02-15'),
(24, '::1', '2024-02-23'),
(25, '::1', '2024-03-04'),
(26, '::1', '2024-03-08');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_site.categorias`
--

CREATE TABLE `tb_site.categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_site.categorias`
--

INSERT INTO `tb_site.categorias` (`id`, `nome`, `slug`, `order_id`) VALUES
(11, 'victor', 'victor', 12),
(12, 'asdas', 'asdas', 11);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_site.config`
--

CREATE TABLE `tb_site.config` (
  `titulo` varchar(255) NOT NULL,
  `nome_autor` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `icone1` varchar(255) NOT NULL,
  `descricao1` text NOT NULL,
  `icone2` varchar(255) NOT NULL,
  `descricao2` text NOT NULL,
  `icone3` varchar(255) NOT NULL,
  `descricao3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_site.config`
--

INSERT INTO `tb_site.config` (`titulo`, `nome_autor`, `descricao`, `icone1`, `descricao1`, `icone2`, `descricao2`, `icone3`, `descricao3`) VALUES
('Projeto 01', 'Victor Magalhães Gonçalves Wagner', 'Você precisa de um site ou aplicativo web? Então você está no lugar certo! Com habilidades em programação orientada a objetos e banco de dados, ele pode criar soluções personalizadas para suas necessidades. O PHP é uma linguagem livre e de código aberto, o que significa que você não precisa se preocupar com taxas de licenciamento. Entre em contato comigo hoje e comece a transformar suas ideias em realidade.\r\n', 'fa fa-css3', 'O CSS3 é a terceira versão das famosas Cascading Style Sheets (ou simplesmente CSS), pela qual se define estilos para um projeto web (página de internet). Com efeitos de transição, imagem, imagem de fundo/background e outros, pode-se criar estilos únicos para seus projetos web, alterando diversos aspectos de design no layout da página . O CSS3 é usado para estruturar, estilizar e formatar páginas da web, e várias novas funcionalidades foram adicionadas a ele .', 'fa fa-html5', 'O HTML5 é a quinta versão da linguagem de marcação de hipertexto (HTML) usada para estruturar e exibir conteúdo na World Wide Web . O HTML5 é a versão mais recente do HTML e foi projetado para ser mais eficiente, mais fácil de usar e mais flexível do que as versões anteriores . Ele inclui novos recursos, como suporte a vídeo e áudio, bem como novas tags e atributos que permitem que os desenvolvedores criem sites mais interativos e dinâmicos .', 'fa fa-gg-circle', 'O JavaScript é uma linguagem de programação que permite a você implementar itens complexos em páginas web .Toda vez que uma página da web faz mais do que simplesmente mostrar a você informação estática , mostrando conteúdo que se atualiza em um intervalo de tempo, mapas interativos ou gráficos 2D/3D animados, etc. , você pode apostar que o JavaScript provavelmente está envolvido. Ele é uma das tecnologias da web modernas mais populares e é versátil e amigável para iniciantes.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_site.depoimentos`
--

CREATE TABLE `tb_site.depoimentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `depoimento` text NOT NULL,
  `data` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_site.depoimentos`
--

INSERT INTO `tb_site.depoimentos` (`id`, `nome`, `depoimento`, `data`, `order_id`) VALUES
(24, 'victor', 'primeiro depoimento', '23/10/2023', 25),
(25, 'carlos', 'segundo depoimento', '12/10/2023', 26),
(26, 'Alessandro', 'terceiro depoimento', '23/10/2023', 27),
(27, 'dineuza', 'quarto depoimento', '23/10/2023', 24);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_site.noticias`
--

CREATE TABLE `tb_site.noticias` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `capa` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_site.noticias`
--

INSERT INTO `tb_site.noticias` (`id`, `categoria_id`, `data`, `titulo`, `conteudo`, `capa`, `slug`, `order_id`) VALUES
(15, 12, '2024-01-29', 'flamengo', '<p>xcxcvxcvxc</p>', '65b7fe0de0964.png', 'flamengo', 15);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_site.servicos`
--

CREATE TABLE `tb_site.servicos` (
  `id` int(11) NOT NULL,
  `servicos` text NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_site.servicos`
--

INSERT INTO `tb_site.servicos` (`id`, `servicos`, `order_id`) VALUES
(4, 'Meu serviço #1', 5),
(5, 'Meu serviço #2', 6),
(6, 'Meu serviço #3 EDITADO Denovo', 7),
(7, 'Meu serviço #4', 4),
(8, 'Meu serviço #5', 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_site.slides`
--

CREATE TABLE `tb_site.slides` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slide` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_site.slides`
--

INSERT INTO `tb_site.slides` (`id`, `nome`, `slide`, `order_id`) VALUES
(13, 'victor', '654952629f719.jpg', 16),
(15, 'fundo ', '65495d5823c54.jpg', 13),
(16, 'fundo 3', '65495d628c74e.avif', 15);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_adm.online`
--
ALTER TABLE `tb_adm.online`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_adm.usuarios`
--
ALTER TABLE `tb_adm.usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_admin.clientes`
--
ALTER TABLE `tb_admin.clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_admin.empreendimentos`
--
ALTER TABLE `tb_admin.empreendimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_admin.estoque`
--
ALTER TABLE `tb_admin.estoque`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_admin.estoque_imagens`
--
ALTER TABLE `tb_admin.estoque_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_admin.financeiro`
--
ALTER TABLE `tb_admin.financeiro`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_admin.imagens_imoveis`
--
ALTER TABLE `tb_admin.imagens_imoveis`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_admin.imoveis`
--
ALTER TABLE `tb_admin.imoveis`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_admin.visitas`
--
ALTER TABLE `tb_admin.visitas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_site.categorias`
--
ALTER TABLE `tb_site.categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_site.depoimentos`
--
ALTER TABLE `tb_site.depoimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_site.noticias`
--
ALTER TABLE `tb_site.noticias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_site.servicos`
--
ALTER TABLE `tb_site.servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_site.slides`
--
ALTER TABLE `tb_site.slides`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_adm.online`
--
ALTER TABLE `tb_adm.online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de tabela `tb_adm.usuarios`
--
ALTER TABLE `tb_adm.usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_admin.clientes`
--
ALTER TABLE `tb_admin.clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `tb_admin.empreendimentos`
--
ALTER TABLE `tb_admin.empreendimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tb_admin.estoque`
--
ALTER TABLE `tb_admin.estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tb_admin.estoque_imagens`
--
ALTER TABLE `tb_admin.estoque_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `tb_admin.financeiro`
--
ALTER TABLE `tb_admin.financeiro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT de tabela `tb_admin.imagens_imoveis`
--
ALTER TABLE `tb_admin.imagens_imoveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tb_admin.imoveis`
--
ALTER TABLE `tb_admin.imoveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_admin.visitas`
--
ALTER TABLE `tb_admin.visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `tb_site.categorias`
--
ALTER TABLE `tb_site.categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tb_site.depoimentos`
--
ALTER TABLE `tb_site.depoimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `tb_site.noticias`
--
ALTER TABLE `tb_site.noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `tb_site.servicos`
--
ALTER TABLE `tb_site.servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tb_site.slides`
--
ALTER TABLE `tb_site.slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
