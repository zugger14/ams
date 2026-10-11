<?php
class Services_Model extends CI_model{

	public function getServices(){				//for getting all available services and its info.

		$query=$this->db->get('tbl_service');
		if(empty($query->result())) throw new exception('there is no any services recorded.');
		return $query->result();

	}

	public function totalServices(){ //this function is used to get total number of patients.
		$query=$this->db->get('tbl_service');
		$no_of_services=$query->num_rows();

		return $no_of_services;
	}

	public function getServices_by_id($id){			//for getting a specific service and its info on the basis of id.

		$query=$this->db->where('service_id',$id)
						->get('tbl_service');
		if(empty($query->result())) throw new exception('no such services found.');
		return $query->result();

	}

	public function addServices($data){

		$add=$this->db->insert('tbl_service',$data);
		if($add){

			return TRUE;
		}

		else{

			return FALSE;

		}

	}

	public function is_service_id($id){//this function is used to check if the id exists in appointment table.
		$query=$this->db->where('service_id',$id)
						->get('tbl_service');
		$row=$query->num_rows();
		if($row>0){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function deleteServices($id){
		if(!$this->is_service_id($id)) throw new exception('cannot delete the services..invalid id..');
		$delete=$this->db->where('service_id',$id)
						->delete('tbl_Service');
		if($delete){

			return TRUE;
		}

		else{

			return FALSE;
		}

	}

	public function editServices($id,$data){

		$edit=$this->db->where('service_id',$id)
					   ->update('tbl_service',$data);

		if($edit){

			return TRUE;
		}

		else{

			return FALSE;

		}

	}

}


?>