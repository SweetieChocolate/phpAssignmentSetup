-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2023 at 04:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `BIN_TO_UUID` (`b` BINARY(16)) RETURNS CHAR(36) CHARSET latin1 COLLATE latin1_swedish_ci  BEGIN
   DECLARE hexStr CHAR(32);
   SET hexStr = HEX(b);
   RETURN LOWER(CONCAT(
        SUBSTR(hexStr, 1, 8), '-',
        SUBSTR(hexStr, 9, 4), '-',
        SUBSTR(hexStr, 13, 4), '-',
        SUBSTR(hexStr, 17, 4), '-',
        SUBSTR(hexStr, 21)
    ));
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `UUID_TO_BIN` (`uuid` CHAR(36)) RETURNS BINARY(16)  BEGIN
    RETURN UNHEX(REPLACE(uuid, '-', ''));
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `allowance`
--

CREATE TABLE `allowance` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `EmploymentID` binary(16) DEFAULT NULL,
  `FromMonth` datetime(6) DEFAULT NULL,
  `ToMonth` datetime(6) DEFAULT NULL,
  `AllowanceTypeID` binary(16) DEFAULT NULL,
  `Amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `allowance`
--

INSERT INTO `allowance` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `EmploymentID`, `FromMonth`, `ToMonth`, `AllowanceTypeID`, `Amount`) VALUES
(0x8efedb6dc0f011edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:11:32.769322', '2023-03-12 23:11:48.360575', b'0', 0x17b739ecc0ee11edbde050ebf62b0b36, '2023-01-01 00:00:00.000000', NULL, 0x740ebae3c08411ed8f3450ebf62b0b36, 20),
(0x98f8a60fc0f011edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:11:49.505846', '2023-03-12 23:11:59.837565', b'0', 0x5829ef3ac0ee11edbde050ebf62b0b36, '2023-01-01 00:00:00.000000', '2023-04-01 00:00:00.000000', 0x740ebae3c08411ed8f3450ebf62b0b36, 20);

-- --------------------------------------------------------

--
-- Table structure for table `autonumber`
--

CREATE TABLE `autonumber` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `ObjectClassType` text DEFAULT NULL,
  `Format` text DEFAULT NULL,
  `CurrentNumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `autonumber`
--

