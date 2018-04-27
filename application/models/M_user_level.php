<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user_level extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
          
    function save_user_level() {
            
            $id_user_level = $this->input->post("id_user_level");             
            $level  = $this->input->post("level");
			$code  = $this->input->post("code");            
            $description_user_level = $this->input->post("description_user_level");
            $note = $this->input->post("note");                                  
            
            $this->session->set_userdata("error_ins_user_level", "");            

            if ($id_user_level == 0) {                                                               
				$id = $this->m_setup->return_next_id('tbuser_level', 'id_user_level');
			}					                      

        	$data = array ( 
            	"id_user_level" => ($id_user_level == 0) ? $id : $id_user_level,         
                "level"  => $this->input->post("level"),        
                "code"  => $this->input->post("code"),
                "description_user_level"  => $this->input->post("description_user_level"),                              
                "note" => $this->input->post("note")    
            );
                                                       
        	if (!empty($id_user_level) && $id_user_level != 0){            	
                $this->db->where("id_user_level", $id_user_level);
                $query = $this->db->update("tbuser_level", $data);
                if ($query) {                                                                       
                    return TRUE;
                }
				return FALSE;

            } else {
                $query = $this->db->insert("tbuser_level", $data);                                                        
                if ($query) {
                    $id_user_level_inserted = $this->db->insert_id();
                    $this->session->set_userdata("id_user_level_inserted", $id_user_level_inserted);
					return TRUE;
                }
                return FALSE;
            }                                                                        
     }
       
    function delete($id_user_level) {
 
        $query = $this->db->where("id_user_level", $id_user_level)->update("tbuser_level", array("status" => "0" ));
  
        if ($query) {                                                                       
            return true;
        } else {
            return false;
         }                                
    }

    function return_user_level($id_user_level = 0, $reg_initial = 0, $per_page = 0) {
                
        $this->db->select("tbuser_level.*");
                                                                             
        if ($id_user_level != 0) {            
            $this->db->where('id_user_level', $id_user_level);            
        }

        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
        
        $field = $this->session->userdata("field");
         
        switch($field) {
            case 'level': {
                $field_table = 'level';     
                break;
            }
            case 'code': {
                $field_table = 'code';     
                break;
            }			
            case 'description_user_level': {
                $field_table = 'description_user_level';     
                break;
            }                                                            
            default: {
                $field_table = 'id_user_level';     
                break;
            }                
        }
        
        $order = $this->session->userdata("order");                
        if (!empty($field_table) && !empty($order)) {
            $this->db->order_by($field_table, $order);
        }
                
        $this->db->order_by('tbuser_level.description_user_level desc');                
                
        return $this->db->get('tbuser_level');
        //return $this->db->last_query(); 
    }
        
    function autocomplete($term)  {               
        $this->db->select("id_user_level, code");
        $this->db->like("code", $term);
        $this->db->order_by("code");
        
        $consult = $this->db->get("tbuser_level");
        
        return $consult;        
    }

    function filter_user_level($reg_initial = 0, $per_page = 0) {        

        $id_user_level = $this->session->userdata("id_user_level");
        $level = $this->session->userdata("level");
        $code = $this->session->userdata("code");		
        $description_user_level = $this->session->userdata("description_user_level");        
                                           
        $this->db->select("tbuser_level.*");
        $this->db->order_by('tbuser_level.dt_update', 'asc');
        
        if (!empty($id_user_level)) {            
            $this->db->where("id_user_level", $id_user_level);            
        }        
        if (!empty($level)) {            
            $this->db->like("level", $level);            
        }                        
        if (!empty($code)) {            
            $this->db->like("code", $code);            
        }
        if (!empty($description_user_level)) {            
            $this->db->like("description_user_level", $description_user_level);            
        }
                                
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
        
        return $this->db->get('tbuser_level');        
    }

    function total_user_level(){
                
        $this->db->select("COUNT(DISTINCT id_user_level) as total_user_level", FALSE);
        
        return $this->db->get("tbuser_level")->row()->total_user_level;        
    }
    
    function total_user_level_filtered(){
                        
        $level = $this->session->userdata("level");
		$code = $this->session->userdata("code");
        $description_user_level = $this->session->userdata("description_user_level");

        $this->db->select("COUNT(DISTINCT id_user_level) as total_user_level", FALSE);                
                
        if (!empty($level)) {            
            $this->db->where("level", $level);            
        }		        
        if (!empty($code)) {            
            $this->db->where("code", $code);            
        }
        if (!empty($description_user_level)) {            
            $this->db->like("description_user_level", $description_user_level);            
        }
 
       	$this->db->where('tbuser_level.status', '1');        
        
        return $this->db->get("tbuser_level")->row()->total_user_level;        
    }        
        
    function list_user_level() {        	
        $this->db->where('tbuser_level.status', '1');
        return $this->db->get("tbuser_level");        
    }
}
    
