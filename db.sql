CREATE DATABASE sop2011;

GRANT CREATE, DROP, SELECT, UPDATE, INSERT, DELETE
	ON sop2011.*
	TO 'sop2011_admin'@'localhost'
	IDENTIFIED BY 'z0m1x9n2';
	
	
CREATE TABLE Sorveglianti
(
	matricola INTEGER AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(50) NOT NULL,
	cognome VARCHAR(50) NOT NULL,
	password VARCHAR(40) NOT NULL
) ENGINE = InnoDB;


INSERT INTO Sorveglianti(nome, cognome, password) VALUES('Giustino', 'Borzacchiello', SHA1('ciccio'));
INSERT INTO Sorveglianti(nome, cognome, password) VALUES('Gennaro', 'Alfano', SHA1('ciccio'));
INSERT INTO Sorveglianti(nome, cognome, password) VALUES('Francesco Paolo', 'Cimmino', SHA1('ciccio'));