-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2024 at 05:57 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `caja_iestpffaa`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`iestpffaa`@`%` PROCEDURE `buscarCliente` (IN `idCliente` INT)   BEGIN
	SELECT id, nombres, apellidos, tipo, idTipoDocumento AS tipoDocumento,
    	nroDocumento, telefono, email, fechaNac, idTipoCliente AS tipoCliente
    FROM cliente
    WHERE id = idCliente;
END$$

$$

CREATE DEFINER=`iestpffaa`@`%` PROCEDURE `listarClientes` ()   BEGIN
        SELECT A.id, TRIM(CONCAT(A.nombres, ' ', A.apellidos)) AS nombres,
            CONCAT(C.codigo, ' - ', A.nroDocumento) AS documento, 
            A.telefono, A.email, B.nombre AS tipoCliente, A.tipo
        FROM cliente A INNER JOIN tipocliente B
        ON A.idTipoCliente = B.id INNER JOIN tipodocumento C
        ON A.idTipoDocumento = C.id;
    END$$

CREATE DEFINER=`iestpffaa`@`%` PROCEDURE `listarTiposDocumento` ()   BEGIN
	SELECT id, CONCAT(codigo, ' - ', nombre) AS nombre
    FROM tipodocumento;
END$$

CREATE DEFINER=`iestpffaa`@`%` PROCEDURE `loginUsuario` (`emailUsuario` VARCHAR(80))   BEGIN
	SELECT A.*, B.codigo AS rol
    FROM usuarios A INNER JOIN roles B 
    	ON A.rolId = B.id
    WHERE email = emailUsuario;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `tipo` char(1) NOT NULL COMMENT 'N: Natural | J:Juridica',
  `idTipoDocumento` int(11) NOT NULL,
  `nroDocumento` varchar(30) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `fechaNac` date NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A' COMMENT 'A: Activo | I:Inactivo',
  `idTipoCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id`, `nombres`, `apellidos`, `tipo`, `idTipoDocumento`, `nroDocumento`, `telefono`, `email`, `fechaNac`, `estado`, `idTipoCliente`) VALUES
