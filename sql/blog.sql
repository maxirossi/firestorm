-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-12-2016 a las 21:47:28
-- Versión del servidor: 5.5.50-0+deb8u1
-- Versión de PHP: 5.6.27-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `blog`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(10) unsigned NOT NULL,
  `moduleID` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `celphone` varchar(15) DEFAULT NULL,
  `date_nac` date DEFAULT NULL,
  `permissions` tinyint(1) NOT NULL,
  `order` int(10) unsigned NOT NULL,
  `last_mod` datetime NOT NULL,
  `master` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `moduleID`, `name`, `lastName`, `user`, `password`, `email`, `address`, `phone`, `celphone`, `date_nac`, `permissions`, `order`, `last_mod`, `master`) VALUES
(1, 0, NULL, NULL, 'admin', 'd1678b77a1e66888d5e6d01c388afb63', 'rossi.maxi@gmail.com', NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `content`
--

CREATE TABLE IF NOT EXISTS `content` (
`id` int(10) unsigned NOT NULL,
  `date` date DEFAULT NULL,
  `category` smallint(4) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `summary` text,
  `body` longtext,
  `altFieldDate` date DEFAULT NULL,
  `altFieldDateEnd` date DEFAULT NULL,
  `subcat_id` int(10) unsigned DEFAULT NULL,
  `supercat_id` int(10) unsigned DEFAULT NULL,
  `position` int(5) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `last_mod` datetime NOT NULL,
  `time` varchar(15) DEFAULT NULL,
  `moduleID` int(3) NOT NULL,
  `cat_ids` text,
  `imgUrl` text NOT NULL,
  `useImg` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `menu` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `content`
--

INSERT INTO `content` (`id`, `date`, `category`, `status`, `title`, `subtitle`, `name`, `summary`, `body`, `altFieldDate`, `altFieldDateEnd`, `subcat_id`, `supercat_id`, `position`, `url`, `last_mod`, `time`, `moduleID`, `cat_ids`, `imgUrl`, `useImg`, `description`, `tags`, `menu`) VALUES
(1, NULL, NULL, 1, 'Frontend', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2016-12-16 00:00:00', NULL, 4, NULL, '', '', '', '', NULL),
(2, NULL, NULL, 1, 'Backend', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2016-12-16 00:00:00', NULL, 4, NULL, '', '', '', '', NULL),
(3, NULL, NULL, 1, 'Database', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, '2016-12-16 00:00:00', NULL, 4, NULL, '', '', '', '', NULL),
(4, NULL, 2, 1, 'PHP5', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'http://php.net/', '2016-12-16 00:00:00', NULL, 3, NULL, '', '', '', '', NULL),
(5, NULL, 2, 1, 'Codeigniter 3.0', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'https://www.codeigniter.com/', '2016-12-16 00:00:00', NULL, 3, NULL, '', '', 'PHP Framework', '', NULL),
(6, NULL, 1, 1, 'HTML5', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '2016-12-19 00:00:00', NULL, 3, NULL, '', '', '', '', NULL),
(7, NULL, 1, 1, 'Javascript / Jquery', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '2016-12-16 00:00:00', NULL, 3, NULL, '', '', '', '', NULL),
(8, NULL, 3, 1, 'MySQL', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '2016-12-16 00:00:00', NULL, 3, NULL, '', '', '', '', NULL),
(9, NULL, NULL, 1, 'title', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2016-12-17 00:00:00', NULL, 5, NULL, '', '', 'Demo Frontend', '', NULL),
(10, NULL, NULL, 1, 'subtitle', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2016-12-17 00:00:00', NULL, 5, NULL, '', '', 'A little demo of <i class="fa fa-code" aria-hidden="true"></i> FireStormCMS in blog format', '', NULL),
(11, NULL, NULL, 1, 'About', 'A little of history', 'About', NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '2016-12-18 00:00:00', NULL, 1, NULL, '', '', '<strong>FireStorm</strong> was born as a punctual project, we needed an own <strong>CMS </strong>for the company that we were working. Gradually it was growing and we were reusing it in several websites. The first versions did not support OOP, let alone MVC. Currently it is a very flexible <strong>CMS</strong> and that is being used in more than 50 projects.<br />\r\n<br />\r\nMy idea was always to publish it and share it with the community of programmers, since I think it is a <strong>CMS</strong> with certain interesting features. Some highlights are:<br />\r\n&nbsp;\r\n<ul>\r\n	<li>Uses&nbsp;<strong>CodeIgniter</strong>, a lightweight and fast PHP framework that implements the <strong>MVC </strong>development model.</li>\r\n	<li>It is very <strong>flexible and modular</strong>. You are thinking so that the programmer only configure the modules that will use your application. Of the rest is responsible <strong> FireStorm</strong></li>\r\n	<li>Its&nbsp;<strong>extensible</strong>. If you need to add some functionality or modify the core of the program you can do it without too many complicated ones. Is thinking to grow ;)</li>\r\n</ul>\r\n', '', 1),
(13, NULL, NULL, 1, 'Dependencies', ' Some technologies we use', 'Dependencies', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2016-12-18 00:00:00', NULL, 1, NULL, '', '', '<strong>FrontEnd</strong>\r\n<ul>\r\n	<li>HTML5</li>\r\n	<li>CSS3</li>\r\n	<li>Bootstrap 3</li>\r\n	<li>JavaScript</li>\r\n	<li>Jquery</li>\r\n	<li>Ajax</li>\r\n	<li>DataTables Plugin</li>\r\n</ul>\r\n<br />\r\n<strong>BackEnd</strong>\r\n\r\n<ul>\r\n	<li>PHP5</li>\r\n	<li>Codeigniter</li>\r\n</ul>\r\n<br />\r\n<strong>Database</strong><br />\r\nMySQL', '', 1),
(15, NULL, NULL, 1, 'Requirements', 'Few, really few', 'Requirements', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, '2016-12-18 00:00:00', NULL, 1, NULL, '', '', 'The basic requirements are a server that supports PHP v &gt;= 5, the module mod_rewrite &nbsp;activated and a server of relational database. Preferably MySQL, but you can also use SQL Server or another option.', '', 1),
(17, NULL, 1, 1, 'CSS3', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '2016-12-19 00:00:00', NULL, 3, NULL, '', '', '', '', NULL),
(18, NULL, 1, 1, 'Bootstrap', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '2016-12-19 00:00:00', NULL, 3, NULL, '', '', '', '', NULL),
(19, NULL, 1, 1, 'DataTables (Jquery Plugin)', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '2016-12-19 00:00:00', NULL, 3, NULL, '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `defaultModulesConfig`
--

CREATE TABLE IF NOT EXISTS `defaultModulesConfig` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `debug` tinyint(1) DEFAULT NULL,
  `printRequest` tinyint(1) DEFAULT NULL,
  `printInsertSql` tinyint(1) DEFAULT NULL,
  `printUpdateSql` tinyint(1) DEFAULT NULL,
  `printSelectSql` tinyint(1) DEFAULT NULL,
  `ordenSql` varchar(100) DEFAULT NULL,
  `oFields` varchar(100) DEFAULT NULL,
  `lFields` varchar(100) DEFAULT NULL,
  `media` tinyint(1) DEFAULT NULL,
  `listadoUpload` tinyint(1) DEFAULT NULL,
  `listadoFlickr` tinyint(1) DEFAULT NULL,
  `listadoUrl` tinyint(1) DEFAULT NULL,
  `OpcImagenes` tinyint(1) DEFAULT NULL,
  `OpcAudios` tinyint(1) DEFAULT NULL,
  `OpcVideos` tinyint(1) DEFAULT NULL,
  `youtube` tinyint(1) DEFAULT NULL,
  `paginado` tinyint(1) DEFAULT NULL,
  `paginadoCant` tinyint(3) DEFAULT NULL,
  `OpcSort` tinyint(1) DEFAULT NULL,
  `permitirCrear` tinyint(1) DEFAULT NULL,
  `morir` tinyint(1) DEFAULT NULL,
  `limitImages` smallint(3) DEFAULT NULL,
  `limitYoutube` smallint(3) DEFAULT NULL,
  `permiteCrear` tinyint(1) DEFAULT NULL,
  `modulo_id` int(11) DEFAULT NULL,
  `useImg` varchar(255) DEFAULT NULL,
  `last_mod` date DEFAULT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `defaultModulesConfig`
--

INSERT INTO `defaultModulesConfig` (`id`, `nombre`, `debug`, `printRequest`, `printInsertSql`, `printUpdateSql`, `printSelectSql`, `ordenSql`, `oFields`, `lFields`, `media`, `listadoUpload`, `listadoFlickr`, `listadoUrl`, `OpcImagenes`, `OpcAudios`, `OpcVideos`, `youtube`, `paginado`, `paginadoCant`, `OpcSort`, `permitirCrear`, `morir`, `limitImages`, `limitYoutube`, `permiteCrear`, `modulo_id`, `useImg`, `last_mod`, `orden`) VALUES
(1, 'Default options for modules config', NULL, 0, 0, 0, 0, 'id desc', '', 'id, nombre', 1, 0, 0, 0, 0, 0, 0, 0, 1, 20, 1, NULL, 1, 2, 5, 1, 102, 'no usar ninguna', '2010-08-20', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files`
--

CREATE TABLE IF NOT EXISTS `files` (
`id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `name` varchar(250) NOT NULL,
  `position` int(10) unsigned NOT NULL,
  `size` varchar(50) NOT NULL,
  `text` text,
  `title` varchar(250) DEFAULT NULL,
  `font` varchar(250) DEFAULT NULL,
  `destacar` tinyint(1) NOT NULL,
  `table` varchar(50) NOT NULL,
  `supercat_id` int(10) unsigned NOT NULL,
  `cat_id` int(10) unsigned NOT NULL,
  `subcat_id` int(10) unsigned NOT NULL,
  `last_mod` datetime NOT NULL,
  `type` varchar(50) NOT NULL,
  `moduleID` int(3) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `files`
--

INSERT INTO `files` (`id`, `item_id`, `name`, `position`, `size`, `text`, `title`, `font`, `destacar`, `table`, `supercat_id`, `cat_id`, `subcat_id`, `last_mod`, `type`, `moduleID`) VALUES
(10, 11, '', 0, '1185052', NULL, '4cadaca8ee9a0308f9005e8b7896df98.png', NULL, 0, '', 0, 0, 0, '2016-12-17 16:43:26', 'image/png', 1),
(11, 13, '', 0, '1727763', NULL, 'c2c9e3b3e237ece9985ed1e09e29eb24.png', NULL, 0, '', 0, 0, 0, '2016-12-17 16:44:54', 'image/png', 1),
(12, 15, '', 0, '1808305', NULL, '71fcc976117b5188ad573bb915edadec.png', NULL, 0, '', 0, 0, 0, '2016-12-17 16:47:14', 'image/png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulesConfig`
--

CREATE TABLE IF NOT EXISTS `modulesConfig` (
`id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `debug` tinyint(1) DEFAULT NULL,
  `printRequest` tinyint(1) DEFAULT NULL,
  `printInsertSql` tinyint(1) DEFAULT NULL,
  `printUpdateSql` tinyint(1) DEFAULT NULL,
  `printSelectSql` tinyint(1) DEFAULT NULL,
  `ordenSql` varchar(100) DEFAULT NULL,
  `oFields` varchar(100) DEFAULT NULL,
  `lFields` varchar(100) DEFAULT NULL,
  `media` tinyint(1) DEFAULT NULL,
  `listadoUpload` tinyint(1) DEFAULT NULL,
  `listadoFlickr` tinyint(1) DEFAULT NULL,
  `listadoUrl` tinyint(1) DEFAULT NULL,
  `OpcImagenes` tinyint(1) DEFAULT NULL,
  `OpcAudios` tinyint(1) DEFAULT NULL,
  `OpcVideos` tinyint(1) DEFAULT NULL,
  `youtube` tinyint(1) DEFAULT NULL,
  `paginado` tinyint(1) DEFAULT NULL,
  `paginadoCant` tinyint(3) DEFAULT NULL,
  `OpcSort` tinyint(1) DEFAULT NULL,
  `permitirCrear` tinyint(1) DEFAULT NULL,
  `morir` tinyint(1) DEFAULT NULL,
  `limitImages` smallint(3) DEFAULT NULL,
  `limitYoutube` smallint(3) DEFAULT NULL,
  `permiteCrear` tinyint(1) DEFAULT NULL,
  `modulo_id` int(11) DEFAULT NULL,
  `useImg` varchar(255) DEFAULT NULL,
  `last_mod` date DEFAULT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modulesConfig`
--

INSERT INTO `modulesConfig` (`id`, `module_name`, `nombre`, `debug`, `printRequest`, `printInsertSql`, `printUpdateSql`, `printSelectSql`, `ordenSql`, `oFields`, `lFields`, `media`, `listadoUpload`, `listadoFlickr`, `listadoUrl`, `OpcImagenes`, `OpcAudios`, `OpcVideos`, `youtube`, `paginado`, `paginadoCant`, `OpcSort`, `permitirCrear`, `morir`, `limitImages`, `limitYoutube`, `permiteCrear`, `modulo_id`, `useImg`, `last_mod`, `orden`) VALUES
(1, 'marcas', 'marcas', NULL, 0, 0, 0, 0, 'nombre asc', 'nombre', 'id, nombre', 1, 0, 0, 0, 0, 0, 0, 0, 1, 100, 1, NULL, 0, 0, 0, 1, 101, 'no usar ninguna', '2010-10-07', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `summary` text NOT NULL,
  `position` smallint(6) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `moduleID` int(3) NOT NULL,
  `last_mod` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `title`, `name`, `description`, `summary`, `position`, `status`, `moduleID`, `last_mod`) VALUES
(1, 'A example post', NULL, '<strong>Lorem Ipsum</strong>&nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno est&aacute;ndar de las industrias desde el a&ntilde;o 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido us&oacute; una galer&iacute;a de textos y los mezcl&oacute; de tal manera que logr&oacute; hacer un libro de textos especimen. No s&oacute;lo sobrevivi&oacute; 500 a&ntilde;os, sino que tambien ingres&oacute; como texto de relleno en documentos electr&oacute;nicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creaci&oacute;n de las hojas &quot;Letraset&quot;, las cuales contenian pasajes de Lorem Ipsum, y m&aacute;s recientemente con software de autoedici&oacute;n, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 'Lorem Ipsum', 0, 1, 2, '2016-12-18 00:00:00'),
(4, 'Other Post', NULL, '<strong>Lorem Ipsum</strong>&nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno est&aacute;ndar de las industrias desde el a&ntilde;o 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido us&oacute; una galer&iacute;a de textos y los mezcl&oacute; de tal manera que logr&oacute; hacer un libro de textos especimen. No s&oacute;lo sobrevivi&oacute; 500 a&ntilde;os, sino que tambien ingres&oacute; como texto de relleno en documentos electr&oacute;nicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creaci&oacute;n de las hojas &quot;Letraset&quot;, las cuales contenian pasajes de Lorem Ipsum, y m&aacute;s recientemente con software de autoedici&oacute;n, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 'Lorem Ipsum II', 0, 1, 2, '2016-12-18 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `usuario` (`user`), ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `content`
--
ALTER TABLE `content`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `defaultModulesConfig`
--
ALTER TABLE `defaultModulesConfig`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `files`
--
ALTER TABLE `files`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulesConfig`
--
ALTER TABLE `modulesConfig`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `content`
--
ALTER TABLE `content`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `defaultModulesConfig`
--
ALTER TABLE `defaultModulesConfig`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `files`
--
ALTER TABLE `files`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `modulesConfig`
--
ALTER TABLE `modulesConfig`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
