<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	function loginAdmin($email, $password)
	{
		$this->load->helper('security');
		$password = do_hash($password);
		$query = $this->db->get_where('admin', array('email' => $email, 'password' => $password));
		if ($query->num_rows() > 0){
			$newdata = array(
				'email'     => $email,
				'isLogged' => TRUE,
				'name' => $query->row()->name,
				'ID' => $query->row()->ID,
				'role' => 'admin',
				'lastSeen' => $query->row()->lastSeen
			);	
			$this->session->set_userdata($newdata);
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
}

?>