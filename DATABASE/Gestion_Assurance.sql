drop database if exists Assurance;
create database if not exists Assurance;
use Assurance;

create table utilisateur(
    iduser int(4) auto_increment primary key,
    login varchar(50),
    email varchar(255),
    role varchar(50),   -- admin ou visiteur
    etat int(1),        -- 1:activé 0:desactivé
    pwd varchar(255)
);

CREATE TABLE fournisseurs (
    id_fournisseur INT AUTO_INCREMENT PRIMARY KEY,
    ICE VARCHAR(20) NOT NULL,
    IF VARCHAR(20) NOT NULL,
    nom_fournisseur VARCHAR(100) NOT NULL,
    adresse TEXT NOT NULL,
    ville VARCHAR(50) NOT NULL
);
CREATE TABLE marches (
    id_marche INT AUTO_INCREMENT PRIMARY KEY,
    numero_marche VARCHAR(50) NOT NULL,
    objet TEXT NOT NULL,
    direction VARCHAR(100) NOT NULL,
    montant DECIMAL(15, 2) NOT NULL,
    devise VARCHAR(10) NOT NULL,
    annee YEAR NOT NULL,
    id_fournisseur INT,
    FOREIGN KEY (id_fournisseur) REFERENCES fournisseurs(id_fournisseur)
);
CREATE TABLE polices_assurance (
    id_police INT AUTO_INCREMENT PRIMARY KEY,
    numero_assurance VARCHAR(50) NOT NULL,
    libelle_assurance VARCHAR(100) NOT NULL,
    exige ENUM('Oui', 'Non') NOT NULL,
    statut ENUM('Expiré', 'Active') NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    id_marche INT,
    FOREIGN KEY (id_marche) REFERENCES marches(id_marche)
);
	
INSERT INTO utilisateur(login,email,role,etat,pwd) VALUES 
    ('Yassine','admin@gmail.com','ADMIN',1,md5('123')),
    ('Youness','user1@gmail.com','ADMIN',1,md5('123')),
    ('user2','user2@gmail.com','VISITEUR',1,md5('123'));	



select * from fournisseurs;
select * from marches;
select * from polices_assurance;
select * from utilisateur;


