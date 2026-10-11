<?php
class Users_Model extends CI_Model{

    public function getusers(){
                                                    //method to get all data from user table.
        $query = $this->db->get('tbl_login_user');  //selects all field from user table.
        if(empty($query->result())) throw new exception('no any users.. ');
        return $query->result();                    //returns all data from user table
    }

   public function validate($username,$password){          //this method is used to validate entered username and password with the data in database.
        $query=$this->db->where('login_username',$username)          //checks database infromation of user table with user inputed information and selects matched results.
                        ->where('login_password',$password)
                        ->get('tbl_login_user');

        $rows=$query->num_rows();                                    //returns number of rows from selected result.
        if($rows==1){

            return $query->result();

        }

        else{

            return FALSE;
        }
    }

    public function users_password_hash($password){

        $hashed_password=password_hash($password,PASSWORD_DEFAULT);
        return $hashed_password;

    }

    public function get_active_users_name($id){

        $data=$this->get_active_users_by_id($id);
        foreach($data as $name){
            return $name->login_username;
        }
    }

    public function get_active_users_by_id($id){ //method for getting active users data.

        $query=$this->db->where('login_user_id',$id)//selects only the row which matches to the data in user table.
                          ->get('tbl_login_user');
        return $query->result();//returns selected data from user table.
    }

    public function get_active_users_by_patient_id($id){//method for getting active logged in patient data. by using patients_id as parameter.

        $query=$this->db->where('id',$id)//selects only the row which matches to the data in user table.
                        ->where('login_usertype','patient')
                        ->get('tbl_login_user');
        return $query->result();//returns selected data from user table.
    }

    public function get_id_by_patient_id($id){  //this funcion is used to get login_usr_id by using patient's id.
        try{

            $result=$this->get_active_users_by_patient_id($id);
            foreach($result as $user){

                $id=$user->login_user_id;

            }
            return $id;
        }catch(exception $e){
            throw new exception($e->getMessage());
        }
    }

    public function get_active_users_by_dentist_id($id){ //method for getting active logged in dentist data. by using dentists_id as parameter.

        $query=$this->db->where('id',$id)//selects only the row which matches to the data in user table.
                        ->where('login_usertype','dentist')
                        ->get('tbl_login_user');
        return $query->result();//returns selected data from user table.

    }

    public function get_id_by_dentist_id($id){//this function is used to get login_user_id by using dentist's id.
        try{

            $result=$this->get_active_users_by_dentist_id($id);
            foreach($result as $user){

                $id=$user->login_user_id;

            }

            return $id;

        }catch(exception $e){

            throw new exception($e->getMessage());
        }
    }

    public function addUsers($data){ //method for adding new users in the database
        $add=$this->db->insert('tbl_login_user',$data);

        if($add){

            return TRUE;
        }

        else{

            return FALSE;
        }
    }

    public function editUsers_by_id($id,$data,$type=null){//method for editing users info by using patients or dentists id as parameter.
        $this->db->where('id',$id);
        if($type){
            $this->db->where('login_usertype',$type);
        }
        $edit=$this->db->update('tbl_login_user',$data);
        if($edit){
            return TRUE;
        }
        return FALSE;
    }

    public function delete_users_by_patient_dentist_id_and_type($id,$type){
        $delete_flag=$this->db->where('id',$id)
                              ->where('login_usertype',$type)
                              ->delete('tbl_login_user');
        if($delete_flag) return TRUE;
        return FALSE;
    }

