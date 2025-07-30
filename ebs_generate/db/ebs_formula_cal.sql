# MySQL-Front 5.0  (Build 1.96)

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;


# Host: localhost    Database: lgt_ebs_generate
# ------------------------------------------------------
# Server version 5.1.41

#
# Table structure for table ebs_formula_cal
#

DROP TABLE IF EXISTS `ebs_formula_cal`;
CREATE TABLE `ebs_formula_cal` (
  `id_formula` int(4) NOT NULL AUTO_INCREMENT,
  `supplier_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `car_plant` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dock_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_destination` int(5) DEFAULT NULL COMMENT 'rf_ebs_customer_destination',
  `emp_insert` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_insert` datetime DEFAULT NULL,
  `emp_update` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id_formula`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Dumping data for table ebs_formula_cal
#

INSERT INTO `ebs_formula_cal` VALUES (1,'FTTLA','SAMRONG','S1',2,'1972',NULL,NULL,NULL);
INSERT INTO `ebs_formula_cal` VALUES (2,'FTTLA','BANPHO','P1',3,'1972',NULL,NULL,NULL);
INSERT INTO `ebs_formula_cal` VALUES (3,'FTTLA','GATEWAY','G2',4,'1972',NULL,NULL,NULL);
INSERT INTO `ebs_formula_cal` VALUES (4,'FTTLA','GATEWAY','C2',4,'1972',NULL,NULL,NULL);
INSERT INTO `ebs_formula_cal` VALUES (5,'FTTLA','GATEWAY','XA',4,'1972',NULL,NULL,NULL);
INSERT INTO `ebs_formula_cal` VALUES (6,'FTTLA','GATEWAY','XX',4,'1972',NULL,NULL,NULL);
INSERT INTO `ebs_formula_cal` VALUES (7,'FTTLA','GATEWAY','Z1',5,'1972',NULL,NULL,NULL);
INSERT INTO `ebs_formula_cal` VALUES (8,'FTTLA','GATEWAY#2','C2',4,'1972',NULL,NULL,NULL);
INSERT INTO `ebs_formula_cal` VALUES (9,'FTTLA','GATEWAY#2','C5',5,'1972',NULL,NULL,NULL);
INSERT INTO `ebs_formula_cal` VALUES (10,'FTTLA','BANGPAKONG','BN',7,'1972',NULL,NULL,NULL);
INSERT INTO `ebs_formula_cal` VALUES (11,'FTTLA','BANGPAKONG','DZ',7,'1972',NULL,NULL,NULL);
INSERT INTO `ebs_formula_cal` VALUES (12,'FTTLA','BANGPAKONG','D1',7,'1972',NULL,NULL,NULL);
INSERT INTO `ebs_formula_cal` VALUES (13,'FTTL1','SAMRONG','OS',55,'1972',NULL,NULL,NULL);
INSERT INTO `ebs_formula_cal` VALUES (14,'FTTL1','BANPHO','OP',56,'1972',NULL,NULL,NULL);
INSERT INTO `ebs_formula_cal` VALUES (15,'FTTL1','GATEWAY#2','OE',57,'1972',NULL,NULL,NULL);
INSERT INTO `ebs_formula_cal` VALUES (16,'FTTL1','GATEWAY','OG',57,'1972',NULL,NULL,NULL);
INSERT INTO `ebs_formula_cal` VALUES (17,'FTTL1','GATEWAY','OW',57,'1972',NULL,NULL,NULL);
INSERT INTO `ebs_formula_cal` VALUES (18,'FTTL1','BANGPLEE','OA',58,'1972',NULL,NULL,NULL);

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
