<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');


class M_evaluation extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function return_evaluation($id_evaluation = 0, $reg_initial = 0, $per_page = 0, $id_application = 0) {

        $this->db->select("tbevaluation.*, tbapplication.*, tbquestionnaries.*, 
        						tbpeople.*, tbevaluation.id_evaluation as id ");
		$this->db->join("tbapplication", "tbapplication.id_application = tbevaluation.id_application", 'LEFT');								
		$this->db->join("tbpeople", "tbpeople.id_people = tbevaluation.id_people", 'LEFT');
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbevaluation.id_questionnaries", 'LEFT');		
	               
        if ($id_evaluation != 0) {
            $this->db->where("tbevaluation.id_evaluation", $id_evaluation);
        }
        if ($id_application != 0) {
            $this->db->where("tbevaluation.id_application", $id_application);
        }
				
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }

        return $this->db->get("tbevaluation");	
	}

    function total_evaluation($id_application = 0){
                
        $this->db->select("COUNT(DISTINCT id_evaluation) as total_evaluation", FALSE);            
        if ($id_application != 0) {
            $this->db->where("tbevaluation.id_application", $id_application);
        }
        $this->db->where("status", '1');
		
        return $this->db->get("tbevaluation")->row()->total_evaluation;        
    }

    function save_evaluation() {
    
        $id_evaluation = $this->input->post("id_evaluation");
		$id_application = $this->input->post("list_application");
		$id_people = $this->input->post("list_people");
		$id_questionnaries = $this->input->post("list_questionnaries");		
		$id_order_questionnaries = $this->input->post("id_order_questionnaries");
		$name_evaluation = $this->input->post("name_evaluation");		            
        $dt_evaluation = $this->input->post("dt_evaluation");
		$note = $this->input->post("note");        						      
		
		if ($id_evaluation == 0) {
			$id = $this->m_setup->return_next_id('tbevaluation', 'id_evaluation');
		}					                      

		$dt_evl = substr($dt_evaluation, 6, 4) ."-". substr($dt_evaluation, 3, 2) ."-". substr($dt_evaluation, 0, 2);

        $data = array ( 
            	'id_evaluation' => ($id_evaluation == 0) ? $id : $id_evaluation,         
                'id_application' => $id_application,
                'id_questionnaries' => $id_questionnaries,                
                'id_people' => $id_people,
                'name_evaluation' => $name_evaluation,
                'dt_evaluation' => $dt_evl,
                'note' => $note
        );
                	            	                                
        if (!empty($id_evaluation) && $id_evaluation != 0){        
            $this->db->where("id_evaluation", $id_evaluation);
            
            if ($this->db->update("tbevaluation", $data)) { 
                return TRUE;
            } else {
	            return FALSE;            	
            }
			        
        } else {        	
            if ($this->db->insert("tbevaluation", $data)) { 
                return TRUE;
            } else {
            	return FALSE;
			}        
        }   
    }
       
    function delete($id_evaluation){

        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries

        $this->db->where("id_evaluation", $id_evaluation)->delete("tbevaluation");                
        $cod_db = $this->db->error(); 

        $this->db->db_debug = $db_debug; //restore setting

        if (! isset($cod_db['message'])) {
            return 0;            //TRUE;
        } else {
            return $cod_db['code'];      // FALSE;
        }
    }
 
 	function total_evaluation_filtered(){
                        
		$id_evaluation = $this->session->userdata("id_evaluation");
        $id_questionnaries = $this->session->userdata("id_questionnaries");
        $id_people = $this->session->userdata("id_people");
		$name_evaluation = $this->session->userdata("name_evaluation");

		if (!empty($id_questionnaries)) {            
//            $this->db->like("name_questionnaries", $id_questionnaries);            
			$array = $this->m_setup->return_array_id('tbquestionnaries', "name_questionnaries", 
									$id_questionnaries, "id_questionnaries");

            $this->db->where_in("tbevaluation.id_questionnaries", $array);
			$this->db->group_by("tbevaluation.id_evaluation, tbevaluation.id_questionnaries");                                    
        }        

        if (!empty($id_people)) {            
//            $this->db->like("name", $id_people);            
			$array = $this->m_setup->return_array_id('tbpeople', "name", $id_people, "id_people");

            $this->db->where_in("tbevaluation.id_people", $array);
			$this->db->group_by("tbevaluation.id_evaluation, tbevaluation.id_people");                                    
        }
		
        $this->db->select("tbevaluation.*, tbquestionnaries.*, tbevaluation.id_evaluation as id ");
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbevaluation.id_questionnaries", 'LEFT');
		$this->db->join("tbpeople", "tbpeople.id_people = tbevaluation.id_people", 'LEFT');
				
        $this->db->select("COUNT(DISTINCT id_evaluation) as total_evaluation", FALSE);                
          
        if (!empty($id_evaluation)) {            
            $this->db->where("id_evaluation", $id_evaluation);            
        }
        if (!empty($name_evaluation)) {            
            $this->db->like("name_evaluation", $name_evaluation);            
        }
 
        $this->db->where('tbevaluation.status', '1');        
        
        //return $this->db->get("tbevaluation")->row()->total_evaluation;
        $ret = $this->db->get('tbevaluation');
        
		$row = ($ret->num_rows() > 0) ? $ret->row()->total_evaluation : 1;		        
        return $row;
    }        
       
    function autocomplete($term)  {
               
        $this->db->select("id_evaluation, name_evaluation");
        $this->db->like("name_evaluation", $term);
        $this->db->order_by("name_evaluation desc");
        
        $consult = $this->db->get("tbevaluation");        
        return $consult;        
    }       

    function filter_evaluation($reg_initial = 0, $per_page = 0) {
        
        $id_evaluation = $this->session->userdata("id_evaluation");
        $id_questionnaries = $this->session->userdata("id_questionnaries");
        $id_people = $this->session->userdata("id_people");
		$name_evaluation = $this->session->userdata("name_evaluation");       

        $this->db->select("tbevaluation.*, tbquestionnaries.*, tbevaluation.id_evaluation as id ");
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbevaluation.id_questionnaries", 'LEFT');
		$this->db->join("tbpeople", "tbpeople.id_people = tbevaluation.id_people", 'LEFT');
		                                                           
        if (!empty($id_evaluation)) {            
            $this->db->where("id_evaluation", $id_evaluation);            
        }        
        if (!empty($id_questionnaries)) {            
            $this->db->like("id_questionnaries", $id_questionnaries);            
        }                
        if (!empty($id_people)) {            
            $this->db->like("name", $id_people);            
        }
        if (!empty($name_evaluation)) {            
            $this->db->like("name_evaluation", $name_evaluation);            
        }

		$this->db->where("tbevaluation.status", '1');		                                
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
		
        return $this->db->get('tbevaluation');        
    }    
        
    function list_evaluation() {
        	        	
        $this->db->where('status', '1');
        return $this->db->get("tbevaluation");        
    }
        
    function return_evaluation_candidate($id_application, $id_people, $id_questionnaires) {
 
		if ( (is_null($id_application) || $id_application == 0)
		 ||  (is_null($id_people) || $id_people == 0)
		 ||  (is_null($id_questionnaires) || $id_questionnaires == 0) ) {
		 	 return FALSE; /*$id_questionnaries = 0;*/ 
		 } 	
        
		$this->db->where("id_application", $id_application);
		$this->db->where("id_people", $id_people);
		$this->db->where("id_questionnaries", $id_questionnaires);							        	
        $this->db->where('status', '1');
		
		$this->db->where_not_in('id_situation', ' 1, 3, 6, 7, 8, 9 ');				
        $query = $this->db->get("tbevaluation")->result_array();
        
        if (count($query) > 0) {
        	return TRUE;
        } else {
        	return FALSE;	
        }						        
    }             

	function save_evaluation_candidate($data) {
	
        if ($this->db->insert("tbevaluation", $data)) { 
            return TRUE;
        } else {
        	return FALSE;
		}        		
	}
	
}

