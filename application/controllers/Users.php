<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class users extends MY_controller {

    public function index() {        
        $this->session->userdata("ins_data", '');        
    
        $this->load->library('pagination');

        $total_general = $this->m_users->total_users();
        $per_page = $this->m_setup->return_setup()->row()->items_per_page;
        
        $reg_initial = $this->uri->segment(3, 0);
        
        $config['base_url'] = base_url('users/index');
        $config['total_rows'] = $total_general;
        $config['per_page'] = $per_page;
        
        $config['num_links'] = 3;
                    
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = "<li class='active'> <span>";
        $config['cur_tag_close'] = '</span> </li>';
                    
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
                                
        $data['total_consult'] = $total_general;            
        $data['type'] = '';
        $data['pagination'] = $this->pagination->create_links();
		                    
        $data['consult'] = $this->m_users->return_users(0, $reg_initial, $per_page);                                   
		        
        $data['name_view'] = 'v_users';
        $this->load->view('v_layout', $data);
    }
    
    public function edit($id_users = 0) {
			
        $data['user'] = $this->m_users->return_users($id_users)->row();        
		$data['list_user_level'] = $this->m_user_level->list_user_level();
		$data['list_people'] = $this->m_users->returns_people_without_user();		
				        
        $data['name_view'] = 'v_form_users';
        $this->load->view('v_layout', $data);        
    }
    
    public function new_user(){

		$data['list_user_level'] = $this->m_user_level->list_user_level();
		$data['list_people'] = $this->m_users->returns_people_without_user();		        
        $data['name_view'] = 'v_form_users';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_user() {
		
        $id_users = $this->input->post("id_users");                    
        $old_pasword = $this->input->post("old_pasword");
        $new_pasword = $this->input->post("new_pasword");
       
        $verify_password = TRUE;
        $pass = "";
                  
        if ( (($old_pasword != '') && ($new_pasword != ''))  || (($new_pasword != '') && (!empty($id_users))) ) {
            $pass = "and pasword";
            $verify_password = $this->m_users->verify_password();
        }    
                
        if ($verify_password) {            
            if ($this->m_users->save_user()) {            
                $message = standard_message( 1, "Data ".$pass." the user updated successfully....", 
                     array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                            "<a href='". base_url("users") ."' class='btn btn-primary'> Users </a>",                                                                                    
                            "<a href='". base_url('users/new_user') ."' class='btn btn-primary'> New User </a>"  ));                
            }
            else {
                $message = standard_message( 4, " User Update Error....", 
                     array( "<a href='". base_url() ."' class='btn btn-info'>Home </a>", 
                            "<a href='". base_url('users') ."' class='btn btn-primary'> Users </a>",                                                                                    
                            "<a href='". base_url('users/new_user') ."' class='btn btn-primary'>New User </a>"  ));                
            }
                
            $this->load->view('v_layout', $message);
                                    
        } else {                            
            $this->session->set_flashdata("Error", "<span style='color: #f00;'> Old Password Incorrect, no saved information, Retype. </span>");            
            redirect(base_url("users/edit/$id_users"));
        }                
    }
         
    public function delete($id_users){
           
        $ret = $this->m_users->delete($id_users);
        
        if ($ret == 0) {
            $message = standard_message( 1, "Excluded Successfully User....", 
                 array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                        "<a href='". base_url("users") ."' class='btn btn-primary'> Users </a>",                                                                                    
                        "<a href='". base_url('users/new_user') ."' class='btn btn-primary'>New User </a>" ));                        
        } else {
              if ($ret == 1451) {
                 $message = standard_message( 4, "Error in Deletion, contact support.....", 
                 array( "<a href='". base_url() ."' class='btn btn-info'>Home </a>", 
                        "<a href='". base_url('users') ."' class='btn btn-primary'> Users </a>",                                                                                    
                        "<a href='". base_url('users/new_user') ."' class='btn btn-primary'>New User </a>"  ));                                
              }
        } 

        $this->load->view('v_layout', $message);                      
    }
						
    public function autocomplete() {
        
        $term = $this->input->get("term");
        
        $consult = $this->m_users->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }
 
    public function filter() {

        $this->load->library('pagination');                                               
 
        $var_post = $this->input->post();
 
        if (!empty($var_post)) {
            $this->session->set_userdata("id_users", $this->input->post("filtro_id_users"));
            $this->session->set_userdata("id_people", $this->input->post("filtro_id_people"));
            $this->session->set_userdata("login", $this->input->post("filtro_login"));
            $this->session->set_userdata("id_user_level", $this->input->post("filtro_id_user_level"));
        }

        $dados['id_users'] = $this->session->userdata("id_users");
        $dados['id_people'] = $this->session->userdata("id_people");
        $dados['login'] = $this->session->userdata("login");        
        $dados['id_user_level'] = $this->session->userdata("id_user_level");        
                                                                   
        $total_general = $this->m_users-> total_users_filtered();
        $per_page = $this->m_setup->return_setup()->row()->items_per_page;;
        
        $reg_initial = $this->uri->segment(3, 0);
        
        $config['base_url'] = base_url('users/filter');
        $config['total_rows'] = $total_general;
        $config['per_page'] = $per_page;
        
        $config['num_links'] = 3;
                    
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = "<li class='active'> <span>";
        $config['cur_tag_close'] = '</span> </li>';
                    
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
 
        $data['total_consult'] = $total_general;           
        $data['type'] = '';
        $data['pagination'] = $this->pagination->create_links();                    
        			
        $data['consult'] = $this->m_users->filter_users($reg_initial, $per_page);
        //echo $this->db->last_query();
                    
        $data['name_view'] = 'v_users';                                                                                               
        $this->load->view('v_layout', $data);
    }
     
    public function order($field, $order) {
        
        $this->session->set_userdata("field", $field);
        $this->session->set_userdata("order", $order);
        
        redirect(base_url('users'));                
    }

    public function window_data_complete_user() {
         
        $id_users = $this->input->post("id_users");
        
        $consult = $this->m_users->return_users($id_users)->result_array();
        //print_r($consult);        
        $data_user = $consult[0];
        echo json_encode($data_user);
    }
	

