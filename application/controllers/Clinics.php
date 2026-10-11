 <?php
class Clinics extends MY_Controller{

	function __construct(){

		parent::__construct();
		if(!$this->isLogged('admin')) redirect('users');
		$this->load->model('Clinics_Model');
		$this->load->model('Dentists_Model');
		$this->load->model('Appointments_Model');
		$this->load->model('Users_Model');
		$this->load->library('upload');
		$this->load->library('email');
	}

	public function index(){
		try{

			$this->displayMessage($message=array('add_message','edit_message','delete_message','message'));
			$data['result']=$this->Clinics_Model->getClinic();	//gets all data from getClinic method in Clinic_Model and assigns to array variable.
		}catch(exception $e){

			$data['result']=array();
		}
		$this->load->view('clinic/index',$data);		//sends the data assined to $data to the view page.
	}

	public function show($id){
		try{

			$data['result']=$this->Clinics_Model->getClinic_by_id($id);
			$this->load->view('clinic/show',$data);

		}catch(exception $e){

			$this->setMessage(utf8_encode($e->getMessage()));
			redirect('clinics');

		}
	}

	public function add(){

		if($this->form_validation->run('clinic_add')==FALSE){

			$this->load->view('clinic/add_edit');
		}
		else{
			$clinic_location=$this->input->post('clinic_location');
			$clinic_type=$this->input->post('clinic');
			$fieldname=array('clinic_location','clinic_type');
			$form_stored=$this->formInput($fieldname);
			$add=$this->Clinics_Model->addClinic($form_stored);
			if($add){

				$this->session->set_flashdata('add_message','successfully added clinics');
				redirect('clinics');
			}
			$this->session->set_flashdata('add_message','could not add clinic');
			redirect('clinics');
		}
	}

	public function delete($id){

		$data['id']=$id;
		$this->load->view('clinic/destroy',$data);

	}

	public function destroy($id){
		try{

			$delete=$this->Clinics_Model->deleteClinic($id);
			if($delete){
				$this->session->set_flashdata('delete_message','successfully deleted');
				redirect('clinics');
			}

			else{

				$this->session->set_flashdata('delete_message','could not delete clinics');
				redirect('clinics');
			}

		}catch(exception $e){
			$this->setMessage($e->getMessage());
			redirect('clinics');
		}

	}

	public function edit($id){
		try{

			$data['result']=$this->Clinics_Model->getClinic();
			$data['id']=$id;												//assigns id from argument to array $data.
			$data['info']=$this->Clinics_Model->getClinic_by_id($id);		//gets the information of clinic whose id matches from the existing method in patient model
			if($this->form_validation->run('clinic_add')==FALSE){

				$this->load->view('clinic/add_edit',$data);
			}

			else{
				$fieldname=array('clinic_location','clinic_type');
				$form_stored=$this->formInput($fieldname);
				$edit=$this->Clinics_Model->editClinic($id,$form_stored);
				if($edit){

					$this->session->set_flashdata('edit_message','edited successfully');
					redirect('clinics');
				}
				$this->session->set_flashdata('edit_message','could not edit records');
				redirect('clinics');
			}
		}catch(exception $e){

			$this->setMessage(utf8_encode($e->getMessage()));
			redirect('clinics');
		}
	}

	public function show_reports(){	//this function is used to list all reports.

		$this->displayMessage($message=array('message'));
		$result=$this->load->view('clinic/report/report');
	}

	public function report_dentist(){ //this function is used to show weekly reports of how many appointments each dentist had.

		$this->displayMessage($message=array('message'));
		if($this->form_validation->run('weekly_input')==FALSE){

			$this->load->view('clinic/report/weekly_report_day_input');
		}
		else{
			$date=$this->input->post('appointment_date');//print_r($date);die;
			$data['date']=$date;
			try{

				$data['result']=$this->Dentists_Model->getDentists();//print_r($result);die;
				$result=$data['result'];
				foreach($result as $dentists){
					$id=$dentists->dentist_id;
					$data['num'][]=$this->Appointments_Model->total_no_of_app_of_each_dentist($id,$date);
				}
				$this->load->view('clinic/report/report1',$data);
			}catch(exception $e){

				$this->setMessage(utf8_encode($e->getMessage()));
				redirect('reports');
			}
		}
	}

	public function viewDetail($id,$date){//this function is used to show detail report of appointments that a particular dentists had during the week.
		try{

			$data['result']=$this->Appointments_Model->appointment_by_each_dentist_weekly($id,$date);
			$this->load->view('clinic/report/detail',$data);

		}catch(exception $e){

			$this->setMessage(utf8_encode($e->getMessage()));
			redirect('report/dentist');
		}
	}

	public function report_day(){//this function is used  to show report of appointment for day ahead.
		try{

			$data['result']=$this->Appointments_Model->getApp_for_coming_day();
			$this->load->view('clinic/report/report2',$data);

		}catch(exception $e){

			$data['result']=array();
			$this->load->view('clinic/report/report2',$data);
		}
	}

	public function report_clinic(){//this function is used to show report about how busy each dental clinic is during the week.

		$this->displayMessage($message=array('message'));
		if($this->form_validation->run('weekly_input')==FALSE){

			$this->load->view('clinic/report/weekly_report_day_input');
		}

		else{

			$date=$this->input->post('appointment_date');
			$data['date']=$date;
			try{

				$data['result']=$this->Clinics_Model->getClinic();
				$result=$data['result'];
				foreach($result as $clinic){
					$id=$clinic->clinic_id;
					$data['num'][]=$this->Appointments_Model->total_no_of_app_in_each_clinic($id,$date);/*print_r($data['num']);die;*/
				}

				$this->load->view('clinic/report/report3',$data);

			}catch(exception $e){

				$this->setMessage(utf8_encode($e->getMessage()));
				redirect('reports');
			}
		}
	}

	public function viewDetail_for_clinic($id,$date){//this function is used to show detail report of appointment held in according to dental clinic.
		try{

			$data['result']=$this->Appointments_Model->getApp_by_clinic($id,$date);
			$this->load->view('clinic/report/detail_clinic',$data);

		}catch(exception $e){

			$this->setMessage(utf8_encode($e->getMessage()));
			redirect('report/clinic');
		}
	}

/*	public function do_upload(){ //just for testing.

		$this->load->view('upload');
		$this->upload->do_upload('filename');
		$data['data']=$this->upload->data();//print_r($datas);die;
		$this->load->view('upload_success',$data);
	}

	public function checkPass(){ //just for testing.

		$this->load->view('hashpassword');
		if($_POST){
			$id=$this->session->userdata('logged_in_userid');
			$username=$this->input->post('username');
			$pass=$this->input->post('pass');
			$hashed_pass=password_hash($pass,PASSWORD_DEFAULT);
			$data=array('login_username'=>$username,'login_password'=>$hashed_pass);
			$add_flag=$this->Users_Model->addUsers($data);
			$query=$this->db->where('login_username',$username)
											->get('tbl_login_user');
			$user=$query->result();
			//print_r($user[0]->login_password);die;
			$database_password=$user[0]->login_password;
			if(password_verify($pass,$database_password)){
				echo "password matched";

			}

			else{

				echo "not matched";
			}
		}
	}*/
}

?>