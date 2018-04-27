<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');


class M_invitations extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function return_invitations($id_invitations = 0, $reg_initial = 0, $per_page = 0) {

        $this->db->select("tbinvitations.*, invited.*, admin.*, tbapplication.*, tbinvitations.id_invitations as id,
        					invited.id_people as id_people_invitation, invited.name as name_invitation, 
        					admin.id_people as id_people_admin, admin.name as name_admin
        	 			 ");
		$this->db->join("tbpeople admin", "admin.id_people = tbinvitations.id_people_admin ", 'LEFT');								
		$this->db->join("tbpeople invited", "invited.id_people = tbinvitations.id_people_invitation", 'LEFT');		
		$this->db->join("tbapplication", "tbapplication.id_application = tbinvitations.id_application", 'LEFT');		

        if ($id_invitations != 0) {
            $this->db->where("tbinvitations.id_invitations", $id_invitations);
        }
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }

    	$this->db->where("tbinvitations.dt_visited_link", NULL);
        $this->db->where('tbinvitations.status', '1');        
		
        return $this->db->get("tbinvitations");	
	}

    function total_invitations(){
                
        $this->db->select("COUNT(DISTINCT id_invitations) as total_invitations", FALSE);            

    	$this->db->where("dt_visited_link", NULL);
        $this->db->where("status", '1');
		
        return $this->db->get("tbinvitations")->row()->total_invitations;        
    }

    function save_invitations() {
    
        $id_invitations = $this->input->post("id_invitations");
		$dt_invitations = $this->input->post("dt_invitations");
		$id_people_admin = $this->input->post("id_people_admin");
		$id_people_invitation = $this->input->post("list_people_invited");
		$id_application = $this->input->post("list_application");
		$link_invitation = $this->input->post("link_invitation");
		$dt_visited_link = "";
		$note = $this->input->post("note");                   						      
				
		if ($id_invitations == 0) {
			$id = $this->m_setup->return_next_id('tbinvitations', 'id_invitations');
		}					                      

        $data = array ( 
            	'id_invitations' => ($id_invitations == 0) ? $id : $id_invitations,         
                'dt_invitations' => $dt_invitations,
                'id_application' => $id_application,
                'id_people_admin' => $id_people_admin,
                'id_people_invitation' => $id_people_invitation,
                'link_invitation' => $link_invitation,
                //'dt_visited_link' => $dt_visited_link,
                'note' => $note
        );

        if (!empty($id_invitations) && $id_invitations != 0){        
            $this->db->where("id_invitations", $id_invitations);
            
            if ($this->db->update("tbinvitations", $data)) { 
                return TRUE;
            } else {
	            return FALSE;            	
            }
			        
        } else {        	
            if ($this->db->insert("tbinvitations", $data)) { 
                return TRUE;
            } else {
            	return FALSE;
			}        
        }   
    }

    function save_invitations_link($data, $id_bd) {

		if ($id_bd == 0) {
        	$ret = $this->db->insert("tbinvitations", $data);
			     
        } else {        	
        	array_shift($data);
        	$this->db->where("id_invitations", $id_bd);
        	$ret = $this->db->update("tbinvitations", $data);
		}
		
		return $ret;        			
	}
       
	function record_dt_visited_link($id_invitation) {
    		
    	$data = array( 'dt_visited_link' => date('Y-m-d H:i:s'));

		$this->db->where("id_people_invitation", $id_invitation);
        
        if ($this->db->update("tbinvitations", $data)) { 
            return TRUE;
        } else {
            return FALSE;            	
        }
	}

	function return_application_candidate($id_application, $id_people_invitation) {

        $this->db->select(" tbinvitations.*, tbapplication.* ");
		$this->db->join("tbapplication", "tbapplication.id_application = tbinvitations.id_application", 'LEFT');		

        $this->db->where("tbinvitations.id_people_invitation", $id_people_invitation);
		$this->db->where("tbinvitations.dt_visited_link", NULL);
        $this->db->where("tbinvitations.status", '1');

        if ($id_application > 0) {
			$this->db->where("tbinvitations.id_application", $id_application);	        	
			$id = $this->db->get("tbinvitations")->result_array();
    	    $ret = is_null($id) ? 0 : $id[0]['id_invitations'];

		} else {
			$this->db->order_by("tbinvitations.id_application asc");		        	
			$ret = $this->db->get("tbinvitations"); 
		}
		
        return $ret;		
	}

    function delete($id_invitations){

        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries

        $this->db->where("id_invitations", $id_invitations)->delete("tbinvitations");                
        $cod_db = $this->db->error(); 

        $this->db->db_debug = $db_debug; //restore setting

        if (! isset($cod_db['message'])) {
            return 0;            //TRUE;
        } else {
            return $cod_db['code'];      // FALSE;
        }
    }
 
 	function total_invitations_filtered(){
                        
		$id_invitations = $this->session->userdata("id_invitations");
        $dt_invitations = $this->session->userdata("dt_invitations");
        $id_people_invitation = $this->session->userdata("id_people_invitation");
		$id_application = $this->session->userdata("id_application");
 
        $this->db->select("tbinvitations.*, invited.*, admin.*, tbapplication.*, tbinvitations.id_invitations as id,
        					invited.id_people as id_people_invitation, invited.name as name_invitation, 
        					admin.id_people as id_people_admin, admin.name as name_admin
        	 			 ");
		$this->db->join("tbpeople admin", "admin.id_people = tbinvitations.id_people_admin ", 'LEFT');								
		$this->db->join("tbpeople invited", "invited.id_people = tbinvitations.id_people_invitation", 'LEFT');		
		$this->db->join("tbapplication", "tbapplication.id_application = tbinvitations.id_application", 'LEFT');		
				
        $this->db->select("COUNT(DISTINCT id_invitations) as total_invitations", FALSE);                
          
        if (!empty($id_invitations)) {            
            $this->db->where("id_invitations", $id_invitations);            
        }
        if (!empty($dt_invitations)) {            
            $this->db->like("dt_invitations", $dt_invitations);           
        }
        if (!empty($id_people_invitation)) {            
            $this->db->like("name_invitation", $id_people_invitation);           
        }
        if (!empty($id_application)) {            
            $this->db->like("name_application", $id_application);           
        }

    	$this->db->where("tbinvitations.dt_visited_link", NULL);
        $this->db->where('tbinvitations.status', '1');        
        
        //return $this->db->get("tbinvitations")->row()->total_invitations;
        $ret = $this->db->get('tbinvitations');
        
		$row = ($ret->num_rows() > 0) ? $ret->row()->total_invitations : 1;		        
        return $row;
    }        
       
    function autocomplete($term)  {
               
        $this->db->select("id_invitations, name_invitations");
        $this->db->like("name_invitations", $term);
        $this->db->order_by("name_invitations desc");
        
        $consult = $this->db->get("tbinvitations");        
        return $consult;        
    }       

    function filter_invitations($reg_initial = 0, $per_page = 0) {
        
        $id_invitations = $this->session->userdata("id_invitations");
        $dt_invitations = $this->session->userdata("dt_invitations");
        $id_people_invitation = $this->session->userdata("id_people_invitation");
		$id_application = $this->session->userdata("id_application");       

        $this->db->select("tbinvitations.*, admin.*, invited.*, tbapplication.*, tbinvitations.id_invitations as id,
        					invited.id_people as id_people_invitation, invited.name as name_invitation, 
        					admin.id_people as id_people_admin, admin.name as name_admin
        	 			 ");
		$this->db->join("tbpeople admin", "admin.id_people = tbinvitations.id_people_admin ", 'LEFT');								
		$this->db->join("tbpeople invited", "invited.id_people = tbinvitations.id_people_invitation", 'LEFT');		
		$this->db->join("tbapplication", "tbapplication.id_application = tbinvitations.id_application", 'LEFT');		
				
        if (!empty($id_invitations)) {            
            $this->db->where("id_invitations", $id_invitations);            
        }        
        if (!empty($dt_invitations)) {            
            $this->db->like("dt_invitations", $dt_invitations);            
        }
        if (!empty($id_people_invitation)) {            
            $this->db->like("name_invitation", $id_people_invitation);            
        }                
        if (!empty($id_application)) {            
            $this->db->like("name_application", $id_application);            
        }

    	$this->db->where("tbinvitations.dt_visited_link", NULL);
        $this->db->where('tbinvitations.status', '1');        
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
		
        return $this->db->get('tbinvitations');        
    }    
        
    function list_invitations() {	        	

    	$this->db->where("tbinvitations.dt_visited_link", NULL);
        $this->db->where('tbinvitations.status', '1');
                
        return $this->db->get("tbinvitations");        
    }
              
}

