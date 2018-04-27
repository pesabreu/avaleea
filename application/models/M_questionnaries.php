<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');


class M_questionnaries extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function return_questionnaries($id_questionnaries = 0, $reg_initial = 0, $per_page = 0, $id_people = 0) {
        	
       	$this->db->select("tbquestionnaries.*, tbmodules.*, tbquestionnaries_type.*, tbalternatives_type.*,  
        				tblevel_type.*, tbpeople.*,	tbsituation.*, tbquestionnaries.id_questionnaries as id ");
        
        $this->db->join("tbmodules", "tbmodules.id_modules = tbquestionnaries.id_modules", 'LEFT');
		$this->db->join("tbquestionnaries_type", "tbquestionnaries_type.id_questionnaries_type = tbquestionnaries.id_questionnaries_type", 'LEFT');
		$this->db->join("tbalternatives_type", "tbalternatives_type.id_alternatives_type = tbquestionnaries.id_alternatives_type", 'LEFT');
		$this->db->join("tblevel_type", "tblevel_type.id_level_type = tbquestionnaries.id_level_type", 'LEFT');
		$this->db->join("tbpeople", "tbpeople.id_people = tbquestionnaries.id_people", 'LEFT');
		$this->db->join("tbsituation", "tbsituation.id_situation = tbquestionnaries.id_situation", 'LEFT');
	               
        if ($id_questionnaries != 0) {						
            $this->db->where("tbquestionnaries.id_questionnaries", $id_questionnaries);
        }
        if ($id_people != 0) {
            $this->db->where("tbquestionnaries.id_people", $id_people);
        }
        
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
                        
        return $this->db->get("tbquestionnaries");	
	}

    function total_questionnaries($id_people = 0){
                
        $this->db->select("COUNT(DISTINCT id_questionnaries) as total_questionnaries", FALSE);            
        
        if ($id_people != 0) {
            $this->db->where("tbquestionnaries.id_people", $id_people);
        }        
        $this->db->where("status", '1');
		
        return $this->db->get("tbquestionnaries")->row()->total_questionnaries;        
    }

    function save_questionnaries() {
    
        $id_questionnaries = $this->input->post("id_questionnaries");
		$id_questionnaries_type = $this->input->post("list_questionnaries_type");
		$id_modules = $this->input->post("list_modules");        
        $id_alternatives_type = $this->input->post("list_alternatives_type");
        $id_level_type = $this->input->post("list_level_type");        
        $id_people = $this->input->post("list_people");
        $id_situation = $this->input->post("list_situation");        						      
        $name_questionnaries = $this->input->post("name_questionnaries");
        $title_questionnaries = $this->input->post("title_questionnaries");
		$description_questionnaries = $this->input->post("description_questionnaries");
		$instructions_questionnaries = $this->input->post("instructions_questionnaries");
		$order_module_questionnaries = $this->input->post("order_module_questionnaries");
		$dt_creation = $this->input->post("dt_creation");
		$series_semester = $this->input->post("series_semester");						
		
		if ($id_questionnaries == 0) {
			$id = $this->m_setup->return_next_id('tbquestionnaries', 'id_questionnaries');
		}					                      
		$dt_cr = substr($dt_creation, 6, 4) ."-". substr($dt_creation, 3, 2) ."-". substr($dt_creation, 0, 2);

        $data = array ( 
            	'id_questionnaries' => ($id_questionnaries == 0) ? $id : $id_questionnaries,         
                'id_questionnaries_type' => $id_questionnaries_type,
                'id_modules' => $id_modules,
                'id_alternatives_type' => $id_alternatives_type,
                'id_level_type' => $id_level_type,
                'id_situation' => $id_situation,
                'id_people' => $id_people,
                'name_questionnaries' => $name_questionnaries,
                'title_questionnaries' => $title_questionnaries,
                'description_questionnaries' => $description_questionnaries,
                'instructions_questionnaries' => $instructions_questionnaries,
                'order_module_questionnaries' => $order_module_questionnaries,
                'dt_creation' => $dt_cr,
                'series_semester' => $series_semester                                                
        );
                	            	                                
        if (!empty($id_questionnaries) && $id_questionnaries != 0){        
            $this->db->where("id_questionnaries", $id_questionnaries);
            
            if ($this->db->update("tbquestionnaries", $data)) { 
                return TRUE;
            } else {
	            return FALSE;            	
            }
			        
        } else {        	
            if ($this->db->insert("tbquestionnaries", $data)) { 
                return TRUE;
            } else {
            	return FALSE;
			}        
        }   
    }
       
