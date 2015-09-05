-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2013 at 05:09 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ojt`
--
CREATE DATABASE IF NOT EXISTS `ojt` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ojt`;

-- --------------------------------------------------------

--
-- Table structure for table `checklist`
--

CREATE TABLE IF NOT EXISTS `checklist` (
  `checklist_id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `department_id` int(5) unsigned zerofill NOT NULL,
  PRIMARY KEY (`checklist_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `checklist`
--

INSERT INTO `checklist` (`checklist_id`, `name`, `type`, `department_id`) VALUES
(00001, 'Moa', 1, 00001),
(00002, 'Endorsement Letter', 1, 00001),
(00003, 'Acknowledgement Letter', 1, 00001),
(00004, 'Letter of Acceptance', 1, 00001),
(00005, 'Letter of Application', 1, 00001),
(00006, 'Resume', 1, 00001),
(00007, 'Waiver Form', 1, 00001),
(00008, 'DTR', 0, 00001),
(00009, 'Accomplishment Report', 0, 00001),
(00010, 'Documentation at Work', 0, 00001),
(00011, 'Certificate Of Completion', 0, 00001),
(00012, 'Evaluation Form', 0, 00001),
(00015, 'Moa', 1, 00002),
(00016, 'Endorsement Letter', 1, 00002),
(00017, 'Acknowledgement Letter', 1, 00002),
(00018, 'Letter of Acceptance', 1, 00002),
(00019, 'Letter of Application', 1, 00002),
(00020, 'Resume', 1, 00002),
(00021, 'Waiver Form', 1, 00002),
(00022, 'DTR', 0, 00002),
(00023, 'Accomplishment Report', 0, 00002),
(00024, 'Documentation at Work', 0, 00002),
(00025, 'Certificate of Completion', 0, 00002),
(00026, 'Evaluation Form', 0, 00002),
(00028, 'Evaluation of grades', 1, 00003),
(00029, 'MOA', 1, 00003),
(00033, 'Parent''s Permit', 1, 00003),
(00034, 'Practice Teaching Fee ( P1,000)', 1, 00003),
(00035, 'Medical certificate(x-ray)', 1, 00003),
(00036, 'Portfolio Report', 0, 00003),
(00037, 'Narrative Report', 0, 00003),
(00044, 'Moa', 1, 00004),
(00045, 'Major Subjects (passed)', 0, 00004),
(00046, 'Compilation of Cases', 1, 00004),
(00047, 'Completed RLE', 1, 00004),
(00048, 'Diary Report', 1, 00004),
(00049, 'Case Study Presentation', 0, 00004),
(00050, 'sss', 1, 00001);

-- --------------------------------------------------------

--
-- Table structure for table `coordinator`
--

CREATE TABLE IF NOT EXISTS `coordinator` (
  `coordinator_id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `fname` varchar(32) NOT NULL,
  `lname` varchar(32) NOT NULL,
  `mname` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `department_id` int(5) unsigned zerofill NOT NULL,
  `course_id` int(5) unsigned zerofill NOT NULL,
  `x` int(1) NOT NULL,
  PRIMARY KEY (`coordinator_id`),
  KEY `course_id` (`course_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `coordinator`
--

INSERT INTO `coordinator` (`coordinator_id`, `fname`, `lname`, `mname`, `username`, `password`, `department_id`, `course_id`, `x`) VALUES
(00001, 'Admin', 'Admin', 'Admin', 'admin', 'admin', 00000, 00000, 1),
(00002, 'Mean', 'Arino', 'Sabio', 'mean', 'mean', 00001, 00001, 0),
(00003, 'Zaldy', 'Magnate', 'C. ', 'zaldy', 'zaldy', 00002, 00008, 0),
(00004, 'Jerry', 'Agsunod', 'B. ', 'jerry', 'jerry', 00001, 00003, 0),
(00005, 'Romulus', 'Calloa', 'R.', 'romulus', 'romulus', 00001, 00002, 0),
(00006, 'Bryan', 'MaraÃ‘o', 'F. ', 'bryan', 'bryan', 00002, 00007, 0),
(00007, 'Bernardo', 'Salvante', 'L.', 'bernardo', 'bernardo', 00003, 00011, 0),
(00008, 'Maximo', 'Razal', 'L.', 'razal', 'razal', 00003, 00012, 0),
(00011, 'Sunjay', 'Gandia', 'C.', 'sunjay', 'sunjay', 00002, 00010, 0),
(00012, 'Milagros', 'Belchez', 'O.', 'milagros', 'milagros', 00002, 00014, 0),
(00013, 'Binondo', 'Revidad Jr.', 'G.', 'binondo', 'binondo', 00004, 00013, 0);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `clabel` varchar(32) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `department_id` int(5) unsigned zerofill NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `clabel`, `cname`, `department_id`) VALUES
(00001, 'BSIS', 'BS in Information System', 00001),
(00002, 'BSIT', 'BS in Information Technology', 00001),
(00003, 'BSCS', 'BS in Computer Science', 00001),
(00004, 'BSCpE', 'BS in Computer Engineering', 00001),
(00005, 'BSECE', 'BS in Electronics Engineering', 00001),
(00006, 'BSET', 'BS in Electronics Technology', 00002),
(00007, 'BSELT', 'BS in Electrical Technology', 00002),
(00008, 'BSAT', 'BS in Automotive Technology', 00002),
(00009, 'BSMT', 'BS in Mechanical Technology', 00002),
(00010, 'Entrep', 'BS in Entrepreneurship', 00002),
(00011, 'BEEd', 'Bachelor in Elementary Education', 00003),
(00012, 'BSEd', 'Bachelor in Secondary Education', 00003),
(00013, 'BSN', 'Bachelor of Science in Nursing', 00004),
(00014, 'BSFT', 'Bachelor of Science in Food Technology', 00002),
(00019, 'D', 'U', 00001);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `label` varchar(32) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `name`, `label`) VALUES
(00001, 'Computer and Engineering Studies Department', 'CESD'),
(00002, 'Technology and Entrepreneurship Department', 'TED'),
(00003, 'Teacher Education Department', 'TEdD'),
(00004, 'Nursing and Health Sciences Department', 'NHSD');

-- --------------------------------------------------------

