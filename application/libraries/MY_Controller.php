<?php
class MY_Controller extends CI_controller{
	public function __contruct(){

		parent::__construct();

	}

	public function isEmpty($data){			/*this function checks for empty fields before adding data.*/
		foreach ($data as $value) {
			if($value==NULL){

				return TRUE;

			}

			$check=0;
		}

		if($check==0){
			return FALSE;
		}
	}

}