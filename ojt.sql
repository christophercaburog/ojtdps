-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2013 at 05:49 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

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
(00028, 'Evaluation of grades', 0, 00003),
(00029, 'MOA', 0, 00003),
(00033, 'Parent''s Permit', 0, 00003),
(00034, 'Practice Teaching Fee ( P1,000)', 0, 00003),
(00035, 'Medical certificate(x-ray)', 0, 00003),
(00036, 'Portfolio Report', 1, 00003),
(00037, 'Narrative Report', 1, 00003),
(00044, 'Moa', 1, 00004),
(00045, 'Major Subjects (passed)', 0, 00004),
(00046, 'Compilation of Cases', 1, 00004),
(00047, 'Completed RLE', 1, 00004),
(00048, 'Diary Report', 1, 00004),
(00049, 'Case Study Presentation', 0, 00004);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `coordinator`
--

INSERT INTO `coordinator` (`coordinator_id`, `fname`, `lname`, `mname`, `username`, `password`, `department_id`, `course_id`, `x`) VALUES
(00001, 'Admin', 'Admin', 'Admin', 'admin', 'admin', 00000, 00000, 1),
(00002, 'Mean', 'Arino', 'Sabio', 'mean', 'mean', 00001, 00001, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

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
(00015, 'BSEntrep', 'Bachelor of Science in Entrepreneurship', 00002);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
(00001, 'OJT Deployment Record Management System', '2013-2014');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
(00019, 00003, 'Company', 'company'),
(00020, 00003, 'Address', 'waddress'),
(00021, 00003, 'Office Head', 'head'),
(00022, 00003, 'Contact', 'wcontact'),
(00023, 00003, 'Email', 'email'),
(00024, 00003, 'Starting Date', 'start'),
(00025, 00003, 'Ending Date', 'end'),
(00026, 00004, 'Company', 'company'),
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
  ADD CONSTRAINT `work_ibfk_2` FOREIGN KEY (`workdata_id`) REFERENCES `workdata` (`workdata_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `work_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workdata`
--
ALTER TABLE `workdata`
  ADD CONSTRAINT `workdata_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE;
