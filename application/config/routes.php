<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

//------------patients
$route['patients']='Patients';
$route['patients_profile']='Patients/profileView';
$route['patients/add']='Patients/add';
$route['patients/add/(:any)']='Patients/add';
$route['patients/edit/(:num)']='Patients/edit/$1';
$route['patients/edit/(:num)/(:any)']='Patients/edit/$1';
$route['patients/edit_email/(:num)/(:any)']='Patients/email_edit/$1/$2';
$route['patients/delete/(:num)']='Patients/delete/$1';
$route['patients/delete/(:num)/(:any)']='Patients/delete/$1';
$route['patients/destroy/(:num)']='Patients/destroy/$1';
$route['patients/destroy/(:num)/(:any)']='Patients/destroy/$1';
$route['patients/show/(:num)']='Patients/show/$1';
$route['patients/show/(:num)/(:any)']='Patients/show/$1';
$route['patients/search']='Patients/search';
$route['patients/search/(:any)	']='Patients/search';
$route['patients/editProfile']='Patients/editProfile';
$route['patients/editProfile/(:any)']='Patients/editProfile';
$route['patients/notification']='Patients/notification';
$route['patients/notification/(:any)']='Patients/notification';
$route['patients/appointment']='Patients/appointment';
$route['patients/showServices']='Patients/showServices';
$route['patients/changePassword']='Patients/changePassword';
$route['patients/changePassword/(:any)']='Patients/changePassword';
$route['patients/cancelAppointment/(:num)']='Patients/cancelAppointment/$1';
$route['patients/addAppointment']='Patients/addAppointment';
$route['patients/editAppointment/(:num)']='Patients/editAppointment/$1';
$route['patients/editAppointment/(:num)/(:any)']='Patients/editAppointment/$1';
$route['patients/(:any)']='Patients';



//-------------dentists
$route['dentists/notification/(:num)']='Dentists/notification/$1';
$route['dentists']='Dentists';
$route['dentists_profile']='Dentists/profileView';
$route['dentists/edit/(:num)']='Dentists/edit/$1';
$route['dentists/edit/(:num)/(:any)']='Dentists/edit/$1';
$route['dentists/edit_email/(:num)/(:any)']='Dentists/email_edit/$1/$2';
$route['dentists/add']='Dentists/add';
$route['dentists/add/(:any)']='Dentists/add';
$route['dentists/show/(:num)']='Dentists/show/$1';
$route['dentists/show/(:num)/(:any)']='Dentists/show/$1';
$route['dentists/delete/(:num)']='Dentists/delete/$1';
$route['dentists/delete/(:num)/(:any)']='Dentists/delete/$1';
$route['dentists/destroy/(:num)']='Dentists/destroy/$1';
$route['dentists/destroy/(:num)/(:any)']='Dentists/destroy/$1';
$route['dentists/editprofile']='Dentists/editProfile';
$route['dentists/editprofile/(:any)']='Dentists/editProfile';
$route['dentists/notification']='Dentists/notification';
$route['dentists/notification/(:any)']='Dentists/notification';
$route['dentists/appointment']='Dentists/appointment';
$route['dentists/showServices']='Dentists/showServices';
$route['dentists/changePassword']='Dentists/changePassword';
$route['dentists/changePassword/(:any)']='Dentists/changePassword';
$route['dentists/cancelAppointment/(:num)']='Dentists/cancelAppointment/$1';
$route['dentists/(:any)']='Dentists';



//-------------clinics
$route['clinics']='Clinics';
$route['clinics/edit/(:num)']='Clinics/edit/$1';
$route['clinics/edit/(:num)/(:any)']='Clinics/edit/$1';
$route['clinics/add']='Clinics/add';
$route['clinics/add/(:any)']='Clinics/add';
$route['clinics/delete/(:num)']='Clinics/delete/$1';
$route['clinics/delete/(:num)/(:any)']='Clinics/delete/$1';
$route['clinics/destroy/(:num)']='Clinics/destroy/$1';
$route['clinics/destroy/(:num)/(:any)']='Clinics/destroy/$1';
$route['clinics/show/(:num)']='Clinics/show/$1';
$route['clinics/show/(:num)/(:any)']='Clinics/show/$1';
$route['reports']='Clinics/show_reports';
$route['report/dentist']='Clinics/report_dentist';
$route['report/day']='Clinics/report_day';
$route['report/clinic']='Clinics/report_clinic';
$route['clinics/viewDetail/(:any)']='Clinics/viewDetail/$1/$2';
$route['clinics/viewDetail_for_clinic/(:num)/(:any)']='Clinics/viewDetail_for_clinic/$1/$2';
$route['clinics/(:any)']='Clinics';

//-------------users
$route['users']='Users';
$route['addusers']='Users/Add';
$route['login']='Users/login';
$route['logout']='Users/logout';
$route['register']='Users/register';
$route['dashboard']='Users/dashboard';
$route['users/(:any)']='Users';
$route['forgotpassword']='Users/forgotPassword';


//-------------appointments
$route['appointments']='Appointments';
$route['appointments/add/(:any)']='Appointments/add/$1';
$route['appointments/add']='Appointments/add';
$route['appointments/add/(:any)/(:any)']='Appointments/add';
$route['appointments/edit/(:num)']='Appointments/edit/$1';
$route['appointments/edit/(:num)/(:any)']='Appointments/edit/$1';
$route['appointments/delete/(:num)']='Appointments/delete/$1';
$route['appointments/delete/(:num)/(:any)']='Appointments/delete/$1';
$route['appointments/destroy/(:num)']='Appointments/destroy/$1';
$route['appointments/destroy/(:num)/(:any)']='Appointments/destroy/$1/$2';
$route['appointments/show/(:num)']='Appointments/show/$1';
$route['appointments/show/(:num)/(:any)']='Appointments/show/$1';
$route['appointments/(:any)']='Appointments';


//--------------services
$route['services']='Services';
$route['services/add']='Services/add';
$route['services/add/(:any)']='Services/add';
$route['services/edit/(:num)']='Services/edit/$1';
$route['services/edit/(:num)/(:any)']='Services/edit/$1';
$route['services/show/(:num)']='Services/show/$1';
$route['services/show/(:num)/(:any)']='Services/show/$1';
$route['services/delete/(:num)']='Services/delete/$1';
$route['services/delete/(:num)/(:any)']='Services/delete/$1';
$route['services/destroy/(:num)']='Services/destroy/$1';
$route['services/destroy/(:num)/(:any)']='Services/destroy/$1';
$route['services/(:any)']='Services';

/*end of my own routes*/

$route['(:any)']='Users';
$route['default_controller'] = 'Users';
$route['404_override'] = 'MY_Controller/not_found';


/* End of file routes.php */
/* Location: ./application/config/routes.php */