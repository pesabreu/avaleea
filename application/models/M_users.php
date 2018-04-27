<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');


class M_users extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function return_users($id_users = 0, $reg_initial = 0, $per_page = 0) {

        $this->db->select("tbusers.*, tbpeople.*, tbuser_level.*, tbusers.id_people as idpeople,  
			tbpeople.name as name_people, tbusers.login as login, tbuser_level.code as code_level");
        $this->db->join("tbuser_level", "tbuser_level.id_user_level = tbusers.id_user_level", 'LEFT');
		$this->db->join("tbpeople", "tbpeople.id_people = tbusers.id_people", 'LEFT');
	               
        if ($id_users != 0) {
            $this->db->where("tbusers.id_users", $id_users);
        }

        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
        
		$query = $this->db->get("tbusers");
		echo $this->db->last_query() ."<br /><br />";
		
		return $this->db->get("tbusers");	
	}

    function total_users(){
                
        $this->db->select("COUNT(DISTINCT id_users) as total_users", FALSE);            
        $this->db->where("status", '1');
		
        return $this->db->get("tbusers")->row()->total_users;        
    }

    function save_user() {
    
        $id_users = $this->input->post("id_users");
		$id_people = $this->input->post("list_people");        
        $id_user_level = $this->input->post("list_user_level");
        $login = $this->input->post("login");		
        $note = $this->input->post("note");		                               
				
		$password = $this->input->post("new_password");
		
		if ($id_users == 0) {
			$password = $this->input->post("old_password");
			$id = $this->m_setup->return_next_id('tbusers', 'id_users');
		}					                      

		$logged = (!empty($id_users) && $id_users != 0) ? '1' : 'x';

        $data = array ( 
            	'id_users' => ($id_users == 0) ? $id : $id_users,         
                'id_people' => $id_people,
                'id_user_level' => $id_user_level,
                'login' => $login,
                'password' => md5($password),
                'logged' => $logged, 
                'note' => $note,
                'dt_update' => date('Y-m-d H:i:s')                                                
        );
                	            	                                
        if (!empty($id_users) && $id_users != 0){        
            $this->db->where("id_users", $id_users);
            
            if ($this->db->update("tbusers", $data)) 
                return TRUE;
            else 
               return FALSE;        
        }
        else {        	
			//array_push($data, "logged => 'x'");
            if ($this->db->insert("tbusers", $data)) 
                return TRUE;
            else 
                return FALSE;        
        }   
    }

 	public function save_user_invitation($data) {

        if ($this->db->insert("tbusers", $data)){ 
            return TRUE;
        } else { 
            return FALSE;
		}        
	}

    public function verify_password() {

        $id_users = $this->input->post("id_users");        
        $password = md5($this->input->post("old_password"));
        
        $consult = $this->db->get_where("tbusers", array("password" => $password, "id_users" => $id_users));
        
        if ($consult->num_rows() > 0) 
            return TRUE;
        else
            return FALSE;
    }
       
    function delete($id_users){

        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries

        $this->db->where("id_users", $id_users)->delete("tbusers");                
        $cod_db = $this->db->error(); 

        $this->db->db_debug = $db_debug; //restore setting

        if (! isset($cod_db['message'])) {
            return 0;            //TRUE;
        } else {
            return $cod_db['code'];      // FALSE;
        }
    }
 
 	function total_users_filtered(){
                        
		$id_users = $this->session->userdata("id_users");
        $id_people = $this->session->userdata("id_people");
        $login = $this->session->userdata("login");
        $user_level = $this->session->userdata("id_user_level");

        if (!empty($id_people)) {            
//            $this->db->like("tbusers.id_people", $id_people);            
			$array = $this->m_setup->return_array_id('tbpeople', "name", 
									$id_people, "id_people");

            $this->db->where_in("tbusers.id_people", $array);
			$this->db->group_by("tbusers.id_users, tbusers.id_people");                        
        }        
        if (!empty($user_level)) {            
//            $this->db->like("id_user_level", $user_level);
			$array = $this->m_setup->return_array_id('tbuser_level', "code", 
									$user_level, "id_user_level");

            $this->db->where_in("tbusers.id_user_level", $array);
			$this->db->group_by("tbusers.id_users, tbusers.id_user_level");                        
        }
		
        $this->db->join("tbuser_level", "tbuser_level.id_user_level = tbusers.id_user_level", 'LEFT');
		$this->db->join("tbpeople", "tbpeople.id_people = tbusers.id_people", 'LEFT');

        $this->db->select("COUNT(DISTINCT id_users) as total_users", FALSE);                
          
        if (!empty($id_users)) {            
            $this->db->where("id_users", $id_users);            
        }
        if (!empty($login)) {            
            $this->db->like("login", $login);            
        }        
        $this->db->where('tbusers.status', '1');        
        
        //return $this->db->get("tbusers")->row()->total_users;
        $ret = $this->db->get('tbusers');
        
		$row = ($ret->num_rows() > 0) ? $ret->row()->total_users : 1;		        
        return $row;
    }        
       
    function autocomplete($term)  {
               
        $this->db->select("id_users, login");
        $this->db->like("login", $term);
        $this->db->order_by("login desc");
        
        $consult = $this->db->get("tbusers");        
        return $consult;        
    }       

    function filter_users($reg_initial = 0, $per_page = 0) {

        $this->db->select("tbusers.*, tbpeople.*, tbuser_level.*, tbusers.id_people as idpeople,  
			tbpeople.name as name_people, tbusers.login as login, tbuser_level.code as code_level ");
        $this->db->join("tbuser_level", "tbuser_level.id_user_level = tbusers.id_user_level", 'LEFT');
		$this->db->join("tbpeople", "tbpeople.id_people = tbusers.id_people", 'LEFT');
        
        $id_users = $this->session->userdata("id_users");
        $id_people = $this->session->userdata("id_people");
        $login = $this->session->userdata("login");        
        $id_user_level = $this->session->userdata("id_user_level");
                                                           
        if (!empty($id_users)) {            
            $this->db->where("id_users", $id_users);            
        }        
        if (!empty($id_people)) {            
            $this->db->like("tbpeople.name", $id_people);            
        }                
        if (!empty($login)) {            
            $this->db->like("login", $login);            
        }                
        if (!empty($id_user_level)) {            
            $this->db->like("tbuser_level.code", $id_user_level);            
        }
		$this->db->where("tbusers.status", '1');
		                                
        if ($per_page != 0) {            
            $this->db->limit($per_page, $reg_initial);            
        }
		
        return $this->db->get('tbusers');        
    }    

	function return_user_per_people($id_people="") {
			
		if (trim($id_people) == "" || $id_people == 0) { return FALSE;	}
				
		$this->db->where("tbusers.id_people", $id_people);
		
        return $this->db->get('tbusers')->row();		
	}
              
    function returns_people_without_user() {

        //$this->db->select("tbpeople.*");        
		//$this->db->join("tbusers", "tbusers.id_people <> tbpeople.id_people", 'RIGHT');        
		//$query = $this->db->get("tbusers");
		//echo $this->db->last_query();
		//return $this->db->get("tbpeople");
		$query = " SELECT tbpeople.* FROM tbpeople WHERE tbpeople.status = '1' AND tbpeople.id_people "; 
   		$query .= " NOT IN (SELECT tbusers.id_people FROM tbusers WHERE tbusers.status = '1')";
		$ret = $this->db->query($query);
		
		return $ret;			
	}

}
