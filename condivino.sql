-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mag 23, 2017 alle 17:24
-- Versione del server: 5.6.24
-- PHP	 Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Database: `condivino`
--

DROP DATABASE IF EXISTS condivinoauto; 
CREATE DATABASE IF NOT EXISTS `condivinoauto`;
use `condivinoauto`;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE IF NOT EXISTS `utente` (
  `username`             varchar(20)       NOT NULL,
  `password`             varchar(20)   DEFAULT NULL,
  `nome`                 varchar(40)   DEFAULT NULL,
  `cognome`              varchar(40)   DEFAULT NULL,
  `via`                  varchar(100)  DEFAULT NULL,
  `CAP`                  varchar(5)    DEFAULT NULL,
  `citta`                varchar(20)   DEFAULT NULL,
  `email`                varchar(80)   DEFAULT NULL,
  `sesso`                varchar(1)    DEFAULT NULL,
  `data_nascita`         datetime      DEFAULT NULL,
  `codice_fiscale`       varchar(16)   DEFAULT NULL,
  `telefono`             varchar(35)   DEFAULT NULL,
  `codice_attivazione`   varchar(20)   DEFAULT NULL,
  `stato`                enum('non_attivo','attivo')  DEFAULT NULL,
  PRIMARY KEY       (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `vino`
--

CREATE TABLE IF NOT EXISTS `vino` (
  `vinoID`               int(13)           NOT NULL,
  `nome`                 varchar(20)       NOT NULL,
  `produttore`           varchar(50)   DEFAULT NULL,
  `denominazione`        varchar(50)   DEFAULT NULL,
  `paese`                varchar(50)   DEFAULT NULL,
  `regione`              varchar(50)   DEFAULT NULL,
  `descrizione`          varchar(500)  DEFAULT NULL,
  `vitigno`              varchar(20)   DEFAULT NULL,
  `annata`               int(4)        DEFAULT NULL,
  `grado`                float         DEFAULT NULL,
  `volume`               float         DEFAULT NULL,
  `colore`               varchar(10)   DEFAULT NULL,
  `noteSensoriali`       varchar(200)  DEFAULT NULL,
  `temperaturaServizio`  int(2)        DEFAULT NULL,
  `prezzo`               float         DEFAULT NULL,
  `etichetta`            varchar(100)  DEFAULT NULL,
  PRIMARY KEY       (`vinoID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1, AUTO_INCREMENT=5;
  
-- --------------------------------------------------------

--
-- Struttura della tabella `pagamento`
--

CREATE TABLE IF NOT EXISTS `pagamento` (
  `numero_pagamento`     varchar(16)       NOT NULL,
  `nome_titolare`        varchar(40)   DEFAULT NULL,
  `cognome_titolare`     varchar(40)   DEFAULT NULL,
  `cartacredito_numero`  varchar(16)   DEFAULT NULL,
  `data_scadenza`        date          DEFAULT NULL,
  `ccv`                  varchar(3)    DEFAULT NULL,
  `importo`              float             NOT NULL,
  `tipo_pagamento`       enum('contanti','carta di credito')  DEFAULT NULL,
  PRIMARY KEY       (`numero_pagamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `location`
--
CREATE TABLE IF NOT EXISTS `location` (
  `locationID`  int(13)           NOT NULL,
  `nome`        varchar(100)  DEFAULT NULL,
  `via`         varchar(100)  DEFAULT NULL,
  `CAP`         varchar(5)    DEFAULT NULL,
  `citta`       varchar(20)   DEFAULT NULL,
  `email`       varchar(80)   DEFAULT NULL,
  `telefono`    varchar(35)   DEFAULT NULL,
  PRIMARY KEY       (`locationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1, AUTO_INCREMENT=5;

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE IF NOT EXISTS `commento` (
  `commentoID`           int(11)           NOT NULL,
  `vinoID_FK`            int(13)           NOT NULL,
  `testo`  	         varchar(1024) DEFAULT NULL,
  `voto`   	         float             NOT NULL,
  PRIMARY KEY       (`commentoID`),
  KEY `Vino_FK`     (vinoID_FK)
) ENGINE=InnoDB DEFAULT CHARSET=latin1, AUTO_INCREMENT=4;

-- --------------------------------------------------------

--
-- Struttura della tabella `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `eventoID`             int(13)           NOT NULL,
  `vinoID_FK`            int(13)           NOT NULL,
  `locationID_FK`        int(13)       DEFAULT NULL,
  `nome`                 varchar(20)   DEFAULT NULL,
  `data_chiusura`        datetime      DEFAULT NULL,
  `posti`                int(11)       DEFAULT NULL,
  `descBreve`            varchar(200)  DEFAULT NULL,
  `descrizione`          varchar(1024) DEFAULT NULL,
  `prezzo`               float             NOT NULL,
  `foto`                 varchar(100)  DEFAULT NULL,
  `pubblicato`           tinyint(1)        NOT NULL,
  PRIMARY KEY       (`eventoID`), 
  KEY `Vino_FK`     (`vinoID_FK`),
  KEY `Location_FK` (`locationID_FK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1, AUTO_INCREMENT=3;

-- --------------------------------------------------------

--
-- Struttura della tabella `eventopartecipante`
--

CREATE TABLE IF NOT EXISTS `eventopartecipante` (
  `eventoPartecipanteID`    int(13)           NOT NULL,
  `username_FK`             varchar(20)   DEFAULT NULL,
  `numero_pagamento_FK`     varchar(16)       NOT NULL,
  `eventoID_FK`   	    int(13)           NOT NULL,
  `pagato`       	    tinyint(1)    DEFAULT NULL,
  PRIMARY KEY        (`eventopartecipanteID`), 
  KEY `Utente_FK`    (`username_FK`),
  KEY `Pagamento_FK` (`numero_pagamento_FK`),
  KEY `Evento_FK`    (`eventoID_FK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1, AUTO_INCREMENT=7; 

-- --------------------------------------------------------

--
-- Indexes for dumped tables
-- ALTER TABLE table_name
--   ADD     [CONSTRAINT  `symbol`]  PRIMARY KEY (`index_column_name`)
--   ADD KEY [`index_name`]                      (`index_column_name`)   
--   MODIFY  [COLUMN]     `column_name` 	     column_definition
--   ADD     [CONSTRAINT [`symbol`]] FOREIGN KEY (`index_column_name`) REFERENCES `table_name` (`index_column_name`);
--

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
ADD CONSTRAINT `commento_vino`     		FOREIGN KEY (`vinoID_FK`)       REFERENCES `vino`     (`vinoID`);

--
-- Limiti per la tabella `evento`
--
ALTER TABLE `evento`
ADD CONSTRAINT `evento_vino`     		FOREIGN KEY (`vinoID_FK`)       REFERENCES `vino`     (`vinoID`),
ADD CONSTRAINT `evento_location` 		FOREIGN KEY (`locationID_FK`)   REFERENCES `location` (`locationID`);

--
-- Limiti per la tabella `eventopartecipante`
--
ALTER TABLE `eventopartecipante`
ADD CONSTRAINT `eventopartecipante_utente`      FOREIGN KEY (`username_FK`)         REFERENCES `utente` (`username`),
ADD CONSTRAINT `eventopartecipante_pagamento`   FOREIGN KEY (`numero_pagamento_FK`) REFERENCES `pagamento` (`numero_pagamento`),
ADD CONSTRAINT `eventopartecipante_evento`      FOREIGN KEY (`eventoID_FK`)         REFERENCES `evento` (`eventoID`);

-- --------------------------------------------------------

use `condivinoauto`;
--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` 
(`username`,         `password`, `nome`,      `cognome`,  `via`,             `CAP`,    `citta`,     `email`,             `sesso`, `data_nascita`, `codice_fiscale`, `telefono`, `codice_attivazione`, `stato` ) VALUES
('massimovirno',     'password', 'Massimo',   'Virno',    'Via C.B. 6',      '00154',  'Roma',      'io@massimovirno.it',    'M',             '',               '',         '',          '945761796', 'attivo'),
('antoniomartone',   'martone',  'Antonio',   'Martone',  'Via Cipparola 5', '05018',  'Orvieto',   'am@dominiiiii.net',     'M',             '',               '',         '',           '12345678', 'attivo'),
('nikolatesla',      'tesla',    'Nikola',    'Tesla',    '5th Avenue',      '10024',  'New York',  'niktes@elettric.com',   'M',             '',               '',         '',           '23456789', 'attivo'),
('serafinocicerone', 'cicerone', 'Serafino',  'Cicerone', 'Via Croce 1',     '67010',  'L''Aquila', 'sc@prof.aquila.it',     'M',             '',               '',         '',           '12345679', 'attivo'),
('isaacnewton',      'isaac',    'Isaac',     'Newton',   'Via Croce 2',     '67010',  'L''Aquila', 'is@fisica.aquila.it',   'M',             '',               '',         '',           '12345789', 'attivo'),
('mariecurie',       'marie',    'Marie',     'Curie',    '5th Avenue',      '10024',  'New York',  'mcurie@fisics.com',     'F',             '',               '',         '',           '12346789', 'attivo');

--
-- Dump dei dati per la tabella `vino`
--

INSERT INTO `vino` 
(`Vinoid`,  `nome`,               `produttore`,     `denominazione`,                   `paese`,  `regione`,  `descrizione`,                                                                                                                                                                                                                                                                                                                                                `vitigno`,        `annata`, `grado`, `volume`, `colore`, `noteSensoriali`,                                                                                                                                                                   `temperaturaServizio`, `prezzo`, `etichetta`) VALUES
(       1,  'Sursur',             'Donnafugata',    'sicilia doc',                     'italia', 'sicilia',  'Il nome sur sur, che significa grillo, deriva dalla lingua araba classica, un tempo parlata anche in Sicilia. Dalle uve dell''omonimo vitigno nasce questo vino che ha tutta la poesia del canto dei gril',                                                                                                                                                  'grillo',         2014,      12.5,   0.75,     'bianco', 'Offre un naso fresco e fruttato con note di pesca bianca e pompelmo, unite a sentori di erbe aromatiche.',                                                                          4,                    10.9,     'sursur.jpg'),
(       2,  'Monte Sant''Urbano', 'Speri Fratelli', 'Amarone della Valpolicella DOCG', 'italia', 'veneto',   'Vino dai profumi ampissimi e dalla complessità indiscussa, questo Amarone sfida il tempo prestandosi ad un invecchiamento anche lungo in bottiglia.',                                                                                                                                                                                                        'corvina',        2010,      15,     0.75,     'rosso',  'profumo è gradevolmente speziato e ricorda il gusto del ribes',                                                                                                                    20,                    40,       'amarone.jpg'),
(       3,  'Tignanello',         'Antinori',       'Toscana IGT',                     'italia', 'toscana',  'Tignanello, in origine "Chianti Classico Riserva vigneto Tignanello" e dal 1971 Toscana IGT con il nome di Tignanello. Dal 1982 la composizione è rimasta la stessa di quella attuale. Tignanello viene prodotto soltanto nelle annate migliori. Il meglio dell''esperienza Antinori in un vino senza eguali che non può mancare nella vostra collezione! ', 'sangiovese',     2012,      13.5,   0.75,     'rosso',  'Il vino è lungo e persistente ed escono, nel retrogusto, note di cioccolato, mirtilli e confettura di prugne.',                                                                    20,                    65,       'tignanello.jpg'),
(       4,  'Per è Palummo',      'Casa D''Ambra',  'Ischia Doc',                      'Italia', 'campania', 'Questo vino nasce da uve ai più sconosciute, tipiche della zona di Ischia e del Golfo di Napoli. Con i suoi profumi delicati e vinosi e a sua anima vivace e intrigante esprime tutto il calore e l''energia della terra dove nasce!',                                                                                                                       'Per è Palummo ', 2013,      12,     0.75,     'rosso',  'Al naso è un mix di sensazioni di frutta rossa, fragolina e lampone con toni floreali di peonia e geranio, insieme a lievi sensazioni speziate di cannella e chiodi di garofano.', 20,                    12.4,     'perepalummo.jpg');

--
-- Dump dei dati per la tabella `pagamento`
--

INSERT INTO `pagamento` 
(`numero_pagamento`,`nome_titolare`, `cognome_titolare`, `cartacredito_numero`, `data_scadenza`, `ccv`, `importo`,   `tipo_pagamento`) VALUES
('0000000000000001',             '',                 '',                  NULL,            NULL,    '',     15.00,         'contanti'),
('0000000000000005',            'a',                 '',                  NULL,            NULL,    '',     15.00,         'contanti'),
('0000000000000008',            'q',                'q',                  NULL,            NULL,    '',     15.00,         'contanti'),
('0000000000000009',            'q',                'q',                  NULL,            NULL,    '',     15.00,         'contanti'),
('1111111111111111',            'x',                'x',                  NULL,            NULL,    '',     15.00,         'contanti'),
('1233333012321327',     'Serafino',         'Cicerone',    '2143854395643453',    '2019-12-01', '222',     15.00, 'carta di credito'),
('1233353012321324',      'Antonio',          'Martone',    '2143999995643421',    '2020-10-01', '234',     15.00, 'carta di credito'),
('1234123412431234',       'Nikola',            'Tesla',    '2143888895644312',    '2020-07-10', '123',     15.00, 'carta di credito'),
('1234126412341234',        'Isaac',           'Newton',    '2147777395645453',    '2019-12-25', '113',     15.00, 'carta di credito'),
('1237812341241234',        'Marie',            'Curie',    '2146666395646556',    '2019-11-07', '823',     15.00, 'carta di credito'),
('1332333301221320',      'Massimo',            'Virno',    '2145555395647667',    '2020-01-01', '111',     15.00, 'carta di credito');

--
-- Dump dei dati per la tabella `location`
--

INSERT INTO `location` 
(`locationID`, `citta`,   `via`             ) VALUES
(           1, 'Roma',    'Via Frattina 146'      ),
(           2, 'Milano',  'Via Triboniano 250'    ),
(           3, 'Napoli',  'Via Toledo 275'        ),
(           4, 'Palermo', 'Piazza Monte Grappa 35');

--
-- Dump dei dati per la tabella `commento`
--	

INSERT INTO `commento` 
(`commentoID`, `vinoID_FK`, `testo`,                      `voto`) VALUES
(           1,           3, 'Nella media',                     6),
(           2,           4, 'Pessimo',                         3),
(           3,           1, 'Eccellente da bere di nuovo',     9),
(           4,           2, 'Discreto',                        5);

--
-- Dump dei dati per la tabella `evento`
--

INSERT INTO `evento` 
(`eventoID`,  `vinoID_FK`, `locationID_FK`, `nome`           , `data_chiusura`      , `posti`, `descBreve`,                                                    `descrizione`,                                                                  `prezzo`, `foto`,       `pubblicato`) VALUES
(         1,            1,               1, 'Cena a casa mia', '2015-09-01 20:00:00',      10, 'Cena leggera a casa mia con cous cous e contorni di verdure.', 'Il menu prevede un cous cous con melanzane e zucchine. Cortorno di peperoni.',       10, 'foto01.jpg',            1),  
(         2,            2,               1, 'BBQ in giardino', '2015-09-03 21:00:00',       5, 'Brace con bistecche e salsicce',                               'Brace nel giardino con carni e bruschette.',                                         25, 'foto02.jpg',            2);

--
-- Dump dei dati per la tabella `eventopartecipante`
--

INSERT INTO `eventopartecipante` 
(`eventoPartecipanteID`,      `username_FK`,`numero_pagamento_FK`,`eventoID_FK`, `pagato`) VALUES
(                     1, 'antoniomartone'  ,   '1233353012321324',            1,     NULL),
(                     2, 'serafinocicerone',   '1233333012321327',            1,        0),
(                     3, 'nikolatesla'     ,   '1234123412431234',            2,        0),
(                     4, 'massimovirno'    ,   '1332333301221320',            2,        0),
(                     5, 'isaacnewton'     ,   '1234126412341234',            2,        1),
(                     6, 'mariecurie'      ,   '1237812341241234',            1,        1);

-- -------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