(1, 'Incotech S.A.C.', '', 'J', 3, '20123456789', '987654321', 'contacto@incotechsac.pe', '0000-00-00', 'A', 2),
(2, 'Rosario', 'Rojas Santillan', 'N', 1, '01234567', '912345678', 'rrojas@uncorreo.com', '1994-11-02', 'A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cuotaprestamo`
--

CREATE TABLE `cuotaprestamo` (
  `id` int(11) NOT NULL,
  `idPrestamo` int(11) NOT NULL,
  `nroCuota` int(11) NOT NULL,
  `importeCuota` decimal(8,3) NOT NULL,
  `importeInteres` decimal(8,3) NOT NULL,
  `amortizacion` decimal(8,3) NOT NULL,
  `fechaPago` datetime NOT NULL,
  `estado` char(1) NOT NULL COMMENT 'P:Pendiente\r\nG:Pagado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cuotaprestamo`
--

INSERT INTO `cuotaprestamo` (`id`, `idPrestamo`, `nroCuota`, `importeCuota`, `importeInteres`, `amortizacion`, `fechaPago`, `estado`) VALUES
(1, 1, 1, 567.360, 120.000, 447.360, '2025-01-06 00:00:00', 'P'),
(2, 1, 2, 567.360, 111.050, 456.310, '2025-02-06 00:00:00', 'P'),
(3, 1, 3, 567.360, 101.930, 465.430, '2025-03-06 00:00:00', 'P'),
(4, 1, 4, 567.360, 92.620, 474.740, '2025-04-06 00:00:00', 'P'),
(5, 1, 5, 567.360, 83.120, 484.240, '2025-05-06 00:00:00', 'P'),
(6, 1, 6, 567.360, 73.440, 493.920, '2025-06-06 00:00:00', 'P'),
(7, 1, 7, 567.360, 63.560, 503.800, '2025-07-06 00:00:00', 'P'),
(8, 1, 8, 567.360, 53.480, 513.880, '2025-08-06 00:00:00', 'P'),
(9, 1, 9, 567.360, 43.210, 524.150, '2025-09-06 00:00:00', 'P'),
(10, 1, 10, 567.360, 32.720, 534.640, '2025-10-06 00:00:00', 'P'),
(11, 1, 11, 567.360, 22.030, 545.330, '2025-11-06 00:00:00', 'P'),
(12, 1, 12, 567.360, 11.120, 556.240, '2025-12-06 00:00:00', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `nroDocumento` varchar(30) NOT NULL,
  `idTipoDocumento` int(11) NOT NULL,
  `fechaNac` date NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A' COMMENT 'A:Activo | I:Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `empleado`
--

INSERT INTO `empleado` (`id`, `nombres`, `apellidos`, `nroDocumento`, `idTipoDocumento`, `fechaNac`, `telefono`, `email`, `estado`) VALUES
(1, 'Graciela Valentina', 'Gutierrez Quispe', '76549123', 1, '2000-10-18', '987654326', 'gvgutierrez@empresa.pe', 'A'),
(2, 'DONALD ALEXANDER', 'Sullon Porras', '12345678', 1, '1988-02-05', '987654321', 'prueba@correo.pe', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `prestamo`
--

CREATE TABLE `prestamo` (
  `id` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `importe` decimal(8,3) NOT NULL,
  `tasa` decimal(5,3) NOT NULL,
  `tiempo` int(11) NOT NULL COMMENT 'Expresado en meses',
  `tipoCuota` char(1) NOT NULL COMMENT 'F:Fijo | V:Variable',
  `fechaPrestamo` datetime NOT NULL,
  `fechaDesembolso` date NOT NULL,
  `estado` char(1) NOT NULL COMMENT 'A:Activo\r\nP:Pendiente\r\nC:Cerrado\r\nN:Anulado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prestamo`
--

INSERT INTO `prestamo` (`id`, `idEmpleado`, `idCliente`, `importe`, `tasa`, `tiempo`, `tipoCuota`, `fechaPrestamo`, `fechaDesembolso`, `estado`) VALUES
(1, 1, 1, 6000.000, 2.000, 12, 'F', '2024-12-06 00:00:00', '2024-12-06', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `codigo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `codigo`) VALUES
(1, 'Administrador', 'ADM'),
(2, 'Recursos Humanos', 'RRHH'),
(3, 'Prestamista', 'PRES'),
(4, 'Cajero', 'CAJ');

-- --------------------------------------------------------

--
-- Table structure for table `tipocliente`
--

CREATE TABLE `tipocliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A' COMMENT 'A: Activo - I: Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipocliente`
--

INSERT INTO `tipocliente` (`id`, `nombre`, `estado`) VALUES
(1, 'Estandar', 'A'),
(2, 'Corporativo', 'A'),
(3, 'Banca Exclusiva', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `codigo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipodocumento`
--

INSERT INTO `tipodocumento` (`id`, `nombre`, `codigo`) VALUES
(1, 'Documento Nacional de Identidad', 'DNI'),
(2, 'Carné de Extranjería', 'CEXTR'),
(3, 'Registro Único de Contribuyente', 'RUC'),
(4, 'Carné de Permiso Temp. de Permanencia', 'CTEMP');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(60) NOT NULL,
  `rolId` int(11) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A' COMMENT 'A: Activo\r\nI: Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `rolId`, `estado`) VALUES
(1, 'Alex', 'Sullon', 'usuario@midominio.pe', '$2y$10$yui5f0UI.xt8N/P5MDT8dORBpfBsHEEWZJAPt/M1CqU6Z9at1tzsq', 1, 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQClienteDocumento` (`idTipoDocumento`,`nroDocumento`),
  ADD KEY `FKClienteTipoCliente` (`idTipoCliente`);

--
-- Indexes for table `cuotaprestamo`
--
ALTER TABLE `cuotaprestamo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQPretamoNroCuota` (`idPrestamo`,`nroCuota`);

--
-- Indexes for table `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQEmpleadoNroDocumento` (`nroDocumento`),
  ADD KEY `FKEmpleadoTipoDocumento` (`idTipoDocumento`);

--
-- Indexes for table `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKPrestamoCliente` (`idCliente`),
  ADD KEY `FKPrestamoEmpleado` (`idEmpleado`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipocliente`
--
ALTER TABLE `tipocliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQTipoCliente` (`nombre`);

--
-- Indexes for table `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cuotaprestamo`
--
ALTER TABLE `cuotaprestamo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tipocliente`
--
ALTER TABLE `tipocliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipodocumento`
--
ALTER TABLE `tipodocumento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `FKClienteTipoCliente` FOREIGN KEY (`idTipoCliente`) REFERENCES `tipocliente` (`id`),
  ADD CONSTRAINT `FKClienteTipoDocumento` FOREIGN KEY (`idTipoDocumento`) REFERENCES `tipodocumento` (`id`);

--
-- Constraints for table `cuotaprestamo`
--
ALTER TABLE `cuotaprestamo`
  ADD CONSTRAINT `FKCuotaPrestamoPrestamo` FOREIGN KEY (`idPrestamo`) REFERENCES `prestamo` (`id`);

--
-- Constraints for table `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `FKEmpleadoTipoDocumento` FOREIGN KEY (`idTipoDocumento`) REFERENCES `tipodocumento` (`id`);

--
-- Constraints for table `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `FKPrestamoCliente` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `FKPrestamoEmpleado` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;