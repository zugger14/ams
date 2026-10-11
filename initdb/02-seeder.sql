-- AMS Database Seeder
-- Run this script to populate the database with dummy data for testing.

USE ams;

-- Disable foreign key checks just in case (though not strictly enforced in current schema)
SET FOREIGN_KEY_CHECKS = 0;

-- Clear existing data (optional, but good for a fresh start)
TRUNCATE TABLE `tbl_appointment`;
TRUNCATE TABLE `tbl_service`;
TRUNCATE TABLE `tbl_notification`;
TRUNCATE TABLE `tbl_dentist`;
TRUNCATE TABLE `tbl_patient`;
TRUNCATE TABLE `tbl_clinic`;
TRUNCATE TABLE `tbl_login_user`;

-- 1. Create default admin user
INSERT INTO `tbl_login_user` (`login_user_id`, `id`, `login_username`, `login_password`, `login_email`, `login_usertype`) VALUES 
(1, NULL, 'admin', 'admin', 'admin@admin.com', 'clinic_operator');

-- 2. Seed Clinics
INSERT INTO `tbl_clinic` (`clinic_id`, `clinic_location`, `clinic_type`) VALUES 
(1, 'Kathmandu City Center', 'General Dentistry'),
(2, 'Lalitpur Branch', 'Orthodontics Specialist');

-- 3. Seed Dentists
INSERT INTO `tbl_dentist` (`dentist_id`, `dentist_name`, `dentist_firstname`, `dentist_lastname`, `dentist_address`, `dentist_contact`, `dentist_email`, `dentist_clinic`) VALUES 
(1, 'Dr. Sarah Smith', 'Sarah', 'Smith', 'Baneshwor, Ktm', '9801234567', 'sarah@dentist.com', 'Kathmandu City Center'),
(2, 'Dr. Ram Sharma', 'Ram', 'Sharma', 'Patan, Lalitpur', '9841234567', 'ram@dentist.com', 'Lalitpur Branch');

-- 4. Seed Patients
INSERT INTO `tbl_patient` (`patient_id`, `patient_firstname`, `patient_lastname`, `patient_address`, `patient_contact`, `patient_email`, `patient_clinic`) VALUES 
(1, 'John', 'Doe', 'Thamel, Ktm', '9812345678', 'john@doe.com', 'Kathmandu City Center'),
(2, 'Jane', 'Doe', 'Pulchowk, Lalitpur', '9823456789', 'jane@doe.com', 'Lalitpur Branch'),
(3, 'Sita', 'Nepali', 'Bhaktapur', '9834567890', 'sita@nepali.com', 'Kathmandu City Center');

-- 5. Seed Patient Login Users (so you don't have to register them manually)
INSERT INTO `tbl_login_user` (`login_user_id`, `id`, `login_username`, `login_password`, `login_email`, `login_usertype`) VALUES 
(2, 1, 'johndoe', 'ssssss', 'john@doe.com', 'patient'),
(3, 2, 'janedoe', 'ssssss', 'jane@doe.com', 'patient'),
(4, 3, 'sitanepali', 'ssssss', 'sita@nepali.com', 'patient');

-- 6. Seed Dentist Login Users
INSERT INTO `tbl_login_user` (`login_user_id`, `id`, `login_username`, `login_password`, `login_email`, `login_usertype`) VALUES 
(5, 1, 'dr_sarah', 'ssssss', 'sarah@dentist.com', 'dentist'),
(6, 2, 'dr_ram', 'ssssss', 'ram@dentist.com', 'dentist');

-- 7. Seed Services
INSERT INTO `tbl_service` (`service_id`, `service_name`, `service_price`, `service_clinic`, `service_startdate`) VALUES 
(1, 'Teeth Cleaning', 1500.00, 'Kathmandu City Center', '2020-01-01'),
(2, 'Root Canal', 5000.00, 'Kathmandu City Center', '2020-01-01'),
(3, 'Braces Consultation', 1000.00, 'Lalitpur Branch', '2021-06-15');

-- 8. Seed Appointments (Dates set in the future so they show up)
INSERT INTO `tbl_appointment` (`appointment_id`, `appointment_made_date`, `appointment_time`, `appointment_date`, `expiry_time`, `patient_id`, `dentist_id`, `clinic_id`, `status`) VALUES 
(1, CURDATE(), '10:00:00', DATE_ADD(CURDATE(), INTERVAL 2 DAY), DATE_ADD(CURDATE(), INTERVAL '2 12' DAY_HOUR), 1, 1, 1, NULL),
(2, CURDATE(), '14:30:00', DATE_ADD(CURDATE(), INTERVAL 3 DAY), DATE_ADD(CURDATE(), INTERVAL '3 16' DAY_HOUR), 2, 2, 2, NULL);

-- 9. Seed Notifications
INSERT INTO `tbl_notification` (`notification_id`, `login_user_id`, `notification_date`, `notification_content`, `notification_viewdate`) VALUES 
(1, 2, NOW(), 'Welcome to Samajcare! Your account has been registered.', NULL),
(2, 5, NOW(), 'You have a new appointment scheduled for next week.', NULL);

SET FOREIGN_KEY_CHECKS = 1;
