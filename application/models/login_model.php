<?php

class Login_model extends CI_Model{

	function ValidaLogin()
        {
		$this->db->where('hl_email', $this->input->post('email'));
		$this->db->where('pw_password', md5($this->input->post('senha')));
		$query = $this->db->get('tb_user');
                $result = $query->result();
		if($query->num_rows == 1)
		{
			return $result;
		}
		
	}

}

?>