<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');


class M_customize extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function return_customize($id_customize = 0, $reg_initial = 0, $per_page = 0) {

        $this->db->select("tbcustomize.*, tbquestionnaries.*, tbpeople.*, 
        						tbcustomize.id_customize as id ");
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbcustomize.id_questionnaries", 'LEFT');								
		$this->db->join("tbpeople", "tbpeople.id_people = tbcustomize.id_people", 'LEFT');		
	               
        if ($id_customize != 0) {
            $this->db->where("tbcustomize.id_customize", $id_customize);
        }
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }

        return $this->db->get("tbcustomize");	
	}

    function total_customize(){
                
        $this->db->select("COUNT(DISTINCT id_customize) as total_customize", FALSE);            
        $this->db->where("status", '1');
		
        return $this->db->get("tbcustomize")->row()->total_customize;        
    }

    function save_customize() {
    
        $id_customize = $this->input->post("id_customize");
		$id_questionnaries = $this->input->post("list_questionnaries");
		$id_people = $this->input->post("list_people");
		$description_customize = $this->input->post("description_customize");            
        $dt_customize = $this->input->post("dt_customize");
		$note = $this->input->post("note");        						      
		
		if ($id_customize == 0) {
			$id = $this->m_setup->return_next_id('tbcustomize', 'id_customize');
		}					                      

		$dt_evl = substr($dt_customize, 6, 4) ."-". substr($dt_customize, 3, 2) ."-". substr($dt_customize, 0, 2);

        $data = array ( 
            	'id_customize' => ($id_customize == 0) ? $id : $id_customize,         
                'id_questionnaries' => $id_questionnaries,
                'id_people' => $id_people,
                'description_customize' => $description_customize,                
                'dt_customize' => $dt_customize,
                'note' => $note
        );
                	            	                                
        if (!empty($id_customize) && $id_customize != 0){        
            $this->db->where("id_customize", $id_customize);
            
            if ($this->db->update("tbcustomize", $data)) { 
                return TRUE;
            } else {
	            return FALSE;            	
            }
			        
        } else {        	
            if ($this->db->insert("tbcustomize", $data)) { 
                return TRUE;
            } else {
            	return FALSE;
			}        
        }   
    }
       
    function delete($id_customize){

        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries

        $this->db->where("id_customize", $id_customize)->delete("tbcustomize");                
        $cod_db = $this->db->error(); 

        $this->db->db_debug = $db_debug; //restore setting

        if (! isset($cod_db['message'])) {
            return 0;            //TRUE;
        } else {
            return $cod_db['code'];      // FALSE;
        }
    }
 
 	function total_customize_filtered(){
                        
		$id_customize = $this->session->userdata("id_customize");
        $id_questionnaries = $this->session->userdata("id_questionnaries");
        $id_people = $this->session->userdata("id_people");
		$description_customize = $this->session->userdata("description_customize");

        if (!empty($id_questionnaries)) {            
//            $this->db->like("name_questions", $id_questions);            
			$array = $this->m_setup->return_array_id('tbquestionnaries', "name_questionnaries", 
									$id_questionnaries, "id_questionnaries");

            $this->db->where_in("tbcustomize.id_questionnaries", $array);
			$this->db->group_by("tbcustomize.id_customize, tbcustomize.id_questionnaries");                                    
        }        

        if (!empty($id_people)) {            
//            $this->db->like("name", $id_evaluation);            
			$array = $this->m_setup->return_array_id('tbpeople', "name", 
									$id_people, "id_people");

            $this->db->where_in("tbcustomize.id_people", $array);
			$this->db->group_by("tbcustomize.id_customize, tbcustomize.id_people");                                    
        }

        $this->db->select("tbcustomize.*, tbquestionnaries.*, tbpeople.*, tbcustomize.id_customize as id ");
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbcustomize.id_questionnaries", 'LEFT');
		$this->db->join("tbpeople", "tbpeople.id_people = tbcustomize.id_people", 'LEFT');
				
        $this->db->select("COUNT(DISTINCT id_customize) as total_customize", FALSE);                
          
        if (!empty($id_customize)) {            
            $this->db->where("id_customize", $id_customize);            
        }
        if (!empty($description_customize)) {            
            $this->db->like("description_customize", $description_customize);            
        }
 
        $this->db->where('tbcustomize.status', '1');        
        
        //return $this->db->get("tbcustomize")->row()->total_customize;
        $ret = $this->db->get('tbcustomize');
        
		$row = ($ret->num_rows() > 0) ? $ret->row()->total_customize : 1;		        
        return $row;
    }        
       
    function autocomplete($term)  {
               
        $this->db->select("id_customize, description_customize");
        $this->db->like("description_customize", $term);
        $this->db->order_by("description_customize desc");
        
        $consult = $this->db->get("tbcustomize");        
        return $consult;        
    }       

    function filter_customize($reg_initial = 0, $per_page = 0) {
        
        $id_customize = $this->session->userdata("id_customize");
        $id_questionnaries = $this->session->userdata("id_questionnaries");
        $id_people = $this->session->userdata("id_people");
		$description_customize = $this->session->userdata("description_customize");       

        $this->db->select("tbcustomize.*, tbquestionnaries.*, tbpeople.*, tbcustomize.id_customize as id ");
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbcustomize.id_questionnaries", 'LEFT');
		$this->db->join("tbpeople", "tbpeople.id_people = tbcustomize.id_people", 'LEFT');
				
        if (!empty($id_customize)) {            
            $this->db->where("id_customize", $id_customize);            
        }        
        if (!empty($id_questionnaries)) {            
            $this->db->like("name_questionnaries", $id_questionnaries);            
        }
        if (!empty($id_people)) {            
            $this->db->like("name", $id_people);            
        }                
        if (!empty($description_customize)) {            
            $this->db->like("description_customize", $description_customize);            
        }

		$this->db->where("tbcustomize.status", '1');		                                
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
		
        return $this->db->get('tbcustomize');        
    }    
        
    function list_customize() {
        	        	
        $this->db->where('status', '1');
        return $this->db->get("tbcustomize");        
    }
              
}

