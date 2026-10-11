<?php
class Appointments_Model extends CI_Model{

	public function __construct(){

		parent::__construct();

	}
	public function totalAppointments(){ //this function is used to get total number of appointments.

		$query=$this->db->get('tbl_appointment');
		$no_of_app=$query->num_rows();

		return $no_of_app;
	}

	public function getApp(){ //this function is used to get all upcoming date's appoinments info from appointment table

		$query=$this->db->where('tbl_appointment.expiry_time > NOW()')
						->where('tbl_appointment.status',null)
						->join('tbl_patient','tbl_appointment.patient_id=tbl_patient.patient_id')
						->join('tbl_dentist','tbl_appointment.dentist_id=tbl_dentist.dentist_id')
						->join('tbl_clinic','tbl_appointment.clinic_id=tbl_clinic.clinic_id')
						->get('tbl_appointment');

		if(empty($query->result())) throw new exception('there is no any appointments made.');
		return $query->result();
	}

	public function getApp_by_id($id){//this function is used to get appointment info by passing id as parameter

		$query=$this->db->where('tbl_appointment.appointment_id',$id)
						->where('expiry_time > NOW()')
						->where('tbl_appointment.status',null)
						->join('tbl_patient','tbl_appointment.patient_id=tbl_patient.patient_id')
						->join('tbl_dentist','tbl_appointment.dentist_id=tbl_dentist.dentist_id')
						->join('tbl_clinic','tbl_appointment.clinic_id=tbl_clinic.clinic_id')
						->get('tbl_appointment');//print_r($query->result());die;//selects  row of appointment table whose id matches.
		if(empty($query->result())) throw new exception('cannot get the selected appointment info.');
		return $query->result();
	}

	public function addApp($data){//for adding new appointment.

		$add_flag=$this->db->insert('tbl_appointment',$data);
		if($add_flag){

			return TRUE;
		}

		else{

			return FALSE;

		}
	}

	public function add_validation($data){//this function is used to validate appointment info if it is addable or not.

		if(date("Y-m-d",strtotime("$data[appointment_date]"))<date("Y-m-d")){

			$this->session->set_flashdata('app_message','the date you are choosing is invalid refering to current date..check again');
			return FALSE;
		}

		if(date("Y-m-d",strtotime("$data[appointment_date]"))===date("Y-m-d")){
			if(strtotime("$data[appointment_time]")<date('H:i:s')){
				$this->session->set_flashdata('app_message','the time you are choosing is invalid refering to current time..check once again!!');
				return FALSE;
			}
		}

		if(strtotime("$data[appointment_time]")<strtotime("9 am")||strtotime("$data[appointment_time]")>strtotime("6 pm")){
			$this->session->set_flashdata('app_message','appointment is not avialable at that time.please choose other time..');
			return FALSE;
		}

		$form_time=date("H:i:s",strtotime("$data[appointment_time]"));
		$form_date=date("Y-m-d",strtotime("$data[appointment_date]"));

		try{

			if(isset($data['clinic_id'])){

				$dentist_id=$data['dentist_id'];
				$dentist_result=$this->getDentists_by_id($dentist_id);
				$clinic_id=$data['clinic_id'];
				$results=$this->getClinic_by_id($clinic_id);

				if($results[0]->clinic_location!==$dentist_result[0]->dentist_clinic){

					$this->session->set_flashdata('app_message','the dentist is not available in the clinic you want..see all dentists and their location..');
					return FALSE;
				}
			}

			try{
				$result=$this->Appointments_Model->getApp();//print_r($result);die;
				foreach($result as $app){
					if($app->dentist_id==$data['dentist_id']&&$app->appointment_date==$form_date){
						if($form_time>=$app->appointment_time){

							if($app->appointment_time==$form_time||$form_time<date("H:i:s",strtotime("$app->appointment_time + 2 hour"))){

								$this->session->set_flashdata('app_message','the time has been already reserved by another patient to same dentist.');
								return FALSE;
							}
						}
						else{
							if($app->appointment_time==$form_time||$form_time>date("H:i:s",strtotime("$app->appointment_time - 2 hour"))){

								$this->session->set_flashdata('app_message','the time has been already reserved by another patient to same dentist.');
								return FALSE;
							}
						}
					}
				}
			}catch(exception $e){

				return TRUE;
			}

			return TRUE;

		}catch(exception $e){

			$this->setMessage($e->getMessage());
			redirect('patients/addAppointment');
		}

	}

