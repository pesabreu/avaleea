<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class M_tabsys extends CI_Model {
    
    function __construct() {
        parent::__construct();
		
		$tabsys = $this->session->userdata("tabsys");
		$table_sys = $this->session->userdata("table_sys");
    }
    
    function return_tabsys($id_tabsys = 0, $reg_initial = 0, $per_page = 0) {

		$tabsys = $this->session->userdata("tabsys");
		$table_sys = $this->session->userdata("table_sys");

		$id = 'id_'.$tabsys;
		$code = 'code_'.$tabsys;
		$desc = 'description_'.$tabsys;
		
		$this->db->select("$id as id, $code as code, $desc as desc, note" );

        if ($id_tabsys != 0) {
            $this->db->where('id_'.$tabsys, $id_tabsys);
        }
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
        
		//$query = $this->db->get("tbusers");
		//echo $this->db->last_query();
		return $this->db->get($table_sys);	
	}

    function total_tabsys(){
		$tabsys = $this->session->userdata("tabsys");
		$table_sys = $this->session->userdata("table_sys");
                
        $this->db->select("COUNT(DISTINCT id_".$tabsys .") as total_tabsys", FALSE);            
        $this->db->where("status", '1');
		
        return $this->db->get($table_sys)->row()->total_tabsys;        
    }

    function save() {
    	$tabsys = $this->session->userdata("tabsys");		
		$table_sys = $this->session->userdata("table_sys");					
	
        $id_ts = $this->input->post("id_tabsys");
        $code = $this->input->post("code");
        $desc = $this->input->post("description");		
        $note = $this->input->post("note");		                               
				
		if ($id_ts == 0) {
			$id = $this->m_setup->return_next_id("$table_sys", 'id_'.$tabsys);
		}					                      

        $data = array ( 
            	'id_'.$tabsys => ($id_ts == 0) ? $id : $id_ts,         
                'code_'.$tabsys => $code,
                'description_'.$tabsys => $desc, 
                'note' => $note                                                
        );
                	            	                                
        if (!empty($id_ts) && $id_ts != 0){        
            $this->db->where("id_".$tabsys, $id_ts);
            
            if ($this->db->update($table_sys, $data)) 
                return TRUE;
            else 
               return FALSE;        
        } else {        	
            if ($this->db->insert($table_sys, $data)) 
                return TRUE;
            else 
                return FALSE;        
        }   
    }
       
    function delete($id_tabsys){
    	
		$tabsys = $this->session->userdata("tabsys");		
		$table_sys = $this->session->userdata("table_sys");					

        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries

        $this->db->where("id_".$tabsys, $id_tabsys)->delete($table_sys);                
        $cod_db = $this->db->error(); 

        $this->db->db_debug = $db_debug; //restore setting

        if (! isset($cod_db['message'])) {
            return 0;            //TRUE;
        } else {
            return $cod_db['code'];      // FALSE;
        }
    }
 
 	function total_tabsys_filtered() {
 		
		$tabsys = $this->session->userdata("tabsys");		
		$table_sys = $this->session->userdata("table_sys");					
                       
		$id = $this->session->userdata("id_".$tabsys);
        $code = $this->session->userdata("code_".$tabsys);
        $desc = $this->session->userdata("description_".$tabsys);
		
        $this->db->select("COUNT(DISTINCT id_".$tabsys .") as total_tabsys", FALSE);

        if (!empty($id)) {            
            $this->db->where("id_".$tabsys, $id);            
        }
        if (!empty($code)) {            
            $this->db->like("code_".$tabsys, $code);            
        }      
        if (!empty($desc)) {            
            $this->db->like("description_".$tabsys, $desc);            
        }

        $this->db->where('status', '1');        
        
        return $this->db->get($table_sys)->row()->total_tabsys;        
    }        
       
    function autocomplete($term)  {
		$tabsys = $this->session->userdata("tabsys");		
		$table_sys = $this->session->userdata("table_sys");					
               
		$id = "id_" .$tabsys;
		$code = "code_" .$tabsys;
			   
        $this->db->select("$id, $code");
        $this->db->like($code, $term);
        $this->db->order_by("$code desc");
        
        $consult = $this->db->get($table_sys);        
        return $consult;        
    }       

    function filter_tabsys($reg_initial = 0, $per_page = 0) {
		$tabsys = $this->session->userdata("tabsys");		
		$table_sys = $this->session->userdata("table_sys");					
        
        $id = $this->session->userdata("id");
        $code = $this->session->userdata("code");
        $desc = $this->session->userdata("desc");        

		$id_db = 'id_'.$tabsys;
		$code_db = 'code_'.$tabsys;
		$desc_db = 'description_'.$tabsys;
		
		$this->db->select("$id_db as id, $code_db as code, $desc_db as desc, note ");
        $this->db->order_by('dt_update', 'asc');        
                                                           
        if (!empty($id)) {            
            $this->db->where("$id_db", $id);            
        }        
        if (!empty($code)) {            
            $this->db->like("$code_db", $code);            
        }                
        if (!empty($desc)) {            
            $this->db->like("$desc_db", $desc);            
        }

		$this->db->where("status", '1');
				                                
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
		
        return $this->db->get($table_sys);        
    }    
        
    function list_tabsys($table) {        	
        $this->db->where('status', '1');
        return $this->db->get($table);        
    }

}
