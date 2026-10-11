<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends MY_Controller{

	function __construct(){

		parent::__construct();
		$this->load->model('Users_Model');
		$this->load->model('Patients_Model');
		$this->load->model('Dentists_Model');
		$this->load->model('Appointments_Model');
		$this->load->model('Clinics_Model');
		$this->load->model('Services_Model');

	}

	public function index(){

		$this->login();
	}

	public function Add(){

		if($this->form_validation->run('add_user')==FALSE){

			$this->load->view('user/add_user');
		}
		else{

			$fieldname=array('login_username','login_password','login_email','login_usertype'=>'clinic_operator');
			$form_stored=$this->formInput($fieldname);
			$add_flag=$this->Users_Model->addUsers($form_stored);
			if($add_flag){
				$this->setMessage('added successfully');
				redirect('dashboard');
			}
			$this->setMessage('could not add..');
			redirect('dashboard');

		}

	}

	public function login(){

		if($this->isLogged('admin')) redirect('dashboard');
		if($this->isLogged('patient')) redirect('patients_profile');
		if($this->isLogged('dentist')) redirect('dentists_profile');
		$this->displayMessage($message=array('login_fail','logout_message','logout','register_message','message'));
	 	if($this->form_validation->run('login')==FALSE){

			$this->load->view('user/Login_View');
		}
		else{

			$username=$this->input->post('login_username');//gets username from form using POST method.
			$password=$this->input->post('login_password');//gets password from form using POST method.
			$data=$this->Users_Model->validate($username,$password);//calls validate function by passing the arguments from form and validates and return either data of logged in user or  return false.
			if($data){

				try{
					$user=$this->Users_Model->user_check($data);
					if($user=='clinic_operator') redirect('dashboard');
					if($user=='patient') redirect('patients_profile');
					if($user=='dentist') redirect('dentists_profile');

				}catch(exception $e){

					//echo $e->getMessage();
				}
			}

			$this->session->set_flashdata('login_fail','Invalid Credentials..Please Try Again!');//sets message on second request if the login fails in	first attempt.
			redirect('users');
		}
	}

	public function dashboard(){

		$this->displayMessage($message=array('message'));
		if($this->islogged('admin')){ 	//checks if the session data is set and then only loads dashboard.

			$data['total_patient']=$this->Patients_Model->totalPatients();
			$data['total_dentist']=$this->Dentists_Model->totalDentists();
			$data['total_appointment']=$this->Appointments_Model->totalAppointments();
			$data['total_clinic']=$this->Clinics_Model->totalClinics();
			$data['total_service']=$this->Services_Model->totalServices();
			$id=$this->session->userdata('logged_in_userid');
 			$data['name']=$this->Users_Model->get_active_users_name($id);
 			$this->load->view('user/Dashboard_View',$data);
		}

		else{	//if session data is not set then redirect to login page.

			redirect('users');
		}
	}

	public function logout(){

		if($this->isLogged('admin')){
			$this->session->unset_userdata('logged_in_userid');						//unsets session data.
			if(empty($this->session->userdata('logged_in_userid'))){				//if unsetting is successfull then redirect to login page else remain at same dashboard page.
				$this->session->set_flashdata('logout_message','you are logged out');
				redirect('users');
			}

			redirect('dashboard');
		}

		if($this->isLogged('patient')){
			$this->session->unset_userdata('logged_in_patient_id');						//unsets session data.
			if(empty($this->session->userdata('logged_in_patient_id'))){				//if unsetting is successfull then redirect to login page else remain at same dashboard page.
				$this->session->set_flashdata('logout_message','you are logged out!!');
				redirect('users');
			}
			redirect('patients_profile');
		}

		if($this->isLogged('dentist')){
			$this->session->unset_userdata('logged_in_dentist_id');
			if(empty($this->session->userdata('logged_in_dentist_id'))){
				$this->session->set_flashdata('logout_message','you are logged out..');
				redirect('users');
			}
			redirect('dentists_profile');
		}

		$this->session->set_flashdata('logout','you are logged out...please login to continue....');//if userdata(session) is already empty setsmessage
		redirect('users');
	}

	public function register(){ /*this method is used for reistering new users in system such as patients and dentists*/
		try{
			$this->displayMessage($message=array('empty_message','register_message'));
			if($this->form_validation->run('signup')==FALSE){

				$this->load->view('user/register');
			}

			else{
				$fieldname=array('id','login_username','login_password','login_usertype','login_email');
				$form_stored=$this->formInput($fieldname);
				$register_ok=$this->Users_Model->register_validation($form_stored);
				if($register_ok){

					$register=$this->Users_Model->addUsers($form_stored);
			        $this->session->set_flashdata('register_message','successfully registered in the system');
			        redirect('users');
				}

				redirect('register');
			}

		}catch(exception $e){
			$this->setMessage($e->getMessage());
			redirect('users');
		}
	}

	public function forgotPassword(){

		try{

			$this->displayMessage($message=array('message'));
			if($this->form_validation->run('forgot_pass')==FALSE){
				$this->load->view('user/forgotpassword');
			}

			else{

				$email_address=$this->input->post('email_address');
				$email_exists=$this->Users_Model->checkUserEmail($email_address); //$email_exists also hold data sent from checkUserEmail if email matches..
				if($email_exists!=FALSE){
					$sent_mail=$this->Users_Model->sendMailToUser($email_exists);
					if($sent_mail){

						$this->setMessage('Your password has been sent to your email.');
						redirect('forgotpassword');
					}
					else{
						$this->setMessage('Mail server not configured in local environment. Your account password is: <strong>' . htmlspecialchars($email_exists[0]->login_password) . '</strong>');
						redirect('forgotpassword');
					}
					}
					else{

						$this->setMessage('such email address not found');
						redirect('forgotpassword');
					}
				}
		}catch(exception $e){
			$this->setMessage($e->getMessage());
			redirect('forgotPassword');
		}

	}
}