/**************************************************************************************************
*
*		Method of users external
*  
* **************************************************************************************************/

	public function login_external() {
		//session_start();

        $user = $this->input->post("email_login");
        $password = $this->input->post("password_login");        
		
        $consult = $this->m_users->recovery_user_password($user, $password);
		 		 		 
        if (count($consult) == 0) {
            $this->session->set_userdata("logged", "0");                    
            echo "Incorrect User/Password, retype ! ";                                       
            //redirect(base_url('home/external_questions'));                
        
        } else {
			$data = array(
				"id_users" => $consult[0]['id_users'],
				"id_people" => $consult[0]['id_people']
			);

        	$this->session->set_userdata("source", 'home');
			
			//echo "Name => " .$consult[0]['name'];
			//echo "<br /><br /><br />";
			
			if ($this->make_login($consult[0], $user, $consult[0]['name'])) {
				echo $consult[0]['name'];			// "Login Ok ! ";				
			} else {
				echo "message", "Incorrect User/Password, retype ! ";
			}
		}
	}

	public function save_external() {
		
		//print_r($_POST);
		//exit;
        $first_name = $this->input->post("first_name");
		$last_name = $this->input->post("last_name");						
		$email = $this->input->post("email_login");
		
		if (trim($first_name) == "" || trim($last_name) == "" || trim($email) == "") {
			return FALSE;
		}
				
		$ret = $this->m_users->save_external();	
		
		if (count($ret) > 0) {
			
			if ($this->make_login($ret)) {						

				echo "Ok, wrote and logging user !";
			} else {
				echo "Error, login user !";
			}
		} else {
			echo "Error, insert user, contact Support !";
		}
	}
	
	public function search_email() {
				
		$email = $_GET['email'];
				
		$existe_email = $this->m_users->search_email($email); 
		
		if (trim($existe_email) == '') {
			echo 'Ok';
		
		} else {		
			echo $existe_email;
		}
	}

	public function make_login($dados, $em = "", $nm = "") {
					
		//$this->clear_all();
		
		if (trim($nm) == "" || trim($em) == "") {		
	        $first_name = $this->input->post("first_name");
			$last_name = $this->input->post("last_name");
			$name = $first_name ." ". $last_name;				 
			$email = $this->input->post("email_login");

		} else {
			$name = $nm;
			$email = $em;
		}
			
    	$this->session->set_userdata("logged", "3");
        $this->session->set_userdata("user", $email);					
        $this->session->set_userdata("id_users", $dados['id_users']);
		$this->session->set_userdata("category_user", 5);
		
		$this->session->set_userdata("id_people_admin", $dados['id_people']);
		$this->session->set_userdata("name_user", $name);
		$this->session->set_userdata("dt_creation", date("Y-m-d"));						           
		$this->session->set_userdata("email_admin", $email);
		        
		$this->session->set_userdata("id_level_users", 4);
		$this->session->set_userdata("origem", '0');
		$this->session->set_userdata("itens_per_page", $this->m_setup->return_setup()->row()->items_per_page);

		$this->create_cookie();
						
		return TRUE;
	}

	public function clear_all() {		
		$filename = URL_UPL_QUESTIONS. $this->session->userdata('name_file');
		unlink($filename);
		
		$var = $this->session->userdata("logged");
		$logged = isset($var) ? $var : 0;
		$name_cookie = "avaleea";
		if ($logged == "3") {
			$name_cookie = "avaleea_".$this->session->userdata("user");
		}
						
		$this->session->sess_destroy();
		$this->session->unset_userdata('logged');
		$this->session->unset_userdata('source');
		$this->session->unset_userdata('name_file');
		$this->session->unset_userdata('file_pointer');
		$this->session->unset_userdata('save_questions_external');
		$this->session->unset_userdata("id_edit");		
		$this->session->unset_userdata("type_edit");
					
		setcookie('avaleea');							
//		setcookie('avaleea', '', time() - 3600, "http://localhost/avaleea/home/external_questions");
		unset($_COOKIE["avaleea"]);

		setcookie($name_cookie);			
//		setcookie($name_cookie, '', time() - 3600, ""http://localhost/avaleea/home/external_questions"");
		unset($_COOKIE[$name_cookie]);
		
		$_COOKIE = array();
		return TRUE;
	}

	public function create_cookie() {
		$prefix = $this->session->userdata("user");
		$name_file = $prefix ."_". date("Y-m-d") .".avl";

		$name_cookie = "avaleea_". $prefix;
		$name_file = $name_cookie;
		$time = time() + (3600*24*30*1*1);	// 30 days expiry date				
		
		$value_cookie = array(
			"identify" => $prefix,
			"name_file" => $name_file,
			"quantity" => $this->session->userdata("save_questions_external")
		);

		$cookie = setcookie($name_cookie, serialize($value_cookie), $time, "http://localhost/avaleea/home/external_questions");
		
		return TRUE;		
	}
}
