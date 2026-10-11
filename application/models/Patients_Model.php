<?php
class Patients_Model extends CI_Model{

	public function __construct(){

		parent::__construct();

	}

	public function getPatients(){							//method for getting all the patients in patientstable from database.
		$query=$this->db->get('tbl_patient');		//selects all field of patient table.

		if(empty($query->result())) throw new exception('there is no any patients recorded..');
		return	$query->result();				//returns all data from patient table in database.
	}

	public function getPatients_by_id($id){

		$query=$this->db->where('patient_id',$id)
						->get('tbl_patient');		//selects  row of patient table whose id matches.

		if(empty($query->result())){
			throw new exception('such patients does not exist..');
		}
		else{

			return $query->result();
		}

	}

	public function addPatients($data){								//method for adding new patients
		$add_flag=$this->db->insert('tbl_patient',$data);		//inserts array of data of patient into patient table in database.
		if($add_flag)
		{
			return TRUE;										//checks if added or not.
		}
		else
		{
			return FALSE;
		}
	}

	public function is_patients_id($id){//this function is used to check if the id exists in patient table.
		$query=$this->db->where('patient_id',$id)
										->get('tbl_patient');
		$row=$query->num_rows();
		if($row>0){
			return TRUE;
		}
		else{
			return FALSE;
		}

	}

	public function editPatients($id,$data){
		if(!$this->is_patients_id($id)) throw new exception('cannot find any patient..not edited any record..');
		$edit_flag=$this->db->where('patient_id',$id)			//selects the row in which the id matches and update that particular matched row.
												->update('tbl_patient',$data);
		if($edit_flag)
		{
			return TRUE;										//checks if edited or not.if edited redirect to patients view page else redirect to patient view page with unsuccesfull task message.
		}
		else
		{
			return FALSE;
		}

	}

	public function deletePatients($id){
		if(!$this->is_patients_id($id)) throw new exception('cannot find any patient..not deleted any record..');
		$delete_flag=$this->db->where('patient_id',$id)			//selects the row in which the id matches and update that particular matched row.
													->delete('tbl_patient');
		if($delete_flag)
		{
			return TRUE;										//checks if deleted or not.if deleted redirect to patients view page else redirect to patient view page with unsuccesfull task message.
		}

		else
		{
			return FALSE;
		}

	}

	public function getPatients_for_app($id){	//this method is used for selecting only those patients who have no appointment.
		$query=$this->db->where_not_in('patient_id',$id)
										->get('tbl_patient');

		if(empty($query->result())) throw new exception('there is no any patients left for adding appointment.the patient may already have an appointment.');
		return $query->result();
	}

	public function totalPatients(){ //this function is used to get total number of patients.
		$query=$this->db->get('tbl_patient');
		$no_of_patients=$query->num_rows();

		return $no_of_patients;
	}
}


?>