--
-- Table structure for table `isubmit`
--

CREATE TABLE IF NOT EXISTS `isubmit` (
  `isubmit_id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `student_id` int(5) unsigned zerofill NOT NULL,
  `checklist_id` int(5) unsigned zerofill NOT NULL,
  PRIMARY KEY (`isubmit_id`),
  KEY `student_id` (`student_id`),
  KEY `checklist_id` (`checklist_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=266 ;

--
-- Dumping data for table `isubmit`
--

INSERT INTO `isubmit` (`isubmit_id`, `student_id`, `checklist_id`) VALUES
(00010, 00003, 00028),
(00011, 00003, 00029),
(00012, 00003, 00033),
(00013, 00003, 00034),
(00014, 00003, 00035),
(00015, 00004, 00028),
(00016, 00004, 00029),
(00017, 00004, 00033),
(00018, 00004, 00034),
(00019, 00004, 00035),
(00020, 00005, 00028),
(00021, 00005, 00029),
(00022, 00005, 00033),
(00023, 00005, 00034),
(00024, 00005, 00035),
(00025, 00006, 00028),
(00026, 00006, 00029),
(00027, 00006, 00033),
(00028, 00006, 00034),
(00029, 00006, 00035),
(00030, 00007, 00028),
(00031, 00007, 00029),
(00032, 00007, 00033),
(00033, 00007, 00034),
(00034, 00007, 00035),
(00035, 00008, 00028),
(00036, 00008, 00029),
(00037, 00008, 00033),
(00038, 00008, 00034),
(00039, 00008, 00035),
(00040, 00009, 00028),
(00041, 00009, 00029),
(00042, 00009, 00033),
(00043, 00009, 00034),
(00044, 00009, 00035),
(00045, 00010, 00028),
(00046, 00010, 00029),
(00047, 00010, 00033),
(00048, 00010, 00034),
(00049, 00010, 00035),
(00050, 00011, 00028),
(00051, 00011, 00029),
(00052, 00011, 00033),
(00053, 00011, 00034),
(00054, 00011, 00035),
(00056, 00013, 00028),
(00057, 00013, 00029),
(00058, 00013, 00033),
(00059, 00013, 00034),
(00060, 00013, 00035),
(00061, 00014, 00028),
(00062, 00014, 00029),
(00063, 00014, 00033),
(00064, 00014, 00034),
(00065, 00014, 00035),
(00066, 00015, 00028),
(00067, 00015, 00029),
(00068, 00015, 00033),
(00069, 00015, 00034),
(00070, 00015, 00035),
(00071, 00018, 00028),
(00072, 00018, 00029),
(00073, 00018, 00033),
(00074, 00018, 00034),
(00075, 00018, 00035),
(00083, 00030, 00001),
(00084, 00030, 00002),
(00085, 00030, 00003),
(00086, 00030, 00004),
(00087, 00030, 00005),
(00088, 00030, 00006),
(00089, 00030, 00007),
(00090, 00031, 00001),
(00091, 00031, 00002),
(00092, 00031, 00003),
(00093, 00031, 00004),
(00094, 00031, 00005),
(00095, 00031, 00006),
(00096, 00031, 00007),
(00097, 00032, 00001),
(00098, 00032, 00002),
(00099, 00032, 00003),
(00100, 00032, 00004),
(00101, 00032, 00005),
(00102, 00032, 00006),
(00103, 00032, 00007),
(00104, 00033, 00001),
(00105, 00033, 00002),
(00106, 00033, 00003),
(00107, 00033, 00004),
(00108, 00033, 00005),
(00109, 00033, 00006),
(00110, 00033, 00007),
(00111, 00034, 00001),
(00112, 00034, 00002),
(00113, 00034, 00003),
(00114, 00034, 00004),
(00115, 00034, 00005),
(00116, 00034, 00006),
(00117, 00034, 00007),
(00118, 00035, 00001),
(00119, 00035, 00002),
(00120, 00035, 00003),
(00121, 00035, 00004),
(00122, 00035, 00005),
(00123, 00035, 00006),
(00124, 00035, 00007),
(00125, 00036, 00001),
(00126, 00036, 00002),
(00127, 00036, 00003),
(00128, 00036, 00004),
(00129, 00036, 00005),
(00130, 00036, 00006),
(00131, 00036, 00007),
(00132, 00037, 00001),
(00133, 00037, 00002),
(00134, 00037, 00003),
(00135, 00037, 00004),
(00136, 00037, 00005),
(00137, 00037, 00006),
(00138, 00037, 00007),
(00139, 00038, 00001),
(00140, 00038, 00002),
(00141, 00038, 00003),
(00142, 00038, 00004),
(00143, 00038, 00005),
(00144, 00038, 00006),
(00145, 00038, 00007),
(00146, 00039, 00001),
(00147, 00039, 00002),
(00148, 00039, 00003),
(00149, 00039, 00004),
(00150, 00039, 00005),
(00151, 00039, 00006),
(00152, 00039, 00007),
(00153, 00040, 00001),
(00154, 00040, 00002),
(00155, 00040, 00003),
(00156, 00040, 00004),
(00157, 00040, 00005),
(00158, 00040, 00006),
(00159, 00040, 00007),
(00160, 00041, 00002),
(00161, 00041, 00003),
(00162, 00041, 00004),
(00163, 00041, 00005),
(00164, 00041, 00006),
(00165, 00041, 00007),
(00166, 00042, 00001),
(00167, 00042, 00002),
(00168, 00042, 00003),
(00169, 00042, 00004),
(00170, 00042, 00005),
(00171, 00042, 00006),
(00172, 00042, 00007),
(00173, 00043, 00001),
(00174, 00043, 00002),
(00175, 00043, 00003),
(00176, 00043, 00004),
(00177, 00043, 00005),
(00178, 00043, 00006),
(00179, 00043, 00007),
(00180, 00044, 00001),
(00181, 00044, 00002),
(00182, 00044, 00003),
(00183, 00044, 00004),
(00184, 00044, 00005),
(00185, 00044, 00006),
(00186, 00044, 00007),
(00187, 00045, 00001),
(00188, 00045, 00002),
(00189, 00045, 00003),
(00190, 00045, 00004),
(00191, 00045, 00005),
(00192, 00045, 00006),
(00193, 00045, 00007),
(00194, 00046, 00001),
(00195, 00046, 00002),
(00196, 00046, 00003),
(00197, 00046, 00004),
(00198, 00046, 00005),
(00199, 00046, 00006),
(00200, 00046, 00007),
(00201, 00047, 00001),
(00202, 00047, 00002),
(00203, 00047, 00003),
(00204, 00047, 00004),
(00205, 00047, 00005),
(00206, 00047, 00006),
(00207, 00047, 00007),
(00208, 00048, 00001),
(00209, 00048, 00002),
(00210, 00048, 00003),
(00211, 00048, 00004),
(00212, 00048, 00005),
(00213, 00048, 00006),
(00214, 00048, 00007),
(00215, 00049, 00001),
(00216, 00049, 00002),
(00217, 00049, 00003),
(00218, 00049, 00004),
(00219, 00049, 00005),
(00220, 00049, 00006),
(00221, 00049, 00007),
(00222, 00050, 00001),
(00223, 00050, 00002),
(00224, 00050, 00003),
(00225, 00050, 00004),
(00226, 00050, 00005),
(00227, 00050, 00006),
(00228, 00050, 00007),
(00229, 00020, 00028),
(00230, 00020, 00029),
(00231, 00020, 00033),
(00232, 00020, 00034),
(00233, 00020, 00035),
(00238, 00054, 00015),
(00239, 00054, 00016),
(00240, 00054, 00017),
(00241, 00054, 00018),
(00242, 00054, 00019),
(00243, 00054, 00020),
(00244, 00054, 00021),
(00245, 00055, 00001),
(00246, 00055, 00002),
(00247, 00055, 00003),
(00248, 00055, 00004),
(00249, 00055, 00005),
(00250, 00056, 00001),
(00251, 00056, 00002),
(00252, 00056, 00003),
(00253, 00056, 00004),
(00254, 00056, 00005),
(00255, 00056, 00006),
(00256, 00056, 00007),
(00257, 00055, 00006),
(00258, 00055, 00007),
(00259, 00055, 00008),
(00260, 00055, 00009),
(00261, 00055, 00010),
(00262, 00055, 00011),
(00263, 00055, 00012),
(00264, 00058, 00005),
(00265, 00041, 00001);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `year` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `year`) VALUES
(00001, 'Student Deployment Record Management System', '2013-2014');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `sID` varchar(8) NOT NULL,
  `fname` varchar(32) NOT NULL,
  `mname` varchar(32) NOT NULL,
  `lname` varchar(32) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `dob` varchar(32) NOT NULL,
  `contact` varchar(32) NOT NULL,
  `course_id` int(5) unsigned zerofill NOT NULL,
  `year` varchar(1) NOT NULL,
  `block` varchar(1) NOT NULL,
  `date` varchar(32) NOT NULL,
  `sy` varchar(10) NOT NULL,
  `dir` varchar(100) NOT NULL,
  `coordinator` varchar(100) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `sID`, `fname`, `mname`, `lname`, `address`, `gender`, `dob`, `contact`, `course_id`, `year`, `block`, `date`, `sy`, `dir`, `coordinator`) VALUES
