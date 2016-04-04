CREATE TABLE Kayttaja(
  id SERIAL PRIMARY KEY,
  ktunnus varchar(50) NOT NULL,
  nimi varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Muistilista(
  id SERIAL PRIMARY KEY,
  kayttaja_id INTEGER REFERENCES Kayttaja(id),
  nimi varchar(50) NOT NULL,
  tarkeys INTEGER NOT NULL,
  luomispaiva TIMESTAMP,
  status BOOLEAN DEFAULT FALSE,
  voimassaolopaiva DATE,
  kuvaus varchar (500), 
);

CREATE TABLE Askar(
  id SERIAL PRIMARY KEY,
  kayttaja_id INTEGER REFERENCES Kayttaja(id),
  muistilista_id INTEGER REFERENCES Muistilista(id),
  nimi varchar(50) NOT NULL,
  tarkeys INTEGER NOT NULL,
  lisayspaiva TIMESTAMP,
  status BOOLEAN DEFAULT FALSE,
  voimassaolopaiva DATE,
  kuvaus varchar (500),
);

