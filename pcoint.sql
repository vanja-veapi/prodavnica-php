-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2021 at 04:54 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id17012774_pcoint`
--

-- --------------------------------------------------------

--
-- Table structure for table `boje`
--

CREATE TABLE `boje` (
  `idBoja` int(11) NOT NULL,
  `boja` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `boje`
--

INSERT INTO `boje` (`idBoja`, `boja`) VALUES
(1, 'Bela'),
(2, 'Crna'),
(3, 'Crvena'),
(5, 'Plava'),
(4, 'Siva');

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `idKategorije` int(11) NOT NULL,
  `naziv` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`idKategorije`, `naziv`) VALUES
(1, 'Desktop'),
(2, 'Laptop'),
(3, 'Gaming'),
(4, 'Office');

-- --------------------------------------------------------

--
-- Table structure for table `kategorije_proizvodi`
--

CREATE TABLE `kategorije_proizvodi` (
  `idKategorijeProizvodi` int(11) NOT NULL,
  `idProizvod` int(11) NOT NULL,
  `idKategorije` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategorije_proizvodi`
--

INSERT INTO `kategorije_proizvodi` (`idKategorijeProizvodi`, `idProizvod`, `idKategorije`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 2),
(4, 3, 4),
(5, 4, 2),
(6, 4, 4),
(7, 8, 1),
(8, 3, 1),
(9, 5, 3),
(10, 6, 2),
(11, 7, 2),
(12, 9, 2),
(13, 9, 4),
(14, 10, 2),
(15, 10, 3),
(16, 11, 2),
(17, 12, 2),
(18, 13, 2),
(19, 14, 2),
(20, 15, 2),
(21, 17, 1),
(22, 17, 3),
(23, 16, 1),
(24, 16, 3);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `idKorisnik` int(11) NOT NULL,
  `ime` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `idUloga` int(11) NOT NULL,
  `idPol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`idKorisnik`, `ime`, `prezime`, `mail`, `lozinka`, `datum`, `idUloga`, `idPol`) VALUES
(1, 'Pera', 'Peric', 'pera@gmail.com', 'bf676ed1364b5857fba69b5623c81b64', '2021-06-06 16:23:45', 1, 1),
(4, 'Mika', 'Mikic', 'mika@gmail.com', 'e471a891c22fb1b5b722f57bed71de32', '2021-06-06 16:26:57', 2, 2),
(5, 'Laza', 'Lazic', 'laza@gmail.com', '973902af2b44887ff2f2c6854bf5cf9d', '2021-06-06 16:30:55', 2, 1),
(17, 'Misko', 'Miskic', 'misko@gmail.com', 'a6f606f232ccf854b1e7723dfccab32f', '2021-06-10 08:30:17', 2, 1),
(19, 'Uros', 'Urosevic', 'uros@gmail.com', '8a8446b60bb8a078ed67f9e5f65c3a07', '2021-06-10 08:32:52', 2, 1),
(20, 'Zorana', 'Zoranovic', 'zorana@gmail.com', '0330fe45ee9252d7e1e388847171f3ea', '2021-06-10 08:37:06', 2, 2),
(21, 'Milena', 'Milenic', 'milena@gmail.com', '9fea42299fa6fc042f87e03084a0b5f9', '2021-06-10 08:39:04', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `korpa`
--

CREATE TABLE `korpa` (
  `idKorpa` int(11) NOT NULL,
  `idKorisnik` int(11) NOT NULL,
  `izvrseno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korpa`
--

INSERT INTO `korpa` (`idKorpa`, `idKorisnik`, `izvrseno`) VALUES
(4, 4, 0),
(5, 5, 1),
(6, 1, 1),
(7, 1, 0),
(8, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `narudzbina`
--

CREATE TABLE `narudzbina` (
  `idNarudzbina` int(11) NOT NULL,
  `idKorpa` int(11) NOT NULL,
  `idProizvod` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `datum` datetime NOT NULL DEFAULT current_timestamp(),
  `poslato` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `narudzbina`
--

INSERT INTO `narudzbina` (`idNarudzbina`, `idKorpa`, `idProizvod`, `kolicina`, `datum`, `poslato`) VALUES
(16, 4, 14, 2, '2021-06-14 09:43:49', 'Ne'),
(17, 4, 11, 1, '2021-06-14 09:44:11', 'Ne'),
(18, 5, 4, 3, '2021-06-14 09:46:10', 'Ne'),
(19, 5, 9, 1, '2021-06-14 09:46:20', 'Ne'),
(20, 6, 4, 1, '2021-06-14 09:52:51', 'Ne'),
(21, 6, 13, 2, '2021-06-14 09:53:33', 'Ne'),
(22, 7, 5, 1, '2021-06-14 12:27:23', 'Ne'),
(23, 8, 14, 1, '2021-06-14 13:43:13', 'Ne');

-- --------------------------------------------------------

--
-- Table structure for table `navs`
--

CREATE TABLE `navs` (
  `idNav` int(11) NOT NULL,
  `href` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `naziv` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `navs`
--

INSERT INTO `navs` (`idNav`, `href`, `naziv`) VALUES
(1, 'index.php', 'Home'),
(2, 'index.php?page=about', 'About'),
(3, 'index.php?page=contact', 'Contact us'),
(4, 'index.php?page=shop', 'Shop'),
(5, 'index.php?page=login', 'Login'),
(6, 'index.php?page=register', 'Register');

-- --------------------------------------------------------

--
-- Table structure for table `pol`
--

CREATE TABLE `pol` (
  `idPol` int(11) NOT NULL,
  `naziv` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pol`
--

INSERT INTO `pol` (`idPol`, `naziv`) VALUES
(1, 'Muški'),
(2, 'Ženski');

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `idProizvod` int(11) NOT NULL,
  `naziv` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cena` decimal(9,2) NOT NULL,
  `opis` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `idSlika` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`idProizvod`, `naziv`, `cena`, `opis`, `idSlika`) VALUES
(1, 'ACER Aspire', 9000.00, 'Ako Vam je potreban laptop za gaming, a niste često kod kuće, ACER Aspire je prava stvar za Vas.', 1),
(2, 'ACER Predator', 250.00, 'Solidan laptop, namenjen za svakodnevnu upotrebu.', 2),
(3, 'ALTOS Predator', 1400.00, 'Desktop računar. Odličan za kanceralijske potrebe.', 3),
(4, 'Apple MacBook', 2600.00, 'Kao i do sada, apple ne prestaje da nas ne iznenađuje sa kvalitenim proizvodima. Danas je na meniju laptop poslednje generacije, ultra brz i ultra tečan.', 4),
(5, 'AURORA Pro', 1600.00, 'Desktop računar namenjen za gaming, ali svojom brzinom opravdan je i za rudarenje.', 5),
(6, 'DELL Inspirion', 350.00, 'Laptop sa odličnom slikom.', 6),
(7, 'DELL Vostro', 400.00, NULL, 7),
(8, 'ASUS Desktop', 900.00, 'Mid-range desktop računar. Moći ćete da uživate u čarima 4K rezolucije bez ikakvih poteškoća. (Mogao bih da radim kao sastavljač opisa, dobro mi ide)', 8),
(9, 'FUJITSU Lifebook', 600.00, 'Odličan laptop za obradu fotografija.', 9),
(10, 'HP Elite Dragon Flz', 1000.00, 'Laptop sa odličnom dijagonalom i IPS Panelom. Slika će Vam delovati kao da je na dohvat ruke. Ovaj laptop Vam pruža mogućnost da gledate filmove u 4k rezoluciji.', 10),
(11, 'HP Envz', 750.00, NULL, 11),
(12, 'HP Laptop', 400.00, NULL, 12),
(13, 'HP Spectre', 150.00, NULL, 13),
(14, 'Lenovo IdeaPad', 50.00, 'Ovaj kvalitet uz ovakvu cenu nećete naći ni na buvljaku.', 14),
(15, 'Lenovo Legion', 700.00, NULL, 15),
(16, 'Prime PRO', 4500.00, 'Brutalan za MINING.', 17),
(17, 'PRIME', 4000.00, 'Brutalan za mining', 16);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi_boje`
--

CREATE TABLE `proizvodi_boje` (
  `idProizvodBoje` int(11) NOT NULL,
  `idProizvod` int(11) NOT NULL,
  `idBoja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proizvodi_boje`
--

INSERT INTO `proizvodi_boje` (`idProizvodBoje`, `idProizvod`, `idBoja`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 2),
(4, 4, 1),
(5, 5, 2),
(6, 6, 4),
(7, 7, 4),
(8, 8, 2),
(9, 9, 2),
(10, 10, 2),
(11, 11, 1),
(12, 12, 5),
(13, 13, 2),
(14, 14, 1),
(15, 15, 2),
(16, 17, 3),
(17, 16, 5);

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE `slike` (
  `idSlika` int(11) NOT NULL,
  `src` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slike`
--

INSERT INTO `slike` (`idSlika`, `src`, `alt`) VALUES
(1, 'ACER-Aspire.png', 'ACER Aspire'),
(2, 'ACER-PREDATOR-TRITON-500.png', 'ACER Predator'),
(3, 'ALTOS-Select-Office.png', 'Altos office'),
(4, 'APPLE-MacBook.png', 'Apple Macbook'),
(5, 'AURORA-PRO.png', 'Aurora pro'),
(6, 'DELL-inspirion.png', 'DELL Inspirion'),
(7, 'DELL-Vostro.png', 'Dell vostro'),
(8, 'Desktop-racunar-ASUS.png', 'ASUS Desktop'),
(9, 'FUJITSU-Lifebook.png', 'FUJITSU'),
(10, 'HP-Elite-DragonFly.png', 'Dragon Fly'),
(11, 'HP-ENVY.png', 'HP Envy'),
(12, 'HP-Laptop-15s.png', 'HP Laptop'),
(13, 'HP-Spectre.png', 'HP Spectre'),
(14, 'Lenovo-IdeaPad.png', 'Lenovo IdeaPad'),
(15, 'LENOVO-Legion.png', 'Lenovo Legion'),
(16, 'PRIME.png', 'Prime'),
(17, 'PRIME-PRO-MasterBox.png', 'PRIME PRO');

-- --------------------------------------------------------

--
-- Table structure for table `uloge`
--

CREATE TABLE `uloge` (
  `idUloga` int(11) NOT NULL,
  `naziv` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uloge`
--

INSERT INTO `uloge` (`idUloga`, `naziv`) VALUES
(1, 'Admin'),
(2, 'Korisnik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boje`
--
ALTER TABLE `boje`
  ADD PRIMARY KEY (`idBoja`),
  ADD UNIQUE KEY `boja` (`boja`);

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`idKategorije`);

--
-- Indexes for table `kategorije_proizvodi`
--
ALTER TABLE `kategorije_proizvodi`
  ADD PRIMARY KEY (`idKategorijeProizvodi`),
  ADD KEY `idProizvod` (`idProizvod`),
  ADD KEY `idKategorije` (`idKategorije`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`idKorisnik`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD KEY `idUloga` (`idUloga`),
  ADD KEY `idPol` (`idPol`);

--
-- Indexes for table `korpa`
--
ALTER TABLE `korpa`
  ADD PRIMARY KEY (`idKorpa`),
  ADD KEY `idKorisnik` (`idKorisnik`);

--
-- Indexes for table `narudzbina`
--
ALTER TABLE `narudzbina`
  ADD PRIMARY KEY (`idNarudzbina`),
  ADD KEY `idKorpa` (`idKorpa`),
  ADD KEY `idProizvod` (`idProizvod`);

--
-- Indexes for table `navs`
--
ALTER TABLE `navs`
  ADD PRIMARY KEY (`idNav`);

--
-- Indexes for table `pol`
--
ALTER TABLE `pol`
  ADD PRIMARY KEY (`idPol`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`idProizvod`),
  ADD KEY `idSlika` (`idSlika`);

--
-- Indexes for table `proizvodi_boje`
--
ALTER TABLE `proizvodi_boje`
  ADD PRIMARY KEY (`idProizvodBoje`),
  ADD KEY `idProizvod` (`idProizvod`),
  ADD KEY `idBoja` (`idBoja`);

--
-- Indexes for table `slike`
--
ALTER TABLE `slike`
  ADD PRIMARY KEY (`idSlika`);

--
-- Indexes for table `uloge`
--
ALTER TABLE `uloge`
  ADD PRIMARY KEY (`idUloga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boje`
--
ALTER TABLE `boje`
  MODIFY `idBoja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `idKategorije` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategorije_proizvodi`
--
ALTER TABLE `kategorije_proizvodi`
  MODIFY `idKategorijeProizvodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `idKorisnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `korpa`
--
ALTER TABLE `korpa`
  MODIFY `idKorpa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `narudzbina`
--
ALTER TABLE `narudzbina`
  MODIFY `idNarudzbina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `navs`
--
ALTER TABLE `navs`
  MODIFY `idNav` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pol`
--
ALTER TABLE `pol`
  MODIFY `idPol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `idProizvod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `proizvodi_boje`
--
ALTER TABLE `proizvodi_boje`
  MODIFY `idProizvodBoje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `slike`
--
ALTER TABLE `slike`
  MODIFY `idSlika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `uloge`
--
ALTER TABLE `uloge`
  MODIFY `idUloga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategorije_proizvodi`
--
ALTER TABLE `kategorije_proizvodi`
  ADD CONSTRAINT `kategorije_proizvodi_ibfk_1` FOREIGN KEY (`idProizvod`) REFERENCES `proizvodi` (`idProizvod`),
  ADD CONSTRAINT `kategorije_proizvodi_ibfk_2` FOREIGN KEY (`idKategorije`) REFERENCES `kategorije` (`idKategorije`);

--
-- Constraints for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD CONSTRAINT `korisnici_ibfk_1` FOREIGN KEY (`idPol`) REFERENCES `pol` (`idPol`),
  ADD CONSTRAINT `korisnici_ibfk_2` FOREIGN KEY (`idUloga`) REFERENCES `uloge` (`idUloga`);

--
-- Constraints for table `korpa`
--
ALTER TABLE `korpa`
  ADD CONSTRAINT `korpa_ibfk_1` FOREIGN KEY (`idKorisnik`) REFERENCES `korisnici` (`idKorisnik`);

--
-- Constraints for table `narudzbina`
--
ALTER TABLE `narudzbina`
  ADD CONSTRAINT `narudzbina_ibfk_1` FOREIGN KEY (`idKorpa`) REFERENCES `korpa` (`idKorpa`),
  ADD CONSTRAINT `narudzbina_ibfk_2` FOREIGN KEY (`idProizvod`) REFERENCES `proizvodi` (`idProizvod`);

--
-- Constraints for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD CONSTRAINT `proizvodi_ibfk_1` FOREIGN KEY (`idSlika`) REFERENCES `slike` (`idSlika`);

--
-- Constraints for table `proizvodi_boje`
--
ALTER TABLE `proizvodi_boje`
  ADD CONSTRAINT `proizvodi_boje_ibfk_1` FOREIGN KEY (`idProizvod`) REFERENCES `proizvodi` (`idProizvod`),
  ADD CONSTRAINT `proizvodi_boje_ibfk_2` FOREIGN KEY (`idBoja`) REFERENCES `boje` (`idBoja`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