	public function is_appointment_id($id){//this function is used to check if the id exists in appointment table.
		$query=$this->db->where('appointment_id',$id)
						->get('tbl_appointment');
		$row=$query->num_rows();
		if($row==1){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function deleteApp($id){	//for deleting appointment.
		if(!$this->is_appointment_id($id)) throw new exception('cannot delete the appointment record you selected..invalid selection..');
		$delete_flag=$this->db->where('appointment_id',$id)
							  ->delete('tbl_appointment');
		if($delete_flag){
			return TRUE;
		}

		else{

			return FALSE;
		}
	}

	public function cancelApp($id){	//this function is used to cancel appointment and hide the appointment from displaying canceled appointment..

		if(!$this->is_appointment_id($id)) throw new exception('cannot delete the appointment record you selected..invalid selection..');
		$data['status']="canceled";
		$cancel=$this->db->where('appointment_id',$id)
						 ->update('tbl_appointment',$data);
		if($cancel){

			return TRUE;
		}

		return FALSE;
	}

	public function editApp($id,$data){			//for editing appointment informations

		$edit_flag=$this->db->where('appointment_id',$id)
							->update('tbl_appointment',$data);
		if($edit_flag){

			return TRUE;
		}

		else{

			return FALSE;
		}

	}

	public function make_date_for_appointment($data_stored){ //this function is used to make date and expiry dates for appointment.

		$made_date=date("y-m-d");
		$date_obj=new datetime($data_stored['appointment_date']);
		$time_obj=new datetime($data_stored['appointment_time']);
		$merge=new datetime($date_obj->format('Y-m-d').' '.$time_obj->format('H:i:s'));
		$datetime=$merge->format('Y-m-d H:i:s');
		$expiry_time=strtotime("$datetime+2hours");
		$expiry_datetime=date("Y-m-d H:i:s",$expiry_time);
		if(isset($data_stored['patient_id'])){

			$fieldname=array('appointment_made_date'=>$made_date,'expiry_time'=>$expiry_datetime,'appointment_time','appointment_date','patient_id'=>$data_stored['patient_id'],'dentist_id','clinic_id'); //needs fixing here..
		}
		else{

			$fieldname=array('appointment_made_date'=>$made_date,'expiry_time'=>$expiry_datetime,'appointment_time','appointment_date','patient_id','dentist_id','clinic_id'); //needs fixing here..
		}

		return $fieldname;
	}

	public function getApp_by_patient_id($id){	//method for getting appointment by  searching patient  id in appointment table

		$query=$this->db->where('tbl_appointment.patient_id',$id)
						->where('expiry_time > NOW()')
						->where('tbl_appointment.status',null)
						->join('tbl_patient','tbl_appointment.patient_id=tbl_patient.patient_id')
						->join('tbl_dentist','tbl_appointment.dentist_id=tbl_dentist.dentist_id')
						->join('tbl_clinic','tbl_appointment.clinic_id=tbl_clinic.clinic_id')
						->get('tbl_appointment');//print_r($query->result());die;
		if(empty($query->result())) throw new exception('cannot get appointment info');
		return $query->result();
	}

	public function getApp_by_dentist_id($id){	//method for getting appointment by searching dentist id in appointment table.

		$query=$this->db->where('tbl_appointment.dentist_id',$id)
						->where('expiry_time > NOW()')
						->where('tbl_appointment.status',null)
						->join('tbl_patient','tbl_appointment.patient_id=tbl_patient.patient_id')
						->join('tbl_dentist','tbl_appointment.dentist_id=tbl_dentist.dentist_id')
						->join('tbl_clinic','tbl_appointment.clinic_id=tbl_clinic.clinic_id')
						->get('tbl_appointment');
		if(empty($query->result())) throw new exception('cannot get appointment info you want.');
		return $query->result();
	}

	public function getId_of_appointed_patient(){ /* this function is used to get id of all patients who are already appointed and exist in appointment table. */
		$id=array();
		try{

			$result=$this->getApp();

		}catch(exception $e){

			return NULL;
		}

		if(isset($result)){

			foreach($result as $appointment){

				$id[]=$appointment->patient_id;
			}
			return $id;
		}
	}

	public function getID_of_appointed_patient_by_id($id){//this function is used to get id of patients by using appointment's id.
		try{

			$result=$this->getApp_by_id($id);
			if(isset($result)){

				foreach($result as $patient){

					$id=$patient->patient_id;

				}
				return $id;
			}

		}catch(exception $e){

			throw new exception(utf8_encode($e->getMessage()));
		}
	}

	public function getDentists_by_id($id){	//fo checking the dentist is in which clinic.

		$query=$this->db->where('dentist_id',$id)
						->get('tbl_dentist');		//selects  row of dentist table whose id matches.
		if(empty($query->result())) throw new exception('there is no such dentist data.');
		return $query->result();
	}

	public function getClinic_by_id($id){//for getting available clinics.

		$query=$this->db->where('clinic_id',$id)
						->get('tbl_clinic');
		if(empty($query->result())) throw new exception('no data available from such id.');
		return $query->result();
	}

	public function getId_of_appointed_dentist(){ //this function is used to get the id of all dentists who are already appointed and exist in appointment table.

		try{

			$query=$this->getApp();
			foreach($query as $appointment){

				$id[]=$appointment->dentist_id;
			}
			return $id;

		}catch(exception $e){

			throw new exception(utf8_encode($e->getMessage()));
		}
	}

	public function getID_of_appointed_dentist_by_id($id){//this function is used to get id of appointed dentist by using appointment's id.

		try{
			$result=$this->getApp_by_id($id);
			foreach($result as $appointment){

				$id=$appointment->dentist_id;
			}
			return $id;

		}catch(exception $e){

			throw new exception(utf8_encode($e->getMessage()));
		}
	}

	public function appointment_by_each_dentist_weekly($id,$date){/*this function is used to get all appointments info of particular dentists identified by id as parameter..*/

		$newdate = strtotime('-7 day',strtotime($date));
		$newdate = date ( 'Y-m-d' , $newdate );
		$query=$this->db->where('tbl_appointment.dentist_id',$id)
						->where("tbl_appointment.appointment_date > '$newdate'")
						->where("tbl_appointment.appointment_date < '$date'")
						->join('tbl_patient','tbl_appointment.patient_id=tbl_patient.patient_id')
						->join('tbl_dentist','tbl_appointment.dentist_id=tbl_dentist.dentist_id')
						->join('tbl_clinic','tbl_appointment.clinic_id=tbl_clinic.clinic_id')
						->get('tbl_appointment');
		//if(empty($query->result())) return NULL;
							//throw new exception('no such appointments to show in system.');
		return $query->result();

	}

	public function total_no_of_app_of_each_dentist($id,$date){//this function is used to get total number of appointments of a dentist of last week.

		$newdate = strtotime ( '-7 day' , strtotime ( $date ) ) ;
		$newdate = date ( 'Y-m-d' , $newdate );
		$query=$this->db->where('dentist_id',$id)
						->where("tbl_appointment.appointment_date > '$newdate'")
						->where("tbl_appointment.appointment_date < '$date'")
						->get('tbl_appointment');
		//if(empty($query->result())) throw new exception('no data records to show. ');
		$no_of_appointment=$query->num_rows();
		return($no_of_appointment);
	}

	public function getApp_for_coming_day(){//this function is used to show appointment of coming day.

		$query=$this->db->where('DATE_SUB(tbl_appointment.appointment_date,interval 1 day) = CURDATE()')
										->join('tbl_patient','tbl_appointment.patient_id=tbl_patient.patient_id')
										->join('tbl_dentist','tbl_appointment.dentist_id=tbl_dentist.dentist_id')
										->join('tbl_clinic','tbl_appointment.clinic_id=tbl_clinic.clinic_id')
										->get('tbl_appointment');
		if(empty($query->result())) throw new exception('there is no any appointments for selected conditions..');
		return $query->result();
	}

	public function getApp_by_clinic($clinic_id,$date){//this function is used to get appointments  info by clinic location

		$newdate = strtotime ( '-7 day' , strtotime ($date) ) ;
		$newdate = date ( 'Y-m-d' , $newdate );
		$query=$this->db->where("tbl_appointment.appointment_date > '$newdate'")
										->where("tbl_appointment.appointment_date < '$date'")
										->where('tbl_appointment.clinic_id',$clinic_id)
										->join('tbl_patient','tbl_appointment.patient_id=tbl_patient.patient_id')
										->join('tbl_dentist','tbl_appointment.dentist_id=tbl_dentist.dentist_id')
										->join('tbl_clinic','tbl_appointment.clinic_id=tbl_clinic.clinic_id')
										->get('tbl_appointment');//print_r($query->result());die;
		/*$check_empty=$query->num_rows();
		if($check_empty==0) 	throw new exception('no data records to show dmdm for selected condition');*/
		return $query->result();
	}

	public function total_no_of_app_in_each_clinic($id,$date){//this function is used to get total nuber of appointments in a clinic determined by clinic id.

		$results=$this->getApp_by_clinic($id,$date);
		$counter=0;
		foreach($results as $result){
			$counter++;
		}
		return $counter;
	}

}

?>