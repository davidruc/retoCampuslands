**David Andrés Rueda Chacón**// **SPUTNIK**

**RETO CAMPUSLANDS**

********

***1. Script de la base de datos:***

CREATE DATABASE campuslands;

USE campuslands;

CREATE TABLE pais ( idPais int, nombrePais varchar(50));

CREATE TABLE departamento (idDep int, nombreDep varchar(50), idPais int);

CREATE TABLE region (idReg int, nombreReg varchar(50), idDep int);		

CREATE TABLE campers (idCamper int, nombreCamper varchar(50), apellidoCamper varchar(50), fechaNac date, idReg int);

**definimos las llaves principales y las que serán foraneas**

ALTER TABLE campers ADD PRIMARY KEY (idCamper), ADD KEY idReg(idReg);

ALTER TABLE region ADD PRIMARY KEY (idReg), ADD KEY idDep(idDep);

ALTER TABLE departamento ADD PRIMARY KEY (idDep), ADD KEY idPais(idPais);

ALTER TABLE pais ADD PRIMARY KEY (idPais);

**realizamos la relación entre las llaves**

ALTER TABLE campers ADD CONSTRAINT idCamper FOREIGN KEY (idReg) REFERENCES region(idReg);

ALTER TABLE region ADD CONSTRAINT idReg FOREIGN KEY (idDep) REFERENCES departamento(idDep);

ALTER TABLE departamento ADD CONSTRAINT idDep FOREIGN KEY (idPais) REFERENCES pais(idPais);