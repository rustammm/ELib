
-- Структура таблицы `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `library` varchar(200) NOT NULL,
  `serial1` int(50) NOT NULL,
  `serial2` int(50) NOT NULL,
  `name` varchar(300) NOT NULL,
  `student` int(50) NOT NULL,
  `grade` int(10) NOT NULL,
  `category` varchar(50) NOT NULL,
  `lang` varchar(50) NOT NULL,
  `date_taken` varchar(200) NOT NULL,
  `price` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `library`, `serial1`, `serial2`, `name`, `student`, `grade`, `category`, `lang`, `date_taken`, `price`) VALUES
(1, '1', 1, 1, 'ÐšÐ½Ð¸Ð³Ð°', 0, 11, 'ÐšÐ½Ð¸Ð³Ð°', 'Ð ÑƒÑÑÐºÐ¸Ð¹', '', 100),
(2, '1', 1, 2, 'ÐšÐ½Ð¸Ð³Ð°', 0, 11, 'ÐšÐ½Ð¸Ð³Ð°', 'Ð ÑƒÑÑÐºÐ¸Ð¹', '', 100);

-- --------------------------------------------------------

--
-- Структура таблицы `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `object` int(50) NOT NULL,
  `description` varchar(150) NOT NULL,
  `category` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `library` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `history`
--

INSERT INTO `history` (`id`, `object`, `description`, `category`, `date`, `library`) VALUES
(1, -1, 'Ð’Ñ‹ Ð²Ð¾ÑˆÐ»Ð¸', 'Ð’Ñ…Ð¾Ð´ Ð°Ð´Ð¼Ð¸Ð½Ð¸ÑÑ‚Ñ€Ð°Ñ‚Ð¾Ñ€Ð° admin', '2015-06-08 11:39:13', '1'),
(2, -1, 'Ð’Ñ‹ Ð´Ð¾Ð±Ð°Ð²Ð¸Ð»Ð¸ ÑƒÑ‡ÐµÐ½Ð¸ÐºÐ° Ñ id : <b>1</b> , Ð¤Ð°Ð¼Ð¸Ð»Ð¸ÐµÐ¹ : <b>agawg</b>, Ð˜Ð¼ÐµÐ½ÐµÐ¼: <b>fawf</b>', 'Ð£Ñ‡ÐµÐ½Ð¸ÐºÐ¸:Ð”Ð¾Ð±Ð°Ð²Ð»ÐµÐ½Ð¸Ðµ', '2015-06-08 11:45:49', '1'),
(3, -1, 'Ð’Ñ‹ ÑƒÐ´Ð°Ð»Ð¸Ð»Ð¸ ÑƒÑ‡ÐµÐ½Ð¸ÐºÐ° Ñ id : <b>1</b>, Ð¤Ð˜: <b>agawg fawf </b>', 'Ð£Ñ‡ÐµÐ½Ð¸ÐºÐ¸:Ð£Ð´Ð°Ð»ÐµÐ½Ð¸Ðµ', '2015-06-08 11:48:44', '1'),
(4, -1, 'Ð’Ñ‹ Ð´Ð¾Ð±Ð°Ð²Ð¸Ð»Ð¸ ÑƒÑ‡ÐµÐ½Ð¸ÐºÐ° Ñ id : <b>2</b> , Ð¤Ð°Ð¼Ð¸Ð»Ð¸ÐµÐ¹ : <b>ÐÐ±Ð´ÑƒÐ¼ÑƒÑ‚Ð°Ð»Ð¾Ð²</b>, Ð˜Ð¼ÐµÐ½ÐµÐ¼: <b>Ð ÑƒÑÑ‚Ð°Ð¼</b>', 'Ð£Ñ‡ÐµÐ½Ð¸ÐºÐ¸:Ð”Ð¾Ð±Ð°Ð²Ð»ÐµÐ½Ð¸Ðµ', '2015-06-08 11:54:36', '1'),
(5, -1, 'Ð’Ñ‹ Ð²Ð¾ÑˆÐ»Ð¸', 'Ð’Ñ…Ð¾Ð´ Ð°Ð´Ð¼Ð¸Ð½Ð¸ÑÑ‚Ñ€Ð°Ñ‚Ð¾Ñ€Ð° admin', '2015-06-08 11:55:55', '1'),
(6, -1, 'Ð’Ñ‹ Ð²Ð¾ÑˆÐ»Ð¸', 'Ð’Ñ…Ð¾Ð´ Ð°Ð´Ð¼Ð¸Ð½Ð¸ÑÑ‚Ñ€Ð°Ñ‚Ð¾Ñ€Ð° admin', '2015-06-08 11:56:17', '1'),
(7, -1, 'Ð’Ñ‹ Ð´Ð¾Ð±Ð°Ð²Ð¸Ð»Ð¸ ÐºÐ½Ð¸Ð³Ñƒ Ñ id : <b>2</b> Ð¸ Ð½Ð°Ð·Ð²Ð°Ð½Ð¸ÐµÐ¼ : <b>ÐšÐ½Ð¸Ð³Ð°</b>, Ð½Ð¾Ð¼ÐµÑ€Ð¾Ð¼: <b>1</b>', 'ÐšÐ½Ð¸Ð³Ð¸:Ð”Ð¾Ð±Ð°Ð²Ð»ÐµÐ½Ð¸Ðµ', '2015-06-08 11:57:02', '1'),
(8, -1, 'Ð’Ñ‹ Ð¸Ð·Ð¼ÐµÐ½Ð¸Ð»Ð¸ Ð¸Ð½Ñ„Ð¾Ñ€Ð¼Ð°Ñ†Ð¸ÑŽ Ð¾Ð± ÑƒÑ‡ÐµÐ½Ð¸ÐºÐµ Ñ id : 2', 'Ð£Ñ‡ÐµÐ½Ð¸ÐºÐ¸:Ð˜Ð·Ð¼ÐµÐ½ÐµÐ½Ð¸Ðµ', '2015-06-08 13:12:36', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `in_act_books`
--

CREATE TABLE IF NOT EXISTS `in_act_books` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `item_id` int(100) NOT NULL,
  `sid` int(100) NOT NULL,
  `library` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `libraries`
--

CREATE TABLE IF NOT EXISTS `libraries` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `school_db` varchar(200) NOT NULL,
  `school_name` varchar(200) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `libraries`
--

INSERT INTO `libraries` (`id`, `school_db`, `school_name`, `hidden`) VALUES
(1, '', 'Test', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `grade` int(10) NOT NULL,
  `letter` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `points` int(50) NOT NULL DEFAULT '0',
  `library` varchar(200) NOT NULL,
  `PIN` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `name`, `surname`, `grade`, `letter`, `password`, `points`, `library`, `PIN`, `email`) VALUES
(2, 'ÐÐ±Ð²', 'Ð“Ð´Ðµ', 11, 'Ð‘', 'd9b1d7db4cd6e70935368a1efb10e377', 0, '1', '63ee451939ed580ef3c4b6f0109d1fd0', 'rustam960@yandex.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `library` varchar(200) NOT NULL,
  `name` char(15) DEFAULT NULL,
  `password` char(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `library`, `name`, `password`, `status`) VALUES
(1, '1', 'admin', 'c3284d0f94606de1fd2af172aba15bf3', 1);
