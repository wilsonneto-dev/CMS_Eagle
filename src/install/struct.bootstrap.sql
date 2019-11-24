CREATE TABLE admin (
  id int(11) NOT NULL,
  ativo tinyint(1) DEFAULT '1',
  datacadastro timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  codprojeto int(11) DEFAULT 1,
  nome varchar(400) DEFAULT NULL,
  email varchar(400) DEFAULT NULL,
  senha varchar(400) DEFAULT NULL,
  ultimo_acesso timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  ip varchar(100) DEFAULT NULL,
  bloqueado int(1) DEFAULT '0',
  imagem varchar(400) DEFAULT NULL,
  cod_grupo_admin int(11) DEFAULT NULL,
  token varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE projeto_workspace (
  id int(11) NOT NULL,
  nome varchar(500) DEFAULT NULL,
  ativo int(1) DEFAULT '1',
  cadastrado datetime DEFAULT CURRENT_TIMESTAMP,
  atualizado datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  cod_admin int(11) DEFAULT NULL,
  hash varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE admin_projeto_workspace (
  id int(11) NOT NULL,
  cod_admin int(11) NOT NULL,
  cod_projeto_workspace int(11) NOT NULL,
  cadastrado datetime DEFAULT CURRENT_TIMESTAMP,
  atualizado datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE grupo_admin (
  id int(11) NOT NULL,
  ativo tinyint(1) DEFAULT '1',
  datacadastro timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  codprojeto int(11) DEFAULT 1,
  nome varchar(200) DEFAULT NULL,
  descricao varchar(200) DEFAULT NULL,
  cod_pagina_admin int(11) DEFAULT NULL,
  hierarquia int(11) DEFAULT '10',
  padrao int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE grupo_pagina_admin (
  id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  cod_grupo_admin int(11) DEFAULT NULL,
  cod_pagina_admin int(11) DEFAULT NULL,
  escrita int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE log_geral (
  id int(11) NOT NULL,
  datacadastro timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  codprojeto int(11) DEFAULT '1',
  ip varchar(100) DEFAULT NULL,
  pagina varchar(200) DEFAULT NULL,
  texto varchar(2000) DEFAULT NULL,
  tipo varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE menu_admin (
  id int(11) NOT NULL,
  ativo tinyint(1) DEFAULT '1',
  datacadastro timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  codprojeto int(11) DEFAULT 1,
  icone varchar(400) DEFAULT NULL,
  texto varchar(400) DEFAULT NULL,
  ordem int(11) DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE notificacao_tipo (
  id int(11) NOT NULL,
  nome varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE notificacao_visualizacao (
  id int(11) NOT NULL,
  codprojeto int(11) DEFAULT '1',
  cod_admin int(11) DEFAULT NULL,
  cod_notificacao_tipo int(11) DEFAULT NULL,
  data timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE pagina_admin (
  id int(11) NOT NULL,
  ativo tinyint(1) DEFAULT '1',
  datacadastro timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  codprojeto int(11) DEFAULT 1,
  descricao varchar(400) DEFAULT NULL,
  posicao int(11) DEFAULT '100',
  url varchar(500) DEFAULT NULL,
  target varchar(200) DEFAULT NULL,
  cod_menu_admin int(11) DEFAULT NULL,
  bloqueado int(1) DEFAULT '0',
  permissao varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE admin
  ADD PRIMARY KEY (id),
  ADD KEY cod_grupo_admin (cod_grupo_admin);
ALTER TABLE admin_projeto_workspace
  ADD PRIMARY KEY (id);

ALTER TABLE grupo_admin
  ADD PRIMARY KEY (id),
  ADD KEY cod_pagina_admin (cod_pagina_admin);

ALTER TABLE grupo_pagina_admin
  ADD KEY fk_grupo (cod_grupo_admin),
  ADD KEY fk_pagina (cod_pagina_admin);

ALTER TABLE log_admin
  ADD PRIMARY KEY (id),
  ADD KEY cod_admin (cod_admin);

ALTER TABLE log_geral
  ADD PRIMARY KEY (id);

ALTER TABLE menu_admin
  ADD PRIMARY KEY (id);

ALTER TABLE notificacao
  ADD PRIMARY KEY (id),
  ADD KEY cod_notificacao_tipo (cod_notificacao_tipo);

ALTER TABLE notificacao_tipo
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY id (id);

ALTER TABLE notificacao_visualizacao
  ADD PRIMARY KEY (id),
  ADD KEY cod_notificacao_tipo (cod_notificacao_tipo),
  ADD KEY cod_admin_fk_idx (cod_admin);
ALTER TABLE pagina_admin
  ADD PRIMARY KEY (id),
  ADD KEY cod_menu_admin (cod_menu_admin);

ALTER TABLE projeto_workspace
  ADD PRIMARY KEY (id);

ALTER TABLE admin
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE admin_projeto_workspace
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE grupo_admin
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE log_admin
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE log_geral
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE menu_admin
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE notificacao
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE notificacao_tipo
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE notificacao_visualizacao
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE pagina_admin
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE projeto_workspace
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE admin
  ADD CONSTRAINT admin_ibfk_1 FOREIGN KEY (cod_grupo_admin) REFERENCES grupo_admin (id);

ALTER TABLE grupo_admin
  ADD CONSTRAINT grupo_admin_ibfk_1 FOREIGN KEY (cod_pagina_admin) REFERENCES pagina_admin (id);

ALTER TABLE pagina_admin
  ADD CONSTRAINT pagina_admin_ibfk_1 FOREIGN KEY (cod_menu_admin) REFERENCES menu_admin (id);
COMMIT;