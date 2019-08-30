-- MySQL dump 10.16  Distrib 10.1.32-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: tiendas_buap
-- ------------------------------------------------------
-- Server version	10.1.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `REL_CONTEO_INVENTARIO`
--

DROP TABLE IF EXISTS `REL_CONTEO_INVENTARIO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REL_CONTEO_INVENTARIO` (
  `CONTEO_FK_PROCUTO` int(10) unsigned NOT NULL,
  `CONTEO_FK_ESPACIO` int(10) unsigned NOT NULL,
  `CONTEO_CANTIDAD` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `rel_conteo_inventario_conteo_fk_procuto_foreign` (`CONTEO_FK_PROCUTO`),
  KEY `rel_conteo_inventario_conteo_fk_espacio_foreign` (`CONTEO_FK_ESPACIO`),
  CONSTRAINT `rel_conteo_inventario_conteo_fk_espacio_foreign` FOREIGN KEY (`CONTEO_FK_ESPACIO`) REFERENCES `TIENDAS_ESPACIOS` (`ESPACIO_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_conteo_inventario_conteo_fk_procuto_foreign` FOREIGN KEY (`CONTEO_FK_PROCUTO`) REFERENCES `TIENDAS_PRODUCTOS` (`PRODUCTOS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REL_CONTEO_INVENTARIO`
--

LOCK TABLES `REL_CONTEO_INVENTARIO` WRITE;
/*!40000 ALTER TABLE `REL_CONTEO_INVENTARIO` DISABLE KEYS */;
INSERT INTO `REL_CONTEO_INVENTARIO` VALUES (1000,1,30,'2019-07-09 19:50:47','2019-07-09 20:47:49'),(1002,2,10,'2019-07-10 14:40:42','2019-07-10 14:41:20');
/*!40000 ALTER TABLE `REL_CONTEO_INVENTARIO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REL_DEVOLUCIONES`
--

DROP TABLE IF EXISTS `REL_DEVOLUCIONES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REL_DEVOLUCIONES` (
  `FK_VENTA` int(10) unsigned NOT NULL,
  `FK_DEV_PROD_INICIAL` int(10) unsigned NOT NULL,
  `FK_DEV_PROD_CAMBIO` int(10) unsigned NOT NULL,
  `FK_USUARIO` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `REL_DEV_MOTIVO` text COLLATE utf8mb4_unicode_ci,
  KEY `rel_devoluciones_fk_venta_foreign` (`FK_VENTA`),
  KEY `rel_devoluciones_fk_dev_prod_inicial_foreign` (`FK_DEV_PROD_INICIAL`),
  KEY `rel_devoluciones_fk_dev_prod_cambio_foreign` (`FK_DEV_PROD_CAMBIO`),
  KEY `rel_devoluciones_fk_usuario_foreign` (`FK_USUARIO`),
  CONSTRAINT `rel_devoluciones_fk_dev_prod_cambio_foreign` FOREIGN KEY (`FK_DEV_PROD_CAMBIO`) REFERENCES `TIENDAS_DEVOLUCIONES` (`DEVOLUCIONES_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_devoluciones_fk_dev_prod_inicial_foreign` FOREIGN KEY (`FK_DEV_PROD_INICIAL`) REFERENCES `TIENDAS_DEVOLUCIONES` (`DEVOLUCIONES_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_devoluciones_fk_usuario_foreign` FOREIGN KEY (`FK_USUARIO`) REFERENCES `TIENDAS_LOGIN` (`LOGIN_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_devoluciones_fk_venta_foreign` FOREIGN KEY (`FK_VENTA`) REFERENCES `TIENDAS_VENTAS` (`VENTAS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REL_DEVOLUCIONES`
--

LOCK TABLES `REL_DEVOLUCIONES` WRITE;
/*!40000 ALTER TABLE `REL_DEVOLUCIONES` DISABLE KEYS */;
INSERT INTO `REL_DEVOLUCIONES` VALUES (1,3,4,'cajero','acascas');
/*!40000 ALTER TABLE `REL_DEVOLUCIONES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REL_HISTORIAL_PRODUCTO`
--

DROP TABLE IF EXISTS `REL_HISTORIAL_PRODUCTO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REL_HISTORIAL_PRODUCTO` (
  `FK_PROCUTO` int(10) unsigned NOT NULL,
  `FK_HISTORIAL` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `rel_historial_producto_fk_procuto_foreign` (`FK_PROCUTO`),
  KEY `rel_historial_producto_fk_historial_foreign` (`FK_HISTORIAL`),
  CONSTRAINT `rel_historial_producto_fk_historial_foreign` FOREIGN KEY (`FK_HISTORIAL`) REFERENCES `TIENDAS_HISTORIAL` (`HISTORIAL_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_historial_producto_fk_procuto_foreign` FOREIGN KEY (`FK_PROCUTO`) REFERENCES `TIENDAS_PRODUCTOS` (`PRODUCTOS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REL_HISTORIAL_PRODUCTO`
--

LOCK TABLES `REL_HISTORIAL_PRODUCTO` WRITE;
/*!40000 ALTER TABLE `REL_HISTORIAL_PRODUCTO` DISABLE KEYS */;
INSERT INTO `REL_HISTORIAL_PRODUCTO` VALUES (1000,1,NULL,NULL),(1001,2,NULL,NULL),(1000,3,NULL,NULL),(1001,4,NULL,NULL),(1000,5,NULL,NULL),(1001,6,NULL,NULL),(1000,7,NULL,NULL),(1001,8,NULL,NULL),(1000,9,NULL,NULL),(1000,10,NULL,NULL),(1000,11,NULL,NULL),(1000,12,NULL,NULL),(1000,13,NULL,NULL),(1000,14,NULL,NULL),(1002,15,NULL,NULL),(1000,16,NULL,NULL),(1002,17,NULL,NULL),(1002,18,NULL,NULL),(1002,19,NULL,NULL),(1002,20,NULL,NULL),(1002,21,NULL,NULL),(1002,22,NULL,NULL),(1002,23,NULL,NULL),(1002,24,NULL,NULL),(1002,25,NULL,NULL),(1002,26,NULL,NULL);
/*!40000 ALTER TABLE `REL_HISTORIAL_PRODUCTO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REL_INVENTARIO`
--

DROP TABLE IF EXISTS `REL_INVENTARIO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REL_INVENTARIO` (
  `DATOS_VENTA_FK_PROCUTO` int(10) unsigned NOT NULL,
  `DATOS_VENTA_FK_ESPACIO` int(10) unsigned NOT NULL,
  `DATOS_VENTA_CANTIDAD` int(11) NOT NULL,
  `DATOS_VENTA_INVENTARIO_MINIMO` int(11) DEFAULT NULL,
  KEY `rel_inventario_datos_venta_fk_procuto_foreign` (`DATOS_VENTA_FK_PROCUTO`),
  KEY `rel_inventario_datos_venta_fk_espacio_foreign` (`DATOS_VENTA_FK_ESPACIO`),
  CONSTRAINT `rel_inventario_datos_venta_fk_espacio_foreign` FOREIGN KEY (`DATOS_VENTA_FK_ESPACIO`) REFERENCES `TIENDAS_ESPACIOS` (`ESPACIO_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_inventario_datos_venta_fk_procuto_foreign` FOREIGN KEY (`DATOS_VENTA_FK_PROCUTO`) REFERENCES `TIENDAS_PRODUCTOS` (`PRODUCTOS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REL_INVENTARIO`
--

LOCK TABLES `REL_INVENTARIO` WRITE;
/*!40000 ALTER TABLE `REL_INVENTARIO` DISABLE KEYS */;
INSERT INTO `REL_INVENTARIO` VALUES (1000,1,1849,NULL),(1001,1,900,NULL),(1000,2,74,NULL),(1001,2,90,NULL),(1002,1,552,NULL),(1002,2,128,NULL);
/*!40000 ALTER TABLE `REL_INVENTARIO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REL_MOVILIZACION_PRODUCTO`
--

DROP TABLE IF EXISTS `REL_MOVILIZACION_PRODUCTO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REL_MOVILIZACION_PRODUCTO` (
  `REL_MOV_FK_MOVILIZACION` int(10) unsigned NOT NULL,
  `REL_MOV_FK_PROCUTO` int(10) unsigned NOT NULL,
  `REL_MOV_FK_EMISOR` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `REL_MOV_FK_RECEPTOR` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `REL_MOV_ESTATUS` enum('PENDIENTE','FINALIZADO','CANCELADO') COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `rel_movilizacion_producto_rel_mov_fk_movilizacion_foreign` (`REL_MOV_FK_MOVILIZACION`),
  KEY `rel_movilizacion_producto_rel_mov_fk_procuto_foreign` (`REL_MOV_FK_PROCUTO`),
  KEY `rel_movilizacion_producto_rel_mov_fk_emisor_foreign` (`REL_MOV_FK_EMISOR`),
  KEY `rel_movilizacion_producto_rel_mov_fk_receptor_foreign` (`REL_MOV_FK_RECEPTOR`),
  CONSTRAINT `rel_movilizacion_producto_rel_mov_fk_emisor_foreign` FOREIGN KEY (`REL_MOV_FK_EMISOR`) REFERENCES `TIENDAS_LOGIN` (`LOGIN_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_movilizacion_producto_rel_mov_fk_movilizacion_foreign` FOREIGN KEY (`REL_MOV_FK_MOVILIZACION`) REFERENCES `TIENDAS_MOVILIZACION_INVENTARIO` (`MOVILIZACION_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_movilizacion_producto_rel_mov_fk_procuto_foreign` FOREIGN KEY (`REL_MOV_FK_PROCUTO`) REFERENCES `TIENDAS_PRODUCTOS` (`PRODUCTOS_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_movilizacion_producto_rel_mov_fk_receptor_foreign` FOREIGN KEY (`REL_MOV_FK_RECEPTOR`) REFERENCES `TIENDAS_LOGIN` (`LOGIN_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REL_MOVILIZACION_PRODUCTO`
--

LOCK TABLES `REL_MOVILIZACION_PRODUCTO` WRITE;
/*!40000 ALTER TABLE `REL_MOVILIZACION_PRODUCTO` DISABLE KEYS */;
INSERT INTO `REL_MOVILIZACION_PRODUCTO` VALUES (1,1000,'cajero','cajero','FINALIZADO'),(2,1001,'cajero','cajero','FINALIZADO'),(4,1000,'cajero',NULL,'PENDIENTE'),(5,1002,'administrador',NULL,'CANCELADO'),(6,1002,'administrador',NULL,'PENDIENTE'),(7,1002,'administrador','cajero','FINALIZADO'),(8,1002,'administrador',NULL,'PENDIENTE');
/*!40000 ALTER TABLE `REL_MOVILIZACION_PRODUCTO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REL_PAGO_DEPOSITO`
--

DROP TABLE IF EXISTS `REL_PAGO_DEPOSITO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REL_PAGO_DEPOSITO` (
  `PAGO_DEPOSITO_FK_VENTA` int(10) unsigned NOT NULL,
  `PAGO_DEPOSITO_FICHA` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `rel_pago_deposito_pago_deposito_fk_venta_foreign` (`PAGO_DEPOSITO_FK_VENTA`),
  CONSTRAINT `rel_pago_deposito_pago_deposito_fk_venta_foreign` FOREIGN KEY (`PAGO_DEPOSITO_FK_VENTA`) REFERENCES `TIENDAS_VENTAS` (`VENTAS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REL_PAGO_DEPOSITO`
--

LOCK TABLES `REL_PAGO_DEPOSITO` WRITE;
/*!40000 ALTER TABLE `REL_PAGO_DEPOSITO` DISABLE KEYS */;
INSERT INTO `REL_PAGO_DEPOSITO` VALUES (6,'65465451','2019-07-01 19:33:04',NULL);
/*!40000 ALTER TABLE `REL_PAGO_DEPOSITO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REL_PAGO_MIXTO`
--

DROP TABLE IF EXISTS `REL_PAGO_MIXTO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REL_PAGO_MIXTO` (
  `PAGO_MIXTO_FK_VENTA` int(10) unsigned NOT NULL,
  `PAGO_MIXTO_EFECTIVO` double(8,2) NOT NULL,
  `PAGO_MIXTO_CREDITO` double(8,2) NOT NULL,
  `PAGO_MIXTO_DEBITO` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `rel_pago_mixto_pago_mixto_fk_venta_foreign` (`PAGO_MIXTO_FK_VENTA`),
  CONSTRAINT `rel_pago_mixto_pago_mixto_fk_venta_foreign` FOREIGN KEY (`PAGO_MIXTO_FK_VENTA`) REFERENCES `TIENDAS_VENTAS` (`VENTAS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REL_PAGO_MIXTO`
--

LOCK TABLES `REL_PAGO_MIXTO` WRITE;
/*!40000 ALTER TABLE `REL_PAGO_MIXTO` DISABLE KEYS */;
INSERT INTO `REL_PAGO_MIXTO` VALUES (3,0.00,4000.00,1000.00,'2019-07-01 19:31:00',NULL),(10,100.00,0.00,200.00,'2019-07-10 18:56:12',NULL);
/*!40000 ALTER TABLE `REL_PAGO_MIXTO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REL_PAGO_NOMINA`
--

DROP TABLE IF EXISTS `REL_PAGO_NOMINA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REL_PAGO_NOMINA` (
  `PAGO_NOMINA_FK_VENTA` int(10) unsigned NOT NULL,
  `PAGO_NOMINA_ID_TRAB` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PAGO_NOMINA_NOMBRE_TRAB` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PAGO_NOMINA_QUINCENAS_TRAB` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `rel_pago_nomina_pago_nomina_fk_venta_foreign` (`PAGO_NOMINA_FK_VENTA`),
  CONSTRAINT `rel_pago_nomina_pago_nomina_fk_venta_foreign` FOREIGN KEY (`PAGO_NOMINA_FK_VENTA`) REFERENCES `TIENDAS_VENTAS` (`VENTAS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REL_PAGO_NOMINA`
--

LOCK TABLES `REL_PAGO_NOMINA` WRITE;
/*!40000 ALTER TABLE `REL_PAGO_NOMINA` DISABLE KEYS */;
INSERT INTO `REL_PAGO_NOMINA` VALUES (2,'145465465','Marvin Gabriel Eliosa Abaroa','2','2019-07-01 19:27:59',NULL),(9,'Marvin','1000842','3','2019-07-10 14:30:35',NULL);
/*!40000 ALTER TABLE `REL_PAGO_NOMINA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REL_PAGO_TRANSFERENCIA`
--

DROP TABLE IF EXISTS `REL_PAGO_TRANSFERENCIA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REL_PAGO_TRANSFERENCIA` (
  `PAGO_TRANSFERENCIA_FK_VENTA` int(10) unsigned NOT NULL,
  `PAGO_TRANSFERENCIA_OPERACION` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `rel_pago_transferencia_pago_transferencia_fk_venta_foreign` (`PAGO_TRANSFERENCIA_FK_VENTA`),
  CONSTRAINT `rel_pago_transferencia_pago_transferencia_fk_venta_foreign` FOREIGN KEY (`PAGO_TRANSFERENCIA_FK_VENTA`) REFERENCES `TIENDAS_VENTAS` (`VENTAS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REL_PAGO_TRANSFERENCIA`
--

LOCK TABLES `REL_PAGO_TRANSFERENCIA` WRITE;
/*!40000 ALTER TABLE `REL_PAGO_TRANSFERENCIA` DISABLE KEYS */;
INSERT INTO `REL_PAGO_TRANSFERENCIA` VALUES (5,'8464348','2019-07-01 19:32:08',NULL);
/*!40000 ALTER TABLE `REL_PAGO_TRANSFERENCIA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REL_PRODUCTO_NOTA_ENTRADA`
--

DROP TABLE IF EXISTS `REL_PRODUCTO_NOTA_ENTRADA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REL_PRODUCTO_NOTA_ENTRADA` (
  `FK_PROCUTO` int(10) unsigned NOT NULL,
  `FK_NOTA_ENTRADA` int(10) unsigned NOT NULL,
  KEY `rel_producto_nota_entrada_fk_procuto_foreign` (`FK_PROCUTO`),
  KEY `rel_producto_nota_entrada_fk_nota_entrada_foreign` (`FK_NOTA_ENTRADA`),
  CONSTRAINT `rel_producto_nota_entrada_fk_nota_entrada_foreign` FOREIGN KEY (`FK_NOTA_ENTRADA`) REFERENCES `TIENDAS_NOTA_ENTRADA` (`NOTA_ENTRADA_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_producto_nota_entrada_fk_procuto_foreign` FOREIGN KEY (`FK_PROCUTO`) REFERENCES `TIENDAS_PRODUCTOS` (`PRODUCTOS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REL_PRODUCTO_NOTA_ENTRADA`
--

LOCK TABLES `REL_PRODUCTO_NOTA_ENTRADA` WRITE;
/*!40000 ALTER TABLE `REL_PRODUCTO_NOTA_ENTRADA` DISABLE KEYS */;
INSERT INTO `REL_PRODUCTO_NOTA_ENTRADA` VALUES (1000,1),(1001,2),(1000,3),(1000,4),(1000,5),(1000,6),(1000,7),(1000,8),(1000,9),(1000,10),(1002,11),(1002,12);
/*!40000 ALTER TABLE `REL_PRODUCTO_NOTA_ENTRADA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REL_QUINCENAS_VENTA`
--

DROP TABLE IF EXISTS `REL_QUINCENAS_VENTA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REL_QUINCENAS_VENTA` (
  `REL_QUINCENAS_FK_VENTA` int(10) unsigned NOT NULL,
  `REL_QUINCENAS_FK_QUINCENA` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `rel_quincenas_venta_rel_quincenas_fk_venta_foreign` (`REL_QUINCENAS_FK_VENTA`),
  KEY `rel_quincenas_venta_rel_quincenas_fk_quincena_foreign` (`REL_QUINCENAS_FK_QUINCENA`),
  CONSTRAINT `rel_quincenas_venta_rel_quincenas_fk_quincena_foreign` FOREIGN KEY (`REL_QUINCENAS_FK_QUINCENA`) REFERENCES `TIENDAS_QUINCENAS` (`QUINCENAS_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_quincenas_venta_rel_quincenas_fk_venta_foreign` FOREIGN KEY (`REL_QUINCENAS_FK_VENTA`) REFERENCES `TIENDAS_VENTAS` (`VENTAS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REL_QUINCENAS_VENTA`
--

LOCK TABLES `REL_QUINCENAS_VENTA` WRITE;
/*!40000 ALTER TABLE `REL_QUINCENAS_VENTA` DISABLE KEYS */;
INSERT INTO `REL_QUINCENAS_VENTA` VALUES (2,1,NULL,NULL),(2,2,NULL,NULL),(9,3,NULL,NULL),(9,4,NULL,NULL),(9,5,NULL,NULL);
/*!40000 ALTER TABLE `REL_QUINCENAS_VENTA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REL_USUARIO_ESPACIO`
--

DROP TABLE IF EXISTS `REL_USUARIO_ESPACIO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REL_USUARIO_ESPACIO` (
  `FK_USUARIO` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FK_ESPACIO` int(10) unsigned NOT NULL,
  KEY `rel_usuario_espacio_fk_usuario_foreign` (`FK_USUARIO`),
  KEY `rel_usuario_espacio_fk_espacio_foreign` (`FK_ESPACIO`),
  CONSTRAINT `rel_usuario_espacio_fk_espacio_foreign` FOREIGN KEY (`FK_ESPACIO`) REFERENCES `TIENDAS_ESPACIOS` (`ESPACIO_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_usuario_espacio_fk_usuario_foreign` FOREIGN KEY (`FK_USUARIO`) REFERENCES `TIENDAS_LOGIN` (`LOGIN_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REL_USUARIO_ESPACIO`
--

LOCK TABLES `REL_USUARIO_ESPACIO` WRITE;
/*!40000 ALTER TABLE `REL_USUARIO_ESPACIO` DISABLE KEYS */;
INSERT INTO `REL_USUARIO_ESPACIO` VALUES ('cajero',2);
/*!40000 ALTER TABLE `REL_USUARIO_ESPACIO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REL_VENTA_FACTURA`
--

DROP TABLE IF EXISTS `REL_VENTA_FACTURA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REL_VENTA_FACTURA` (
  `REL_FACTURA_FK_VENTA` int(10) unsigned NOT NULL,
  `REL_FACTURA_NUMERO` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `rel_venta_factura_rel_factura_fk_venta_foreign` (`REL_FACTURA_FK_VENTA`),
  CONSTRAINT `rel_venta_factura_rel_factura_fk_venta_foreign` FOREIGN KEY (`REL_FACTURA_FK_VENTA`) REFERENCES `TIENDAS_VENTAS` (`VENTAS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REL_VENTA_FACTURA`
--

LOCK TABLES `REL_VENTA_FACTURA` WRITE;
/*!40000 ALTER TABLE `REL_VENTA_FACTURA` DISABLE KEYS */;
/*!40000 ALTER TABLE `REL_VENTA_FACTURA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REL_VENTA_PRODUCTO`
--

DROP TABLE IF EXISTS `REL_VENTA_PRODUCTO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REL_VENTA_PRODUCTO` (
  `REL_VENTA_FK_VENTA` int(10) unsigned NOT NULL,
  `REL_VENTA_FK_PROCUTO` int(10) unsigned NOT NULL,
  `REL_VENTA_FK_ESPACIO` int(10) unsigned NOT NULL,
  `REL_VENTA_FK_USUARIO` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `REL_VENTA_PRECIO` double(8,2) NOT NULL,
  `REL_VENTA_CANTIDAD` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `rel_venta_producto_rel_venta_fk_venta_foreign` (`REL_VENTA_FK_VENTA`),
  KEY `rel_venta_producto_rel_venta_fk_procuto_foreign` (`REL_VENTA_FK_PROCUTO`),
  KEY `rel_venta_producto_rel_venta_fk_espacio_foreign` (`REL_VENTA_FK_ESPACIO`),
  KEY `rel_venta_producto_rel_venta_fk_usuario_foreign` (`REL_VENTA_FK_USUARIO`),
  CONSTRAINT `rel_venta_producto_rel_venta_fk_espacio_foreign` FOREIGN KEY (`REL_VENTA_FK_ESPACIO`) REFERENCES `TIENDAS_ESPACIOS` (`ESPACIO_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_venta_producto_rel_venta_fk_procuto_foreign` FOREIGN KEY (`REL_VENTA_FK_PROCUTO`) REFERENCES `TIENDAS_PRODUCTOS` (`PRODUCTOS_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_venta_producto_rel_venta_fk_usuario_foreign` FOREIGN KEY (`REL_VENTA_FK_USUARIO`) REFERENCES `TIENDAS_LOGIN` (`LOGIN_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_venta_producto_rel_venta_fk_venta_foreign` FOREIGN KEY (`REL_VENTA_FK_VENTA`) REFERENCES `TIENDAS_VENTAS` (`VENTAS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REL_VENTA_PRODUCTO`
--

LOCK TABLES `REL_VENTA_PRODUCTO` WRITE;
/*!40000 ALTER TABLE `REL_VENTA_PRODUCTO` DISABLE KEYS */;
INSERT INTO `REL_VENTA_PRODUCTO` VALUES (1,1000,2,'cajero',350.00,4,'2019-07-01 19:26:26',NULL),(1,1001,2,'cajero',450.00,5,'2019-07-01 19:26:26',NULL),(2,1000,2,'cajero',350.00,2,'2019-07-01 19:27:59',NULL),(3,1000,2,'cajero',350.00,4,'2019-07-01 19:31:00',NULL),(4,1001,2,'cajero',450.00,4,'2019-07-01 19:31:46',NULL),(5,1000,2,'cajero',350.00,2,'2019-07-01 19:32:08',NULL),(5,1001,2,'cajero',450.00,1,'2019-07-01 19:32:09',NULL),(6,1000,2,'cajero',350.00,2,'2019-07-01 19:33:04',NULL),(7,1000,2,'cajero',350.00,1,'2019-07-01 19:35:20',NULL),(8,1000,2,'cajero',280.00,6,'2019-07-10 14:29:35',NULL),(9,1000,2,'cajero',280.00,1,'2019-07-10 14:30:35',NULL),(10,1000,2,'cajero',280.00,1,'2019-07-10 18:56:12',NULL),(11,1000,2,'cajero',280.00,3,'2019-08-05 19:36:56',NULL);
/*!40000 ALTER TABLE `REL_VENTA_PRODUCTO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TIENDAS_DATOS_VENTA_PRODUCTO`
--

DROP TABLE IF EXISTS `TIENDAS_DATOS_VENTA_PRODUCTO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TIENDAS_DATOS_VENTA_PRODUCTO` (
  `DATOS_VENTA_FK_PROCUTO` int(10) unsigned NOT NULL,
  `DATOS_VENTA_PRECIO` double(8,2) DEFAULT NULL,
  `DATOS_VENTA_DESCUENTO` int(11) DEFAULT NULL,
  KEY `tiendas_datos_venta_producto_datos_venta_fk_procuto_foreign` (`DATOS_VENTA_FK_PROCUTO`),
  CONSTRAINT `tiendas_datos_venta_producto_datos_venta_fk_procuto_foreign` FOREIGN KEY (`DATOS_VENTA_FK_PROCUTO`) REFERENCES `TIENDAS_PRODUCTOS` (`PRODUCTOS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TIENDAS_DATOS_VENTA_PRODUCTO`
--

LOCK TABLES `TIENDAS_DATOS_VENTA_PRODUCTO` WRITE;
/*!40000 ALTER TABLE `TIENDAS_DATOS_VENTA_PRODUCTO` DISABLE KEYS */;
INSERT INTO `TIENDAS_DATOS_VENTA_PRODUCTO` VALUES (1000,350.00,20),(1001,450.00,0),(1002,25.00,10);
/*!40000 ALTER TABLE `TIENDAS_DATOS_VENTA_PRODUCTO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TIENDAS_DEVOLUCIONES`
--

DROP TABLE IF EXISTS `TIENDAS_DEVOLUCIONES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TIENDAS_DEVOLUCIONES` (
  `DEVOLUCIONES_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DEVOLUCIONES_PROCUTO_ID` int(10) unsigned NOT NULL,
  `DEVOLUCIONES_CANTIDAD` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`DEVOLUCIONES_ID`),
  KEY `tiendas_devoluciones_devoluciones_procuto_id_foreign` (`DEVOLUCIONES_PROCUTO_ID`),
  CONSTRAINT `tiendas_devoluciones_devoluciones_procuto_id_foreign` FOREIGN KEY (`DEVOLUCIONES_PROCUTO_ID`) REFERENCES `TIENDAS_PRODUCTOS` (`PRODUCTOS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TIENDAS_DEVOLUCIONES`
--

LOCK TABLES `TIENDAS_DEVOLUCIONES` WRITE;
/*!40000 ALTER TABLE `TIENDAS_DEVOLUCIONES` DISABLE KEYS */;
INSERT INTO `TIENDAS_DEVOLUCIONES` VALUES (3,1000,4,'2019-08-22 15:59:27',NULL),(4,1002,5,'2019-08-22 15:59:27',NULL);
/*!40000 ALTER TABLE `TIENDAS_DEVOLUCIONES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TIENDAS_ESPACIOS`
--

DROP TABLE IF EXISTS `TIENDAS_ESPACIOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TIENDAS_ESPACIOS` (
  `ESPACIO_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ESPACIO_NOMBRE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ESPACIO_UBICACION` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ESPACIO_SIGLAS` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ESPACIO_TIPO` enum('BODEGA','TIENDA') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ESPACIO_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TIENDAS_ESPACIOS`
--

LOCK TABLES `TIENDAS_ESPACIOS` WRITE;
/*!40000 ALTER TABLE `TIENDAS_ESPACIOS` DISABLE KEYS */;
INSERT INTO `TIENDAS_ESPACIOS` VALUES (1,'Bodega 1','DAPI','B1','BODEGA','2019-06-28 20:37:01',NULL),(2,'Tienda Lobos CU','Ciudad Universitaria','CU','TIENDA','2019-06-28 20:37:30',NULL),(3,'Tienda BUAP CCU','Complejo Cultural Universitario','CCU','TIENDA','2019-07-02 15:46:46',NULL),(4,'Tienda BUAP Centro','Centro','CN','TIENDA','2019-07-10 14:20:45',NULL);
/*!40000 ALTER TABLE `TIENDAS_ESPACIOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TIENDAS_HISTORIAL`
--

DROP TABLE IF EXISTS `TIENDAS_HISTORIAL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TIENDAS_HISTORIAL` (
  `HISTORIAL_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `HISTORIAL_TEXTO` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`HISTORIAL_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TIENDAS_HISTORIAL`
--

LOCK TABLES `TIENDAS_HISTORIAL` WRITE;
/*!40000 ALTER TABLE `TIENDAS_HISTORIAL` DISABLE KEYS */;
INSERT INTO `TIENDAS_HISTORIAL` VALUES (1,'cajero - Se ha creado el producto Playera Lobos. El codigo asignado por el sistema es 1000','2019-06-28 20:33:42',NULL),(2,'cajero - Se ha creado el producto Audifonos Bluetooth. El codigo asignado por el sistema es 1001','2019-06-28 20:34:11',NULL),(3,'cajero - Se ha registrado la nota de venta 1. La nota de venta se ha enlazado al producto 1000','2019-06-28 20:38:54',NULL),(4,'cajero - Se ha registrado la nota de venta 2. La nota de venta se ha enlazado al producto 1001','2019-06-28 20:39:06',NULL),(5,'cajero - Movilización de inventario del producto 1000, de Bodega 1 a Tienda Lobos CU. Unidades movilizadas: 100','2019-06-28 20:41:45',NULL),(6,'cajero - Movilización de inventario del producto 1001, de Bodega 1 a Tienda Lobos CU. Unidades movilizadas: 100','2019-06-28 20:41:56',NULL),(7,'cajero - Recepción de inventario exitosa en Tienda Lobos CU de 100 unidades del producto 1000','2019-06-28 20:42:54',NULL),(8,'cajero - Recepción de inventario exitosa en Tienda Lobos CU de 100 unidades del producto 1001','2019-06-28 20:42:58',NULL),(9,'administrador - Se ha registrado la nota de venta 3. La nota de venta se ha enlazado al producto 1000','2019-07-09 18:25:34',NULL),(10,' - Se ha registrado la nota de venta 8. La nota de venta se ha enlazado al producto 1000','2019-07-10 13:28:50',NULL),(11,' - Se ha registrado la nota de venta 9. La nota de venta se ha enlazado al producto 1000','2019-07-10 13:32:09',NULL),(12,' - Se ha editado los datos del producto Playera Cuello Redondo','2019-07-10 13:32:59',NULL),(13,' - Se ha actualizado los datos de venta del producto  Precio: $350, Descuento: 20%','2019-07-10 13:33:14',NULL),(14,'cajero - Movilización de inventario del producto 1000, de Bodega 1 a Tienda Lobos CU. Unidades movilizadas: 29','2019-07-10 13:37:13',NULL),(15,'administrador - Se ha creado el producto Aplaudidor. El codigo asignado por el sistema es 1002','2019-07-10 13:57:23',NULL),(16,'administrador - Se ha registrado la nota de venta 10. La nota de venta se ha enlazado al producto 1000','2019-07-10 14:00:55',NULL),(17,'administrador - Se ha registrado la nota de venta 11. La nota de venta se ha enlazado al producto 1002','2019-07-10 14:01:49',NULL),(18,'administrador - Se ha editado los datos del producto Aplaudidor','2019-07-10 14:10:28',NULL),(19,'administrador - Se ha actualizado los datos de venta del producto  Precio: $25, Descuento: 10%','2019-07-10 14:10:49',NULL),(20,'administrador - Movilización de inventario del producto 1002, de Bodega 1 a Tienda Lobos CU. Unidades movilizadas: 100','2019-07-10 14:11:56',NULL),(21,'administrador - Movilización de inventario del producto 1002, de Bodega 1 a Tienda BUAP CCU. Unidades movilizadas: 100','2019-07-10 14:13:57',NULL),(22,'administrador - Se ha cancelado la movilizacion de inventario de 100 unidades del producto 1002 que tenían como destino Bodega 1.','2019-07-10 14:16:44',NULL),(23,'administrador - Movilización de inventario del producto 1002, de Bodega 1 a Tienda Lobos CU. Unidades movilizadas: 98','2019-07-10 14:18:17',NULL),(24,'cajero - Recepción de inventario exitosa en Tienda Lobos CU de 98 unidades del producto 1002','2019-07-10 14:18:41',NULL),(25,'administrador - Movilización de inventario del producto 1002, de Bodega 1 a Tienda BUAP Centro. Unidades movilizadas: 100','2019-07-10 14:21:22',NULL),(26,'cajero - Se ha registrado la nota de venta 12. La nota de venta se ha enlazado al producto 1002','2019-07-10 14:40:19',NULL);
/*!40000 ALTER TABLE `TIENDAS_HISTORIAL` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TIENDAS_LOGIN`
--

DROP TABLE IF EXISTS `TIENDAS_LOGIN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TIENDAS_LOGIN` (
  `LOGIN_ID` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LOGIN_CONTRASENIA` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LOGIN_CATEGORIA` enum('ADMINISTRADOR','ENCARGADO','CAJERO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `LOGIN_RESPONSABLE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`LOGIN_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TIENDAS_LOGIN`
--

LOCK TABLES `TIENDAS_LOGIN` WRITE;
/*!40000 ALTER TABLE `TIENDAS_LOGIN` DISABLE KEYS */;
INSERT INTO `TIENDAS_LOGIN` VALUES ('administrador','123456','ADMINISTRADOR','USUARIO ADMINISTRADOR',NULL,NULL),('cajero','123456','CAJERO','USUARIO CAJERO',NULL,NULL),('encargado','123456','ENCARGADO','USUARIO ENCARGADO',NULL,NULL);
/*!40000 ALTER TABLE `TIENDAS_LOGIN` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TIENDAS_MOVILIZACION_INVENTARIO`
--

DROP TABLE IF EXISTS `TIENDAS_MOVILIZACION_INVENTARIO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TIENDAS_MOVILIZACION_INVENTARIO` (
  `MOVILIZACION_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MOVILIZACION_ORIGEN` int(10) unsigned NOT NULL,
  `MOVILIZACION_DESTINO` int(10) unsigned NOT NULL,
  `MOVILIZACION_CANTIDAD` int(11) NOT NULL,
  `MOVILIZACION_FECHA_MOVIMIENTO` date NOT NULL,
  `MOVILIZACION_FECHA_RECEPCION` date DEFAULT NULL,
  `MOVILIZACION_FECHA_CANCELACION` date DEFAULT NULL,
  PRIMARY KEY (`MOVILIZACION_ID`),
  KEY `tiendas_movilizacion_inventario_movilizacion_origen_foreign` (`MOVILIZACION_ORIGEN`),
  KEY `tiendas_movilizacion_inventario_movilizacion_destino_foreign` (`MOVILIZACION_DESTINO`),
  CONSTRAINT `tiendas_movilizacion_inventario_movilizacion_destino_foreign` FOREIGN KEY (`MOVILIZACION_DESTINO`) REFERENCES `TIENDAS_ESPACIOS` (`ESPACIO_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tiendas_movilizacion_inventario_movilizacion_origen_foreign` FOREIGN KEY (`MOVILIZACION_ORIGEN`) REFERENCES `TIENDAS_ESPACIOS` (`ESPACIO_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TIENDAS_MOVILIZACION_INVENTARIO`
--

LOCK TABLES `TIENDAS_MOVILIZACION_INVENTARIO` WRITE;
/*!40000 ALTER TABLE `TIENDAS_MOVILIZACION_INVENTARIO` DISABLE KEYS */;
INSERT INTO `TIENDAS_MOVILIZACION_INVENTARIO` VALUES (1,1,2,100,'2019-06-28','2019-06-28',NULL),(2,1,2,100,'2019-06-28','2019-06-28',NULL),(3,1,2,29,'2019-07-10',NULL,NULL),(4,1,2,29,'2019-07-10',NULL,NULL),(5,1,2,100,'2019-07-10',NULL,'2019-07-10'),(6,1,3,100,'2019-07-10',NULL,NULL),(7,1,2,98,'2019-07-10','2019-07-10',NULL),(8,1,4,100,'2019-07-10',NULL,NULL);
/*!40000 ALTER TABLE `TIENDAS_MOVILIZACION_INVENTARIO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TIENDAS_NOTA_ENTRADA`
--

DROP TABLE IF EXISTS `TIENDAS_NOTA_ENTRADA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TIENDAS_NOTA_ENTRADA` (
  `NOTA_ENTRADA_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NOTA_ENTRADA_PRECIO_COMPRA` double(8,2) NOT NULL,
  `NOTA_ENTRADA_CANTIDAD` int(11) NOT NULL,
  `NOTA_ENTRADA_OBSERVACIONES` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`NOTA_ENTRADA_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TIENDAS_NOTA_ENTRADA`
--

LOCK TABLES `TIENDAS_NOTA_ENTRADA` WRITE;
/*!40000 ALTER TABLE `TIENDAS_NOTA_ENTRADA` DISABLE KEYS */;
INSERT INTO `TIENDAS_NOTA_ENTRADA` VALUES (1,200.00,1000,NULL,'2019-06-28 20:38:54',NULL),(2,300.00,1000,NULL,'2019-06-28 20:39:06',NULL),(3,150.00,50,'observaciones','2019-07-09 18:25:34',NULL),(4,150.00,40,'Observaciones','2019-07-09 20:49:18',NULL),(5,150.00,40,'Observaciones','2019-07-09 20:50:22',NULL),(6,150.00,30,'observaciones','2019-07-10 13:15:56',NULL),(7,150.00,30,'observaciones','2019-07-10 13:20:31',NULL),(8,150.00,30,NULL,'2019-07-10 13:28:50',NULL),(9,150.00,49,'observaciones','2019-07-10 13:32:08',NULL),(10,15.00,849,'Un aplaudidor viene raspado y se devolvió','2019-07-10 14:00:54',NULL),(11,15.00,850,'observaciones','2019-07-10 14:01:49',NULL),(12,17.00,30,'observaciones','2019-07-10 14:40:18',NULL);
/*!40000 ALTER TABLE `TIENDAS_NOTA_ENTRADA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TIENDAS_PRODUCTOS`
--

DROP TABLE IF EXISTS `TIENDAS_PRODUCTOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TIENDAS_PRODUCTOS` (
  `PRODUCTOS_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PRODUCTOS_NOMBRE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PRODUCTOS_COLOR` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PRODUCTOS_GENERO` enum('DAMA','CABALLERO','UNISEX') COLLATE utf8mb4_unicode_ci NOT NULL,
  `PRODUCTOS_TALLA` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PRODUCTOS_OBSERVACIONES` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`PRODUCTOS_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1003 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TIENDAS_PRODUCTOS`
--

LOCK TABLES `TIENDAS_PRODUCTOS` WRITE;
/*!40000 ALTER TABLE `TIENDAS_PRODUCTOS` DISABLE KEYS */;
INSERT INTO `TIENDAS_PRODUCTOS` VALUES (1000,'Playera Cuello Redondo','Blando','UNISEX','M',NULL,'2019-06-28 20:33:42','2019-07-10 13:32:58'),(1001,'Audifonos Bluetooth','Negro','UNISEX','SIN TALLA',NULL,'2019-06-28 20:34:11',NULL),(1002,'Aplaudidor','Blanco','UNISEX','SIN TALLA','Platico duro, pintadas','2019-07-10 13:57:23','2019-07-10 14:10:28');
/*!40000 ALTER TABLE `TIENDAS_PRODUCTOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TIENDAS_QUINCENAS`
--

DROP TABLE IF EXISTS `TIENDAS_QUINCENAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TIENDAS_QUINCENAS` (
  `QUINCENAS_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `QUINCENAS_ESTATUS` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `QUINCENAS_FECHA_ESTIMADA` date DEFAULT NULL,
  `QUINCENAS_FECHA_PAGO` datetime DEFAULT NULL,
  `QUINCENAS_OBSERVACIONES` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`QUINCENAS_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TIENDAS_QUINCENAS`
--

LOCK TABLES `TIENDAS_QUINCENAS` WRITE;
/*!40000 ALTER TABLE `TIENDAS_QUINCENAS` DISABLE KEYS */;
INSERT INTO `TIENDAS_QUINCENAS` VALUES (1,'PENDIENTE',NULL,NULL,NULL,'2019-07-01 19:27:59',NULL),(2,'PENDIENTE',NULL,NULL,NULL,'2019-07-01 19:27:59',NULL),(3,'PENDIENTE',NULL,NULL,NULL,'2019-07-10 14:30:35',NULL),(4,'PENDIENTE',NULL,NULL,NULL,'2019-07-10 14:30:35',NULL),(5,'PENDIENTE',NULL,NULL,NULL,'2019-07-10 14:30:35',NULL);
/*!40000 ALTER TABLE `TIENDAS_QUINCENAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TIENDAS_VENTAS`
--

DROP TABLE IF EXISTS `TIENDAS_VENTAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TIENDAS_VENTAS` (
  `VENTAS_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VENTAS_TIPO_PAGO` enum('EFECTIVO','TARJETA DÉBITO','TARJETA CRÉDITO','MIXTO','NÓMINA','TRANSFERENCIA','DEPÓSITO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `VENTAS_CONSECUTIVO_DIARIO` int(11) DEFAULT NULL,
  `VENTAS_CONSECUTIVO_ANUAL` int(11) NOT NULL,
  `VENTAS_TOTAL` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`VENTAS_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TIENDAS_VENTAS`
--

LOCK TABLES `TIENDAS_VENTAS` WRITE;
/*!40000 ALTER TABLE `TIENDAS_VENTAS` DISABLE KEYS */;
INSERT INTO `TIENDAS_VENTAS` VALUES (1,'TARJETA DÉBITO',NULL,1,3650.00,'2019-07-01 19:26:26',NULL),(2,'NÓMINA',NULL,2,700.00,'2019-07-01 19:27:59',NULL),(3,'MIXTO',NULL,3,1400.00,'2019-07-01 19:31:00',NULL),(4,'TARJETA CRÉDITO',NULL,4,1800.00,'2019-07-01 19:31:46',NULL),(5,'TRANSFERENCIA',NULL,5,1150.00,'2019-07-01 19:32:08',NULL),(6,'DEPÓSITO',NULL,6,700.00,'2019-07-01 19:33:04',NULL),(7,'EFECTIVO',NULL,7,350.00,'2019-07-01 19:35:20',NULL),(8,'MIXTO',NULL,8,2120.00,'2019-07-10 14:29:35',NULL),(9,'NÓMINA',NULL,9,280.00,'2019-07-10 14:30:35',NULL),(10,'MIXTO',NULL,10,280.00,'2019-07-10 18:56:12',NULL),(11,'EFECTIVO',NULL,11,840.00,'2019-08-05 19:36:55',NULL);
/*!40000 ALTER TABLE `TIENDAS_VENTAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (101,'2014_10_12_000000_create_users_table',1),(102,'2014_10_12_100000_create_password_resets_table',1),(103,'2019_04_02_222006_create_tiendas_login_table',1),(104,'2019_04_03_160200_create_tiendas_productos_table',1),(105,'2019_04_03_161146_create_tiendas_tienda_table',1),(106,'2019_04_03_161609_create_tiendas_datos_venta_producto_table',1),(107,'2019_04_03_162019_create_tiendas_historial_table',1),(108,'2019_04_03_162559_create_tiendas_nota_entrada_table',1),(109,'2019_04_09_155855_create_rel_inventario_table',1),(110,'2019_04_09_164022_create_rel_producto_nota_entrada_table',1),(111,'2019_04_09_191322_create_rel_usuario_espacio_table',1),(112,'2019_04_11_150921_create_rel_historial_producto_table',1),(113,'2019_04_24_215349_create_tiendas_movilizacion_inventario_table',1),(114,'2019_05_08_155229_create_tiendas_ventas_table',1),(115,'2019_05_08_174005_create_rel_venta_producto_table',1),(116,'2019_06_12_143557_create_rel_movilizacion_producto',1),(117,'2019_06_24_180740_create_rel_pago_mixto_table',1),(118,'2019_06_24_202749_create_rel_pago_transferencia_table',1),(119,'2019_06_24_215053_create_rel_pago_deposito_table',1),(120,'2019_06_26_160615_create_rel_pago_nomina_table',1),(121,'2019_06_26_162036_create_tiendas_quincenas_table',1),(122,'2019_06_26_162836_create_rel_quincenas_venta_table',1),(123,'2019_07_02_161031_create_rel_conteo_inventario_table',2),(124,'2019_08_05_202226_create_rel_venta_factura_table',3),(133,'2019_08_09_164558_create_tiendas_devoluciones_table',4),(134,'2019_08_09_164623_create_rel_devoluciones_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-29 14:29:14
