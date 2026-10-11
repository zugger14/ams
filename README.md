# Appointment Management System (AMS) - Samajcare Dental Clinic

A comprehensive web-based appointment and clinic management system built with CodeIgniter (PHP) and MariaDB. The application manages clinics, dentists, patients, appointments, services, and reports across three primary user roles: **Clinic Operator (Admin)**, **Dentist**, and **Patient**.

---

## 🚀 Quickstart & Setup Guide

### Prerequisites
- [Docker](https://www.docker.com/) & Docker Compose installed and running.

### 1. Start the Containers
In the project root, run:
```bash
docker compose up -d
```
- **Web App**: [http://localhost:8080](http://localhost:8080) (Apache + PHP 7.4)
- **Database**: MariaDB 10.4 on port `3307` (`localhost:3307`)

### 2. Seed the Database (Required for Testing)
Populate the database with dummy clinics, dentists, patients, services, upcoming appointments, and test login credentials:
```bash
docker compose exec -T db mysql -u root ams < seeder.sql
```

---

## 🔑 Test Credentials Reference

All testing accounts use the pre-configured password: `ssssss` (except the admin).

| Role | Username | Password | Email | Notes |
| :--- | :--- | :--- | :--- | :--- |
| **Clinic Operator (Admin)** | `admin` | `admin` | `admin@admin.com` | Full management access |
| **Patient** | `johndoe` | `ssssss` | `john@doe.com` | Patient ID: `1` |
| **Patient** | `janedoe` | `ssssss` | `jane@doe.com` | Patient ID: `2` |
| **Patient** | `sitanepali` | `ssssss` | `sita@nepali.com` | Patient ID: `3` |
| **Dentist** | `dr_sarah` | `ssssss` | `sarah@dentist.com` | Dentist ID: `1` |
| **Dentist** | `dr_ram` | `ssssss` | `ram@dentist.com` | Dentist ID: `2` |

---

## 🧭 How to Test Features in Your Web Browser

Open [http://localhost:8080](http://localhost:8080) in your browser.

### 1. Testing as Clinic Operator (Admin)
Log in with `admin` / `admin`:
- **Dashboard (`/dashboard`)**: Displays real-time summary metric cards (Total Patients, Dentists, Clinics, Appointments, Services).
- **Patients Menu**:
  - `Show all patients`: View, inspect (`show`), `edit`, or `delete` patients.
  - `Add Patients`: Add a new patient record with contact and assigned clinic.
  - `Search patient by id code`: Quickly look up any patient by their numeric ID (e.g., search `1`).
- **Dentists Menu**:
  - `Show all dentists`: View dentists, their contact details, and assigned clinics.
  - `Add dentist`: Register new dental practitioners to clinics.
- **Clinics Menu**:
  - `Show all clinics`: View clinic branches (e.g., Kathmandu City Center, Lalitpur Branch).
  - `Add clinic`: Add new clinic branches with location and type (`main` or `branch`).
- **Appointments Menu**:
  - `Show all appointments`: View all booked upcoming appointments with patient, dentist, and clinic details.
  - `Add appointment`: Schedule an appointment for an existing patient with available dentists and clinics.
- **Services Menu**:
  - `Show all services`: Manage dental procedures (e.g., Teeth Cleaning, Root Canal, Braces).
  - `Add services`: Create service offerings with pricing and location.
- **Reports Menu**:
  - `Weekly Report of dentist`: Enter an appointment date to see appointment workloads for each dentist.
  - `Appointment report of day ahead`: View all appointments scheduled for tomorrow.
  - `Weekly report of clinics`: View patient traffic distribution across clinic locations.
- **Add Users (`/addusers`)**:
  - Click the user icon in the top right navbar to create additional clinic operators.

---

### 2. Testing as Patient
Log in with `johndoe` / `ssssss`:
- **Patient Profile (`/patients_profile`)**: View your registered patient contact details and clinic location.
- **My Appointment (`/patients/appointment`)**: View your active upcoming appointments, edit appointment date/time, or cancel an appointment.
- **Add Appointment (`/patients/addAppointment`)**: Schedule an appointment by picking an available dentist, clinic branch, date, and time.
- **Notifications (`/patients/notification`)**: View system alerts and appointment notifications.
- **Services (`/patients/showServices`)**: Browse dental procedures and pricing across clinic branches.
- **Account Settings (`/patients/changePassword`)**: Change your password securely.
- **Edit Profile (`/patients/editProfile`)**: Update your personal contact details.

---

### 3. Testing as Dentist
Log in with `dr_sarah` / `ssssss`:
- **Dentist Profile (`/dentists_profile`)**: View your professional profile and clinic assignment.
- **My Appointment (`/dentists/appointment`)**: Review your schedule of assigned patient appointments. Dentists can cancel appointments if necessary (an automatic notification is delivered to the patient).
- **My Notifications (`/dentists/notification`)**: View notifications when appointments are booked or cancelled.
- **Services (`/dentists/showServices`)**: Review available services and pricing.
- **Account Settings & Profile**: Update contact details or change password from the top-right user menu.

---

### 4. Patient Self-Registration Workflow
In AMS, registration is a verified two-step process:
1. **Operator Step**: The clinic operator first registers the patient via **Patients > Add Patients** (this generates a unique Patient ID, e.g., `4`).
2. **Patient Self-Registration**:
   - Go to [http://localhost:8080/register](http://localhost:8080/register).
   - Enter your assigned `id` code, `login_username`, the same `login_email` on file with the clinic, password, and select **patient** as the user type.
   - Upon submission, the login credentials are activated and linked to the patient record.

---

### 5. Password Recovery (`/forgotpassword`)
- Go to [http://localhost:8080/forgotpassword](http://localhost:8080/forgotpassword).
- Enter the email address associated with your account (e.g., `john@doe.com`).
- In local development mode, AMS displays the account password directly on screen so you can test recovery even without external SMTP configured.

---

## 🛠️ Key Caveats, Fixes & Improvements

During the review and revamp, the following critical issues and caveats were addressed:
1. **Dynamic Base URL**: Replaced hardcoded `http://localhost:8080/` with dynamic `$_SERVER['HTTP_HOST']` in `config.php`, ensuring CSS and asset loading works across different ports.
2. **Missing Schema Elements**: Added the `status` column to `tbl_appointment` and the missing `tbl_notification` table to prevent fatal database query errors.
3. **Empty State Exceptions**: Previously, methods in `Appointments_Model`, `Dentists_Model`, `Services_Model`, and `Notifications_Model` threw raw exceptions when queries returned 0 rows, violently redirecting users back to dashboards. All views now gracefully handle empty data states with helpful messages and action buttons.
4. **PHP Typo Bugs Fixed**:
   - Corrected syntax typos in exception handling: `catch(exeption $e)`, `catch(eception $e)`, and `catch(exceptions $e)` were corrected to `catch(Exception $e)`.
   - Corrected `$this->set_flashdata()` to `$this->session->set_flashdata()` in `Clinics.php`.
   - Removed an active debug statement `print_r(...); die;` in `Dentists_Model::getDentists_for_app()`.
5. **Dentist & Patient Account Management**:
   - Fixed `Dentists::edit` to properly read and update `dentist_firstname` and `dentist_lastname`.
   - Fixed undefined `$username` bug in `Patients::changePassword` that was overwriting usernames with `NULL`.
   - Fixed `Users_Model::check_pass` to check passwords against the correct user type rather than always querying dentists.
   - Fixed `Dentists::notification` to look up notifications by dentist ID rather than patient ID.
6. **Form Validation Alignment**: Aligned all rule keys in `application/config/form_validation.php` to match the exact input names used across forms (`email_address`, `id`, `appointment_date`, `new_password`, etc.).
7. **Clean Navigation**: Fixed brand links and dashboard links in `header.php` and `sidebar.php` to dynamically route users to their respective role dashboards.

---

## 📊 QA Test Report

For complete test execution details, verification matrix, and visual browser screenshots across all 36 automated steps, see:
- [QA_TEST_REPORT.md](QA_TEST_REPORT.md)
- [qa_test_report.json](qa_test_report.json)

