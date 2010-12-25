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
	oraInizio TIME NOT NULL,
	oraFine TIME NOT NULL,
	partenza INTEGER NOT NULL,
	arrivo INTEGER NOT NULL,
	codiceTurno INTEGER NOT NULL,

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

ALTER TABLE Percorsi ADD CONSTRAINT Percorsi_fk3
	  FOREIGN KEY (codiceTurno) REFERENCES Turni(codiceTurno);


CREATE TABLE TURNO_PERCORSO
(
	codiceTurno INTEGER NOT NULL,
	codicePercorso INTEGER NOT NULL,
	
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