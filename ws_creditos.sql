-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para ws_creditos
CREATE DATABASE IF NOT EXISTS `ws_creditos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ws_creditos`;

-- Volcando estructura para tabla ws_creditos.aprobaciones
CREATE TABLE IF NOT EXISTS `aprobaciones` (
  `id_aprobacion` int NOT NULL AUTO_INCREMENT,
  `n_credito` int DEFAULT NULL,
  `estado_aprobacion` int DEFAULT '3',
  PRIMARY KEY (`id_aprobacion`),
  KEY `id_aprobacion` (`id_aprobacion`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla ws_creditos.aprobaciones: ~4 rows (aproximadamente)
INSERT INTO `aprobaciones` (`id_aprobacion`, `n_credito`, `estado_aprobacion`) VALUES
	(1, 1, 3),
	(2, 2, 1),
	(3, 3, 1),
	(4, 4, 1);

-- Volcando estructura para tabla ws_creditos.creditos
CREATE TABLE IF NOT EXISTS `creditos` (
  `n_credito` int NOT NULL AUTO_INCREMENT,
  `cedula` int DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `estado` int DEFAULT '3',
  `saldo` double DEFAULT '0',
  PRIMARY KEY (`n_credito`),
  KEY `n_credito` (`n_credito`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla ws_creditos.creditos: ~4 rows (aproximadamente)
INSERT INTO `creditos` (`n_credito`, `cedula`, `nombre`, `valor`, `estado`, `saldo`) VALUES
	(1, 1073180929, 'Laura R', 2000000, 1, 0),
	(2, 1073170989, 'David B', 1000000, 1, 0),
	(3, 1073569989, 'Andres B', 3000000, 1, 0),
	(4, 1073170989, 'Jhon R', 2000000, 1, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
