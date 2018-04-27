<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');


class M_modules extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function return_modules($id_modules = 0, $reg_initial = 0, $per_page = 0) {

        $this->db->select("tbmodules.*, tbindustry.*, tbacademic_area.*, tbdisciplines.*, tbsituation.*, tbmodules.id_modules as id ");
        $this->db->join("tbindustry", "tbindustry.id_industry = tbmodules.id_industry", 'LEFT');
		$this->db->join("tbacademic_area", "tbacademic_area.id_academic_area = tbmodules.id_academic_area", 'LEFT');
		$this->db->join("tbdisciplines", "tbdisciplines.id_disciplines = tbmodules.id_disciplines", 'LEFT');
		$this->db->join("tbsituation", "tbsituation.id_situation = tbmodules.id_situation", 'LEFT');
	               
        if ($id_modules != 0) {
            $this->db->where("tbmodules.id_modules", $id_modules);
        }
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }

        return $this->db->get("tbmodules");	
	}

    function total_modules(){
                
        $this->db->select("COUNT(DISTINCT id_modules) as total_modules", FALSE);            
        $this->db->where("status", '1');
		
        return $this->db->get("tbmodules")->row()->total_modules;        
    }

    function save_modules() {
    
        $id_modules = $this->input->post("id_modules");
		$id_industry = $this->input->post("list_industry");
		$id_academic_area = $this->input->post("list_academic_area");        
        $id_disciplines = $this->input->post("list_disciplines");
        $id_situation = $this->input->post("list_situation");		      
        $name_modules = $this->input->post("name_modules");
        $title_modules = $this->input->post("title_modules");
		$description_modules = $this->input->post("description_modules");
		$text_modules = $this->input->post("text_modules");
		$time_modules = $this->input->post("time_modules");
		$subject = $this->input->post("subject");
		$theme = $this->input->post("theme");
		$scope = $this->input->post("scope");						
		
		if ($id_modules == 0) {
			$id = $this->m_setup->return_next_id('tbmodules', 'id_modules');
		}					                      

        $data = array ( 
            	'id_modules' => ($id_modules == 0) ? $id : $id_modules,         
                'id_industry' => $id_industry,
                'id_academic_area' => $id_academic_area,
                'id_disciplines' => $id_disciplines,
                'id_situation' => $id_situation,
                'name_modules' => $name_modules,
                'title_modules' => $title_modules,
                'description_modules' => $description_modules,
                'text_modules' => $text_modules,
                'time_modules' => $time_modules,
                'subject' => $subject,
                'theme' => $theme, 
                'scope' => $scope                                                
        );
                	            	                                
        if (!empty($id_modules) && $id_modules != 0){        
            $this->db->where("id_modules", $id_modules);
            
            if ($this->db->update("tbmodules", $data)) { 
                return TRUE;
            } else {
	            return FALSE;            	
            }
			        
        } else {        	
            if ($this->db->insert("tbmodules", $data)) { 
                return TRUE;
            } else {
            	return FALSE;
			}        
        }   
    }
       
    function delete($id_modules){

        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries

        $this->db->where("id_modules", $id_modules)->delete("tbmodules");                
        $cod_db = $this->db->error(); 

        $this->db->db_debug = $db_debug; //restore setting

        if (! isset($cod_db['message'])) {
            return 0;            //TRUE;
        } else {
            return $cod_db['code'];      // FALSE;
        }
    }
 
 	function total_modules_filtered(){
                        
		$id_modules = $this->session->userdata("id_modules");
        $id_industry = $this->session->userdata("id_industry");
        $name_modules = $this->session->userdata("name_modules");
        $subject = $this->session->userdata("subject");

        if (!empty($id_industry)) {            
//            $this->db->like("name_industry", $id_industry);            
			$array = $this->m_setup->return_array_id('tbindustry', "name_industry", $id_industry, "id_industry");

            $this->db->or_where_in("tbmodules.id_industry", $array);
			$this->db->group_by("tbmodules.id_modules, tbmodules.id_industry");                        
        }        

        $this->db->select("tbmodules.*, tbindustry.*, tbmodules.id_modules as id ");
        $this->db->join("tbindustry", "tbindustry.id_industry = tbmodules.id_industry", 'LEFT');
		
        $this->db->select("COUNT(DISTINCT id_modules) as total_modules", FALSE);                
          
        if (!empty($id_modules)) {            
            $this->db->where("id_modules", $id_modules);            
        }
        if (!empty($name_modules)) {            
            $this->db->like("name_modules", $name_modules);            
        }        
        if (!empty($subject)) {            
            $this->db->like("subject", $subject);            
        }
 
        $this->db->where('tbmodules.status', '1');        
		        
        //return $this->db->get("tbmodules")->row()->total_modules;
        $ret = $this->db->get('tbmodules');
        
		$row = ($ret->num_rows() > 0) ? $ret->row()->total_modules : 1;		        
        return $row;

        /*echo "ret -> ". $ret ."<br /><br />";
		echo $this->db->last_query();
		exit();*/			
    }        
       
    function autocomplete($term)  {
               
        $this->db->select("id_modules, name_modules");
        $this->db->like("name_modules", $term);
        $this->db->order_by("name_modules desc");
        
        $consult = $this->db->get("tbmodules");        
        return $consult;        
    }       

    function filter_modules($reg_initial = 0, $per_page = 0) {
        
        $id_modules = $this->session->userdata("id_modules");
        $id_industry = $this->session->userdata("id_industry");
        $name_modules = $this->session->userdata("name_modules");        
        $subject = $this->session->userdata("subject");

        $this->db->select("tbmodules.*, tbindustry.*, tbmodules.id_modules as id ");
        $this->db->join("tbindustry", "tbindustry.id_industry = tbmodules.id_industry", 'LEFT');
                                                           
        if (!empty($id_modules)) {            
            $this->db->where("id_modules", $id_modules);            
        }        
        if (!empty($name_modules)) {            
            $this->db->like("name_modules", $name_modules);            
        }               
        if (!empty($subject)) {            
            $this->db->like("subject", $subject);            
        }

		$this->db->where("tbmodules.status", '1');
		                                
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
		
        return $this->db->get('tbmodules');
	}    
        
    function list_modules() {        	
        $this->db->where('status', '1');
        return $this->db->get("tbmodules");        
    }
              
}
