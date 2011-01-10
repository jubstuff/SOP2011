CREATE DATABASE PercorsiKML2011;

GRANT CREATE, DROP, SELECT, UPDATE, INSERT, DELETE, ALTER
	ON PercorsiKML2011.*
	TO 'Pkml2011_admin'@'localhost'
	IDENTIFIED BY 'z0m1x9n2';
	
CREATE TABLE Percorsi_SOP2011 (
 idPercorso INTEGER NOT NULL,
 idPDC INTEGER NOT NULL,
 indirizzoPDC VARCHAR(255) NOT NULL,
 latPDC VARCHAR(255) NOT NULL,
 longPDC VARCHAR(255) NOT NULL
) ENGINE = InnoDB ;

ALTER TABLE Percorsi_SOP2011
ADD CONSTRAINT PSOP_PK
PRIMARY KEY (idPercorso, idPDC);


INSERT INTO Percorsi_SOP2011 (idPercorso, idPDC, indirizzoPDC, latPDC, longPDC)
    VALUES (1, 1, 'via umbria napoli', '40.89354', '14.258068');

INSERT INTO Percorsi_SOP2011 (idPercorso, idPDC, indirizzoPDC, latPDC, longPDC)
    VALUES (1, 2, 'via toledo napoli', '40.845509', '14.249201');

INSERT INTO Percorsi_SOP2011 (idPercorso, idPDC, indirizzoPDC, latPDC, longPDC)
    VALUES (1, 3, 'via acton napoli', '40.83649', '14.252279');

INSERT INTO Percorsi_SOP2011 (idPercorso, idPDC, indirizzoPDC, latPDC, longPDC)
    VALUES (2, 1, 'via abate gioacchino napoli', '40.890178', '14.259376');

INSERT INTO Percorsi_SOP2011 (idPercorso, idPDC, indirizzoPDC, latPDC, longPDC)
    VALUES (2, 2, 'via alfonso ruta napoli', '40.890678', '14.25689');
