<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function logging() {
        	
        $user = $this->input->post("login");
        $password = md5($this->input->post("password"));
        
        $consult = $this->db->get_where("tbusers", array("login" => $user, "password" => $password));
        
        if ($consult->num_rows() > 0) {                            
            return true;
        } else {
            return false;
        }
    }
    
    function recovery_user($user = '') {
        
        if ($user != '') {
        	
        	$this->db->select("tbusers.*, tbpeople.*, tbweb_contact.*, tbusers.id_users as id, 
        		tbpeople.id_people as id_people_admin, tbpeople.name as name_admin, tbpeople.dt_update as dt");
							 
			$this->db->join("tbpeople", "tbpeople.id_people = tbusers.id_people", 'LEFT');								
			$this->db->join("tbweb_contact", "tbweb_contact.id_people = tbusers.id_people", 'LEFT');
					            
            $consult = $this->db->get_where("tbusers", array("login" => $user))->row();
            return $consult;        
        }
		
		return FALSE;
    } 
    
    function recovery_password() {
            
        $user = $this->input->post("login");
               
       if ($user != '') {
           $this->db->where("login", $user);
       }
               
        $consult = $this->db->get("tbusers");
        //$consulta = $this->db->get_where("tbusers", array("login" => $user ));
        
        if ($consult->num_rows() > 0) {
            return true;
        } else {
            return false;
        }            
    }    
    
    function return_password() {
            
        $user = $this->input->post("login");
               
       if ($user != '') {
           $this->db->where("login", $user);
       }
               
       return $this->db->get("tbusers");
    }    


    function write_key($key = null, $id_users = 0, $email = null) {
        
        if ($key != '') {
            if ($this->db->insert("tbpassword_recover", array("recovery_key" => $key, "id_users" => $id_users ) ) ) {
                return true;
            }
        }
        return false;
    }

    function verification_key($key = null) {
            
        $this->db->where("TIMESTAMPDIFF(MINUTE, date_time, now()) <= 1440") ;  // Link Válid to 01 day = 24 hours = 1440 minutes  -- calculated in minutes.
        
        $consult = $this->db->get_where("tbpassword_recover", array("key" => $key ));
        
        if ($consult->num_rows() > 0) {
            return true;
        } else {
            return false;
        }            
    }

    function save_password_recover() {        
        $key = $this->input->post("key");        
        $password = md5($this->input->post("password_1"));        

        $user = $this->db->get_where("tbpassword_recover", array("recovery_key" => $key ))->row()->login;
        
        $query = $this->db->where("login", $user)->update("tbusers", array("password" => $password));
        
        if ($query) {
            return true;
        } else {
            return false;
        }           
    }

	function save_password_new_user() {
		
		$user = $this->input->post("login");
		$senha = md5($this->input->post("password_1"));
		
		$ret = false;		
		$query = $this->db->where("login", $user)->update("tbusers", 
								array("password" => $password, "logged" => '0' ));
        if ($query) {
            $ret = true;
        }		
		return $ret;           
	}	
	
	
	
	

}

