-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Raakaaine(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
kcalPer100 INTEGER NOT NULL,
proteiiniPer100 double NOT NULL,
hiilihydraatitPer100 double NOT NULL,
rasvaPer100 double NOT NULL
);

CREATE TABLE Eines(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
kcal INTEGER NOT NULL,
proteiini double NOT NULL,
hiilihydraatit double NOT NULL,
rasva double NOT NULL
);

CREATE TABLE Annos(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
kcalPer100 INTEGER NOT NULL,
proteiiniPer100 double NOT NULL,
hiilihydraatitPer100 double NOT NULL,
rasvaPer100 double NOT NULL
raakaaine_id INTEGER REFERENCES Raakaaine(id)
);

CREATE TABLE Paivanravinto(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
kcal INTEGER NOT NULL,
proteiini double NOT NULL,
hiilihydraatit double NOT NULL,
rasva double NOT NULL
annos_id INTEGER REFERENCES Annos(id),
eines_id INTEGER REFERENCES Eines(id),
);