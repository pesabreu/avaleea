<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');


class M_questions extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function return_questions($id_questions = 0, $reg_initial = 0, $per_page = 0, $id_questionnaries = 0) {

        $this->db->select("tbquestions.*, tbcfg_questions.*, tbquestionnaries.*, tbalternatives_type.*, 
        							tbsituation.*, tbquestions.id_questions as id ");
		$this->db->join("tbcfg_questions", "tbcfg_questions.id_questions = tbquestions.id_questions", 'LEFT');
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbquestions.id_questionnaries", 'LEFT');
		$this->db->join("tbalternatives_type", "tbalternatives_type.id_alternatives_type = tbquestions.id_alternatives_type", 'LEFT');
		$this->db->join("tbsituation", "tbsituation.id_situation = tbquestions.id_situation", 'LEFT');
	               
        if ($id_questions != 0) {
            $this->db->where("tbquestions.id_questions", $id_questions);
        }
        if ($id_questionnaries != 0) {
            $this->db->where("tbquestions.id_questionnaries", $id_questionnaries);
        }

        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }

        return $this->db->get("tbquestions");	
	}

    function total_questions($id_questionnaries = 0){
                
        $this->db->select("COUNT(DISTINCT id_questions) as total_questions", FALSE);            
        if ($id_questionnaries != 0) {
            $this->db->where("tbquestions.id_questionnaries", $id_questionnaries);
        }
        $this->db->where("status", '1');
		
        return $this->db->get("tbquestions")->row()->total_questions;        
    }

    function save_questions() {
    
        $id_questions = $this->input->post("id_questions");
		$id_questionnaries = $this->input->post("list_questionnaries");      
        $id_alternatives_type = $this->input->post("list_alternatives_type");      
        $id_situation = $this->input->post("list_situation");        						      
        $name_questions = $this->input->post("name_questions");
        $title_questions = $this->input->post("title_questions");
		$enunciation = $this->input->post("enunciation");
		$order_questionnaries = $this->input->post("order_questionnaries");
		
		if ($id_questions == 0) {
			$id = $this->m_setup->return_next_id('tbquestions', 'id_questions');
		}					                      

        $data = array ( 
            	'id_questions' => ($id_questions == 0) ? $id : $id_questions,         
                'id_questionnaries' => $id_questionnaries,
                'id_alternatives_type' => $id_alternatives_type,
                'id_situation' => $id_situation,
                'name_questions' => $name_questions,
                'title_questions' => $title_questions,
                'enunciation' => $enunciation,
                'order_questionnaries' => $order_questionnaries                                                
        );
                	            	                                
        if (!empty($id_questions) && $id_questions != 0){        
            $this->db->where("id_questions", $id_questions);
            
            if ($this->db->update("tbquestions", $data)) { 
                return TRUE;
            } else {
	            return FALSE;            	
            }
			        
        } else {        	
            if ($this->db->insert("tbquestions", $data)) { 
                return TRUE;
            } else {
            	return FALSE;
			}        
        }   
    }
       
    function delete($id_questions){

        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries

        $this->db->where("id_questions", $id_questions)->delete("tbquestions");                
        $cod_db = $this->db->error(); 

        $this->db->db_debug = $db_debug; //restore setting

        if (! isset($cod_db['message'])) {
            return 0;            //TRUE;
        } else {
            return $cod_db['code'];      // FALSE;
        }
    }
 
 	function total_questions_filtered(){
                        
		$id_questions = $this->session->userdata("id_questions");
        $id_questionnaries = $this->session->userdata("id_questionnaries");
        $name_questions = $this->session->userdata("name_questions");
        $enunciation = $this->session->userdata("enunciation");

        if (!empty($id_questionnaries)) {            
//            $this->db->like("id_questionnaries", $id_questionnaries);            
			$array = $this->m_setup->return_array_id('tbquestionnaries', "name_questionnaries", 
															$id_questionnaries, "id_questionnaries");

            $this->db->or_where_in("tbquestions.id_questionnaries", $array);
			$this->db->group_by("tbquestions.id_modules, tbquestions.id_questionnaries");                        
        }                

        $this->db->select("tbquestions.*, tbquestionnaries.*, tbquestions.id_questions as id ");
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbquestions.id_questionnaries", 'LEFT');
		
        $this->db->select("COUNT(DISTINCT id_questions) as total_questions", FALSE);                
          
        if (!empty($id_questions)) {            
            $this->db->where("id_questions", $id_questions);            
        }
        if (!empty($name_questions)) {            
            $this->db->like("name_questions", $name_questions);            
        }        
        if (!empty($enunciation)) {            
            $this->db->like("enunciation", $enunciation);            
        }
 
        $this->db->where('tbquestions.status', '1');        
        
        //return $this->db->get("tbquestions")->row()->total_questions;        
        $ret = $this->db->get('tbquestions');
        
		$row = ($ret->num_rows() > 0) ? $ret->row()->total_questions : 1;		        
        return $row;
    }        
       
    function autocomplete($term)  {
               
        $this->db->select("id_questions, name_questions");
        $this->db->like("name_questions", $term);
        $this->db->order_by("name_questions desc");
        
        $consult = $this->db->get("tbquestions");        
        return $consult;        
    }       

    function filter_questions($reg_initial = 0, $per_page = 0) {
        
        $id_questions = $this->session->userdata("id_questions");
        $id_questionnaries = $this->session->userdata("id_questionnaries");
        $name_questions = $this->session->userdata("name_questions");
        $enunciation = $this->session->userdata("enunciation");        

        $this->db->select("tbquestions.*, tbquestionnaries.*, tbquestions.id_questions as id ");
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbquestions.id_questionnaries", 'LEFT');
                                                           
        if (!empty($id_questions)) {            
            $this->db->where("id_questions", $id_questions);            
        }        
        if (!empty($id_questionnaries)) {            
            $this->db->like("id_questionnaries", $id_questionnaries);
		}		
        if (!empty($name_questions)) {            
            $this->db->like("name_questions", $name_questions);            
        }
        if (!empty($enunciation)) {            
            $this->db->like("enunciation", $enunciation);            
        }               

		$this->db->where("tbquestions.status", '1');
		                                
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
		
        return $this->db->get('tbquestions');        
    }    
        
    function list_questions() {
        	        	
        $this->db->where('status', '1');
        return $this->db->get("tbquestions");        
    }

    function return_questions_completed($id_questionnaries) {
    	
		if ($id_questionnaries == 0) { return FALSE; }		

        $this->db->select("tbquestions.*, tbalternatives.*, tbquestions.id_questions as id ");
		$this->db->join("tbalternatives", "tbalternatives.id_questions = tbquestions.id_questions", 'LEFT');
        
        $this->db->where("tbquestions.id_questionnaries", $id_questionnaries);
        $this->db->order_by("tbquestions.id_questions ASC, tbalternatives.id_alternatives ASC");
        
        return $this->db->get("tbquestions");	
    }   

	public function return_complete_data($id_questions = 0) {

		if ($id_questions == 0 or is_null($id_questions)) { $id_questions = 0; } 	
		
    	$this->db->select("tbquestions.*, tbalternatives_type.*, tbsituation.*, tbcfg_questions.*, 
    						tbpresentation_type.*, tbmandatory_answers.*,
    						tbquestions.id_questions, tbquestions.id_questions as id ");

        $this->db->join("tbalternatives_type", "tbalternatives_type.id_alternatives_type = tbquestions.id_alternatives_type", 'LEFT');
		$this->db->join("tbsituation", "tbsituation.id_situation = tbquestions.id_situation", 'LEFT');   	
		$this->db->join("tbcfg_questions", "tbcfg_questions.id_questions = tbquestions.id_questions", 'LEFT');
		$this->db->join("tbpresentation_type", "tbpresentation_type.id_presentation_type = tbcfg_questions.id_presentation_type", 'LEFT');
		$this->db->join("tbmandatory_answers", "tbmandatory_answers.id_mandatory_answers = tbcfg_questions.id_mandatory_answers", 'LEFT');        				

        $this->db->where("tbquestions.id_questions", $id_questions);

		$query = $this->db->get("tbquestions")->result_array();

        return $query;          
        //return $this->db->get("tbquestionnaries")->result_array();							
	}

	public function save_questions_authors() {

		$id_questionnaries = $this->input->post("id_questionnariesq");
		$id_questions = $this->input->post("id_questions");		
        $id_people = $this->session->userdata("id_people_admin");		
        
        $id_alternatives_type = $this->input->post("selectAlternativestype");      
        $id_situation = $this->input->post("selectSituationq");        						      
        $name_questions = $this->input->post("name_questions");
        $title_questions = $this->input->post("title_questions");
		$enunciation = $this->input->post("enunciation");
		$order_questionnaries = $this->input->post("order_questionnaries");

		if ($id_questions == 0) {					
			$id = $this->m_setup->return_next_id('tbquestions', 'id_questions');
		}					                      

        $data = array ( 
            	'id_questions' => ($id_questions == 0) ? $id : $id_questions,         
                'id_questionnaries' => $id_questionnaries,
                'id_alternatives_type' => $id_alternatives_type,
                'id_situation' => $id_situation,
                'name_questions' => $name_questions,
                'title_questions' => $title_questions,
                'enunciation' => $enunciation,
                'order_questionnaries' => $order_questionnaries                                                
        );
                	            	                                
        if (!empty($id_questions) && $id_questions != 0){
            $this->db->where("id_questions", $id_questions);
            
            if (! $this->db->update("tbquestions", $data)) { 
	            return FALSE;            	
            }			        
        } else {        	
            if (! $this->db->insert("tbquestions", $data)) { 
            	return FALSE;
			}        
        }

		$id_quest = ($id_questions == 0) ? $id : $id_questions;

		if ($this->save_cfg_client($id_quest)) {
			return TRUE;
		} else {
			return FALSE;
		}				   
	}



/* 
***************************************************************************************************
*
*		Method of tbcfg_questions
*  
***************************************************************************************************
*/

    function return_cfg_questions($id_questions = 0, $reg_initial = 0, $per_page = 0) {

        $this->db->select("tbcfg_questions.*, tbquestions.*, tbpresentation_type.*, 
       				tbmandatory_answers.*, tbcfg_questions.id_cfg_questions as id ");
		$this->db->join("tbquestions", "tbquestions.id_questions = tbcfg_questions.id_questions", 'LEFT');	
		$this->db->join("tbpresentation_type", "tbpresentation_type.id_presentation_type = tbcfg_questions.id_presentation_type", 'LEFT');		
		$this->db->join("tbmandatory_answers", "tbmandatory_answers.id_mandatory_answers = tbcfg_questions.id_mandatory_answers", 'LEFT');
	               
        if ($id_questions != 0) {
            $this->db->where("tbcfg_questions.id_questions", $id_questions);
        }
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }

  		return $this->db->get("tbcfg_questions");	
	}

    function save_cfg_questions() {
    		
    	$id_cfg_questions = $this->input->post("id_cfg_questions");
		$this->db->where("id_cfg_questions", $id_cfg_questions);		
		
        $data = array ( 
	    	'id_cfg_questions' => $id_cfg_questions,         
	        'id_questions' => $this->input->post("id_questions"),
	        'weight' => $this->input->post("weight"),
	        'time_duration' => $this->input->post("time_duration"),	        	        
	        'quantity_alternatives' => $this->input->post("quantity_alternatives"),	        
	        'id_presentation_type' => $this->input->post("list_presentation_type"),
	        'allows_modify_response' => $this->input->post("list_allows_modify_response"),
	        'id_mandatory_answers' => $this->input->post("list_mandatory_answers"),
	        'editable' => $this->input->post("list_editable")
        );
                	            	                                
        if ($this->db->update("tbcfg_questions", $data)) { 
            return TRUE;
        } else {
            return FALSE;            	
        }			        
    }              

    function save_cfg_client($id_questions) {
    		
    	$id_cfg_questions = $this->input->post("id_cfg_questions");		
		if ($id_cfg_questions == 0) {
			$id = $id_questions;    // $this->m_setup->return_next_id('tbcfg_questions', 'id_cfg_questions');
		}					                      
		
        $data = array ( 
	    	'id_cfg_questions' => ($id_cfg_questions == 0) ? $id : $id_cfg_questions,         
	        'id_questions' => $id_questions,
	        'weight' => $this->input->post("selectWeight"),
	        'time_duration' => $this->input->post("time_durationq"),                
	        'quantity_alternatives' => $this->input->post("quantity_alternatives"),	                                                      
	        'id_presentation_type' => $this->input->post("selectPresentationtype"),	        
	        'allows_modify_response' => $this->input->post("selectAllowsmodifyresponse"),
	        'id_mandatory_answers' => $this->input->post("selectMandatoryanswers"),
	        'editable' => $this->input->post("selectEditable")
        );
                	            	                                
        if (!empty($id_questions) && $id_questions != 0){        
			$this->db->where("id_cfg_questions", $id_cfg_questions);		
            
            if (! $this->db->update("tbcfg_questions", $data)) { 
	            return FALSE;            	
            }			        
        } else {
        	try {        	
            	$this->db->insert("tbcfg_questions", $data);
			} catch (Exception $e) {
		    	echo 'Exceção capturada cfg Questions : ',  $e->getMessage(), "\n";
			} 
        } 
		
		$i = ($id_cfg_questions == 0) ? $id : $id_cfg_questions; 
		$this->session->set_userdata("id_questions_save", $i);  
        return TRUE;
    }              
              
}

