-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Raakaaine(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
kcalPer100 INTEGER NOT NULL,
proteiiniPer100 float NOT NULL,
hiilihydraatitPer100 float NOT NULL,
rasvaPer100 float NOT NULL
);

CREATE TABLE Eines(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
kcal INTEGER NOT NULL,
proteiini float NOT NULL,
hiilihydraatit float NOT NULL,
rasva float NOT NULL
);

CREATE TABLE Annos(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
kcalPer100 INTEGER NOT NULL,
proteiiniPer100 float NOT NULL,
hiilihydraatitPer100 float NOT NULL,
rasvaPer100 float NOT NULL
raakaaine_id INTEGER REFERENCES Raakaaine(id)
);

CREATE TABLE Paivanravinto(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
kcal INTEGER NOT NULL,
proteiini float NOT NULL,
hiilihydraatit float NOT NULL,
rasva float NOT NULL
annos_id INTEGER REFERENCES Annos(id),
eines_id INTEGER REFERENCES Eines(id),
);