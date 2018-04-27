<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class M_setup extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function return_setup() {
        
        return $this->db->get("tbglobal_setup");        
    }
          
    function save(){
        	    		
		$id_users = $this->session->userdata("id_users");       	    		
		$id_setup = $this->input->post("id_setup");		
        $items_per_page = $this->input->post('items_per_page');
        $folder_of_images = $this->input->post('folder_of_images');    
        $note = $this->input->post('note');        
						
        $data = array(  "id_users" => $id_users,
        				"items_per_page" => $items_per_page,
                       "folder_of_images" => $folder_of_images,
                       "note" => $note 
                     );
                                  
		$query = FALSE;
		
        if (!empty($id_setup) && $id_setup > 0) {
            $query = $this->db->update("tbglobal_setup", $data);            
        }                                           
                                                                                            
        if ($query) {
            return TRUE;
        } else {
            return FALSE;
        }                                                                                            
        
    }

    function save_logo($logo = null) {
        
        return $this->db->update("tbglobal_setup", array("logo" => $logo));        
    }
          
    function address_logo() {            
        return $this->db->select("logo")->get("tbglobal_setup")->row()->logo;
    }

	function return_next_id($tab, $ind) {
					
		$this->db->select_max($ind, 'id');
		$this->db->where($ind ." < 999999");
		
		$query = $this->db->get($tab);
		//echo $this->db->last_query();
		
		$id = $query->row()->id;		 
		return $id + 1;
	}  

	function return_array_id($tab, $col, $data, $ind) {
					
		$this->db->select(" $ind as id_ret ");
		$this->db->like($col, $data);
		
		$query = $this->db->get($tab);

		$ret = "";
		foreach ($query->result_array() as $row) {
        	$ret .= $row["id_ret"] .", ";			
		}

		$ret = substr($ret, 0, (strlen(trim($ret)) - 1) );
		//print_r($ret);
		//exit();
				
		return $ret;
	}  
}
