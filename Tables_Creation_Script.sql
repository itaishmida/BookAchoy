-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2014 at 04:01 PM
-- Server version: 5.5.36-cll
-- PHP Version: 5.4.23


--
-- Version 1.0 of the Tables Creation Script - by Mor.
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `maplehos_bookachoy`
--

DROP DATABASE IF EXISTS `maplehos_bookachoy`;

CREATE DATABASE IF NOT EXISTS `maplehos_bookachoy` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `maplehos_bookachoy`;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--
-- Creation: Apr 12, 2014 at 12:58 PM
--


DROP TABLE IF EXISTS `book`, `loans`, `review`, `user`, `users_friends`, `users_owned_books`, `users_read_books`, `wishes`;
DROP TABLE IF EXISTS `book`, `user`;

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `google_id` varchar(20) CHARACTER SET latin1 NOT NULL,
  `name` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `genre` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `overall_rating` tinyint(4) NOT NULL,
  `isbn` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `author` (`author`),
  KEY `genre` (`genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--
-- Creation: Apr 12, 2014 at 12:59 PM
--

DROP TABLE IF EXISTS `loans`;
CREATE TABLE IF NOT EXISTS `loans` (
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `loan_date` date,
  `due_date` date NOT NULL,
  `request_date` date NOT NULL,
  UNIQUE KEY `loan_unique_index` (`user_id`,`friend_id`,`book_id`,`loan_date`),
  KEY `user_id` (`user_id`),
  KEY `friend_id` (`friend_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--
-- Creation: Apr 12, 2014 at 01:00 PM
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `review_text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `user_book_ids_index` (`user_id`,`book_id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--
-- Creation: Apr 12, 2014 at 01:00 PM
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fbid` varchar(30) CHARACTER SET latin1 NOT NULL,
  `name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(254) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `acct_status` tinyint(4) NOT NULL,
  `join_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_index` (`email`),
  UNIQUE KEY `fbid_index` (`fbid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_friends`
--
-- Creation: Apr 12, 2014 at 01:00 PM
--

DROP TABLE IF EXISTS `users_friends`;
CREATE TABLE IF NOT EXISTS `users_friends` (
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`,`friend_id`),
  KEY `friend_id` (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_owned_books`
--
-- Creation: Apr 12, 2014 at 01:00 PM
--

DROP TABLE IF EXISTS `users_owned_books`;
CREATE TABLE IF NOT EXISTS `users_owned_books` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_read_books`
--
-- Creation: Apr 12, 2014 at 01:00 PM
--

DROP TABLE IF EXISTS `users_read_books`;
CREATE TABLE IF NOT EXISTS `users_read_books` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  UNIQUE KEY `user_book_id_index` (`user_id`,`book_id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wishes`
--
-- Creation: Apr 12, 2014 at 01:00 PM
--

DROP TABLE IF EXISTS `wishes`;
CREATE TABLE IF NOT EXISTS `wishes` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `wish_date` date NOT NULL,
  UNIQUE KEY `user_book_ids_index` (`user_id`,`book_id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loans_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loans_ibfk_3` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_friends`
--
ALTER TABLE `users_friends`
  ADD CONSTRAINT `users_friends_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_friends_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_owned_books`
--
ALTER TABLE `users_owned_books`
  ADD CONSTRAINT `users_owned_books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_owned_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_read_books`
--
ALTER TABLE `users_read_books`
  ADD CONSTRAINT `users_read_books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_read_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishes`
--
ALTER TABLE `wishes`
  ADD CONSTRAINT `wishes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishes_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON UPDATE CASCADE;
  
-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 27, 2014 at 11:55 AM
-- Server version: 5.5.36-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `maplehos_bookachoy`
--

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `google_id`, `name`, `author`, `genre`, `overall_rating`, `isbn`) VALUES
(904, 'SAoCAAAAQAAJ', 'Around the world in eighty days', 'Jules Verne', '', 0, ''),
(905, 'WKLPETOoieIC', 'Sanctuary', 'Edith Wharton', '', 0, ''),
(906, '7GM4AAAAMAAJ', 'The Secret Garden', 'Frances Hodgson Burnett', '', 0, ''),
(907, 'zm8RAAAAYAAJ', 'Penrod', 'Booth Tarkington', '', 0, ''),
(908, 'v8IRAAAAYAAJ', 'Pollyanna', 'Eleanor Hodgman Porter', '', 0, ''),
(909, '1G0jAAAAMAAJ', 'Heidi', 'Johanna Spyri', '', 0, ''),
(910, 'MMwBZaorBHkC', 'Little Women', 'Arc Manor', '', 0, ''),
(911, 'vbNPkVVEYoYC', 'Within the Song to Live', 'Nathan Yonathan', '', 0, ''),
(912, 'qVkhHcbtXjIC', 'Ben and the bear', 'Chris Riddell', '', 0, ''),
(913, 'cxZllaF8gMYC', 'The Star of David and the War of Gog and Magog', 'Joseph Shoshani', '', 0, ''),
(914, 'q1EPx-ceN78C', 'A Reliable Wife', 'Robert Goolrick', '', 0, ''),
(915, '7cS_1K3HoMQC', 'Alexandra', 'Valerie Martin', '', 0, ''),
(916, 'BLoCrV-1_EEC', 'A Savage War of Peace: Algeria 1954-1962', 'Alistair Horne', '', 0, 'ISBN159017481X'),
(919, 'i_W6AtCCCVMC', 'Gone with the Wind', 'Margaret Mitchell', '', 0, 'ISBN1416573461'),
(922, 'Y7sOAAAAIAAJ', 'Alice''s Adventures in Wonderland', 'Lewis Carroll', '', 0, 'STANFORD361050048965'),
(923, '', '', '', '', 0, ''),
(924, '2SZMpXN0NkMC', 'Alice in Wonderland', 'Eva Le Gallienne, Florida Friebus, Lewis Carroll', '', 0, 'UOM39015002514530'),
(925, 'u8lyAgAAQBAJ', 'Alice''s Adventures in Wonderland', 'Lewis Carroll', '', 0, 'unknown'),
(927, '8oq7TeFHx2cC', 'Observing Harry', 'Cath Arnold', '', 0, 'ISBN0335224091'),
(928, '3dwNAAAAQAAJ', 'Treasure Island', 'Robert Louis Stevenson', '', 0, 'OXFORD504229172'),
(929, 'InpWiZ3trP8C', 'Educational attainment in the United States: March 1989 and 1988', 'Robert Kominski, United States. Bureau of the Census', '', 0, 'UIUC30112106565598'),
(930, 'a-ZkUeVLdO8C', 'Topology in Chemistry: Discrete Mathematics of Molecules', 'unknown', '', 0, 'ISBN1898563764'),
(931, '1gHreatkfH4C', '12: The Elements of Great Managing', 'Rodd Wagner, James K. Harter', '', 0, 'ISBN159562998X'),
(932, 'hmH07m8YzzAC', '21: 2 Experts 1 Goal', 'Daniel Loigerot, Elina Kaminsky', '', 0, 'ISBN0615680011'),
(933, '_IV5MDFCUpAC', 'Cornell ''69: Liberalism and the Crisis of the American University', 'Donald Alexander Downs', '', 0, 'ISBN0801436532'),
(934, '0r6u8b0oOt0C', '999: New Stories Of Horror And Suspense', 'Al Sarrantonio', '', 0, 'ISBN0062046322'),
(935, 'S_dAZ2K2opQC', '666: The Number of the Beast', 'Peter Abrahams', '', 0, 'ISBN0545000092'),
(936, 'c1rAgGh4gVsC', 'Parliament in Context, 1235-1707', 'unknown', '', 0, 'ISBN0748614869'),
(937, 'YKlOAAAAYAAJ', 'The Flock Book of the Kent Or Romney Marsh Sheep', 'Kent or Romney Marsh Sheep-Breeders'' Association', '', 0, 'CORNELL3192406467925'),
(938, 'vcLwcYOv2rAC', 'Secret Letters From 0 To 10', 'Susie Morgenstern', '', 0, 'ISBN1101174374'),
(939, 'hEawXSP4AVwC', 'Viking Rus: Studies on the Presence of Scandinavians in Eastern Europe', 'Wladyslaw Duczko', '', 0, 'ISBN9004138749'),
(940, 'f47qOw2w5Q0C', 'Porno? Chic!: How Pornography Changed the World and Made it a Better Place', 'Brian McNair', '', 0, 'ISBN0415572908'),
(941, 'bpZRowUJfgUC', 'Reading, Writing, and Rewriting the Prostitute Body', 'Shannon Bell', '', 0, 'ISBN0253208599'),
(942, '3rBJBfo5ebYC', 'The Little Bit Naughty Book of Blow Jobs', 'Lainie Speiser', '', 0, 'ISBN1569757410'),
(943, 'o7BDmY8vzWIC', 'Kama Sutra: (Classics Deluxe Edition)', 'Vatsyayana', '', 0, 'ISBN1101651075'),
(944, 'F-_017Mo_fgC', 'Fuck This Book', 'Bodhi Oser', '', 0, 'ISBN1452122717'),
(945, 'maoIywAACAAJ', 'The Pussy Trap', 'Ne Ne Capri', '', 0, 'ISBN0982841485'),
(946, 'zLJ9AgAAQBAJ', 'Lady Gaga and Popular Music: Performing Gender, Fashion, and Culture', 'unknown', '', 0, 'ISBN113407994X'),
(948, 'mUc9AwAAQBAJ', 'Carry On, Warrior: The Power of Embracing Your Messy, Beautiful Life', 'Glennon Doyle Melton', '', 0, 'ISBN1451698224'),
(949, 'TE0AnAEACAAJ', 'Carrie', 'Lawrence D. Cohen, Brian De De Palma, Stephen King, Piper Laurie, John Travolta', '', 0, 'OCLC753856729'),
(950, 'FNxGvn1SCVMC', 'Carrie', 'Stephen King', '', 0, 'ISBN0385528833'),
(951, 'KUj4AAAAQBAJ', 'A Pigeon and a Boy: A Novel', 'Meir Shalev', '', 0, 'ISBN0805242686'),
(952, 'PgcYAQAAIAAJ', 'Sermon and other stories', 'Haim Hazaz, Dan Miron', '', 0, 'STANFORD361051142367'),
(953, 'gSSxSupZqkEC', 'Horns: A Novel', 'Joe Hill', '', 0, 'ISBN006196946X'),
(954, 'LgpKId3vZcIC', 'On Killing', 'Lt. Col. Dave Grossman', '', 0, 'ISBN0759277257'),
(955, 'RB48AQAAMAAJ', 'The Pennsylvania-German: A Popular Magazine of Biography, History, Genealogy ...', 'unknown', '', 0, 'OSU32435026615047'),
(956, 'GV5irW3lbvwC', 'The Death of Bunny Munro: A Novel', 'Nick Cave', '', 0, 'ISBN0865479402'),
(957, '_TOuTLEV0tQC', 'And the Ass Saw the Angel', 'Nick Cave', '', 0, 'ISBN0141935324'),
(958, 'DW6Ebt4k9kYC', 'Almost Dead: A Novel', 'Assaf Gavron', '', 0, 'ISBN0062008609'),
(959, 'iSe95FJrfeYC', 'Spinoza: A Life', 'Steven Nadler, Steven M. Nadler', '', 0, 'ISBN0521002931'),
(960, '8S0PNAAACAAJ', 'הארי פוטר ואוצרות המוות', 'J. K. Rowling, גילי בר הלל סמו', '', 0, 'ISBN9654826356');

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fbid`, `name`, `email`, `acct_status`, `join_date`) VALUES
(676039135, '1093670109', 'Mor Hasson', 'mor.hsn@gmail.com', 0, '2014-05-19'),
(676039137, '748384921', 'Bat-Hen Meushary Fisher', 'meushary@gmail.com', 0, '2014-05-19'),
(676039139, '676039134', 'שי פישר', 'shai.fisher@gmail.com', 0, '2014-05-19'),
(676039140, '100000617083781', 'Itai Shmida', 'itai.shmida@gmail.com', 0, '2014-05-21'),
(676039141, '9999', 'Test User', 'test@test.com', 1, '0000-00-00'),
(676039142, '541032350', 'Adi Mizrahi', 'adim_2@walla.co.il', 0, '2014-05-26'),
(676039143, '1621403976', 'Dror Noyman', 'dror.icp@gmail.com', 0, '2014-05-27');

--
-- Dumping data for table `users_friends`
--

INSERT INTO `users_friends` (`user_id`, `friend_id`) VALUES
(676039135, 676039139),
(676039135, 676039140),
(676039135, 676039142),
(676039137, 676039143),
(676039139, 676039135),
(676039139, 676039139),
(676039139, 676039139),
(676039139, 676039140),
(676039139, 676039142),
(676039140, 676039135),
(676039140, 676039139),
(676039140, 676039142),
(676039142, 676039135),
(676039142, 676039139),
(676039142, 676039140),
(676039143, 676039137);

--
-- Dumping data for table `users_owned_books`
--

INSERT INTO `users_owned_books` (`user_id`, `book_id`, `added_date`, `status`) VALUES
(676039139, 912, '2014-05-21', 0),
(676039140, 911, '2014-05-21', 0),
(676039140, 907, '2014-05-21', 0),
(676039137, 915, '2014-05-22', 0),
(676039137, 910, '2014-05-22', 0),
(676039137, 919, '2014-05-24', 0),
(676039139, 925, '2014-05-26', 0),
(676039135, 907, '2014-05-26', 0),
(676039135, 927, '2014-05-26', 0),
(676039135, 928, '2014-05-26', 0),
(676039142, 927, '2014-05-26', 0),
(676039142, 924, '2014-05-26', 0),
(676039139, 935, '2014-05-26', 0),
(676039143, 950, '2014-05-27', 0),
(676039139, 951, '2014-05-27', 0),
(676039139, 952, '2014-05-27', 0),
(676039143, 953, '2014-05-27', 0),
(676039139, 957, '2014-05-27', 0),
(676039139, 958, '2014-05-27', 0),
(676039139, 959, '2014-05-27', 0),
(676039139, 960, '2014-05-27', 0);  

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
