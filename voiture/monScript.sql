
CREATE TABLE Marque(
   id_marque COUNTER,
   pays VARCHAR(255),
   nom VARCHAR(255),
   PRIMARY KEY(id_marque)
);

CREATE TABLE Couleur(
   id_couleur COUNTER,
   nom VARCHAR(255),
   PRIMARY KEY(id_couleur)
);

CREATE TABLE Motorisation(
   id_motorisation COUNTER,
   type VARCHAR(255),
   PRIMARY KEY(id_motorisation)
);

CREATE TABLE Voiture(
   id_voiture COUNTER,
   plaque VARCHAR(50),
   nb_porte INT,
   model VARCHAR(255),
   id_motorisation INT NOT NULL,
   id_marque INT NOT NULL,
   PRIMARY KEY(id_voiture),
   UNIQUE(id_marque),
   FOREIGN KEY(id_motorisation) REFERENCES Motorisation(id_motorisation),
   FOREIGN KEY(id_marque) REFERENCES Marque(id_marque)
);

CREATE TABLE habiller(
   id_voiture INT,
   id_couleur INT,
   PRIMARY KEY(id_voiture, id_couleur),
   FOREIGN KEY(id_voiture) REFERENCES Voiture(id_voiture),
   FOREIGN KEY(id_couleur) REFERENCES Couleur(id_couleur)
);