INSERT INTO `autonumber` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `ObjectClassType`, `Format`, `CurrentNumber`) VALUES
(0xfe89ab83c0ed11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 22:53:11.415951', '2023-03-12 22:53:15.681829', b'0', 'OEmployment', 'E%05d', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bonus`
--

CREATE TABLE `bonus` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `EmploymentID` binary(16) DEFAULT NULL,
  `FromMonth` datetime(6) DEFAULT NULL,
  `ToMonth` datetime(6) DEFAULT NULL,
  `BonusTypeID` binary(16) DEFAULT NULL,
  `Amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bonus`
--

INSERT INTO `bonus` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `EmploymentID`, `FromMonth`, `ToMonth`, `BonusTypeID`, `Amount`) VALUES
(0xa28e29aec0f011edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:12:05.585201', '2023-03-12 23:12:17.873641', b'0', 0x741004edc0ee11edbde050ebf62b0b36, '2023-01-01 00:00:00.000000', NULL, 0xa78be552c08411ed8f3450ebf62b0b36, 20),
(0xaa7458a1c0f011edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:12:18.837771', '2023-03-12 23:12:31.729760', b'0', 0x84f66e67c0ee11edbde050ebf62b0b36, '2023-01-01 00:00:00.000000', '2023-03-01 00:00:00.000000', 0xa78be552c08411ed8f3450ebf62b0b36, 20);

-- --------------------------------------------------------

--
-- Table structure for table `careerhistory`
--

CREATE TABLE `careerhistory` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `EmploymentID` binary(16) DEFAULT NULL,
  `PreviousCareerID` binary(16) DEFAULT NULL,
  `NextCareerID` binary(16) DEFAULT NULL,
  `Salary` double DEFAULT NULL,
  `NewSalary` double DEFAULT NULL,
  `CareerCodeID` binary(16) DEFAULT NULL,
  `RegionID` binary(16) DEFAULT NULL,
  `BranchID` binary(16) DEFAULT NULL,
  `LocationID` binary(16) DEFAULT NULL,
  `DepartmentID` binary(16) DEFAULT NULL,
  `PositionID` binary(16) DEFAULT NULL,
  `PositionFamilyID` binary(16) DEFAULT NULL,
  `JobLevelID` binary(16) DEFAULT NULL,
  `EffectiveDate` datetime(6) DEFAULT NULL,
  `EndDate` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `careerhistory`
--

INSERT INTO `careerhistory` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `EmploymentID`, `PreviousCareerID`, `NextCareerID`, `Salary`, `NewSalary`, `CareerCodeID`, `RegionID`, `BranchID`, `LocationID`, `DepartmentID`, `PositionID`, `PositionFamilyID`, `JobLevelID`, `EffectiveDate`, `EndDate`) VALUES
(0x3328ff1ec0ee11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 22:54:39.701628', '2023-03-12 23:00:17.906385', b'0', 0x17b739ecc0ee11edbde050ebf62b0b36, NULL, 0xf0840ba6c0ee11edbde050ebf62b0b36, 500, 500, 0x2e9a144abfca11edb19f50ebf62b0b36, NULL, 0x979ea08cbfc911edb19f50ebf62b0b36, 0xa983e4c2bfc911edb19f50ebf62b0b36, 0xb62c7e0abfc911edb19f50ebf62b0b36, 0xc7e4ab47bfc911edb19f50ebf62b0b36, 0xfa5c382bbfc911edb19f50ebf62b0b36, 0x1ae25bb0bfca11edb19f50ebf62b0b36, '2023-01-01 00:00:00.000000', '2023-03-14 00:00:00.000000'),
(0x6859e8e7c0ee11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 22:56:08.941444', '2023-03-12 22:56:08.945781', b'0', 0x5829ef3ac0ee11edbde050ebf62b0b36, NULL, NULL, 500, 500, 0x2e9a144abfca11edb19f50ebf62b0b36, 0x7efe5267bfc911edb19f50ebf62b0b36, NULL, 0xa5fc9140bfc911edb19f50ebf62b0b36, 0xba144426bfc911edb19f50ebf62b0b36, 0xcbd46b5dbfc911edb19f50ebf62b0b36, 0x021b6e92bfca11edb19f50ebf62b0b36, NULL, '2023-01-01 00:00:00.000000', NULL),
(0x84603f80c0ee11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 22:56:55.959188', '2023-03-12 22:56:55.962821', b'0', 0x741004edc0ee11edbde050ebf62b0b36, NULL, NULL, 500, 500, 0x2e9a144abfca11edb19f50ebf62b0b36, 0x7efe5267bfc911edb19f50ebf62b0b36, 0x979ea08cbfc911edb19f50ebf62b0b36, NULL, 0xba144426bfc911edb19f50ebf62b0b36, 0xcbd46b5dbfc911edb19f50ebf62b0b36, NULL, 0x1ae25bb0bfca11edb19f50ebf62b0b36, '2023-01-01 00:00:00.000000', NULL),
(0x9ef8436bc0ee11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 22:57:40.576182', '2023-03-12 22:57:40.579807', b'0', 0x84f66e67c0ee11edbde050ebf62b0b36, NULL, NULL, 500, 500, 0x2e9a144abfca11edb19f50ebf62b0b36, 0x7efe5267bfc911edb19f50ebf62b0b36, 0x94306f0abfc911edb19f50ebf62b0b36, NULL, 0xbd7da3b8bfc911edb19f50ebf62b0b36, NULL, 0x021b6e92bfca11edb19f50ebf62b0b36, 0x1ae25bb0bfca11edb19f50ebf62b0b36, '2023-01-01 00:00:00.000000', NULL),
(0xbaf2073ac0ee11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 22:58:27.511525', '2023-03-12 22:58:27.515140', b'0', 0xa0a382eac0ee11edbde050ebf62b0b36, NULL, NULL, 500, 500, 0x2e9a144abfca11edb19f50ebf62b0b36, 0x8e2512efbfc911edb19f50ebf62b0b36, NULL, 0xa983e4c2bfc911edb19f50ebf62b0b36, 0xbd7da3b8bfc911edb19f50ebf62b0b36, 0xcf12d669bfc911edb19f50ebf62b0b36, NULL, NULL, '2023-01-01 00:00:00.000000', NULL),
(0xc8ab36b3c0ee11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 22:58:50.535603', '2023-03-12 22:58:50.539598', b'0', 0xbe837f2bc0ee11edbde050ebf62b0b36, NULL, NULL, 500, 500, 0x2e9a144abfca11edb19f50ebf62b0b36, 0x89ffe2a5bfc911edb19f50ebf62b0b36, 0x979ea08cbfc911edb19f50ebf62b0b36, NULL, NULL, 0xcbd46b5dbfc911edb19f50ebf62b0b36, 0x07179b3fbfca11edb19f50ebf62b0b36, NULL, '2023-01-01 00:00:00.000000', NULL),
(0xdb450820c0ee11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 22:59:21.742602', '2023-03-12 22:59:21.746345', b'0', 0xcd64eb3ec0ee11edbde050ebf62b0b36, NULL, NULL, 500, 500, 0x2e9a144abfca11edb19f50ebf62b0b36, 0x89ffe2a5bfc911edb19f50ebf62b0b36, 0x9c68fb67bfc911edb19f50ebf62b0b36, NULL, 0xba144426bfc911edb19f50ebf62b0b36, 0xcf12d669bfc911edb19f50ebf62b0b36, NULL, 0x1ae25bb0bfca11edb19f50ebf62b0b36, '2023-01-01 00:00:00.000000', NULL),
(0xf0840ba6c0ee11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 22:59:57.387720', '2023-03-12 23:00:17.907629', b'0', 0x17b739ecc0ee11edbde050ebf62b0b36, 0x3328ff1ec0ee11edbde050ebf62b0b36, NULL, 500, 600, 0x33979fe2bfca11edb19f50ebf62b0b36, NULL, 0x979ea08cbfc911edb19f50ebf62b0b36, 0xa983e4c2bfc911edb19f50ebf62b0b36, 0xb62c7e0abfc911edb19f50ebf62b0b36, 0xcbd46b5dbfc911edb19f50ebf62b0b36, 0xfa5c382bbfc911edb19f50ebf62b0b36, 0x1ae25bb0bfca11edb19f50ebf62b0b36, '2023-03-15 00:00:00.000000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `codefield`
--

CREATE TABLE `codefield` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `ParentID` binary(16) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `CodeType` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `codefield`
--

INSERT INTO `codefield` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `ParentID`, `Description`, `CodeType`) VALUES
(0x7efe5267bfc911edb19f50ebf62b0b36, 'R1', 'Region 1', 'System Administrator', 'System Administrator', '2023-03-11 11:59:25.828218', '2023-03-11 11:59:43.385085', b'0', NULL, NULL, 'REGION'),
(0x89ffe2a5bfc911edb19f50ebf62b0b36, 'R2', 'Region 2', 'System Administrator', 'System Administrator', '2023-03-11 11:59:44.293401', '2023-03-11 11:59:49.708801', b'0', NULL, NULL, 'REGION'),
(0x8e2512efbfc911edb19f50ebf62b0b36, 'R3', 'Region 3', 'System Administrator', 'System Administrator', '2023-03-11 11:59:51.248007', '2023-03-11 11:59:57.070332', b'0', NULL, NULL, 'REGION'),
(0xddb60ab7bfc911edb19f50ebf62b0b36, 'R4', 'Region 4', 'System Administrator', 'System Administrator', '2023-03-11 12:02:04.738074', '2023-03-11 12:02:09.864648', b'0', NULL, NULL, 'REGION'),
(0xe199f816bfc911edb19f50ebf62b0b36, 'R5', 'Region 5', 'System Administrator', 'System Administrator', '2023-03-11 12:02:11.264988', '2023-03-11 12:02:16.067016', b'0', NULL, NULL, 'REGION'),
(0x94306f0abfc911edb19f50ebf62b0b36, 'B1', 'Branch 1', 'System Administrator', 'System Administrator', '2023-03-11 12:00:01.388798', '2023-03-11 12:00:06.343485', b'0', NULL, NULL, 'BRANCH'),
(0x979ea08cbfc911edb19f50ebf62b0b36, 'B2', 'Branch 2', 'System Administrator', 'System Administrator', '2023-03-11 12:00:07.144112', '2023-03-11 12:00:14.096304', b'0', NULL, NULL, 'BRANCH'),
(0x9c68fb67bfc911edb19f50ebf62b0b36, 'B3', 'Branch 3', 'System Administrator', 'System Administrator', '2023-03-11 12:00:15.181153', '2023-03-11 12:00:20.920695', b'0', NULL, NULL, 'BRANCH'),
(0xa06e8aa6bfc911edb19f50ebf62b0b36, 'B4', 'Branch 4', 'System Administrator', 'System Administrator', '2023-03-11 12:00:21.928507', '2023-03-11 12:00:26.945433', b'0', NULL, NULL, 'BRANCH'),
(0xe6d099f9bfc911edb19f50ebf62b0b36, 'B5', 'Branch 5', 'System Administrator', 'System Administrator', '2023-03-11 12:02:20.011729', '2023-03-11 12:02:25.681064', b'0', NULL, NULL, 'BRANCH'),
(0xa5fc9140bfc911edb19f50ebf62b0b36, 'L1', 'Location 1', 'System Administrator', 'System Administrator', '2023-03-11 12:00:31.247859', '2023-03-11 12:00:36.540114', b'0', NULL, NULL, 'LOCATION'),
(0xa983e4c2bfc911edb19f50ebf62b0b36, 'L2', 'Location 2', 'System Administrator', 'System Administrator', '2023-03-11 12:00:37.167899', '2023-03-11 12:00:41.822712', b'0', NULL, NULL, 'LOCATION'),
(0xacb9880bbfc911edb19f50ebf62b0b36, 'L3', 'Location 3', 'System Administrator', 'System Administrator', '2023-03-11 12:00:42.552643', '2023-03-11 12:00:48.635422', b'0', NULL, NULL, 'LOCATION'),
(0xb0d93e48bfc911edb19f50ebf62b0b36, 'L4', 'Location 4', 'System Administrator', 'System Administrator', '2023-03-11 12:00:49.471299', '2023-03-11 12:00:54.390604', b'0', NULL, NULL, 'LOCATION'),
(0xeea21e05bfc911edb19f50ebf62b0b36, 'L5', 'Location 5', 'System Administrator', 'System Administrator', '2023-03-11 12:02:33.128772', '2023-03-11 12:02:37.921901', b'0', NULL, NULL, 'LOCATION'),
(0xb62c7e0abfc911edb19f50ebf62b0b36, 'D1', 'Department 1', 'System Administrator', 'System Administrator', '2023-03-11 12:00:58.405506', '2023-03-11 12:01:04.284409', b'0', NULL, NULL, 'DEPARTMENT'),
(0xba144426bfc911edb19f50ebf62b0b36, 'D2', 'Department 2', 'System Administrator', 'System Administrator', '2023-03-11 12:01:04.957628', '2023-03-11 12:01:10.090691', b'0', NULL, NULL, 'DEPARTMENT'),
(0xbd7da3b8bfc911edb19f50ebf62b0b36, 'D3', 'Department 3', 'System Administrator', 'System Administrator', '2023-03-11 12:01:10.681348', '2023-03-11 12:01:16.249237', b'0', NULL, NULL, 'DEPARTMENT'),
(0xc1119256bfc911edb19f50ebf62b0b36, 'D4', 'Department 4', 'System Administrator', 'System Administrator', '2023-03-11 12:01:16.684001', '2023-03-11 12:01:23.935048', b'0', NULL, NULL, 'DEPARTMENT'),
(0xf3377edebfc911edb19f50ebf62b0b36, 'D5', 'Department 5', 'System Administrator', 'System Administrator', '2023-03-11 12:02:40.818629', '2023-03-11 12:02:46.664796', b'0', NULL, NULL, 'DEPARTMENT'),
(0xc7e4ab47bfc911edb19f50ebf62b0b36, 'P1', 'Position 1', 'System Administrator', 'System Administrator', '2023-03-11 12:01:28.133777', '2023-03-11 12:01:33.883233', b'0', NULL, NULL, 'POSITION'),
(0xcbd46b5dbfc911edb19f50ebf62b0b36, 'P2', 'Position 2', 'System Administrator', 'System Administrator', '2023-03-11 12:01:34.738327', '2023-03-11 12:01:39.524554', b'0', NULL, NULL, 'POSITION'),
(0xcf12d669bfc911edb19f50ebf62b0b36, 'P3', 'Position 3', 'System Administrator', 'System Administrator', '2023-03-11 12:01:40.180415', '2023-03-11 12:01:46.109209', b'0', NULL, NULL, 'POSITION'),
(0xd32008a7bfc911edb19f50ebf62b0b36, 'P4', 'Position 4', 'System Administrator', 'System Administrator', '2023-03-11 12:01:46.977783', '2023-03-11 12:01:52.267874', b'0', NULL, NULL, 'POSITION'),
(0xd6dce8b0bfc911edb19f50ebf62b0b36, 'P5', 'Position 5', 'System Administrator', 'System Administrator', '2023-03-11 12:01:53.248765', '2023-03-11 12:01:58.471543', b'0', NULL, NULL, 'POSITION'),
(0xfa5c382bbfc911edb19f50ebf62b0b36, 'PF1', 'Position Family 1', 'System Administrator', 'System Administrator', '2023-03-11 12:02:52.803345', '2023-03-11 12:03:04.793602', b'0', NULL, NULL, 'POSITIONFAMILY'),
(0x021b6e92bfca11edb19f50ebf62b0b36, 'PF2', 'Position Family 2', 'System Administrator', 'System Administrator', '2023-03-11 12:03:05.800524', '2023-03-11 12:03:13.337675', b'0', NULL, NULL, 'POSITIONFAMILY'),
(0x07179b3fbfca11edb19f50ebf62b0b36, 'PF3', 'Position Family 3', 'System Administrator', 'System Administrator', '2023-03-11 12:03:14.164075', '2023-03-11 12:03:20.876505', b'0', NULL, NULL, 'POSITIONFAMILY'),
(0x0b7795a4bfca11edb19f50ebf62b0b36, 'PF4', 'Position Family 4', 'System Administrator', 'System Administrator', '2023-03-11 12:03:21.503951', '2023-03-11 12:03:26.562081', b'0', NULL, NULL, 'POSITIONFAMILY'),
(0x0efb0cc6bfca11edb19f50ebf62b0b36, 'PF5', 'Position Family 5', 'System Administrator', 'System Administrator', '2023-03-11 12:03:27.398719', '2023-03-11 12:03:31.786542', b'0', NULL, NULL, 'POSITIONFAMILY'),
(0x13ef854cbfca11edb19f50ebf62b0b36, 'JL1', 'Job Level 1', 'System Administrator', 'System Administrator', '2023-03-11 12:03:35.711763', '2023-03-11 12:03:46.377777', b'0', NULL, NULL, 'JOBLEVEL'),
(0x1ae25bb0bfca11edb19f50ebf62b0b36, 'JL2', 'Job Level 2', 'System Administrator', 'System Administrator', '2023-03-11 12:03:47.369538', '2023-03-11 12:03:51.584955', b'0', NULL, NULL, 'JOBLEVEL'),
(0x1dd7d5a8bfca11edb19f50ebf62b0b36, 'JL3', 'Job Level 3', 'System Administrator', 'System Administrator', '2023-03-11 12:03:52.333726', '2023-03-11 12:03:59.728974', b'0', NULL, NULL, 'JOBLEVEL'),
(0x22ad03f8bfca11edb19f50ebf62b0b36, 'JL4', 'Job Level 4', 'System Administrator', 'System Administrator', '2023-03-11 12:04:00.441745', '2023-03-11 12:04:04.566035', b'0', NULL, NULL, 'JOBLEVEL'),
(0x2599d867bfca11edb19f50ebf62b0b36, 'JL5', 'Job Level 5', 'System Administrator', 'System Administrator', '2023-03-11 12:04:05.349782', '2023-03-11 12:04:14.258867', b'0', NULL, NULL, 'JOBLEVEL'),
(0x2e9a144abfca11edb19f50ebf62b0b36, 'NEWJOIN', 'New Join', 'System Administrator', 'System Administrator', '2023-03-11 12:04:20.450269', '2023-03-11 12:04:27.861420', b'0', NULL, NULL, 'CAREERCODE'),
(0x33979fe2bfca11edb19f50ebf62b0b36, 'PROMOTE', 'Promote', 'System Administrator', 'System Administrator', '2023-03-11 12:04:28.822876', '2023-03-11 12:04:37.896423', b'0', NULL, NULL, 'CAREERCODE'),
(0x397b8918bfca11edb19f50ebf62b0b36, 'DEMOTE', 'Demote', 'System Administrator', 'System Administrator', '2023-03-11 12:04:38.705028', '2023-03-11 12:04:47.289344', b'0', NULL, NULL, 'CAREERCODE'),
(0x3fbb6944bfca11edb19f50ebf62b0b36, 'MOVE', 'Movement', 'System Administrator', 'System Administrator', '2023-03-11 12:04:49.189981', '2023-03-11 12:04:54.824128', b'0', NULL, NULL, 'CAREERCODE'),
(0x46f602b6bfca11edb19f50ebf62b0b36, 'SEPARATION', 'Separation', 'System Administrator', 'System Administrator', '2023-03-11 12:05:01.318071', '2023-03-11 12:05:23.974664', b'0', NULL, NULL, 'CAREERCODE'),
(0x740ebae3c08411ed8f3450ebf62b0b36, 'GAS', 'Gasoline Allowance', 'System Administrator', 'System Administrator', '2023-03-12 10:17:43.369426', '2023-03-12 10:17:57.312519', b'0', NULL, NULL, 'ALLOWANCETYPE'),
(0x806f87c7c08411ed8f3450ebf62b0b36, 'PHONE', 'Phone Allowance', 'System Administrator', 'System Administrator', '2023-03-12 10:18:04.136311', '2023-03-12 10:18:10.684153', b'0', NULL, NULL, 'ALLOWANCETYPE'),
(0x84b70a3bc08411ed8f3450ebf62b0b36, 'HOUSE', 'House Allowance', 'System Administrator', 'System Administrator', '2023-03-12 10:18:11.315830', '2023-03-12 10:18:22.317167', b'0', NULL, NULL, 'ALLOWANCETYPE'),
(0x8bcf649cc08411ed8f3450ebf62b0b36, 'MEAL', 'Meal Allowance', 'System Administrator', 'System Administrator', '2023-03-12 10:18:23.219481', '2023-03-12 10:18:51.485518', b'0', NULL, NULL, 'ALLOWANCETYPE'),
(0xa1c50dadc08411ed8f3450ebf62b0b36, 'INC', 'Incentive Bonus', 'System Administrator', 'System Administrator', '2023-03-12 10:19:00.061613', '2023-03-12 10:19:08.725120', b'0', NULL, NULL, 'BONUSTYPE'),
(0xa78be552c08411ed8f3450ebf62b0b36, 'ACH', 'Achievement Bonus', 'System Administrator', 'System Administrator', '2023-03-12 10:19:09.753337', '2023-03-12 10:19:27.262633', b'0', NULL, NULL, 'BONUSTYPE'),
(0xb346439dc08411ed8f3450ebf62b0b36, 'APP', 'Appraisal Bonus', 'System Administrator', 'System Administrator', '2023-03-12 10:19:29.430022', '2023-03-12 10:19:37.456654', b'0', NULL, NULL, 'BONUSTYPE'),
(0xba2ac586c08411ed8f3450ebf62b0b36, 'LATE', 'Late Deduction', 'System Administrator', 'System Administrator', '2023-03-12 10:19:40.993535', '2023-03-12 10:19:58.256960', b'0', NULL, NULL, 'DEDUCTIONTYPE'),
(0xc4f54a28c08411ed8f3450ebf62b0b36, 'EAR', 'Early Deduction', 'System Administrator', 'System Administrator', '2023-03-12 10:19:59.097976', '2023-03-12 10:20:07.260806', b'0', NULL, NULL, 'DEDUCTIONTYPE'),
(0xcaefa01dc08411ed8f3450ebf62b0b36, 'LEAVE', 'Leave Deduction', 'System Administrator', 'System Administrator', '2023-03-12 10:20:09.127181', '2023-03-12 10:20:21.389546', b'0', NULL, NULL, 'DEDUCTIONTYPE');

-- --------------------------------------------------------

--
-- Table structure for table `deduction`
--

CREATE TABLE `deduction` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `EmploymentID` binary(16) DEFAULT NULL,
  `FromMonth` datetime(6) DEFAULT NULL,
  `ToMonth` datetime(6) DEFAULT NULL,
  `DeductionTypeID` binary(16) DEFAULT NULL,
  `Amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `deduction`
--

INSERT INTO `deduction` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `EmploymentID`, `FromMonth`, `ToMonth`, `DeductionTypeID`, `Amount`) VALUES
(0xb4ca30f5c0f011edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:12:36.177594', '2023-03-12 23:12:54.735304', b'0', 0xbe837f2bc0ee11edbde050ebf62b0b36, '2023-03-01 00:00:00.000000', '2023-03-01 00:00:00.000000', 0xcaefa01dc08411ed8f3450ebf62b0b36, 10);

-- --------------------------------------------------------

--
-- Table structure for table `employment`
--

CREATE TABLE `employment` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `PersonID` binary(16) DEFAULT NULL,
  `Salary` double DEFAULT NULL,
  `StartDate` datetime(6) DEFAULT NULL,
  `EndDate` datetime(6) DEFAULT NULL,
  `RegionID` binary(16) DEFAULT NULL,
  `BranchID` binary(16) DEFAULT NULL,
  `LocationID` binary(16) DEFAULT NULL,
  `DepartmentID` binary(16) DEFAULT NULL,
  `PositionID` binary(16) DEFAULT NULL,
  `PositionFamilyID` binary(16) DEFAULT NULL,
  `JobLevelID` binary(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employment`
--

INSERT INTO `employment` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `PersonID`, `Salary`, `StartDate`, `EndDate`, `RegionID`, `BranchID`, `LocationID`, `DepartmentID`, `PositionID`, `PositionFamilyID`, `JobLevelID`) VALUES
(0x17b739ecc0ee11edbde050ebf62b0b36, 'E00001', 'DOV Ratha', 'System Administrator', 'System Administrator', '2023-03-12 22:53:53.657543', '2023-03-12 23:00:17.927635', b'0', 0x17b7afdbc0ee11edbde050ebf62b0b36, 600, '2023-01-01 00:00:00.000000', NULL, NULL, 0x979ea08cbfc911edb19f50ebf62b0b36, 0xa983e4c2bfc911edb19f50ebf62b0b36, 0xb62c7e0abfc911edb19f50ebf62b0b36, 0xcbd46b5dbfc911edb19f50ebf62b0b36, 0xfa5c382bbfc911edb19f50ebf62b0b36, 0x1ae25bb0bfca11edb19f50ebf62b0b36),
(0x5829ef3ac0ee11edbde050ebf62b0b36, 'E00002', 'VUTHY Lyhour', 'System Administrator', 'System Administrator', '2023-03-12 22:55:41.783475', '2023-03-12 22:56:08.947913', b'0', 0x582ccdc0c0ee11edbde050ebf62b0b36, 500, '2023-01-01 00:00:00.000000', NULL, 0x7efe5267bfc911edb19f50ebf62b0b36, NULL, 0xa5fc9140bfc911edb19f50ebf62b0b36, 0xba144426bfc911edb19f50ebf62b0b36, 0xcbd46b5dbfc911edb19f50ebf62b0b36, 0x021b6e92bfca11edb19f50ebf62b0b36, NULL),
(0x741004edc0ee11edbde050ebf62b0b36, 'E00003', 'KAO Sokmean', 'System Administrator', 'System Administrator', '2023-03-12 22:56:28.589841', '2023-03-12 22:56:55.964884', b'0', 0x74107c7fc0ee11edbde050ebf62b0b36, 500, '2023-01-01 00:00:00.000000', NULL, 0x7efe5267bfc911edb19f50ebf62b0b36, 0x979ea08cbfc911edb19f50ebf62b0b36, NULL, 0xba144426bfc911edb19f50ebf62b0b36, 0xcbd46b5dbfc911edb19f50ebf62b0b36, NULL, 0x1ae25bb0bfca11edb19f50ebf62b0b36),
(0x84f66e67c0ee11edbde050ebf62b0b36, 'E00004', 'HOUN Darika', 'System Administrator', 'System Administrator', '2023-03-12 22:56:56.943414', '2023-03-12 22:57:40.581810', b'0', 0x84f6e78cc0ee11edbde050ebf62b0b36, 500, '2023-01-01 00:00:00.000000', NULL, 0x7efe5267bfc911edb19f50ebf62b0b36, 0x94306f0abfc911edb19f50ebf62b0b36, NULL, 0xbd7da3b8bfc911edb19f50ebf62b0b36, NULL, 0x021b6e92bfca11edb19f50ebf62b0b36, 0x1ae25bb0bfca11edb19f50ebf62b0b36),
(0xa0a382eac0ee11edbde050ebf62b0b36, 'E00005', 'LIM Chhily', 'System Administrator', 'System Administrator', '2023-03-12 22:57:43.376210', '2023-03-12 22:58:27.517264', b'0', 0xa0a3fd4ac0ee11edbde050ebf62b0b36, 500, '2023-01-01 00:00:00.000000', NULL, 0x8e2512efbfc911edb19f50ebf62b0b36, NULL, 0xa983e4c2bfc911edb19f50ebf62b0b36, 0xbd7da3b8bfc911edb19f50ebf62b0b36, 0xcf12d669bfc911edb19f50ebf62b0b36, NULL, NULL),
(0xbe837f2bc0ee11edbde050ebf62b0b36, 'E00006', 'MAO Linda', 'System Administrator', 'System Administrator', '2023-03-12 22:58:33.498034', '2023-03-12 22:58:50.565533', b'0', 0xbe83f626c0ee11edbde050ebf62b0b36, 500, '2023-01-01 00:00:00.000000', NULL, 0x89ffe2a5bfc911edb19f50ebf62b0b36, 0x979ea08cbfc911edb19f50ebf62b0b36, NULL, NULL, 0xcbd46b5dbfc911edb19f50ebf62b0b36, 0x07179b3fbfca11edb19f50ebf62b0b36, NULL),
(0xcd64eb3ec0ee11edbde050ebf62b0b36, 'E00007', 'CHHOM Vannak', 'System Administrator', 'System Administrator', '2023-03-12 22:58:58.463461', '2023-03-12 22:59:21.748413', b'0', 0xcd65625dc0ee11edbde050ebf62b0b36, 500, '2023-01-01 00:00:00.000000', NULL, 0x89ffe2a5bfc911edb19f50ebf62b0b36, 0x9c68fb67bfc911edb19f50ebf62b0b36, NULL, 0xba144426bfc911edb19f50ebf62b0b36, 0xcf12d669bfc911edb19f50ebf62b0b36, NULL, 0x1ae25bb0bfca11edb19f50ebf62b0b36);

-- --------------------------------------------------------

--
-- Table structure for table `functionmodule`
--

CREATE TABLE `functionmodule` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Category` text DEFAULT NULL,
  `SubCategory` text DEFAULT NULL,
  `FunctionName` text DEFAULT NULL,
  `DisplayOrder` int(11) DEFAULT NULL,
  `URL` text DEFAULT NULL,
  `SubURL` text DEFAULT NULL,
  `IsEnable` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `functionmodule`
--

INSERT INTO `functionmodule` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `Category`, `SubCategory`, `FunctionName`, `DisplayOrder`, `URL`, `SubURL`, `IsEnable`) VALUES
(0x9c80b26cc09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'IT ADMINISTRATION', '', 'Function', 901, '~/modules/01-it-admin/function-module.php', '', b'1'),
(0x9c80bc72c09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'IT ADMINISTRATION', '', 'Role', 902, '~/modules/01-it-admin/role-module.php', '', b'1'),
(0x9c80bcf4c09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'IT ADMINISTRATION', '', 'Auto Number', 903, '~/modules/01-it-admin/auto-number.php', '', b'1'),
(0x9c80bd2fc09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'SYSTEM SETTING', '', 'User Management', 801, '~/modules/02-system-admin/user-management.php', '', b'1'),
(0x9c80bd81c09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'SYSTEM SETTING', '', 'Region', 802, '~/modules/03-workforce-management/setup/region.php', '', b'1'),
(0x9c80bddac09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'SYSTEM SETTING', '', 'Branch', 803, '~/modules/03-workforce-management/setup/branch.php', '', b'1'),
(0x9c80be06c09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'SYSTEM SETTING', '', 'Location', 804, '~/modules/03-workforce-management/setup/location.php', '', b'1'),
(0x9c8113e5c09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'SYSTEM SETTING', '', 'Department', 805, '~/modules/03-workforce-management/setup/department.php', '', b'1'),
(0x9c8116cbc09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'SYSTEM SETTING', '', 'Position', 806, '~/modules/03-workforce-management/setup/position.php', '', b'1'),
(0x9c81178ac09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'SYSTEM SETTING', '', 'Position Family', 807, '~/modules/03-workforce-management/setup/position-family.php', '', b'1'),
(0x9c81181ec09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'SYSTEM SETTING', '', 'Job Level', 808, '~/modules/03-workforce-management/setup/job-level.php', '', b'1'),
(0x9c8118c6c09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'SYSTEM SETTING', '', 'Career Code', 809, '~/modules/03-workforce-management/setup/career-code.php', '', b'1'),
(0x9c811957c09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'SYSTEM SETTING', '', 'Payroll Setting', 810, '~/modules/04-payroll/setup/payroll-setting.php', '', b'1'),
(0x9c811a43c09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'SYSTEM SETTING', '', 'Allowance Type', 811, '~/modules/04-payroll/setup/allowance-type.php', '', b'1'),
(0x9c811ad0c09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'SYSTEM SETTING', '', 'Bonus Type', 812, '~/modules/04-payroll/setup/bonus-type.php', '', b'1'),
(0x9c811b59c09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'SYSTEM SETTING', '', 'Deduction Type', 813, '~/modules/04-payroll/setup/deduction-type.php', '', b'1'),
(0x9c811be0c09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'WORKFORCE MANAGEMENT', '', 'Employment', 101, '~/modules/03-workforce-management/employment.php', '', b'1'),
(0x9c811c5dc09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'WORKFORCE MANAGEMENT', '', 'Career History', 102, '~/modules/03-workforce-management/career-history.php', '', b'1'),
(0x9c811cdbc09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 23:01:53.555289', b'0', 'PAYROLL', '', 'Generate Monthly Salary', 201, '~/modules/04-payroll/monthly-salary-generate.php', '', b'1'),
(0x9c811d5fc09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'PAYROLL', '', 'Monthly Salary', 202, '~/modules/04-payroll/monthly-salary.php', '', b'1'),
(0x9c811de7c09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'PAYROLL', '', 'Allowance', 203, '~/modules/04-payroll/allowance.php', '', b'1'),
(0x9c811e82c09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'PAYROLL', '', 'Bonus', 204, '~/modules/04-payroll/bonus.php', '', b'1'),
(0x9c811f03c09a11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 12:56:20.000000', '2023-03-12 12:56:20.000000', b'0', 'PAYROLL', '', 'Deduction', 205, '~/modules/04-payroll/deduction.php', '', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `functionroledetail`
--

CREATE TABLE `functionroledetail` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `FunctionModuleID` binary(16) DEFAULT NULL,
  `RoleModuleID` binary(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `functionroledetail`
--

INSERT INTO `functionroledetail` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `FunctionModuleID`, `RoleModuleID`) VALUES
(0x9f0a3c28c0c011ed994850ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 17:28:25.285637', '2023-03-12 17:28:27.352964', b'0', 0x9c811be0c09a11ed8f3450ebf62b0b36, 0x33af5494c0c011ed994850ebf62b0b36),
(0xa789e9fec0c011ed994850ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 17:28:39.544129', '2023-03-12 17:28:41.431922', b'0', 0x9c811c5dc09a11ed8f3450ebf62b0b36, 0x33af5494c0c011ed994850ebf62b0b36),
(0x350d063bc0ef11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:01:52.370483', '2023-03-12 23:01:53.556757', b'0', 0x9c811cdbc09a11ed8f3450ebf62b0b36, 0x33af5494c0c011ed994850ebf62b0b36);

-- --------------------------------------------------------

--
-- Table structure for table `monthlysalary`
--

CREATE TABLE `monthlysalary` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `MonthlySalaryGenerateID` binary(16) DEFAULT NULL,
  `EmploymentID` binary(16) DEFAULT NULL,
  `InMonth` datetime(6) DEFAULT NULL,
  `FromDate` datetime(6) DEFAULT NULL,
  `ToDate` datetime(6) DEFAULT NULL,
  `TotalDay` double DEFAULT NULL,
  `ExchangeRate` double DEFAULT NULL,
  `GenerateMessage` text DEFAULT NULL,
  `BasicSalaryEarned` double DEFAULT NULL,
  `AllowanceAmount` double DEFAULT NULL,
  `BonusAmount` double DEFAULT NULL,
  `DeductionAmount` double DEFAULT NULL,
  `SalaryAmount` double DEFAULT NULL,
  `AmountToBeTax` double DEFAULT NULL,
  `AmountToBeTaxKH` double DEFAULT NULL,
  `TaxAmount` double DEFAULT NULL,
  `TaxAmountKH` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `monthlysalary`
--

INSERT INTO `monthlysalary` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `MonthlySalaryGenerateID`, `EmploymentID`, `InMonth`, `FromDate`, `ToDate`, `TotalDay`, `ExchangeRate`, `GenerateMessage`, `BasicSalaryEarned`, `AllowanceAmount`, `BonusAmount`, `DeductionAmount`, `SalaryAmount`, `AmountToBeTax`, `AmountToBeTaxKH`, `TaxAmount`, `TaxAmountKH`) VALUES
(0xcc1d0765c0f011edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:13:15.308090', '2023-03-12 23:13:54.279164', b'0', 0xc631ba47c0f011edbde050ebf62b0b36, 0x17b739ecc0ee11edbde050ebf62b0b36, '2023-01-01 00:00:00.000000', '2023-01-01 00:00:00.000000', '2023-01-31 00:00:00.000000', 31, 4000, 'Success', 500, 20, 0, 0, 511.75, 520, 2080000, 8.25, 33000),
(0xce02b8eec0f011edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:13:18.491159', '2023-03-12 23:13:54.276404', b'0', 0xc631ba47c0f011edbde050ebf62b0b36, 0x5829ef3ac0ee11edbde050ebf62b0b36, '2023-01-01 00:00:00.000000', '2023-01-01 00:00:00.000000', '2023-01-31 00:00:00.000000', 31, 4000, 'Success', 500, 20, 0, 0, 511.75, 520, 2080000, 8.25, 33000),
(0xcff37046c0f011edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:13:21.746383', '2023-03-12 23:13:54.273714', b'0', 0xc631ba47c0f011edbde050ebf62b0b36, 0x741004edc0ee11edbde050ebf62b0b36, '2023-01-01 00:00:00.000000', '2023-01-01 00:00:00.000000', '2023-01-31 00:00:00.000000', 31, 4000, 'Success', 500, 0, 20, 0, 511.75, 520, 2080000, 8.25, 33000),
(0xd1fd077ac0f011edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:13:25.164734', '2023-03-12 23:13:54.270926', b'0', 0xc631ba47c0f011edbde050ebf62b0b36, 0x84f66e67c0ee11edbde050ebf62b0b36, '2023-01-01 00:00:00.000000', '2023-01-01 00:00:00.000000', '2023-01-31 00:00:00.000000', 31, 4000, 'Success', 500, 0, 20, 0, 511.75, 520, 2080000, 8.25, 33000),
(0xd4f48001c0f011edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:13:30.141955', '2023-03-12 23:13:54.269554', b'0', 0xc631ba47c0f011edbde050ebf62b0b36, 0xa0a382eac0ee11edbde050ebf62b0b36, '2023-01-01 00:00:00.000000', '2023-01-01 00:00:00.000000', '2023-01-31 00:00:00.000000', 31, 4000, 'Success', 500, 0, 0, 0, 493.75, 500, 2000000, 6.25, 25000),
(0xd712ef66c0f011edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:13:33.696860', '2023-03-12 23:13:54.268198', b'0', 0xc631ba47c0f011edbde050ebf62b0b36, 0xbe837f2bc0ee11edbde050ebf62b0b36, '2023-01-01 00:00:00.000000', '2023-01-01 00:00:00.000000', '2023-01-31 00:00:00.000000', 31, 4000, 'Success', 500, 0, 0, 0, 493.75, 500, 2000000, 6.25, 25000),
(0xd961ed61c0f011edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:13:37.570005', '2023-03-12 23:13:54.266820', b'0', 0xc631ba47c0f011edbde050ebf62b0b36, 0xcd64eb3ec0ee11edbde050ebf62b0b36, '2023-01-01 00:00:00.000000', '2023-01-01 00:00:00.000000', '2023-01-31 00:00:00.000000', 31, 4000, 'Success', 500, 0, 0, 0, 493.75, 500, 2000000, 6.25, 25000);

-- --------------------------------------------------------

--
-- Table structure for table `monthlysalaryallowance`
--

CREATE TABLE `monthlysalaryallowance` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `MonthlySalaryID` binary(16) DEFAULT NULL,
  `AllowanceTypeID` binary(16) DEFAULT NULL,
  `Amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `monthlysalaryallowance`
--

INSERT INTO `monthlysalaryallowance` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `MonthlySalaryID`, `AllowanceTypeID`, `Amount`) VALUES
(0xdfbf2725c0f011edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:13:48.247264', '2023-03-12 23:13:54.277791', b'0', 0xce02b8eec0f011edbde050ebf62b0b36, 0x740ebae3c08411ed8f3450ebf62b0b36, 20),
(0xdfc0e0d3c0f011edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:13:48.258583', '2023-03-12 23:13:54.295518', b'0', 0xcc1d0765c0f011edbde050ebf62b0b36, 0x740ebae3c08411ed8f3450ebf62b0b36, 20);

-- --------------------------------------------------------

--
-- Table structure for table `monthlysalarybonus`
--

CREATE TABLE `monthlysalarybonus` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `MonthlySalaryID` binary(16) DEFAULT NULL,
  `BonusTypeID` binary(16) DEFAULT NULL,
  `Amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `monthlysalarybonus`
--

INSERT INTO `monthlysalarybonus` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `MonthlySalaryID`, `BonusTypeID`, `Amount`) VALUES
(0xdfb9faa1c0f011edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:13:48.213375', '2023-03-12 23:13:54.272376', b'0', 0xd1fd077ac0f011edbde050ebf62b0b36, 0xa78be552c08411ed8f3450ebf62b0b36, 20),
(0xdfbd841ac0f011edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:13:48.236537', '2023-03-12 23:13:54.275053', b'0', 0xcff37046c0f011edbde050ebf62b0b36, 0xa78be552c08411ed8f3450ebf62b0b36, 20);

-- --------------------------------------------------------

--
-- Table structure for table `monthlysalarydeduction`
--

CREATE TABLE `monthlysalarydeduction` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `MonthlySalaryID` binary(16) DEFAULT NULL,
  `DeductionTypeID` binary(16) DEFAULT NULL,
  `Amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `monthlysalarygenerate`
--

CREATE TABLE `monthlysalarygenerate` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `InMonth` datetime(6) DEFAULT NULL,
  `FromDate` datetime(6) DEFAULT NULL,
  `ToDate` datetime(6) DEFAULT NULL,
  `ExchangeRate` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `monthlysalarygenerate`
--

INSERT INTO `monthlysalarygenerate` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `InMonth`, `FromDate`, `ToDate`, `ExchangeRate`) VALUES
(0xc631ba47c0f011edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:13:05.377382', '2023-03-12 23:13:54.265397', b'0', '2023-01-01 00:00:00.000000', '2023-01-01 00:00:00.000000', '2023-01-31 00:00:00.000000', 4000);

-- --------------------------------------------------------

--
-- Table structure for table `payrollsetting`
--

CREATE TABLE `payrollsetting` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payrollsetting`
--

INSERT INTO `payrollsetting` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`) VALUES
(0x26e85efdc08c11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 11:12:49.907450', '2023-03-12 11:43:02.458043', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `FamilyName` text DEFAULT NULL,
  `GivenName` text DEFAULT NULL,
  `Gender` text DEFAULT NULL,
  `BirthDay` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `FamilyName`, `GivenName`, `Gender`, `BirthDay`) VALUES
(0x17b7afdbc0ee11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 22:53:53.660601', '2023-03-12 22:55:26.317980', b'0', 'DOV', 'Ratha', NULL, '2000-01-01 00:00:00.000000'),
(0x582ccdc0c0ee11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 22:55:41.802388', '2023-03-12 22:56:08.949230', b'0', 'VUTHY', 'Lyhour', NULL, '2000-01-01 00:00:00.000000'),
(0x74107c7fc0ee11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 22:56:28.592901', '2023-03-12 22:56:55.966289', b'0', 'KAO', 'Sokmean', NULL, '2000-01-01 00:00:00.000000'),
(0x84f6e78cc0ee11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 22:56:56.946514', '2023-03-12 22:57:40.583120', b'0', 'HOUN', 'Darika', NULL, '2000-01-01 00:00:00.000000'),
(0xa0a3fd4ac0ee11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 22:57:43.379326', '2023-03-12 22:58:27.518569', b'0', 'LIM', 'Chhily', NULL, '2000-01-01 00:00:00.000000'),
(0xbe83f626c0ee11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 22:58:33.501076', '2023-03-12 22:58:50.580523', b'0', 'MAO', 'Linda', NULL, '2000-01-01 00:00:00.000000'),
(0xcd65625dc0ee11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 22:58:58.466509', '2023-03-12 22:59:21.749719', b'0', 'CHHOM', 'Vannak', NULL, '2000-01-01 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `personemail`
--

CREATE TABLE `personemail` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `PersonID` binary(16) DEFAULT NULL,
  `Type` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `personemail`
--

INSERT INTO `personemail` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `PersonID`, `Type`) VALUES
(0x3ecd911fc0ee11edbde050ebf62b0b36, 'abc@gmail.com', '', 'System Administrator', 'System Administrator', '2023-03-12 22:54:59.235094', '2023-03-12 22:55:26.320627', b'0', 0x17b7afdbc0ee11edbde050ebf62b0b36, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `personphone`
--

CREATE TABLE `personphone` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `PersonID` binary(16) DEFAULT NULL,
  `Type` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `personphone`
--

INSERT INTO `personphone` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `PersonID`, `Type`) VALUES
(0x3915e067c0ee11edbde050ebf62b0b36, '011 22 33 44', '', 'System Administrator', 'System Administrator', '2023-03-12 22:54:49.642652', '2023-03-12 22:55:26.319313', b'0', 0x17b7afdbc0ee11edbde050ebf62b0b36, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `rolemodule`
--

CREATE TABLE `rolemodule` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rolemodule`
--

INSERT INTO `rolemodule` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`) VALUES
(0x21cccd9fc0c011ed994850ebf62b0b36, 'ADMIN', 'Administrator', 'System Administrator', 'System Administrator', '2023-03-12 17:24:55.167872', '2023-03-12 17:25:07.043341', b'0'),
(0x296f5594c0c011ed994850ebf62b0b36, 'SYSADMIN', 'System Administrator', 'System Administrator', 'System Administrator', '2023-03-12 17:25:07.977027', '2023-03-12 17:25:23.215897', b'0'),
(0x33af5494c0c011ed994850ebf62b0b36, 'TEST', 'TEST Role', 'System Administrator', 'System Administrator', '2023-03-12 17:25:25.173644', '2023-03-12 17:25:42.417699', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `taxcontribution`
--

CREATE TABLE `taxcontribution` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `PayrollSettingID` binary(16) DEFAULT NULL,
  `FromAmount` double DEFAULT NULL,
  `ToAmount` double DEFAULT NULL,
  `TaxRate` double DEFAULT NULL,
  `CumulativeDeduction` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `taxcontribution`
--

INSERT INTO `taxcontribution` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `PayrollSettingID`, `FromAmount`, `ToAmount`, `TaxRate`, `CumulativeDeduction`) VALUES
(0x3e378d2dc08d11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 11:20:38.510393', '2023-03-12 11:22:35.183986', b'0', 0x26e85efdc08c11ed8f3450ebf62b0b36, 0, 1500000, 0, 0),
(0x52593d5ac08d11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 11:21:12.285590', '2023-03-12 11:43:02.465460', b'0', 0x26e85efdc08c11ed8f3450ebf62b0b36, 1500001, 2000000, 5, 75000),
(0x615fcd84c08d11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 11:21:37.494424', '2023-03-12 11:43:02.463650', b'0', 0x26e85efdc08c11ed8f3450ebf62b0b36, 2000001, 8500000, 10, 175000),
(0x6f7a1adcc08d11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 11:22:01.154900', '2023-03-12 11:43:02.461645', b'0', 0x26e85efdc08c11ed8f3450ebf62b0b36, 8500001, 12500000, 15, 600000),
(0x820df2b4c08d11ed8f3450ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 11:22:32.322796', '2023-03-12 11:43:02.459861', b'0', 0x26e85efdc08c11ed8f3450ebf62b0b36, 12500001, 1000000000, 20, 1225000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `UserName` text DEFAULT NULL,
  `Password` text DEFAULT NULL,
  `UserEmail` text DEFAULT NULL,
  `IsAdministrator` bit(1) DEFAULT NULL,
  `IsBan` bit(1) DEFAULT NULL,
  `RequirePasswordChange` bit(1) DEFAULT NULL,
  `LastLoginTime` datetime(6) DEFAULT NULL,
  `EmploymentID` binary(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `UserName`, `Password`, `UserEmail`, `IsAdministrator`, `IsBan`, `RequirePasswordChange`, `LastLoginTime`, `EmploymentID`) VALUES
(0xf3956184c0ed11edbde050ebf62b0b36, '', 'System Administrator', 'System Administrator', 'System Administrator', '2023-03-12 22:52:53.000000', '2023-03-13 22:14:35.243721', b'0', 'sa', '1', 'abc@gmail.com', b'1', b'0', b'0', '2023-03-13 22:14:35.242303', NULL),
(0x17b81787c0ee11edbde050ebf62b0b36, 'E00001', 'DOV Ratha', 'System Administrator', 'System Administrator', '2023-03-12 22:53:53.663223', '2023-03-12 23:01:11.499038', b'0', 'E00001', 'E00001', NULL, b'0', b'0', b'0', NULL, 0x17b739ecc0ee11edbde050ebf62b0b36),
(0x582d9469c0ee11edbde050ebf62b0b36, 'E00002', 'VUTHY Lyhour', 'System Administrator', 'System Administrator', '2023-03-12 22:55:41.807404', '2023-03-12 22:56:08.950525', b'0', 'E00002', 'E00002', NULL, NULL, b'1', NULL, NULL, 0x5829ef3ac0ee11edbde050ebf62b0b36),
(0x7410da77c0ee11edbde050ebf62b0b36, 'E00003', 'KAO Sokmean', 'System Administrator', 'System Administrator', '2023-03-12 22:56:28.595305', '2023-03-12 22:56:55.967782', b'0', 'E00003', 'E00003', NULL, NULL, b'1', NULL, NULL, 0x741004edc0ee11edbde050ebf62b0b36),
(0x84f74703c0ee11edbde050ebf62b0b36, 'E00004', 'HOUN Darika', 'System Administrator', 'System Administrator', '2023-03-12 22:56:56.948957', '2023-03-12 22:57:40.584412', b'0', 'E00004', 'E00004', NULL, NULL, b'1', NULL, NULL, 0x84f66e67c0ee11edbde050ebf62b0b36),
(0xa0a46432c0ee11edbde050ebf62b0b36, 'E00005', 'LIM Chhily', 'System Administrator', 'System Administrator', '2023-03-12 22:57:43.381982', '2023-03-12 22:58:27.519862', b'0', 'E00005', 'E00005', NULL, NULL, b'1', NULL, NULL, 0xa0a382eac0ee11edbde050ebf62b0b36),
(0xbe8455b5c0ee11edbde050ebf62b0b36, 'E00006', 'MAO Linda', 'System Administrator', 'System Administrator', '2023-03-12 22:58:33.503522', '2023-03-12 22:58:50.610949', b'0', 'E00006', 'E00006', NULL, NULL, b'1', NULL, NULL, 0xbe837f2bc0ee11edbde050ebf62b0b36),
(0xcd65c323c0ee11edbde050ebf62b0b36, 'E00007', 'CHHOM Vannak', 'System Administrator', 'System Administrator', '2023-03-12 22:58:58.468987', '2023-03-12 22:59:21.751050', b'0', 'E00007', 'E00007', NULL, NULL, b'1', NULL, NULL, 0xcd64eb3ec0ee11edbde050ebf62b0b36);

-- --------------------------------------------------------

--
-- Table structure for table `userroledetail`
--

CREATE TABLE `userroledetail` (
  `ObjectID` binary(16) DEFAULT NULL,
  `ObjectNumber` text DEFAULT NULL,
  `ObjectName` text DEFAULT NULL,
  `CreatedBy` text DEFAULT NULL,
  `LastModifiedBy` text DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL,
  `LastModifiedDateTime` datetime(6) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `UserID` binary(16) DEFAULT NULL,
  `RoleModuleID` binary(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userroledetail`
--

INSERT INTO `userroledetail` (`ObjectID`, `ObjectNumber`, `ObjectName`, `CreatedBy`, `LastModifiedBy`, `CreatedDateTime`, `LastModifiedDateTime`, `IsDeleted`, `UserID`, `RoleModuleID`) VALUES
(0x1b58ac7bc0ef11edbde050ebf62b0b36, '', '', 'System Administrator', 'System Administrator', '2023-03-12 23:01:09.245495', '2023-03-12 23:01:11.500358', b'0', 0x17b81787c0ee11edbde050ebf62b0b36, 0x33af5494c0c011ed994850ebf62b0b36);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
