<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userlevel extends MY_controller {
            
        public function __construct() {

            parent::__construct();                          
        }

        public function index() {
        
            $this->session->userdata("ins_data", '');        
        
            $this->load->library('pagination');

            $total_general = $this->m_user_level-> total_user_level();
            $per_page = $this->m_setup->return_setup()->row()->items_per_page;
            
            $reg_initial = $this->uri->segment(3, 0);
            
            $config['base_url'] = base_url('userlevel/index');
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
            $data['tipo'] = '';
            $data['pagination'] = $this->pagination->create_links();                    
            $data['consult'] = $this->m_user_level->return_user_level(0, $reg_initial, $per_page, 1);                                   
           //$sql = $this->m_user_level->db->last_query();

            $data['name_view'] = 'v_user_level';                       
            $this->load->view('v_layout', $data);
    }
        
        public function save_user_level() {            

            $id_user_level = $this->input->post("id_user_level");
                                   
            if ($id_user_level == 0) {
                    
                $query = $this->m_user_level->save_user_level();                                
                $this->session->set_userdata("ins_data", '0');
                if ($query) {                    
                    $this->session->set_userdata("ins_data", '1');                                                                                
                    $id_user_level = $this->session->userdata("id_user_level_inserted");                    
                                        
                    $message = standard_message( 1, "User Level Registered Successfully....", 
                        array( "<a href='". base_url() ."' class='btn btn-info'>Home </a>", 
                               "<a href='". base_url('userlevel') ."' class='btn btn-primary'> User Level </a>",
                               "<a href='". base_url('userlevel/new_user_level') ."' class='btn btn-primary'> New User Level </a>",
                               "<a href='". base_url('userlevel/edit_user_level/'.$id_user_level) ."' class='btn btn-primary'>Continue </a>") );
                }
                else {
                    $mens = "Error in User Level Registered....";
                    
                    $error_ins_user_level = $this->session->userdata("error_ins_user_level");
                    if (trim($error_ins_user_level) != '') {
                        $mess = "Level User already exists, Please Check  !!! - ";
                    }
                    
                    $message = standard_message( 4, $mess, 
                        array( "<a href='". base_url() ."' class='btn btn-info'>Home </a>", 
                               "<a href='". base_url('userlevel') ."' class='btn btn-primary'>User Level </a>",                                                                                    
                               "<a href='". base_url('userlevel/new_user_level') ."' class='btn btn-primary'>New User Level </a>" ) );         
                }
                
                $this->load->view('v_layout', $message);
            }
            
            elseif ($id_user_level > 0) {
                
                $query = $this->m_user_level->save_user_level();

                if ($query) {                                        
                    $message = standard_message( 1, "User Level Updated Successfully....", 
                        array( "<a href='". base_url() ."' class='btn btn-info'>Home </a>", 
                               "<a href='". base_url('userlevel') ."' class='btn btn-primary'>User Level </a>",                                                                                    
                               "<a href='". base_url('userlevel/novo_user_level') ."' class='btn btn-primary'>New User Level </a>" ) );         
                }
                else {
                    $message = standard_message( 4, "User Level Update Error....", 
                        array( "<a href='". base_url() ."' class='btn btn-info'>Home </a>", 
                               "<a href='". base_url('userlevel') ."' class='btn btn-primary'>User Level </a>",                                                                                    
                               "<a href='". base_url('userlevel/new_user_level') ."' class='btn btn-primary'>New User Level </a>" ) );         
                }
                
                $this->load->view('v_layout', $message);                                
            }
        }
        
        public function new_user_level() {                
            $data['name_view'] = 'v_form_user_level';                        
            $this->load->view('v_layout', $data);                                    
        }
        
        public function edit_user_level($id_user_level = 0) {            
            //$id_user_level = $this->uri->segment(3,0); 

            $ins_data = $this->session->userdata("ins_data");
            $consult = $this->m_user_level->return_user_level($id_user_level)->row();                                                
            $data['consult'] = $consult;            
                        
            $data['id_user_level'] = isset($consult->id_user_level) ? $consult->id_user_level : '';            
            $data['name_view'] = 'v_form_user_level';
                        
            $this->load->view('v_layout', $data);
        }
        
        public function delete_user_level($id_user_level) {
            
            if ( $this->m_user_level->delete_user_level($id_user_level) ) {                                                       
                $message = standard_message( 1, "Excluded User Success Level....", 
                    array( "<a href='". base_url() ."' class='btn btn-info'>Home </a>", 
                           "<a href='". base_url('userlevel') ."' class='btn btn-primary'>User Level </a>",                                                                                    
                           "<a href='". base_url('userlevel/new_user_level') ."' class='btn btn-primary'>New User Level </a>" ) );         
            }
            else {
                $message = standard_message( 4, "User Level Deletion Error....", 
                    array( "<a href='". base_url() ."' class='btn btn-info'>Home </a>", 
                           "<a href='". base_url('userlevel') ."' class='btn btn-primary'>User Level </a>",                                                                                    
                           "<a href='". base_url('userlevel/new_user_level') ."' class='btn btn-primary'>New User Level </a>" ) );         
            }                
            $this->load->view('v_layout', $message);                                
        }       
                
        public function autocomplete(){            
            $term = $this->input->get("term");            
            $consult = $this->m_user_level->autocomplete($term);
            
            //$return = $consult;
            $return = array();
            
            echo json_encode($return);            
        }
     
        public function filter() {
            $this->load->library('pagination');                                               
 
            $var_post = $this->input->post(); 
            if (!empty($var_post)) {
                $this->session->set_userdata("id_user_level", $this->input->post("filter_id_user_level"));
                $this->session->set_userdata("level", $this->input->post("filter_level"));
				$this->session->set_userdata("code", $this->input->post("filter_code"));
                $this->session->set_userdata("description_user_level", $this->input->post("filter_description_user_level"));        
            }

            $data['id_user_level'] = $this->session->userdata("id_user_level");
            $data['level'] = $this->session->userdata("level");
            $data['code'] = $this->session->userdata("code");			
            $data['description_user_level'] = $this->session->userdata("description_user_level");        
                                                                       
            $total_general = $this->m_user_level-> total_user_level_filtered();
            $per_page = $this->m_setup->return_setup()->row()->items_per_page;
            
            $reg_initial = $this->uri->segment(3, 0);
            
            $config['base_url'] = base_url('userlevel/filter');
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
            
            $data['consult'] = $this->m_user_level->filter_user_level($reg_initial, $per_page);
                        
            $data['name_view'] = 'v_user_level';                                                                                               
            $this->load->view('v_layout', $data);
        }
     
    public function order($field, $order) {
        
        $this->session->set_userdata("field", $field);
        $this->session->set_userdata("order", $order);
        
        redirect(base_url('userlevel'));                
    }

    public function window_data_complete_user_level() {
         
        $id_user_level = $this->input->post("id_user_level");
        
        $consult = $this->m_user_level->return_user_level($id_user_level)->result_array();
                
        $data_user_level = $consult[0];
        echo json_encode($data_user_level);
    }

}
