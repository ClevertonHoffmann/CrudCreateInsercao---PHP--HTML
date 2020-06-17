create database CrudCreate;

use CrudCreate;

create table Marca (
codigo int primary key auto_increment,
descricao varchar(100)  
);

insert into marca (descricao) 
values ("Ford"),("Honda"), ("Nissan"), ("BMW"), ("Mercedes");

create table Aluno (
codigo int primary key auto_increment,
nome varchar(100), 
email varchar(120), 
dataDeNascimento date, 
notaFinal double);

insert into Aluno (nome, email, dataDeNascimento, notaFinal) 
values("Pedro Almeida","pedro@gmail.com", "2001-12-20",10.0),
		("Fulano de Tal","fulano@hotmail.com" , "2000-12-20",8.0), 
		("Cassiano Matos","cassiano@outlook.com" , "2002-12-20",7.0), 
		("Jose Alves","jose@maq.com", "2003-01-20",6.0), 
		("Carlos Eduardo","carlos@gmail.com", "2001-08-20",8.5);


create table Produto(
codigo int primary key auto_increment, 
descricao varchar(150), 
dataDaCompra date, 
dataValidade date, 
valor double);

insert into Produto(descricao, dataDaCompra, dataValidade, valor)
values("Sabonete","2000-12-20", "2001-12-20",2.50),
		("Fubá","2000-01-20" , "2001-12-20",8.0), 
		("Vassoura","2000-05-20" , "2001-12-20",27.0), 
		("Trigo","2010-12-20", "2011-02-20",6.0), 
		("Banana","2020-03-20", "2020-04-20",3.5);


create table Pandemia(
codigo int primary key auto_increment, 
dataAnalise date, 
numeroDeContagios int, 
numerosDeCurados int, 
numeroDeObitos int);

insert into Pandemia(dataAnalise, numeroDeContagios, numerosDeCurados, numeroDeObitos)
values("2000-12-20", 2, 0, 1),
		 ("2001-02-20", 100, 10, 20),
	    ("2001-12-20", 4000, 500, 1000),
	  	 ("2000-12-20", 14000, 12000, 2000);

select * from marca;
select * from Aluno;
select * from Produto;
select * from Pandemia;

/*drop table marca;
drop table Aluno;
drop table Produto;
drop table Pandemia;
*/