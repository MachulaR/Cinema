SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title_original` text COLLATE utf8_unicode_ci,
  `title_pl` text COLLATE utf8_unicode_ci NOT NULL,
  `trailer` text COLLATE utf8_unicode_ci,
  `img` text COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `screen_time` text COLLATE utf8_unicode_ci NOT NULL,
  `cinema_halls` text COLLATE utf8_unicode_ci,
  `add_timestamp` datetime NOT NULL,
  `edit_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `last_name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `reserved_seats` text COLLATE utf8_unicode_ci NOT NULL,
  `movie_title_pl` text COLLATE utf8_unicode_ci NOT NULL,
  `movie_title_original` text COLLATE utf8_unicode_ci,
  `reservation_date` text COLLATE utf8_unicode_ci NOT NULL,
  `reservation_hour` text COLLATE utf8_unicode_ci NOT NULL,
  `cinema_hall` int(11) NOT NULL,
  `add_timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
