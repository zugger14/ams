<?php
class MY_Controller extends CI_controller{

	public function __construct(){

		parent::__construct();
	}

	public function setMessage($message){ //this function is used to set message (flashdata).

		$this->session->set_flashdata('message',$message);
		return true;
	}

	public function formInput($fieldname){	/*this function is used to get field names from form and returns the array of data inputed in form*/

		foreach($fieldname as $key=>$name){

			if(is_string($key)){

				$data[$key]=$name;
				continue;
			}
			$data[$name]=$this->input->post($name);
		}

		return $data;
	}

	public function not_found(){

		echo "such page doesnot exit please go back from browser..";

	}

	public function isLogged($usertype){

		if($usertype==='admin'){
			if($this->session->userdata('logged_in_userid')){
				return TRUE;
			}
		}

		if($usertype==='patient'){
			if($this->session->userdata('logged_in_patient_id')){
				return TRUE;
			}
		}

		if($usertype==='dentist'){
			if($this->session->userdata('logged_in_dentist_id')){
				return TRUE;
			}
		}

		return FALSE;
	}

	public function displayMessage($message_headers){

		foreach ($message_headers as $value) {

			if($this->session->flashdata($value)){

				echo '<div class="alert alert-info alert-dismissable" style="margin: 15px 20px 0 20px;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$this->session->flashdata($value).'</div>';
			}
		}
	}

	public function isValidDate($date){

		$date_part_array=explode("-",$date);
		if(count($date_part_array)==3){

			$day=$date_part_array[2];
			$month=$date_part_array[1];
			$year=$date_part_array[0];
			if(!checkdate($month,$day,$year)){
				$this->form_validation->set_message('isValidDate','proper date is not inserted in format:(yyyy-mm-dd)');
				return FALSE;
			}
			else
				return TRUE;
		}

		else{

			$this->form_validation->set_message('isValidDate','proper date is not inserted in format:(yyyy-mm-dd)');
			return FALSE;
		}
	}
}