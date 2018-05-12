<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class questions extends MY_controller {

    public function index($id_questionnaries = 0) {        
        $this->session->userdata("ins_data", '');        

        $total_general = $this->m_questions->total_questions($id_questionnaries);        
        $reg_initial = $this->uri->segment(3, 0);
		$per_page = $this->session->userdata("itens_per_page");
        
		$config = configure_pagination('questions/index', $total_general, $per_page);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();	
                                
        $data['total_consult'] = $total_general;            		                    
        $data['consult'] = $this->m_questions->return_questions(0, $reg_initial, $per_page, $id_questionnaries);                                   
		        
        $data['name_view'] = 'v_questions';
        $this->load->view('v_layout', $data);
    }
    
    public function edit($id_questions = 0) {

        $data['id_questions'] = $id_questions;			
        $data['questions'] = $this->m_questions->return_questions($id_questions)->row();        

		$data['list_questionnaries'] = $this->m_questionnaries->list_questionnaries();
		$data['list_alternatives_type'] = $this->m_tabsys->list_tabsys('tbalternatives_type');
		$data['list_situation'] = $this->m_tabsys->list_tabsys('tbsituation');
								        
        $data['name_view'] = 'v_form_questions';
        $this->load->view('v_layout', $data);        
    }
    
    public function new_questions() {

		$data['list_questionnaries'] = $this->m_questionnaries->list_questionnaries();
		$data['list_alternatives_type'] = $this->m_tabsys->list_tabsys('tbalternatives_type');
		$data['list_situation'] = $this->m_tabsys->list_tabsys('tbsituation');
						        
        $data['name_view'] = 'v_form_questions';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_questions() {		

        $id_questions = $this->input->post("id_questions");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                "<a href='". base_url("questions") ."' class='btn btn-primary'> Questions </a>",                                                                                    
                "<a href='". base_url('questions/new_questions') ."' class='btn btn-primary'> New Questions </a>"  );                

        if ($this->m_questions->save_questions()) {
        	if ($id_questions != 0) {            
            	$message = standard_message( 1, " Questions Updated Successfully....", $botoes );
			} else {
				$message = standard_message( 1, " Questions Inserted Successfully....", $botoes );
			}
        
        } else {
        	if ($id_questions != 0) {
            	$message = standard_message( 4, " Questions Update Error....", $botoes);
			} else {
				$message = standard_message( 4, " Questions Insert Error....", $botoes);
			} 
        }
            
        $this->load->view('v_layout', $message);                                    
    }
         
    public function delete($id_questions){
           
        $ret = $this->m_questions->delete($id_questions);

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
            "<a href='". base_url("questions") ."' class='btn btn-primary'> Questions </a>",                                                                                    
            "<a href='". base_url('questions/new_questions') ."' class='btn btn-primary'> New Questions </a>" );                
        
        if ($ret == 0) {
            $message = standard_message( 1, " Excluded Successfully Questions....", $botoes ); 

        } else {
             $message = standard_message( 4, " Error in Deletion, contact support.....", $botoes ); 
        } 

        $this->load->view('v_layout', $message);                      
    }
						
    public function autocomplete() {
        
        $term = $this->input->get("term");        
        $consult = $this->m_questions->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }
 
    public function filter() {

        $this->load->library('pagination');                                               
 
        $var_post = $this->input->post();
 
        if (!empty($var_post)) {
            $this->session->set_userdata("id_questions", $this->input->post("filtro_id_questions"));
            $this->session->set_userdata("id_questionnaries", $this->input->post("filtro_id_questionnaries"));            
            $this->session->set_userdata("name_questions", $this->input->post("filtro_name_questions"));
            $this->session->set_userdata("enunciation", $this->input->post("filtro_enunciation"));			
        }

        $dados['id_questions'] = $this->session->userdata("id_questions");
        $dados['id_questionnaries'] = $this->session->userdata("id_questionnaries");
        $dados['name_questions'] = $this->session->userdata("name_questions");        
        $dados['enunciation'] = $this->session->userdata("enunciation");        
                                                                   
        $total_general = $this->m_questions-> total_questions_filtered();
        $reg_initial = $this->uri->segment(3, 0);
		$per_page = $this->session->userdata("itens_per_page");
        
		$config = configure_pagination('questions/filter', $total_general, $per_page);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();	
 
        $data['total_consult'] = $total_general;                   			
        $data['consult'] = $this->m_questions->filter_questions($reg_initial, $per_page);
        //echo $this->db->last_query();
                    
        $data['name_view'] = 'v_questions';                                                                                               
        $this->load->view('v_layout', $data);
    }
     
    public function order($field, $order) {
        
        $this->session->set_userdata("field", $field);
        $this->session->set_userdata("order", $order);
        
        redirect(base_url('questions'));                
    }

    public function window_data_complete_questions() {
         
        $id_questions = $this->input->post("id_questions");
        
        $consult = $this->m_questions->return_questions($id_questions)->result_array();
        //print_r($consult);        
        $data_questions = $consult[0];
        echo json_encode($data_questions);
    }

	public function return_questions_questionnaires() {
        	
        $id_questionnaries = $this->input->post("id_questionnaries");		
		$questions = $this->m_questions->return_questions(0, 0, 0, $id_questionnaries);
		
		$html = "";
		
		if (count($questions) > 0) {			
			$html = '
			  <select class="form-control" size="3" id="selectQuestions" name="selectQuestions" onchange="" required>
			  	<option selected="selected" value="">Select Questions</option> ';
		  	
			  foreach ($questions->result() as $question) {
				  $html .= ' <option value="' .$question->id. '">' .$question->title_questions. ' </option> ';				  															  ;
			  }					
			  ' </select> ';
		}

		echo $html;	
	}
	
	public function return_questions_client() {
        	
        $id_questions = $this->input->post("id_questions");
		
		if ($id_questions == "" or $id_questions == 0 ) {			
			$array = array();
			$this->session->set_userdata("questions", "");			
			$this->session->set_userdata("open_questions", '0');

		} else {
			$this->session->set_userdata("open_questions", '1');				
			$questions = $this->m_questions->return_complete_data($id_questions);
			
			$this->session->set_userdata("questions", $questions);
			$this->session->set_userdata("id_questions", $questions[0]['id_questions']);
			$this->session->set_userdata("id_cfg_questions", $questions[0]['id_cfg_questions']);
			$this->session->set_userdata("title_questions", $questions[0]['title_questions']);						              		
														
			foreach ($questions as $arr) {
				foreach ($arr as $key => $value) {										
					$array[$key] = $value;
				}
			}			
		}		

		echo json_encode($array);;
	}

	public function save_questions_author($value='') {
		
		$this->session->set_userdata("save_questions", "0");
	    $id_questions = $this->input->post("id_questions");
		
		$id_questionnaries = $this->input->post("id_questionnariesq");		
					
        if ($this->m_questions->save_questions_authors()) {
        		
			if ($id_questions != 0) {
				$msg = " Questions Updated Successfully ! ";
				$msg_pend = " Check the pending of the questions, some may prevent the use of the questionnaire in applications. ";
				$ret = " <br /><br /><div class='callout callout-warning'> <p style='color: #000;'> ". $msg ." </p> <p style='color: #000;'> ". $msg_pend ." </p> </div> <br /> ";
				
				$quantity_alternatives = $this->input->post("quantity_alternatives");
				$pendencias = $this->checks_disputes($id_questions, $quantity_alternatives);
				
				if (count($pendencias) > 0) {
					
					$ret .= " <br /> <div class='callout callout-danger'>";
					$ret .= " <p style='color: #000;'> Pending Issues </p>";
					foreach ($pendencias as $key => $value) {
						
						$ret .= " <p style='color: #000;'> ". $value ." </p> ";						
								
					}
					$ret .= "</div>";
					$ret .= "<br /> <div> <button id='open_alternatives' name='open_alternatives' 
					 						type='button' class='btn btn-success' 
			   		        				data-backdrop='static' data-toggle='modal' 
			   		        				data-target='#formModalAlternatives'>
			   		               		Edit Alternatives
		   		                   </button>";
					$ret .= "<script> $('#id_questions').val('". $id_questions ."'); </script>";
					$ret .= "<script> $('#id_questionnaries').val('". $id_questionnaries ."'); </script>  </div>";
				}
			
			} else {	
				$id = $this->session->userdata("id_questions_save");
				$idq = $this->session->userdata("id_questionnaries");
				
				$msg = " Questions Inserted Successfully ! ";
				$msg_pend = " You just created a questions, so that it can be used in an questionnaire, 
								you must now create the alternatives. ";
				$ret = "<br /><br /><div class='callout callout-success'> <p style='color: #000;'> ". 
							$msg ."</p> <p style='color: #000;'> ". $msg_pend ."</p> </div> <br />";

				$ret .= "<div style='margin-top: 20px;'> <button id='open_alternatives' name='open_alternatives' 
				 						type='button' class='btn btn-success' 
		   		        				data-backdrop='static' data-toggle='modal' 
		   		        				data-target='#formModalAlternatives'>
		   		               		Edit Alternatives
	   		                   </button>";
							   
				$ret .= "<script> $('#id_questions').val('". $id ."'); </script>";
				$ret .= "<script> $('#id_questionnaries').val('". $idq ."'); </script>  </div>";
			}			
			$this->session->set_userdata("save_questions", "1");			
			
			$alternatives = $this->m_alternatives->return_alternatives(0, 0, 0, $id_questions)->result_array();			
			$this->session->set_userdata("alternatives", $alternatives);					
        
        } else {
        	$msg = " Questions Registration Error ! ";
			$msg_pend = " Check the form completion ! ";
			$ret = "<div class='callout callout-danger'> <p> ". $msg ."</p> <p> ". $msg_pend ."</p> </div>";	
		}            
		
		echo $ret;
		exit;
		//return TRUE;
	}
		
	public function checks_disputes($id_questions, $quantity_issues)	{
			
		$tot_questions = $this->m_alternatives->total_alternatives($id_questions);
		$ret = "";
		
		if ($tot_questions == 0) {
			$ret = array( "Questions does not have registered Alternatives",
						  "There are Pending Issues that will prevent the use of the Application Questionnaire"						
						); 
		
		} elseif ($tot_questions != $quantity_issues ) {
			$ret = array( "Number of alternatives different from that reported in the Questions",
						  "There are Pending Issues that will prevent the use of the Application Questionnaire"						
						); 
		}
		return $ret;
	}

	

