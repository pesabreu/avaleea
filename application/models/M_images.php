<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');


class M_images extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function return_images($id_images = 0, $reg_initial = 0, $per_page = 0) {

        $this->db->select("tbimages.*, tbquestionnaries.*, tbquestions.*, tbimages.id_images as id ");
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbimages.id_questionnaries", 'LEFT');								
		$this->db->join("tbquestions", "tbquestions.id_questions = tbimages.id_questions", 'LEFT');		
	               
        if ($id_images != 0) {
            $this->db->where("tbimages.id_images", $id_images);
        }
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }

        return $this->db->get("tbimages");	
	}

    function total_images(){
                
        $this->db->select("COUNT(DISTINCT id_images) as total_images", FALSE);            
        $this->db->where("status", '1');
		
        return $this->db->get("tbimages")->row()->total_images;        
    }

    function save_images() {
    
        $id_images = $this->input->post("id_images");
		$id_questionnaries = $this->input->post("list_questionnaries");
		$id_questions = $this->input->post("list_questions");
		$name_images = $this->input->post("name_images");
		$title_images = $this->input->post("title_images");
		$description_images = $this->input->post("description_images");                   						      
		$url_images = $this->input->post("url_images");
				
		if ($id_images == 0) {
			$id = $this->m_setup->return_next_id('tbimages', 'id_images');
		}					                      

        $data = array ( 
            	'id_images' => ($id_images == 0) ? $id : $id_images,         
                'id_questionnaries' => $id_questionnaries,
                'id_questions' => $id_questions,
                'name_images' => $name_images,
                'title_images' => $title_images,
                'url_images' => $url_images
        );

        if (!empty($id_images) && $id_images != 0){        
            $this->db->where("id_images", $id_images);
            
            if ($this->db->update("tbimages", $data)) { 
                return TRUE;
            } else {
	            return FALSE;            	
            }
			        
        } else {        	
            if ($this->db->insert("tbimages", $data)) { 
                return TRUE;
            } else {
            	return FALSE;
			}        
        }   
    }
       
    function delete($id_images){

        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries

        $this->db->where("id_images", $id_images)->delete("tbimages");                
        $cod_db = $this->db->error(); 

        $this->db->db_debug = $db_debug; //restore setting

        if (! isset($cod_db['message'])) {
            return 0;            //TRUE;
        } else {
            return $cod_db['code'];      // FALSE;
        }
    }
 
 	function total_images_filtered(){
                        
		$id_images = $this->session->userdata("id_images");
        $id_questionnaries = $this->session->userdata("id_questionnaries");
        $id_questions = $this->session->userdata("id_questions");
		$name_images = $this->session->userdata("name_images");

        if (!empty($id_questionnaries)) {            
//            $this->db->like("name_questions", $id_questions);            
			$array = $this->m_setup->return_array_id('tbquestionnaries', "name_questionnaries", 
									$id_questionnaries, "id_questionnaries");

            $this->db->where_in("tbimages.id_questionnaries", $array);
			$this->db->group_by("tbimages.id_images, tbimages.id_questionnaries");                                    
        }        

        if (!empty($id_questions)) {            
//            $this->db->like("name", $id_evaluation);            
			$array = $this->m_setup->return_array_id('tbquestions', "name_questions", 
									$id_questions, "id_questions");

            $this->db->where_in("tbimages.id_questions", $array);
			$this->db->group_by("tbimages.id_images, tbimages.id_questions");                                    
        }

        $this->db->select("tbimages.*, tbquestionnaries.*, tbquestions.*, tbimages.id_images as id ");
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbimages.id_questionnaries", 'LEFT');
		$this->db->join("tbquestions", "tbquestions.id_questions = tbimages.id_questions", 'LEFT');
				
        $this->db->select("COUNT(DISTINCT id_images) as total_images", FALSE);                
          
        if (!empty($id_images)) {            
            $this->db->where("id_images", $id_images);            
        }
        if (!empty($name_images)) {            
            $this->db->like("name_images", $name_images);           
        }
 
        $this->db->where('tbimages.status', '1');        
        
        //return $this->db->get("tbimages")->row()->total_images;
        $ret = $this->db->get('tbimages');
        
		$row = ($ret->num_rows() > 0) ? $ret->row()->total_images : 1;		        
        return $row;
    }        
       
    function autocomplete($term)  {
               
        $this->db->select("id_images, name_images");
        $this->db->like("name_images", $term);
        $this->db->order_by("name_images desc");
        
        $consult = $this->db->get("tbimages");        
        return $consult;        
    }       

    function filter_images($reg_initial = 0, $per_page = 0) {
        
        $id_images = $this->session->userdata("id_images");
        $id_questionnaries = $this->session->userdata("id_questionnaries");
        $id_questions = $this->session->userdata("id_questions");
		$name_images = $this->session->userdata("name_images");       

        $this->db->select("tbimages.*, tbquestionnaries.*, tbquestions.*, tbimages.id_images as id ");
		$this->db->join("tbquestionnaries", "tbquestionnaries.id_questionnaries = tbimages.id_questionnaries", 'LEFT');
		$this->db->join("tbquestions", "tbquestions.id_questions = tbimages.id_questions", 'LEFT');
				
        if (!empty($id_images)) {            
            $this->db->where("id_images", $id_images);            
        }        
        if (!empty($id_questionnaries)) {            
            $this->db->like("name_questionnaries", $id_questionnaries);            
        }
        if (!empty($id_questions)) {            
            $this->db->like("name_questions", $id_questions);            
        }                
        if (!empty($name_images)) {            
            $this->db->like("name_images", $name_images);            
        }

		$this->db->where("tbimages.status", '1');		                                
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
		
        return $this->db->get('tbimages');        
    }    
        
    function list_images() {
        	        	
        $this->db->where('status', '1');
        return $this->db->get("tbimages");        
    }
              
}

