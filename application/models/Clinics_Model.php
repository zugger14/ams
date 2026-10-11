<?php
class Clinics_Model extends CI_Model{

	public function getClinic(){

		$query=$this->db->get('tbl_clinic');

		if(empty($query->result())) throw new exception('there is no any clinics added..');
		return $query->result();
	}

	public function totalClinics(){ //this function is used to get total number of clinics.
		$query=$this->db->get('tbl_clinic');
		$no_of_clinics=$query->num_rows();

		return $no_of_clinics;
	}

	public function getClinic_by_id($id){

		$query=$this->db->where('clinic_id',$id)
						->get('tbl_clinic');

		if(empty($query->result())) throw new exception('no data available from such id.');
		return $query->result();

	}

	public function is_clinic_id($id){//this function is used to check if the id exists in dentist table.
		$query=$this->db->where('clinic_id',$id)
						->get('tbl_clinic');
		$row=$query->num_rows();
		if($row>0){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function addClinic($data){

		$add_flag=$this->db->insert('tbl_clinic',$data);
		if($add_flag){

			return TRUE;

		}

		else{

			return FALSE;

		}

	}

	public function deleteClinic($id){
		if(!$this->is_clinic_id($id)) throw new exception('cannot delete the record you selected..invalid selection..');
		$delete_flag=$this->db->where('clinic_id',$id)
							  ->delete('tbl_clinic');
		if($delete_flag){

			return TRUE;
		}
		else{

			return FALSE;
		}

	}

	public function editClinic($id,$data){

		$edit_flag=$this->db->where('clinic_id',$id)
							->update('tbl_clinic',$data);

		if($edit_flag){

			return TRUE;
		}

		else{

			return FALSE;
		}
	}

}
?>