/**************************************************************************************************
*
*		Method of tbcfg_questions
*  
* **************************************************************************************************/
    
    public function edit_cfg_questions($id_questions = 0) {

        $data['id_questions'] = $id_questions;			
        $data['cfg_questions'] = $this->m_questions->return_cfg_questions($id_questions)->row();        

		$data['list_presentation_type'] = $this->m_tabsys->list_tabsys('tbpresentation_type');
		$data['list_mandatory_answers'] = $this->m_tabsys->list_tabsys('tbmandatory_answers');						
						        
        $data['name_view'] = 'v_cfg_questions';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_cfg_questions() {		

        $id_cfg_questions = $this->input->post("id_cfg_questions");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
	        "<a href='". base_url("questions") ."' class='btn btn-primary'> Questions </a>",                                                                                    
	        "<a href='". base_url('questions/edit_cfg_questions/'.$id_cfg_questions) ."' class='btn btn-primary'> Continue Editing </a>" );                

        if ($this->m_questions->save_cfg_questions()) {
        	$message = standard_message( 1, " Setup Questions Updated Successfully....", $botoes );
        	        
        } else {
            $message = standard_message( 4, " Setup Questions Update Error....", $botoes);
        }
            
        $this->load->view('v_layout', $message);                                    
    }
						
    public function autocomplete_cfg_questions() {
    	        
        $term = $this->input->get("term");        
        $consult = $this->m_questions->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }

	

