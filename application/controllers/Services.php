<?php
class Services extends MY_Controller{

	public function __construct(){

		parent::__construct();
		if(!$this->isLogged('admin')) redirect('users');
		$this->load->model('Services_Model');
		$this->load->model('Clinics_Model');
	}

	public function index(){
		try{
			$this->displayMessage($message=array('add_message','edit_message','delete_message','message'));
			$data['result']=$this->Services_Model->getServices();		//gets all data from getpatients method in service model and assigns to array variable.
		}catch(exception $e)
		{
			$data['result']=array();
		}
		$this->load->view('service/index',$data);					//sends the data assined to $data to the view page.
	}

	public function show($id){
		try{
			$data['result']=$this->Services_Model->getServices_by_id($id);
			$this->load->view('service/show',$data);
		}catch(exception $e){
			$this->setMessage($e->getMessage());
			redirect('services');
		}
	}

	public function add(){
		$data['clinic_location']=$this->Clinics_Model->getClinic();
		if($this->form_validation->run('service_add')==FALSE){

			$this->load->view('service/add_edit',$data);
		}
		else{
			$date=date("Y-m-d");
			$fieldname=array('service_name','service_price','service_clinic','service_startdate'=>$date);
			$form_stored=$this->formInput($fieldname);
			$add=$this->Services_Model->addServices($form_stored);
			if($add){
				$this->session->set_flashdata('add_message','successully addded');
				redirect('services');
			}
			$this->session->set_flashdata('add_message','error..could not be added..');
			redirect('services');
		}
	}

	public function delete($id){

		$data['id']=$id;
		$this->load->view('service/destroy',$data);
	}

	public function destroy($id){/*this function gets id from delete function and if confirms for delete this function is executed*/
		try{

			$delete=$this->Services_Model->deleteServices($id);
			if($delete){
				$this->session->set_flashdata('delete_message','deleted successfully');
				redirect('services');
			}

			else{

				$this->session->set_flashdata('delete_message','could not be deleted..contact system operator');
				redirect('services');
			}

		}catch(exception $e){
			$this->setMessage($e->getMessage());
			redirect('services');
		}
	}

	public function edit($id){
		try{
			$data['result']=$this->Services_Model->getServices();
			$data['id']=$id;	//assigns id from argument to array $data.
			$data['info']=$this->Services_Model->getServices_by_id($id);	//gets the information of patient whose id matches from the existing method in patient model
			$data['clinic_location']=$this->Clinics_Model->getClinic();
			if($this->form_validation->run('service_add')==FALSE){

				$this->load->view('service/add_edit',$data);
			}
			else{

				$fieldname=array('service_name','service_price','service_clinic');
				$form_stored=$this->formInput($fieldname);
				$edit=$this->Services_Model->editServices($id,$form_stored);
				if($edit)
				{
					$this->session->set_flashdata('edit_message','your record was edited succesfully' );
					redirect('services');
				}
				$this->session->set_flashdata('edit_message','your record could not be edited..contact system operator' );
				redirect('services');
			}
		}catch(exception $e){
			$this->setMessage($e->getMessage());
			redirect('services');
		}
	}

}

?>