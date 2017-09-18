CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuarios_id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `nombre` VARCHAR(100) NULL,
  `apellido_paterno` VARCHAR(100) NULL,
  `apellido_materno` VARCHAR(100) NULL,
  `email` VARCHAR(150) NULL,
  `passwd` VARCHAR(70) NULL,
  `estatus` INT(1) NOT NULL DEFAULT 1,
  `cuentas_id` INT NOT NULL DEFAULT 0,
  `creacion` DATETIME DEFAULT   CURRENT_TIMESTAMP,
  `edicion` DATETIME ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`usuarios_id`),
  INDEX `usuarios_username_idx` (`username` ASC),
  INDEX `usuarios_estatus_idx` (`estatus` ASC),
  INDEX `usuarios_cuentas_id_idx` (`cuentas_id` ASC))
ENGINE = InnoDB;

-- Bianconeri26!
INSERT INTO `usuarios` (`usuarios_id`, `username`, `nombre`, `apellido_paterno`, `apellido_materno`, `email`, `passwd`, `estatus`, `cuentas_id`) VALUES
(1, 'tisca26', 'Gerardo Gabriel', 'Tiscareño', 'Gutiérrez', 'gerry.t26@gmail.com', '$2y$10$XQy2VIM.tJuZ3/3wxoLUtOduMWzPsFmopgR2g2c7bHeVBwQRPry4e', 1, 1);

-- ----------------------------------------------------------

CREATE TABLE IF NOT EXISTS `resources` (
  `resources_id` INT NOT NULL AUTO_INCREMENT,
  `resource` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`resources_id`))
ENGINE = InnoDB;

--
-- Volcado de datos para la tabla `resources`
--

INSERT INTO `resources` (`resources_id`, `resource`) VALUES
(1, 'resources'),
(2, 'users'),
(3, 'groups'),
(4, 'acl'),
(5, 'dashboard'),
(6, 'menu');

-- ----------------------------------------------------------

CREATE TABLE IF NOT EXISTS `accesscontrollist` (
  `TARGETID` INT NOT NULL,
  `TYPEID` INT NOT NULL,
  `RESOURCEID` INT NOT NULL,
  `R` INT NULL,
  `I` INT NULL,
  `U` INT NULL,
  `D` INT NULL,
  INDEX `acl_targetid_idx` (`TARGETID` ASC),
  INDEX `acl_typeid_idx` (`TYPEID` ASC),
  INDEX `acl_resourceid_idx` (`RESOURCEID` ASC))
ENGINE = InnoDB;

--
-- Volcado de datos para la tabla `accesscontrollist`
--

INSERT INTO `accesscontrollist` (`TARGETID`, `TYPEID`, `RESOURCEID`, `R`, `I`, `U`, `D`) VALUES
(1, 1, 1, 1, 1, 1, 1),
(1, 1, 2, 1, 1, 1, 1),
(1, 1, 3, 1, 1, 1, 1),
(1, 1, 4, 1, 1, 1, 1),
(1, 1, 5, 1, 1, 1, 1),
(1, 1, 6, 1, 1, 1, 1);

