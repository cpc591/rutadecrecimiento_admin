/*
SQLyog Ultimate v13.2.0 (64 bit)
MySQL - 5.7.44-log : Database - rutacrecimiento_crm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`rutacrecimiento_crm` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `rutacrecimiento_crm`;

/*View structure for view PreguntasConOpcionesRespuesta */

/*!50001 DROP TABLE IF EXISTS `PreguntasConOpcionesRespuesta` */;
/*!50001 DROP VIEW IF EXISTS `PreguntasConOpcionesRespuesta` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `PreguntasConOpcionesRespuesta` AS (select `variables`.`id` AS `preguntaID`,`variables`.`name` AS `preguntaTITULO`,cast(json_unquote(json_extract(`variables`.`values`,'$[0].attributes.variable_response')) as char charset utf8) AS `respuestaOPCIONvalor1`,cast(json_unquote(json_extract(`variables`.`values`,'$[0].attributes.percentage')) as decimal(5,2)) AS `respuestaOPCIONporcentaje1`,cast(json_unquote(json_extract(`variables`.`values`,'$[1].attributes.variable_response')) as char charset utf8) AS `respuestaOPCIONvalor2`,cast(json_unquote(json_extract(`variables`.`values`,'$[1].attributes.percentage')) as decimal(5,2)) AS `respuestaOPCIONporcentaje2`,cast(json_unquote(json_extract(`variables`.`values`,'$[2].attributes.variable_response')) as char charset utf8) AS `respuestaOPCIONvalor3`,cast(json_unquote(json_extract(`variables`.`values`,'$[2].attributes.percentage')) as decimal(5,2)) AS `respuestaOPCIONporcentaje3`,cast(json_unquote(json_extract(`variables`.`values`,'$[3].attributes.variable_response')) as char charset utf8) AS `respuestaOPCIONvalor4`,cast(json_unquote(json_extract(`variables`.`values`,'$[3].attributes.percentage')) as decimal(5,2)) AS `respuestaOPCIONporcentaje4`,cast(json_unquote(json_extract(`variables`.`values`,'$[4].attributes.variable_response')) as char charset utf8) AS `respuestaOPCIONvalor5`,cast(json_unquote(json_extract(`variables`.`values`,'$[4].attributes.percentage')) as decimal(5,2)) AS `respuestaOPCIONporcentaje5`,cast(json_unquote(json_extract(`variables`.`values`,'$[5].attributes.variable_response')) as char charset utf8) AS `respuestaOPCIONvalor6`,cast(json_unquote(json_extract(`variables`.`values`,'$[5].attributes.percentage')) as decimal(5,2)) AS `respuestaOPCIONporcentaje6`,`variables`.`values` AS `values` from `variables`) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
