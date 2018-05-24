<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class tabsys extends MY_controller {
    
    function __construct() {
        parent::__construct();
	
		$table_sys = $this->uri->segment(3, 0);
		$tabsys = $this->uri->segment(4, 0);
		$origem = $this->uri->segment(5, 0);		

//		if ($origem == "m") {
			$this->session->set_userdata("tabsys", $tabsys);
			$this->session->set_userdata("table_sys", $table_sys);						
//		}
    }

    public function index() {
		
		$origem = $this->session->userdata("origem");
		
		if ($origem == '0') {
	 		$tabsys = $this->uri->segment(4, 0);		
			$table_sys = $this->uri->segment(3, 0);
			$this->session->set_userdata("tabsys", $tabsys);
			$this->session->set_userdata("table_sys", $table_sys);	
		} else {
	 		$tabsys = $this->session->userdata("tabsys");		
			$table_sys = $this->session->userdata("table_sys");
			//$this->session->set_userdata("origem", "0");					
		}		

        $this->session->userdata("ins_data", '');            

        $total_general = $this->m_tabsys->total_tabsys();
        $reg_initial = $this->uri->segment(6, 0);
		$per_page = $this->session->userdata("itens_per_page");
        
		$config = configure_pagination('tabsys/index/'.$table_sys.'/'.$tabsys.'/m', $total_general, $per_page);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
                                
        $data['total_consult'] = $total_general;            
        $data['consult'] = $this->m_tabsys->return_tabsys(0, $reg_initial, $per_page);                                   
		        
        $data['name_view'] = 'v_tabsys';
        $this->load->view('v_layout', $data);
    }
    
	public function verify_table() {		
		$tabsys = $this->uri->segment(3, 0);		
		$ext_table = $this->uri->segment(4, 0);
		redirect(base_url('tabsys')); 
		//echo $tabsys .'<br />'. $ext_table;
		//exit();
		$this->session->set_userdata("tabsys", $tabsys);
		$this->session->set_userdata("table_sys", $table_sys);		
	}

    public function edit($id_tabsys, $table="", $controller="") {

		$this->session->set_userdata("table_sys", $table);
		$this->session->set_userdata("tabsys", $controller);		
				
        $data['tab_sys'] = $this->m_tabsys->return_tabsys($id_tabsys)->row();
        
        $data['name_view'] = 'v_form_tabsys';
        $this->load->view('v_layout', $data);        
    }
    
    public function new_tabsys($table_sys = "", $tabsys = ""){

		$this->session->set_userdata("tabsys", $tabsys);
		$this->session->set_userdata("table_sys", $table_sys);		

        $data['name_view'] = 'v_form_tabsys';
        $this->load->view('v_layout', $data);        
    }
    
    public function save($table_sys = "", $tabsys = "") {
    	
 		$this->session->set_userdata("tabsys", $tabsys);		
		$this->session->set_userdata("table_sys", $table_sys);					
	
		$array = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
          "<a href='". base_url('tabsys/index/'.$table_sys.'/'.$tabsys.'/m') ."' class='btn btn-primary'>". title_table($tabsys). "</a>",                                                                                    
          "<a href='". base_url('tabsys/new_tabsys/'.$table_sys.'/'.$tabsys.'/m') ."' class='btn btn-primary'> New ". title_table($tabsys). "</a>" );                		 
	
	    if ($this->m_tabsys->save()) {            
	        $message = standard_message( 1, " Data Updated Successfully....", $array );                
	    }
	    else {
	        $message = standard_message( 4, " Data Update Error....", $array );                
	    }
	        
		$this->session->set_userdata("origem", "1");			
	    $this->load->view('v_layout', $message);                                    
    }
         
    public function delete($id_tabsys, $table_sys = "", $tabsys = ""){

 		$this->session->userdata("tabsys", $tabsys);		
		$this->session->userdata("table_sys", $table_sys);					
           
        $ret = $this->m_tabsys->delete($id_tabsys);
	
		$array = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
          "<a href='". base_url('tabsys/index/'.$table_sys.'/'.$tabsys.'/m') ."' class='btn btn-primary'>". title_table($tabsys). "</a>",                                                                                    
          "<a href='". base_url('tabsys/new_tabsys/'.$table_sys.'/'.$tabsys.'/m') ."' class='btn btn-primary'> New ". title_table($tabsys). "</a>" );                		 
        
        if ($ret == 0) {
            $message = standard_message( 1, "Excluded Successfully....", $array );                        
        } else {
              if ($ret == 1451) {
                 $message = standard_message( 4, "Error in Deletion, contact support.....", $array );                                
              }
        } 
		$this->session->set_userdata("origem", "1");
        $this->load->view('v_layout', $message);                      
    }
						
    public function autocomplete() {
        
        $term = $this->input->get("term");
        
        $consult = $this->m_tabsys->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }
 
    public function filter() {

        $this->load->library('pagination');                                               
 		$tabsys = $this->session->userdata("tabsys");		
		$table_sys = $this->session->userdata("table_sys");
         
        $var_post = $this->input->post();
 
        if (!empty($var_post)) {
            $this->session->set_userdata("id", $this->input->post("filtro_id"));
            $this->session->set_userdata("code", $this->input->post("filtro_code"));
            $this->session->set_userdata("desc", $this->input->post("filtro_desc"));
        }

        $dados['id'] = $this->session->userdata("id");
        $dados['code'] = $this->session->userdata("code");
        $dados['desc'] = $this->session->userdata("desc");              
                                                                   
        $total_general = $this->m_tabsys-> total_tabsys_filtered();
        $reg_initial = $this->uri->segment(6, 0);
        $per_page = $this->session->userdata("itens_per_page");
        
		$config = configure_pagination('tabsys/filter/'.$table_sys.'/'.$tabsys.'/m', $total_general, $per_page);          
        //$config['base_url'] = base_url('tabsys/filter');
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
 
        $data['total_consult'] = $total_general;           
        $data['consult'] = $this->m_tabsys->filter_tabsys($reg_initial, $per_page);
        //echo $this->db->last_query();
                    
        $data['name_view'] = 'v_tabsys';                                                                                               
        $this->load->view('v_layout', $data);
    }
     
    public function order($field, $order) {
        
        $this->session->set_userdata("field", $field);
        $this->session->set_userdata("order", $order);
        
        redirect(base_url());                
    }

    public function window_data_complete_tabsys() {
         
        $id_tabsys = $this->input->post("id");
        $consult = $this->m_tabsys->return_tabsys($id_tabsys)->result_array();
        //print_r($consult);        
        $data = $consult[0];
        echo json_encode($data);
    }
}
