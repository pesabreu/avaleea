<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');


class M_industry extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function return_industry($id_industry = 0, $reg_initial = 0, $per_page = 0) {
	               
        if ($id_industry != 0) {
            $this->db->where("id_industry", $id_industry);
        }
   
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }

        return $this->db->get("tbindustry");	
	}

    function total_industry(){
                
        $this->db->select("COUNT(DISTINCT id_industry) as total_industry", FALSE);            
        $this->db->where("status", '1');
		
        return $this->db->get("tbindustry")->row()->total_industry;        
    }

    function save_industry() {
    
        $id_industry = $this->input->post("id_industry");
		$name_industry = $this->input->post("name_industry");
		$title_industry = $this->input->post("title_industry");        
        $description_industry = $this->input->post("description_industry");        
        $note = $this->input->post("note");
		
		if ($id_industry == 0) {
			$id = $this->m_setup->return_next_id('tbindustry', 'id_industry');
		}					                      

        $data = array ( 
            	'id_industry' => ($id_industry == 0) ? $id : $id_industry,         
                'name_industry' => $name_industry,
                'title_industry' => $title_industry,
                'description_industry' => $description_industry,
                'note' => $note                                                
        );
		
        if (!empty($id_industry) && $id_industry != 0){        
            $this->db->where("id_industry", $id_industry);
            
            if ($this->db->update("tbindustry", $data)) { 
                return TRUE;
            } else {
	            return FALSE;            	
            }
			        
        } else {        	
            if ($this->db->insert("tbindustry", $data)) { 
                return TRUE;
            } else {
            	return FALSE;
			}        
        }   
    }
       
    function delete($id_industry){

        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries

        $this->db->where("id_industry", $id_industry)->delete("tbindustry");                
        $cod_db = $this->db->error(); 

        $this->db->db_debug = $db_debug; //restore setting

        if (! isset($cod_db['message'])) {
            return 0;            //TRUE;
        } else {
            return $cod_db['code'];      // FALSE;
        }
    }
 
 	function total_industry_filtered(){
                        
		$id_industry = $this->session->userdata("id_industry");
        $name_industry = $this->session->userdata("name_industry");
        $title_industry = $this->session->userdata("title_industry");
		
        $this->db->select("COUNT(DISTINCT id_industry) as total_industry", FALSE);                
          
        if (!empty($id_industry)) {            
            $this->db->where("id_industry", $id_industry);            
        }
        if (!empty($name_industry)) {            
            $this->db->like("name_industry", $name_industry);            
        }        
        if (!empty($title_industry)) {            
            $this->db->like("title_industry", $title_industry);            
        }        
 
        $this->db->where('status', '1');        
        
        return $this->db->get("tbindustry")->row()->total_industry;        
    }        
       
    function autocomplete($term)  {
               
        $this->db->select("id_industry, name_industry");
        $this->db->like("name_industry", $term);
        $this->db->order_by("name_industry desc");
        
        $consult = $this->db->get("tbindustry");        
        return $consult;        
    }       

    function filter_industry($reg_initial = 0, $per_page = 0) {
        
        $id_industry = $this->session->userdata("id_industry");
        $name_industry = $this->session->userdata("name_industry");
        $title_industry = $this->session->userdata("title_industry");        
                                                           
        if (!empty($id_industry)) {            
            $this->db->where("id_industry", $id_industry);            
        }        
        if (!empty($name_industry)) {            
            $this->db->like("name_industry", $name_industry);            
        }                
        if (!empty($title_industry)) {            
            $this->db->like("title_industry", $title_industry);            
        }               

		$this->db->where("status", '1');
		                                
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
		
        return $this->db->get('tbindustry');        
    }    
        
    function list_industry() {        	

        $this->db->where('status', '1');
        return $this->db->get("tbindustry");        
    }
              
}
