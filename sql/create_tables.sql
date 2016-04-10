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
  tarkeys integer NOT NULL,
  luomispaiva DATE,
  status boolean DEFAULT FALSE,
  voimassaolopaiva DATE,
  kuvaus text 
);

CREATE TABLE Askare(
  id SERIAL PRIMARY KEY,
  kayttaja_id INTEGER REFERENCES Kayttaja(id),
  muistilista_id INTEGER REFERENCES Muistilista(id),
  nimi varchar(50) NOT NULL,
  tarkeys integer NOT NULL,
  lisayspaiva DATE,
  status boolean DEFAULT FALSE,
  voimassaolopaiva DATE,
  kuvaus text
);