    public function user_check($data){//this function is used to check if the login user is patient or dentists or admin nd set session userdata and return usertype.

        if($data[0]->login_usertype=="clinic_operator"){//$flag will return data if username and password matches in the database.

            $id = $data[0]->login_user_id;//gets the id of the user.
            $this->session->set_userdata('logged_in_userid',$id);//stores id as session data for getting name of the user.
            return 'clinic_operator';
        }

        if($data[0]->login_usertype=='patient'){ //if usertype is patient userdata is stored in different session variable. and flow transfered to Patients controller

            $id=$data[0]->id;
            $this->session->set_userdata('logged_in_patient_id',$id); //must be changed not patient id but users id in tbl_login_users should be stored.
            return 'patient';
        }

        if($data[0]->login_usertype=='dentist'){ //similarly if usertype is dentists userdata is stored and flow transfered to dentist controller.

            $id=$data[0]->id;
            $this->session->set_userdata('logged_in_dentist_id',$id);
            return 'dentist';
        }

        throw new exception('invalid usertype');
    }

    public function check_pass($arguments,$id,$usertype='patient'){//this funtion is used to validate data for changing password for users.
        try{
            if($usertype=='dentist'){
                $user=$this->get_active_users_by_dentist_id($id);
            }else{
                $user=$this->get_active_users_by_patient_id($id);
            }
            if(empty($user) || $arguments['password']!==$user[0]->login_password){
                $this->session->set_flashdata('error_message','wrong password!!..your password was not changed..');
                return FALSE;
            }
            return TRUE;

        }catch(exception $e){

            throw new exception($e->getMessage());
        }
    }

    public function register_validation($form_stored){
        try{

            $users=$this->getUsers();
            /*foreach($users as $user ){

                if($user->login_username===$form_stored['login_username']){
                    $this->session->set_flashdata('register_message','the given username already exists.please use another username..');
                    return FALSE;
                }
            }*/
            $id=$form_stored['id'];
            if($form_stored['login_usertype']=="patient"){

                $patient=$this->Patients_Model->getPatients_by_id($id);
                $user=$this->get_active_users_by_patient_id($id);
                if(empty($patient) || $form_stored['id']!==$patient[0]->patient_id){
                    $this->session->set_flashdata('register_message','such patient number code not found!..try again..');
                    return FALSE;
                }

                if(!empty($user) && $form_stored['id']===$user[0]->id && $user[0]->login_usertype=='patient'){
                    $this->session->set_flashdata('register_message','patient had already been registered under the entered code.try again!..');
                    return FALSE;
                }

                 if($form_stored['login_email']!==$patient[0]->patient_email){
                    $this->session->set_flashdata('register_message','email doesnot match with the recorded email in system...use email provided at clinic.');
                    return FALSE;
                }

                return true;
            }

            if($form_stored['login_usertype']=="dentist"){

                $dentist=$this->Dentists_Model->getDentists_by_id($id);
                $user=$this->get_active_users_by_dentist_id($id);
                if(empty($dentist) || $form_stored['id']!==$dentist[0]->dentist_id){
                    $this->session->set_flashdata('register_message','such dentist number code not found!..try again..');
                    return FALSE;
                }
                if(!empty($user) && $form_stored['id']===$user[0]->id && $user[0]->login_usertype=='dentist'){
                    $this->session->set_flashdata('register_message','dentist had already been registered under the entered code.try again!..');
                    return FALSE;
                }
                if($form_stored['login_email']!==$dentist[0]->dentist_email){
                    $this->session->set_flashdata('register_message','email doesnot match with the recorded email in system...use email provided at clinic.');
                    return FALSE;
                }

                return true;
            }

        }catch(exception $e){

            throw new exception($e->getMessage());

        }
    }

    public function checkUserEmail($email_address){ //this function is used to check if entered email exists in the system or not.

        $query=$this->db->where('login_email',$email_address)
                        ->get('tbl_login_user');

        if(empty($query->result())) return FALSE;
        return $query->result();
    }

    public function sendMailToUser($user_data){ //this function is used to send email including password of user.
        try{
        $password=$user_data[0]->login_password;
        $email=$user_data[0]->login_email;
        $this->email->to($email);
        $this->email->subject('Forgotten password recovery');
        $this->email->message('The password for your samajcare account is: '.$password);
        if(!$this->email->send()){

            return FALSE;
        }

        return TRUE;

        }catch(exception $e){

            throw new exception($e->getMessage());
        }
    }

}

?>