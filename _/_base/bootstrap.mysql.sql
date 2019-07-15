SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE admin (
  id int(11) NOT NULL,
  ativo tinyint(1) DEFAULT '1',
  datacadastro timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  codprojeto int(11) DEFAULT NULL,
  nome varchar(400) DEFAULT NULL,
  email varchar(400) DEFAULT NULL,
  senha varchar(400) DEFAULT NULL,
  ultimo_acesso timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  ip varchar(100) DEFAULT NULL,
  bloqueado int(1) DEFAULT '0',
  imagem varchar(400) DEFAULT NULL,
  cod_grupo_admin int(11) DEFAULT NULL,
  token varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela admin
--

INSERT INTO admin (id, ativo, datacadastro, codprojeto, nome, email, senha, ultimo_acesso, ip, bloqueado, imagem, cod_grupo_admin, token) VALUES
(1, 1, '2019-06-06 18:13:09', 60, 'Will - Root', 'root@wilsonneto.com.br', 'e10adc3949ba59abbe56e057f20f883e', '2019-06-01 03:00:00', NULL, 0, NULL, 4, '0d29c8d7eff97d2');

CREATE TABLE admin_projeto_workspace (
  id int(11) NOT NULL,
  cod_admin int(11) NOT NULL,
  cod_projeto_workspace int(11) NOT NULL,
  cadastrado datetime DEFAULT CURRENT_TIMESTAMP,
  atualizado datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO admin_projeto_workspace (id, cod_admin, cod_projeto_workspace, cadastrado, atualizado) VALUES
(1, 1, 1, '2019-02-22 14:17:55', NULL);


CREATE TABLE grupo_admin (
  id int(11) NOT NULL,
  ativo tinyint(1) DEFAULT '1',
  datacadastro timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  codprojeto int(11) DEFAULT NULL,
  nome varchar(200) DEFAULT NULL,
  descricao varchar(200) DEFAULT NULL,
  cod_pagina_admin int(11) DEFAULT NULL,
  hierarquia int(11) DEFAULT '10',
  padrao int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO grupo_admin (id, ativo, datacadastro, codprojeto, nome, descricao, cod_pagina_admin, hierarquia, padrao) VALUES
(1, 1, '2014-07-29 05:18:25', 1, 'Administrador', 'Grupo de Administradores', 44, 10, 1);

CREATE TABLE grupo_pagina_admin (
  cod_grupo_admin int(11) DEFAULT NULL,
  cod_pagina_admin int(11) DEFAULT NULL,
  escrita int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO grupo_pagina_admin (cod_grupo_admin, cod_pagina_admin, escrita) VALUES 
(4, 63, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela log_admin
--

CREATE TABLE log_admin (
  id int(11) NOT NULL,
  datacadastro timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  codprojeto int(11) DEFAULT '1',
  ip varchar(100) DEFAULT NULL,
  pagina varchar(200) DEFAULT NULL,
  texto varchar(5000) DEFAULT NULL,
  tipo varchar(300) DEFAULT NULL,
  valor_anterior varchar(5000) DEFAULT NULL,
  valor_apos varchar(5000) DEFAULT NULL,
  cod_admin int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela log_geral
--

CREATE TABLE log_geral (
  id int(11) NOT NULL,
  datacadastro timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  codprojeto int(11) DEFAULT '1',
  ip varchar(100) DEFAULT NULL,
  pagina varchar(200) DEFAULT NULL,
  texto varchar(2000) DEFAULT NULL,
  tipo varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela menu_admin
--

CREATE TABLE menu_admin (
  id int(11) NOT NULL,
  ativo tinyint(1) DEFAULT '1',
  datacadastro timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  codprojeto int(11) DEFAULT NULL,
  icone varchar(400) DEFAULT NULL,
  texto varchar(400) DEFAULT NULL,
  ordem int(11) DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela menu_admin
--

INSERT INTO menu_admin (id, ativo, datacadastro, codprojeto, icone, texto, ordem) VALUES
(1, 0, '2014-07-29 05:14:43', 1, 'fa-bar-chart-o', 'Análises', 10),
(2, 1, '2014-08-08 06:22:27', 1, 'fa-edit', 'Site', 11),
(3, 1, '2014-08-08 06:22:27', 1, 'fa-th', 'Dados', 12),
(4, 0, '2014-08-17 06:00:00', 1, 'fa-folder', 'Promoters', 13),
(5, 1, '2014-08-17 06:00:00', 1, 'fa-laptop', 'Configurações', 499),
(6, 0, '2014-11-22 04:00:00', 1, ' fa-file-text', 'Relatórios', 15),
(7, 1, '2016-09-22 00:57:52', 1, 'fa-users', 'Administradores', 500),
(8, 1, '2017-08-10 19:46:14', 1, 'fa-list', 'Audiência', 2),
(9, 1, '2017-08-10 19:46:14', 1, 'fa-file-text-o', 'Páginas', 100),
(10, 1, '2017-08-10 19:46:14', 1, 'fa-shopping-cart', 'e-Commerce', 1),
(11, 1, '2017-08-10 19:46:14', 1, 'fa-file-text-o', 'Blog / Conteúdo', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela notificacao
--

CREATE TABLE notificacao (
  id int(11) NOT NULL,
  codprojeto int(11) DEFAULT '1',
  data timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  ativo int(11) DEFAULT '1',
  cod_notificacao_tipo int(11) DEFAULT NULL,
  texto varchar(1000) DEFAULT NULL,
  cod_complemento int(11) DEFAULT NULL,
  link varchar(300) DEFAULT NULL,
  icone varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela notificacao_tipo
--

CREATE TABLE notificacao_tipo (
  id int(11) NOT NULL,
  nome varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela notificacao_visualizacao
--

CREATE TABLE notificacao_visualizacao (
  id int(11) NOT NULL,
  codprojeto int(11) DEFAULT '1',
  cod_admin int(11) DEFAULT NULL,
  cod_notificacao_tipo int(11) DEFAULT NULL,
  data timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela pagina_admin
--

CREATE TABLE pagina_admin (
  id int(11) NOT NULL,
  ativo tinyint(1) DEFAULT '1',
  datacadastro timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  codprojeto int(11) DEFAULT NULL,
  descricao varchar(400) DEFAULT NULL,
  posicao int(11) DEFAULT '100',
  url varchar(500) DEFAULT NULL,
  target varchar(200) DEFAULT NULL,
  cod_menu_admin int(11) DEFAULT NULL,
  bloqueado int(1) DEFAULT '0',
  permissao varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela projeto_workspace
--

CREATE TABLE projeto_workspace (
  id int(11) NOT NULL,
  nome varchar(500) DEFAULT NULL,
  ativo int(1) DEFAULT '1',
  cadastrado datetime DEFAULT CURRENT_TIMESTAMP,
  atualizado datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  cod_admin int(11) DEFAULT NULL,
  hash varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table admin
--
ALTER TABLE admin
  ADD PRIMARY KEY (id),
  ADD KEY cod_grupo_admin (cod_grupo_admin);

--
-- Indexes for table admin_projeto_workspace
--
ALTER TABLE admin_projeto_workspace
  ADD PRIMARY KEY (id);

--
-- Indexes for table grupo_admin
--
ALTER TABLE grupo_admin
  ADD PRIMARY KEY (id),
  ADD KEY cod_pagina_admin (cod_pagina_admin);

--
-- Indexes for table grupo_pagina_admin
--
ALTER TABLE grupo_pagina_admin
  ADD KEY fk_grupo (cod_grupo_admin),
  ADD KEY fk_pagina (cod_pagina_admin);

--
-- Indexes for table log_admin
--
ALTER TABLE log_admin
  ADD PRIMARY KEY (id),
  ADD KEY cod_admin (cod_admin);

--
-- Indexes for table log_geral
--
ALTER TABLE log_geral
  ADD PRIMARY KEY (id);

--
-- Indexes for table menu_admin
--
ALTER TABLE menu_admin
  ADD PRIMARY KEY (id);

--
-- Indexes for table notificacao
--
ALTER TABLE notificacao
  ADD PRIMARY KEY (id),
  ADD KEY cod_notificacao_tipo (cod_notificacao_tipo);

--
-- Indexes for table notificacao_tipo
--
ALTER TABLE notificacao_tipo
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY id (id);

--
-- Indexes for table notificacao_visualizacao
--
ALTER TABLE notificacao_visualizacao
  ADD PRIMARY KEY (id),
  ADD KEY cod_notificacao_tipo (cod_notificacao_tipo),
  ADD KEY cod_admin_fk_idx (cod_admin);

--
-- Indexes for table pagina_admin
--
ALTER TABLE pagina_admin
  ADD PRIMARY KEY (id),
  ADD KEY cod_menu_admin (cod_menu_admin);

--
-- Indexes for table projeto_workspace
--
ALTER TABLE projeto_workspace
  ADD PRIMARY KEY (id);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table admin
--
ALTER TABLE admin
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table admin_projeto_workspace
--
ALTER TABLE admin_projeto_workspace
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table grupo_admin
--
ALTER TABLE grupo_admin
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table log_admin
--
ALTER TABLE log_admin
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1652;
--
-- AUTO_INCREMENT for table log_geral
--
ALTER TABLE log_geral
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table menu_admin
--
ALTER TABLE menu_admin
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table notificacao
--
ALTER TABLE notificacao
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table notificacao_tipo
--
ALTER TABLE notificacao_tipo
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table notificacao_visualizacao
--
ALTER TABLE notificacao_visualizacao
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table pagina_admin
--
ALTER TABLE pagina_admin
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table projeto_workspace
--
ALTER TABLE projeto_workspace
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela admin
--
ALTER TABLE admin
  ADD CONSTRAINT admin_ibfk_1 FOREIGN KEY (cod_grupo_admin) REFERENCES grupo_admin (id);

--
-- Limitadores para a tabela grupo_admin
--
ALTER TABLE grupo_admin
  ADD CONSTRAINT grupo_admin_ibfk_1 FOREIGN KEY (cod_pagina_admin) REFERENCES pagina_admin (id);

--
-- Limitadores para a tabela pagina_admin
--
ALTER TABLE pagina_admin
  ADD CONSTRAINT pagina_admin_ibfk_1 FOREIGN KEY (cod_menu_admin) REFERENCES menu_admin (id);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
