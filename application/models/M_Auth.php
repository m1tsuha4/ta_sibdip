<?php 

class M_Auth extends CI_Model
{

    private $_user = 'tb_pegawai';

    public function doLogin($username, $password)
    {
        $query = $this->db->get_where($this->_user, 
        ['username' => $username, 'password' => $password]);

        if ($query->num_rows() == 1) {
            # code...
            return $query->result();
        }
        else 
        {
            return false;
        }
    }

}

?>