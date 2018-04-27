<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');


class M_people extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function return_people($id_people = 0, $reg_initial = 0, $per_page = 0) {

        $this->db->select("tbpeople.*, tbcategories.*, tboccupation_area.*, tbweb_contact.*, tbaddresses.*, tbphones.*, 
        					tbpeople.dt_update as dt, tbpeople.id_people as id ");
        $this->db->join("tbcategories", "tbcategories.id_categories = tbpeople.id_categories", 'LEFT');
		$this->db->join("tboccupation_area", "tboccupation_area.id_occupation_area = tbpeople.id_occupation_area", 'LEFT');
		$this->db->join("tbaddresses", "tbaddresses.id_people = tbpeople.id_people", 'LEFT');
		$this->db->join("tbphones", "tbphones.id_people = tbpeople.id_people", 'LEFT');
		$this->db->join("tbweb_contact", "tbweb_contact.id_people = tbpeople.id_people", 'LEFT');
	               
        if ($id_people != 0) {
            $this->db->where("tbpeople.id_people", $id_people);
        }
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
		
		$this->db->where('tbpeople.status', '1');
    	
    	//return $this->db->get("tbpeople");
    	$query = $this->db->get("tbpeople");	
    	return $query;
	}

    function total_people(){
                
        $this->db->select("COUNT(DISTINCT id_people) as total_people", FALSE);            
        $this->db->where("status", '1');
		
        return $this->db->get("tbpeople")->row()->total_people;        
    }

    function save_people() {
    
        $id_people = $this->input->post("id_people");
		$type_people = $this->input->post("list_type_people");
		$id_categories = $this->input->post("list_categories");        
        $id_occupation_area = $this->input->post("list_occupation");        
        $name = $this->input->post("name");
        $name_fantasy = $this->input->post("name_fantasy");
		$legal_identification = $this->input->post("legal_identification");
		$physical_identification = $this->input->post("physical_identification");
		$dt_birthday = $this->input->post("dt_birthday");
		$city = $this->input->post("city");
		$state = $this->input->post("state");
		$country = $this->input->post("country");						
        $note = $this->input->post("notes");		                               
		
		if ($id_people == 0) {
			$id = $this->m_setup->return_next_id('tbpeople', 'id_people');
		}					                      

		$dt_b = substr($dt_birthday, 6, 4) ."-". substr($dt_birthday, 3, 2) ."-". substr($dt_birthday, 0, 2); 

        $data = array ( 
            	'id_people' => ($id_people == 0) ? $id : $id_people,         
                'type_people' => $type_people,
                'id_categories' => $id_categories,
                'id_occupation_area' => $id_occupation_area,
                'name' => $name,
                'name_fantasy' => $name_fantasy,
                'legal_identification' => $legal_identification,
                'physical_identification' => $physical_identification,
                'dt_birthday' => $dt_b,
                'city' => $city,
                'state' => $state,
                'country' => $country, 
                'note' => $note                                                
        );
		
		//print_r($data);
		//exit();
                	            	                                
        if (!empty($id_people) && $id_people != 0){        
            $this->db->where("id_people", $id_people);
            
            if ($this->db->update("tbpeople", $data)) { 
                return TRUE;
            } else {
	            return FALSE;            	
            }
			        
        } else {        	
            if ($this->db->insert("tbpeople", $data)) { 
                return TRUE;
            } else {
            	return FALSE;
			}        
        }   
    }
       
    function delete($id_people){

        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries

        $this->db->where("id_people", $id_people)->delete("tbpeople");                
        $cod_db = $this->db->error(); 

        $this->db->db_debug = $db_debug; //restore setting

        if (! isset($cod_db['message'])) {
            return 0;            //TRUE;
        } else {
            return $cod_db['code'];      // FALSE;
        }
    }
 
 	function total_people_filtered(){
                        
		$id_people = $this->session->userdata("id_people");
        $name = $this->session->userdata("name");
        $legal_identification = $this->session->userdata("legal_identification");
        $physical_identification = $this->session->userdata("physical_identification");
		
        $this->db->select("COUNT(DISTINCT id_people) as total_people", FALSE);                
          
        if (!empty($id_people)) {            
            $this->db->where("id_people", $id_people);            
        }
        if (!empty($name)) {            
            $this->db->like("name", $name);            
        }        
        if (!empty($legal_identification)) {            
            $this->db->like("legal_identification", $legal_identification);            
        }        
        if (!empty($physical_identification)) {            
            $this->db->like("physical_identification", $physical_identification);            
        }
 
        $this->db->where('status', '1');        
        
        return $this->db->get("tbpeople")->row()->total_people;        
    }        
       
    function autocomplete($term)  {
               
        $this->db->select("id_people, name");
        $this->db->like("name", $term);
        $this->db->order_by("name desc");
        
        $consult = $this->db->get("tbpeople");        
        return $consult;        
    }       

    function filter_people($reg_initial = 0, $per_page = 0) {
        
        $id_people = $this->session->userdata("id_people");
        $name = $this->session->userdata("name");
        $legal_identification = $this->session->userdata("legal_identification");        
        $physical_identification = $this->session->userdata("physical_identification");

        $this->db->select("tbpeople.*, tbpeople.id_people as id ");

                                                           
        if (!empty($id_people)) {            
            $this->db->where("id_people", $id_people);            
        }        
        if (!empty($name)) {            
            $this->db->like("name", $name);            
        }                
        if (!empty($legal_identification)) {            
            $this->db->like("legal_identification", $legal_identification);            
        }               
        if (!empty($physical_identification)) {            
            $this->db->like("physical_identification", $physical_identification);            
        }

		$this->db->where("status", '1');
		                                
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
		
        return $this->db->get('tbpeople');        
    }    
        
