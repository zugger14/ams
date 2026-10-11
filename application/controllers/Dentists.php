<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dentists extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!($this->isLogged('admin'))&&!($this->isLogged('patient'))&&!($this->isLogged('dentist'))) redirect('users');
		$this->load->model('Clinics_Model');
		$this->load->model('Dentists_Model');
		$this->load->model('Appointments_Model');
		$this->load->model('Users_Model');
		$this->load->model('Notifications_Model');
	}

	public function index()
	{
		try{

			$this->displayMessage($message=array('add_message','edit_message','delete_message','message'));
			$data['result'] = $this->Dentists_Model->getDentists();//gets all data from get patients method in patient model and assigns to array variable.
		}catch(exception $e){

			$data['result'] = array();
		}
		$this->load->view('dentist/index', $data);//sends the data assined to $data to the view page.
	}

	public function show($id)
	{
		try{

			$data['result'] = $this->Dentists_Model->getDentists_by_id($id);
			$this->load->view('dentist/show', $data);

		}catch(exception $e){

			$this->setMessage(utf8_encode($e->getMessage()));
			redirect('dentists');
		}
	}

	public function add()
	{
		try{

			$data['clinic_location'] = $this->Clinics_Model->getClinic();
			if($this->form_validation->run('dentist_add')==FALSE){

				$this->load->view('dentist/add_edit', $data);
			}
			else{
				$fieldname = array('dentist_firstname','dentist_lastname','dentist_address', 'dentist_contact', 'dentist_email', 'dentist_clinic');
				$form_stored = $this->formInput($fieldname);
				$add = $this->Dentists_Model->addDentists($form_stored);//variables which hold data from form are passed as argument in method which will add those new data of patient.
				if ($add) {

					$this->session->set_flashdata('add_message', 'succesfully added');
					redirect('dentists');
				}
				$this->session->set_flashdata('add_message', 'could not add');
				redirect('dentists');
			}

		}catch(exception $e){

			$this->setMessage(utf8_encode($e->getMessage()));
			redirect('dentists');

		}
	}

	public function delete($id)//this function loads confirm delete page.
	{
		$data['id'] = $id;
		$this->load->view('dentist/destroy', $data);
	}

	public function destroy($id)//this function is used to delete appointment.
	{
		try{

			$delete = $this->Dentists_Model->deleteDentists($id);
			if ($delete) {
				$this->Users_Model->delete_users_by_patient_dentist_id_and_type($id,'dentist');//if a dentist is deleted then also delete from user table.
				$this->session->set_flashdata('delete_message', 'succesfully deleted!');
				redirect('dentists');
			}

			$this->session->set_flashdata('delete_message', 'could not delete.');
			redirect('dentists');

		}catch(exception $e){
			$this->setMessage($e->getMessage());
			redirect('dentists');
		}
	}

	public function edit($id)
	{
		try{
			$this->displayMessage($message=array('message'));
			$data['result'] = $this->Dentists_Model->getDentists();
			$data['clinic_location'] = $this->Clinics_Model->getClinic();
			$data['id'] = $id;                                                //assigns id from argument to array $data.
			$data['info'] = $this->Dentists_Model->getDentists_by_id($id);    //gets the information of patient whose id matches from the existing method in patient model
			if($this->form_validation->run('dentist_add')==FALSE){

				$this->load->view('dentist/add_edit', $data);
			}
			else{

				$fieldname = array('dentist_firstname', 'dentist_lastname', 'dentist_address', 'dentist_contact', 'dentist_clinic');
				$form_stored = $this->formInput($fieldname);
				$edit = $this->Dentists_Model->editDentists($id, $form_stored);    //variables which hold data from form are passed as argument in method which will edit those existing data of patient with new name.
				if ($edit) {
					$this->session->set_flashdata('edit_message', 'successfully edited.');
					redirect('dentists');
				}
				$this->session->set_flashdata('edit_message', 'could not edit records');
				redirect('dentists');
			}

		}catch(exception $e){

			$this->setMessage(utf8_encode($e->getMessage()));
			redirect('dentists');

		}
	}

	public function email_edit($id,$do_email){

		if($do_email=='delete'){
			$dentist_email=array('dentist_email'=>null);
			$edit=$this->Dentists_Model->editDentists($id,$dentist_email);
			if($edit){
				$this->setMessage('deleted email please add new one..');
				redirect('dentists/edit/'."$id");
			}
			$this->setMessage('cannot delete email');
			redirect('dentists/edit/'."$id");
		}
		if($do_email=='add'){
			if($this->form_validation->run('email_add_dentist')==FALSE){

				$this->load->view('dentist/add_email');
			}
			else{

				$dentist_email=array('dentist_email'=>$this->input->post('dentist_email'));
				$edit=$this->Dentists_Model->editDentists($id,$dentist_email);
				if($edit){

					$this->session->set_flashdata('added email successfully');
					redirect('dentists/edit/'."$id");
				}
				$this->setMessage('cannot add email');
				redirect('dentists/edit/'."$id");
			}
		}
	}

	public function profileView(){    /*--this function loads view page of profile of logged_in dentist--*/
		try{

			$this->displayMessage($message=array('edit_message','cancel_app','notification_message','message'));
			$id = $this->session->userdata('logged_in_dentist_id');
			$datas['data'] = $this->Dentists_Model->getDentists_by_id($id);
			$this->load->view('dentist/login/dentist_profile', $datas);

		}catch(exception $e){

			$this->setMessage(utf8_encode($e->getMessage()));
			redirect('users');
		}

	}

	public function appointment(){ /*--this function is used to show appointment for dentist--*/
		try{
			$this->displayMessage($message=array('cancel_app'));
			$id=$this->session->userdata('logged_in_dentist_id');
			$appointments['result']=$this->Appointments_Model->getApp_by_dentist_id($id);
		}catch(exception $e){
			$appointments['result']=array();
		}
		$this->load->view('dentist/login/dentist_appointment',$appointments);
	}

	public function cancelAppointment($id){//this function is used to cancel appointment by dentist.

		$patient_id=$this->Appointments_Model->getID_of_appointed_patient_by_id($id);
		$patient_user_id=$this->Users_Model->get_id_by_patient_id($patient_id);
		$datetime=date("Y-m-d H:i:s");
		$notification_content="your appointment has been cancelled by the dentist on $datetime..you can make another appointment with another dentist..";
		$data=array('login_user_id'=>$patient_user_id,'notification_date'=>$datetime,'notification_content'=>$notification_content);
		$this->Notifications_Model->add_notification($data);
		//above parts are for adding notifications.

		redirect('appointments/destroy/'.$id.'/'."dentist");

	}

	public function editProfile(){ /*--this method is used to edit the profile of logged in dentist--*/

		try{
			$id=$this->session->userdata('logged_in_dentist_id');
			$data['info']=$this->Dentists_Model->getDentists_by_id($id);//gets the information of dentistt whose id matches from the existing method in patient model
			if($this->form_validation->run('edit_dentist_profile')==FALSE){

				$this->load->view('dentist/login/logged_edit',$data);	//passes id and other needed data to view page.

			}
			else{
				$fieldname=array('dentist_firstname','dentist_lastname','dentist_address','dentist_contact','dentist_email');
				$form_stored=$this->formInput($fieldname);	//returns data posted from form and stores in an another array named $field.
				$edit=$this->Dentists_Model->editDentists($id,$form_stored);
				if($edit){
					$new_email['login_email']=$form_stored['dentist_email'];
					$this->Users_Model->editUsers_by_id($id,$new_email,'dentist');
					$this->session->set_flashdata('edit_message','your record was edited...' );
					redirect('dentists_profile');
				}
				$this->session->set_flashdata('edit_message','your record could not be edited...' );
				redirect('dentists_profile');
			}
		}catch(exception $e){
			$this->setMessage(utf8_encode($e->getMessage()));
			redirect('dentists_profile');
		}
	}

	public function changePassword(){ //this method is used to change the username and password of logged in dentists

		$id=$this->session->userdata('logged_in_dentist_id');
		$this->displayMessage($message=array('error_message'));
		if($this->form_validation->run('edit_account')==FALSE){

			$this->load->view('dentist/login/change_password');

		}
		else{

			$password=$this->input->post('login_password');
			$arguments=array('password'=>$password);
			$new_password=$this->input->post('new_password');
			$change_pass=$this->Users_Model->check_pass($arguments,$id,'dentist');
			if($change_pass){
				$form_stored=array('login_password'=>$new_password);
				$edit=$this->Users_Model->editUsers_by_id($id,$form_stored,'dentist');
				if($edit){

					$this->session->set_flashdata('edit_message','succesfully changed...');
					redirect('dentists_profile');
				}
				else{

					$this->session->set_flashdata('edit_message','cannot change your account settings..try again later.');
					redirect('dentists_profile');
				}
			}
			redirect('dentists/changePassword');
		}
	}

	public function notification(){
		try{
			$dentist_id=$this->session->userdata('logged_in_dentist_id');
			$dentist_user_id=$this->Users_Model->get_id_by_dentist_id($dentist_id);
			$data['notification']=$this->Notifications_Model->get_notification_by_user_id($dentist_user_id);
			$view_date=date("Y-m-d H:i:s");
			$update_data=array('notification_viewdate'=>$view_date);
			$this->Notifications_Model->edit_notification($dentist_user_id,$update_data);

		}catch(exception $e){

			$data['notification']=array();
		}
		$this->load->view('patient/login/notification',$data);
	}

	public function showServices(){
		$this->load->model('Services_Model');
		try{
			$data['result']=$this->Services_Model->getServices();
		}catch(exception $e){
			$data['result']=array();
		}
		$this->load->view('patient/login/services',$data);
	}
}