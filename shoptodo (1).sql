-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 19, 2020 at 10:10 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoptodo`
--

-- --------------------------------------------------------

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
CREATE TABLE IF NOT EXISTS `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_carrito` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `metodo` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `pago` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compras`
--

INSERT INTO `compras` (`id`, `id_carrito`, `id_usuario`, `id_producto`, `metodo`, `direccion`, `pago`, `fecha`, `cantidad`) VALUES
(31, 8285, 0, 2, '', '', '', '2020-03-18', 1),
(32, 8285, 0, 3, '', '', '', '2020-03-18', 1),
(30, 8719, 0, 2, '', '', '', '2020-03-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `imagenurl` varchar(255) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `Branch` varchar(255) NOT NULL,
  `descripcion2` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `precio`, `descripcion`, `imagenurl`, `idcategoria`, `categoria`, `Branch`, `descripcion2`) VALUES
(1, 'Lenovo\r\n', 695, 'Portátil Convertible 2 en 1 LENOVO Yoga 520-14IKB 14 Intel Core i3 / RAM 8 GB / Disco Duro 256 GB / Windows 10 Home\r\n', '1.jpg', 1, 'laptop', 'lenovo', 'Tamaño pantalla (cm/pulg): 39.62 cm / 15.6 \" \r\n Resolución: 1366 x 768 píxeles \r\n Retroiluminación LED: Sí \r\n Calidad de imagen: HD \r\n Tamaño pantalla (cm): 39.62 cm Tamaño pantalla (pulgadas): 15.6 \" \r\n Tamaño memoria RAM: 4 GB\r\n'),
(2, 'Lenovo\r\n', 679, 'Portátil Convertible 2 en 1 LENOVO Yoga 520-14IKB 14 Intel® Core™ i3 / RAM 8 GB / Disco Duro 256 GB / Windows 10\r\n', '2.jpg', 1, 'laptop', 'lenovo', 'Tamaño pantalla (cm/pulg): 39.62 cm / 15.6 \" \r\n Resolución: 1366 x 768 píxeles \r\n Retroiluminación LED: Sí \r\n Calidad de imagen: HD \r\n Tamaño pantalla (cm): 39.62 cm Tamaño pantalla (pulgadas): 15.6 \" \r\n Tamaño memoria RAM: 4 GB\r\n'),
(3, 'Lenovo\r\n', 594, 'Portátil Convertible 2 en 1 LENOVO Yoga 520-14IKB 14 Intel® Core™ i3 / RAM 4 GB / Disco Duro 1 TB / Windows 10\r\n', '3.jpg', 1, 'laptop', 'lenovo', 'Tamaño pantalla (cm/pulg): 39.62 cm / 15.6 \" \r\n Resolución: 1366 x 768 píxeles \r\n Retroiluminación LED: Sí \r\n Calidad de imagen: HD \r\n Tamaño pantalla (cm): 39.62 cm Tamaño pantalla (pulgadas): 15.6 \" \r\n Tamaño memoria RAM: 4 GB\r\n'),
(4, 'Lenovo\r\n', 679, 'Portátil Convertible 2 en 1 LENOVO Yoga 510-14IKB 14 Intel® Core™ i3 / RAM 8 GB / Disco Duro 256 GB / Windows 10\r\n', '4.jpg', 1, 'laptop', 'lenovo', 'Tamaño pantalla (cm/pulg): 39.62 cm / 15.6 \" \r\n Resolución: 1366 x 768 píxeles \r\n Retroiluminación LED: Sí \r\n Calidad de imagen: HD \r\n Tamaño pantalla (cm): 39.62 cm Tamaño pantalla (pulgadas): 15.6 \" \r\n Tamaño memoria RAM: 4 GB\r\n'),
(5, 'Lenovo\r\n', 390, 'Portátil Convertible 2 en 1 LENOVO Yoga 310-11IAP Intel Celeron N3350 / RAM 4 GB / Disco Duro 128 GB / Windows 10\r\n', '5.jpg', 1, 'laptop', 'lenovo', 'Tamaño pantalla (cm/pulg): 39.62 cm / 15.6 \" \r\n Resolución: 1366 x 768 píxeles \r\n Retroiluminación LED: Sí \r\n Calidad de imagen: HD \r\n Tamaño pantalla (cm): 39.62 cm Tamaño pantalla (pulgadas): 15.6 \" \r\n Tamaño memoria RAM: 4 GB\r\n'),
(6, 'Medion\r\n', 199, 'Portátil Convertible 2 en 1 MEDION E2221T-MD60684 Intel® Atom® / RAM 2 GB / Disco Duro 32 GB / Windows 10\r\n', '6.jpg', 2, 'laptop', 'medio', 'Tamaño pantalla (cm/pulg): 39.62 cm / 15.6 \" \r\n Resolución: 1366 x 768 píxeles \r\n Retroiluminación LED: Sí \r\n Calidad de imagen: HD \r\n Tamaño pantalla (cm): 39.62 cm Tamaño pantalla (pulgadas): 15.6 \" \r\n Tamaño memoria RAM: 4 GB\r\n'),
(7, 'Samsung\r\n', 169, 'Tablet 10,1\'\' SAMSUNG TAB A T580 16+2 GB Negra RAM 2 GB / Almacenamiento 16 GB\r\n', '7.jpg', 3, 'tablet', 'samsung', 'Tamaño pantalla (cm/pulg): 39.62 cm / 15.6 \" \r\n Resolución: 1366 x 768 píxeles \r\n Retroiluminación LED: Sí \r\n Calidad de imagen: HD \r\n Tamaño pantalla (cm): 39.62 cm Tamaño pantalla (pulgadas): 15.6 \" \r\n Tamaño memoria RAM: 4 GB\r\n'),
(8, 'Lenovo\r\n', 79, 'Tablet 7\'\' LENOVO 3-710F RAM 1 GB / 8 GB de almacenamiento\r\n', '8.jpg', 1, 'tablet', 'lenovo', 'Tamaño pantalla (cm/pulg): 39.62 cm / 15.6 \" \r\n Resolución: 1366 x 768 píxeles \r\n Retroiluminación LED: Sí \r\n Calidad de imagen: HD \r\n Tamaño pantalla (cm): 39.62 cm Tamaño pantalla (pulgadas): 15.6 \" \r\n Tamaño memoria RAM: 4 GB\r\n'),
(9, 'Lenovo\r\n', 139, 'Tablet 10.1\'\' LENOVO TB-X103F RAM 1 GB / Almacenamiento 16 GB\r\n', '9.jpg', 1, 'tablet', 'lenovo', 'Tamaño pantalla (cm/pulg): 39.62 cm / 15.6 \" \r\n Resolución: 1366 x 768 píxeles \r\n Retroiluminación LED: Sí \r\n Calidad de imagen: HD \r\n Tamaño pantalla (cm): 39.62 cm Tamaño pantalla (pulgadas): 15.6 \" \r\n Tamaño memoria RAM: 4 GB\r\n'),
(10, 'Amazon\r\n', 80, 'E-Book KINDLE Touch Wifi 6 Pantalla E Ink Pearl HD, 167 ppp. Tecnología de fuente optimizada.\r\n', '10.jpg', 4, 'ebook', 'amazon', 'Tamaño pantalla (cm/pulg): 39.62 cm / 15.6 \" \r\n Resolución: 1366 x 768 píxeles \r\n Retroiluminación LED: Sí \r\n Calidad de imagen: HD \r\n Tamaño pantalla (cm): 39.62 cm Tamaño pantalla (pulgadas): 15.6 \" \r\n Tamaño memoria RAM: 4 GB\r\n'),
(11, 'Amazon\r\n', 130, 'E-Book KINDLE Paperwhite 4 GB WiFi / 6\'\'\r\n', '11.jpg', 4, 'ebook', 'amazon', 'Tamaño pantalla (cm/pulg): 39.62 cm / 15.6 \" \r\n Resolución: 1366 x 768 píxeles \r\n Retroiluminación LED: Sí \r\n Calidad de imagen: HD \r\n Tamaño pantalla (cm): 39.62 cm Tamaño pantalla (pulgadas): 15.6 \" \r\n Tamaño memoria RAM: 4 GB\r\n'),
(12, 'PHP CodeIgniter for Absolute Beginners\r\n', 43, 'Learn CodeIgniter from scratch with this simple and easy to master course! Building dynamic websites is not an easy challenge and requires time and effort dedicated to coding every bit of the website, which is why anytime there is...\r\n', '12.jpg\r\n', 5, 'book', 'php', '\r\n'),
(13, 'Building PHP RESTful Web Services\r\n', 122, 'PHP 7 has modernized the way developers write code, simplifying various operations and adding support for several more.\r\n', '13.jpg\r\n', 5, 'book', 'php', '\r\n'),
(14, 'Getting Started with Microservices in PHP\r\n', 120, 'Microservices (aka the microservice architecture) is an architectural style that structures an application as a collection of loosely coupled services. The microservice architecture enables the continuous delivery/deployment of large...\r\n', '14.jpg\r\n', 5, 'book', 'php', '\r\n'),
(15, 'Building RESTful Web Services with PHP 7\r\n', 30, '\"REST is the most wide spread and effective standard to develop APIs for internet services. With the way PHP and its eco-system has modernized the way code is written by simplifying various operations, it is useful to develop RESTful APIs...\r\n', '15.jpg\r\n', 5, 'book', 'php', '\r\n'),
(16, 'Advanced Concepts of PHP Reactive Programming\r\n', 144, 'Reactive Programming helps us write code that is concise, clear, and readable. Combining the power of reactive programming and PHP, one of the most widely used languages, will enable you to create web applications more pragmatically...\r\n', '16.jpg\r\n', 5, 'book', 'php', '\r\n'),
(17, 'Getting started with PHP Reactive Programming\r\n', 101, 'Reactive Programming helps us write code that is concise, clear, and readable. Combining the power of reactive programming and PHP, one of the most widely used languages, will enable you to create web applications more pragmatically...\r\n', '17.jpg\r\n', 5, 'book', 'php', '\r\n'),
(18, 'Web Development with Angular and PHP\r\n\r\n', 108, 'Did you ever think of creating your own social network? In this course, we\'re going to create one using Angular and Laravel! We\'re going to build a simple social network application - “Friends\' Circle.\" Users will be able to register, lo...\r\n', '18.jpg\r\n', 5, 'book', 'php', '\r\n'),
(19, 'jQuery 1.3 with PHP\r\n', 30, 'For PHP developers, this intro to jQuery has it all. It will empower your applications with new responsive capabilities and custom-built plugins. You\'ll be amazed at the difference a few lines of JavaScript can make.\r\n', '19.jpg\r\n', 6, 'book', 'jquery', '\r\n'),
(20, 'Practical Web Development Java\r\n', 16, 'Web development has grown to become vital in shaping how humans interact, work, learn, and consume. Practical Web Development provides you with a roadmap of web development today, giving you the tools you need and the guidance to keep y...\r\n', '20.jpg\r\n', 7, 'book', 'java', '\r\n'),
(21, 'Integrating Elasticsearch with Java\r\n', 30, 'Integrating Elasticsearch with PHP and Laravel will help you to achieve just what the title suggests. This video series will walk you through everything required to integrate Elasticsearch with your PHP / Laravel web application. The section...\r\n', '21.jpg\r\n', 7, 'book', 'java', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `attempts` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `enabled`, `password`, `token`, `attempts`) VALUES
(49, 'esteban', 'blue_fire@hotmail.es', 0, '$2a$07$asxx54ahjppf45sd87a5aub7LdtrTXnn.ZQdALsthndsluPeTbv.a', '35653636356266303262323633', 0),
(51, 'estebanlui', 'estebanbluefire@gmail.com', 0, '$2a$07$asxx54ahjppf45sd87a5aub7LdtrTXnn.ZQdALsthndsluPeTbv.a', '35653638663366326433366362', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
