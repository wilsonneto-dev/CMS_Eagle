create table lista
(

	id int primary key auto_increment,
	titulo varchar(350),
	descricao varchar(500),

	ativo int(1) default 1,
	cadastrado datetime default current_timestamp,
	atualizado datetime on update current_timestamp

);


create table campanha
(

	id int primary key auto_increment,
	titulo varchar(350),
	descricao varchar(500),
	investimento int,
	source varchar(500),

	ativo int(1) default 1,
	cadastrado datetime default current_timestamp,
	atualizado datetime on update current_timestamp

);

create table lead
(

    id int primary key auto_increment,
    cod_lista int,
    cod_campanha int,
        
    nome varchar(350),
    sobrenome varchar(350),
    email varchar(350),
    ocupacao varchar(350),
    empresa varchar(350),
    telefone varchar(350),

    ativo int(1) default 1,
    cadastrado datetime default current_timestamp,
    atualizado datetime on update current_timestamp

);

create table landing_page
(
	
	id int primary key auto_increment,
	url varchar(500),
	
	label varchar(250),

	cod_lista int,
	
	imagem_topo varchar(250),
	imagem_quadrada varchar(250),
	imagem_thumb varchar(250),

	resumo varchar(500),
	texto varchar(2000),
	texto_agradecimento varchar(2000),

	arquivo varchar(350),
	tipo varchar(250),
	layout varchar(250),

	ativo int(1) default 1,
	cadastrado datetime default current_timestamp,
	atualizado datetime on update current_timestamp

);


create table blog_autor
(
	
	id int primary key auto_increment,
	url varchar(500),
	
	nome varchar(500),
	introducao varchar(1000),
	texto varchar(10000),

	link varchar(500),
	imagem varchar(500),
	thumb varchar(500),

	ativo int(1) default 1,
	cadastrado datetime default current_timestamp,
	atualizado datetime on update current_timestamp

);

create table blog_artigo
(
	
	id int primary key auto_increment,
	url varchar(500),
	
	cod_autor int,

	data datetime,

	titulo varchar(500),
	introducao varchar(1000),
	texto varchar(10000),

	video varchar(500),
	imagem varchar(500),
	thumb varchar(500),

	header_titlulo varchar(300),
	header_descricao varchar(300),
	header_keywords varchar(300),

	ativo int(1) default 1,
	cadastrado datetime default current_timestamp,
	atualizado datetime on update current_timestamp

);


create table blog_tag
(
	
	id int primary key auto_increment,
	url varchar(500),
	
	titulo varchar(500),
	texto varchar(10000),

	ativo int(1) default 1,
	cadastrado datetime default current_timestamp,
	atualizado datetime on update current_timestamp

);