    function list_people() {        	
        $this->db->where('status', '1');
        return $this->db->get("tbpeople");        
    }

        
    function return_categorie($cat = 0) {
		
        $this->db->select("tbpeople.*, tbweb_contact.*, tbpeople.id_people as id ");
		$this->db->join("tbweb_contact", "tbweb_contact.id_people = tbpeople.id_people", 'LEFT');		

		if ($cat != 0) {
			$this->db->where('id_categories', $cat);
		}
		    	        	
        $this->db->where('tbpeople.status', '1');
        return $this->db->get("tbpeople");        
    }
              

  
/* 
***************************************************************************************************
*
*		Method of Adrresses
*  
***************************************************************************************************
*/

    function return_addresses($id_people = 0, $reg_initial = 0, $per_page = 0) {

        $this->db->select("tbaddresses.*, tbpeople.*, tbaddresses.id_addresses as id ");
		$this->db->join("tbpeople", "tbpeople.id_people = tbaddresses.id_people", 'LEFT');	
	               
        if ($id_people != 0) {
            $this->db->where("tbaddresses.id_people", $id_people);
        }
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }

  		//return $this->db->get("tbaddresses");
  		$query = $this->db->get("tbaddresses");
			
		//Echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
		//echo $this->db->last_query();
		//echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";		
		//print_r($query);
		return $query;	
	}

    function save_addresses() {
    		
    	$id_addresses = $this->input->post("id_addresses");
		$this->db->where("id_addresses", $id_addresses);		
		
        $data = array ( 
	    	'id_addresses' => $id_addresses,         
	        'id_qpeople' => $this->input->post("id_people"),
	        'public_place' => $this->input->post("public_place"),
	        'number' => $this->input->post("number"),
	        'neighborhood' => $this->input->post("neighborhood"),
	        'complement_1' => $this->input->post("complement_1"),
	        'complement_2' => $this->input->post("complement_2"),
	        'complement_3' => $this->input->post("complement_3"),
	        'zipcode' => $this->input->post("zipcode")                                                
        );

        if ($this->db->update("tbaddresses", $data)) { 
            return TRUE;
        } else {
            return FALSE;            	
        }			        
    }              


/* 
***************************************************************************************************
*
*		Method of Phones
*  
***************************************************************************************************
*/

    function return_phones($id_people = 0, $reg_initial = 0, $per_page = 0) {

        $this->db->select("tbphones.*, tbpeople.*, tbphones.id_phones as id ");
		$this->db->join("tbpeople", "tbpeople.id_people = tbphones.id_people", 'LEFT');	
	               
        if ($id_people != 0) {
            $this->db->where("tbphones.id_people", $id_people);
        }
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }

  		//return $this->db->get("tbaddresses");
  		$query = $this->db->get("tbphones");			
		return $query;	
	}

    function save_phones() {
    		
    	$id_phones = $this->input->post("id_phones");
		$this->db->where("id_phones", $id_phones);		
		
        $data = array ( 
	    	'id_phones' => $id_phones,         
	        'id_qpeople' => $this->input->post("id_people"),
	        'list_people' => $this->input->post("list_people"),
	        'area_code_1' => $this->input->post("area_code_1"),
	        'ddd_1' => $this->input->post("ddd_1"),
	        'number_phone_1' => $this->input->post("number_phone_1"),
	        'area_code_2' => $this->input->post("area_code_2"),
	        'ddd_2' => $this->input->post("ddd_2"),
	        'number_phone_2' => $this->input->post("number_phone_2"),
	        'area_code_3' => $this->input->post("area_code_3"),
	        'ddd_3' => $this->input->post("ddd_3"),
	        'number_phone_3' => $this->input->post("number_phone_3"),
        );

        if ($this->db->update("tbphones", $data)) { 
            return TRUE;
        } else {
            return FALSE;            	
        }			        
    }              
    

/* 
***************************************************************************************************
*
*		Method of Web Contact
*  
***************************************************************************************************
*/

    function return_web_contact($id_people = 0, $reg_initial = 0, $per_page = 0) {

        $this->db->select("tbweb_contact.*, tbpeople.*, tbweb_contact.id_web_contact as id ");
		$this->db->join("tbpeople", "tbpeople.id_people = tbweb_contact.id_people", 'LEFT');	
	               
        if ($id_people != 0) {
            $this->db->where("tbweb_contact.id_people", $id_people);
        }
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }

  		//return $this->db->get("tbaddresses");
  		$query = $this->db->get("tbweb_contact");			
		return $query;	
	}

    function save_web_contact() {
    		
    	$id_web_contact = $this->input->post("id_web_contact");
		$this->db->where("id_phones", $id_web_contact);		
		
        $data = array ( 
	    	'id_web_contact' => $id_web_contact,         
	        'id_people' => $this->input->post("id_people"),
	        'email_1' => $this->input->post("email_1"),
	        'email_2' => $this->input->post("email_2"),
	        'email_3' => $this->input->post("email_3"),
	        
	        'website' => $this->input->post("website"),
	        'facebook' => $this->input->post("facebook"),
	        'twitter' => $this->input->post("twitter"),
	        'instagram' => $this->input->post("instagram"),
	        'linkedin' => $this->input->post("linkedin"),
	        'other_social_network_1' => $this->input->post("other_social_network_1"),
	        'url_other_sn_1' => $this->input->post("url_other_sn_1"),
	        'other_social_network_2' => $this->input->post("other_social_network_2"),
	        'url_other_sn_2' => $this->input->post("url_other_sn_2")
        );

        if ($this->db->update("tbweb_contact", $data)) { 
            return TRUE;
        } else {
            return FALSE;            	
        }			        
    }              
    
}

