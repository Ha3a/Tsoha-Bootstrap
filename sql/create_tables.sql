-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Raakaaine(
id SERIAL PRIMARY KEY,
nimi varchar(53) NOT NULL,
kcalPer100 INTEGER NOT NULL,
proteiiniPer100 float NOT NULL,
hiilihydraatitPer100 float NOT NULL,
rasvaPer100 float NOT NULL
);



CREATE TABLE Annos(
id SERIAL PRIMARY KEY,
nimi varchar(55) NOT NULL
);

CREATE TABLE Paivanravinto(
id SERIAL PRIMARY KEY,
annos_id INTEGER REFERENCES Annos(id),
nimi varchar(56) NOT NULL,
kcal INTEGER NOT NULL,
proteiini float NOT NULL,
hiilihydraatit float NOT NULL,
rasva float NOT NULL
);

CREATE TABLE Kayttaja (
    id SERIAL PRIMARY KEY,
    nimi varchar(20) NOT NULL,
    salasana varchar(20) NOT NULL,
    admin boolean default false
);

CREATE TABLE Annosraakaaine (
    annos_id integer,
    raakaaine_id integer,
    maara integer,
    FOREIGN KEY (annos_id) REFERENCES Annos(id),
    FOREIGN KEY (raakaaine_id) REFERENCES RaakaAine(id)
);
