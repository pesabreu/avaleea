<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');


class M_application extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function return_application($id_application = 0, $reg_initial = 0, $per_page = 0, $id_people = 0) {

        $this->db->select("tbapplication.*, tbquestionnaries.*, tbapplication_type.*, tbapplication_mode.*, 
        								tbpeople.*,	tbapplication.id_application as id ");
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbapplication.id_questionnaries", 'LEFT');
		$this->db->join("tbpeople", "tbpeople.id_people = tbapplication.id_people", 'LEFT');
		$this->db->join("tbapplication_type", "tbapplication_type.id_application_type = tbapplication.id_application_type", 'LEFT');
		$this->db->join("tbapplication_mode", "tbapplication_mode.id_application_mode = tbapplication.id_application_mode", 'LEFT');
	               
        if ($id_application != 0) {
            $this->db->where("tbapplication.id_application", $id_application);
        }
        if ($id_people != 0) {
            $this->db->where("tbapplication.id_people", $id_people);
        }

        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }

        return $this->db->get("tbapplication");	
	}

    function total_application($id_people = 0){
                
        $this->db->select("COUNT(DISTINCT id_application) as total_application", FALSE);            
        if ($id_people != 0) {
            $this->db->where("tbapplication.id_people", $id_people);
        }
        $this->db->where("status", '1');
		
        return $this->db->get("tbapplication")->row()->total_application;        
    }

    function save_application() {
    
        $id_application = $this->input->post("id_application");
		$id_questionnaries = $this->input->post("list_questionnaries");
		$id_people = $this->input->post("list_people");      
        $id_application_type = $this->input->post("list_application_type");      
        $id_application_mode = $this->input->post("list_application_mode");        						      
        $name_application = $this->input->post("name_application");
        $title_application = $this->input->post("title_application");
		$note = $this->input->post("note");
		
		if ($id_application == 0) {
			$id = $this->m_setup->return_next_id('tbapplication', 'id_application');
		}					                      

        $data = array ( 
            	'id_application' => ($id_application == 0) ? $id : $id_application,         
                'id_questionnaries' => $id_questionnaries,
                'id_people' => $id_people,
                'id_application_type' => $id_application_type,
                'id_application_mode' => $id_application_mode,
                'name_application' => $name_application,
                'title_application' => $title_application,
                'note' => $note                                                
        );
                	            	                                
        if (!empty($id_application) && $id_application != 0){        
            $this->db->where("id_application", $id_application);
            
            if ($this->db->update("tbapplication", $data)) { 
                return TRUE;
            } else {
	            return FALSE;            	
            }
			        
        } else {        	
            if ($this->db->insert("tbapplication", $data)) { 
                return TRUE;
            } else {
            	return FALSE;
			}        
        }   
    }
       
    function delete($id_application){

        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries

        $this->db->where("id_application", $id_application)->delete("tbapplication");                
        $cod_db = $this->db->error(); 

        $this->db->db_debug = $db_debug; //restore setting

        if (! isset($cod_db['message'])) {
            return 0;            //TRUE;
        } else {
            return $cod_db['code'];      // FALSE;
        }
    }
 
 	function total_application_filtered(){
                        
		$id_application = $this->session->userdata("id_application");
        $id_questionnaries = $this->session->userdata("id_questionnaries");
        $name_application = $this->session->userdata("name_application");
        $title_application = $this->session->userdata("title_application");

        if (!empty($id_questionnaries)) {            
//            $this->db->like("name_questionnaries", $id_questionnaries);            
			$array = $this->m_setup->return_array_id('tbquestionnaries', "name_questionnaries", 
									$id_questionnaries, "id_questionnaries");

            $this->db->where_in("tbapplication.id_questionnaries", $array);
			$this->db->group_by("tbapplication.id_application, tbapplication.id_questionnaries ");            
        }        

        $this->db->select("tbapplication.*, tbquestionnaries.*, tbapplication.id_application as id ");
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbapplication.id_questionnaries", 'LEFT');

        $this->db->select("COUNT(DISTINCT id_application) as total_application", FALSE);                
          
        if (!empty($id_application)) {            
            $this->db->where("id_application", $id_application);            
        }
        if (!empty($name_application)) {            
            $this->db->like("name_application", $name_application);            
        }        
        if (!empty($title_application)) {            
            $this->db->like("title_application", $title_application);            
        }
 
        $this->db->where('tbapplication.status', '1');        
        
        //return $this->db->get("tbapplication")->row()->total_application;
        $ret = $this->db->get('tbapplication');
        
		$row = ($ret->num_rows() > 0) ? $ret->row()->total_application : 1;		        
        return $row;
    }        
       
    function autocomplete($term)  {
               
        $this->db->select("id_application, name_application");
        $this->db->like("name_application", $term);
        $this->db->order_by("name_application desc");
        
        $consult = $this->db->get("tbapplication");        
        return $consult;        
    }       

    function filter_application($reg_initial = 0, $per_page = 0) {
        
        $id_application = $this->session->userdata("id_application");
        $id_questionnaries = $this->session->userdata("id_questionnaries");
        $name_application = $this->session->userdata("name_application");
        $title_application = $this->session->userdata("title_application");        

        $this->db->select("tbapplication.*, tbquestionnaries.*, tbapplication.id_application as id ");
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbapplication.id_questionnaries", 'LEFT');
                                                           
        if (!empty($id_application)) {            
            $this->db->where("id_application", $id_application);            
        }        
        if (!empty($id_questionnaries)) {            
            $this->db->like("id_questionnaries", $id_questionnaries);            
        }                
        if (!empty($name_application)) {            
            $this->db->like("name_application", $name_application);            
        }
        if (!empty($title_application)) {            
            $this->db->like("title_application", $title_application);            
        }               

		$this->db->where("tbapplication.status", '1');
		                                
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
		
        return $this->db->get('tbapplication');        
    }    
        
    function list_application() {
        	        	
        $this->db->where('status', '1');
        return $this->db->get("tbapplication");        
    }
                           
    function return_applications_people($id_people) {
    	
		if ($id_people == 0 || $id_people == "" || is_null($id_people)) {
			return FALSE;
		}
        	        	
        $this->db->where('status', '1');
		$this->db->where('id_people', $id_people);
		
        return $this->db->get("tbapplication");        
    }


	public function return_complete_data($id_application = 0) {

		if ($id_questionnaries == 0 or is_null($id_questionnaries)) { $id_questionnaries = 0; } 	
		
   		$this->db->select("tbapplication.*, tbapplication_mode.*, tbapplication_type.*,
    						tbcfg_application.*, tbapplication.id_application as id ");		

        $this->db->join("tbapplication_mode", "tbapplication_mode.id_application_mode = tbapplication.id_application_mode", 'LEFT');
		$this->db->join("tbapplication_type", "tbapplication_type.id_application_type = tbapplication.id_application_type", 'LEFT');    	
		$this->db->join("tbcfg_application", "tbcfg_application.id_application = tbapplication.id_application", 'LEFT');

        $this->db->where("tbapplication.id_application", $id_application);

        return $this->db->get("tbapplication")->result_array();							
	}
	
	public function return_data_view($id_application) {

		if ($id_application == 0 or is_null($id_application)) { return FALSE; } 	
		
   		$this->db->select("tbapplication.*, tbcfg_application.*, tbevaluation.*, tbquestionnaries.*,
   							tbquestions.*, tbanswers.*, tbapplication.id_application as id ");
		
		$this->db->join("tbcfg_application", "tbcfg_application.id_application = tbapplication.id_application", 'LEFT');
		$this->db->join("tbevaluation", "tbevaluation.id_application = tbapplication.id_application", 'LEFT');
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbevaluation.id_questionnaries", 'LEFT');						
		$this->db->join("tbquestions", "tbquestions.id_questionnaries = tbquestionnaries.id_questionnaries", 'LEFT');
		$this->db->join("tbanswers", "tbanswers.id_questions = tbquestions.id_questions", 'LEFT');

        $this->db->where("tbapplication.id_application", $id_application);
        $this->db->order_by("tbapplication.id_application asc, tbevaluation.id_evaluation, 
								tbquestionnaries.id_questionnaries asc, tbquestions.id_questions asc");

		$query = $this->db->get("tbapplication")->result_array();		              
        return $query;         
	}

	public function save_application_authors() {
		$id_application = $this->input->post("id_application");
				
        $id_people = $this->session->userdata("id_people_admin");		
				
		$id_application_type = $this->input->post("selectType");
		$id_application_mode = $this->input->post("selectApplicationmode");        
        $name_application = $this->input->post("name_application");
        $title_application = $this->input->post("title_application");
		$note = $this->input->post("note");
		
		if ($id_application == 0) {
			$id = $this->m_setup->return_next_id('tbapplication', 'id_application');
		}					                      

        $data = array ( 
            	'id_application' => ($id_application == 0) ? $id : $id_application,
                'id_people' => $id_people,            	         
                'id_application_type' => $id_application_type,
                'id_application_mode' => $id_application_mode,
                'name_application' => $name_application,
                'title_application' => $title_application,
                'note' => $note                                                
        );
                	            	                                
        if (! empty($id_application) && $id_application > 0){
        	
            $this->db->where("id_application", $id_application);
            
            if (! $this->db->update("tbapplication", $data)) {
	            return FALSE;            	
            }			        
        } else {			
            if (! $this->db->insert("tbapplication", $data)) {
	            return FALSE;            	
            }
        }   

		$id_applic = ($id_application == 0) ? $id : $id_application;

		if (! $this->save_cfg_client($id_applic)) {
			return FALSE;
		}

		if (! $this->save_application_questionnaires($id_applic)) {
			return FALSE;
		}
		
		return TRUE;					
	}

    function save_application_questionnaires($id_application) {
		
		if (! $this->delete_application_questionnaires($id_application)) {
			return FALSE;
		}
	
		$questionnaires = $this->input->post("selectQuestionnariesp");	
		$seq = 0;
		
		foreach ($questionnaires as $value) {
			$id = $this->m_setup->return_next_id('tbapplication_questionnaires', 'id_application_questionnaires');
		
	        $data = array ( 
		    	'id_application_questionnaires' => $id,
		    	'id_application' => $id_application,         
		        'id_questionnaires' => $value,	        
		        'sequential_in_application' => ++$seq,                                                
		        'dt_association' => date('Y-m-d'),	        	        
		        'note' => ''
	        );            	
            if (! $this->db->insert("tbapplication_questionnaires", $data)) {
/*        		echo "Merda...";		
				echo "<br /> <br />";
				echo "id ==> ". $value;
				//print_r($questionnaires);		
				echo "<br /> <br />";
				//exit;	
*/ 
            	return FALSE;
            }									
		}			
        return TRUE;
    }              
       
    function delete_application_questionnaires($id_application){

        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries

        $this->db->where("id_application", $id_application)->delete("tbapplication_questionnaires");                
        $cod_db = $this->db->error(); 

        $this->db->db_debug = $db_debug; //restore setting

        if (! isset($cod_db['message']) || $cod_db['code'] == 0) {
            return TRUE;            		// TRUE;
        } else {
            return FALSE;     // $cod_db['code'];     // FALSE;
        }
    }
 		
	public function return_questionnaries_application($id_application) {
		
		if (is_null($id_application) || $id_application == 0) { return FALSE; }
		
        $this->db->where("tbapplication_questionnaires.id_application", $id_application);

		$query = $this->db->get("tbapplication_questionnaires")->result_array();
		              
        return $query;         				
	}	
	
	public function return_application_candidate($id_application) {
        	
		if (is_null($id_application) || $id_application == 0) { return FALSE; }

   		$this->db->select("tbapplication.*, tbapplication_questionnaires.*, tbquestionnaries.*,
   							tbapplication.id_application as id ");
		
		$this->db->join("tbapplication_questionnaires", "tbapplication_questionnaires.id_application = tbapplication.id_application", 'LEFT');
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbapplication_questionnaires.id_questionnaires", 'LEFT');						

        $this->db->where("tbapplication.id_application", $id_application);
        $this->db->order_by("tbapplication.id_application asc, tbquestionnaries.id_questionnaries asc");

		$query = $this->db->get("tbapplication");		              
        return $query;         
	}
	
	public function return_data_candidate($id_application) {

		if (is_null($id_application) || $id_application == 0) { return FALSE; } 	
				
   		$this->db->select("tbapplication.*, tbcfg_application.*, tbapplication_questionnaires.*, 
			  				tbquestionnaries.*, tbcfg_questionnaries.*, tbapplication.id_application as id ");
				
		$this->db->join("tbcfg_application", "tbcfg_application.id_application = tbapplication.id_application", 'LEFT');
		$this->db->join("tbapplication_questionnaires", "tbapplication_questionnaires.id_application = tbapplication.id_application", 'LEFT');		
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbapplication_questionnaires.id_questionnaires", 'LEFT');						
		$this->db->join("tbcfg_questionnaries", "tbcfg_questionnaries.id_questionnaries = tbquestionnaries.id_questionnaries", 'LEFT');						

		$this->db->where("tbapplication.id_application", $id_application);
		$this->db->where("tbapplication.status", '1');

        $this->db->order_by("tbapplication.id_application asc, tbquestionnaries.id_questionnaries asc");

		$query = $this->db->get("tbapplication")->result_array();		              
		
        return $query;         
	}
		
/* 
***************************************************************************************************
*
*		Method of tbcfg_application
*  
***************************************************************************************************
*/

    function return_cfg_application($id_application = 0, $reg_initial = 0, $per_page = 0) {

        $this->db->select("tbcfg_application.*, tbapplication.*, tbcfg_application.id_cfg_application as id ");
		$this->db->join("tbapplication", "tbapplication.id_application = tbcfg_application.id_application", 'LEFT');	
	               
        if ($id_application != 0) {
            $this->db->where("tbcfg_application.id_application", $id_application);
        }
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }

  		return $this->db->get("tbcfg_application");	
	}

    function save_cfg_application() {
    		
    	$id_cfg_application = $this->input->post("id_cfg_application");
		$this->db->where("id_cfg_application", $id_cfg_application);		
		
		//$dt_application = $this->input->post("dt_application");
		//$dt_cfg = substr($dt_application, 6, 4) ."-". substr($dt_application, 3, 2) ."-". substr($dt_application, 0, 2);		
		
        $data = array ( 
	    	'id_cfg_application' => $id_cfg_application,         
	        'id_application' => $this->input->post("id_application"),
	        'dt_application' => $this->input->post("dt_application"),
	        'dt_finished' => $this->input->post("dt_finished"),
	        'quantity_evaluated' => $this->input->post("quantity_evaluated"),	        	        
	        'individual_group' => $this->input->post("list_individual_group"),	        
	        'confirm_id_pin' => $this->input->post("list_confirm_id_pin"),	        
	        'tolerance' => $this->input->post("list_tolerance"),
        );
                	            	                                
        if ($this->db->update("tbcfg_application", $data)) { 
            return TRUE;
        } else {
            return FALSE;            	
        }			        
    }                            

    function save_cfg_client($id_application) {
    		
    	$id_cfg_application = $this->input->post("id_cfg_applicationp");		
		if ($id_application == 0) {
			$id = $this->m_setup->return_next_id('tbcfg_application', 'id_cfg_application');
		}					                      
		
        $data = array ( 
	    	'id_cfg_application' => ($id_application == 0) ? $id : $id_application,
	    	'id_application' => $id_application,         
	        'dt_application' => $this->input->post("dt_application"),	        
	        'dt_finished' => $this->input->post("dt_finished"),                                                
	        'quantity_evaluated' => $this->input->post("quantity_evaluated"),	        	        
	        'individual_group' => $this->input->post("selectIndividualgroup"),
	        'confirm_id_pin' => $this->input->post("selectConfirmidpin"),
	        'tolerance' => $this->input->post("selectTolerance")
        );
                	            	                                
        if (!empty($id_cfg_application) && $id_cfg_application != 0){        
			$this->db->where("id_cfg_application", $id_cfg_application);		
            
            if (! $this->db->update("tbcfg_application", $data)) { 
	            return FALSE;            	
            }			        
        } else {     	
            	$this->db->insert("tbcfg_application", $data);
		} 
		
		$i = ($id_cfg_application == 0) ? $id : $id_cfg_application; 
		$this->session->set_userdata("id_application_save", $i);  
        return TRUE;
    }              

}

