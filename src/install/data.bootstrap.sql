INSERT INTO menu_admin(id, icone, texto, ordem) VALUES
(1, 'fa-bar-chart-o', 'Análises', 10),
(2, 'fa-edit', 'Site', 20),
(3, 'fa-th', 'Dados', 30),
(4, 'fa-folder', 'Promoters', 40),
(5, 'fa-laptop', 'Configurações', 70),
(6, ' fa-file-text', 'Relatórios', 50),
(7, 'fa-users', 'Administradores', 80),
(8, 'fa-list', 'Audiência', 20),
(9, 'fa-file-text-o', 'Páginas', 50),
(10, 'fa-shopping-cart', 'e-Commerce', 10),
(11, 'fa-file-text-o', 'Blog/Conteúdo', 10);

INSERT INTO pagina_admin (id, `descricao`, `posicao`, `url`, `target`, `cod_menu_admin`, `bloqueado`, `permissao`) VALUES
(1, 'Usuários', 1, 'crud/admin', NULL, 7, 0, 'admin'),
(2, 'Grupos', 2, 'crud/grupo_admin', NULL, 7, 0, 'grupo_admin'),
(3, 'Páginas', 3, 'crud/pagina_admin', NULL, 7, 0, 'pagina_admin'),
(4, 'Menu', 4, 'crud/menu_admin', NULL, 7, 0, 'menu_admin'),
(5, 'Grupos -> Páginas', 5, 'crud/grupo_pagina_admin', NULL, 7, 0, 'grupo_pagina_admin'),
(6, 'Blank', 5, 'blank', NULL, 1, 0, 'blank'),
(7, 'Workspaces', 6, 'crud/projeto_workspace', NULL, 7, 0, 'projeto_workspace');

INSERT INTO grupo_admin (id, nome, descricao, cod_pagina_admin, hierarquia, padrao) VALUES
(1, 'Root', 'Root', 6, 1, 0),
(2, 'Administrador', 'Root', 6, 2, 1);

INSERT INTO grupo_pagina_admin (cod_grupo_admin, cod_pagina_admin, escrita) VALUES 
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(1, 4, 1),
(1, 5, 1),
(1, 6, 1),
(1, 7, 1);

INSERT INTO admin ( nome, email, senha, ip, bloqueado, imagem, cod_grupo_admin, token) VALUES
('{{root_user_name}}', '{{root_user}}', MD5('{{root_pass}}'), NULL, 0, NULL, 1, '0d29c8d7eff97d2');

INSERT INTO `projeto_workspace` (`id`, `nome`, `cod_admin`, `hash`) VALUES
(1, 'Workspace', 1, '3b655a738065fdfe8c197a325afbece8');

INSERT INTO admin_projeto_workspace ( id, cod_admin, cod_projeto_workspace ) VALUES
( 1, 1, 1 );

