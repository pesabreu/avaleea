<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');


class M_answers extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function return_answers($id_answers = 0, $reg_initial = 0, $per_page = 0, $id_evaluation = 0) {

        $this->db->select("tbanswers.*, tbevaluation.*, tbquestions.*, 
        						tbanswers.id_answers as id ");
		$this->db->join("tbevaluation", "tbevaluation.id_evaluation = tbanswers.id_evaluation", 'LEFT');								
		$this->db->join("tbquestions", "tbquestions.id_questions = tbanswers.id_questions", 'LEFT');		
	               
        if ($id_answers != 0) {
            $this->db->where("tbanswers.id_answers", $id_answers);
        }
        if ($id_evaluation != 0) {
            $this->db->where("tbanswers.id_evaluation", $id_evaluation);
        }
		
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }

        return $this->db->get("tbanswers");	
	}

    function total_answers($id_evaluation = 0){
                
        $this->db->select("COUNT(DISTINCT id_answers) as total_answers", FALSE);            
        if ($id_evaluation != 0) {
            $this->db->where("tbanswers.id_evaluation", $id_evaluation);
        }		
        $this->db->where("status", '1');
		
        return $this->db->get("tbanswers")->row()->total_answers;        
    }

    function save_answers() {
    
        $id_answers = $this->input->post("id_answers");
		$id_evaluation = $this->input->post("list_evaluation");
		$id_questions = $this->input->post("list_questions");
		$id_alternative_select = $this->input->post("id_alternative_select");            
        $answer = $this->input->post("answer");
		$note = $this->input->post("note");        						      
		
		if ($id_answers == 0) {
			$id = $this->m_setup->return_next_id('tbanswers', 'id_answers');
		}					                      

		$dt_evl = substr($dt_answers, 6, 4) ."-". substr($dt_answers, 3, 2) ."-". substr($dt_answers, 0, 2);

        $data = array ( 
            	'id_answers' => ($id_answers == 0) ? $id : $id_answers,         
                'id_evaluation' => $id_evaluation,
                'id_questions' => $id_questions,
                'id_alternative_select' => $id_alternative_select,                
                'answer' => $answer,
                'note' => $note
        );
                	            	                                
        if (!empty($id_answers) && $id_answers != 0){        
            $this->db->where("id_answers", $id_answers);
            
            if ($this->db->update("tbanswers", $data)) { 
                return TRUE;
            } else {
	            return FALSE;            	
            }
			        
        } else {        	
            if ($this->db->insert("tbanswers", $data)) { 
                return TRUE;
            } else {
            	return FALSE;
			}        
        }   
    }
       
    function delete($id_answers){

        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries

        $this->db->where("id_answers", $id_answers)->delete("tbanswers");                
        $cod_db = $this->db->error(); 

        $this->db->db_debug = $db_debug; //restore setting

        if (! isset($cod_db['message'])) {
            return 0;            //TRUE;
        } else {
            return $cod_db['code'];      // FALSE;
        }
    }
 
 	function total_answers_filtered(){
                        
		$id_answers = $this->session->userdata("id_answers");
        $id_questions = $this->session->userdata("id_questions");
        $id_evaluation = $this->session->userdata("id_evaluation");
		$answers = $this->session->userdata("answers");

        if (!empty($id_questions)) {            
//            $this->db->like("name_questions", $id_questions);            
			$array = $this->m_setup->return_array_id('tbquestions', "name_questions", 
									$id_questions, "id_questions");

            $this->db->where_in("tbanswers.id_questions", $array);
			$this->db->group_by("tbanswers.id_answers, tbanswers.id_questions");                                    
        }        

        if (!empty($id_evaluation)) {            
//            $this->db->like("name", $id_evaluation);            
			$array = $this->m_setup->return_array_id('tbevaluation', "name_evaluation", 
									$id_evaluation, "id_evaluation");

            $this->db->where_in("tbanswers.id_evaluation", $array);
			$this->db->group_by("tbanswers.id_answers, tbanswers.id_evaluation");                                    
        }

        $this->db->select("tbanswers.*, tbquestions.*, tbanswers.id_answers as id ");
		$this->db->join("tbevaluation", "tbevaluation.id_evaluation = tbanswers.id_evaluation", 'LEFT');
		$this->db->join("tbquestions", "tbquestions.id_questions = tbanswers.id_questions", 'LEFT');
				
        $this->db->select("COUNT(DISTINCT id_answers) as total_answers", FALSE);                
          
        if (!empty($id_answers)) {            
            $this->db->where("id_answers", $id_answers);            
        }
        if (!empty($answers)) {            
            $this->db->like("answers", $answers);            
        }
 
        $this->db->where('tbanswers.status', '1');        
        
        //return $this->db->get("tbanswers")->row()->total_answers;
        $ret = $this->db->get('tbanswers');
        
		$row = ($ret->num_rows() > 0) ? $ret->row()->total_answers : 1;		        
        return $row;
    }        
       
    function autocomplete($term)  {
               
        $this->db->select("id_answers, answers");
        $this->db->like("answers", $term);
        $this->db->order_by("answers desc");
        
        $consult = $this->db->get("tbanswers");        
        return $consult;        
    }       

    function filter_answers($reg_initial = 0, $per_page = 0) {
        
        $id_answers = $this->session->userdata("id_answers");
        $id_questions = $this->session->userdata("id_questions");
        $id_evaluation = $this->session->userdata("id_evaluation");
		$answers = $this->session->userdata("answers");       

        $this->db->select("tbanswers.*, tbquestions.*, tbanswers.id_answers as id ");
		$this->db->join("tbevaluation", "tbevaluation.id_evaluation = tbanswers.id_evaluation", 'LEFT');
		$this->db->join("tbquestions", "tbquestions.id_questions = tbanswers.id_questions", 'LEFT');
		                                                           
        if (!empty($id_answers)) {            
            $this->db->where("id_answers", $id_answers);            
        }        
        if (!empty($id_evaluation)) {            
            $this->db->like("id_evaluation", $id_evaluation);            
        }
        if (!empty($id_questions)) {            
            $this->db->like("id_questions", $id_questions);            
        }                
        if (!empty($answers)) {            
            $this->db->like("answers", $answers);            
        }

		$this->db->where("tbanswers.status", '1');		                                
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
		
        return $this->db->get('tbanswers');        
    }    
        
    function list_answers() {
        	        	
        $this->db->where('status', '1');
        return $this->db->get("tbanswers");        
    }

	function save_answers_candidate($data) {
	
        if ($this->db->insert("tbanswers", $data)) { 
            return TRUE;
        } else {
        	return FALSE;
		}        		
	}
              
}

