create database controleDeEstoque;

use controleDeEstoque;

create table usuario(
id_user int AUTO_INCREMENT PRIMARY KEY,
name varchar(80) not null,
cpf varchar(11) not null unique,
endereco varchar(100) not null,
usuario varchar(20) not null unique,
senha varchar(20) not null,
telefone varchar(11) not null,
status BIT DEFAULT 1)

create table produto(
id_produto int AUTO_INCREMENT PRIMARY KEY,
produto varchar(70) not null,
marca varchar(50) not null,
tamanho varchar (20) not null,
cor varchar(25) not null,
quantidade int not null,
tipo varchar(25) not null,
foto varchar(50),
data_saida date,
data_entrada date,
estoque varchar(20),
descricao varchar(100),
status bit DEFAULT 1)

create table emprestimo(
id_emprestimo int AUTO_INCREMENT PRIMARY KEY,
id_produto int,
id_user int,
responsavel varchar(70),
data_saida_emprestimo date,
data_volta_emprestimo date,
descricao varchar(100),
telefone_resp int not null,
status bit DEFAULT 1)

insert into usuario(id_user, name, cpf, endereco, usuario, senha, telefone)
 values (NULL , 'Caique', 10750157909, 'Rua João do Canto e Melo 182', 'caiquems', '1234', 11949531875);

insert into usuario(id_user, name, cpf, endereco, usuario, senha, telefone)
 values (NULL , 'Thayssa', 53285850892, 'Rua João do Canto e Melo 182', 'thayssa', '1234', 11958578944);


/*SELECT * FROM usuario      =>>aqui vai aparecer tudo o que estiver na tabela selecionada*/
 /*SELECT * FROM usuario WHERE status=1     =>>aqui vc vai limitar o que vai ser mostrado*/

