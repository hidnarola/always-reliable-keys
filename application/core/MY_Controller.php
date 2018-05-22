<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->model(array('users_model'));
    if ($this->session->userdata('user_id') != '') {
      $this->logged_in_id = $this->session->userdata('user_id');
    }
    //$this->current_loc_Arr = json_decode(file_get_contents("http://ipinfo.io"));
	}

	/**
     * Generate unique username
     * @param $string_name, $rand_no
     * @return $username
    */
    public function generate_unique_username($string_name="", $rand_no = 200){
	    while(true){
	        $username_parts = array_filter(explode(" ", strtolower($string_name))); //explode and lowercase name
	        $username_parts = array_slice($username_parts, 0, 2); //return only first two arry part
	    
	        $part1 = (!empty($username_parts[0]))?substr($username_parts[0], 0,8):""; //cut first name to 8 letters
	        $part2 = (!empty($username_parts[1]))?substr($username_parts[1], 0,5):""; //cut second name to 5 letters
	        $part3 = ($rand_no)?rand(0, $rand_no):"";
	        
	        $username = $part1. str_shuffle($part2). $part3; //str_shuffle to randomly shuffle all characters 
	        
	        $username_exist_in_db = $this->username_exist_in_database($username); //check username in database
	        if(!$username_exist_in_db){
	            return $username;
	        }
	    }
	}

	public function username_exist_in_database($username){
		$result = $this->users_model->get_all_details(TBL_USERS,array('username'=>$username));
		return $result->num_rows();
	}

	public function test_email(){
    	$email_var = array(
    	   'user_id'	=> '123',
     	   'first_name' => 'Parth',
    	   'username'	=> 'Viramgama',
    	   'email_id'	=> 'pav.narola@gmail.com',
    	   'password'	=> 'password123#'
   		);
        $message = $this->load->view('email_template/default_header.php', $email_var, true);
        $message .= $this->load->view('email_template/staff_registration.php', $email_var, true);
        $message .= $this->load->view('email_template/default_footer.php', $email_var, true);
        $email_array = array(
          'mail_type' 		=> 'html',
          'from_mail_id'    => $this->config->item('smtp_user'),
          'from_mail_name' 	=> 'Narola Team',
          'to_mail_id' 		=> 'pav.narola@gmail.com',
          'cc_mail_id' 		=> '',
          'subject_message' => 'Account Registration',
          'body_messages' 	=> 'Demo Message'
        );
        $email_send = common_email_send($email_array);
        die;
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */