CREATE DATABASE IF NOT EXISTS opinionbox;

USE opinionbox;

CREATE TABLE `clients`(
    `id`int(11) auto_increment primary key,
    `name` varchar(255) not null,
    `cpf` varchar(255) not null
) ENGINE = InnoDB;

CREATE TABLE `address` (
	`id` int(11) auto_increment primary key,
	`number` varchar(255) not null,
	`address` varchar(255) not null,
	`neighborhood` varchar(255) not null,
	`city` varchar(255) not null,
	`state` varchar(100) not null,
	`client_id` int,
	 CONSTRAINT `client_id`
	FOREIGN KEY(client_id) REFERENCES clients(id)
) ENGINE = InnoDB;

CREATE TABLE `zipcodes` (
	`id` int(11) auto_increment primary key,
	`zipcode` varchar(255) not null,
	`address_id` int(11),
	FOREIGN KEY(address_id) REFERENCES address(id)
) ENGINE = InnoDB;


INSERT INTO clients (name, cpf) VALUES
('João da Silva', '111.111.111-11'),
('Maria Souza', '222.222.222-22'),
('Carlos Pereira', '333.333.333-33'),
('Ana Santos', '444.444.444-44'),
('Pedro Oliveira', '555.555.555-55'),
('Mariana Rodrigues', '666.666.666-66'),
('Lucas Almeida', '777.777.777-77'),
('Beatriz Costa', '888.888.888-88'),
('Rafael Ramos', '999.999.999-99'),
('Larissa Gomes', '000.000.000-00');

INSERT INTO address (number, address, neighborhood, city, state, client_id) VALUES
('123', 'Rua das Flores', 'Centro', 'São Paulo', 'SP', 1);


INSERT INTO zipcodes (zipcode, address_id) VALUES
('01000-000', 1),
('02000-000', 1);

INSERT INTO address (number, address, neighborhood, city, state, client_id) VALUES
('456', 'Avenida dos Sonhos', 'Jardins', 'Rio de Janeiro', 'RJ', 2);


INSERT INTO zipcodes (zipcode, address_id) VALUES
('20000-000', 2),
('21000-000', 2),
('22000-000', 2);