    function delete($id_questionnaries){

        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries

        $this->db->where("id_questionnaries", $id_questionnaries)->delete("tbquestionnaries");                
        $cod_db = $this->db->error(); 

        $this->db->db_debug = $db_debug; //restore setting

        if (! isset($cod_db['message'])) {
            return 0;            //TRUE;
        } else {
            return $cod_db['code'];      // FALSE;
        }
    }
 
 	function total_questionnaries_filtered(){
                        
		$id_questionnaries = $this->session->userdata("id_questionnaries");
        $id_questionnaries_type = $this->session->userdata("id_questionnaries_type");
        $id_modules = $this->session->userdata("id_modules");
        $name_questionnaries = $this->session->userdata("name_questionnaries");
		
        if (!empty($id_questionnaries_type)) {            		           
//            $this->db->like("code_questionnaries_type", $id_questionnaries_type);
			$array = $this->m_setup->return_array_id('tbquestionnaries_type', "code_questionnaries_type", 
									$id_questionnaries_type, "id_questionnaries_type");

            $this->db->where_in("tbquestionnaries.id_questionnaries_type", $array);
			$this->db->group_by("tbquestionnaries.id_questionnaries, tbquestionnaries.id_questionnaries_type ");            
        }
		        
        if (!empty($id_modules)) {            
//            $this->db->like("questionnaries.id_modules", $id_modules);            
			$array = $this->m_setup->return_array_id('tbmodules', "name_modules", 
									$id_modules, "id_modules");

            $this->db->where_in("tbquestionnaries.id_modules", $array);
			$this->db->group_by("tbquestionnaries.id_questionnaries, tbquestionnaries.id_modules");                                    
        }        

        $this->db->select("tbquestionnaries.*, tbmodules.*, tbquestionnaries_type.* ");
        $this->db->join("tbmodules", "tbmodules.id_modules = tbquestionnaries.id_modules", 'LEFT');
		$this->db->join("tbquestionnaries_type", "tbquestionnaries_type.id_questionnaries_type = tbquestionnaries.id_questionnaries_type", 'LEFT');
		
        $this->db->select("COUNT(DISTINCT id_questionnaries) as total_questionnaries", FALSE);                
          
        if (!empty($id_questionnaries)) {            
            $this->db->where("id_questionnaries", $id_questionnaries);            
        }
        if (!empty($name_questionnaries)) {            
            $this->db->like("name_questionnaries", $name_questionnaries);
			$this->db->group_by("tbquestionnaries.id_questionnaries, tbquestionnaries.name_questionnaries");                        
        }
 
        $this->db->where('tbquestionnaries.status', '1');        
        
        //return $this->db->get("tbquestionnaries")->row()->total_questionnaries;
        $ret = $this->db->get('tbquestionnaries');
        
		$row = ($ret->num_rows() > 0) ? $ret->row()->total_questionnaries : 1;		        
        return $row;
		
		//$query = $this->db->get("tbquestionnaries")->row()->total_questionnaries;
		//echo $this->db->last_query();
		//exit();
    }        
       
    function autocomplete($term)  {
               
        $this->db->select("id_questionnaries, name_questionnaries");
        $this->db->like("name_questionnaries", $term);
        $this->db->order_by("name_questionnaries desc");
        
        $consult = $this->db->get("tbquestionnaries");        
        return $consult;        
    }       

    function filter_questionnaries($reg_initial = 0, $per_page = 0) {
        
        $id_questionnaries = $this->session->userdata("id_questionnaries");
        $id_questionnaries_type = $this->session->userdata("id_questionnaries_type");
        $id_modules = $this->session->userdata("id_modules");
        $name_questionnaries = $this->session->userdata("name_questionnaries");        

        $this->db->select("tbquestionnaries.*, tbmodules.*, tbquestionnaries_type.* ");
        $this->db->join("tbmodules", "tbmodules.id_modules = tbquestionnaries.id_modules", 'LEFT');
		$this->db->join("tbquestionnaries_type", "tbquestionnaries_type.id_questionnaries_type = tbquestionnaries.id_questionnaries_type", 'LEFT');
                                                           
        if (!empty($id_questionnaries)) {            
            $this->db->where("id_questionnaries", $id_questionnaries);            
        }
        if (!empty($id_questionnaries_type)) {            
            $this->db->like("code_questionnaries_type", $id_questionnaries_type);
        }                
        if (!empty($id_modules)) {            
            $this->db->like("name_modules", $id_modules);            
        }                        
        if (!empty($name_questionnaries)) {            
            $this->db->like("name_questionnaries", $name_questionnaries);            
        }               

		$this->db->where("tbquestionnaries.status", '1');
		                                
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
		
        return $this->db->get('tbquestionnaries');        
    }    
        
