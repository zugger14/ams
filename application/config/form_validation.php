<?php
$config = array(
    'signup' => array(
        array('field' => 'id', 'label' => 'ID Code', 'rules' => 'trim|required'),
        array('field' => 'login_username', 'label' => 'Username', 'rules' => 'trim|required'),
        array('field' => 'login_email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
        array('field' => 'login_password', 'label' => 'Password', 'rules' => 'trim|required'),
        array('field' => 're_password', 'label' => 'Re-Password', 'rules' => 'trim|required|matches[login_password]')
    ),
    'login' => array(
        array('field' => 'login_username', 'label' => 'Username', 'rules' => 'trim|required'),
        array('field' => 'login_password', 'label' => 'Password', 'rules' => 'trim|required')
    ),
    'add_user' => array(
        array('field' => 'login_username', 'label' => 'Username', 'rules' => 'trim|required'),
        array('field' => 'login_password', 'label' => 'Password', 'rules' => 'trim|required'),
        array('field' => 're_password', 'label' => 'Password Confirmation', 'rules' => 'trim|required|matches[login_password]'),
        array('field' => 'login_email', 'label' => 'Email', 'rules' => 'trim|required|valid_email')
    ),
    'forgot_pass' => array(
        array('field' => 'email_address', 'label' => 'Email Address', 'rules' => 'trim|required|valid_email')
    ),
    'patient_add' => array(
        array('field' => 'patient_firstname', 'label' => 'First Name', 'rules' => 'trim|required'),
        array('field' => 'patient_lastname', 'label' => 'Last Name', 'rules' => 'trim|required'),
        array('field' => 'patient_contact', 'label' => 'Contact Number', 'rules' => 'trim|required')
    ),
    'patient_edit' => array(
        array('field' => 'patient_firstname', 'label' => 'First Name', 'rules' => 'trim|required'),
        array('field' => 'patient_lastname', 'label' => 'Last Name', 'rules' => 'trim|required'),
        array('field' => 'patient_contact', 'label' => 'Contact Number', 'rules' => 'trim|required')
    ),
    'email_add_patient' => array(
        array('field' => 'patient_email', 'label' => 'Email', 'rules' => 'trim|required|valid_email')
    ),
    'search_id' => array(
        array('field' => 'id', 'label' => 'Patient ID', 'rules' => 'trim|required|numeric')
    ),
    'edit_patient_profile' => array(
        array('field' => 'patient_firstname', 'label' => 'First Name', 'rules' => 'trim|required'),
        array('field' => 'patient_lastname', 'label' => 'Last Name', 'rules' => 'trim|required'),
        array('field' => 'patient_contact', 'label' => 'Contact', 'rules' => 'trim|required')
    ),
    'edit_patient_appointment' => array(
        array('field' => 'appointment_date', 'label' => 'Date', 'rules' => 'trim|required'),
        array('field' => 'appointment_time', 'label' => 'Time', 'rules' => 'trim|required')
    ),
    'dentist_add' => array(
        array('field' => 'dentist_firstname', 'label' => 'First Name', 'rules' => 'trim|required'),
        array('field' => 'dentist_lastname', 'label' => 'Last Name', 'rules' => 'trim|required'),
        array('field' => 'dentist_contact', 'label' => 'Contact', 'rules' => 'trim|required')
    ),
    'email_add_dentist' => array(
        array('field' => 'dentist_email', 'label' => 'Email', 'rules' => 'trim|required|valid_email')
    ),
    'edit_dentist_profile' => array(
        array('field' => 'dentist_firstname', 'label' => 'First Name', 'rules' => 'trim|required'),
        array('field' => 'dentist_lastname', 'label' => 'Last Name', 'rules' => 'trim|required'),
        array('field' => 'dentist_contact', 'label' => 'Contact', 'rules' => 'trim|required')
    ),
    'clinic_add' => array(
        array('field' => 'clinic_location', 'label' => 'Location', 'rules' => 'trim|required')
    ),
    'weekly_input' => array(
        array('field' => 'appointment_date', 'label' => 'Date', 'rules' => 'trim|required')
    ),
    'service_add' => array(
        array('field' => 'service_name', 'label' => 'Service Name', 'rules' => 'trim|required'),
        array('field' => 'service_price', 'label' => 'Service Price', 'rules' => 'trim|required|numeric')
    ),
    'appointment_add' => array(
        array('field' => 'appointment_date', 'label' => 'Date', 'rules' => 'trim|required'),
        array('field' => 'appointment_time', 'label' => 'Time', 'rules' => 'trim|required')
    ),
    'edit_account' => array(
        array('field' => 'login_password', 'label' => 'Old Password', 'rules' => 'trim|required'),
        array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'trim|required'),
        array('field' => 're_password', 'label' => 'Confirm Password', 'rules' => 'trim|required|matches[new_password]')
    )
);
