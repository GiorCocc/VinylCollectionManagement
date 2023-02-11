-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 11, 2023 alle 16:16
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myvinylcollection`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `artists`
--

INSERT INTO `artists` (`id`, `name`) VALUES
(1, 'Pink Floyd'),
(2, 'Muse'),
(3, 'Dope lemon'),
(4, 'Porcupine tree'),
(5, 'Pearl jam'),
(6, ''),
(7, 'Mike Oldfield'),
(8, 'Queen'),
(9, 'The animals'),
(10, 'Arctic monkeys'),
(11, 'Black sabbath'),
(12, 'David Bowie'),
(13, 'Dio'),
(14, 'Dire straits'),
(15, 'Eagles'),
(16, 'Francesco de Gregori'),
(17, 'Funkadelic'),
(18, 'Kiss'),
(19, 'Led zeppelin'),
(20, 'Lucio Battisti'),
(21, 'Matthew Bellamy'),
(22, 'Phil collins'),
(23, 'Rammstein'),
(24, 'The rolling stones'),
(25, 'The smiths'),
(26, 'Opus Kink'),
(27, 'Ernia');

-- --------------------------------------------------------

--
-- Struttura della tabella `labels`
--

CREATE TABLE `labels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `labels`
--

INSERT INTO `labels` (`id`, `name`) VALUES
(1, 'EMI'),
(2, 'Warner'),
(3, 'Indipendent'),
(4, 'Transmission'),
(5, 'Epic/associated'),
(7, 'Sony'),
(8, 'Pink Floyd Recordings'),
(9, 'Virgin music'),
(10, 'Domino'),
(11, 'Vertigo'),
(12, 'Parlophone'),
(13, 'BMG'),
(14, 'Asylum'),
(15, 'RCA'),
(16, 'Westbound records'),
(17, 'Mercury'),
(18, 'Atlantic'),
(19, 'Numero uno'),
(20, 'Globalist'),
(21, 'Tommy Boy'),
(22, 'WEA'),
(23, 'Harvest'),
(24, 'Music for nations'),
(25, 'Universal'),
(26, 'Decca'),
(27, 'Nice Swam'),
(28, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` int(11) NOT NULL,
  `label` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `insert_date` datetime DEFAULT current_timestamp(),
  `vinyl_condition` varchar(3) DEFAULT NULL,
  `sleeve_condition` varchar(3) DEFAULT NULL,
  `format` int(2) DEFAULT NULL,
  `speed` int(2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `genre` varchar(256) NOT NULL,
  `numberOfSongs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `records`
--

INSERT INTO `records` (`id`, `title`, `artist`, `label`, `year`, `insert_date`, `vinyl_condition`, `sleeve_condition`, `format`, `speed`, `notes`, `genre`, `numberOfSongs`) VALUES
(20, 'Ten', 5, 7, 1991, '2023-02-03 16:38:21', '2', '1', 1, 1, '', 'Rock', 11),
(21, 'The final cut', 1, 8, 1983, '2023-02-04 11:37:15', '1', '1', 1, 1, '2016 Reissue', 'Rock', 13),
(22, 'Wish You Were Here', 1, 8, 1975, '2023-02-04 11:45:12', '1', '1', 1, 1, '2016 Reissue', 'Rock', 5),
(23, 'Voyage 34: the complete trip', 4, 4, 1992, '2023-02-04 11:51:02', '1', '1', 1, 1, 'Edizione in vinile dell\'edizione in cd originale del 1992 rimasterizzata nel 2010', 'Rock psicadelico', 4),
(24, 'Tubular bells', 7, 9, 1973, '2023-02-04 11:57:20', '2', '4', 1, 1, '', 'Prog', 2),
(25, 'Origin of symmetry (XX anniversary remixx)', 2, 2, 2021, '2023-02-04 12:00:52', '1', '2', 1, 1, 'Edizione rimasterizzata e remix dell\'originale del 2001 con traccia \"Futurism\" non presente nell\'edizione originale', 'Rock', 12),
(26, 'Will of the people', 2, 2, 2022, '2023-02-08 09:20:38', '1', '2', 1, 1, 'Edizione limitata gatefold red+black marble', 'Rock', 10),
(27, 'Drones', 2, 2, 2015, '2023-02-08 11:53:41', '1', '2', 1, 1, '', 'Rock', 12),
(28, 'The Platinum Collection', 8, 1, 2022, '2023-02-08 12:01:28', '1', '1', 1, 1, '', 'Pop', 51),
(29, 'House of the rising sun', 9, 1, 1970, '2023-02-08 12:08:47', '4', '4', 1, 1, '', 'Blues', 12),
(30, 'Live at the royal albert hall', 10, 10, 2020, '2023-02-08 12:09:42', '1', '1', 1, 1, '', 'Indie Rock', 20),
(31, 'Heaven and hell', 11, 11, 1980, '2023-02-08 12:10:22', '3', '4', 1, 1, '', 'Hardo rock', 8),
(32, 'The Rise And Fall Of Ziggy Stardust And The Spiders From Mars', 12, 12, 2020, '2023-02-08 12:11:28', '1', '2', 1, 1, '', 'Glam', 11),
(33, 'Dream evil', 13, 11, 1987, '2023-02-08 12:13:27', '3', '4', 1, 1, '', 'Metal', 9),
(34, 'On every street', 14, 2, 1991, '2023-02-08 12:14:05', '3', '4', 1, 1, '', 'Rock', 12),
(35, 'Smooth Big Cat', 3, 13, 2019, '2023-02-08 12:14:56', '1', '1', 1, 1, 'Picture Disc', 'Rock Psicadelico', 10),
(36, 'The Long Run', 15, 14, 1979, '2023-02-08 12:15:46', '3', '4', 1, 1, '', 'Rock', 10),
(37, 'Rimmel', 16, 15, 1975, '2023-02-08 12:16:25', '3', '4', 1, 1, '', 'Rock', 9),
(38, 'Maggot brain', 17, 16, 1971, '2023-02-08 12:17:37', '1', '1', 1, 1, '', 'Funk', 7),
(39, 'Crazy nights', 18, 17, 1987, '2023-02-08 12:18:09', '3', '4', 1, 1, '', 'Rock', 11),
(40, 'Led zeppelin II', 19, 18, 0, '2023-02-08 12:19:48', '3', '3', 1, 1, '', 'Rock', 9),
(41, 'Led zeppelin IV', 19, 18, 1983, '2023-02-08 12:20:16', '3', '3', 1, 1, '', 'Rock', 8),
(42, 'Il mio canto libero', 20, 19, 1972, '2023-02-08 12:21:06', '4', '4', 1, 1, '', 'Pop', 8),
(43, 'Il nostro caro angelo', 20, 19, 1973, '2023-02-08 12:21:32', '3', '3', 1, 1, '', 'Pop', 8),
(44, 'Cryosleep', 21, 20, 2021, '2023-02-08 12:22:14', '1', '1', 1, 1, '', 'Elettronica', 10),
(45, 'Simulation Theory Live', 2, 21, 2020, '2023-02-08 12:23:19', '3', '1', 1, 1, '', 'Live', 9),
(46, 'Hello, I Must Be Going', 22, 22, 1982, '2023-02-08 12:24:33', '3', '3', 1, 1, '', 'Jazz', 10),
(48, 'The Dark Side Of The Moon', 1, 23, 1973, '2023-02-08 12:26:10', '3', '3', 1, 1, '', 'Rock', 10),
(49, 'The Division Bell', 1, 1, 1994, '2023-02-08 12:26:34', '2', '2', 1, 1, '', 'Rock', 11),
(50, 'The Wall', 1, 23, 1977, '2023-02-08 12:27:08', '3', '4', 1, 1, '', 'Rock', 26),
(51, 'Closure / continuation', 4, 24, 2022, '2023-02-08 12:27:45', '1', '1', 1, 1, 'Edizione speciale con due vinili bianchi', 'Prog', 7),
(52, 'Deadwing', 4, 4, 2005, '2023-02-08 12:28:11', '1', '1', 1, 1, '', 'Prog', 11),
(53, 'RAMMSTEIN', 23, 25, 2019, '2023-02-08 12:28:57', '1', '1', 1, 1, '', 'Metal', 11),
(54, 'Big Hits (High Tide and Green Grass)', 24, 26, 1966, '2023-02-08 12:30:02', '5', '4', 1, 1, 'Segni di carta incollata al disco rendono la riproduzione di due tracce (una per lato) impossibile. NON RIPRODURRE', 'Rock', 14),
(55, 'The Queen Is Dead', 25, 2, 1985, '2023-02-08 12:30:42', '1', '1', 1, 1, '', 'Pop', 10),
(57, 'Animals (2018 Remix)', 1, 8, 2022, '2023-02-08 14:37:07', '1', '1', 1, 1, '', 'Rock', 5),
(61, '\'Til The Stream Runs Dry', 26, 27, 2022, '2023-02-10 12:35:27', '1', '1', 1, 1, '', 'Garage', 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` int(11) NOT NULL,
  `duration` varchar(11) DEFAULT NULL,
  `records` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist`, `duration`, `records`) VALUES
(5, 'Once', 5, '9:3:51', 20),
(16, 'The Post War Dream', 1, '3:00', 21),
(17, 'Your Possible Pasts', 1, '4:26', 21),
(18, 'One of the Few', 1, '1:11', 21),
(19, 'When the Tigers Broke Free', 1, '3:16', 21),
(20, 'The Hero\'s Return', 1, '2:43', 21),
(21, 'The Gunner\'s Dream', 1, '5:18', 21),
(22, 'Paranoid Eyes', 1, '3:41', 21),
(23, 'Get Your Filthy Hands Off My Desert', 1, '1:17', 21),
(24, 'The Fletcher Memorial Home', 1, '4:12', 21),
(25, 'Southampton Dock', 1, '2:10', 21),
(26, 'The Final Cut', 1, '4:45', 21),
(27, 'Not Now John', 1, '4:56', 21),
(28, 'Two Suns in the Sunset', 1, '5:23', 21),
(34, 'Voyage 34: phase I', 4, '12:54', 23),
(35, 'Voyage 34: phase II', 4, '17:30', 23),
(36, 'Voyage 34: phase III', 4, '19:28', 23),
(37, 'Voyage 34: phase IV', 4, '19:42', 23),
(52, 'Will Of The People', 2, '3:18', 26),
(53, 'Compliance', 2, '4:10', 26),
(54, 'Liberation', 2, '3:06', 26),
(55, 'Won’t Stand Down', 2, '3:29', 26),
(56, 'Ghosts (How Can I Move On)', 2, '3:36', 26),
(57, 'You Make Me Feel Like It’s Halloween', 2, '3:00', 26),
(58, 'Kill Or Be Killed', 2, '5:00', 26),
(59, 'Verona', 2, '4:56', 26),
(60, 'Euphoria', 2, '3:23', 26),
(61, 'We Are Fucking Fucked', 2, '3:36', 26),
(69, 'New born', 2, '', 25),
(70, 'Bliss', 2, '', 25),
(72, 'Space dementia', 2, '', 25),
(73, 'Hyper music', 2, '', 25),
(74, 'Plug in baby', 2, '', 25),
(75, 'Pigs on the wing 1', 1, '1:25', 57),
(76, 'Dogs', 1, '17:08', 57),
(77, 'Pigs (Three Different Ones)', 1, '11:28', 57),
(78, 'Sheep', 1, '10:20', 57),
(80, 'Pigs on the wing 2', 1, '1:25', 57),
(97, 'Harridan', 4, '8:09', 51),
(98, 'Of the new day', 4, '4:43', 51),
(99, 'Rats return', 4, '5:40', 51),
(100, 'Dignity', 4, '8:21', 51),
(101, 'Herd culling', 4, '7:02', 51),
(102, 'Walk the plank', 4, '4:26', 51),
(103, 'Chimera\'s wreck', 4, '9:40', 51),
(106, 'Side 1', 7, '25:00', 24),
(107, 'Side 2', 7, '17:30', 24),
(108, 'Have you seen your mother standing in the shadow?', 24, '', 54),
(109, 'Paint it, black', 24, '', 54),
(110, 'It\'s all over now', 24, '', 54),
(111, 'The last time', 24, '', 54),
(112, 'Heart of stone', 24, '', 54),
(113, 'Not fade away', 24, '', 54),
(114, 'Come on', 24, '', 54),
(115, '(I can\'t get no) satisfaction', 24, '', 54),
(116, 'Get off of my cloud', 24, '', 54),
(117, 'As tears go by', 24, '', 54),
(118, '19th. nervous breakdown', 24, '', 54),
(119, 'Lady Jane', 24, '', 54),
(120, 'Time is on my side', 24, '', 54),
(121, 'Little red rooster', 24, '', 54),
(122, 'crazy crazy nights', 18, '', 39),
(123, 'i\'ll fight hell to hold you', 18, '', 39),
(124, 'bang bang you', 18, '', 39),
(125, 'no, no, no', 18, '', 39),
(126, 'hell or high water', 18, '', 39),
(127, 'my way', 18, '', 39),
(128, 'when your walls come down', 18, '', 39),
(129, 'reason to live', 18, '', 39),
(130, 'good girl gone bad', 18, '', 39),
(131, 'turn on the night', 18, '', 39),
(132, 'thief in the night', 18, '', 39),
(133, 'unintended (acoustic)', 21, '', 44),
(134, 'bridge over the troubled water', 21, '', 44),
(135, 'behold, the glove', 21, '', 44),
(136, 'take a bow (four hands piano)', 21, '', 44),
(137, 'pray', 21, '', 44),
(138, 'tomorrow\'s world', 21, '', 44),
(139, 'guiding light (on Jeff\'s guitar)', 21, '', 44),
(140, 'simulation theory theme (instrumental)', 21, '', 44),
(141, 'fever', 21, '', 44),
(142, 'unintended (piano lullaby)', 21, '', 44),
(143, 'deadwing', 4, '', 52),
(144, 'shallow', 4, '', 52),
(145, 'Lazarus', 4, '', 52),
(146, 'halo', 4, '', 52),
(147, 'arriving somewhere but not here', 4, '', 52),
(148, 'mellotron scratch', 4, '', 52),
(149, 'open car', 4, '', 52),
(150, 'start of something beautiful', 4, '', 52),
(151, 'glass arm shattering', 4, '', 52),
(152, 'so called friend', 4, '', 52),
(153, 'half-light', 4, '', 52),
(154, 'night people', 13, '', 33),
(155, 'dream evil', 13, '', 33),
(156, 'sunset superman', 13, '', 33),
(157, 'all the fools sailed away', 13, '', 33),
(158, 'naked in the rain', 13, '', 33),
(159, 'overlove', 13, '', 33),
(160, 'i could have been a dreamer', 13, '', 33),
(161, 'faces in the window', 13, '', 33),
(162, 'when a woman cries', 13, '', 33),
(163, 'Dead inside', 2, '', 27),
(164, '(drill sergeant)', 2, '', 27),
(165, 'psycho', 2, '', 27),
(166, 'mercy', 2, '', 27),
(167, 'reapers', 2, '', 27),
(168, 'the handler', 2, '', 27),
(169, '(JFK)', 2, '', 27),
(170, 'defector', 2, '', 27),
(171, 'revolt', 2, '', 27),
(172, 'aftermath', 2, '', 27),
(173, 'the globalist', 2, '', 27),
(174, 'drones', 2, '', 27),
(175, 'neon knights', 11, '', 31),
(176, 'children of the sea', 11, '', 31),
(177, 'lady evil', 11, '', 31),
(178, 'heaven and hell', 11, '', 31),
(179, 'wishing well', 11, '', 31),
(180, 'die young', 11, '', 31),
(181, 'walk away', 11, '', 31),
(182, 'lonely is the world', 11, '', 31),
(183, 'i don\'t care anymore', 22, '', 46),
(184, 'i cannot believe it\'s time', 22, '', 46),
(185, 'like china', 22, '', 46),
(186, 'do you know, do you care?', 22, '', 46),
(187, 'you can\'t hurry love', 22, '', 46),
(188, 'it don\'t matter to me', 22, '', 46),
(189, 'thru house walls', 22, '', 46),
(190, 'don\'t let him steal your heart away', 22, '', 46),
(191, 'the west side', 22, '', 46),
(192, 'why can\'t it wait \'til morning', 22, '', 46),
(193, 'I\'m crying', 9, '', 29),
(194, 'house of the rising sun', 9, '', 29),
(195, 'boom boom', 9, '', 29),
(196, 'i\'m mad again', 9, '', 29),
(197, 'bring it on home to me', 9, '', 29),
(198, 'we\'ve gotta get out of this place', 9, '', 29),
(199, 'story of bo diddley', 9, '', 29),
(200, 'how you\'ve changed', 9, '', 29),
(201, 'bright lights big city', 9, '', 29),
(202, 'roadrunner', 9, '', 29),
(203, 'worried life blues', 9, '', 29),
(204, 'it\'s my life', 9, '', 29),
(205, 'la luce dell\'est', 20, '', 42),
(206, 'luci - ah', 20, '', 42),
(207, 'l\'acquila', 20, '', 42),
(208, 'vento nel vento', 20, '', 42),
(209, 'confusione', 20, '', 42),
(210, 'io vorrei... non vorrei... ma se vuoi', 20, '', 42),
(211, 'gente per bene e gente per male', 20, '', 42),
(212, 'il mio canto libero', 20, '', 42),
(213, 'la collina dei ciliegi', 20, '4:54', 43),
(214, 'ma è un canto brasileiro', 20, '5:17', 43),
(215, 'la canzone della terra', 20, '5:30', 43),
(216, 'il nostro caro angelo', 20, '4:29', 43),
(217, 'le allettanti promesse', 20, '5:08', 43),
(218, 'io gli ho detto no', 20, '4:20', 43),
(219, 'prendi fra le mani la testa', 20, '3:52', 43),
(220, 'questo inferno rosa', 20, '6:50', 43),
(221, 'Whole lotta love', 19, '5:33', 40),
(222, 'what is and what should never be', 19, '4:47', 40),
(223, 'the lemon song', 19, '6:20', 40),
(224, 'thank you', 19, '3:50', 40),
(225, 'heartbreaker', 19, '4:15', 40),
(226, 'living loving maid (she\'s just a woman)', 19, '2:40', 40),
(227, 'ramble on', 19, '4:35', 40),
(228, 'moby dick', 19, '4:25', 40),
(229, 'bring it on home', 19, '4:19', 40),
(230, 'black dog', 19, '', 41),
(231, 'rock and roll', 19, '', 41),
(232, 'the battle of evermore', 19, '', 41),
(233, 'stairway to heaven', 19, '', 41),
(234, 'misty mountain hop', 19, '', 41),
(235, 'four sticks', 19, '', 41),
(236, 'going to california', 19, '', 41),
(237, 'when the levee breaks', 19, '', 41),
(238, 'four out of five', 10, '', 30),
(239, 'brainstorm', 10, '', 30),
(240, 'crying lightning', 10, '', 30),
(241, 'do i wanna know?', 10, '', 30),
(242, 'why\'d you only call me when you\'re high?', 10, '', 30),
(243, '505', 10, '', 30),
(244, 'one point perspective', 10, '', 30),
(245, 'do me a favour', 10, '', 30),
(246, 'cornerstone', 10, '', 30),
(247, 'knee socks', 10, '', 30),
(248, 'arabella', 10, '', 30),
(249, 'tranquility base hotel + casino', 10, '', 30),
(250, 'she looks like fun', 10, '', 30),
(251, 'from the ritz to the rubble', 10, '', 30),
(252, 'pretty visitors', 10, '', 30),
(253, 'don\'t sit down \'cause I\'ve moved the chair', 10, '', 30),
(254, 'i bet you looks good on the dancefloor', 10, '', 30),
(255, 'star treatment', 10, '', 30),
(256, 'the view from the afternoon', 10, '', 30),
(257, 'r u mine?', 10, '', 30),
(258, 'maggot brain', 17, '10:04', 38),
(259, 'can you get to that', 17, '2:44', 38),
(260, 'hit it and quit it', 17, '3:41', 38),
(261, 'you and your folks, me and my folks', 17, '3:27', 38),
(262, 'super stupid', 17, '3:53', 38),
(263, 'back in our minds', 17, '2:35', 38),
(264, 'wars of Armageddon', 17, '9:27', 38),
(265, 'calling elvis', 14, '6:24', 34),
(266, 'on every street', 14, '5:01', 34),
(267, 'when it comes to you', 14, '4:59', 34),
(268, 'fade to black', 14, '3:48', 34),
(269, 'the bug', 14, '4:15', 34),
(270, 'you and your friend', 14, '5:57', 34),
(271, 'heavy fuel', 14, '4:55', 34),
(272, 'iron hand', 14, '3:08', 34),
(273, 'ticket to heaven', 14, '4:24', 34),
(274, 'my parties', 14, '5:30', 34),
(275, 'planet fo new orleans', 14, '7:45', 34),
(276, 'how long', 14, '3:49', 34),
(277, 'Citizen erased', 2, '', 25),
(278, 'Micro cuts', 2, '', 25),
(279, 'Screenager', 2, '', 25),
(280, 'Darkshines', 2, '', 25),
(281, 'Feeling good', 2, '', 25),
(282, 'Futurism', 2, '', 25),
(283, 'Megalomania', 2, '', 25),
(284, 'Deutschland', 23, '', 53),
(285, 'radio', 23, '', 53),
(286, 'zeig dich', 23, '', 53),
(287, 'ausländer', 23, '', 53),
(288, 'sex', 23, '', 53),
(289, 'puppe', 23, '', 53),
(290, 'was ich liebe', 23, '', 53),
(291, 'diamant', 23, '', 53),
(292, 'weit weg', 23, '', 53),
(293, 'tattoo', 23, '', 53),
(294, 'hallomann', 23, '', 53),
(295, 'into the stream', 26, '', 61),
(296, 'i love you baby', 26, '', 61),
(297, 'dog stay down', 26, '', 61),
(298, 'st.paul of the tarantulas', 26, '', 61),
(299, '(i\'m going down to that) hole in the ground', 26, '', 61),
(300, 'the unrepentant soldier', 26, '', 61),
(301, '\'til the stream runs dry', 26, '', 61),
(311, 'Rimmel', 16, '3:42', 37),
(312, 'Pezzi Di Vetro', 16, '3:10', 37),
(313, 'Il Signor Hood', 16, '3:13', 37),
(314, 'Pablo', 16, '4:24', 37),
(315, 'Buonanotte Fiorellino', 16, '2:06', 37),
(316, 'Le Storie Di Ieri', 16, '4:10', 37),
(317, 'Quattro Cani', 16, '3:18', 37),
(318, 'Piccola Mela', 16, '2:47', 37),
(319, 'Piano Bar', 16, '2:42', 37),
(320, 'Algorithm (Alternate Reality Version)', 2, '', 45),
(321, 'Pressure (Film Edit)', 2, '', 45),
(322, 'Break It To Me', 2, '', 45),
(323, 'The Dark Side', 2, '', 45),
(324, 'Thought Contagion', 2, '', 45),
(325, 'Dig Down (Acoustic Gospel Version)', 2, '', 45),
(326, 'Propaganda (Acoustic Version)', 2, '', 45),
(327, 'Algorithm', 2, '', 45),
(328, 'Metal Medley', 2, '', 45),
(329, 'Hey You', 3, '4:38', 35),
(330, 'Salt & Pepper', 3, '5:28', 35),
(331, 'Hey Little Baby', 3, '5:17', 35),
(332, 'Lonely Boys Paradise', 3, '5:05', 35),
(333, 'Give Me Honey', 3, '3:38', 35),
(334, 'Dope & Smoke', 3, '5:04', 35),
(335, 'Smooth Big Cat', 3, '4:33', 35),
(336, 'The Midnight Slow', 3, '3:24', 35),
(337, 'Mechanical Bull', 3, '3:44', 35),
(338, 'Hey Man Don\'t Look At Me Like That	', 3, '5:28', 35),
(339, 'Even Flow', 5, '4:53', 20),
(340, 'Alive', 5, '5:40', 20),
(341, 'Why Go', 5, '3:19', 20),
(342, 'Black', 5, '5:43', 20),
(343, 'Jeremy', 5, '5:18', 20),
(344, 'Oceans', 5, '2:41', 20),
(345, 'Porch', 5, '3:30', 20),
(346, 'Garden', 5, '4:59', 20),
(347, 'Deep', 5, '4:18', 20),
(348, 'Release', 5, '9:05', 20),
(349, 'Speak To Me', 1, '1:10', 48),
(350, 'Breathe', 1, '2:48', 48),
(351, 'On The Run', 1, '3:36', 48),
(352, 'Time', 1, '7:01', 48),
(353, 'The Great Gig In The Sky', 1, '4:36', 48),
(354, 'Money', 1, '6:22', 48),
(355, 'Us And Them', 1, '7:46', 48),
(356, 'Any Colour You Like', 1, '3:25', 48),
(357, 'Brain Damage', 1, '3:48', 48),
(358, 'Eclipse', 1, '2:03', 48),
(359, 'Cluster One', 1, '', 49),
(360, 'What Do You Want From Me', 1, '', 49),
(361, 'Poles Apart', 1, '', 49),
(362, 'Marooned', 1, '', 49),
(363, 'A Great Day For Freedom', 1, '', 49),
(364, 'Wearing The Inside Out', 1, '', 49),
(365, 'Take It Back', 1, '', 49),
(366, 'Coming Back To Life', 1, '', 49),
(367, 'Keep Talking', 1, '', 49),
(368, 'Lost For Words', 1, '', 49),
(369, 'High Hopes', 1, '', 49),
(370, 'The Long Run', 15, '3:42', 36),
(371, 'I Can\'t Tell You Why', 15, '4:56', 36),
(372, 'In The City', 15, '3:46', 36),
(373, 'The Disco Strangler', 15, '2:46', 36),
(374, 'King Of Hollywood', 15, '6:28', 36),
(375, 'Heartache Tonight', 15, '4:26', 36),
(376, 'Those Shoes', 15, '4:56', 36),
(377, 'Teenage Jail', 15, '3:44', 36),
(378, 'The Greeks Don\'t Want No Freaks', 15, '2:20', 36),
(379, 'The Sad Café', 15, '5:25', 36),
(380, 'Bohemian Rhapsody', 8, '5:54', 28),
(381, 'Another One Bites The Dust', 8, '3:36', 28),
(382, 'Killer Queen', 8, '2:59', 28),
(383, 'Fat Bottomed Girls', 8, '3:21', 28),
(384, 'Bicycle Race', 8, '3:02', 28),
(385, 'You\'re My Best Friend', 8, '2:51', 28),
(386, 'Don\'t Stop Me Now', 8, '3:29', 28),
(387, 'Save Me', 8, '3:48', 28),
(388, 'Crazy Little Thing Called Love', 8, '2:43', 28),
(389, 'Somebody To Love', 8, '4:55', 28),
(390, 'Now I\'m Here', 8, '4:13', 28),
(391, 'Good Old-Fashioned Lover Boy', 8, '2:54', 28),
(392, 'Play The Game', 8, '3:31', 28),
(393, 'Flash', 8, '2:47', 28),
(394, 'Seven Seas Of Rhye', 8, '2:48', 28),
(395, 'We Will Rock You', 8, '2:01', 28),
(396, 'We Are The Champions', 8, '2:59', 28),
(397, 'A Kind Of Magic', 8, '4:24', 28),
(398, 'Under Pressure (feat. David Bowie)', 8, '3:56', 28),
(399, 'Radio Ga Ga', 8, '5:48', 28),
(400, 'I Want It All', 8, '4:01', 28),
(401, 'I Want To Break Free', 8, '4:18', 28),
(402, 'Innuendo', 8, '6:31', 28),
(403, 'It\'s A Hard Life', 8, '4:09', 28),
(404, 'Breakthru', 8, '4:08', 28),
(405, 'Who Wants To Live Forever', 8, '4:56', 28),
(406, 'Headlong', 8, '4:33', 28),
(407, 'The Miracle', 8, '5:01', 28),
(408, 'I\'m Going Slightly Mad', 8, '4:07', 28),
(409, 'The Invisible Man', 8, '3:55', 28),
(410, 'Hammer To Fall', 8, '3:40', 28),
(411, 'Friends Will Be Friends', 8, '4:07', 28),
(412, 'The Show Must Go On', 8, '4:35', 28),
(413, 'One Vision', 8, '4:02', 28),
(414, 'The Show Must Go On (feat. Elton John)', 8, '4:35', 28),
(415, 'Under Pressure (feat. David Bowie) (Rah Mix)', 8, '4:08', 28),
(416, 'Barcelona (by Freddie Mercury Feat. Montserrant Caballè)', 8, '4:26', 28),
(417, 'Too Much Love Will Kill You', 8, '4:20', 28),
(418, 'Somebody To (feat. George Michael) Love', 8, '5:17', 28),
(419, 'You Don\'t Fool Me', 8, '5:24', 28),
(420, 'Heaven For Everyone', 8, '4:43', 28),
(421, 'Las Palabras De Amor', 8, '4:31', 28),
(422, 'Driven By You (by Brian May)', 8, '4:11', 28),
(423, 'Living On My Own (by Freddie Mercury)', 8, '3:38', 28),
(424, 'Let Me Live', 8, '4:45', 28),
(425, 'The Great Pretender (by Freddie Mercury)', 8, '3:28', 28),
(426, 'Princes Of The Universe', 8, '3:32', 28),
(427, 'Another One Bites The Dust (feat. Wyclef Jean)', 8, '4:20', 28),
(428, 'No-One But You (Only The Good Die Young)', 8, '4:13', 28),
(429, 'These Are The Days Of Our Lives', 8, '4:15', 28),
(430, 'Thank God It\'s Christmas', 8, '4:19', 28),
(431, 'The Queen Is Dead (Take Me Back To Dear Old Blighty)', 25, '6:23', 55),
(432, 'Frankly, Mr. Shankly', 25, '2:17', 55),
(433, 'I Know It\'s Over	', 25, '5:48', 55),
(434, 'Never Had No One Ever	', 25, '3:36', 55),
(435, 'Cemetry Gates', 25, '2:39', 55),
(436, 'Bigmouth Strikes Again', 25, '3:12', 55),
(437, 'The Boy With The Thorn In His Side', 25, '3:15', 55),
(438, 'Vicar In A Tutu', 25, '2:21', 55),
(439, 'There Is A Light That Never Goes Out', 25, '4:02', 55),
(440, 'Some Girls Are Bigger Than Others', 25, '3:14', 55),
(441, 'Five Years', 12, '4:42', 32),
(442, 'Soul Love', 12, '3:34', 32),
(443, 'Moonage Daydream', 12, '4:40', 32),
(444, 'Starman', 12, '4:10', 32),
(445, 'It Ain\'t Easy	', 12, '2:58', 32),
(446, 'Lady Stardust', 12, '3:22', 32),
(447, 'Star', 12, '2:47', 32),
(448, 'Hang On To Yourself', 12, '2:40', 32),
(449, 'Ziggy Stardust', 12, '3:13', 32),
(450, 'Suffragette City', 12, '3:25', 32),
(451, 'Rock \'N\' Roll Suicide', 12, '2:58', 32),
(452, 'In The Flesh?', 1, '', 50),
(453, 'The Thin Ice', 1, '', 50),
(454, 'Another Brick In The Wall Part 1', 1, '', 50),
(455, 'The Happiest Days Of Our Lives', 1, '', 50),
(456, 'Another Brick In The Wall Part 2', 1, '', 50),
(457, 'Mother', 1, '', 50),
(458, 'Goodbye Blue Sky', 1, '', 50),
(459, 'Empty Spaces', 1, '', 50),
(460, 'Young Lust', 1, '', 50),
(461, 'One Of My Turns', 1, '', 50),
(462, 'Don\'t Leave Me Now', 1, '', 50),
(463, 'Another Brick In The Wall Part 3', 1, '', 50),
(464, 'Goodbye Cruel World', 1, '', 50),
(465, 'Hey You', 1, '', 50),
(466, 'Is There Anybody Out There?', 1, '', 50),
(467, 'Nobody Home', 1, '', 50),
(468, 'Vera', 1, '', 50),
(469, 'Bring The Boys Back Home', 1, '', 50),
(470, 'Comfortably Numb', 1, '', 50),
(471, 'The Show Must Go On', 1, '', 50),
(472, 'In The Flesh', 1, '', 50),
(473, 'Run Like Hell', 1, '', 50),
(474, 'Waiting For The Worms', 1, '', 50),
(475, 'Stop', 1, '', 50),
(476, 'The Trial', 1, '', 50),
(477, 'Outside The Wall', 1, '', 50),
(478, 'Shine On You Crazy Diamond (1 - 5)', 1, '13:34', 22),
(479, 'Welcome To The Machine', 1, '4:53', 22),
(480, 'Have A Cigar', 1, '5:40', 22),
(481, 'Wish You Were Here', 1, '5:34', 22),
(482, 'Shine On Your Crazy Diamond (parts 6-9)', 1, '12:31', 22);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artist` (`artist`),
  ADD KEY `label` (`label`);

--
-- Indici per le tabelle `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artist` (`artist`),
  ADD KEY `records` (`records`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT per la tabella `labels`
--
ALTER TABLE `labels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT per la tabella `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT per la tabella `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=483;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_ibfk_1` FOREIGN KEY (`artist`) REFERENCES `artists` (`id`),
  ADD CONSTRAINT `records_ibfk_2` FOREIGN KEY (`label`) REFERENCES `labels` (`id`);

--
-- Limiti per la tabella `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`artist`) REFERENCES `artists` (`id`),
  ADD CONSTRAINT `songs_ibfk_2` FOREIGN KEY (`records`) REFERENCES `records` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
