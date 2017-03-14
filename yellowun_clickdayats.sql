-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 14, 2017 at 03:56 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `yellowun_clickdayats`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `lastSeen` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `name`, `email`, `password`, `lastSeen`) VALUES
(1, 'Jack', 'michele@yellowunicorns.com', 'caec475925e1c17ea2b871ac0a461f7573f25e2f', '2017-03-02 09:14:00'),
(2, 'John', 'andrea@amorosi.com', '5dd83bf2730cc172045efc4e12f41ea1f3b3a8cd', '2017-03-14 14:55:00'),
(3, 'Nicola', 'nicola@yellowunicorns.com', '9d12a5ce674362679d1e066591186c4f519eb4f1', '2016-06-01 15:21:00'),
(4, 'Vanessa', 'vanessa@yellowunicorns.com', '9d12a5ce674362679d1e066591186c4f519eb4f1', '2016-06-09 09:32:00'),
(5, 'Alessandro Faletti', 'alessandrofaletti@atseco.it', '9d12a5ce674362679d1e066591186c4f519eb4f1', '2017-01-31 16:13:00'),
(6, 'Admins', 'clickdayats2016@gmail.com', '488f2d286927bf6deedb75a73a39f899282b73f6', '2016-06-27 08:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `clickmasters`
--

CREATE TABLE `clickmasters` (
  `ID` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `recovery` varchar(50) DEFAULT NULL,
  `lastSeen` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clickmasters`
--

INSERT INTO `clickmasters` (`ID`, `code`, `name`, `surname`, `email`, `password`, `recovery`, `lastSeen`) VALUES
(-1, '', 'General', 'ClickMaster', 'general@clickmaster.it', 'caec475925e1c17ea2b871ac0a461f7573f25e2f', NULL, '2016-05-01 14:57:00'),
(1, '98MM', 'Michele', 'Mazza', 'mhlmazza@gmail.com', 'caec475925e1c17ea2b871ac0a461f7573f25e2f', NULL, '2016-06-25 10:42:00'),
(85, '99AF', 'Alessandro', 'Faletti', 'andre_amo@live.cm', '5dd83bf2730cc172045efc4e12f41ea1f3b3a8cd', NULL, '2017-03-09 18:44:00'),
(86, '01PC', 'Paolo', 'Corradini', 'paolocorradini@atseco.it', '100aa4cf50065f201ba5340921850ae3a6bf23e4', NULL, '2016-06-08 15:52:00'),
(87, '10FB', 'Federico', 'Bonini', 'kikko-90@hotmail.it', '4233033b9d07724b707e1c27659c8096fc672c06', NULL, '2016-05-30 07:31:00'),
(88, '02MG', 'Mirko', 'Graiani', 'mirkograiani@atseco.it', '5b1b2df7cf46de1733111de8ca622bc18b9cede4', NULL, '2016-06-16 13:34:00'),
(89, '03MC', 'Marco', 'Cremaschi', 'marcocremaschi@atseco.it', 'c20acdece38dd60f0ab1f690c43bcf7cd1f978f5', NULL, '2017-01-09 15:27:00'),
(90, '04FF', 'Filippo', 'Ferretti', 'filippoferretti@atseco.it', '19b0e4b3b3af47d26837b3504237c00118eeeea9', NULL, '2016-05-26 14:44:00'),
(91, '05CC', 'Chiara', 'Chiarabini', 'chiarachiarabini@atseco.it', 'ee4697b6d03cd96cf489886aa0e2fcd526fc4488', NULL, '2016-06-01 14:36:00'),
(92, '06AC', 'Antonio', 'Calabrese', 'londonday@yahoo.it', 'd68b4c9cd85aca2c5d97584e332484d5c0a2696b', NULL, '2016-07-04 16:57:00'),
(93, '12SF', 'Silvia', 'Fradici', 'silviafradici@atseco.it', 'c6c5c199f4845f7ce9f0610ef66dc5c3aa8cfcc7', NULL, '2016-05-27 09:48:00'),
(95, '15AG', 'Annalisa', 'Gargiulo', 'annalisagargiulo@atseco.it', '6967f842fc89a467c8e8f5cb09ddf9b68be9ad79', NULL, '2016-05-30 12:24:00'),
(96, '16MS', 'Maurizio', 'Spadavecchia', 'mauriziospadavecchia@atseco.it', 'bf930014f8100d7b3723c285a73c82d93c4e3adc', NULL, NULL),
(98, '19CC', 'Cristina', 'Cosentino', 'josdasd@live.cm', '5dd83bf2730cc172045efc4e12f41ea1f3b3a8cd', NULL, '2017-03-09 07:32:00'),
(99, '14LP', 'Lorenzo', 'Pattini', 'lorenzopattini@atseco.it', 'ce6f013850ddddb62f181cd0ab6647a17db5c238', NULL, '2016-05-26 07:24:00'),
(144, '13MB', 'Maria Laura', 'Benevelli', 'mariabenevelli@atseco.it', '562038d5c12a260b2d3a26ea7105474ecd0c0051', NULL, '2016-05-30 09:07:00'),
(154, '11YU', 'Yellow', 'Unicorns', 'info@yellowunicorns.com', '6263a042b965bbb7531573122a83ffc73f56d4a8', NULL, '2016-02-25 18:00:00'),
(155, '20AB', 'Alessandra', 'Bondavalli', 'alessandrabondavalli@atseco.it', '0a5c5f6e131afa6f677021df2255177c5f27759e', NULL, '2016-05-20 10:32:00'),
(156, '21SB', 'Simone', 'Bonacini', 'simonebonacini@atseco.it', '61a5a839384d46ba42670224b06a8d0b795033ee', NULL, '2016-05-26 14:50:00'),
(157, '22MC', 'OCGaming', 'OCGaming', 'clickday1@hotmail.com', '174757931974915212b863259c3135afa75dbbc6', NULL, '2016-05-30 10:26:00'),
(158, '23MC', ' Ghetto della Tecnologia ', ' Ghetto della Tecnologia ', 'clickday2@hotmail.com', '311aa7b5db7ebdf6b3f46479ec092f83a590663c', NULL, '2016-05-30 07:32:00'),
(159, '24MS', 'Massimo', 'Simoncini', 'info@officina3dlab.it', 'dc7001c76716d13e069578bad83862bc7392c643', NULL, '2016-05-26 13:52:00'),
(160, '25CP', 'Caterina', 'Parisi', 'caterina.parisi@outlook.com', 'aa5b11d69e45c7c9fe88548dc58237415749fc60', NULL, '2016-05-31 09:48:00'),
(161, '07MS', 'Mirco', 'Siciliano', 'mircosiciliano@atseco.it', '14092161b0df30b9b3e5e92f161e7f9dc3362636', NULL, '2016-06-07 12:50:00'),
(162, '26MY', 'Mary', 'Mary', 'clickdaymary@gmail.com', 'dedac644c5315a7d9fb723bd1f651a06724dd591', NULL, '2016-06-07 13:14:00'),
(163, '27AF', 'Alberto', 'Faletti', 'albyfaletti@hotmail.it', '302f933fbbd5c257c700edf9fd0884ad49a82f71', NULL, '2016-06-01 11:40:00'),
(164, '28SM', 'Silvia', 'Messori', 'silviamessori@atseco.it', '81e438022427b4e45f406c2c8bdec59f9aa0c593', NULL, NULL),
(165, '29EB', 'Elisa', 'Barbieri', 'elisabarbieri179@gmail.com', '7c5eb322f5d6390e6edf5585a5396cc5da993427', NULL, '2016-06-07 13:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `ID` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `filename` varchar(50) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=387 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mails`
--

CREATE TABLE `mails` (
  `ID` int(11) NOT NULL,
  `mittID` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `destID` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `parentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `not_mail`
--

CREATE TABLE `not_mail` (
  `ID` int(11) NOT NULL,
  `mailID` int(11) NOT NULL,
  `destID` int(11) NOT NULL,
  `role` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `projects_classic`
--

CREATE TABLE `projects_classic` (
  `ID` int(11) NOT NULL,
  `file` varchar(255) CHARACTER SET latin1 NOT NULL,
  `region_ex` varchar(255) CHARACTER SET latin1 NOT NULL,
  `region` varchar(255) CHARACTER SET latin1 NOT NULL,
  `proj` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects_classic`
--

INSERT INTO `projects_classic` (`ID`, `file`, `region_ex`, `region`, `proj`) VALUES
(1, 'p001ARPACE.txt', 'EMILIA ROMAGNA', 'EMR', 'A.R.P.A. Azienda Rivestimenti Pavimenti Affini S.p.A.'),
(2, 'p002AMBROS.txt', 'UMBRIA', 'UMB', 'AMBROSI SPA'),
(3, 'p003AUTBAL.txt', 'MARCHE', 'MAR', 'AUTOCARROZZERIA BALEANI SRL'),
(4, 'p004AUTLAN.txt', 'LAZIO', 'LAZ', 'AUTOLAND S.R.L.'),
(5, 'p005AUTBEV.txt', 'UMBRIA', 'UMB', 'AUTONOLEGGI BEVILACQUA'),
(6, 'p006AUTSIL.txt', 'TOSCANA', 'TOS', 'AUTOTRASPORTI ANTONIO SILVESTRE SAS'),
(7, 'p007BTFSRL.txt', 'UMBRIA', 'UMB', 'B.T.F. S.R.L.'),
(8, 'p008BARBIN.txt', 'MARCHE', 'MAR', 'BARBINI EMILIA SNC DI BARBINI EMILIA E C.'),
(9, 'p009BATTIP.txt', 'TOSCANA', 'TOS', 'BATTI PIETRO E FIGLI SNC'),
(10, 'p010BFGSRL.txt', 'UMBRIA', 'UMB', 'BDG S.r.l.'),
(11, 'p011BEDDIN.txt', 'UMBRIA', 'UMB', 'BEDDINI PAOLINO'),
(12, 'p012BELARD.txt', 'UMBRIA', 'UMB', 'BELARDONI SANDRO E MARIO SNC'),
(13, 'p013BERNAR.txt', 'MARCHE', 'MAR', 'BERNARDI ROBERTO'),
(14, 'p014BIANCH.txt', 'UMBRIA', 'UMB', 'BIANCHINI ANGELO'),
(15, 'p015BIMCCM.txt', 'MARCHE', 'MAR', 'Biemme di C.C.M. COOP. CARTAI MODENESE SOC. COOP.'),
(16, 'p016BRDIBR.txt', 'UMBRIA', 'UMB', 'BR DI BAZZUCCHI ROBERTO'),
(17, 'p017BRAGIO.txt', 'UMBRIA', 'UMB', 'BRAGIOLA SPA'),
(18, 'p018BRUNEL.txt', 'UMBRIA', 'UMB', 'BRUNELLI GIAN PAOLO SRL'),
(19, 'p019BUTTER.txt', 'EMILIA ROMAGNA', 'EMR', 'BUTTERI COSTRUZIONI S.r.l.'),
(20, 'p020CEGCAL.txt', 'TOSCANA', 'TOS', 'C&G CALCESTRUZZO DI CARGI E GIUSTARINI S.R.L.'),
(21, 'p021CMMCOS.txt', 'UMBRIA', 'UMB', 'C.M.M. COSTRUZIONI S.R.L.'),
(22, 'p022CMRSRL.txt', 'UMBRIA', 'UMB', 'C.M.R. SRL'),
(23, 'p023CABIAN.txt', 'EMILIA ROMAGNA', 'EMR', 'CA'' BIANCA S.r.l.'),
(24, 'p024CAGNIN.txt', 'MARCHE', 'MAR', 'CAGNINI COSTRUZIONI S.R.L.'),
(25, 'p025CARAVA.txt', 'UMBRIA', 'UMB', 'CARAVAN CAMPER 2 SAS'),
(26, 'p026CARRAL.txt', 'TOSCANA', 'TOS', 'CARROZZERIA RALLY S.N.C. DI CACIOLLI E LATINI'),
(27, 'p027CASINI.txt', 'TOSCANA', 'TOS', 'CASINI ELIO SAS DI CASINI CLAUDIO E C.'),
(28, 'p028CECCAR.txt', 'UMBRIA', 'UMB', 'CECCARELLI SERAFINA S.R.L.'),
(29, 'p029CEPRIN.txt', 'UMBRIA', 'UMB', 'CEPRINI COSTRUZIONI SRL'),
(30, 'p030CHIASS.txt', 'TOSCANA', 'TOS', 'CHIASSERINI SILVIO'),
(31, 'p031CIMIGN.txt', 'UMBRIA', 'UMB', 'Cimignoli Costruzioni di Sauro Cimignoli'),
(32, 'p032COGEAA.txt', 'ABRUZZO', 'ABR', 'CO.GE.A. S.r.l.'),
(33, 'p033CONREC.txt', 'UMBRIA', 'UMB', 'CONSORZIO RECUPERI SRL'),
(34, 'p034CONSOR.txt', 'UMBRIA', 'UMB', 'CONSORZIO V.P.M.'),
(35, 'p035DESANT.txt', 'UMBRIA', 'UMB', 'DE SANTIS QUARTILIO DI DE SANTIS AGOSTINO'),
(36, 'p036DELBUO.txt', 'TOSCANA', 'TOS', 'DEL BUONO MAURO'),
(37, 'p037DINIAR.txt', 'EMILIA ROMAGNA', 'EMR', 'Dini Argeo  S.r.l.'),
(38, 'p038DOMGRU.txt', 'UMBRIA', 'UMB', 'DOMENICHINI GROUP SRL'),
(39, 'p039ECOEDI.txt', 'ABRUZZO', 'ABR', 'ECO EDIL AUTOTRASPORTI DI BENEDETTI ENRICO COSTANTINO'),
(40, 'p040ECOSAT.txt', 'TOSCANA', 'TOS', 'ECO SAT s.r.l.'),
(41, 'p041ECOCAV.txt', 'UMBRIA', 'UMB', 'Ecocave Srl Unipersonale'),
(42, 'p042ECOTER.txt', 'UMBRIA', 'UMB', 'ECOTER ITALIA SRL'),
(43, 'p043EDIFER.txt', 'UMBRIA', 'UMB', 'EDIL FERRAMENTA CANADA SNC'),
(44, 'p044EDIPAP.txt', 'UMBRIA', 'UMB', 'EDIL MECCANICA S.N.C. DI PAPA LUCIANO E LUIGI S.N.C.'),
(45, 'p045EDIPCO.txt', 'UMBRIA', 'UMB', 'EDIL P COSTRUZIONI DI PULITO ALESSANDRO'),
(46, 'p046EDIL94.txt', 'UMBRIA', 'UMB', 'EDIL94 S.R.L.'),
(47, 'p047EDILCO.txt', 'TOSCANA', 'TOS', 'EDILCOMIT SRL'),
(48, 'p048EDICAS.txt', 'UMBRIA', 'UMB', 'EDILIZIA CASTELLINI DI CASTELLINI ROBERTO E C SNC'),
(49, 'p049EDIPER.txt', 'UMBRIA', 'UMB', 'Edilizia Persichetti S.r.l.'),
(50, 'p050EDIRUF.txt', 'UMBRIA', 'UMB', 'EDILIZIA RUFFINELLI S.R.L.'),
(51, 'p051EDIMON.txt', 'TOSCANA', 'TOS', 'EDILMONTE SNC'),
(52, 'p052EDICIR.txt', 'UMBRIA', 'UMB', 'Edilnova Snc Di Ciribilli S E Grasselli S'),
(53, 'p053EDILST.txt', 'TOSCANA', 'TOS', 'EDILSTRADE DI ORLANDO MAURIZIO'),
(54, 'p054ELEBTB.txt', 'TOSCANA', 'TOS', 'ELETTROMECCANICA B.T.B. SRL'),
(55, 'p055ELETOR.txt', 'TOSCANA', 'TOS', 'ELETTROMECCANICA TORRITESE S.R.L.'),
(56, 'p056EREDIB.txt', 'MARCHE', 'MAR', 'EREDI BATTISTELLI GUALTIERO DI e BATTISTELLI LUIGI E C. SNC'),
(57, 'p057ERMESC.txt', 'EMILIA ROMAGNA', 'EMR', 'Ermes Ceramiche S.p.A.'),
(58, 'p058EUROST.txt', 'EMILIA ROMAGNA', 'EMR', 'EUROSTRADE SRL'),
(59, 'p059FBETTI.txt', 'UMBRIA', 'UMB', 'F.LLI BETTI SNC'),
(60, 'p060FBROGI.txt', 'UMBRIA', 'UMB', 'F.LLI BROGIALDI E C SNC'),
(61, 'p061FMARAS.txt', 'EMILIA ROMAGNA', 'EMR', 'F.lli Marastoni s.n.c.'),
(62, 'p062FTENER.txt', 'UMBRIA', 'UMB', 'F.lli Tenerini SERGIO & ALVARO SRL'),
(63, 'p063FAGIOL.txt', 'UMBRIA', 'UMB', 'FAGIOLARI S.R.L.'),
(64, 'p064FERINA.txt', 'TOSCANA', 'TOS', 'FERI NATALE SRL'),
(65, 'p065FIORIN.txt', 'MARCHE', 'MAR', 'FIORI COSTRUZIONI SRL'),
(66, 'p066FIPEMS.txt', 'UMBRIA', 'UMB', 'FIPEM S.R.L.'),
(67, 'p067FRATEL.txt', 'UMBRIA', 'UMB', 'FRATELLI BECCHETTI L. & G. SNC'),
(68, 'p068FRECCI.txt', 'TOSCANA', 'TOS', 'FRECCIA DEL VALDARNO SNC DI TOPINI E VALDAI'),
(69, 'p069FUOCHI.txt', 'TOSCANA', 'TOS', 'FUOCHI FIORENZO S.R.L.'),
(70, 'p070GCOSTR.txt', 'UMBRIA', 'UMB', 'G. COSTRUZIONI SRLS'),
(71, 'p071GAVLOC.txt', 'UMBRIA', 'UMB', 'GAVARINI LOCAZIONI SRL'),
(72, 'p072GAVARI.txt', 'UMBRIA', 'UMB', 'GAVARINI SRL'),
(73, 'p073GHEOSR.txt', 'EMILIA ROMAGNA', 'EMR', 'GHEO s.r.l.'),
(74, 'p074GIELLE.txt', 'TOSCANA', 'TOS', 'GIELLE DI GENITO LUIGINO'),
(75, 'p075GIOVAN.txt', 'UMBRIA', 'UMB', 'GIOVANNOLI ALBERTO'),
(76, 'p076GMPSPA.txt', 'UMBRIA', 'UMB', 'GMP S.P.A.'),
(77, 'p077GOTTAR.txt', 'TOSCANA', 'TOS', 'GOTTARDI LAMBERTO'),
(78, 'p078GRECOC.txt', 'TOSCANA', 'TOS', 'GRECO COSTRUZIONI SRL'),
(79, 'p079IPLATA.txt', 'ABRUZZO', 'ABR', 'I PLATANI SRL'),
(80, 'p080IANNEL.txt', 'TOSCANA', 'TOS', 'IANNELLI SRL'),
(81, 'p081ICEFSS.txt', 'LAZIO', 'LAZ', 'ICEFS SRL'),
(82, 'p082ILCAST.txt', 'TOSCANA', 'TOS', 'IL CASTELLO SRL'),
(83, 'p083IMMOM2.txt', 'UMBRIA', 'UMB', 'IMMOBILIARE M2 s.r.l.'),
(84, 'p084IMPCAR.txt', 'UMBRIA', 'UMB', 'IMPERCAR ECOLOGY SYSTEM SRL'),
(85, 'p085IMPFOG.txt', 'MARCHE', 'MAR', 'IMPERFOGLIA SRL'),
(86, 'p086IMPANG.txt', 'TOSCANA', 'TOS', 'Impresa Costruzioni ANGELI AGOSTINO'),
(87, 'p087IMPCAN.txt', 'UMBRIA', 'UMB', 'IMPRESA EDILE CANTERINI ERMANNO'),
(88, 'p088IMPCAP.txt', 'TOSCANA', 'TOS', 'IMPRESA EDILE CAPACCI IVANO'),
(89, 'p089IMPCOR.txt', 'TOSCANA', 'TOS', 'IMPRESA EDILE CORSALONE SAS di Clabattini Ivano & C'),
(90, 'p090IMPFAS.txt', 'MARCHE', 'MAR', 'IMPRESA EDILE FASIS SNC'),
(91, 'p091IMPROS.txt', 'TOSCANA', 'TOS', 'IMPRESA EDILE ROSSI - SERAFINI SRL'),
(92, 'p092IMPSCA.txt', 'UMBRIA', 'UMB', 'IMPRESA EDILE SCARGIALI MARIO'),
(93, 'p093IMPMAR.txt', 'MARCHE', 'MAR', 'IMPRESA MARCOLINI MARCELLO'),
(94, 'p094IMPMAR.txt', 'MARCHE', 'MAR', 'IMPRESA MARTARELLI PAOLO'),
(95, 'p095IMPMAT.txt', 'EMILIA ROMAGNA', 'EMR', 'Impresa Mattei s.r.l.'),
(96, 'p096IMPFUR.txt', 'TOSCANA', 'TOS', 'IMPRESA ROSSI FURIO & FIGLI SRL'),
(97, 'p097IMPTAR.txt', 'MARCHE', 'MAR', 'IMPRESA TARTABINI OTTAVIO E C. SNC'),
(98, 'p098INEORC.txt', 'TOSCANA', 'TOS', 'INERTI VAL D''ORCIA SRL'),
(99, 'p099ISAACQ.txt', 'UMBRIA', 'UMB', 'ISA - IMPRESA STRADE ACQUEDOTTI SNC'),
(100, 'p100ITALGR.txt', 'BASILICATA', 'BAS', 'ITALGRANITI s.n.c.'),
(101, 'p101ITAIMP.txt', 'UMBRIA', 'UMB', 'ITALIMPIANTI S.R.L.'),
(102, 'p102ITAMAN.txt', 'EMILIA ROMAGNA', 'EMR', 'ITALMANOMETRI S.R.L.'),
(103, 'p103LADUEB.txt', 'UMBRIA', 'UMB', 'LA DUE B.C. S.R.L.'),
(104, 'p104LATOSC.txt', 'TOSCANA', 'TOS', 'LA TOSCANA S.r.l.'),
(105, 'p105MGMGRE.txt', 'EMILIA ROMAGNA', 'EMR', 'M.G.M. Di Grenzi Marco & C. S.r.l.'),
(106, 'p106MICSRL.txt', 'TOSCANA', 'TOS', 'M.I. - C.S. SRL'),
(107, 'p107MANCIN.txt', 'UMBRIA', 'UMB', 'MANCINELLI PAOLO & GAETANO SNC'),
(108, 'p108MARCHE.txt', 'MARCHE', 'MAR', 'MARCHETTI STEFANO'),
(109, 'p109MARCHI.txt', 'MARCHE', 'MAR', 'MARCHI GIULIANO E C. SNC'),
(110, 'p110MARGAR.txt', 'EMILIA ROMAGNA', 'EMR', 'Margaritelli Ferroviaria S.p.A.'),
(111, 'p111MARIAN.txt', 'MARCHE', 'MAR', 'MARIANI MATTEO ESCAVAZIONI E TRASPORTI'),
(112, 'p112MECTIL.txt', 'EMILIA ROMAGNA', 'EMR', 'Mectiles Italia S.r.l.'),
(113, 'p113MENDIC.txt', 'EMILIA ROMAGNA', 'EMR', 'Mendicino Trasporti Antonio'),
(114, 'p114MOVITE.txt', 'MARCHE', 'MAR', 'MO.VI.TER. S.R.L.'),
(115, 'p115MUNZIR.txt', 'UMBRIA', 'UMB', 'MUNZI ROBERTO E PAOLO SNC'),
(116, 'p116NUOREA.txt', 'EMILIA ROMAGNA', 'EMR', 'NUOVA OREA s.n.c.'),
(117, 'p117OMATSC.txt', 'UMBRIA', 'UMB', 'OMAT SCALE'),
(118, 'p118OPUSCO.txt', 'UMBRIA', 'UMB', 'OPUS COSTRUZIONI S.R.L.'),
(119, 'p119ORFANI.txt', 'UMBRIA', 'UMB', 'ORFANINI SNC'),
(120, 'p120OVERLA.txt', 'UMBRIA', 'UMB', 'OVERLAND SRL'),
(121, 'p121PACIFR.txt', 'MARCHE', 'MAR', 'PACI FRANCESCO'),
(122, 'p122PAESAG.txt', 'TOSCANA', 'TOS', 'PAESAGGISTICA TOSCANA SRL'),
(123, 'p123PARIGI.txt', 'TOSCANA', 'TOS', 'PARIGI PROFUMERIE SPA'),
(124, 'p124PELLIC.txt', 'UMBRIA', 'UMB', 'PELLICCIA ILARIO'),
(125, 'p125PERUGI.txt', 'UMBRIA', 'UMB', 'PERUGIA CONGLOMERATI SRL'),
(126, 'p126PESCIM.txt', 'TOSCANA', 'TOS', 'PESCI MASSIMO TRIVELLAZIONI'),
(127, 'p127PETRUC.txt', 'UMBRIA', 'UMB', 'PETRUCCI MAURIZIO'),
(128, 'p128PIABOS.txt', 'MARCHE', 'MAR', 'PIAN DEL BOSCO SRL'),
(129, 'p129PICONE.txt', 'UMBRIA', 'UMB', 'PICONE COSTRUZIONI SRL'),
(130, 'p130PISELL.txt', 'UMBRIA', 'UMB', 'PISELLI CAVE SRL'),
(131, 'p131PROCEL.txt', 'TOSCANA', 'TOS', 'PROCELLI COSTRUZIONI SRL'),
(132, 'p132PUCCIU.txt', 'UMBRIA', 'UMB', 'PUCCIUFFICIO S.R.L.'),
(133, 'p133RFMMOR.txt', 'UMBRIA', 'UMB', 'R.F.M. DI MORONI GIANCARLO S.R.L.'),
(134, 'p134RGRICC.txt', 'UMBRIA', 'UMB', 'R.G. SAS DI RICCIONI P. & C'),
(135, 'p135ROMEIS.txt', 'EMILIA ROMAGNA', 'EMR', 'ROMEI STEFANO sas'),
(136, 'p136ROSINI.txt', 'TOSCANA', 'TOS', 'ROSINI IMPIANTI SRL'),
(137, 'p137SEASRL.txt', 'UMBRIA', 'UMB', 'S.e.a.s. S.r.l.'),
(138, 'p138STSETS.txt', 'CALABRIA', 'CAL', 'S.T.S. Edil Trasporti e Scavi SNC'),
(139, 'p139SALATI.txt', 'EMILIA ROMAGNA', 'EMR', 'SALATI E MONTEPIETRA s.r.l.'),
(140, 'p140SARDEG.txt', 'SARDEGNA', 'SAR', 'SARDEGNA AMBIENTE E COSTRUZIONI S.R.L.'),
(141, 'p141SCALAV.txt', 'TOSCANA', 'TOS', 'SCALA VIRGILIO & FIGLI S.P.A.'),
(142, 'p142SEAFSR.txt', 'EMILIA ROMAGNA', 'EMR', 'Seaf s.r.l.'),
(143, 'p143SOCSAP.txt', 'UMBRIA', 'UMB', 'SOC COOP LA STRADA DEI SAPORI'),
(144, 'p144SOFERS.txt', 'TOSCANA', 'TOS', 'SOFER SRL'),
(145, 'p145SORBOA.txt', 'UMBRIA', 'UMB', 'SORBO AUTOTRASPORTI SRL'),
(146, 'p146SPACCI.txt', 'UMBRIA', 'UMB', 'SPACCINI G E SEGOLONI M SNC'),
(147, 'p147STEROG.txt', 'UMBRIA', 'UMB', 'STEROGLASS s.r.l.'),
(148, 'p148TAMAGN.txt', 'UMBRIA', 'UMB', 'TAMAGNINI IMPIANTI S.R.L.'),
(149, 'p149TECNOS.txt', 'UMBRIA', 'UMB', 'TECNOSERVICE DI BEI RICCARDO'),
(150, 'p150TIEZZI.txt', 'TOSCANA', 'TOS', 'TIEZZI COSTRUZIONI EDILI SRL'),
(151, 'p151TINICE.txt', 'UMBRIA', 'UMB', 'TINI SNC COSTRUZIONI EDILI'),
(152, 'p152UMBRAS.txt', 'UMBRIA', 'UMB', 'UMBRA SCAVI SNC DI FORTINI E GIUGLIARELLI'),
(153, 'p153UMBRAQ.txt', 'UMBRIA', 'UMB', 'UMBRAQUADRI S.R.L'),
(154, 'p154UMBRIA.txt', 'UMBRIA', 'UMB', 'UMBRA LAVORI DI CASCIARI ANDREA'),
(155, 'p155VERCOS.txt', 'EMILIA ROMAGNA', 'EMR', 'VERCOS FRIGO S.r.l.'),
(156, 'p156VIELLE.txt', 'EMILIA ROMAGNA', 'EMR', 'VIELLE SCAVI E COSTRUZIONI s.r.l.'),
(157, 'p157VIRGIL.txt', 'UMBRIA', 'UMB', 'VIRGILI MARCO E GIULIANO SNC'),
(158, 'p158VITTOR.txt', 'ABRUZZO', 'ABR', 'VITTORINI EMIDIO COSTRUZIONI S.R.L.'),
(159, 'p159VOLPIS.txt', 'UMBRIA', 'UMB', 'VOLPI SRL'),
(160, 'p160ZINCAT.txt', 'EMILIA ROMAGNA', 'EMR', 'ZINCATURA LA GALVANICA SNC'),
(161, 'p161TECNOF.txt', 'EMILIA ROMAGNA', 'EMR', 'TECNOFORM SRL'),
(162, 'p162CAPALB.txt', 'EMILIA ROMAGNA', 'EMR', 'CAPANNA ALBERTO SRL'),
(163, 'p163SALFER.txt', 'EMILIA ROMAGNA', 'EMR', 'SALUMIFICIO FERRARI GIOVANNI SRL'),
(164, 'p164SIDACA.txt', 'EMILIA ROMAGNA', 'EMR', 'SIDA CARNI SRL');

-- --------------------------------------------------------

--
-- Table structure for table `projects_sc`
--

CREATE TABLE `projects_sc` (
  `ID` int(11) NOT NULL,
  `file` varchar(255) CHARACTER SET latin1 NOT NULL,
  `region_ex` varchar(255) CHARACTER SET latin1 NOT NULL,
  `region` varchar(255) CHARACTER SET latin1 NOT NULL,
  `proj` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects_sc`
--

INSERT INTO `projects_sc` (`ID`, `file`, `region_ex`, `region`, `proj`) VALUES
(151, 'wawawa.txt', 'LAZIO', 'LAZ', 'TINI SNC COSTRUZIONI EDILI'),
(152, 'p001ARPACEwe.txt', 'UMBRIA', 'UMB', 'UMBRA SCAVI SNC DI FORTINI E GIUGLIARELLI'),
(165, 'p001ARPA23s.txt', 'LAZIO', 'LAZ', 'LAZIO EDILIZIA S.P.A'),
(166, 'p001ARP34sas.txt', 'TOSCANA', 'TOS', 'GIOMI VINICOLA - IL POGGETTO');

-- --------------------------------------------------------

--
-- Table structure for table `screenshots`
--

CREATE TABLE `screenshots` (
  `ID` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `filename` varchar(50) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=903 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `dateBirth` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL DEFAULT '',
  `cf` varchar(16) NOT NULL DEFAULT '',
  `country` varchar(50) NOT NULL DEFAULT '',
  `cap` varchar(10) NOT NULL DEFAULT '',
  `prov` varchar(20) NOT NULL,
  `work` varchar(100) NOT NULL,
  `clickM` int(11) NOT NULL,
  `joinDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastSeen` timestamp NULL DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `code_assigned` int(11) NOT NULL DEFAULT '0',
  `code_received` int(11) NOT NULL DEFAULT '0',
  `screen_uploaded` int(11) NOT NULL DEFAULT '0',
  `cont_uploaded` int(11) NOT NULL DEFAULT '0',
  `recovery` varchar(100) DEFAULT NULL,
  `activation` varchar(16) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `region` char(2) NOT NULL,
  `winnerAgreement` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `clickmasters`
--
ALTER TABLE `clickmasters`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `not_mail`
--
ALTER TABLE `not_mail`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `projects_classic`
--
ALTER TABLE `projects_classic`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `projects_sc`
--
ALTER TABLE `projects_sc`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `screenshots`
--
ALTER TABLE `screenshots`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`),
  ADD KEY `clickM` (`clickM`),
  ADD KEY `name` (`name`),
  ADD KEY `surname` (`surname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `clickmasters`
--
ALTER TABLE `clickmasters`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=166;
--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=387;
--
-- AUTO_INCREMENT for table `mails`
--
ALTER TABLE `mails`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `not_mail`
--
ALTER TABLE `not_mail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects_classic`
--
ALTER TABLE `projects_classic`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT for table `projects_sc`
--
ALTER TABLE `projects_sc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=167;
--
-- AUTO_INCREMENT for table `screenshots`
--
ALTER TABLE `screenshots`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=903;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