CREATE TABLE IF NOT EXISTS `groups` (
  `groups_id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(70) NOT NULL,
  `estatus` INT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`groups_id`),
  INDEX `groups_estatus_idx` (`estatus` ASC))
ENGINE = InnoDB;

INSERT INTO `groups` (`groups_id`, `nombre`, `estatus`) VALUES
(1, 'Administrador', 1);

CREATE TABLE IF NOT EXISTS `usersgroups` (
  `usuarios_id` INT NOT NULL DEFAULT 0,
  `groups_id` INT NOT NULL DEFAULT 0,
  INDEX `usersgroups_user_idx` (`usuarios_id` ASC),
  INDEX `usergroups_group_idx` (`groups_id` ASC))
ENGINE = InnoDB;

INSERT INTO `usersgroups` (`usuarios_id`, `groups_id`) VALUES (1, 1);


CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  `shortdesc` VARCHAR(255) NULL,
  `page_uri` VARCHAR(60) NULL,
  `estatus` INT(1) NOT NULL DEFAULT 1,
  `parent_id` INT NULL,
  `orden` INT NOT NULL DEFAULT 1,
  `resource_id` INT NULL,
  `icon` VARCHAR(45) NULL,
  PRIMARY KEY (`menu_id`),
  INDEX `menu_parentid_idx` (`parent_id` ASC),
  INDEX `menu_estatus_idx` (`estatus` ASC),
  INDEX `menu_orden_idx` (`orden` ASC),
  INDEX `menu_recurso_idx` (`resource_id` ASC))
ENGINE = InnoDB;

INSERT INTO `menu` 
(`menu_id`, `nombre`, `shortdesc`, `page_uri`, `estatus`, `parent_id`, `orden`, `resource_id`) VALUES
(1, 'Administración', 'Administración', '', 1, 0, 0, NULL),
(2, 'Seguridad', 'Seguridad', 'resources/', 1, 1, 0, 1),
(3, 'Menú', 'Menú', 'menu/', 1, 1, 1, 6),
(4, 'Recursos', 'Recursos', 'resources/', 1, 2, 0, 1),
(5, 'Usuarios', 'Usuarios', 'users/', 1, 2, 1, 2),
(6, 'Grupos', 'Grupos', 'groups/', 1, 2, 2, 3);


CREATE OR REPLACE VIEW v_usuarios_activos AS 
SELECT u.*, GROUP_CONCAT(g.nombre ORDER BY g.nombre SEPARATOR ', ') as grupos, GROUP_CONCAT(g.groups_id ORDER BY g.groups_id SEPARATOR ', ') as grupos_id
FROM usuarios u
INNER JOIN usersgroups ug on u.usuarios_id = ug.usuarios_id
INNER JOIN groups g ON ug.groups_id = g.groups_id
WHERE u.estatus = 1 AND g.estatus = 1
GROUP BY u.usuarios_id;

CREATE OR REPLACE VIEW v_usuarios AS 
SELECT u.*, GROUP_CONCAT(g.nombre ORDER BY g.nombre SEPARATOR ', ') as grupos, GROUP_CONCAT(g.groups_id ORDER BY g.groups_id SEPARATOR ', ') as grupos_id
FROM usuarios u
INNER JOIN usersgroups ug on u.usuarios_id = ug.usuarios_id
INNER JOIN groups g ON ug.groups_id = g.groups_id
GROUP BY u.usuarios_id;

CREATE TABLE IF NOT EXISTS `personas` (
  `personas_id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(254) NOT NULL,
  `rfc` VARCHAR(13) NOT NULL,
  `calle` VARCHAR(150) NULL,
  `no_exterior` VARCHAR(20) NULL,
  `no_interior` VARCHAR(20) NULL,
  `colonia` VARCHAR(60) NULL,
  `municipio` VARCHAR(60) NULL,
  `estado` VARCHAR(60) NULL,
  `pais` VARCHAR(60) NULL,
  `codigo_postal` VARCHAR(10) NULL,
  `estatus` INT(1) NOT NULL DEFAULT 1,
  `cat_regimen_fiscal_id` INT NOT NULL DEFAULT 0,
  `cuentas_id` INT NOT NULL DEFAULT 0,
  `fecha_creacion` DATETIME DEFAULT   CURRENT_TIMESTAMP,
  `fecha_edicion` DATETIME ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`personas_id`),
  INDEX `personas_regimen_idx` (`cat_regimen_fiscal_id` ASC),
  INDEX `personas_estatus_idx` (`estatus` ASC),
  INDEX `personas_cuentas_idx` (`cuentas_id` ASC))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `usuarios_personas` (
  `usuarios_id` INT NOT NULL DEFAULT 0,
  `personas_id` INT NOT NULL DEFAULT 0,
  INDEX `usuarios_personas_user_idx` (`usuarios_id` ASC),
  INDEX `usuarios_personas_persona_idx` (`personas_id` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `cat_regimen_fiscal` (
  `cat_regimen_fiscal_id` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(5) NOT NULL DEFAULT '000',
  `descripcion` VARCHAR(150) NULL,
  `fisica` INT(1) NOT NULL DEFAULT 0,
  `moral` INT(1) NOT NULL DEFAULT 0,
  `fecha_inicio_vigencia` DATE NULL,
  `fecha_fin_vigencia` DATE NULL,
  PRIMARY KEY (`cat_regimen_fiscal_id`),
  INDEX `cat_regimen_fiscal_codigo_idx` (`codigo` ASC),
  INDEX `cat_regimen_fiscal_fisica_idx` (`fisica` ASC),
  INDEX `cat_regimen_fiscal_moral_idx` (`moral` ASC))
ENGINE = InnoDB;

INSERT INTO `cat_regimen_fiscal` (`cat_regimen_fiscal_id`, `codigo`, `descripcion`, `fisica`, `moral`, `fecha_inicio_vigencia`, `fecha_fin_vigencia`) VALUES
(1, '605', 'Sueldos y Salarios e Ingresos Asimilados a Salarios', 1, 0, '2016-11-12', NULL),
(2, '606', 'Arrendamiento', 1, 0, '2016-11-12', NULL),
(3, '608', 'Demás ingresos', 1, 0, '2016-11-12', NULL),
(4, '611', 'Ingresos por Dividendos (socios y accionistas)', 1, 0, '2016-11-12', NULL),
(5, '612', 'Personas Físicas con Actividades Empresariales y Profesionales', 1, 0, '2016-11-12', NULL),
(6, '614', 'Ingresos por intereses', 1, 0, '2016-11-12', NULL),
(7, '616', 'Sin obligaciones fiscales', 1, 0, '2016-11-12', NULL),
(8, '621', 'Incorporación Fiscal', 1, 0, '2016-11-12', NULL),
(9, '629', 'De los Regímenes Fiscales Preferentes y de las personas Multinacionales', 1, 0, '2020-01-01', NULL),
(10, '630', 'Enajenación de acciones en bolsa de valores', 1, 0, '2020-01-01', NULL),
(11, '615', 'Régimen de los ingresos por obtención de premios', 1, 0, '2016-11-12', NULL),
(12, '601', 'General de Ley Personas Morales', 0, 1, '2016-11-12', NULL),
(13, '603', 'Personas Morales con Fines no Lucrativos', 0, 1, '2016-11-12', NULL),
(14, '609', 'Consolidación', 0, 1, '2016-11-12', NULL),
(15, '610', 'Residentes en el Extranjero sin Establecimiento Permanente en México', 1, 1, '2016-11-12', NULL),
(16, '620', 'Sociedades Cooperativas de Producción que optan por diferir sus ingresos', 0, 1, '2016-11-12', NULL),
(17, '622', 'Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras', 1, 1, '2016-11-12', NULL),
(18, '623', 'Opcional para Grupos de Sociedades', 0, 1, '2016-11-12', NULL),
(19, '624', 'Coordinados', 0, 1, '2016-11-12', NULL),
(20, '628', 'Hidrocarburos', 0, 1, '2020-01-01', NULL),
(21, '607', 'Régimen de Enajenación o Adquisición de Bienes', 0, 1, '2016-11-12', NULL);

CREATE OR REPLACE VIEW `v_personas` AS
SELECT p.*, crf.codigo, crf.descripcion, crf.fisica, crf.moral
FROM personas p
INNER JOIN cat_regimen_fiscal crf ON p.cat_regimen_fiscal_id = crf.cat_regimen_fiscal_id;

CREATE OR REPLACE VIEW `v_personas_activas` AS
SELECT p.*, crf.codigo, crf.descripcion, crf.fisica, crf.moral
FROM personas p
INNER JOIN cat_regimen_fiscal crf ON p.cat_regimen_fiscal_id = crf.cat_regimen_fiscal_id
WHERE p.estatus = 1;

CREATE TABLE IF NOT EXISTS `cuentas` (
  `cuentas_id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NULL,
  `estatus` INT(1) NOT NULL DEFAULT 1,
  `fecha_creacion` DATETIME DEFAULT   CURRENT_TIMESTAMP,
  `fecha_edicion` DATETIME ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cuentas_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `clientes` (
  `clientes_id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(254) NULL,
  `rfc` VARCHAR(13) NULL,
  `es_extranjero` INT(1) NOT NULL DEFAULT 0,
  `residencia_fiscal` INT NULL,
  `num_reg_id_trib` VARCHAR(40) NULL,
  `estatus` INT(1) NOT NULL DEFAULT 1,
  `cuentas_id` INT NOT NULL DEFAULT 0,
  `fecha_creacion` DATETIME DEFAULT   CURRENT_TIMESTAMP,
  `fecha_edicion` DATETIME ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`clientes_id`),
  INDEX `clientes_extranjero_idx` (`es_extranjero` ASC),
  INDEX `clientes_estatus_idx` (`estatus` ASC),
  INDEX `clientes_cuentas_id_idx` (`cuentas_id` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `cat_uso_cfdi` (
  `cat_uso_cfdi_id` INT NOT NULL AUTO_INCREMENT,
  `clave` VARCHAR(15) NULL,
  `descripcion` VARCHAR(150) NULL,
  `fisica` INT(1) NOT NULL DEFAULT 0,
  `moral` INT(1) NOT NULL DEFAULT 0,
  `fecha_inicio_vigencia` DATE NULL,
  `fecha_fin_vigencia` DATE NULL,
  PRIMARY KEY (`cat_uso_cfdi_id`),
  INDEX `uso_cfdi_fisica_idx` (`fisica` ASC),
  INDEX `uso_cfdi_moral_idx` (`moral` ASC))
ENGINE = InnoDB;

INSERT INTO `cat_uso_cfdi` (`cat_uso_cfdi_id`, `clave`, `descripcion`, `fisica`, `moral`, `fecha_inicio_vigencia`, `fecha_fin_vigencia`) VALUES
(1, 'G01', 'Adquisición de mercancias', 1, 1, '2017-01-01', NULL),
(2, 'G02', 'Devoluciones, descuentos o bonificaciones', 1, 1, '2017-01-01', NULL),
(3, 'G03', 'Gastos en general', 1, 1, '2017-01-01', NULL),
(4, 'I01', 'Construcciones', 1, 1, '2017-01-01', NULL),
(5, 'I02', 'Mobiliario y equipo de oficina por inversiones', 1, 1, '2017-01-01', NULL),
(6, 'I03', 'Equipo de transporte', 1, 1, '2017-01-01', NULL),
(7, 'I04', 'Equipo de computo y accesorios', 1, 1, '2017-01-01', NULL),
(8, 'I05', 'Dados, troqueles, moldes, matrices y herramental', 1, 1, '2017-01-01', NULL),
(9, 'I06', 'Comunicaciones telefónicas', 1, 1, '2017-01-01', NULL),
(10, 'I07', 'Comunicaciones satelitales', 1, 1, '2017-01-01', NULL),
(11, 'I08', 'Otra maquinaria y equipo', 1, 1, '2017-01-01', NULL),
(12, 'D01', 'Honorarios médicos, dentales y gastos hospitalarios', 1, 0, '2017-01-01', NULL),
(13, 'D02', 'Gastos médicos por incapacidad o discapacidad', 1, 0, '2017-01-01', NULL),
(14, 'D03', 'Gastos funerales', 1, 0, '2017-01-01', NULL),
(15, 'D04', 'Donativos', 1, 0, '2017-01-01', NULL),
(16, 'D05', 'Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación)', 1, 0, '2017-01-01', NULL),
(17, 'D06', 'Aportaciones voluntarias al SAR', 1, 0, '2017-01-01', NULL),
(18, 'D07', 'Primas por seguros de gastos médicos', 1, 0, '2017-01-01', NULL),
(19, 'D08', 'Gastos de transportación escolar obligatoria', 1, 0, '2017-01-01', NULL),
(20, 'D09', 'Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones', 1, 0, '2017-01-01', NULL),
(21, 'D10', 'Pagos por servicios educativos (colegiaturas)', 1, 0, '2017-01-01', NULL),
(22, 'P01', 'Por definir', 1, 1, '2017-03-31', NULL);

CREATE TABLE IF NOT EXISTS `cat_tipo_de_comprobante` (
  `cat_tipo_de_comprobante_id` INT NOT NULL AUTO_INCREMENT,
  `clave` VARCHAR(5) NOT NULL,
  `descripcion` VARCHAR(45) NULL,
  `valor_máximo` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `fecha_vigencia` DATE NULL,
  PRIMARY KEY (`cat_tipo_de_comprobante_id`),
  INDEX `tipo_comprobante_clave_idx` (`clave` ASC))
ENGINE = InnoDB;

INSERT INTO `cat_tipo_de_comprobante` (`cat_tipo_de_comprobante_id`, `clave`, `descripcion`, `valor_máximo`, `fecha_vigencia`) VALUES
(1, 'I', 'Ingreso', 100000000, '2017-01-01'),
(2, 'E', 'Egreso', 100000000, '2017-01-01'),
(3, 'T', 'Traslado', 100000000, '2017-01-01'),
(4, 'N', 'Nómina', 2000000, '2017-01-01'),
(5, 'P', 'Pago', 100000000, '2017-01-01');

CREATE TABLE IF NOT EXISTS `cat_moneda` (
  `cat_moneda_id` INT NOT NULL AUTO_INCREMENT,
  `clave` VARCHAR(5) NULL,
  `descripcion` VARCHAR(70) NULL,
  `decimales` INT(1) NOT NULL DEFAULT 2,
  `porcentaje_variacion` DECIMAL(10,7) NOT NULL DEFAULT 35,
  PRIMARY KEY (`cat_moneda_id`),
  INDEX `moneda_clave_idx` (`clave` ASC))
ENGINE = InnoDB;

INSERT INTO `cat_moneda` (`cat_moneda_id`, `clave`, `descripcion`, `decimales`, `porcentaje_variacion`) VALUES
(1,'AED','Dirham de EAU',2,0.352742445236724),
(2,'AFN','Afghani',2,0.352742445236724),
(3,'ALL','Lek',2,0.352742445236724),
(4,'AMD','Dram armenio',2,0.352742445236724),
(5,'ANG','Florín antillano neerlandés',2,0.352742445236724),
(6,'AOA','Kwanza',2,0.352742445236724),
(7,'ARS','Peso Argentino',2,0.629721772651321),
(8,'AUD','Dólar Australiano',2,0.436901209159141),
(9,'AWG','Aruba Florin',2,0.352742445236724),
(10,'AZN','Azerbaijanian Manat',2,0.352742445236724),
(11,'BAM','Convertibles marca',2,0.352742445236724),
(12,'BBD','Dólar de Barbados',2,0.352742445236724),
(13,'BDT','Taka',2,0.352742445236724),
(14,'BGN','Lev búlgaro',2,0.352742445236724),
(15,'BHD','Dinar de Bahrein',3,0.352742445236724),
(16,'BIF','Burundi Franc',0,0.352742445236724),
(17,'BMD','Dólar de Bermudas',2,0.352742445236724),
(18,'BND','Dólar de Brunei',2,0.352742445236724),
(19,'BOB','Boliviano',2,0.353625258849321),
(20,'BOV','Mvdol',2,0.352742445236724),
(21,'BRL','Real brasileño',2,0.509556451999528),
(22,'BSD','Dólar de las Bahamas',2,0.352742445236724),
(23,'BTN','Ngultrum',2,0.352742445236724),
(24,'BWP','Pula',2,0.352742445236724),
(25,'BYR','Rublo bielorruso',0,0.352742445236724),
(26,'BZD','Dólar de Belice',2,0.362979960016213),
(27,'CAD','Dolar Canadiense',2,0.31494390158765),
(28,'CDF','Franco congoleño',2,0.352742445236724),
(29,'CHE','WIR Euro',2,0.352742445236724),
(30,'CHF','Franco Suizo',2,0.494670117054094),
(31,'CHW','Franc WIR',2,0.352742445236724),
(32,'CLF','Unidad de Fomento',4,0.352742445236724),
(33,'CLP','Peso chileno',0,0.446786779502429),
(34,'CNY','Yuan Renminbi',2,0.277564845995828),
(35,'COP','Peso Colombiano',2,0.332248557734335),
(36,'COU','Unidad de Valor real',2,0.352742445236724),
(37,'CRC','Colón costarricense',2,0.311959319801703),
(38,'CUC','Peso Convertible',2,0.352742445236724),
(39,'CUP','Peso Cubano',2,0.362979960016214),
(40,'CVE','Cabo Verde Escudo',2,0.352742445236724),
(41,'CZK','Corona checa',2,0.416334175667417),
(42,'DJF','Franco de Djibouti',0,0.352742445236724),
(43,'DKK','Corona danesa',2,0.398750728222186),
(44,'DOP','Peso Dominicano',2,0.508078961420075),
(45,'DZD','Dinar argelino',2,0.303262598072916),
(46,'EGP','Libra egipcia',2,0.340492272284569),
(47,'ERN','Nakfa',2,0.352742445236724),
(48,'ETB','Birr etíope',2,0.352742445236724),
(49,'EUR','Euro',2,0.39672087279239),
(50,'FJD','Dólar de Fiji',2,0.354643691147613),
(51,'FKP','Libra malvinense',2,0.352742445236724),
(52,'GBP','Libra Esterlina',2,0.287969717061674),
(53,'GEL','Lari',2,0.352742445236724),
(54,'GHS','Cedi de Ghana',2,0.352742445236724),
(55,'GIP','Libra de Gibraltar',2,0.352742445236724),
(56,'GMD','Dalasi',2,0.352742445236724),
(57,'GNF','Franco guineano',0,0.352742445236724),
(58,'GTQ','Quetzal',2,0.35653159361199),
(59,'GYD','Dólar guyanés',2,0.351785052747086),
(60,'HKD','Dolar De Hong Kong',2,0.353161965300373),
(61,'HNL','Lempira',2,0.276419223373733),
(62,'HRK','Kuna',2,0.352742445236724),
(63,'HTG','Gourde',2,0.352742445236724),
(64,'HUF','Florín',2,0.375905790474456),
(65,'IDR','Rupia',2,0.347786255646005),
(66,'ILS','Nuevo Shekel Israelí',2,0.330582456192405),
(67,'INR','Rupia india',2,0.295397850815415),
(68,'IQD','Dinar iraquí',3,0.586089265308866),
(69,'IRR','Rial iraní',2,0.352742445236724),
(70,'ISK','Corona islandesa',0,0.352742445236724),
(71,'JMD','Dólar Jamaiquino',2,0.281001946982178),
(72,'JOD','Dinar jordano',3,0.352742445236724),
(73,'JPY','Yen',0,0.572682303832548),
(74,'KES','Chelín keniano',2,0.302136242413111),
(75,'KGS','Som',2,0.352742445236724),
(76,'KHR','Riel',2,0.352742445236724),
(77,'KMF','Franco Comoro',0,0.352742445236724),
(78,'KPW','Corea del Norte ganó',2,0.352742445236724),
(79,'KRW','Won',0,0.353767614332004),
(80,'KWD','Dinar kuwaití',3,0.327060682084407),
(81,'KYD','Dólar de las Islas Caimán',2,0.352742445236724),
(82,'KZT','Tenge',2,0.352742445236724),
(83,'LAK','Kip',2,0.352742445236724),
(84,'LBP','Libra libanesa',2,0.352742445236724),
(85,'LKR','Rupia de Sri Lanka',2,0.352742445236724),
(86,'LRD','Dólar liberiano',2,0.352742445236724),
(87,'LSL','Loti',2,0.352742445236724),
(88,'LYD','Dinar libio',3,0.352742445236724),
(89,'MAD','Dirham marroquí',2,0.358811092281766),
(90,'MDL','Leu moldavo',2,0.352742445236724),
(91,'MGA','Ariary malgache',2,0.352742445236724),
(92,'MKD','Denar',2,0.352742445236724),
(93,'MMK','Kyat',2,0.352742445236724),
(94,'MNT','Tugrik',2,0.352742445236724),
(95,'MOP','Pataca',2,0.352742445236724),
(96,'MRO','Ouguiya',2,0.352742445236724),
(97,'MUR','Rupia de Mauricio',2,0.352742445236724),
(98,'MVR','Rupia',2,0.352742445236724),
(99,'MWK','Kwacha',2,0.352742445236724),
(100,'MXN','Peso Mexicano',2,0.352742445236724),
(101,'MXV','México Unidad de Inversión (UDI)',2,0.352742445236724),
(102,'MYR','Ringgit malayo',2,0.266974085521927),
(103,'MZN','Mozambique Metical',2,0.352742445236724),
(104,'NAD','Dólar de Namibia',2,0.352742445236724),
(105,'NGN','Naira',2,0.309794139945863),
(106,'NIO','Córdoba Oro',2,0.352742445236724),
(107,'NOK','Corona noruega',2,0.339456927475235),
(108,'NPR','Rupia nepalí',2,0.352742445236724),
(109,'NZD','Dólar de Nueva Zelanda',2,0.447641493440927),
(110,'OMR','Rial omaní',3,0.352742445236724),
(111,'PAB','Balboa',2,0.352742445236724),
(112,'PEN','Nuevo Sol',2,0.28888497390075),
(113,'PGK','Kina',2,0.352742445236724),
(114,'PHP','Peso filipino',2,0.295977140186533),
(115,'PKR','Rupia de Pakistán',2,0.352742445236724),
(116,'PLN','Zloty',2,0.386492746681686),
(117,'PYG','Guaraní',0,0.365789978216704),
(118,'QAR','Qatar Rial',2,0.352742445236724),
(119,'RON','Leu rumano',2,0.35881075582858),
(120,'RSD','Dinar serbio',2,0.352742445236724),
(121,'RUB','Rublo ruso',2,0.351895919908846),
(122,'RWF','Franco ruandés',0,0.352742445236724),
(123,'SAR','Riyal saudí',2,0.351727634700162),
(124,'SBD','Dólar de las Islas Salomón',2,0.352742445236724),
(125,'SCR','Rupia de Seychelles',2,0.352742445236724),
(126,'SDG','Libra sudanesa',2,0.352742445236724),
(127,'SEK','Corona sueca',2,0.384311966867772),
(128,'SGD','Dolar De Singapur',2,0.353931590142105),
(129,'SHP','Libra de Santa Helena',2,0.352742445236724),
(130,'SLL','Leona',2,0.352742445236724),
(131,'SOS','Chelín somalí',2,0.352742445236724),
(132,'SRD','Dólar de Suriname',2,0.352742445236724),
(133,'SSP','Libra sudanesa Sur',2,0.352742445236724),
(134,'STD','Dobra',2,0.352742445236724),
(135,'SVC','Colon El Salvador',2,0.352742445236724),
(136,'SYP','Libra Siria',2,0.352742445236724),
(137,'SZL','Lilangeni',2,0.352742445236724),
(138,'THB','Baht',2,0.371799266808341),
(139,'TJS','Somoni',2,0.352742445236724),
(140,'TMT','Turkmenistán nuevo manat',2,0.352742445236724),
(141,'TND','Dinar tunecino',3,0.352742445236724),
(142,'TOP','Pa\'anga',2,0.352742445236724),
(143,'TRY','Lira turca',2,0.353388670891485),
(144,'TTD','Dólar de Trinidad y Tobago',2,0.285292691870894),
(145,'TWD','Nuevo dólar de Taiwán',2,0.300870290155189),
(146,'TZS','Shilling tanzano',2,0.352742445236724),
(147,'UAH','Hryvnia',2,0.508387405683213),
(148,'UGX','Shilling de Uganda',0,0.352742445236724),
(149,'USD','Dolar americano',2,0.352742445236724),
(150,'USN','Dólar estadounidense (día siguiente)',2,0.352742445236724),
(151,'UYI','Peso Uruguay en Unidades Indexadas (URUIURUI)',0,0.352742445236724),
(152,'UYU','Peso Uruguayo',2,0.317871497279116),
(153,'UZS','Uzbekistán Sum',2,0.352742445236724),
(154,'VEF','Bolívar',2,1.52771210091442),
(155,'VND','Dong',0,0.300617608153373),
(156,'VUV','Vatu',0,0.352742445236724),
(157,'WST','Tala',2,0.352742445236724),
(158,'XAF','Franco CFA BEAC',0,0.352742445236724),
(159,'XAG','Plata',0,0.352742445236724),
(160,'XAU','Oro',0,0.352742445236724),
(161,'XBA','Unidad de Mercados de Bonos Unidad Europea Composite (EURCO)',0,0.352742445236724),
(162,'XBB','Unidad Monetaria de Bonos de Mercados Unidad Europea (UEM-6)',0,0.352742445236724),
(163,'XBC','Mercados de Bonos Unidad Europea unidad de cuenta a 9 (UCE-9)',0,0.352742445236724),
(164,'XBD','Mercados de Bonos Unidad Europea unidad de cuenta a 17 (UCE-17)',0,0.352742445236724),
(165,'XCD','Dólar del Caribe Oriental',2,0.352742445236724),
(166,'XDR','DEG (Derechos Especiales de Giro)',0,0.36813419592436),
(167,'XOF','Franco CFA BCEAO',0,0.352742445236724),
(168,'XPD','Paladio',0,0.352742445236724),
(169,'XPF','Franco CFP',0,0.352742445236724),
(170,'XPT','Platino',0,0.352742445236724),
(171,'XSU','Sucre',0,0.352742445236724),
(172,'XTS','Códigos reservados específicamente para propósitos de prueba',0,0),
(173,'XUA','Unidad ADB de Cuenta',0,0.352742445236724),
(174,'XXX','Los códigos asignados para las transacciones en que intervenga ninguna moneda',0,0),
(175,'YER','Rial yemení',2,0.352742445236724),
(176,'ZAR','Rand',2,0.540140950966442),
(177,'ZMW','Kwacha zambiano',2,0.352742445236724),
(178,'ZWL','Zimbabwe Dólar',2,0.352742445236724);

CREATE TABLE IF NOT EXISTS `cat_forma_pago` (
  `cat_forma_pago_id` INT NOT NULL AUTO_INCREMENT,
  `clave` VARCHAR(5) NOT NULL,
  `descripcion` VARCHAR(60) NOT NULL,
  `bancarizado` VARCHAR(15) NULL,
  PRIMARY KEY (`cat_forma_pago_id`),
  INDEX `forma_pago_clave_idx` (`clave` ASC))
ENGINE = InnoDB;

INSERT INTO `cat_forma_pago` (`cat_forma_pago_id`, `clave`, `descripcion`, `bancarizado`) VALUES
(1,'01','Efectivo','NO'),
(2,'02','Cheque nominativo','SI'),
(3,'03','Transferencia electrónica de fondos','SI'),
(4,'04','Tarjeta de crédito','SI'),
(5,'05','Monedero electrónico','SI'),
(6,'06','Dinero electrónico','SI'),
(7,'08','Vales de despensa','NO'),
(8,'12','Dación en pago','NO'),
(9,'13','Pago por subrogación','NO'),
(10,'14','Pago por consignación','NO'),
(11,'15','Condonación','NO'),
(12,'17','Compensación','NO'),
(13,'23','Novación','NO'),
(14,'24','Confusión','NO'),
(15,'25','Remisión de deuda','NO'),
(16,'26','Prescripción o caducidad','NO'),
(17,'27','A satisfacción del acreedor','NO'),
(18,'28','Tarjeta de débito','SI'),
(19,'29','Tarjeta de servicios','SI'),
(20,'30','Aplicación de anticipos','NO'),
(21,'99','Por definir','OPCIONAL');

CREATE TABLE IF NOT EXISTS `cat_metodo_pago` (
  `cat_metodo_pago_id` INT NOT NULL AUTO_INCREMENT,
  `clave` VARCHAR(5) NOT NULL,
  `descripcion` VARCHAR(60) NOT NULL,
  `fecha_inicio_vigencia` DATE NULL,
  `fecha_fin_vigencia` DATE NULL,
  PRIMARY KEY (`cat_metodo_pago_id`),
  INDEX `metodo_pago_clave_idx` (`clave` ASC))
ENGINE = InnoDB;

INSERT INTO `cat_metodo_pago` (`cat_metodo_pago_id`, `clave`, `descripcion`, `fecha_inicio_vigencia`) VALUES
(1,'PUE','Pago en una sola exhibición','2017-01-01'),
(2,'PPD','Pago en parcialidades o diferido','2017-01-01');
