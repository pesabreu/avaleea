<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');


class M_alternatives extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function return_alternatives($id_alternatives = 0, $reg_initial = 0, $per_page = 0, $id_questions = 0) {

        $this->db->select("tbalternatives.*, tbquestions.*, tbsituation.*, tbalternatives.id_alternatives as id ");
		$this->db->join("tbquestions", "tbquestions.id_questions = tbalternatives.id_questions", 'LEFT');
		$this->db->join("tbsituation", "tbsituation.id_situation = tbalternatives.id_situation", 'LEFT');
	               
        if ($id_alternatives != 0) {
            $this->db->where("tbalternatives.id_alternatives", $id_alternatives);
        }
        if ($id_questions != 0) {
            $this->db->where("tbalternatives.id_questions", $id_questions);
        }
		
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }

        return $this->db->get("tbalternatives");	
	}

    function total_alternatives($id_questions = 0){
                
        $this->db->select("COUNT(DISTINCT id_alternatives) as total_alternatives", FALSE);            
        if ($id_questions != 0) {
            $this->db->where("tbalternatives.id_questions", $id_questions);
        }
        $this->db->where("status", '1');
		
        return $this->db->get("tbalternatives")->row()->total_alternatives;        
    }

    function save_alternatives() {
    
        $id_alternatives = $this->input->post("id_alternatives");
		$id_questions = $this->input->post("list_questions");
		$id_order_questions = $this->input->post("id_order_questions");            
        $id_situation = $this->input->post("list_situation");        						      
        $description_alternatives = $this->input->post("description_alternatives");
        $text_alternatives = $this->input->post("text_alternatives");
		$right_wrong = $this->input->post("list_right_wrong");
		
		if ($id_alternatives == 0) {
			$id = $this->m_setup->return_next_id('tbalternatives', 'id_alternatives');
		}					                      

        $data = array ( 
            	'id_alternatives' => ($id_alternatives == 0) ? $id : $id_alternatives,         
                'id_questions' => $id_questions,
                'id_order_questions' => $id_order_questions,
                'id_situation' => $id_situation,
                'description_alternatives' => $description_alternatives,
                'text_alternatives' => $text_alternatives,
                'right_wrong' => $right_wrong                                                
        );
                	            	                                
        if (!empty($id_alternatives) && $id_alternatives != 0){        
            $this->db->where("id_alternatives", $id_alternatives);
            
            if ($this->db->update("tbalternatives", $data)) { 
                return TRUE;
            } else {
	            return FALSE;            	
            }
			        
        } else {        	
            if ($this->db->insert("tbalternatives", $data)) { 
                return TRUE;
            } else {
            	return FALSE;
			}        
        }   
    }
       
    function delete($id_alternatives){

        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries

        $this->db->where("id_alternatives", $id_alternatives)->delete("tbalternatives");                
        $cod_db = $this->db->error(); 

        $this->db->db_debug = $db_debug; //restore setting

        if (! isset($cod_db['message'])) {
            return 0;            //TRUE;
        } else {
            return $cod_db['code'];      // FALSE;
        }
    }
 
 	function total_alternatives_filtered(){
                        
		$id_alternatives = $this->session->userdata("id_alternatives");
        $id_questions = $this->session->userdata("id_questions");
        $description_alternatives = $this->session->userdata("description_alternatives");

        if (!empty($id_questions)) {            
//            $this->db->like("name_questions", $id_questions);            
			$array = $this->m_setup->return_array_id('tbquestions', "name_questions", 
									$id_questions, "id_questions");

            $this->db->where_in("tbalternatives.id_questions", $array);
			$this->db->group_by("tbalternatives.id_alternatives, tbalternatives.id_questions");            
        }        

        $this->db->select("tbalternatives.*, tbquestions.*, tbalternatives.id_alternatives as id ");
		$this->db->join("tbquestions", "tbquestions.id_questions = tbalternatives.id_questions", 'LEFT');
		
        $this->db->select("COUNT(DISTINCT id_alternatives) as total_alternatives", FALSE);                
          
        if (!empty($id_alternatives)) {            
            $this->db->where("id_alternatives", $id_alternatives);            
        }
        if (!empty($description_alternatives)) {            
            $this->db->like("description_alternatives", $description_alternatives);            
        }
 
        $this->db->where('tbalternatives.status', '1');        
        
        //return $this->db->get("tbalternatives")->row()->total_alternatives;
        $ret = $this->db->get('tbalternatives');
        
		$row = ($ret->num_rows() > 0) ? $ret->row()->total_alternatives : 1;		        
        return $row;		        
    }        
       
    function autocomplete($term)  {
               
        $this->db->select("id_alternatives, description_alternatives");
        $this->db->like("description_alternatives", $term);
        $this->db->order_by("description_alternatives desc");
        
        $consult = $this->db->get("tbalternatives");        
        return $consult;        
    }       

    function filter_alternatives($reg_initial = 0, $per_page = 0) {
        
        $id_alternatives = $this->session->userdata("id_alternatives");
        $id_questions = $this->session->userdata("id_questions");
        $description_alternatives = $this->session->userdata("name_alternatives");       

        $this->db->select("tbalternatives.*, tbquestions.*, tbalternatives.id_alternatives as id ");
		$this->db->join("tbquestions", "tbquestions.id_questions = tbalternatives.id_questions", 'LEFT');
                                                           
        if (!empty($id_alternatives)) {            
            $this->db->where("id_alternatives", $id_alternatives);            
        }        
        if (!empty($id_questions)) {            
            $this->db->like("id_questions", $id_questions);            
        }                
        if (!empty($description_alternatives)) {            
            $this->db->like("description_alternatives", $description_alternatives);            
        }

		$this->db->where("tbalternatives.status", '1');		                                
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
		
        return $this->db->get('tbalternatives');        
    }    
        
    public function list_alternatives() {
        	        	
        $this->db->where('status', '1');
        return $this->db->get("tbalternatives");        
    }
              
	public function return_complete_data($id_alternatives = 0) {

		if ($id_alternatives == 0 or is_null($id_alternatives)) { $id_alternatives = 0; } 	
		
    	$this->db->select("tbalternatives.*, tbsituation.*, tbalternatives.id_alternatives as id ");

		$this->db->join("tbsituation", "tbsituation.id_situation = tbalternatives.id_situation", 'LEFT');   	

        $this->db->where("tbalternatives.id_alternatives", $id_alternatives);

		$query = $this->db->get("tbalternatives")->result_array();
		//print_r($query);
		//echo "<br /><br /><br />";
		//echo $this->db->last_query();  
		//exit;              
        return $query;         
        //return $this->db->get("tbquestionnaries")->result_array();							
	}

	public function save_alternatives_authors() {
   
        $id_alternatives = $this->input->post("id_alternatives");
		$id_questions = $this->input->post("id_questionsa");
		$id_order_questions = $this->input->post("id_order_questions");            
        $id_situation = $this->input->post("selectSituationa");        						      
        $description_alternatives = $this->input->post("description_alternatives");
        $text_alternatives = $this->input->post("text_alternatives");
		$right_wrong = $this->input->post("selectRightwrong");
		
		if ($id_alternatives == 0) {
			$id = $this->m_setup->return_next_id('tbalternatives', 'id_alternatives');
		}					                      

        $data = array ( 
            	'id_alternatives' => ($id_alternatives == 0) ? $id : $id_alternatives,         
                'id_questions' => $id_questions,
                'id_order_questions' => $id_order_questions,
                'id_situation' => $id_situation,
                'description_alternatives' => $description_alternatives,
                'text_alternatives' => $text_alternatives,
                'right_wrong' => $right_wrong                                                
        );
 		                	            	                                
        if (!empty($id_alternatives) && $id_alternatives != 0){        
            $this->db->where("id_alternatives", $id_alternatives);
           	$ret = $this->db->update("tbalternatives", $data);
		
        } else {        	
            $ret = $this->db->insert("tbalternatives", $data); 
        }
 
   		//echo $this->db->last_query();  
		//exit;              
 
		return $ret;		
	}
        
    public function return_alternatives_candidate($id_questions, $id_order_questions) {
        
		if ( (is_null($id_questions) || $id_questions == 0)  	
		 ||  (is_null($id_order_questions) || $id_order_questions == 0) ) {		 	
			 return FALSE; 
		 }
		 
        $this->db->where("id_questions", $id_questions);
        $this->db->where("id_order_questions", $id_order_questions);		
			        	
        $this->db->where('status', '1');
        return $this->db->get("tbalternatives")->result_array();        
    }
                            
}