    function list_questionnaries() {
        	        	
        $this->db->where('status', '1');
        return $this->db->get("tbquestionnaries");        
    }
              
    function return_questionnaries_people($id_people) {
    	
		if ($id_people == 0 || $id_people == "" || is_null($id_people)) {
			return FALSE;
		}
        	        	
        $this->db->where('status', '1');
		$this->db->where('id_people', $id_people);
		
        return $this->db->get("tbquestionnaries");        
    }

	public function return_complete_data($id_questionnaries = 0) {

		if ($id_questionnaries == 0 or is_null($id_questionnaries)) { return FALSE; /*$id_questionnaries = 0;*/ } 	
		
   		$this->db->select("tbquestionnaries.*, tbmodules.*, tbquestionnaries_type.*, tbalternatives_type.*,  
    				tblevel_type.*, tbpeople.*,	tbsituation.*, tbquestionnaries.id_questionnaries as id, 
    				tbcfg_questionnaries.*, tbpresentation_type.*, tballows_interrupt.*, tballows_navigate.*, 
    				tbmandatory_answers.*, tbflow_issues.* ");		

        $this->db->join("tbmodules", "tbmodules.id_modules = tbquestionnaries.id_modules", 'LEFT');
		$this->db->join("tbquestionnaries_type", "tbquestionnaries_type.id_questionnaries_type = tbquestionnaries.id_questionnaries_type", 'LEFT');
		$this->db->join("tbalternatives_type", "tbalternatives_type.id_alternatives_type = tbquestionnaries.id_alternatives_type", 'LEFT');
		$this->db->join("tblevel_type", "tblevel_type.id_level_type = tbquestionnaries.id_level_type", 'LEFT');
		$this->db->join("tbpeople", "tbpeople.id_people = tbquestionnaries.id_people", 'LEFT');
		$this->db->join("tbsituation", "tbsituation.id_situation = tbquestionnaries.id_situation", 'LEFT');
    	
		$this->db->join("tbcfg_questionnaries", "tbcfg_questionnaries.id_questionnaries = tbquestionnaries.id_questionnaries", 'LEFT');
		$this->db->join("tbpresentation_type", "tbpresentation_type.id_presentation_type = tbcfg_questionnaries.id_presentation_type", 'LEFT');
		$this->db->join("tballows_interrupt", "tballows_interrupt.id_allows_interrupt = tbcfg_questionnaries.id_allows_interrupt", 'LEFT');        	
		$this->db->join("tballows_navigate", "tballows_navigate.id_allows_navigate = tbcfg_questionnaries.id_allows_navigate", 'LEFT');        	
		$this->db->join("tbmandatory_answers", "tbmandatory_answers.id_mandatory_answers = tbcfg_questionnaries.id_mandatory_answers", 'LEFT');        				
		$this->db->join("tbflow_issues", "tbflow_issues.id_flow_issues = tbcfg_questionnaries.id_flow_issues", 'LEFT');        	

        $this->db->where("tbquestionnaries.id_questionnaries", $id_questionnaries);
		$this->db->where("tbquestionnaries.status", '1');

		$query = $this->db->get("tbquestionnaries")->result_array();
		//print_r($query);
		//echo "<br /><br /><br />";
		//echo $this->db->last_query();  
		//exit;
		              
        return $query;         
        //return $this->db->get("tbquestionnaries")->result_array();							
	}
	
	public function return_data_view($id_questionnaries) {

		if ($id_questionnaries == 0 or is_null($id_questionnaries)) { return FALSE; } 	
		
   		$this->db->select("tbquestionnaries.*, tbquestions.*, tbalternatives.*,
   								 tbquestionnaries.id_questionnaries as id ");
		
		$this->db->join("tbquestions", "tbquestions.id_questionnaries = tbquestionnaries.id_questionnaries", 'LEFT');
		$this->db->join("tbalternatives", "tbalternatives.id_questions = tbquestions.id_questions", 'LEFT');

        $this->db->where("tbquestionnaries.id_questionnaries", $id_questionnaries);

		$query = $this->db->get("tbquestionnaries")->result_array();
		//print_r($query);
		//echo "<br /><br /><br />";
		//echo $this->db->last_query();  
		//exit;
		              
        return $query;         
        //return $this->db->get("tbquestionnaries")->result_array();							
	}
	
	public function save_questionnaries_authors() {

		$id_questionnaries = $this->input->post("id_questionnaries");		
        $id_people = $this->session->userdata("id_people_admin");		
				
		$id_questionnaries_type = $this->input->post("selectType");
		$id_modules = $this->input->post("selectModules");        
        $id_alternatives_type = $this->input->post("selectTypeAlternatives");
        $name_questionnaries = $this->input->post("name_questionnaries");
        $title_questionnaries = $this->input->post("title_questionnaries");
		$description_questionnaries = $this->input->post("description_questionnaries");
		$instructions_questionnaries = $this->input->post("instructions_questionnaries");
		$order_module_questionnaries = $this->input->post("order_module_questionnaries");		
        $id_level_type = $this->input->post("selectLeveltype");        
        $id_situation = $this->input->post("selectSituation");        						      
		$dt_creation = $this->input->post("dt_creation");
		$series_semester = $this->input->post("selectSeriessemester");								
		
		if ($id_questionnaries == 0) {
			$id = $this->m_setup->return_next_id('tbquestionnaries', 'id_questionnaries');
		}					                      

        $data = array ( 
            	'id_questionnaries' => ($id_questionnaries == 0) ? $id : $id_questionnaries,
                'id_people' => $id_people,            	         
                'id_questionnaries_type' => $id_questionnaries_type,
                'id_modules' => $id_modules,
                'id_alternatives_type' => $id_alternatives_type,
                'id_level_type' => $id_level_type,
                'id_situation' => $id_situation,
                'name_questionnaries' => $name_questionnaries,
                'title_questionnaries' => $title_questionnaries,
                'description_questionnaries' => $description_questionnaries,
                'instructions_questionnaries' => $instructions_questionnaries,
                'order_module_questionnaries' => $order_module_questionnaries,
                'dt_creation' => (trim($dt_creation) == "" ? date('Y-m-d') : $dt_creation),
                'series_semester' => $series_semester                                                
        );
                	            	                                
        if (!empty($id_questionnaries) && $id_questionnaries != 0){        
            $this->db->where("id_questionnaries", $id_questionnaries);
            
            if (! $this->db->update("tbquestionnaries", $data)) {
	            return FALSE;            	
            }
			        
        } else {
        	
	        try {
	            $this->db->insert("tbquestionnaries", $data);
			} catch (Exception $e) {
			    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
			} 
        }   

		$id_quest = ($id_questionnaries == 0) ? $id : $id_questionnaries;

		if ($this->save_cfg_client($id_quest)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function return_application_candidate($id_application) {
        	
		if (is_null($id_application) || $id_application == 0) { return FALSE; }

   		$this->db->select("tbapplication.*, tbquestionnaries.*,
   							tbapplication.id_application as id ");
		
		$this->db->join("tbapplication_questionnaires", "tbapplication_questionnaires.id_application = tbapplication.id_application", 'LEFT');
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbapplication_questionnaires.id_questionnaires", 'LEFT');						

        $this->db->where("tbapplication.id_application", $id_application);
        $this->db->order_by("tbapplication.id_application asc, tbquestionnaries.id_questionnaries asc");

		$query = $this->db->get("tbapplication");		              
		
        return $query;         
	}
		           
/* 
***************************************************************************************************
*
*		Method of tbcfg_questionnaries
*  
***************************************************************************************************
*/

    function return_cfg_questionnaries($id_questionnaries = 0, $reg_initial = 0, $per_page = 0) {

        $this->db->select("tbcfg_questionnaries.*, tbquestionnaries.*, tbpresentation_type.*, tballows_interrupt.*, 
			tballows_navigate.*, tbmandatory_answers.*,	tbflow_issues.*, tbcfg_questionnaries.id_cfg_questionnaries as id ");
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbcfg_questionnaries.id_questionnaries", 'LEFT');	
		$this->db->join("tbpresentation_type", "tbpresentation_type.id_presentation_type = tbcfg_questionnaries.id_presentation_type", 'LEFT');		
		$this->db->join("tballows_interrupt", "tballows_interrupt.id_allows_interrupt = tbcfg_questionnaries.id_allows_interrupt", 'LEFT');
		$this->db->join("tballows_navigate", "tballows_navigate.id_allows_navigate = tbcfg_questionnaries.id_allows_navigate", 'LEFT');
		$this->db->join("tbmandatory_answers", "tbmandatory_answers.id_mandatory_answers = tbcfg_questionnaries.id_mandatory_answers", 'LEFT');
		$this->db->join("tbflow_issues", "tbflow_issues.id_flow_issues = tbcfg_questionnaries.id_flow_issues", 'LEFT');
	               
        if ($id_questionnaries != 0) {
            $this->db->where("tbcfg_questionnaries.id_questionnaries", $id_questionnaries);
        }
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }

        //$query = $this->db->get("tbcfg_questionnaries");
        //echo $this->db->last_query();
  		//exit();              

  		return $this->db->get("tbcfg_questionnaries");	
	}

    function save_cfg_questionnaries() {
    		
    	$id_cfg_questionnaries = $this->input->post("id_cfg_questionnaries");
		$this->db->where("id_cfg_questionnaries", $id_cfg_questionnaries);		
		
        $data = array ( 
	    	'id_cfg_questionnaries' => $id_cfg_questionnaries,         
	        'id_questionnaries' => $this->input->post("id_questionnaries"),
	        'who_customize' => $this->input->post("list_who_customize"),
	        'id_presentation_type' => $this->input->post("list_presentation_type"),
	        'time_duration' => $this->input->post("time_duration"),
	        'id_allows_interrupt' => $this->input->post("list_allows_interrupt"),
	        'id_allows_navigate' => $this->input->post("list_allows_navigate"),
	        'id_mandatory_answers' => $this->input->post("list_mandatory_answers"),
	        'id_flow_issues' => $this->input->post("list_flow_issues"),                
	        'quantity_issues' => $this->input->post("quantity_issues"),
	        'form_market' => $this->input->post("form_market")                                                
        );
                	            	                                
        if ($this->db->update("tbcfg_questionnaries", $data)) { 
            return TRUE;
        } else {
            return FALSE;            	
        }			        
    }              

    function save_cfg_client($id_questionnaries) {
    		
    	$id_cfg_questionnaries = $this->input->post("id_cfg_questionnaries");		
		if ($id_cfg_questionnaries == 0) {
			$id = $this->m_setup->return_next_id('tbcfg_questionnaries', 'id_cfg_questionnaries');
		}					                      
		
        $data = array ( 
	    	'id_cfg_questionnaries' => ($id_cfg_questionnaries == 0) ? $id : $id_cfg_questionnaries,         
	        'id_questionnaries' => $id_questionnaries,
	        'who_customize' => $this->input->post("selectWhocustomize"),
	        'form_market' => $this->input->post("selectFormmarket"),                                                
	        'id_presentation_type' => $this->input->post("selectPresentationtype"),	        
	        'id_allows_interrupt' => $this->input->post("selectAllowsinterrupt"),
	        'id_allows_navigate' => $this->input->post("selectAllowsnavigate"),
	        'id_mandatory_answers' => $this->input->post("selectMandatoryanswers"),
	        'id_flow_issues' => $this->input->post("selectFlowissues"),
	        'time_duration' => $this->input->post("time_duration"),                
	        'quantity_issues' => $this->input->post("quantity_issues")
        );
                	            	                                
        if (!empty($id_cfg_questionnaries) && $id_cfg_questionnaries != 0){        
			$this->db->where("id_cfg_questionnaries", $id_cfg_questionnaries);		
            
            if (! $this->db->update("tbcfg_questionnaries", $data)) { 
	            return FALSE;            	
            }
			        
        } else {
        	try {        	
            	$this->db->insert("tbcfg_questionnaries", $data);
			} catch (Exception $e) {
		    	echo 'Exceção capturada cfg : ',  $e->getMessage(), "\n";
			} 
        } 
		
		$i = ($id_cfg_questionnaries == 0) ? $id : $id_cfg_questionnaries; 
		$this->session->set_userdata("id_questionnaries_save", $i);  
        return TRUE;
    }              
              
}