/**************************************************************************************************
*
*		Method of questions external
*  
* **************************************************************************************************/


	public function save_external() {
		ini_set('display_errors', 1);
		error_reporting(E_ALL);

		$tot_bytes = 0;
		$dir = "c:/wamp64/www/avaleea/uploads/temp_questions/";
		//$dir = "../uploads/temp_questions/";
				
		$qty_question =	$this->session->userdata("save_questions_external");
		$nro_question = $qty_question + 1;
		
		if ($qty_question == 0) {
			$name_file = randString(12) ."_". date("y-m-d") .".avl";
			$this->session->set_userdata("name_file", $name_file);
			
			$fp = fopen(URL_UPL_QUESTIONS.$name_file, "w");
			if (!$fp) {
				 return FALSE; 
			}
		
		} else {
			$arquivo = $this->session->userdata("name_file");	
			$fp = fopen($dir.$arquivo, "a");
		}
		
	    $type_question = $this->input->post("chosen_option");
		$linha = "[ start - ". $type_question ." - ". str_pad($nro_question, 3, "0", STR_PAD_LEFT) ." ]";
		$tot_bytes += fwrite($fp, $linha ."\r\n");
		
		$text_statement = $this->input->post("text-statement");
		$tot_bytes += fwrite($fp, "stt - ". $text_statement ."\r\n\r\n");		
		
		switch ($type_question) {
			case 'mc':
				$answer1 = trim($this->input->post("answer1"));
				$tot_bytes += fwrite($fp, "asw1 - ". $answer1 ."\r\n");
				
				$answer2 = trim($this->input->post("answer2"));
				$tot_bytes += fwrite($fp, "asw2 - ". $answer2 ."\r\n");
				
				$var = $this->input->post("answer3");
				$answer3 = isset($var) ? trim($var) : '';
				if ($answer3 != '' && substr(trim($answer3), 0, 6) != "Option") {
					$tot_bytes += fwrite($fp, "asw3 - ". $answer3 ."\r\n");
				}
								
				$var = $this->input->post("answer4");
				$answer4 = isset($var) ? trim($var) : '';
				if ($answer4 != '' && substr(trim($answer4), 0, 6) != "Option") {
					$tot_bytes += fwrite($fp, "asw4 - ". $answer4 ."\r\n"); 
				}
				
				$var = $this->input->post("answer5");
				$answer5 = isset($var) ? trim($var) : '';
				if ($answer5 != '' && substr(trim($answer5), 0, 6) != "Option") {
					$tot_bytes += fwrite($fp, "asw5 - ". $answer5 ."\r\n"); 
				}
				
				$right_wrong = $this->input->post("right-wrong");
				$tot_bytes += fwrite($fp, $right_wrong ."\r\n");
				
				break;

			case 'tf':
				$issue1 = trim($this->input->post("issue1"));				
				$issue_tf1 = trim($this->input->post("issue-tf1"));
				$linha = $issue1 ." - ". $issue_tf1;
				$tot_bytes += fwrite($fp, "iss1 - ". $linha ."\r\n");

				$issue2 = trim($this->input->post("issue2"));
				$issue_tf2 = trim($this->input->post("issue-tf2"));
				$linha = $issue2 ." - ". $issue_tf2;
				$tot_bytes += fwrite($fp, "iss2 - ". $linha ."\r\n");

				$var = $this->input->post("issue3");
				$issue3 = isset($var) ? trim($var) : '';
				$var = $this->input->post("issue-tf3");
				$issue_tf3 = isset($var) ? trim($var)  : '';
				if (($issue3 != '') && ($issue_tf3 != '') && (substr(trim($issue_tf3), 0, 5) != "Issue") )
					$linha = $issue3 ." - ". $issue_tf3; {
					$tot_bytes += fwrite($fp, "iss3 - ". $linha ."\r\n"); 
				}
								
				$var = $this->input->post("issue4");
				$issue4 = isset($var) ? trim($var) : '';
				$var = $this->input->post("issue-tf4");
				$issue_tf4 = isset($var) ? trim($var) : '';
				if (($issue4 != '') && ($issue_tf4 != '') && (substr(trim($issue_tf4), 0, 5) != "Issue") )
					$linha = $issue4 ." - ". $issue_tf4; {
					$tot_bytes += fwrite($fp, "iss4 - ". $linha ."\r\n"); 
				}

				$var = $this->input->post("issue5");
				$issue5 = isset($var) ? trim($var) : '';
				$var = $this->input->post("issue-tf5");
				$issue_tf5 = isset($var) ? trim($var) : '';
				if (($issue5 != '') && ($issue_tf5 != '') && (substr(trim($issue_tf5), 0, 5) != "Issue") )
					$linha = $issue5 ." - ". $issue_tf5; {
					$tot_bytes += fwrite($fp, "iss5 - ". $linha ."\r\n"); 
				}
			
				break;

			case 'fg':
				$qty_gap = trim($this->input->post("inlineRadioOptions"));
				$tot_bytes += fwrite($fp, "qty - ". $qty_gap ."\r\n"); 
				
				$part_fg1 = trim($this->input->post("part-fg1"));
				$tot_bytes += fwrite($fp, "pt1 - ". $part_fg1 ."\r\n");
				
				$gap_fg1 = trim($this->input->post("gap-fg1"));
				$tot_bytes += fwrite($fp, "gp1 - ". $gap_fg1 ."\r\n");
				
				$part_fg_last = trim($this->input->post("part-fg-last"));
				$tot_bytes += fwrite($fp, "lst - ". $part_fg_last ."\r\n");

				$var = $this->input->post("part-fg2");
				$part_fg2 = isset($var) ? trim($var) : '';
				if ($part_fg2 != '' && substr(trim($part_fg2), 0, 6) != "Second") {
					$tot_bytes += fwrite($fp, "pt2 - ". $part_fg2 ."\r\n"); 
				}
				
				$var = $this->input->post("gap-fg2");
				$gap_fg2 = isset($var) ? trim($var)  : '';
				if ($gap_fg2 != '' && substr(trim($gap_fg2), 0, 6) != "Second") {
					$tot_bytes += fwrite($fp, "gp2 - ". $gap_fg2 ."\r\n"); 
				}

				$var = $this->input->post("part-fg3");
				$part_fg3 = isset($var) ? trim($var) : '';
				if ($part_fg3 != '' && substr(trim($part_fg3), 0, 5) != "Third") {
					$tot_bytes += fwrite($fp, "pt3 - ". $part_fg3 ."\r\n"); 
				}

				$var = $this->input->post("gap-fg3");
				$gap_fg3 = isset($var) ? trim($var)  : '';
				if ($gap_fg3 != '' && substr(trim($gap_fg3), 0, 5) != "Third") {
					$tot_bytes += fwrite($fp, "gp3 - ". $gap_fg3 ."\r\n"); 
				}				
			
				break;

			case 'sq':
				$text_sq = trim($this->input->post("text-sq"));
				$tot_bytes += fwrite($fp, "sbq - ". $text_sq ."\r\n");

			default:
				
				break;
		}
		
		$linha = "[ end - ".  ($tot_bytes + 20)    ." ]\r\n";
		$tot_bytes += fwrite($fp, $linha);
		
		$tot_bytes += fwrite($fp, "\r\n");
		fclose($fp);
		
		$this->session->set_userdata("save_questions_external", $nro_question);
		$total_questions = str_pad($nro_question, 3, "0", STR_PAD_LEFT); 
		
		//echo "Fim =>";
		echo "Total saved questions: " .$total_questions;		
	}

}
