-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-03-2017 a las 20:55:46
-- Versión del servidor: 5.5.54-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `lineaprimaria`
--
CREATE DATABASE IF NOT EXISTS `lineaprimaria` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lineaprimaria`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `pro_grupo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_grupo`()
begin
  declare fechaPrimera date;
  declare fechaSegunda date;
  declare fechaTercera date;
  declare id int;
  declare cur CURSOR FOR SELECT ngr_llave, dgr_primero,dgr_segundo,dgr_tercero 
  FROM Grupo 
  where cast(date_format(dgr_primero,'%d') as UNSIGNED) mod 5 <> 0 
		or cast(date_format(dgr_segundo,'%d') as UNSIGNED) mod 5 <> 0 
		or cast(date_format(dgr_tercero,'%d') as UNSIGNED) mod 5 <> 0;
		
	open cur;
	read_loop: LOOP
	 FETCH cur INTO id,fechaPrimera,fechaSegunda,fechaTercera;
	 
  if date_format(fechaPrimera,'%d') between '01' and '05' then
		update Grupo set dgr_primero = concat(date_format(fechaPrimera,'%Y'),'-',date_format(fechaPrimera,'%m'),'-','05') where ngr_llave = id;
  else if date_format(fechaPrimera,'%d') between '05' and '10' then
		update Grupo set dgr_primero = concat(date_format(fechaPrimera,'%Y'),'-',date_format(fechaPrimera,'%m'),'-','10') where ngr_llave = id;
  else if date_format(fechaPrimera,'%d') between '10' and '15' then
		update Grupo set dgr_primero = concat(date_format(fechaPrimera,'%Y'),'-',date_format(fechaPrimera,'%m'),'-','15') where ngr_llave = id;
  else if date_format(fechaPrimera,'%d') between '15' and '20' then
		update Grupo set dgr_primero = concat(date_format(fechaPrimera,'%Y'),'-',date_format(fechaPrimera,'%m'),'-','20') where ngr_llave = id;
  else if date_format(fechaPrimera,'%d') between '20' and '25' then
		update Grupo set dgr_primero = concat(date_format(fechaPrimera,'%Y'),'-',date_format(fechaPrimera,'%m'),'-','25') where ngr_llave = id;
  else if date_format(fechaPrimera,'%d') between '25' and '30' then
		update Grupo set dgr_primero = concat(date_format(fechaPrimera,'%Y'),'-',date_format(fechaPrimera,'%m'),'-','30') where ngr_llave = id;
		end if;
	end if;
   end if;
   end if;
  end if;
  end if;
  
  -- modificando fecha segundo pago
  if date_format(fechaSegunda,'%d') between '01' and '05' then
		update Grupo set dgr_segundo = concat(date_format(fechaSegunda,'%Y'),'-',date_format(fechaSegunda,'%m'),'-','05') where ngr_llave = id;
  else if date_format(fechaSegunda,'%d') between '05' and '10' then
		update Grupo set dgr_segundo = concat(date_format(fechaSegunda,'%Y'),'-',date_format(fechaSegunda,'%m'),'-','10') where ngr_llave = id;
  else  if date_format(fechaSegunda,'%d') between '10' and '15' then
		update Grupo set dgr_segundo = concat(date_format(fechaSegunda,'%Y'),'-',date_format(fechaSegunda,'%m'),'-','15') where ngr_llave = id;
  else  if date_format(fechaSegunda,'%d') between '15' and '20' then
		update Grupo set dgr_segundo = concat(date_format(fechaSegunda,'%Y'),'-',date_format(fechaSegunda,'%m'),'-','20') where ngr_llave = id;
  else  if date_format(fechaSegunda,'%d') between '20' and '25' then
		update Grupo set dgr_segundo = concat(date_format(fechaSegunda,'%Y'),'-',date_format(fechaSegunda,'%m'),'-','25') where ngr_llave = id;
  else  if date_format(fechaSegunda,'%d') between '25' and '30' then
		update Grupo set dgr_segundo = concat(date_format(fechaSegunda,'%Y'),'-',date_format(fechaSegunda,'%m'),'-','30') where ngr_llave = id;
  end if;
  end if;
  end if;
  end if;
  end if;
  end if;
  -- modificando fecha tercer pago
  if date_format(fechaTercera,'%d') between '01' and '05' then
		update Grupo set dgr_tercero = concat(date_format(fechaTercera,'%Y'),'-',date_format(fechaTercera,'%m'),'-','05') where ngr_llave = id;
  else  if date_format(fechaTercera,'%d') between '05' and '10' then
		update Grupo set dgr_tercero = concat(date_format(fechaTercera,'%Y'),'-',date_format(fechaTercera,'%m'),'-','10') where ngr_llave = id;
  else  if date_format(fechaTercera,'%d') between '10' and '15' then
		update Grupo set dgr_tercero = concat(date_format(fechaTercera,'%Y'),'-',date_format(fechaTercera,'%m'),'-','15') where ngr_llave = id;
  else  if date_format(fechaTercera,'%d') between '15' and '20' then
		update Grupo set dgr_tercero = concat(date_format(fechaTercera,'%Y'),'-',date_format(fechaTercera,'%m'),'-','20') where ngr_llave = id;
  else  if date_format(fechaTercera,'%d') between '20' and '25' then
		update Grupo set dgr_tercero = concat(date_format(fechaTercera,'%Y'),'-',date_format(fechaTercera,'%m'),'-','25') where ngr_llave = id;
  else  if date_format(fechaTercera,'%d') between '25' and '30' then
		update Grupo set dgr_tercero = concat(date_format(fechaTercera,'%Y'),'-',date_format(fechaTercera,'%m'),'-','30') where ngr_llave = id;
  end if;
  end if;
  end if;
  end if;
  end if;
  end if;
  end loop;
  close cur; 
end$$

DROP PROCEDURE IF EXISTS `pro_login`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_login`()
begin
declare nombre varchar(20);
declare cur1 cursor for
select clo_usuario  from Login where dlo_fechasalida is null and datediff(current_timestamp(),dlo_fechaingreso) > 1;
open cur1;
loop
fetch cur1 into nombre;
update Login 
set dlo_fechasalida = current_timestamp() 
where 
	clo_usuario = nombre 
	and dlo_fechasalida is null 
	and DATEDIFF( CURRENT_TIMESTAMP( ) , dlo_fechaingreso ) >1;
end loop;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AdminsWG`
--

DROP TABLE IF EXISTS `AdminsWG`;
CREATE TABLE IF NOT EXISTS `AdminsWG` (
  `naw_llave` int(11) NOT NULL AUTO_INCREMENT,
  `naw_afiliado` int(11) NOT NULL,
  `naw_whatsapp` int(11) NOT NULL,
  `daw_fecha` date NOT NULL,
  PRIMARY KEY (`naw_llave`),
  UNIQUE KEY `naw_afiliado` (`naw_afiliado`,`naw_whatsapp`),
  KEY `f_awwg` (`naw_whatsapp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `AfiliadoGrupo`
--
DROP VIEW IF EXISTS `AfiliadoGrupo`;
CREATE TABLE IF NOT EXISTS `AfiliadoGrupo` (
`codAfiliado` int(11)
,`codGrupo` int(11)
,`nombre` varchar(100)
,`apellido` varchar(30)
,`celular` varchar(12)
,`otros` varchar(12)
,`estado` varchar(1)
,`fechaIngreso` date
,`fechaPago1` date
,`fechaPago2` date
,`fechaPago3` date
,`numeroGrupo` int(11)
,`codigoWhatsapp` bigint(11)
,`nombreWhatsapp` varchar(100)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Afiliados`
--

DROP TABLE IF EXISTS `Afiliados`;
CREATE TABLE IF NOT EXISTS `Afiliados` (
  `afs_llave` int(11) NOT NULL AUTO_INCREMENT,
  `afs_nombres` varchar(100) NOT NULL,
  `afs_apellidos` varchar(30) DEFAULT NULL,
  `afs_celular` varchar(12) NOT NULL,
  `afs_otros` varchar(12) DEFAULT NULL,
  `afs_documento` varchar(12) DEFAULT NULL,
  `afs_estado` varchar(1) NOT NULL,
  PRIMARY KEY (`afs_llave`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1015 ;

--
-- Disparadores `Afiliados`
--
DROP TRIGGER IF EXISTS `tgr_afiliado`;
DELIMITER //
CREATE TRIGGER `tgr_afiliado` BEFORE UPDATE ON `Afiliados`
 FOR EACH ROW BEGIN
if NEW.afs_celular <> OLD.afs_celular then
  insert into Modificaciones(nmo_llave,cmo_tabla,cmo_campo,nmo_idregistro,cmo_anterior,cmo_nuevo,dmo_modificado,cmo_regresar) values 
(null,'Afiliados','afs_celular',OLD.afs_llave,OLD.afs_celular,NEW.afs_celular,current_date(),'N');
END if;
if NEW.afs_nombres <> OLD.afs_nombres then
  insert into Modificaciones(nmo_llave,cmo_tabla,cmo_campo,nmo_idregistro,cmo_anterior,cmo_nuevo,dmo_modificado,cmo_regresar) values (null,'Afiliados','afs_nombres',OLD.afs_llave,OLD.afs_nombres,NEW.afs_nombres,current_date(),'N');
END if;
if NEW.afs_apellidos <> OLD.afs_apellidos then
  insert into Modificaciones(nmo_llave,cmo_tabla,cmo_campo,nmo_idregistro,cmo_anterior,cmo_nuevo,dmo_modificado,cmo_regresar) values (null,'Afiliados','afs_apellidos',OLD.afs_llave,OLD.afs_apellidos,NEW.afs_apellidos,current_date(),'N');
END if;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Grupo`
--

DROP TABLE IF EXISTS `Grupo`;
CREATE TABLE IF NOT EXISTS `Grupo` (
  `ngr_llave` int(11) NOT NULL AUTO_INCREMENT,
  `ngr_afiliado` int(11) NOT NULL,
  `dgr_ingreso` date NOT NULL,
  `dgr_primero` date NOT NULL,
  `dgr_segundo` date NOT NULL,
  `dgr_tercero` date NOT NULL,
  `ngr_grupo` int(11) NOT NULL,
  PRIMARY KEY (`ngr_llave`),
  KEY `ngr_afiliado` (`ngr_afiliado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1354 ;

--
-- Disparadores `Grupo`
--
DROP TRIGGER IF EXISTS `tgr_eliminargrupo`;
DELIMITER //
CREATE TRIGGER `tgr_eliminargrupo` BEFORE DELETE ON `Grupo`
 FOR EACH ROW begin
delete from Nuevos where nnu_grupo = OLD.ngr_llave;
delete from Pagos where npa_pago = OLD.ngr_llave or npa_recibio = OLD.ngr_llave;
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tgr_nuevogrupo`;
DELIMITER //
CREATE TRIGGER `tgr_nuevogrupo` AFTER INSERT ON `Grupo`
 FOR EACH ROW begin
insert into Nuevos 
	(nnu_llave,nnu_grupo,dnu_fecha,cnu_whatsapp) 
	values 
	(null,
     NEW.ngr_llave,
     current_date(),
     'N'
    );
 end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Login`
--

DROP TABLE IF EXISTS `Login`;
CREATE TABLE IF NOT EXISTS `Login` (
  `nlo_llave` int(11) NOT NULL AUTO_INCREMENT,
  `clo_usuario` varchar(20) NOT NULL,
  `dlo_fechaingreso` datetime NOT NULL,
  `dlo_fechasalida` datetime DEFAULT NULL,
  PRIMARY KEY (`nlo_llave`),
  KEY `clo_usuario` (`clo_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Modificaciones`
--

DROP TABLE IF EXISTS `Modificaciones`;
CREATE TABLE IF NOT EXISTS `Modificaciones` (
  `nmo_llave` int(11) NOT NULL AUTO_INCREMENT,
  `cmo_tabla` varchar(100) NOT NULL,
  `cmo_campo` varchar(100) NOT NULL,
  `nmo_idregistro` int(11) NOT NULL,
  `cmo_anterior` varchar(100) NOT NULL,
  `cmo_nuevo` varchar(100) NOT NULL,
  `dmo_modificado` date NOT NULL,
  `cmo_regresar` char(1) NOT NULL,
  `dmo_regresar` date DEFAULT NULL,
  PRIMARY KEY (`nmo_llave`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Nuevos`
--

DROP TABLE IF EXISTS `Nuevos`;
CREATE TABLE IF NOT EXISTS `Nuevos` (
  `nnu_llave` int(11) NOT NULL AUTO_INCREMENT,
  `nnu_grupo` int(11) NOT NULL,
  `dnu_fecha` date NOT NULL,
  `dnu_fechaws` date DEFAULT NULL,
  `cnu_whatsapp` char(1) NOT NULL,
  PRIMARY KEY (`nnu_llave`),
  KEY `nnu_grupo` (`nnu_grupo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1679 ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `NuevosAgregados`
--
DROP VIEW IF EXISTS `NuevosAgregados`;
CREATE TABLE IF NOT EXISTS `NuevosAgregados` (
`llave` int(11)
,`whatSapp` char(1)
,`fecha` date
,`fechaWhatsapp` date
,`grupo` int(11)
,`nombres` varchar(100)
,`afiliado` int(11)
,`apellidos` varchar(30)
,`celular` varchar(12)
,`nombreWhatsapp` varchar(100)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Paginas`
--

DROP TABLE IF EXISTS `Paginas`;
CREATE TABLE IF NOT EXISTS `Paginas` (
  `nps_llave` tinyint(4) NOT NULL AUTO_INCREMENT,
  `cps_nombre` varchar(100) NOT NULL,
  `cps_carpeta` varchar(100) NOT NULL,
  `cps_archivo` varchar(100) NOT NULL,
  `cps_descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nps_llave`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pagos`
--

DROP TABLE IF EXISTS `Pagos`;
CREATE TABLE IF NOT EXISTS `Pagos` (
  `npa_llave` int(11) NOT NULL AUTO_INCREMENT,
  `npa_pago` int(11) NOT NULL,
  `npa_recibio` int(11) NOT NULL,
  `dpa_fecha` date NOT NULL,
  `npa_npago` tinyint(4) NOT NULL DEFAULT '1',
  `cpa_recibe` char(1) DEFAULT NULL,
  `cpa_paga` char(1) DEFAULT NULL,
  PRIMARY KEY (`npa_llave`),
  UNIQUE KEY `npa_pago` (`npa_pago`,`npa_recibio`,`npa_npago`),
  KEY `npa_recibio` (`npa_recibio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1487 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Permisos`
--

DROP TABLE IF EXISTS `Permisos`;
CREATE TABLE IF NOT EXISTS `Permisos` (
  `npe_llave` int(11) NOT NULL AUTO_INCREMENT,
  `cpe_nombre` varchar(100) NOT NULL,
  `cpe_referencia` varchar(10) NOT NULL,
  PRIMARY KEY (`npe_llave`),
  UNIQUE KEY `cpe_referencia` (`cpe_referencia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PermisosRol`
--

DROP TABLE IF EXISTS `PermisosRol`;
CREATE TABLE IF NOT EXISTS `PermisosRol` (
  `npr_llave` int(11) NOT NULL AUTO_INCREMENT,
  `npr_rol` int(11) NOT NULL,
  `npr_permiso` int(11) NOT NULL,
  PRIMARY KEY (`npr_llave`),
  UNIQUE KEY `npr_permiso` (`npr_permiso`,`npr_rol`),
  KEY `f_prro` (`npr_rol`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `ReferidoAG`
--
DROP VIEW IF EXISTS `ReferidoAG`;
CREATE TABLE IF NOT EXISTS `ReferidoAG` (
`codigo` int(11)
,`codAfiliado` int(11)
,`codReferido` int(11)
,`fechaAsociado` date
,`afiliado` varchar(131)
,`celularAfiliado` varchar(12)
,`referido` varchar(131)
,`celularReferido` varchar(12)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Referidos`
--

DROP TABLE IF EXISTS `Referidos`;
CREATE TABLE IF NOT EXISTS `Referidos` (
  `nre_llave` int(11) NOT NULL AUTO_INCREMENT,
  `nre_afiliado` int(11) NOT NULL,
  `nre_referido` int(11) NOT NULL,
  `dre_fecha` date NOT NULL,
  PRIMARY KEY (`nre_llave`),
  KEY `nre_afiliado` (`nre_afiliado`),
  KEY `nre_referido` (`nre_referido`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1021 ;

--
-- Disparadores `Referidos`
--
DROP TRIGGER IF EXISTS `tgr_eliminarwhatsapp`;
DELIMITER //
CREATE TRIGGER `tgr_eliminarwhatsapp` BEFORE DELETE ON `Referidos`
 FOR EACH ROW begin
delete from ReferidoWhatsapp where nrw_referido = OLD.nre_llave;
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tgr_referidos`;
DELIMITER //
CREATE TRIGGER `tgr_referidos` BEFORE UPDATE ON `Referidos`
 FOR EACH ROW BEGIN
IF NEW.nre_afiliado <> OLD.nre_afiliado THEN 
  insert into Modificaciones(nmo_llave,cmo_tabla,cmo_campo,nmo_idregistro,cmo_anterior,cmo_nuevo,dmo_modificado,cmo_regresar) values 
(null,'Referidos','nre_afiliado',OLD.nre_llave,OLD.nre_afiliado,NEW.nre_afiliado,current_date(),'N');
END IF;
IF NEW.nre_referido <> OLD.nre_referido THEN
  insert into Modificaciones(nmo_llave,cmo_tabla,cmo_campo,nmo_idregistro,cmo_anterior,cmo_nuevo,dmo_modificado,cmo_regresar) values 
(null,'Referidos','nre_referido',OLD.nre_llave,OLD.nre_referido,NEW.nre_referido,current_date(),'N');
END IF; 
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tgr_referidowhatsapp`;
DELIMITER //
CREATE TRIGGER `tgr_referidowhatsapp` AFTER INSERT ON `Referidos`
 FOR EACH ROW begin
declare id int;
 set id = (select nrw_whatsapp from ReferidoWhatsapp where nrw_referido = (select nre_llave from Referidos where nre_referido = NEW.nre_afiliado));
 insert into ReferidoWhatsapp (nrw_referido,nrw_whatsapp) values (NEW.nre_llave,id);
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ReferidoWhatsapp`
--

DROP TABLE IF EXISTS `ReferidoWhatsapp`;
CREATE TABLE IF NOT EXISTS `ReferidoWhatsapp` (
  `nrw_llave` int(11) NOT NULL AUTO_INCREMENT,
  `nrw_referido` int(11) NOT NULL,
  `nrw_whatsapp` int(11) DEFAULT NULL,
  `crw_agregado` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`nrw_llave`),
  UNIQUE KEY `nrw_referido` (`nrw_referido`),
  KEY `nrw_whatsapp` (`nrw_whatsapp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=980 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Roles`
--

DROP TABLE IF EXISTS `Roles`;
CREATE TABLE IF NOT EXISTS `Roles` (
  `nro_llave` int(11) NOT NULL AUTO_INCREMENT,
  `cro_nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`nro_llave`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RolPaginas`
--

DROP TABLE IF EXISTS `RolPaginas`;
CREATE TABLE IF NOT EXISTS `RolPaginas` (
  `nrp_rol` int(11) NOT NULL,
  `nrp_pagina` tinyint(11) NOT NULL,
  `nrp_llave` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`nrp_llave`),
  UNIQUE KEY `uni_rp` (`nrp_rol`,`nrp_pagina`),
  KEY `f_rpps` (`nrp_pagina`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
CREATE TABLE IF NOT EXISTS `Usuarios` (
  `cus_usuario` varchar(20) NOT NULL,
  `cus_password` varchar(200) NOT NULL,
  `nus_afiliado` int(11) NOT NULL,
  `nus_intentos` tinyint(4) NOT NULL,
  `cus_estado` varchar(1) NOT NULL,
  `nus_rol` int(11) NOT NULL DEFAULT '1',
  `dus_fechabloqueo` datetime DEFAULT NULL,
  PRIMARY KEY (`cus_usuario`),
  KEY `nus_afiliado` (`nus_afiliado`),
  KEY `nus_rol` (`nus_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Disparadores `Usuarios`
--
DROP TRIGGER IF EXISTS `tgr_usuario_update`;
DELIMITER //
CREATE TRIGGER `tgr_usuario_update` BEFORE UPDATE ON `Usuarios`
 FOR EACH ROW begin
if NEW.nus_intentos > 3 then
set NEW.dus_fechabloqueo = curdate();
set NEW.nus_intentos = 0;
end if;
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_admingw`
--
DROP VIEW IF EXISTS `v_admingw`;
CREATE TABLE IF NOT EXISTS `v_admingw` (
`llave` int(11)
,`afiliado` int(11)
,`nombreAfiliado` varchar(100)
,`apellidoAfiliado` varchar(30)
,`celularAfiliado` varchar(12)
,`otrosAfiliado` varchar(12)
,`estado` varchar(1)
,`whatsapp` int(11)
,`nombreWhatsapp` char(100)
,`usuario` varchar(20)
,`estadoUsuario` varchar(1)
,`rol` int(11)
,`nombreRol` varchar(100)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_afiliadoswhatsapp`
--
DROP VIEW IF EXISTS `v_afiliadoswhatsapp`;
CREATE TABLE IF NOT EXISTS `v_afiliadoswhatsapp` (
`cantidad` bigint(21)
,`grupoWhatsapp` char(100)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_login`
--
DROP VIEW IF EXISTS `v_login`;
CREATE TABLE IF NOT EXISTS `v_login` (
`clo_usuario` varchar(20)
,`dlo_fechaingreso` datetime
,`dlo_fechasalida` datetime
,`tiempoMin` bigint(21)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_paginasrol`
--
DROP VIEW IF EXISTS `v_paginasrol`;
CREATE TABLE IF NOT EXISTS `v_paginasrol` (
`llave` int(11)
,`pagina` tinyint(4)
,`nombrePagina` varchar(100)
,`carpeta` varchar(100)
,`archivo` varchar(100)
,`descripcion` varchar(100)
,`rol` int(11)
,`nombreRol` varchar(100)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_pagos`
--
DROP VIEW IF EXISTS `v_pagos`;
CREATE TABLE IF NOT EXISTS `v_pagos` (
`fecha` date
,`nPago` tinyint(4)
,`pago` int(11)
,`nombresPago` varchar(100)
,`apellidosPago` varchar(30)
,`celularPago` varchar(12)
,`recibio` int(11)
,`nombresRecibio` varchar(100)
,`apellidosRecibio` varchar(30)
,`celularRecibio` varchar(12)
,`whatsappPago` varchar(100)
,`whatsappRecibio` varchar(100)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_permisosroles`
--
DROP VIEW IF EXISTS `v_permisosroles`;
CREATE TABLE IF NOT EXISTS `v_permisosroles` (
`llave` int(11)
,`permiso` int(11)
,`nombrePermiso` varchar(100)
,`referencia` varchar(10)
,`rol` int(11)
,`nombreRol` varchar(100)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `WhatsappGrupos`
--

DROP TABLE IF EXISTS `WhatsappGrupos`;
CREATE TABLE IF NOT EXISTS `WhatsappGrupos` (
  `nwg_llave` int(11) NOT NULL AUTO_INCREMENT,
  `cwg_nombre` char(100) NOT NULL,
  `dwg_fecha` date NOT NULL,
  PRIMARY KEY (`nwg_llave`),
  UNIQUE KEY `cwg_nombre` (`cwg_nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `AfiliadoGrupo`
--
DROP TABLE IF EXISTS `AfiliadoGrupo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `AfiliadoGrupo` AS select `Afiliados`.`afs_llave` AS `codAfiliado`,`Grupo`.`ngr_llave` AS `codGrupo`,`Afiliados`.`afs_nombres` AS `nombre`,`Afiliados`.`afs_apellidos` AS `apellido`,`Afiliados`.`afs_celular` AS `celular`,`Afiliados`.`afs_otros` AS `otros`,`Afiliados`.`afs_estado` AS `estado`,`Grupo`.`dgr_ingreso` AS `fechaIngreso`,`Grupo`.`dgr_primero` AS `fechaPago1`,`Grupo`.`dgr_segundo` AS `fechaPago2`,`Grupo`.`dgr_tercero` AS `fechaPago3`,`Grupo`.`ngr_grupo` AS `numeroGrupo`,(select `WhatsappGrupos`.`nwg_llave` from `WhatsappGrupos` where (`WhatsappGrupos`.`nwg_llave` = (select `ReferidoWhatsapp`.`nrw_whatsapp` from `ReferidoWhatsapp` where (`ReferidoWhatsapp`.`nrw_referido` = (select `Referidos`.`nre_llave` from `Referidos` where (`Referidos`.`nre_referido` = `Grupo`.`ngr_llave`)))))) AS `codigoWhatsapp`,(select `WhatsappGrupos`.`cwg_nombre` from `WhatsappGrupos` where (`WhatsappGrupos`.`nwg_llave` = (select `ReferidoWhatsapp`.`nrw_whatsapp` from `ReferidoWhatsapp` where (`ReferidoWhatsapp`.`nrw_referido` = (select `Referidos`.`nre_llave` from `Referidos` where (`Referidos`.`nre_referido` = `Grupo`.`ngr_llave`)))))) AS `nombreWhatsapp` from (`Afiliados` join `Grupo` on((`Grupo`.`ngr_afiliado` = `Afiliados`.`afs_llave`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `NuevosAgregados`
--
DROP TABLE IF EXISTS `NuevosAgregados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `NuevosAgregados` AS select `Nuevos`.`nnu_llave` AS `llave`,`Nuevos`.`cnu_whatsapp` AS `whatSapp`,`Nuevos`.`dnu_fecha` AS `fecha`,`Nuevos`.`dnu_fechaws` AS `fechaWhatsapp`,`Grupo`.`ngr_llave` AS `grupo`,`Afiliados`.`afs_nombres` AS `nombres`,`Afiliados`.`afs_llave` AS `afiliado`,`Afiliados`.`afs_apellidos` AS `apellidos`,`Afiliados`.`afs_celular` AS `celular`,(select `WhatsappGrupos`.`cwg_nombre` from `WhatsappGrupos` where (`WhatsappGrupos`.`nwg_llave` = (select `ReferidoWhatsapp`.`nrw_whatsapp` from `ReferidoWhatsapp` where (`ReferidoWhatsapp`.`nrw_referido` = (select `Referidos`.`nre_llave` from `Referidos` where (`Referidos`.`nre_referido` = `Grupo`.`ngr_llave`)))))) AS `nombreWhatsapp` from (`Nuevos` join (`Grupo` join `Afiliados` on((`Grupo`.`ngr_afiliado` = `Afiliados`.`afs_llave`))) on((`Nuevos`.`nnu_grupo` = `Grupo`.`ngr_llave`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `ReferidoAG`
--
DROP TABLE IF EXISTS `ReferidoAG`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ReferidoAG` AS select `Referidos`.`nre_llave` AS `codigo`,`Referidos`.`nre_afiliado` AS `codAfiliado`,`Referidos`.`nre_referido` AS `codReferido`,`Referidos`.`dre_fecha` AS `fechaAsociado`,(select concat(`AfiliadoGrupo`.`nombre`,' ',`AfiliadoGrupo`.`apellido`) from `AfiliadoGrupo` where (`AfiliadoGrupo`.`codGrupo` = `Referidos`.`nre_afiliado`)) AS `afiliado`,(select `AfiliadoGrupo`.`celular` from `AfiliadoGrupo` where (`AfiliadoGrupo`.`codGrupo` = `Referidos`.`nre_afiliado`)) AS `celularAfiliado`,(select concat(`AfiliadoGrupo`.`nombre`,' ',`AfiliadoGrupo`.`apellido`) from `AfiliadoGrupo` where (`AfiliadoGrupo`.`codGrupo` = `Referidos`.`nre_referido`)) AS `referido`,(select `AfiliadoGrupo`.`celular` from `AfiliadoGrupo` where (`AfiliadoGrupo`.`codGrupo` = `Referidos`.`nre_referido`)) AS `celularReferido` from `Referidos`;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_admingw`
--
DROP TABLE IF EXISTS `v_admingw`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_admingw` AS select `AdminsWG`.`naw_llave` AS `llave`,`AdminsWG`.`naw_afiliado` AS `afiliado`,`Afiliados`.`afs_nombres` AS `nombreAfiliado`,`Afiliados`.`afs_apellidos` AS `apellidoAfiliado`,`Afiliados`.`afs_celular` AS `celularAfiliado`,`Afiliados`.`afs_otros` AS `otrosAfiliado`,`Afiliados`.`afs_estado` AS `estado`,`AdminsWG`.`naw_whatsapp` AS `whatsapp`,`WhatsappGrupos`.`cwg_nombre` AS `nombreWhatsapp`,`Usuarios`.`cus_usuario` AS `usuario`,`Usuarios`.`cus_estado` AS `estadoUsuario`,`Usuarios`.`nus_rol` AS `rol`,`Roles`.`cro_nombre` AS `nombreRol` from ((((`AdminsWG` join `Afiliados` on((`Afiliados`.`afs_llave` = `AdminsWG`.`naw_afiliado`))) join `WhatsappGrupos` on((`AdminsWG`.`naw_whatsapp` = `WhatsappGrupos`.`nwg_llave`))) join `Usuarios` on((`Usuarios`.`nus_afiliado` = `Afiliados`.`afs_llave`))) join `Roles` on((`Roles`.`nro_llave` = `Usuarios`.`nus_rol`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `v_afiliadoswhatsapp`
--
DROP TABLE IF EXISTS `v_afiliadoswhatsapp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_afiliadoswhatsapp` AS select count(0) AS `cantidad`,`WhatsappGrupos`.`cwg_nombre` AS `grupoWhatsapp` from (`ReferidoWhatsapp` join `WhatsappGrupos` on((`WhatsappGrupos`.`nwg_llave` = `ReferidoWhatsapp`.`nrw_whatsapp`))) group by `ReferidoWhatsapp`.`nrw_whatsapp`;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_login`
--
DROP TABLE IF EXISTS `v_login`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_login` AS select `Login`.`clo_usuario` AS `clo_usuario`,`Login`.`dlo_fechaingreso` AS `dlo_fechaingreso`,`Login`.`dlo_fechasalida` AS `dlo_fechasalida`,(case when isnull(`Login`.`dlo_fechasalida`) then timestampdiff(MINUTE,`Login`.`dlo_fechaingreso`,now()) else timestampdiff(MINUTE,`Login`.`dlo_fechaingreso`,`Login`.`dlo_fechasalida`) end) AS `tiempoMin` from `Login`;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_paginasrol`
--
DROP TABLE IF EXISTS `v_paginasrol`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_paginasrol` AS select `RolPaginas`.`nrp_llave` AS `llave`,`Paginas`.`nps_llave` AS `pagina`,`Paginas`.`cps_nombre` AS `nombrePagina`,`Paginas`.`cps_carpeta` AS `carpeta`,`Paginas`.`cps_archivo` AS `archivo`,`Paginas`.`cps_descripcion` AS `descripcion`,`Roles`.`nro_llave` AS `rol`,`Roles`.`cro_nombre` AS `nombreRol` from ((`RolPaginas` join `Paginas` on((`RolPaginas`.`nrp_pagina` = `Paginas`.`nps_llave`))) join `Roles` on((`RolPaginas`.`nrp_rol` = `Roles`.`nro_llave`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `v_pagos`
--
DROP TABLE IF EXISTS `v_pagos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pagos` AS select `Pagos`.`dpa_fecha` AS `fecha`,`Pagos`.`npa_npago` AS `nPago`,`Pagos`.`npa_pago` AS `pago`,(select `Afiliados`.`afs_nombres` from `Afiliados` where (`Afiliados`.`afs_llave` = (select `Grupo`.`ngr_afiliado` from `Grupo` where (`Grupo`.`ngr_llave` = `Pagos`.`npa_pago`)))) AS `nombresPago`,(select `Afiliados`.`afs_apellidos` from `Afiliados` where (`Afiliados`.`afs_llave` = (select `Grupo`.`ngr_afiliado` from `Grupo` where (`Grupo`.`ngr_llave` = `Pagos`.`npa_pago`)))) AS `apellidosPago`,(select `Afiliados`.`afs_celular` from `Afiliados` where (`Afiliados`.`afs_llave` = (select `Grupo`.`ngr_afiliado` from `Grupo` where (`Grupo`.`ngr_llave` = `Pagos`.`npa_pago`)))) AS `celularPago`,`Pagos`.`npa_recibio` AS `recibio`,(select `Afiliados`.`afs_nombres` from `Afiliados` where (`Afiliados`.`afs_llave` = (select `Grupo`.`ngr_afiliado` from `Grupo` where (`Grupo`.`ngr_llave` = `Pagos`.`npa_recibio`)))) AS `nombresRecibio`,(select `Afiliados`.`afs_apellidos` from `Afiliados` where (`Afiliados`.`afs_llave` = (select `Grupo`.`ngr_afiliado` from `Grupo` where (`Grupo`.`ngr_llave` = `Pagos`.`npa_recibio`)))) AS `apellidosRecibio`,(select `Afiliados`.`afs_celular` from `Afiliados` where (`Afiliados`.`afs_llave` = (select `Grupo`.`ngr_afiliado` from `Grupo` where (`Grupo`.`ngr_llave` = `Pagos`.`npa_recibio`)))) AS `celularRecibio`,(select `WhatsappGrupos`.`cwg_nombre` from `WhatsappGrupos` where (`WhatsappGrupos`.`nwg_llave` = (select `Referidos`.`nre_llave` from `Referidos` where (`Referidos`.`nre_referido` = (select `Grupo`.`ngr_llave` from `Grupo` where (`Grupo`.`ngr_llave` = `Pagos`.`npa_pago`)))))) AS `whatsappPago`,(select `WhatsappGrupos`.`cwg_nombre` from `WhatsappGrupos` where (`WhatsappGrupos`.`nwg_llave` = (select `Referidos`.`nre_llave` from `Referidos` where (`Referidos`.`nre_referido` = (select `Grupo`.`ngr_llave` from `Grupo` where (`Grupo`.`ngr_llave` = `Pagos`.`npa_recibio`)))))) AS `whatsappRecibio` from `Pagos` order by `Pagos`.`dpa_fecha` desc;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_permisosroles`
--
DROP TABLE IF EXISTS `v_permisosroles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_permisosroles` AS select `PermisosRol`.`npr_llave` AS `llave`,`Permisos`.`npe_llave` AS `permiso`,`Permisos`.`cpe_nombre` AS `nombrePermiso`,`Permisos`.`cpe_referencia` AS `referencia`,`Roles`.`nro_llave` AS `rol`,`Roles`.`cro_nombre` AS `nombreRol` from ((`PermisosRol` join `Permisos` on((`Permisos`.`npe_llave` = `PermisosRol`.`npr_permiso`))) join `Roles` on((`PermisosRol`.`npr_rol` = `Roles`.`nro_llave`)));

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `AdminsWG`
--
ALTER TABLE `AdminsWG`
  ADD CONSTRAINT `AdminsWG_ibfk_1` FOREIGN KEY (`naw_afiliado`) REFERENCES `Afiliados` (`afs_llave`),
  ADD CONSTRAINT `f_awafs` FOREIGN KEY (`naw_afiliado`) REFERENCES `Afiliados` (`afs_llave`),
  ADD CONSTRAINT `f_awwg` FOREIGN KEY (`naw_whatsapp`) REFERENCES `WhatsappGrupos` (`nwg_llave`);

--
-- Filtros para la tabla `Grupo`
--
ALTER TABLE `Grupo`
  ADD CONSTRAINT `Grupo_ibfk_1` FOREIGN KEY (`ngr_afiliado`) REFERENCES `Afiliados` (`afs_llave`);

--
-- Filtros para la tabla `Login`
--
ALTER TABLE `Login`
  ADD CONSTRAINT `Login_ibfk_1` FOREIGN KEY (`clo_usuario`) REFERENCES `Usuarios` (`cus_usuario`);

--
-- Filtros para la tabla `Nuevos`
--
ALTER TABLE `Nuevos`
  ADD CONSTRAINT `Nuevos_ibfk_1` FOREIGN KEY (`nnu_grupo`) REFERENCES `Grupo` (`ngr_llave`);

--
-- Filtros para la tabla `Pagos`
--
ALTER TABLE `Pagos`
  ADD CONSTRAINT `Pagos_ibfk_1` FOREIGN KEY (`npa_recibio`) REFERENCES `Grupo` (`ngr_llave`),
  ADD CONSTRAINT `Pagos_ibfk_2` FOREIGN KEY (`npa_pago`) REFERENCES `Grupo` (`ngr_llave`);

--
-- Filtros para la tabla `PermisosRol`
--
ALTER TABLE `PermisosRol`
  ADD CONSTRAINT `f_prpe` FOREIGN KEY (`npr_permiso`) REFERENCES `Permisos` (`npe_llave`),
  ADD CONSTRAINT `f_prro` FOREIGN KEY (`npr_rol`) REFERENCES `Roles` (`nro_llave`);

--
-- Filtros para la tabla `Referidos`
--
ALTER TABLE `Referidos`
  ADD CONSTRAINT `Referidos_ibfk_1` FOREIGN KEY (`nre_afiliado`) REFERENCES `Grupo` (`ngr_llave`),
  ADD CONSTRAINT `Referidos_ibfk_2` FOREIGN KEY (`nre_referido`) REFERENCES `Grupo` (`ngr_llave`);

--
-- Filtros para la tabla `ReferidoWhatsapp`
--
ALTER TABLE `ReferidoWhatsapp`
  ADD CONSTRAINT `ReferidoWhatsapp_ibfk_1` FOREIGN KEY (`nrw_referido`) REFERENCES `Referidos` (`nre_llave`),
  ADD CONSTRAINT `ReferidoWhatsapp_ibfk_2` FOREIGN KEY (`nrw_whatsapp`) REFERENCES `WhatsappGrupos` (`nwg_llave`);

--
-- Filtros para la tabla `RolPaginas`
--
ALTER TABLE `RolPaginas`
  ADD CONSTRAINT `f_rpps` FOREIGN KEY (`nrp_pagina`) REFERENCES `Paginas` (`nps_llave`),
  ADD CONSTRAINT `f_rpro` FOREIGN KEY (`nrp_rol`) REFERENCES `Roles` (`nro_llave`);

--
-- Filtros para la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD CONSTRAINT `Usuarios_ibfk_1` FOREIGN KEY (`nus_afiliado`) REFERENCES `Afiliados` (`afs_llave`),
  ADD CONSTRAINT `Usuarios_ibfk_2` FOREIGN KEY (`nus_rol`) REFERENCES `Roles` (`nro_llave`);
