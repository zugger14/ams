CREATE DATABASE IF NOT EXISTS ams;
USE ams;

CREATE TABLE IF NOT EXISTS `tbl_login_user` (
  `login_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `login_username` varchar(255) DEFAULT NULL,
  `login_password` varchar(255) DEFAULT NULL,
  `login_email` varchar(255) DEFAULT NULL,
  `login_usertype` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`login_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `tbl_patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_firstname` varchar(255) DEFAULT NULL,
  `patient_lastname` varchar(255) DEFAULT NULL,
  `patient_address` text DEFAULT NULL,
  `patient_contact` varchar(50) DEFAULT NULL,
  `patient_email` varchar(255) DEFAULT NULL,
  `patient_clinic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `tbl_dentist` (
  `dentist_id` int(11) NOT NULL AUTO_INCREMENT,
  `dentist_name` varchar(255) DEFAULT NULL,
  `dentist_firstname` varchar(255) DEFAULT NULL,
  `dentist_lastname` varchar(255) DEFAULT NULL,
  `dentist_address` text DEFAULT NULL,
  `dentist_contact` varchar(50) DEFAULT NULL,
  `dentist_email` varchar(255) DEFAULT NULL,
  `dentist_clinic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`dentist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `tbl_clinic` (
  `clinic_id` int(11) NOT NULL AUTO_INCREMENT,
  `clinic_location` varchar(255) DEFAULT NULL,
  `clinic_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`clinic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `tbl_service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(255) DEFAULT NULL,
  `service_price` decimal(10,2) DEFAULT NULL,
  `service_clinic` varchar(255) DEFAULT NULL,
  `service_startdate` date DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `tbl_appointment` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_made_date` date DEFAULT NULL,
  `appointment_time` varchar(100) DEFAULT NULL,
  `appointment_date` varchar(100) DEFAULT NULL,
  `expiry_time` datetime DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `dentist_id` int(11) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`appointment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `tbl_notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_user_id` int(11) DEFAULT NULL,
  `notification_date` datetime DEFAULT NULL,
  `notification_content` text DEFAULT NULL,
  `notification_viewdate` datetime DEFAULT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add a default admin user
INSERT INTO `tbl_login_user` (`login_username`, `login_password`, `login_email`, `login_usertype`) VALUES 
('admin', 'admin', 'admin@admin.com', 'clinic_operator');
