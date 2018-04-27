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
}