(00003, '0', 'Angelie', 'B. ', 'Rutobio', '', 0, '11/23/2013', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'Angelie_B._Rutobio', 'Bernardo L. Salvante'),
(00004, '0', 'Raquel', 'E.', 'CaÃ±ada', '', 0, '', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'Raquel_E._CaÃ±ada', 'Bernardo L. Salvante'),
(00005, '0', 'Marve', 'T.', 'Del Castillo', '', 0, '', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'Marve_T._Del_Castillo', 'Bernardo L. Salvante'),
(00006, '0', 'Rhea', 'N.', 'Monteveros', '', 0, '', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'Rhea_N._Monteveros', 'Bernardo L. Salvante'),
(00007, '0', 'Jane', 'A.', 'Paraiso', '', 0, '', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'Jane_A._Paraiso', 'Bernardo L. Salvante'),
(00008, '0', 'April', 'O.', 'Salmon', '', 0, '', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'April_O._Salmon', 'Bernardo L. Salvante'),
(00009, '0', 'Rosario', 'T.', 'Abila', '', 0, '', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'Rosario_T._Abila', 'Bernardo L. Salvante'),
(00010, '0', 'Jenielen', 'M.', 'Sanares', '', 0, '', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'Jenielen_M._Sanares', 'Bernardo L. Salvante'),
(00011, '0', 'Emilie May', 'S.', 'Llaneta', '', 0, '', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'Emilie_May_S._Llaneta', 'Bernardo L. Salvante'),
(00012, '0', 'Mavelyn', 'A.', 'Fajardo', '', 0, '11/02/1993', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'Mavelyn_A._Fajardo', 'Bernardo L. Salvante'),
(00013, '0', 'Sarah Jane', 'R.', 'Sabio', '', 0, '', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'Sarah_Jane_R._Sabio', 'Bernardo L. Salvante'),
(00014, '0', 'Carlo Jay', 'M.', 'Oliva', '', 1, '', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'Carlo_Jay_M._Oliva', 'Bernardo L. Salvante'),
(00015, '0', 'Jozime', 'V.', 'Mora', '', 1, '', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'Jozime_V._Mora', 'Bernardo L. Salvante'),
(00016, '0', 'Alvin', 'B.', 'Roncesvalles', '', 1, '11/19/1994', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'Alvin_B._Roncesvalles', 'Bernardo L. Salvante'),
(00017, '0', 'John Rey', 'S.', 'Bonganay', '', 1, '11/11/1994', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'John_Rey_S._Bonganay', 'Bernardo L. Salvante'),
(00018, '0', 'Anloe', 'M.', 'Llamares', '', 0, '11/18/1993', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'Anloe_M._Llamares', 'Bernardo L. Salvante'),
(00019, '0', 'Jorelyn', 'B.', 'Refereza', '', 0, '11/10/1994', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'Jorelyn_B._Refereza', 'Bernardo L. Salvante'),
(00020, '0', 'Sarah Mae', 'C.', 'Sergio', '', 0, '09/16/1993', '', 00011, '4', 'A', '11/23/2013', '2013-2014', 'Sarah_Mae_C._Sergio', 'Bernardo L. Salvante'),
(00026, '0', 'Lyka', 'V.', 'Baria', 'Gabon, Polangui, Albay', 0, '05/14/1994', '', 00001, '4', 'A', '11/23/2013', '2013-2014', 'Lyka_V._Baria', 'Mean Sabio Arino'),
(00027, '0', 'Baby Jean', 'B.', 'Velasco', 'Ubaliiw, Polangui, Albay', 0, '09/30/1991', '', 00001, '4', 'A', '11/23/2013', '2013-2014', 'Baby_Jean_B._Velasco', 'Mean Sabio Arino'),
(00028, '0', 'Crisanta', 'B. ', 'Bobis', 'San Ramon, Oas Albay', 0, '03/30/1993', '', 00001, '4', 'A', '11/23/2013', '2013-2014', 'Crisanta_B._Bobis', 'Mean Sabio Arino'),
(00030, '0', 'Fausthine  Anne ', 'F.', 'Maritana', '', 0, '', '', 00003, '4', 'A', '11/23/2013', '2013-2014', 'Fausthine_Anne_F._Maritana', 'Jerry B.  Agsunod'),
(00031, '0', 'Shierlene ', 'B. ', 'Dela PeÃ±a', '', 0, '', '', 00003, '4', 'A', '11/23/2013', '2013-2014', 'Shierlene_B._Dela_PeÃ±a', 'Jerry B.  Agsunod'),
(00032, '0', 'Ma. Jonalyn ', 'T.', ' Carreon', '', 0, '', '', 00003, '4', 'A', '11/23/2013', '2013-2014', 'Ma._Jonalyn_T._Carreon', 'Jerry B.  Agsunod'),
(00033, '0', 'Andrew ', 'P.', 'CaÃ±averal', '', 1, '', '', 00003, '4', 'A', '11/23/2013', '2013-2014', 'Andrew_P._CaÃ±averal', 'Jerry B.  Agsunod'),
(00034, '0', 'Angeline ', 'D.', 'Padre', '', 0, '', '', 00003, '4', 'A', '11/23/2013', '2013-2014', 'Angeline_D._Padre', 'Jerry B.  Agsunod'),
(00035, '0', 'Raynald ', 'B. ', 'Ronda', '', 1, '', '', 00003, '4', 'A', '11/23/2013', '2013-2014', 'Raynald_B._Ronda', 'Jerry B.  Agsunod'),
(00036, '0', 'Jean ', 'A.', 'Barce', '', 0, '', '', 00003, '4', 'A', '11/23/2013', '2013-2014', 'Jean_A._Barce', 'Jerry B.  Agsunod'),
(00037, '0', 'Gilda', 'E.', 'Rimbao', '', 0, '', '', 00003, '4', 'A', '11/24/2013', '2013-2014', 'Gilda_E._Rimbao', 'Jerry B.  Agsunod'),
(00038, '0', 'Ramil', '', 'Sarion', '', 1, '', '', 00003, '4', 'A', '11/24/2013', '2013-2014', 'Ramil_Sarion', 'Jerry B.  Agsunod'),
(00039, '0', 'Reymar', '', 'Baria', '', 1, '', '', 00003, '4', 'A', '11/24/2013', '2013-2014', 'Reymar_Baria', 'Jerry B.  Agsunod'),
(00040, '0', 'Michael John', '', 'Sabucor', '', 1, '', '', 00003, '4', 'A', '11/24/2013', '2013-2014', 'Michael_John_Sabucor', 'Jerry B.  Agsunod'),
(00041, '0', 'Jahlmar', '', 'Freza', '', 1, '', '', 00003, '4', 'A', '11/24/2013', '2013-2014', 'Jahlmar_Freza', 'Jerry B.  Agsunod'),
(00042, '0', 'Myra', 'B. ', 'Ortega', '', 0, '', '', 00003, '4', 'A', '11/24/2013', '2013-2014', 'Myra_B._Ortega', 'Jerry B.  Agsunod'),
(00043, '0', 'Ricardo', 'S.', 'Saculsan', '', 1, '', '', 00003, '4', 'A', '11/24/2013', '2013-2014', 'Ricardo_S._Saculsan', 'Jerry B.  Agsunod'),
(00044, '0', 'Rhodalyn', 'B.', 'Retumban', '', 0, '', '', 00003, '4', 'A', '11/24/2013', '2013-2014', 'Rhodalyn_B._Retumban', 'Jerry B.  Agsunod'),
(00045, '0', 'Jennyvie', 'S.', 'Llona', '', 0, '', '', 00003, '4', 'A', '11/24/2013', '2013-2014', 'Jennyvie_S._Llona', 'Jerry B.  Agsunod'),
(00046, '0', 'Hazel', 'G.', 'Lozada', '', 0, '', '', 00003, '4', 'A', '11/24/2013', '2013-2014', 'Hazel_G._Lozada', 'Jerry B.  Agsunod'),
(00047, '0', 'Maureen', 'M.', 'Saclag', '', 0, '', '+778-678-678-678', 00003, '4', 'A', '11/24/2013', '2013-2014', 'Maureen_M._Saclag', 'Jerry B.  Agsunod'),
(00048, '0', 'Analisa', 'B. ', 'Ricarte', '', 0, '', '', 00003, '4', 'A', '11/24/2013', '2013-2014', 'Analisa_B._Ricarte', 'Jerry B.  Agsunod'),
(00049, '0', 'Cludeth', 'C. ', 'Coper', '', 0, '', '', 00003, '4', 'A', '11/24/2013', '2013-2014', 'Cludeth_C._Coper', 'Jerry B.  Agsunod'),
(00050, '0', 'Sherry', 'S.', 'Monasterial', '', 0, '', '', 00003, '4', 'A', '11/24/2013', '2013-2014', 'Sherry_S._Monasterial', 'Jerry B.  Agsunod'),
(00051, '0', 'Criza Mae', 'C.', 'Ravago', 'Oas, Albay', 0, '06/03/1994', '', 00001, '4', 'A', '11/24/2013', '2013-2014', 'Criza_Mae_C._Ravago', 'Mean Sabio Arino'),
(00052, '0', 'Aa', '', '', '', 1, '', '', 00007, '4', 'A', '11/24/2013', '2013-2014', 'Aa_', 'Bryan F.  MaraÃ‘o'),
(00054, '0', 'Maruja', 'E.', 'Rinon', 'Bagumbayan Oas, Albay', 0, '', '', 00014, '4', 'A', '11/24/2013', '2013-2014', 'Maruja_E._Rinon', 'Milagros O. Belchez'),
(00055, '0', 'Aiza', 'Bocaya', 'Relleve', 'Pinagdapugan', 0, '10/10/1993', '09099023340', 00001, '4', 'A', '11/24/2013', '2013-2014', 'Aiza_Bocaya_Relleve', 'Mean Sabio Arino'),
(00056, '0', 'Rose', 'Cosa', 'Gue', 'Polangui, Albay', 0, '09/24/1993', '09105552849', 00001, '4', 'A', '11/01/2014', '2014-2015', 'Rose_Cosa_Gue', 'Mean Sabio Arino'),
(00058, '0', 'Jenny', 'Ako', 'Ika', 'Asd Fg', 0, '12/09/1993', '+098-765-443-211', 00003, '4', 'A', '12/10/2013', '2013-2014', 'Jenny_Ako_Ika', 'Jerry B.  Agsunod'),
(00060, '-11-1111', 'Qqqqq', 'Qqq', 'Qqqq', 'Qqqq', 1, '12/01/2013', '+798-787-987-897', 00003, '4', 'A', '12/12/2013', '2013-2014', 'Qqqqq_Qqq_Qqqq', 'Jerry B.  Agsunod'),
(00068, '-88-9789', 'H', 'L', 'L', 'N', 1, '12/13/2013', '+999-999-999-999', 00003, '4', 'A', '12/14/2013', '2013-2014', 'H_L_L', 'Jerry B.  Agsunod'),
(00069, '-68-6876', 'G', 'G', 'G', 'Hgjh', 1, '12/02/2013', '+879-897-979-798', 00013, '4', 'A', '12/20/2013', '2013-2014', 'G_G_G', 'Binondo G. Revidad Jr.');

