CREATE DATABASE  IF NOT EXISTS `sasm` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `sasm`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: localhost    Database: sasm
-- ------------------------------------------------------
-- Server version	5.7.23-log

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
-- Table structure for table `causa`
--

DROP TABLE IF EXISTS `causa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `causa` (
  `idcausa` int(11) NOT NULL AUTO_INCREMENT,
  `nombrecausa` varchar(45) CHARACTER SET utf8 NOT NULL,
  `descripcion` varchar(500) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idcausa`),
  UNIQUE KEY `idcausa_UNIQUE` (`idcausa`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `causa`
--

LOCK TABLES `causa` WRITE;
/*!40000 ALTER TABLE `causa` DISABLE KEYS */;
INSERT INTO `causa` VALUES (1,'Gripa','Escurrimiento Nasal'),(2,'Gripa','Malestar General,Cuerpo Cortado'),(3,'Migrana','Dolor de cabeza intenso'),(4,'Ansiedad','Alteracion de los nervios'),(5,'Resfriado','Pequeña resfrio con congestion nasal'),(6,'Infeccion de la garganta','Inflamacion de garganta con tos'),(9,'Depresion','Depresion moderada con cuadro de ansiedad'),(12,'Obsesivo,compulsivo','Depresion moderada con obsesiones'),(13,'Fiebre','Temperatura corporal elevada por inflamacion de garganta'),(14,'Fiebre','Temperatura por infeccion'),(15,'Dolor de cabeza','Dolor frontal por tension o estres'),(16,'Dolor de muela','Dolor de muela por que esta picada'),(23,'Dolor de Panza','Dolor Abdominal por comer en exceso'),(24,'Diarrea','Indegestion'),(25,'Dolor de Panza','Colicos'),(26,'Tos','Tos con flemas'),(27,'Tos con flemas','Tos moderada'),(28,'Tos','Tos Moderada'),(30,'Mareo','Vertigo con nausea'),(31,'Nauseas','Vertigo con nauseas'),(32,'febrícula','Poca fiebre'),(34,'Colitis','Por comer mucho picante'),(35,'Colitis','Colitis por comer picante'),(36,'Gastritis','Gastritis por comer picante'),(38,'Estres','Estres'),(39,'Dolor de sien','Dolor de sien'),(40,'febrícula','Poca fiebre'),(41,'Agruras','Agruras por comida picante'),(42,'Dolor de hueso','Dolor de huesos'),(43,'Intoxicacion','Intoxicacion por alergia a comida'),(44,'dolor de panza','dolor de panza agudo con nausea y vomito'),(45,'Punzar la cabeza','Punzar la cabeza'),(46,'Presion Arterial alta','Presion Arterial alta'),(47,'Acidez estomacal','Acidez estomacal'),(48,'Fiebre alta','Fiebre alta de 39'),(49,'Mareo','Mareo con vomito'),(50,'Depresion','Depresion'),(51,'lsksl','lskslslkdsld'),(52,'Tos','Tos con flemas; depresor para revisar garganta'),(53,'Gripa','Malestar General,Cuerpo Cortado; recurso usado como botella de agua para tomar medicina; curita y venda para una cortada leve en el brazo'),(54,'Dolor de Panza','Dolor Abdominal por comer en exceso;usando botella de agua para tomar medicamento; asi como jeringa y aguja para una innyeccion de buscapina y un depresor lingual para revisar la garganta'),(55,'Tos','Tos Moderada;uso de botella de agua para tomar medicamentos y jeringa y aguja para una inyeccion de panotos; asi como un cubrebicas para  el virus de la tos'),(56,'Mareo','Vertigo con nausea;uso de botella de agua para tomar medicina;toallitas de alcohol para el mareo;depresor lingual para revisar la garganta y bolsa de plastico para vomito'),(57,'Nauseas','Vertigo con nauseas; uso de botella de agua para tomar la medicina y depresor lingual y cubrebocas para revision'),(58,'Dolor de cabeza','Dolor frontal por tension o estres;ya que llego asi por un asalto'),(59,'Gripa','Malestar General,Cuerpo Cortado; uso de botella de agua para tomar la primera dosis'),(60,'Gripa','Escurrimiento Nasal con infeccion en la garganta'),(61,'Gripa','Escurrimiento Nasal con infeccion en la garganta;'),(62,'Gripa','Escurrimiento Nasal con infeccion en la garganta(bien)'),(63,'Gripa','Escurrimiento Nasal con infeccion en la garganta'),(64,'Depresion','Depresion moderada con cuadro de ansiedad; usado botella de agua para tomar la medicina'),(65,'Infeccion de la garganta','Inflamacion de garganta con tos;usado botella de agua para tomar medicamentos y depresor lingual para revision de garganta'),(66,'Depresion','Depresion moderada con cuadro de ansiedad;uso de recuros botella de agua para tomar medicamentos;jeringa y aguja para inyeccion de ansiolitico con un cateteres ya que llego desmayado y guantes de latex para revision del cuerpo en general'),(67,'girpa','girpa con tos moderada; uso de jeringa y aguja para la inyeccion del medicamento por primera vez'),(68,'Depresion','Depresión moderada con cuadro de ansiedad y dolor de estomago con tos; uso de botella de agua para tomar medicinas y vendas por que traía una herida'),(69,'indigestion fuerte','indigestion fuerte;uso de botella de agua y guantes de latex;asi como de jeringas,aguja y cateteres ya que venia desmayado el paciente'),(70,'Infeccion de la garganta con dolo','Infeccion de la garganta con dolor y tos; uso de botella de agua para el paciente;agujas y jeringa para el primer medicamento; asi como cubrebocas y depresor lingual para revision del paciente'),(76,'ñññ','ñññ'),(77,'ññ','ññ'),(78,'Infeccion de la garganta','Infeccion de la garganta'),(79,'febrícula','febrícula'),(80,'Depresion','Depresión moderada con cuadro de ansiedad y dolor de estomago con tos; uso de botella de agua para tomar medicinas y vendas por que traía una herida'),(81,'ññññññññññññ','ññññññññññññ'),(82,'dolor de estomago','dolor de estomago'),(83,'mareo','mareo con nausea y vomito; trae cortada en el dedo por descuido'),(84,'indigeston','indigeston'),(85,'diarrea','diarrea'),(86,'girpa','girpa con tos moderada; uso de jeringa y aguja para la inyeccion del medicamento por primera vezz');
/*!40000 ALTER TABLE `causa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctores`
--

DROP TABLE IF EXISTS `doctores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctores` (
  `iddoctores` int(11) NOT NULL AUTO_INCREMENT,
  `idrol` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 NOT NULL,
  `apellidopaterno` varchar(45) CHARACTER SET utf8 NOT NULL,
  `apellidomaterno` varchar(45) CHARACTER SET utf8 NOT NULL,
  `especialidad` varchar(45) CHARACTER SET utf8 NOT NULL,
  `turno` varchar(45) CHARACTER SET utf8 NOT NULL,
  `cedprof` varchar(45) CHARACTER SET utf8 NOT NULL,
  `idlogin` int(11) NOT NULL,
  PRIMARY KEY (`iddoctores`),
  UNIQUE KEY `iddoctores_UNIQUE` (`iddoctores`),
  KEY `idlogin_idx` (`idlogin`),
  KEY `idrol_idx` (`idrol`),
  CONSTRAINT `idrol` FOREIGN KEY (`idrol`) REFERENCES `roles` (`idroles`),
  CONSTRAINT `log` FOREIGN KEY (`idlogin`) REFERENCES `login` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctores`
--

LOCK TABLES `doctores` WRITE;
/*!40000 ALTER TABLE `doctores` DISABLE KEYS */;
INSERT INTO `doctores` VALUES (1,1,'Juan','Torres','Espinoza','General','Vespertino','123456',24),(4,3,'Jack','Changoya','Galvan','Nada','Matutino','0000',2),(5,1,'Leonardo','Sanchez','Martinez','General','Completo','10102020',21),(6,2,'Carlos','Carrillo','Arellano','General','Completo','909080',15),(7,1,'Belem','Priego','Sanchez','General','Completo','901090',23),(8,2,'Beatriz','Gonzalez','Beltran','General','Matutino','292900',11),(9,2,'Francisco','Cervantes','De la Torre','General','Vespertino','345890',3),(10,2,'Francisco','Zaragoza','Martinez','Cirujano','Vespertino','34359091',7),(11,2,'Gueorgi','Khatchatourov','Khatchatourov','Traumatología','Matutino','11223344',9),(12,2,'Hugo','Pablo','Leyva','Ginecología','Vespertino','3467891',5),(13,1,'Alejandro','Reyes','Ortiz','Dermatología','Completo','3467281',18),(14,1,'Josue','Figueroa','Gonzalez','Oftalmología','Completo','657281',13),(15,2,'Lisaura','Rodriguez','Alvarado','Ginecología','Completo','45464789',20),(16,2,'Maricela','Bravo','Contreras','Traumatología','Completo','12345000',16),(17,2,'Silvia','Gonzalez','Brambilla','Oftalmologia','Matutino','9010901',6),(18,1,'Rodrigo','Castro','Campos','Otorrinolaringología','Vespertino','2367829',17),(19,2,'Mario','Martinez','Molina','General','Completo','3567890',22),(20,2,'Marco','Heredia','Velasco','Otorrinolaringología','Vespertino','3452628',19),(21,3,'Alejandra','Velasco','Quiroz','Odontología','Completo','54267198',14),(22,1,'Isabel','Cervantes','Palacios','General','Completo','5262725',8),(23,3,'Ana','Delgadillo','Duran','Oftalmología','Completo','2362738',10),(24,1,'Isidro','Gonzalez','Trejo','Oftalmología','Vespertino','8782389',4),(25,3,'Maria','Flores','Castillo','General','Completo','2042156',12),(37,1,'Carlos','Gonzalez','Araujo','Pediattra','Completo','1234',44),(41,2,'Hector','Gonzalez','Gonzalez','General','Vespertino','88238',48),(43,3,'Paco editado','Perez editado','Lopez editado','General','Matutino','222',50),(51,3,'ññññ','ññññ','ññññ','ññññ','Completo','12212',58);
/*!40000 ALTER TABLE `doctores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial`
--

DROP TABLE IF EXISTS `historial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historial` (
  `idhistorial` int(11) NOT NULL AUTO_INCREMENT,
  `iddoc` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `tratamiento` varchar(500) CHARACTER SET utf8 NOT NULL,
  `idcausa` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idhistorial`),
  UNIQUE KEY `idhistorial_UNIQUE` (`idhistorial`),
  KEY `idlogin_idx` (`iddoc`),
  KEY `nombrecausa_idx` (`idcausa`),
  KEY `matricula_idx` (`idpaciente`),
  CONSTRAINT `idcausa` FOREIGN KEY (`idcausa`) REFERENCES `causa` (`idcausa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idlog` FOREIGN KEY (`iddoc`) REFERENCES `doctores` (`iddoctores`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `matricula` FOREIGN KEY (`idpaciente`) REFERENCES `pacientes` (`idpacientes`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial`
--

LOCK TABLES `historial` WRITE;
/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
INSERT INTO `historial` VALUES (1,1,1,'2019-06-29','19:57:00','1 Tableta de Motrin cada 8 horas de 250 mg',6,1),(2,5,7,'2019-06-29','20:18:00','Tomar 1 capsula de fluoxetina y desvenlafalaxina diariamente por 3 meses de 250 mg',9,1),(3,6,4,'2019-06-29','20:22:00','Tomar 1 capsula de desvenlafalxina diariamente de 250 mg hasta la siguente consulta;un sal de uvas por indigestión y un dramamine por hoy',12,1),(4,8,14,'2019-06-29','20:27:00','Tomar 1 Tableta de antiespamodico de 250 mg cada 12 horas,por hoy una buscapiana;un sal de uvas; asi como una aspirina',25,1),(5,9,4,'2019-06-29','20:30:00','Tomar 1 tableta de Buscapina diaria de 250 mg por 2 dias;tomar hoy un bioelectro; un motrin;un tylenol y un sal de uvas',25,1),(6,10,18,'2019-06-29','20:33:00','1 Tableta de Tylenol Cada 8 horas durante 3 dias de 250 mg; asi como una mesulid y un antifludes(250 mg); y una ranitidina',79,1),(7,5,9,'2019-06-29','20:36:00','Tomar cada 8 horas 1 tabetas de 250 mg de panotos;una amolodipino; por 3 dias y un genoprazol',52,1),(8,11,6,'2019-06-29','20:37:00','Tomar 10 gotas diarias',13,0),(9,12,8,'2019-06-29','20:39:00','Tomar 2 tabletas de antifludes diarias de 500 mg y mesulid por 5 dias',53,1),(10,5,11,'2019-06-29','22:14:00','Tomar 1 capsula de buscapina de 250 mg en el dia y noches',54,1),(11,15,20,'2019-06-29','22:17:00','Tomar una tableta de panotos 500 mg cada vez que se presenten sintomas',55,1),(12,16,19,'2019-06-29','22:20:00','Mezclar con agua 1 capsula de Dramamine de 500 mg y una aspirina',56,1),(13,5,13,'2019-06-29','22:23:00','Tomar Dramamine 250 mg mientras pasa el sintoma; junto con sal de uvas y bioelectro',57,1),(14,17,22,'2019-06-29','22:25:00','Tomar Bioelectro 500 mg hasta que pase el dolor;amlodipino para la presion arterial;asi como ketarolaco y un dramamine',58,1),(15,7,1,'2019-06-29','22:27:00','Tomar 1 Antifludes capsula de 500 mg cada 8 horas; numesulida y mesulid alternar por 3 dias;asi como genoprazol y ranitidina por el estomago',59,1),(16,19,17,'2019-06-29','22:33:00','Tomar 1 Genoprazol 500mg despues de los alimentos; asi como ranitidina; por mientras un sal de uvas y buscappina',36,1),(17,20,19,'2019-06-29','22:37:00','Tomar 1 tableta de Antifludes 250 mg cada 12 horas;si es necesario el de 500 mg asi como un tylenol',2,1),(18,5,19,'2019-06-29','22:39:00','Tomar 1 tableta de Biometrix 500 mg cada 8 horas por 3 dias',38,0),(19,6,19,'2019-06-29','22:41:00','Tomar 1 capsula de antifludes 500 mg cada 8 horas; y nimesulida por 5 dias',60,1),(20,1,30,'2019-06-29','22:45:00','Tomar 1 Capsula de Dramamine 250mg cada 8 horas',49,1),(21,5,7,'2019-06-29','22:58:00','1 tableta de buscapina de 500 mg de paracetamol',44,0),(22,5,22,'2019-06-29','22:59:00','Tomar 1 ranitidina 250mg cada 8 horas',41,0),(23,5,22,'2019-06-29','23:01:00','Tomar 1 amlodipino 250 mg diaria',46,0),(24,5,22,'2019-06-29','23:04:00','Tomar 1 Aspirina 500 mg por hoy',46,0),(25,5,21,'2019-06-29','23:07:00','Tomar 1 de motrin 250 mg por 3 dias',48,0),(26,5,21,'2019-06-29','23:08:00','Tomar 1 sal de uvas 250 mg por hoy',47,0),(27,5,39,'2019-06-29','23:10:00','Tomar 1 sal de uvas 250 mg por hoy',47,1),(28,1,7,'2019-06-29','23:13:00','Tomar 1 capsula de fluoxetina diariamente por 3 meses de 250 mg',64,1),(29,1,7,'2019-06-29','23:14:00','Tomar 1 capsula de fluoxetina diariamente por 3 meses de 250 mg y antifludes 250 mg',65,1),(30,5,9,'2019-06-29','23:16:00','Tomar 1 capsula de fluoxetina y desvelafalxina diariamente por 3 meses de 250 mg; panotos y ketorolaco solo por hoy',66,1),(31,5,7,'2019-06-29','23:18:00','Tomar 1 capsula de antludes 250 diariamente por 1/2 mes de 250 mg',86,1),(32,5,7,'2019-06-29','23:36:00','Tomar 1 capsula de fluoxetina y desvenlafalaxina diariamente por 3 meses de 250 mg; una buscapina y panotos por 2 dias',80,1),(33,5,1,'2019-06-29','23:38:00','Tomar 1 sal de uvas 250 mg por hoy; bioelectro y ketorolaco para el dolor en general;tylenol y motrin por las noches por 4 dias',69,1),(34,5,1,'2019-06-29','23:40:00','1 Tableta de Motrin y panotos cada 8 horas de 250 mg por 3 dias',70,1),(35,1,7,'2019-07-01','11:01:00',' inspeccion general yyyyyyy ññññ',81,1),(36,1,15,'2019-07-07','23:28:00','tomar 1 buscapinapor hoy y uso de guates de latex para inspeccion general',82,1),(37,7,6,'2019-07-08','00:34:00','tomar panotos durante 3 dias y  una buscapina por hoy;con uso de botella de agua para la primer toma',26,1),(38,7,12,'2019-07-08','00:39:00','tomar dramamine por 2 dias; 1 en la noche y otra en el dia\r\ncon uso de curitas por una cortada',83,1),(39,1,13,'2019-07-08','00:41:00','tomar  un genoprazol despues de cada comida durante 10 dias;uso de guates de latex para inspeccion general',84,1),(40,1,16,'2019-07-08','00:48:00','tomar una ranitidina por 3 dias;uso de guates de latex para inspeccion general',85,1);
/*!40000 ALTER TABLE `historial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_med`
--

DROP TABLE IF EXISTS `historial_med`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historial_med` (
  `idhistorial_med` int(11) NOT NULL AUTO_INCREMENT,
  `idhistorial` int(11) NOT NULL,
  `idmedicamentos` int(11) NOT NULL,
  PRIMARY KEY (`idhistorial_med`),
  KEY `histo_idx` (`idhistorial`),
  KEY `med_idx` (`idmedicamentos`),
  CONSTRAINT `histo` FOREIGN KEY (`idhistorial`) REFERENCES `historial` (`idhistorial`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `med` FOREIGN KEY (`idmedicamentos`) REFERENCES `medicamentos` (`idmedicamentos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_med`
--

LOCK TABLES `historial_med` WRITE;
/*!40000 ALTER TABLE `historial_med` DISABLE KEYS */;
INSERT INTO `historial_med` VALUES (4,1,1),(5,2,7),(6,2,4),(7,3,20),(8,3,14),(9,3,7),(10,4,19),(11,4,14),(12,4,15),(13,4,22),(14,5,14),(15,5,21),(16,5,22),(17,5,10),(18,5,15),(19,6,25),(20,6,2),(21,6,1),(22,6,21),(23,7,24),(24,7,27),(25,7,17),(26,9,2),(27,9,1),(28,10,15),(29,11,17),(30,12,19),(31,12,20),(32,13,10),(33,13,14),(34,13,20),(35,14,20),(36,14,11),(37,14,27),(38,14,10),(39,15,25),(40,15,24),(41,15,1),(42,15,3),(43,15,8),(44,16,15),(45,16,14),(46,16,25),(47,16,24),(48,17,21),(49,17,8),(50,17,2),(51,18,10),(52,19,3),(53,19,8),(54,20,20),(55,21,15),(56,22,25),(57,23,27),(58,24,19),(59,25,22),(60,26,14),(61,27,14),(62,28,4),(63,29,2),(64,29,4),(65,30,11),(66,30,16),(67,30,7),(68,30,4),(69,31,2),(70,32,16),(71,32,15),(72,32,7),(73,32,4),(74,33,22),(75,33,21),(76,33,11),(77,33,10),(78,33,14),(79,34,16),(80,34,22),(81,36,15),(82,37,15),(83,37,16),(84,38,20),(85,39,14),(86,39,24),(87,40,25);
/*!40000 ALTER TABLE `historial_med` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_rec`
--

DROP TABLE IF EXISTS `historial_rec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historial_rec` (
  `idhistorial_rec` int(11) NOT NULL AUTO_INCREMENT,
  `idhistorial` int(11) NOT NULL,
  `idrecurso` int(11) NOT NULL,
  PRIMARY KEY (`idhistorial_rec`),
  KEY `hist_idx` (`idhistorial`),
  KEY `rec_idx` (`idrecurso`),
  CONSTRAINT `hist` FOREIGN KEY (`idhistorial`) REFERENCES `historial` (`idhistorial`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rec` FOREIGN KEY (`idrecurso`) REFERENCES `recursos` (`idrecurso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_rec`
--

LOCK TABLES `historial_rec` WRITE;
/*!40000 ALTER TABLE `historial_rec` DISABLE KEYS */;
INSERT INTO `historial_rec` VALUES (1,9,1),(2,9,6),(3,9,7),(4,10,13),(5,10,14),(6,10,15),(7,10,16),(8,11,11),(9,11,4),(10,11,3),(11,11,2),(12,12,16),(13,12,13),(14,12,12),(15,12,2),(16,13,12),(17,13,11),(18,13,2),(19,15,2),(20,28,2),(21,29,12),(22,29,2),(23,30,5),(24,30,4),(25,30,3),(26,30,2),(27,30,1),(28,31,3),(29,31,4),(30,32,6),(31,32,2),(32,33,5),(33,33,4),(34,33,3),(35,33,2),(36,33,1),(37,34,12),(38,34,11),(39,34,4),(40,34,3),(41,34,2),(42,36,1),(43,37,2),(44,38,7),(45,39,1),(46,40,1);
/*!40000 ALTER TABLE `historial_rec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idlogin` int(11) NOT NULL,
  `pass` varchar(40) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (2,210207892,'4ff9fc6e4e5d5f590c4f2134a8cc96d1'),(3,14612,'117735823fadae51db091c7d63e60eb0'),(4,16509,'496e781ce57522d8fdad3631eec914fe'),(5,17060,'f1f58e8c06b2a61ce13e0c0aa9473a72'),(6,17204,'e5cb7c411f1d9a67f68deff4a954cfbc'),(7,20197,'7b8e7b0f084ec0ac5fda8eabc030f923'),(8,21301,'165a1761634db1e9bd304ea6f3ffcf2b'),(9,22664,'0a08a9d3d70a2d96cc7aeab2f0a924a5'),(10,27669,'276b6c4692e78d4799c12ada515bc3e4'),(11,30246,'e4f7614a887a8cc07a2eea93a1e31122'),(12,30309,'263bce650e68ab4e23f28263760b9fa5'),(13,31749,'c4f0f080c3f5992b3a4c03d04ace51a2'),(14,31914,'703042aefd627a8c86c4de140cc80c6e'),(15,35523,'1a1dc91c907325c69271ddf0c944bc72'),(16,35691,'148e60fc188d3e74c6be627ecfd8c390'),(17,35692,'2e247e2eb505c42b362e80ed4d05b078'),(18,37847,'958a74a4695ec722416c949165fd7c50'),(19,37848,'3ecf44f199e048645109790c23ca7533'),(20,39338,'e737f23ca2dbbba23960c79367d64a79'),(21,39768,'63a9f0ea7bb98050796b649e85481845'),(22,40140,'21ec6379d30e841a77ab321787a4ee0e'),(23,40936,'68d5aeda5f4970bfd71309765dd267fc'),(24,210204585,'81dc9bdb52d04dc20036dbd8313ed055'),(25,210204586,'c893bad68927b457dbed39460e6afd62'),(26,210204587,'96080775c113b0e5c3e32bdd26214aec'),(27,210204588,'5afb9bcb73acf95a28aa35dbd9acdbda'),(40,9000,'c4ca4238a0b923820dcc509a6f75849b'),(43,31345,'c81e728d9d4c2f636f067f89cc14862c'),(44,66623,'271559ec25268bb9bb2ad7fd8b4cf71a'),(48,893,'c9f0f895fb98ab9159f51fd0297e236d'),(50,2222,'ed4bd209d148b465b340867b3e0942b6'),(58,1245,'d517319f365999b522cd68a21539363a');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicamentos`
--

DROP TABLE IF EXISTS `medicamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicamentos` (
  `idmedicamentos` int(11) NOT NULL AUTO_INCREMENT,
  `medicamentosnombre` varchar(45) CHARACTER SET utf8 NOT NULL,
  `presentacion` varchar(45) CHARACTER SET utf8 NOT NULL,
  `cantidadtot` int(11) NOT NULL,
  PRIMARY KEY (`idmedicamentos`),
  UNIQUE KEY `idmedicamentos_UNIQUE` (`idmedicamentos`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamentos`
--

LOCK TABLES `medicamentos` WRITE;
/*!40000 ALTER TABLE `medicamentos` DISABLE KEYS */;
INSERT INTO `medicamentos` VALUES (1,'Mesulid','Tabletas 500 mg',128),(2,'Antifludes(Tabletas 250 mg)','Tabletas 250 mg',167),(3,'Nimesulida','Tabletas 500 mg',141),(4,'fluoxetina ','Capsulas 250 mg',141),(7,'desvenlafaxina','Tabletas 500 mg',134),(8,'Antifludes(Tabletas 500 mg)','Tabletas 500 mg',164),(9,'Antifludes(Capsulas)','Capsulas 500 mg',132),(10,'BioElectro','Capsulas 500 mg',149),(11,'Ketorolaco','Capsulas 250 mg',149),(12,'Antifludes(Inyectable)','Inyectable 250 ml',160),(13,'venlafaxina','Tabletas 500 mg',140),(14,'Sal de uvas','Sobre 250 mg',150),(15,'Buscapina','Tabletas 500 mg',137),(16,'Panotos(Capsulas)','Capsulas 250 mg',128),(17,'Panotos(Tabletas)','Tabletas 500 mg',176),(19,'Aspirina','Tabletas 500 mg',154),(20,'Dramamine','Tabletas 500 mg',152),(21,'Tylenol','Tabletas 250 mg',132),(22,'Motrin','ibuprofeno 500 mg',138),(24,'Genoprazol ','Tabletas 500 mg',111),(25,'Ranitidida','Tabletas 250 mg',122),(27,'Amlodipino','Capsulas 500 mg',124);
/*!40000 ALTER TABLE `medicamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacientes` (
  `idpacientes` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8 NOT NULL,
  `apellidopaterno` varchar(45) CHARACTER SET utf8 NOT NULL,
  `apellidomaterno` varchar(45) CHARACTER SET utf8 NOT NULL,
  `edad` int(11) NOT NULL,
  `correo` varchar(45) CHARACTER SET utf8 NOT NULL,
  `sexo` char(9) CHARACTER SET utf8 NOT NULL,
  `matricula` bigint(11) NOT NULL,
  `estatus` int(11) DEFAULT '1',
  PRIMARY KEY (`idpacientes`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
INSERT INTO `pacientes` VALUES (1,'Juan','Torres ','Espinoza',29,'JTorreses10@gmail.com','Masculino',210204585,1),(2,'Jack','Changoya','Galvan',30,'jack@gmail.com','Femenino',210207892,1),(3,'Dolores','Espinoza','Diaz',20,'Dolores@gmail.com','Femenino',210210209,1),(4,'Eliud','Rodriguez','Menza',20,'Eliud@hotmail.com','Masculino',215000000,1),(5,'Luis','Perez','Monroy',29,'Luis@yahoo.com','Masculino',214215213,1),(6,'Hugo','Torres','Espinoza',35,'Hugo@hotmail.com','Masculino',21221600,1),(7,'Alma','Piña','Garcia',28,'Alma@gmail.com','Femenino',111222,1),(8,'Anahi','Chavez','Barragan',28,'Anahi@gmail.com','Femenino',210210585,1),(9,'Juan','Torres','Contreras',30,'Torres10@gmail.com','Masculino',211212213,1),(10,'Juan','Torres','Espinoza',29,'Juan@gmail.com','Masculino',210204900,1),(11,'Victor','Cruz','Gonzalez',28,'Victor@gmail.com','Masculino',210204909,1),(12,'Iveth','Leon','Lopez',28,'Iveth@hotmail.com','Femenino',212000111,1),(13,'Joss','Mendoza','Torres',28,'Joss@yahoo.com','Femenino',214567585,1),(14,'Julio','Correa','Torres',40,'Julio@yahoo.com','Masculino',1110002221,1),(15,'Silvia','Maldonado','Villaseñor',22,'Amorsilvia@gmail.com','Femenino',218376585,1),(16,'Andrea','Perez','Gonzalez',26,'Andy@yahoo.com','Femenino',210217888,1),(17,'Carlos','Hernandez','Jerack',27,'Jerack@hotmail.com','Masculino',213788999,1),(18,'Josue','Castelan','Aguilar',34,'Josue@gmail.com','Masculino',209208207,1),(19,'Lupita','Hernandez','Carrasco',28,'Lupita@gmail.com','Femenino',210222585,1),(20,'Ofelia','Rodriguez','Soto',28,'Ofe@yahoo.com','Femenino',210209585,1),(21,'Miguel','Pasteur','Camarillo',30,'pasteur@gmail.com','Masculino',1,0),(22,'Maria','Ambriz','Gallegos',28,'Maria@hotmail.com','Femenino',2,1),(23,'Guadalupe','Ramirez','Ruiz',19,'Ruiz@gmail.com','Femenino',777888999,1),(27,'Luis','Echeverria','Romero',19,'Romero@gmail.com','Masculino',112233445,1),(28,'Ricardo','Moreli','Lopez',20,'Lopez@gmail.com','Masculino',111222333,1),(29,'Joselyne','Mendoza','Ramirez',21,'crush@gmail.com','Femenino',111,0),(30,'Paco editado','Correa editado','Ruiz editado',22,'Pacoeditado@gmail.com','Masculino',218217,1),(38,'Cinthya','Leon','Sanchez',23,'fea@gmail.com','Femenino',2152002181,0),(39,'Ivan','Mendoza','Castro',24,'castro@gmail.com','Masculino',2172182198,1),(40,'Patricia','Giovanna','Cantu',35,'crush@yahoo.com','Femenino',2182112009,1),(41,'Perla','Nuria','Vega',19,'vega@gmail.com','Femenino',9,0);
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recursos`
--

DROP TABLE IF EXISTS `recursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recursos` (
  `idrecurso` int(11) NOT NULL AUTO_INCREMENT,
  `nombrerecurso` varchar(45) CHARACTER SET utf8 NOT NULL,
  `descripcionrecurso` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cantidadtotal` int(11) NOT NULL,
  PRIMARY KEY (`idrecurso`),
  UNIQUE KEY `idrecursos_UNIQUE` (`idrecurso`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recursos`
--

LOCK TABLES `recursos` WRITE;
/*!40000 ALTER TABLE `recursos` DISABLE KEYS */;
INSERT INTO `recursos` VALUES (1,'Guantes de latex','Para evitar virus',486),(2,'Botella de agua','Agua para la deshidratacion,enjuagar,etc',195),(3,'Jeringas','Para inyecciones',163),(4,'Agujas','Para multiples cosas',495),(5,'Cateteres ','Administracion de medicamentos',160),(6,'Vendas','Uso General de lesiones',467),(7,'Curitas','Contra cortadas leves',997),(8,'Gasa','Cubrir heridas',989),(9,'Collarines','Para inmovilizar el cuello',135),(10,'Ferulas','Para fracturas',508),(11,'Cubrebocas','Para evitar trasmiciones de virus',498),(12,'depresor lingual ','Para revision de garganta',299),(13,'toallitas impregnadas de alcohol','Para curaciones ',998),(14,'Bolsa de frio instantaneo desechable','Para torceduras,esguinces ',199),(15,'toallitas impregnadas de antiseptico','Con agua oxigenda',897),(16,'Bolsas de plastico ','para la eliminacion de material potencialmente contaminado',597);
/*!40000 ALTER TABLE `recursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `idroles` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`idroles`),
  UNIQUE KEY `idroles_UNIQUE` (`idroles`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin'),(2,'Medicos'),(3,'Enfermer@s');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'sasm'
--

--
-- Dumping routines for database 'sasm'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-08  1:13:38
