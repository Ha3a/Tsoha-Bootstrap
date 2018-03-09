-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Raakaaine (nimi, kcalPer100, proteiiniPer100, hiilihydraatitPer100, rasvaPer100) VALUES ('Kananmuna', '155', '13', '1.1', '11');
INSERT INTO Annos (nimi) VALUES ('Kanamuna');
INSERT INTO Annosraakaaine (annos_id, raakaaine_id, maara) VALUES ('1', '1', '75');
INSERT INTO Kayttaja (nimi, salasana, admin) VALUES ('admin', '1234', true);
INSERT INTO Ruokailut (annos_id, kayttaja_id) VALUES ('1', '1');