-- --------------------------------------------------------

--
-- Table structure for table `submit`
--

CREATE TABLE IF NOT EXISTS `submit` (
  `submit_id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `student_id` int(5) unsigned zerofill NOT NULL,
  `checklist_id` int(5) unsigned zerofill NOT NULL,
  `file` varchar(100) NOT NULL,
  `date` varchar(32) NOT NULL,
  PRIMARY KEY (`submit_id`),
  KEY `checklist_id` (`checklist_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE IF NOT EXISTS `work` (
  `work_id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `student_id` int(5) unsigned zerofill NOT NULL,
  `workdata_id` int(5) unsigned zerofill NOT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`work_id`),
  KEY `student_id` (`student_id`),
  KEY `workdata_id` (`workdata_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=484 ;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`work_id`, `student_id`, `workdata_id`, `value`) VALUES
(00015, 00003, 00019, 'Polangui South Central Elementary School'),
(00016, 00003, 00020, 'Polangui, Albay'),
(00017, 00003, 00021, ''),
(00018, 00003, 00022, ''),
(00019, 00003, 00023, ''),
(00020, 00003, 00024, '11/13/2013'),
(00021, 00003, 00025, ''),
(00022, 00004, 00019, 'Polangui South Central Elementary School'),
(00023, 00004, 00020, 'Polangui, Albay'),
(00024, 00004, 00021, ''),
(00025, 00004, 00022, ''),
(00026, 00004, 00023, ''),
(00027, 00004, 00024, '11/13/2013'),
(00028, 00004, 00025, ''),
(00029, 00005, 00019, 'Polangui South Central Elementary School'),
(00030, 00005, 00020, 'Polangui, Albay'),
(00031, 00005, 00021, ''),
(00032, 00005, 00022, ''),
(00033, 00005, 00023, ''),
(00034, 00005, 00024, '11/13/2013'),
(00035, 00005, 00025, ''),
(00036, 00006, 00019, 'Polangui South Central Elementary School'),
(00037, 00006, 00020, 'Polangui, Albay'),
(00038, 00006, 00021, ''),
(00039, 00006, 00022, ''),
(00040, 00006, 00023, ''),
(00041, 00006, 00024, '11/13/2013'),
(00042, 00006, 00025, ''),
(00043, 00007, 00019, 'Polangui South Central Elementary School'),
(00044, 00007, 00020, 'Polangui, Albay'),
(00045, 00007, 00021, ''),
(00046, 00007, 00022, ''),
(00047, 00007, 00023, ''),
(00048, 00007, 00024, '11/11/2013'),
(00049, 00007, 00025, '02/27/2014'),
(00050, 00008, 00019, 'Polangui South Central Elementary School'),
(00051, 00008, 00020, 'Polangui, Albay'),
(00052, 00008, 00021, ''),
(00053, 00008, 00022, ''),
(00054, 00008, 00023, ''),
(00055, 00008, 00024, '11/11/2013'),
(00056, 00008, 00025, '02/27/2014'),
(00057, 00009, 00019, 'Polangui South Central Elementary School'),
(00058, 00009, 00020, 'Polangui, Albay'),
(00059, 00009, 00021, ''),
(00060, 00009, 00022, ''),
(00061, 00009, 00023, ''),
(00062, 00009, 00024, '11/11/2013'),
(00063, 00009, 00025, '02/27/2014'),
(00064, 00010, 00019, 'Polangui South Central Elementary School'),
(00065, 00010, 00020, 'Polangui, Albay'),
(00066, 00010, 00021, ''),
(00067, 00010, 00022, ''),
(00068, 00010, 00023, ''),
(00069, 00010, 00024, '11/11/2013'),
(00070, 00010, 00025, '02/27/2014'),
(00071, 00011, 00019, 'Polangui South Central Elementary School'),
(00072, 00011, 00020, 'Polangui, Albay'),
(00073, 00011, 00021, ''),
(00074, 00011, 00022, ''),
(00075, 00011, 00023, ''),
(00076, 00011, 00024, '11/11/2013'),
(00077, 00011, 00025, '02/27/2014'),
(00078, 00012, 00019, 'Polangui South  Central Elementary  School'),
(00079, 00012, 00020, 'Polangui, Albay'),
(00080, 00012, 00021, ''),
(00081, 00012, 00022, ''),
(00082, 00012, 00023, ''),
(00083, 00012, 00024, '11/11/2013'),
(00084, 00012, 00025, '02/27/2014'),
(00085, 00013, 00019, 'Polangui South Central ElementarySchool'),
(00086, 00013, 00020, 'Polangui, Albay'),
(00087, 00013, 00021, ''),
(00088, 00013, 00022, ''),
(00089, 00013, 00023, ''),
(00090, 00013, 00024, '11/11/2013'),
(00091, 00013, 00025, '02/27/2014'),
(00092, 00014, 00019, 'Polangui South Central ElementarySchool'),
(00093, 00014, 00020, 'Polangui, Albay'),
(00094, 00014, 00021, ''),
(00095, 00014, 00022, ''),
(00096, 00014, 00023, ''),
(00097, 00014, 00024, '11/11/2013'),
(00098, 00014, 00025, '02/27/2014'),
(00099, 00015, 00019, 'Polangui South Central Elementary School'),
(00100, 00015, 00020, 'Polangui, Albay'),
(00101, 00015, 00021, ''),
(00102, 00015, 00022, ''),
(00103, 00015, 00023, ''),
(00104, 00015, 00024, '11/11/2013'),
(00105, 00015, 00025, '02/27/2014'),
(00106, 00016, 00019, 'Polangui South Central Elementary School'),
(00107, 00016, 00020, 'Polangui, Albay'),
(00108, 00016, 00021, ''),
(00109, 00016, 00022, ''),
(00110, 00016, 00023, ''),
(00111, 00016, 00024, '11/11/2013'),
(00112, 00016, 00025, '02/27/2014'),
(00113, 00017, 00019, 'Polangui South Central Elementary School'),
(00114, 00017, 00020, 'Polangui, Albay'),
(00115, 00017, 00021, ''),
(00116, 00017, 00022, ''),
(00117, 00017, 00023, ''),
(00118, 00017, 00024, '11/11/13'),
(00119, 00017, 00025, '02/27/14'),
(00120, 00018, 00019, 'Libon East Central Elementary School'),
(00121, 00018, 00020, 'Libon, Albay'),
(00122, 00018, 00021, ''),
(00123, 00018, 00022, ''),
(00124, 00018, 00023, ''),
(00125, 00018, 00024, '11/1/2013'),
(00126, 00018, 00025, '02/27/2014'),
(00127, 00019, 00019, 'Libon East Central Elementary School'),
(00128, 00019, 00020, 'Libon, Albay'),
(00129, 00019, 00021, ''),
(00130, 00019, 00022, ''),
(00131, 00019, 00023, ''),
(00132, 00019, 00024, '11/11/2013'),
(00133, 00019, 00025, '02/27/2014'),
(00134, 00020, 00019, 'LIBON EAST CENTRAL ELEMENTARY SCHOOL'),
(00135, 00020, 00020, 'LIBON, ALBAY'),
(00136, 00020, 00021, ''),
(00137, 00020, 00022, ''),
(00138, 00020, 00023, ''),
(00139, 00020, 00024, '11/11/13'),
(00140, 00020, 00025, '02/27/14'),
(00176, 00026, 00001, 'Csac-bupc'),
(00177, 00026, 00002, 'Polangui, Albay'),
(00178, 00026, 00003, 'Mam Obiles'),
(00179, 00026, 00004, ''),
(00180, 00026, 00005, ''),
(00181, 00026, 00006, '11/20/2013'),
(00182, 00026, 00007, '11/23/2013'),
(00183, 00027, 00001, 'Cesd- Bupc'),
(00184, 00027, 00002, 'Polangui, Albay'),
(00185, 00027, 00003, 'Joseph Carinan'),
(00186, 00027, 00004, ''),
(00187, 00027, 00005, ''),
(00188, 00027, 00006, '11/18/2013'),
(00189, 00027, 00007, ''),
(00190, 00028, 00001, 'TED-BUPC'),
(00191, 00028, 00002, 'Polangui, Albay'),
(00192, 00028, 00003, 'EDEN M. LLAMERA'),
(00193, 00028, 00004, ''),
(00194, 00028, 00005, ''),
(00195, 00028, 00006, '11/20/2013'),
(00196, 00028, 00007, ''),
(00204, 00030, 00001, 'GOVERNMENT SERVICE INSURANCE SYSTEM (GSIS)'),
(00205, 00030, 00002, 'Legazpi, City'),
(00206, 00030, 00003, ''),
(00207, 00030, 00004, ''),
(00208, 00030, 00005, ''),
(00209, 00030, 00006, 'April 16, 2013 '),
(00210, 00030, 00007, 'May 29, 2013'),
(00211, 00031, 00001, 'GOVERNMENT SERVICE INSURANCE SYSTEM (GSIS)'),
(00212, 00031, 00002, 'Legazpi, City'),
(00213, 00031, 00003, ''),
(00214, 00031, 00004, ''),
(00215, 00031, 00005, ''),
(00216, 00031, 00006, 'April 16, 2013 '),
(00217, 00031, 00007, 'May 29, 2013'),
(00218, 00032, 00001, 'GOVERNMENT SERVICE INSURANCE SYSTEM (GSIS)'),
(00219, 00032, 00002, 'Legazpi, City'),
(00220, 00032, 00003, ''),
(00221, 00032, 00004, ''),
(00222, 00032, 00005, ''),
(00223, 00032, 00006, 'April 16, 2013 '),
(00224, 00032, 00007, 'May 29, 2013'),
(00225, 00033, 00001, 'GOVERNMENT SERVICE INSURANCE SYSTEM (GSIS)'),
(00226, 00033, 00002, 'Legazpi, City'),
(00227, 00033, 00003, ''),
(00228, 00033, 00004, ''),
(00229, 00033, 00005, ''),
(00230, 00033, 00006, 'April 16, 2013 '),
(00231, 00033, 00007, 'May 29, 2013'),
(00232, 00034, 00001, 'GOVERNMENT SERVICE INSURANCE SYSTEM (GSIS)'),
(00233, 00034, 00002, 'Legazpi, City'),
(00234, 00034, 00003, ''),
(00235, 00034, 00004, ''),
(00236, 00034, 00005, ''),
(00237, 00034, 00006, 'April 16, 2013 '),
(00238, 00034, 00007, 'May 29, 2013'),
(00239, 00035, 00001, 'GOVERNMENT SERVICE INSURANCE SYSTEM (GSIS)'),
(00240, 00035, 00002, 'Legazpi, City'),
(00241, 00035, 00003, ''),
(00242, 00035, 00004, ''),
(00243, 00035, 00005, ''),
(00244, 00035, 00006, 'April 16, 2013 '),
(00245, 00035, 00007, 'May 29, 2013'),
(00246, 00036, 00001, 'GOVERNMENT SERVICE INSURANCE SYSTEM (GSIS)'),
(00247, 00036, 00002, 'Legazpi, City'),
(00248, 00036, 00003, ''),
(00249, 00036, 00004, ''),
(00250, 00036, 00005, ''),
(00251, 00036, 00006, 'April 16, 2013 '),
(00252, 00036, 00007, 'May 29, 2013'),
(00253, 00037, 00001, 'University of the Phils. Information Technology Development Center (UPITDC)'),
(00254, 00037, 00002, 'UP Diliman, Q.C.'),
(00255, 00037, 00003, ''),
(00256, 00037, 00004, ''),
(00257, 00037, 00005, ''),
(00258, 00037, 00006, 'April 16, 2013'),
(00259, 00037, 00007, 'May 29, 2013'),
(00260, 00038, 00001, 'National Statistic Office (NSO)'),
(00261, 00038, 00002, 'Legazpi City'),
(00262, 00038, 00003, ''),
(00263, 00038, 00004, ''),
(00264, 00038, 00005, ''),
(00265, 00038, 00006, 'April 16, 2013'),
(00266, 00038, 00007, 'May 29, 2013'),
(00267, 00039, 00001, 'National Statistics Office (NSO)'),
(00268, 00039, 00002, 'Legazpi, Albay'),
(00269, 00039, 00003, ''),
(00270, 00039, 00004, ''),
(00271, 00039, 00005, ''),
(00272, 00039, 00006, 'April 16, 2013 '),
(00273, 00039, 00007, 'May 29, 2013'),
(00274, 00040, 00001, 'NATIONAL STATISTICS OFFICE (NSO) '),
(00275, 00040, 00002, 'Legazpi City'),
(00276, 00040, 00003, ''),
(00277, 00040, 00004, ''),
(00278, 00040, 00005, ''),
(00279, 00040, 00006, 'April 16, 2013 '),
(00280, 00040, 00007, 'May 29, 2013'),
(00281, 00041, 00001, 'NATIONAL STATISTICS OFFICE (NSO) '),
(00282, 00041, 00002, 'Legazpi City'),
(00283, 00041, 00003, ''),
(00284, 00041, 00004, ''),
(00285, 00041, 00005, ''),
(00286, 00041, 00006, 'April 16, 2013 '),
(00287, 00041, 00007, 'May 29, 2013'),
(00288, 00042, 00001, 'PAGASA WEATHER BUREAU, Airport Site'),
(00289, 00042, 00002, 'Legazpi City'),
(00290, 00042, 00003, ''),
(00291, 00042, 00004, ''),
(00292, 00042, 00005, ''),
(00293, 00042, 00006, 'April 16, 2013 '),
(00294, 00042, 00007, 'May 29, 2013'),
(00295, 00043, 00001, 'PAGASA WEATHER BUREAU, Airport Site, '),
(00296, 00043, 00002, 'Legazpi City'),
(00297, 00043, 00003, ''),
(00298, 00043, 00004, ''),
(00299, 00043, 00005, ''),
(00300, 00043, 00006, 'April 16, 2013 '),
(00301, 00043, 00007, 'May 29, 2013'),
(00302, 00044, 00001, 'PAGASA WEATHER BUREAU, Airport Site, '),
(00303, 00044, 00002, 'Legazpi City'),
(00304, 00044, 00003, ''),
(00305, 00044, 00004, ''),
(00306, 00044, 00005, ''),
(00307, 00044, 00006, 'April 16, 2013 '),
(00308, 00044, 00007, 'May 29, 2013  '),
(00309, 00045, 00001, 'PAGASA WEATHER BUREAU, Airport Site'),
(00310, 00045, 00002, 'Legazpi City'),
(00311, 00045, 00003, ''),
(00312, 00045, 00004, ''),
(00313, 00045, 00005, ''),
(00314, 00045, 00006, 'April 16, 2013 '),
(00315, 00045, 00007, 'May 29, 2013'),
(00316, 00046, 00001, 'DEPARTMENT OF BUDGET AND MANAGEMENT (DBM) '),
(00317, 00046, 00002, 'Legazpi City'),
(00318, 00046, 00003, ''),
(00319, 00046, 00004, ''),
(00320, 00046, 00005, ''),
(00321, 00046, 00006, 'April 16, 2013 '),
(00322, 00046, 00007, 'May 29, 2013'),
(00323, 00047, 00001, 'DEPARTMENT OF BUDGET AND MANAGEMENT (DBM) '),
(00324, 00047, 00002, 'Legazpi City'),
(00325, 00047, 00003, ''),
(00326, 00047, 00004, ''),
(00327, 00047, 00005, ''),
(00328, 00047, 00006, 'April 16, 2013 '),
(00329, 00047, 00007, 'May 29, 2013'),
(00330, 00048, 00001, 'DEPARTMENT OF JUSTICE '),
(00331, 00048, 00002, 'HALL OF JUSTICE TABACO CITY'),
(00332, 00048, 00003, ''),
(00333, 00048, 00004, ''),
(00334, 00048, 00005, ''),
(00335, 00048, 00006, 'April 16, 2013'),
(00336, 00048, 00007, 'May 29, 2013'),
(00337, 00049, 00001, ''),
(00338, 00049, 00002, ''),
(00339, 00049, 00003, ''),
(00340, 00049, 00004, ''),
(00341, 00049, 00005, ''),
(00342, 00049, 00006, 'April 16, 2013 '),
(00343, 00049, 00007, 'May 29, 2013'),
(00344, 00050, 00001, 'EMBARCADERO DE LEGAZPI'),
(00345, 00050, 00002, 'Legazpi City'),
(00346, 00050, 00003, ''),
(00347, 00050, 00004, ''),
(00348, 00050, 00005, ''),
(00349, 00050, 00006, 'April 16, 2013 '),
(00350, 00050, 00007, 'May 29, 2013'),
(00351, 00051, 00001, 'BUPC-REGISTRAR'),
(00352, 00051, 00002, 'Polangui, Albay'),
(00353, 00051, 00003, 'VERONICA O. GOMEZ'),
(00354, 00051, 00004, ''),
(00355, 00051, 00005, ''),
(00356, 00051, 00006, '11/20/2013'),
(00357, 00051, 00007, ''),
(00358, 00052, 00012, 'aaa'),
(00359, 00052, 00013, ''),
(00360, 00052, 00014, ''),
(00361, 00052, 00015, ''),
(00362, 00052, 00016, ''),
(00363, 00052, 00017, ''),
(00364, 00052, 00018, ''),
(00372, 00054, 00012, 'Jinks Resto'),
(00373, 00054, 00013, ''),
(00374, 00054, 00014, ''),
(00375, 00054, 00015, ''),
(00376, 00054, 00016, ''),
(00377, 00054, 00017, '11/13/2013'),
(00378, 00054, 00018, '02/27/2014'),
(00379, 00055, 00001, 'Nso'),
(00380, 00055, 00002, 'legazpi'),
(00381, 00055, 00003, 'elly abreta'),
(00382, 00055, 00004, '09476065215'),
(00383, 00055, 00005, 'ellyabreta@yahoo.com'),
(00384, 00055, 00006, '11/20/2013'),
(00385, 00055, 00007, '02/28/2014'),
(00386, 00056, 00001, 'nso'),
(00387, 00056, 00002, 'legazpi, albay'),
(00388, 00056, 00003, 'cexil'),
(00389, 00056, 00004, '09476065142'),
(00390, 00056, 00005, 'cecil@yahoo.com'),
(00391, 00056, 00006, '11/20/2014'),
(00392, 00056, 00007, '02/28/2015'),
(00400, 00058, 00001, 'ibm'),
(00401, 00058, 00002, 'naga'),
(00402, 00058, 00003, 'naga'),
(00403, 00058, 00004, '+907-643-267-899'),
(00404, 00058, 00005, 'ghygd'),
(00405, 00058, 00006, '16/12/2013'),
(00406, 00058, 00007, '26/12/2013'),
(00414, 00060, 00001, ''),
(00415, 00060, 00002, ''),
(00416, 00060, 00003, ''),
(00417, 00060, 00004, ''),
(00418, 00060, 00005, ''),
(00419, 00060, 00006, ''),
(00420, 00060, 00007, ''),
(00470, 00068, 00001, ''),
(00471, 00068, 00002, ''),
(00472, 00068, 00003, ''),
(00473, 00068, 00004, ''),
(00474, 00068, 00005, 'h@uas.com'),
(00475, 00068, 00006, ''),
(00476, 00068, 00007, ''),
(00477, 00069, 00026, 'mamamamaa'),
(00478, 00069, 00027, 'asdgjhg'),
(00479, 00069, 00028, 'hjagdjhgjh'),
(00480, 00069, 00029, '+768-768-768-768'),
(00481, 00069, 00030, 'ahsdghjgh@yahoo.com'),
(00482, 00069, 00031, '24/12/2013'),
(00483, 00069, 00032, '28/12/2013');

-- --------------------------------------------------------

--
-- Table structure for table `workdata`
--

CREATE TABLE IF NOT EXISTS `workdata` (
  `workdata_id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `department_id` int(5) unsigned zerofill NOT NULL,
  `label` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`workdata_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `workdata`
--

INSERT INTO `workdata` (`workdata_id`, `department_id`, `label`, `name`) VALUES
(00001, 00001, 'Company', 'company'),
(00002, 00001, 'Address', 'waddress'),
(00003, 00001, 'Office Head', 'head'),
(00004, 00001, 'Contact', 'wcontact'),
(00005, 00001, 'Email', 'email'),
(00006, 00001, 'Starting Date', 'start'),
(00007, 00001, 'Ending Date', 'end'),
(00012, 00002, 'Company', 'company'),
(00013, 00002, 'Address', 'waddress'),
(00014, 00002, 'Office Head', 'head'),
(00015, 00002, 'Contact', 'wcontact'),
(00016, 00002, 'Email', 'email'),
(00017, 00002, 'Starting Date', 'start'),
(00018, 00002, 'Ending Date', 'end'),
(00019, 00003, 'School', 'school'),
(00020, 00003, 'Address', 'waddress'),
(00021, 00003, 'Office Head', 'head'),
(00022, 00003, 'Contact', 'wcontact'),
(00023, 00003, 'Email', 'email'),
(00024, 00003, 'Starting Date', 'start'),
(00025, 00003, 'Ending Date', 'end'),
(00026, 00004, 'Hospital', 'hospital'),
(00027, 00004, 'Address', 'waddress'),
(00028, 00004, 'Office Head', 'head'),
(00029, 00004, 'Contact', 'wcontact'),
(00030, 00004, 'Email', 'email'),
(00031, 00004, 'Starting Date', 'start'),
(00032, 00004, 'Ending Date', 'end');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checklist`
--
ALTER TABLE `checklist`
  ADD CONSTRAINT `checklist_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `isubmit`
--
ALTER TABLE `isubmit`
  ADD CONSTRAINT `isubmit_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `isubmit_ibfk_2` FOREIGN KEY (`checklist_id`) REFERENCES `checklist` (`checklist_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submit`
--
ALTER TABLE `submit`
  ADD CONSTRAINT `submit_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `submit_ibfk_2` FOREIGN KEY (`checklist_id`) REFERENCES `checklist` (`checklist_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work`
--
ALTER TABLE `work`
  ADD CONSTRAINT `work_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `work_ibfk_2` FOREIGN KEY (`workdata_id`) REFERENCES `workdata` (`workdata_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workdata`
--
ALTER TABLE `workdata`
  ADD CONSTRAINT `workdata_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
