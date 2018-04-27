<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class alternatives extends MY_controller {

    public function index($id_questions = 0) {        
        $this->session->userdata("ins_data", '');        

        $total_general = $this->m_alternatives->total_alternatives($id_questions);       
        $reg_initial = $this->uri->segment(3, 0);
		$per_page = $this->session->userdata("itens_per_page");		
       
		$config = configure_pagination('alternatives/index', $total_general, $per_page);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
                                
        $data['total_consult'] = $total_general;            
        $data['consult'] = $this->m_alternatives->return_alternatives(0, $reg_initial, $per_page, $id_questions);                                   
		        
        $data['name_view'] = 'v_alternatives';
        $this->load->view('v_layout', $data);
    }
    
    public function edit($id_alternatives = 0) {

        $data['id_alternatives'] = $id_alternatives;			
        $data['alternatives'] = $this->m_alternatives->return_alternatives($id_alternatives)->row();        

		$data['list_questions'] = $this->m_questions->list_questions();
		$data['list_situation'] = $this->m_tabsys->list_tabsys('tbsituation');
								        
        $data['name_view'] = 'v_form_alternatives';
        $this->load->view('v_layout', $data);        
    }
    
    public function new_alternatives() {

		$data['list_questions'] = $this->m_questions->list_questions();
		$data['list_situation'] = $this->m_tabsys->list_tabsys('tbsituation');
						        
        $data['name_view'] = 'v_form_alternatives';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_alternatives() {		

        $id_alternatives = $this->input->post("id_alternatives");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                "<a href='". base_url("alternatives") ."' class='btn btn-primary'> Alternatives </a>",                                                                                    
                "<a href='". base_url('alternatives/new_alternatives') ."' class='btn btn-primary'> New Alternatives </a>" );                

        if ($this->m_alternatives->save_alternatives()) {
        	if ($id_alternatives != 0) {            
            	$message = standard_message( 1, " Alternatives Updated Successfully....", $botoes );
			} else {
				$message = standard_message( 1, " Alternatives Inserted Successfully....", $botoes );
			}
        
        } else {
        	if ($id_alternatives != 0) {
            	$message = standard_message( 4, " Alternatives Update Error....", $botoes);
			} else {
				$message = standard_message( 4, " Alternatives Insert Error....", $botoes);
			} 
        }
            
        $this->load->view('v_layout', $message);                                    
    }
         
    public function delete($id_alternatives){
           
        $ret = $this->m_alternatives->delete($id_alternatives);

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
            "<a href='". base_url("alternatives") ."' class='btn btn-primary'> Alternatives </a>",                                                                                    
            "<a href='". base_url('alternatives/new_alternatives') ."' class='btn btn-primary'> New Alternatives </a>" );                
        
        if ($ret == 0) {
            $message = standard_message( 1, " Excluded Successfully Alternatives....", $botoes ); 

        } else {
             $message = standard_message( 4, " Error in Deletion, contact support.....", $botoes ); 
        } 

        $this->load->view('v_layout', $message);                      
    }
						
    public function autocomplete() {
        
        $term = $this->input->get("term");        
        $consult = $this->m_alternatives->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }
 
    public function filter() {

        $this->load->library('pagination');                                               
 
        $var_post = $this->input->post();
 
        if (!empty($var_post)) {
            $this->session->set_userdata("id_alternatives", $this->input->post("filtro_id_alternatives"));
            $this->session->set_userdata("id_questions", $this->input->post("filtro_id_questions"));            
            $this->session->set_userdata("description_alternatives", $this->input->post("filtro_description_alternatives"));			
        }

        $dados['id_alternatives'] = $this->session->userdata("id_alternatives");
        $dados['id_questions'] = $this->session->userdata("id_questions");
        $dados['description_alternatives'] = $this->session->userdata("description_alternatives");        
                                                                   
        $total_general = $this->m_alternatives-> total_alternatives_filtered();
        $reg_initial = $this->uri->segment(3, 0);
		$per_page = $this->session->userdata("itens_per_page");		
       
		$config = configure_pagination('alternatives/filter', $total_general, $per_page);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
  
        $data['total_consult'] = $total_general;           
        $data['consult'] = $this->m_alternatives->filter_alternatives($reg_initial, $per_page);
        //echo $this->db->last_query();
                    
        $data['name_view'] = 'v_alternatives';                                                                                               
        $this->load->view('v_layout', $data);
    }
     
    public function order($field, $order) {
        
        $this->session->set_userdata("field", $field);
        $this->session->set_userdata("order", $order);
        
        redirect(base_url('alternatives'));                
    }

    public function window_data_complete_alternatives() {
         
        $id_alternatives = $this->input->post("id_alternatives");
        
        $consult = $this->m_alternatives->return_alternatives($id_alternatives)->result_array();
        //print_r($consult);        
        $data_alternatives = $consult[0];
        echo json_encode($data_alternatives);
    }

	public function return_alternatives_questions() {
        	
        $id_questions = $this->input->post("id_questions");		
		$alternatives = $this->m_alternatives->return_alternatives(0, 0, 0, $id_questions);
		
		$html = "";
		
		if (count($alternatives) > 0) {			
			$html = '
			  <select class="form-control" size="3" id="selectAlternatives" name="selectAlternatives" onchange="return store_alternatives(this);" required>
			  	<option selected="selected" value="#">Select Alternatives</option> ';
		  	
			  foreach ($alternatives->result() as $alternative) {
				  $html .= ' <option value="' .$alternative->id. '">' .$alternative->description_alternatives. ' </option> ';				  															  ;
			  }					
			  ' </select> ';
		}

		echo $html;	
	}
	
	public function return_alternatives_client() {
        	
        $id_alternatives = $this->input->post("id_alternatives");
		
		if ($id_alternatives == "" or $id_alternatives == 0 ) {			
			$array = array();
			$this->session->set_userdata("alternatives", "");			
			$this->session->set_userdata("open_alternatives", '0');

		} else {
			$this->session->set_userdata("open_alternatives", '1');				
			$alternatives = $this->m_alternatives->return_complete_data($id_alternatives);
			
			$this->session->set_userdata("alternatives", $alternatives);
			$this->session->set_userdata("id_alternatives", $alternatives[0]['id_alternatives']);
						
			foreach ($alternatives as $arr) {
				foreach ($arr as $key => $value) {										
					$array[$key] = $value;
				}
			}			
		}		
		/*	
		print_r($alternatives);
		exit;
		*/
		echo json_encode($array);;
	}
	public function save_alternatives_author($value='') {
		
		$this->session->set_userdata("save_alternatives", "0");
	    $id_alternatives = $this->input->post("id_alternatives");		
					
        if ($this->m_alternatives->save_alternatives_authors()) {
        		
			if ($id_alternatives != 0) {
				$msg = " Alternatives Updated Successfully ! ";
				$msg_pend = " Check the pending of the alternative, some may prevent the use of the questions in questionnaires. ";
				$ret = " <br /><br /><div class='callout callout-warning'> <p style='color: #000;'> ". $msg ." </p> <p style='color: #000;'> ". $msg_pend ." </p> </div> <br /> ";
							
			} else {
				//$erro = $this->db->last_query();
				$msg = " Alternatives Inserted Successfully ! ";
				$msg_pend = " You just created a alternative, now you need to create the rest of the alternatives. ";
				$ret = "<br /><br /><div class='callout callout-success'> <p style='color: #000;'> ". 
							$msg ."</p> <p style='color: #000;'> ". $msg_pend ."</p> </div> <br />";
			}			
			$this->session->set_userdata("save_alternatives", "1");			
      
        } else {
        	$msg = " Alternatives Registration Error ! ";
			$msg_pend = " Check the form completion ! ";
			$ret = "<div class='callout callout-danger'> <p> ". $msg ."</p> <p> ". $msg_pend ."</p> </div>";	
		}            
		
		echo $ret;
		exit;
	}
		
	public function checks_disputes($id_alternatives, $quantity_issues)	{
			
		$tot_alternatives = $this->m_alternatives->total_alternatives($id_alternatives);
		$ret = "";
		
		if ($tot_alternatives == 0) {
			$ret = array( "Questions does not have registered Alternatives",
						  "There are Pending Issues that will prevent the use of the Application Questionnaire"						
						); 
		
		} elseif ($tot_alternatives != $quantity_issues ) {
			$ret = array( "Number of alternatives different from that reported in the Questions",
						  "There are Pending Issues that will prevent the use of the Application Questionnaire"						
						); 
		}
		return $ret;
	}

	
}
