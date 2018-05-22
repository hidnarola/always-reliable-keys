<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Model {

	/**
     * Check user exist or not for unique email
     * @author pav
     * @param string username, string password
     * @return array
     */
    public function check_login_validation($uname, $pass) {
        $this->db->select('u.*');
        $this->db->from(TBL_USERS . ' as u');
        $this->db->group_start();
	        $this->db->where('u.email_id',$uname);
	        $this->db->or_where('u.username',$uname);
        $this->db->group_end();
        $this->db->where(
            array(
                'u.password' => $pass, 
                'u.status' => 'active',
                'u.is_delete' => 0,
                'u.user_role!=' =>  0
            )
        );
        $this->db->limit(1);
        $res = $this->db->get();
        return $res->row_array();
    }

    public function find_user_by_email($email_add) {
        $this->db->select('id as user_id, first_name, last_name');
        $this->db->from(TBL_USERS);
        $this->db->where('email_id', $email_add);
        $this->db->where(
            array(
                'is_delete'   => 0
            )
        );
        $res = $this->db->get();
        return $res->row_array();
    }

    public function get_user_details($user_id, $password_verify = NULL) {
        $this->db->select('*');
        $this->db->from(TBL_USERS);
        $this->db->where('id', $user_id);
        if (!is_null($password_verify)) {
            $this->db->where('password_verify', $password_verify);
        }
        $this->db->limit(1);
        $res = $this->db->get();
        return $res->row_array();
    }

    /**
     * Update User profile
     * @author PAV
     * @param integer user id
     * @return boolean
     */
    public function get_user_profile($user_id) {
        $this->db->select('*');
        $this->db->from(TBL_USERS);
        $this->db->where('id', $user_id);
        //$this->db->where('user_role', 1);
        $res = $this->db->get();
        return $res->row_array();
    }
}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */