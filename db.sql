CREATE DATABASE sop2011;

GRANT CREATE, DROP, SELECT, UPDATE, INSERT, DELETE, ALTER
	ON sop2011.*
	TO 'sop2011_admin'@'localhost'
	IDENTIFIED BY 'z0m1x9n2';

CREATE TABLE Ruoli
(
	codiceRuolo INTEGER AUTO_INCREMENT PRIMARY KEY,
	tipo VARCHAR(50) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE Credenziali
(
	nomeUtente VARCHAR(50) PRIMARY KEY,
	password VARCHAR(40) NOT NULL,
	ruolo INTEGER NOT NULL,
	
	CONSTRAINT Credenziali_fk1 FOREIGN KEY (ruolo) REFERENCES Ruoli(codiceRuolo)
) ENGINE = InnoDB;
	
CREATE TABLE Squadre
(
	codiceSquadra INTEGER AUTO_INCREMENT PRIMARY KEY,
	nomeSquadra VARCHAR(50) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE Sorveglianti
(
	matricola INTEGER AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(50) NOT NULL,
	cognome VARCHAR(50) NOT NULL,
	password VARCHAR(40) NOT NULL,
	codiceSquadra INTEGER DEFAULT 1,
	CONSTRAINT Sorveglianti_fk1
	  FOREIGN KEY (codiceSquadra) REFERENCES Squadre(codiceSquadra)
) ENGINE = InnoDB;

CREATE TABLE Clienti
(
	codiceCliente INTEGER AUTO_INCREMENT PRIMARY KEY,
	nomeCliente VARCHAR(50) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE PuntiDiControllo
(
	codicePC INTEGER AUTO_INCREMENT PRIMARY KEY,
	indirizzo VARCHAR(100) NOT NULL,
	latitudine DOUBLE NOT NULL,
	longitudine DOUBLE NOT NULL,
	idTag INTEGER NOT NULL,
	codiceCliente INTEGER NOT NULL,

	CONSTRAINT PC_fk1
	  FOREIGN KEY (codiceCliente) REFERENCES Clienti(codiceCliente)
) ENGINE = InnoDB;


CREATE TABLE Percorsi
(
	codicePercorso INTEGER AUTO_INCREMENT PRIMARY KEY,
	partenza INTEGER NOT NULL,
	arrivo INTEGER NOT NULL,

	CONSTRAINT Percorsi_fk1
	  FOREIGN KEY (partenza) REFERENCES PuntiDiControllo(codicePC),

	CONSTRAINT Percorsi_fk2
	  FOREIGN KEY (arrivo) REFERENCES PuntiDiControllo(codicePC)

) ENGINE = InnoDB;

CREATE TABLE Turni
(
	codiceTurno INTEGER AUTO_INCREMENT PRIMARY KEY,
	codiceSquadra INTEGER NOT NULL,
	codicePercorso INTEGER NOT NULL,
	
	CONSTRAINT Turni_fk1 FOREIGN KEY (codiceSquadra) REFERENCES Squadre(codiceSquadra),
	  
	CONSTRAINT Turni_fk2  FOREIGN KEY (codicePercorso) REFERENCES Percorsi(codicePercorso)
) ENGINE = InnoDB;


CREATE TABLE TURNO_PERCORSO
(
	codiceTurno INTEGER NOT NULL,
	codicePercorso INTEGER NOT NULL,
	CONSTRAINT TP_pk1
		PRIMARY KEY(codiceTurno,codicePercorso);
	CONSTRAINT TP_fk1
	  FOREIGN KEY (codiceTurno) REFERENCES Turni(codiceTurno),
	  
	CONSTRAINT TP_fk2
	  FOREIGN KEY (codicePercorso) REFERENCES Percorsi(codicePercorso)
) ENGINE = InnoDB;

CREATE TABLE PERCORSO_PDC
(
	codicePercorso INTEGER NOT NULL,
	codicePC INTEGER NOT NULL,
	
	CONSTRAINT PPDC_fk1
	  FOREIGN KEY (codicePercorso) REFERENCES Percorsi(codicePercorso),
	  
	CONSTRAINT PPDC_fk2
	  FOREIGN KEY (codicePC) REFERENCES PuntiDiControllo(codicePC)
) ENGINE = InnoDB;

INSERT INTO Ruoli(tipo) VALUES('ASC');
INSERT INTO Ruoli(tipo) VALUES('ATS');
INSERT INTO Ruoli(tipo) VALUES('Sorvegliante');
	
INSERT INTO Squadre(nomeSquadra) VALUES('default');
INSERT INTO Squadre(nomeSquadra) VALUES('alfa');
INSERT INTO Squadre(nomeSquadra) VALUES('bravo');

INSERT INTO Sorveglianti(nome, cognome, password, codiceSquadra) VALUES('Giustino', 'Borzacchiello', SHA1('ciccio'),1);
INSERT INTO Sorveglianti(nome, cognome, password, codiceSquadra) VALUES('Gennaro', 'Alfano', SHA1('ciccio'),1);
INSERT INTO Sorveglianti(nome, cognome, password, codiceSquadra) VALUES('Francesco Paolo', 'Cimmino', SHA1('ciccio'),1);

INSERT INTO Clienti(nomeCliente) VALUES('auchan');
INSERT INTO Clienti(nomeCliente) VALUES('expert');
INSERT INTO Clienti(nomeCliente) VALUES('eldo');

INSERT INTO PuntiDiControllo(indirizzo, latitudine, longitudine, idTag, codiceCliente) VALUES('via Roma 3 Sant\'Antimo Napoli', 40.939137, 14.236021, 1, 1);
INSERT INTO PuntiDiControllo(indirizzo, latitudine, longitudine, idTag, codiceCliente) VALUES('Via Germania 18 Sant\'Antimo Napoli', 40.940310, 14.239848, 1, 1);
INSERT INTO PuntiDiControllo(indirizzo, latitudine, longitudine, idTag, codiceCliente) VALUES('Via Trieste e Trento 5 Sant\'Antimo Napoli', 40.943054, 14.236385, 1, 1);
INSERT INTO PuntiDiControllo(indirizzo, latitudine, longitudine, idTag, codiceCliente) VALUES('Via Polonia 10 Sant\'Antimo Napoli', 40.935598, 14.239135, 1, 1);
INSERT INTO PuntiDiControllo(indirizzo, latitudine, longitudine, idTag, codiceCliente) VALUES('Via Crucis 20 Sant\'Antimo Napoli', 40.943301, 14.232781, 1, 1);
INSERT INTO PuntiDiControllo(indirizzo, latitudine, longitudine, idTag, codiceCliente) VALUES('Via lava 5 Sant\'Antimo Napoli', 40.943952, 14.238581, 1, 1);
INSERT INTO PuntiDiControllo(indirizzo, latitudine, longitudine, idTag, codiceCliente) VALUES('Via Trieste e Trento 54 Sant\'Antimo Napoli', 40.943126, 14.235665, 1, 1);
INSERT INTO PuntiDiControllo(indirizzo, latitudine, longitudine, idTag, codiceCliente) VALUES('seconda traversa coste di agnano 21, pozzuoli NA', 40.830276, 14.135016, 1, 1);