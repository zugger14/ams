<?php
class Dentists_Model extends CI_Model{
	public function getDentists(){							//method for getting all the dentists in dentists table from database.
		$query=$this->db->get('tbl_dentist');		//selects all field of dentist table.
		if(empty($query->result())) throw new exception('there is no any dentists available.');
		return $query->result();					//returns all data from dentist table in database.

	}

	public function totalDentists(){ //this function is used to get total number of dentists.
		$query=$this->db->get('tbl_dentist');
		$no_of_dentists=$query->num_rows();

		return $no_of_dentists;
	}

	public function getDentists_by_id($id){
		$query=$this->db->where('dentist_id',$id)
										->get('tbl_dentist');		//selects  row of dentist table whose id matches.
		if(empty($query->result())) throw new exception('there is no such dentist data.');
		return $query->result();

	}

	public function addDentists($data){		//method for adding new dentists
		$add_flag=$this->db->insert('tbl_dentist',$data);		//inserts array of data of dentist into dentist table in database.
		if($add_flag)
		{
			return TRUE;										//checks if added or not.
		}
		else
		{
			return FALSE;
		}
	}

	public function editDentists($id,$data){

		$edit_flag=$this->db->where('dentist_id',$id)			//selects the row in which the id matches and update that particular matched row.
							->update('tbl_dentist',$data);
		if($edit_flag)
		{
			return TRUE;										//checks if edited or not.if edited redirect to dentist view page else redirect to dentist view page with unsuccesfull task message.
		}
		else
		{
			return FALSE;
		}

	}

	public function is_dentists_id($id){//this function is used to check if the id exists in patient table.
		$query=$this->db->where('dentist_id',$id)
										->get('tbl_dentist');
		$row=$query->num_rows();
		if($row>0){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function deleteDentists($id){
		if(!$this->is_dentists_id($id)) throw new exception('cannot delete the record you selected invalid selection..');
		$delete_flag=$this->db->where('dentist_id',$id)			//selects the row in which the id matches and update that particular matched row.
													->delete('tbl_dentist');
		if($delete_flag)
		{
			return TRUE;										//checks if edited or not.if edited redirect to dentist view page else redirect to dentist view page with unsuccesfull task message.
		}
		else
		{
			return FALSE;
		}

	}

	public function getDentists_for_app($id){//this method is used for selecting only those dentists who have no appointment.

		$query=$this->db->where_not_in('dentist_id',$id)
						->get('tbl_dentist');

		if(empty($query->result())) throw new exception('no any dentists for appointment..');
		return $query->result();
	}
}

?>