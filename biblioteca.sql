drop table livrousuario;
drop table livro;
drop table usuario;

create table usuario (
    nome varchar(50) not null, 
    email varchar(100) not null,
    senha varchar(2000) not null, 
    id int not null auto_increment, 
    primary key(id)
);

create table livro(
    autor varchar(150) not null,
    titulo varchar(25) not null,
    ano char(4) not null,
    editora varchar(40) not null,
    usuario integer,
    quantidade integer,
    id int not null auto_increment,
    foreign key (usuario) references usuario(id),
    primary key(id)
);

create table livrousuario(
    usuario int not null,
    livro int not null,
    id int not null auto_increment,
    foreign key (usuario) references usuario(id),
    foreign key (livro) references livro(id),
    primary key (id)
);

insert into usuario (nome, email, senha) values
("user 1", "user1@hotmail.com", "$2a$08$Cf1f11ePArKlBJomM0F6a.Th7agVGDcNAn8pTlLoKiaxHhkuoZNHu"),
("user 2", "user2@hotmail.com", "$2a$08$Cf1f11ePArKlBJomM0F6a.OgxgIN72hO19iFG7byq0I4qDWzoeEYG");

insert into livro (titulo, autor, ano, editora, quantidade) values
    ('Dom Casmurro', 'Machado de Assis', '1899', 'Livraria Garnier', 10),
    ('One Piece', 'Eiichiro Oda', '1997', 'Panini Comics', 2),
    ('Shingeki no Kyojin', 'Hajime Isayama, Ryo Suzukaze', '2009', 'Kodansha', 50),
    ('Bleach', 'Tite Kubo', '2001', 'Panini', 1);

    insert into livrousuario (usuario, livro) values
    (1, 1),
    (1, 2),
    (2, 3);