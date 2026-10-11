	<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Appointments extends MY_Controller{

		 function __construct(){
			parent::__construct();
			if(!($this->isLogged('admin'))&&!($this->isLogged('patient'))&&!($this->isLogged('dentist'))) redirect('users');
			$this->load->model('Clinics_Model');
			$this->load->model('Appointments_Model');
			$this->load->model('Dentists_Model');
			$this->load->model('Patients_Model');
			$this->load->model('Notifications_Model');
		}

		public function index(){
			try{

				$this->displayMessage($message=array('add_message','edit_message','delete_message','message')); //displays setted  message.
				$data['result']=$this->Appointments_Model->getApp();//gets all data from getApp method in appointment model and assigns to array variable.
			}catch(exception $e){

				$data['result']=array();
			}
			$this->load->view('appointment/index',$data);//sends the data assined to $data to the view page.
		}

		public function show($id){
			try{

				$data['result']=$this->Appointments_Model->getApp_by_id($id);
				$this->load->view('appointment/show',$data);
			}catch(exception $e){

				$this->setMessage(utf8_encode($e->getMessage()));
				redirect('appointments');
			}
		}

		public function add($show=null){
			$this->displayMessage($message=array('app_message','empty_message','patient_message','dentist_message','message'));
			try{
				if(isset($show)=='show'){
					try{

						$data['result']=$this->Appointments_Model->getApp();

					}catch(exception $e){

						$this->setMessage(utf8_encode($e->getMessage()));
						redirect('appointments/add');
					}
				}
				$data['clinic_location']=$this->Clinics_Model->getClinic();//for sending all clinics to view page.
				$patient_id=$this->Appointments_Model->getId_of_appointed_patient();//get id of all patients in appointment table.
				$data['dentists']=$this->Dentists_Model->getDentists();
				if(empty($patient_id)){//if there are no patients in appontment table all patients  are selected for adding appoitment.

					$data['patients']=$this->Patients_Model->getPatients();
				}
				else{//if there are patients in appontment table only patient who are not in appointment table are seleted for adding appoitment.

					$data['patients']=$this->Patients_Model->getPatients_for_app($patient_id);
				}
				if($this->form_validation->run('appointment_add')==FALSE){

					$this->load->view('appointment/add_edit',$data);
				}
				else{
					$data=array('appointment_date','appointment_time','dentist_id','clinic_id');
					$data_stored=$this->formInput($data);
					$add_possible=$this->Appointments_Model->add_validation($data_stored);

					if($add_possible){
						$fieldname=$this->Appointments_Model->make_date_for_appointment($data_stored);
						$form_stored=$this->formInput($fieldname);
						$add=$this->Appointments_Model->addApp($form_stored);	//variables which hold data from form are passed as argument in method which will add those new data of patient.
						if($add){
							$this->session->set_flashdata('add_message','added successfully');
							redirect('appointments');
						}
						else{
							$this->session->set_flashdata('add_message','could not add successfully');
							redirect('appointments');
						}
					}
					redirect('appointments/add');
				}

			}catch(exception $e){

				$this->setMessage(utf8_encode($e->getMessage()));
				redirect('appointments');
			}
		}

		public function delete($id){//this function is used to display confirm message.

			$data['id']=$id;
			$this->load->view('appointment/destroy',$data);

		}

		public function destroy($id,$cancel=null){//this function  deletes the records after confirm delete message.
			try{

				$delete=$this->Appointments_Model->cancelApp($id);
				if($delete){

					if($cancel==='patient'){//if the cancel request comes from logged in patient then this parameter is passed to redirect to patients appointment page.
						$this->session->set_flashdata('cancel_app','your appointment is canceled..you can make a new one..');
						redirect('patients_profile');
					}

					if($cancel==='dentist'){ //if the cancel requests comes from logged in dentist then this parameter is passed for redirecting to dentists appointment page.
						$this->session->set_flashdata('cancel_app','you have canceled appointment with the selected patient...');
						redirect('dentists_profile');
					}

					$this->session->set_flashdata('delete_message','deleted successfully');
					redirect('appointments');
				}

				$this->session->set_flashdata('could not delete the records');
				redirect('appointments');

			}catch(exception $e){

				$this->setMessage(utf8_encode($e->getMessage()));
				redirect('appointments');
			}
		}

		public function edit($id){
			try{

				$this->displayMessage($message=array('app_message','patient_message','dentist_message'));
				$patient_id=$this->Appointments_Model->getId_of_appointed_patient();//get id of all patients in appointment table.
				$data['patients']=$this->Patients_Model->getPatients();
				$data['clinic_location']=$this->Clinics_Model->getClinic();
				$data['dentists']=$this->Dentists_Model->getDentists();
				try {
					$data['result']=$this->Appointments_Model->getApp();
				} catch(exception $e) {
					$data['result']=array();
				}
				$data['id']=$id;			//assigns id from argument to array $data.
				$data['info']=$this->Appointments_Model->getApp_by_id($id);	//gets the information of patient whose id matches from the existing method in patient model
				if($this->form_validation->run('appointment_add')==FALSE){

					$this->load->view('appointment/add_edit',$data);
				}

				else{
					$data=array('appointment_date','appointment_time','dentist_id','clinic_id');
					$data_stored=$this->formInput($data);
					$add_possible=$this->Appointments_Model->add_validation($data_stored);
					if($add_possible){
						$fieldname=$this->Appointments_Model->make_date_for_appointment($data_stored);
						$form_stored=$this->formInput($fieldname);
						$edit=$this->Appointments_Model->editApp($id,$form_stored);	//variables which hold data from form are passed as argument in method which will add those new data of patient.
						if($edit){

							$this->session->set_flashdata('edit_message','edited successfully');
							redirect('appointments');
						}
						else{

							$this->session->set_flashdata('edit_message','could not edit successfully');
							redirect('appointments');
						}
					}
					redirect('appointments/edit/'.$id);
				}
			}catch(exception $e){

				$this->setMessage($e->getMessage());
				redirect('appointments');
			}

		}
	}

	?>