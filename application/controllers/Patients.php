<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Patients extends MY_Controller{

	function __construct(){

		parent::__construct();
		if(!($this->isLogged('admin'))&&!($this->isLogged('patient'))&&!($this->isLogged('dentist'))) redirect('users');
		$this->load->model('Patients_Model');
		$this->load->model('Dentists_Model');
		$this->load->model('Clinics_Model');
		$this->load->model('Users_Model');
		$this->load->model('Appointments_Model');
		$this->load->model('Services_Model');
		$this->load->model('Notifications_Model');
		$this->load->library('form_validation');
	}

	public function index(){
		try{

			$data['result']=$this->Patients_Model->getPatients();		//gets all data from getpatients method in patient model and assigns to array variable.
		}catch(exception $e){
			$data['result']=array();
		}
		$this->displayMessage($message=array('add_message','edit_message','delete_message','message'));
		$this->load->view('patient/index',$data);		//sends the data assined to $data to the view page.
	}

	public function show($id){
		try{

			$data['result']=$this->Patients_Model->getPatients_by_id($id);
			$this->load->view('patient/show',$data);

		}catch(exception $e){

			$this->setMessage($e->getMessage());
			redirect('patients');
		}
	}

	public function add(){

		try{

			$data['clinic_location']=$this->Clinics_Model->getClinic();
			if($this->form_validation->run('patient_add')==FALSE){

				$this->load->view('patient/add_edit',$data);

			}

			else{

				$fieldname=array('patient_firstname','patient_lastname','patient_address','patient_contact','patient_email','patient_clinic');
				$form_stored=$this->formInput($fieldname);//print_r($form_stored);die;

				$add=$this->Patients_Model->addPatients($form_stored);//variables which hold data from form are passed as argument in method which will add those new data of patient.

				if($add){

					$this->session->set_flashdata('add_message','added succesully');
					redirect('patients');
				}

				$this->session->set_flashdata('add_message','could not be added..contact system operator');
				redirect('patients');
			}

		}catch(exception $e){

			$this->setMessage($e->getMessage());
			redirect('patients');
		}

	}

	public function delete($id){

		$data['id']=$id;
		$this->load->view('patient/destroy',$data);

	}

	public function destroy($id){/*this function gets id from delete function and if confirms for delete this function is executed*/

		try{

			$delete=$this->Patients_Model->deletePatients($id);

			if($delete){
				$this->Users_Model->delete_users_by_patient_dentist_id_and_type($id,'patient');//if a patient is deleted then also delete from user table.
				$this->session->set_flashdata('delete_message','deleted successfully');
				redirect('patients');
			}

			else{
				$this->session->set_flashdata('delete_message','could not be deleted..contact system operator');
				redirect('patients');
			}

		}catch(exception $e){
			$this->setMessage($e->getMessage());
			redirect('patients');
		}
	}

	public function edit($id){
		$this->displayMessage($message=array('message'));
		try{//echo $email_delete;die;

			$data['id']=$id;	//assigns id from argument to array $data.
			$data['info']=$this->Patients_Model->getPatients_by_id($id);//gets the information of patient whose id matches from the existing method in patient model
			$data['clinic_location']=$this->Clinics_Model->getClinic();
			if($this->form_validation->run('patient_edit')==FALSE){

				$this->load->view('patient/add_edit',$data);
			}

			else{

				$fieldname=array('patient_firstname','patient_lastname','patient_address','patient_contact','patient_clinic');
				$form_stored=$this->formInput($fieldname);//returns data posted from form and stores in an another array named $field.
				$edit=$this->Patients_Model->editPatients($id,$form_stored);

				if($edit)
				{
					$this->session->set_flashdata('edit_message','your record was edited succesfully' );
					redirect('patients');
				}

				else{

					$this->session->set_flashdata('edit_message','your record could not be edited..contact system operator' );
					redirect('patients');
				}
			}
		}catch(exception $e){

			$this->setMessage($e->getMessage());
			redirect('patients');

		}

	}

	public function email_edit($id,$do_email){ //this is for editing the email by adding and removing only.

		if($do_email=='delete'){
			$patient_email=array('patient_email'=>null);
			$edit=$this->Patients_Model->editPatients($id,$patient_email);
			if($edit){
				$this->setMessage('deleted email please add new one..');
				redirect('patients/edit/'."$id");
			}
			$this->setMessage('cannot delete email');
			redirect('patients/edit/'."$id");
		}
		if($do_email=='add'){
			if($this->form_validation->run('email_add_patient')==FALSE){

				$this->load->view('patient/add_email');
			}
			else{

				$patient_email=array('patient_email'=>$this->input->post('patient_email'));
				$edit=$this->Patients_Model->editPatients($id,$patient_email);
				if($edit){

					$this->session->set_flashdata('added email successfully');
					redirect('patients/edit/'."$id");
				}
				$this->setMessage('cannot add email');
				redirect('patients/edit/'."$id");
			}
		}
	}

	public function search(){/* this function is used to search the patient according to patient id number and if not found displays not found.*/

		try{
			$this->displayMessage($message=array('message'));
			if($this->form_validation->run('search_id')==FALSE){

				$this->load->view('patient/search');
			}
			else{
				$id=$this->input->post('id');
				$data['result']=$this->Patients_Model->getPatients_by_id($id);
				$this->load->view('patient/search_show',$data);

			}
		}catch(exception $e){

			$this->setMessage($e->getMessage());
			redirect('patients/search');
		}
	}

	public function profileView(){	/*--this function is used to load view page of profile of logged_in patient--*/

		$this->displayMessage($message=array('edit_message','add_message','password_error','no_app','notification_message','cancel_app','message','app_message'));
		$id=$this->session->userdata('logged_in_patient_id');
		try{

			$datas['data']=$this->Patients_Model->getPatients_by_id($id);
			$this->load->view('patient/login/patient_profile',$datas);

		}catch(exception $e){

			$this->setMessage('you cannot view this page.only for patients who are registered in system..');
			redirect('users');
		}
	}

	public function appointment(){ /*--this function is used to show appointment of patient--*/

		$this->displayMessage($message=array('cancel_app','message','edit_message'));
		$id=$this->session->userdata('logged_in_patient_id');

		try{

			$appointments['data']=$this->Appointments_Model->getApp_by_patient_id($id);

		}catch(exception $e){

			$appointments['data']=array();
		}

		$this->load->view('patient/login/patient_appointment',$appointments);
	}

	public function cancelAppointment($id){//this function is used to cancel appointment by patients.

		try{

			$dentist_id=$this->Appointments_Model->getID_of_appointed_dentist_by_id($id);
			$dentist_user_id=$this->Users_Model->get_id_by_dentist_id($dentist_id);
			$datetime=date("Y-m-d H:i:s");
			$notification_content="the appointment has been cancelled by the patient.. in $datetime";
			$data=array('login_user_id'=>$dentist_user_id,'notification_date'=>$datetime,'notification_content'=>$notification_content);
			$this->Notifications_Model->add_notification($data);

			redirect('appointments/destroy/'.$id.'/'."patient");
		}catch(exception $e){
			$this->setMessage($e->getMessage());
			redirect('patients_profile');
		}

	}

	public function editProfile(){ /*--this method is used to edit the profile of logged in patient--*/

		try{
			$id=$this->session->userdata('logged_in_patient_id');
			$data['info']=$this->Patients_Model->getPatients_by_id($id);	//gets the information of patient whose id matches from the existing method in patient model
			if($this->form_validation->run('edit_patient_profile')==FALSE){

				$this->load->view('patient/login/logged_edit',$data);					//passes id and other needed data to patient add_edit page.
			}
			else{

				$fieldname=array('patient_firstname','patient_lastname','patient_address','patient_contact','patient_email');
				$form_stored=$this->formInput($fieldname);					//returns data posted from form and stores in an another array named $field.
				$edit=$this->Patients_Model->editPatients($id,$form_stored);
				if($edit)
				{
					$new_email['login_email']=$form_stored['patient_email'];
					$this->Users_Model->editUsers_by_id($id,$new_email);
					$this->session->set_flashdata('edit_message','your record was edited...' );
					redirect('patients_profile');
				}

				else{

					$this->session->set_flashdata('edit_message','your record could not be edited...' );
					redirect('patients_profile');

				}
			}
		}catch(exception $e){

			$this->setMessage($e->getMessage());
			redirect('patients_profile');
		}
	}

	public function addAppointment(){

		$this->displayMessage($message=array('app_message'));
		$id=$this->session->userdata('logged_in_patient_id');

		try{

			$check_appointment=$this->Appointments_Model->getApp_by_patient_id($id);

		}catch(exception $e){

		}

		if(!empty($check_appointment)){

			$this->session->set_flashdata('app_message','you already have a existing appoitment and cannot make another now.. ');
			redirect('patients_profile');
		}

		try{

			$data['dentists']=$this->Dentists_Model->getDentists();
			$data['clinic_location']=$this->Clinics_Model->getClinic();//for sending all clinics to view page.
			if($this->form_validation->run('edit_patient_appointment')==FALSE){

				$this->load->view('patient/login/add_appointment',$data);
			}

			else{

				$data=array('appointment_date','appointment_time','dentist_id','clinic_id','patient_id'=>$id);
				$data_stored=$this->formInput($data);
				$add_possible=$this->Appointments_Model->add_validation($data_stored);

				if($add_possible){

					$fieldname=$this->Appointments_Model->make_date_for_appointment($data_stored);
					$form_stored=$this->formInput($fieldname);
					$add=$this->Appointments_Model->addApp($form_stored);//print_r($add);die;
					if($add){
						$this->session->set_flashdata('add_message', 'you have added appointment.');
						redirect('patients_profile');
					}
					else{

						$this->session->set_flashdata('add_message', 'could not add appointment');
						redirect('patients_profile');
					}
				}
					redirect('patients/addAppointment');
			}

		}catch(exception $e){

			$this->setMessage($e->getMessage());
			redirect('patients_profile');
		}
	}


	public function editAppointment($id){ //this method is used edit appointment info of logged in patient.

		try{

			$this->displayMessage($message=array('app_message'));
			$patient_id=$this->session->userdata('logged_in_patient_id');
			$data['id']=$id;
			$data['info']=$this->Appointments_Model->getApp_by_id($id);
			$data['dentists']=$this->Dentists_Model->getDentists();
			$data['clinic_location']=$this->Clinics_Model->getClinic();
			if($this->form_validation->run('edit_patient_appointment')==FALSE){

				$this->load->view('patient/login/add_appointment',$data);
			}
			else{

				$data=array('appointment_date','appointment_time','dentist_id','clinic_id','patient_id'=>$patient_id);
				$data_stored=$this->formInput($data);
				$add_possible=$this->Appointments_Model->add_validation($data_stored);
				if($add_possible){
					$fieldname=$this->Appointments_Model->make_date_for_appointment($data_stored);
					$form_stored=$this->formInput($fieldname);
					$edit=$this->Appointments_Model->editApp($id,$form_stored);
					if($edit) {
						$this->session->set_flashdata('edit_message', 'your action was successfully performed..');
						redirect('patients/appointment');
					}
					else{
						$this->session->set_flashdata('edit_message', 'could not be perform the requested action..');
						redirect('patients_profile');
					}
				}
				redirect('patients/editAppointment/'.$id);
			}

		}catch(exception $e){
			$this->setMessage($e->getMessage());
			redirect('patients_profile');
		}
	}

	public function changePassword(){//this method is used to change the username and password of logged in patients

		$id=$this->session->userdata('logged_in_patient_id');
		$this->displayMessage($message=array('error_message'));
		if($this->form_validation->run('edit_account')==FALSE){

			$this->load->view('patient/login/change_password');
		}

		else{

			$password=$this->input->post('login_password');
			$new_password=$this->input->post('new_password');
			$arguments=array('password'=>$password);
			$change_pass=$this->Users_Model->check_pass($arguments,$id,'patient');
			if($change_pass){

				$form_stored=array('login_password'=>$new_password);
				$edit=$this->Users_Model->editUsers_by_id($id,$form_stored,'patient');

				if($edit){
					$this->session->set_flashdata('edit_message','succesfully changed...');
					redirect('patients_profile');
				}
				else{

					$this->session->set_flashdata('edit_message','cannot change your account settings..try again later.');
					redirect('patients_profile');
				}
			}

			redirect('patients/changePassword');
		}
	}

	public function showServices(){

		try{

			$data['result']=$this->Services_Model->getServices();

		}catch(exception $e){
			$data['result']=array();
		}
		$this->load->view('patient/login/services',$data);
	}

	public function notification(){
		try{

			$patient_id=$this->session->userdata('logged_in_patient_id');
			$patient_user_id=$this->Users_Model->get_id_by_patient_id($patient_id);
			$data['notification']=$this->Notifications_Model->get_notification_by_user_id($patient_user_id);
			$view_date=date("Y-m-d H:i:s");
			$update_data=array('notification_viewdate'=>$view_date);
			$this->Notifications_Model->edit_notification($patient_user_id,$update_data);

		}catch(exception $e){

			$data['notification']=array();
		}
		$this->load->view('patient/login/notification',$data);
	}
}

