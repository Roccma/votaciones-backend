CREATE TABLE perfil(
	id INT(11) AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(255) NOT NULL,
	apellido VARCHAR(255) NOT NULL,
	direccion VARCHAR(255) NOT NULL,
	telefono VARCHAR(255) NOT NULL,
	dob DATE NOT NULL,
	sexo CHAR NOT NULL
);

CREATE TABLE entidad(
	id INT(11) AUTO_INCREMENT PRIMARY KEY,
	documento VARCHAR(255) UNIQUE NOT NULL,
	es_postulante BOOLEAN NOT NULL,
	id_perfil INT(11) NULL
);

ALTER TABLE entidad
ADD CONSTRAINT fk_entidad_perfil FOREIGN KEY (id_perfil) REFERENCES perfil(id);

CREATE TABLE usuario(
	id INT(11) AUTO_INCREMENT PRIMARY KEY,
	documento VARCHAR(255) UNIQUE NOT NULL,
	clave VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	id_perfil INT(11) NULL
);

ALTER TABLE usuario
ADD CONSTRAINT fk_usuario_perfil FOREIGN KEY (id_perfil) REFERENCES perfil(id);

CREATE TABLE voto(
	id INT(11) AUTO_INCREMENT PRIMARY KEY,
	id_entidad_postulante INT(11) NOT NULL,
	id_entidad_votante INT(11) NOT NULL,
	fecha DATE NOT NULL
);

ALTER TABLE voto
ADD CONSTRAINT fk_voto_postulante FOREIGN KEY (id_entidad_postulante) REFERENCES entidad(id);

ALTER TABLE voto
ADD CONSTRAINT fk_voto_votante FOREIGN KEY (id_entidad_votante) REFERENCES entidad(id);

INSERT INTO perfil (nombre, apellido, direccion, telefono, dob, sexo) VALUES ('Lucas', 'Varela', 'Daniel Muñoz 1575', '092456876', '1990-10-05', 'm');
INSERT INTO perfil (nombre, apellido, direccion, telefono, dob, sexo) VALUES ('Aldana', 'Rodríguez', 'Paysandú 1913', '099451893', '1994-01-28', 'f');
INSERT INTO perfil (nombre, apellido, direccion, telefono, dob, sexo) VALUES ('Romina', 'Marr', 'Avenida 18 de Julio 3578', '095854309', '1991-11-10', 'f');
INSERT INTO perfil (nombre, apellido, direccion, telefono, dob, sexo) VALUES ('Matías', 'Tessadri', 'Purificación 1330', '098761432', '1986-12-01', 'm');
INSERT INTO perfil (nombre, apellido, direccion, telefono, dob, sexo) VALUES ('Juan', 'Macchi', 'Avenida Italia 3789', '099785432', '1995-08-28', 'm');
INSERT INTO perfil (nombre, apellido, direccion, telefono, dob, sexo) VALUES ('Tamara', 'Martínez', 'Nueva York 1510', '092769009', '1998-02-02', 'f');
INSERT INTO perfil (nombre, apellido, direccion, telefono, dob, sexo) VALUES ('Mauricio', 'Bautista', 'Avenida 18 de Julio 1515', '098886734', '1989-07-01', 'm');
INSERT INTO perfil (nombre, apellido, direccion, telefono, dob, sexo) VALUES ('Fabricio', 'Meza', 'Defensa 5067', '095786213', '1990-09-07', 'm');
INSERT INTO perfil (nombre, apellido, direccion, telefono, dob, sexo) VALUES ('María', 'Simon', 'Avenida 8 de Octubre 1430', '096789234', '1991-04-03', 'f');
INSERT INTO perfil (nombre, apellido, direccion, telefono, dob, sexo) VALUES ('Florencia', 'Perez', 'Cerro Largo 2030', '091557389', '1992-02-18', 'f');

INSERT INTO perfil (nombre, apellido, direccion, telefono, dob, sexo) VALUES ('Mauro', 'Rocca', 'Miguelete 1470', '091090921', '1995-08-15', 'm');

INSERT INTO entidad (documento, es_postulante, id_perfil) VALUES ('50345698', FALSE, 1);
INSERT INTO entidad (documento, es_postulante, id_perfil) VALUES ('46781890', FALSE, 2);
INSERT INTO entidad (documento, es_postulante, id_perfil) VALUES ('56784180', FALSE, 3);
INSERT INTO entidad (documento, es_postulante, id_perfil) VALUES ('42567891', FALSE, 4);
INSERT INTO entidad (documento, es_postulante, id_perfil) VALUES ('40982345', TRUE, 5);
INSERT INTO entidad (documento, es_postulante, id_perfil) VALUES ('48679801', TRUE, 6);
INSERT INTO entidad (documento, es_postulante, id_perfil) VALUES ('43456129', FALSE, 7);
INSERT INTO entidad (documento, es_postulante, id_perfil) VALUES ('50128976', FALSE, 8);
INSERT INTO entidad (documento, es_postulante, id_perfil) VALUES ('41237891', FALSE, 9);
INSERT INTO entidad (documento, es_postulante, id_perfil) VALUES ('48934573', FALSE, 10);

INSERT INTO usuario (documento, clave, email, id_perfil) VALUES ('48704743', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'mauroroccaf@gmail.com', 11);

