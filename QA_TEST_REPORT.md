# QA Test Report: Appointment Management System (AMS)

**Date**: 2026-10-10  
**Environment**: Local Docker (PHP 7.4-Apache + MariaDB 10.4)  
**Browser Engine**: Google Chrome 154 (Headless automated execution via Puppeteer)  
**Test Suite Execution**: 36 Steps Executed | **36 Passed (100%)** | **0 Errors**  
**Server Error Count**: 0 PHP Warnings | 0 PHP Fatal Errors | 0 SQL Syntax Errors  

---

## 1. Executive Summary

A comprehensive quality assurance (QA) verification was conducted across all functions, user roles, authentication boundaries, and edge cases of the Appointment Management System (AMS). 

All major regressions identified prior to the revamp—including uncaught exceptions on empty data collections, broken redirect links, missing role filters in authentication models, hardcoded debugging exits, and DataTables JavaScript runtime crashes—have been verified as completely resolved.

---

## 2. Test Coverage Matrix

| User Role | Module / Route | Status | Notes |
|:---|:---|:---:|:---|
| **Public / Guest** | Login Page (`/login`) | **PASS** | Clean render, no pre-filled credentials |
| **Public / Guest** | Forgot Password (`/forgotpassword`) | **PASS** | Input validation & fallback notice |
| **Public / Guest** | Registration (`/register`) | **PASS** | ID verification & user type selector |
| **Public / Guest** | Invalid Auth Attempt | **PASS** | Dismissable alert with invalid login notice |
| **Admin (Clinic Operator)** | Dashboard (`/dashboard`) | **PASS** | Statistics table renders accurate counts |
| **Admin (Clinic Operator)** | Manage Clinics (`/clinics`) | **PASS** | List, add, edit, delete buttons |
| **Admin (Clinic Operator)** | Manage Dentists (`/dentists`) | **PASS** | Complete roster view and add forms |
| **Admin (Clinic Operator)** | Manage Patients (`/patients`) | **PASS** | Patient directory and add forms |
| **Admin (Clinic Operator)** | Search Patient (`/patients/search`) | **PASS** | Search by unique ID code |
| **Admin (Clinic Operator)** | Manage Services (`/services`) | **PASS** | Service catalog listing & creation form |
| **Admin (Clinic Operator)** | Appointments (`/appointments`) | **PASS** | DataTables sorting, pagination, search |
| **Admin (Clinic Operator)** | Schedule Appointment (`/appointments/add`)| **PASS** | Patient, Dentist, Clinic pickers |
| **Admin (Clinic Operator)** | Weekly Dentist Report (`/report/dentist`)| **PASS** | Weekly aggregation table |
| **Admin (Clinic Operator)** | Day Ahead Report (`/report/day`) | **PASS** | Graceful empty/populated schedule table |
| **Admin (Clinic Operator)** | Weekly Clinic Report (`/report/clinic`) | **PASS** | Clinic aggregation report |
| **Admin (Clinic Operator)** | Add System Users (`/addusers`) | **PASS** | User creation interface |
| **Admin (Clinic Operator)** | Logout (`/logout`) | **PASS** | Session cleared, redirected to login |
| **Dentist** | Dashboard (`/dentists_profile`) | **PASS** | Profile info, assigned clinic |
| **Dentist** | My Appointments (`/dentists/appointment`) | **PASS** | Tailored list of dentist appointments |
| **Dentist** | Notifications (`/dentists/notification`) | **PASS** | Direct notices table |
| **Dentist** | Dental Services (`/dentists/showServices`)| **PASS** | Services list view |
| **Dentist** | Account Settings (`/dentists/changePassword`)| **PASS** | Password modification form |
| **Dentist** | Logout (`/logout`) | **PASS** | Session terminated |
| **Patient** | Dashboard (`/patients_profile`) | **PASS** | Patient profile info & address |
| **Patient** | My Appointments (`/patients/appointment`) | **PASS** | Patient appointment list |
| **Patient** | Book Appointment (`/patients/addAppointment`)| **PASS** | Patient appointment booking form |
| **Patient** | Notifications (`/patients/notification`) | **PASS** | Appointment notices list |
| **Patient** | Services Catalog (`/patients/showServices`)| **PASS** | Price list & description table |
| **Patient** | Change Password (`/patients/changePassword`)| **PASS** | Password update view |
| **Patient (Empty State)**| Empty Appointments (`/patients/appointment`)| **PASS** | Displays graceful placeholder |

---

## 3. Visual Verification & Screenshots

### Admin (Clinic Operator) Dashboard
Shows full overview metrics (Total Patients: 3, Total Dentists: 2, Total Clinics: 2, Total Appointments: 2, Total Services: 3):
![Admin Dashboard](./qa_screenshots/05_admin_dashboard.png)

### Admin Appointments with Interactive DataTables
Features responsive pagination, sorting by columns, and live text search:
![Appointments Management](./qa_screenshots/15_admin_appointments.png)

### Dentist Dashboard
Displays dentist profile information and associated clinic:
![Dentist Dashboard](./qa_screenshots/21_dentist_profile.png)

### Patient Dashboard
Displays patient profile information and registered address:
![Patient Dashboard](./qa_screenshots/26_patient_profile.png)

### Graceful Empty State Handling
When a user (such as a new patient) has no appointments, the system renders a clean placeholder message rather than a database error or PHP warning:
![Patient Empty State](./qa_screenshots/32_patient_empty_appointments.png)

### Security & Input Validation
Entering invalid credentials triggers a prominent, dismissable Bootstrap alert without exposing system internals or stack traces:
![Invalid Login Alert](./qa_screenshots/04_invalid_login.png)

---

## 4. Key QA Findings & Remediation

1. **Empty Query Exceptions**:
   - *Previous behavior*: Controllers threw exceptions when `result()` was empty, causing unexpected redirects and broken pages.
   - *Current behavior*: Controllers now return empty arrays and views gracefully display helpful empty-state rows with direct action buttons (e.g. "No appointments found. Book an Appointment").
2. **DataTable Colspan Mismatch**:
   - *Previous behavior*: When rendering an empty table with `<td colspan="X">`, DataTables emitted a `Cannot read properties of undefined (reading 'mData')` JavaScript error in the console.
   - *Current behavior*: Guarded DataTables initialization in `assets/includes/footer.php` to skip initialization when a table contains empty-state colspan cells.
3. **Role-Based Navigation Isolation**:
   - *Previous behavior*: Header and sidebar hardcoded some links that caused cross-role confusion or 404s.
   - *Current behavior*: Header and sidebar dynamically adapt based on active session variables (`logged_in_userid`, `logged_in_dentist_id`, `logged_in_patient_id`).
