CREATE TABLE `felhasznalok` (
  `Azonosito` int(11) NOT NULL,
  `Nev` varchar(128) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `Jelszo` varchar(128) NOT NULL,
  `Profilkep` varchar(128) NOT NULL,
  `Ertesites_hazi` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `felhasznalok` (`Azonosito`, `Nev`, `Email`, `Jelszo`, `Profilkep`, `Ertesites_hazi`) VALUES
(0, 'proba felhasznalo', '', 'f013da16aeecfe3bd3611a8a982959a3f91cffab', 'prof.jpg', '0');


CREATE TABLE `szavaz` (
  `Felhasznalo_azonosito` int(11) DEFAULT NULL,
  `Szavazas_azonosito` int(11) DEFAULT NULL,
  `Szavazat` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `szavaz` (`Felhasznalo_azonosito`, `Szavazas_azonosito`, `Szavazat`) VALUES
(0, 1, '5');


CREATE TABLE `szavazas` (
  `Azonosito` int(11) NOT NULL,
  `Kerdes` varchar(128) NOT NULL,
  `Tipus` varchar(128) NOT NULL,
  `Valaszlehetosegek` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `szavazas` (`Azonosito`, `Kerdes`, `Tipus`, `Valaszlehetosegek`) VALUES
(1, 'Hogy tetszett?', 'emoji', ''),
(2, 'Hogy tetszett 2', 'emoji', '');

ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`Azonosito`);

ALTER TABLE `szavaz`
  ADD KEY `Felhasznalo_azonosito` (`Felhasznalo_azonosito`),
  ADD KEY `Szavazas_azonosito` (`Szavazas_azonosito`);

ALTER TABLE `szavazas`
  ADD PRIMARY KEY (`Azonosito`);

ALTER TABLE `szavaz`
  ADD CONSTRAINT `szavaz_ibfk_1` FOREIGN KEY (`Felhasznalo_azonosito`) REFERENCES `felhasznalok` (`Azonosito`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `szavaz_ibfk_2` FOREIGN KEY (`Szavazas_azonosito`) REFERENCES `szavazas` (`Azonosito`) ON DELETE CASCADE ON UPDATE CASCADE;
