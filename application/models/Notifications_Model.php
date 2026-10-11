<?php
class Notifications_Model extends CI_model{

	public function add_notification($data){//this function is used to add notification content.

		$add_flag=$this->db->insert('tbl_notification',$data);
		if($add_flag){

			return TRUE;
		}

		return FALSE;
	}

	public function edit_notification($id,$data){//this function is used to edit data in notification table..

		$edit_flag=$this->db->where('login_user_id',$id)
							->update('tbl_notification',$data);
		if($edit_flag){
			return TRUE;
		}
		return FALSE;

	}

	public function delete_notication($id,$data){//this function is used to delete notification content.

		$delete_flag=$this->db->where('notification_id',$id)
							  ->delete('tbl_notification');
		if($delete_flag){
			return TRUE;
		}
		return FALSE;

	}

	public function get_notification_by_user_id($user_id){//this function is used to get notification content by login_user_id and where

		$query=$this->db->where('tbl_notification.login_user_id',$user_id)
						->get('tbl_notification');/*      ->where('tbl_notification.notification_viewdate < tbl_notification.notification_date')  ------for filtering new notifications only.*/

			if(empty($query->result())) throw new exception('no notifications are available to display.');
			return $query->result();
	}


}

?>