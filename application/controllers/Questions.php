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

		//ini_set('display_errors', 1);
		//error_reporting(E_ALL);
	
		$total_questions = $this->session->userdata("save_questions_external");

    	$logged = $this->session->userdata("logged");
		
		echo "<br /><br /> save external <br />";
		echo "log => ". $logged ."<br />";
	
    	if ($logged == "2") {
    		echo "<br /><br /> SAlva arquivo<br />";
			    	
			$total_questions = $this->save_external_file();

		} else {
	    	if ($logged == "3") {    	
				$total_questions = $this->save_external_db();
				
			} else {
				$total_questions = "Error, contact Support !";
			}
		}
        echo "Total saved questions: " .$total_questions;		
		//return TRUE;		
	}

	public function save_external_file() {

		$qty_question =	$this->session->userdata("save_questions_external");
		$nro_question = $qty_question + 1;

		$arquivo = $this->session->userdata("name_file");	
		
		$var = $this->session->userdata("file_pointer");
		$fp = isset($var) ? $var : 0;
		
		if ($fp == 0) {
			$fp = fopen(URL_UPL_QUESTIONS.$arquivo, "a+");						
			if ( ! $fp ) {
				return FALSE;
			}			
		}
		
		echo "<br /><br /> external file <br />";
		echo "fp => ". $fp ."<br />";
		
		$tot_bytes = filesize(URL_UPL_QUESTIONS.$arquivo);		
		
	    $type_question = $this->input->post("chosen_option");
		$linha = "[ start - ". $type_question ." - ". str_pad($nro_question, 3, "0", STR_PAD_LEFT) ." ]";
		$tot_bytes += fwrite($fp, $linha ."\r\n");
	    $type_question = $this->input->post("chosen_option");
		
		$text_statement = $this->input->post("text-statement");
		$tot_bytes += fwrite($fp, "stt - ". $text_statement ."\r\n\r\n");		
		
		switch ($type_question) {
			
			case 'mc':
				$right_wrong = $this->input->post("right-wrong");
				$tot_bytes += fwrite($fp, $right_wrong ."\r\n");
				
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
				if (($issue3 != '') && ($issue_tf3 != '') && (substr(trim($issue_tf3), 0, 5) != "Issue") ) {
					$linha = $issue3 ." - ". $issue_tf3; 
					$tot_bytes += fwrite($fp, "iss3 - ". $linha ."\r\n"); 
				}
								
				$var = $this->input->post("issue4");
				$issue4 = isset($var) ? trim($var) : '';
				$var = $this->input->post("issue-tf4");
				$issue_tf4 = isset($var) ? trim($var) : '';
				if (($issue4 != '') && ($issue_tf4 != '') && (substr(trim($issue_tf4), 0, 5) != "Issue") ) {
					$linha = $issue4 ." - ". $issue_tf4;
					$tot_bytes += fwrite($fp, "iss4 - ". $linha ."\r\n"); 
				}

				$var = $this->input->post("issue5");
				$issue5 = isset($var) ? trim($var) : '';
				$var = $this->input->post("issue-tf5");
				$issue_tf5 = isset($var) ? trim($var) : '';
				if (($issue5 != '') && ($issue_tf5 != '') && (substr(trim($issue_tf5), 0, 5) != "Issue") ) {
					$linha = $issue5 ." - ". $issue_tf5;
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

				$part_fg_last = trim($this->input->post("part-fg-last"));
				$tot_bytes += fwrite($fp, "lst - ". $part_fg_last ."\r\n");
				break;

			case 'sq':
				$text_sq = trim($this->input->post("text-sq"));
				$tot_bytes += fwrite($fp, "sbq - ". $text_sq ."\r\n");
				break;
				
			default:
				return FALSE;				
				break;
		}
		
		$linha = "[ end - ".  ($tot_bytes + 20)    ." ]\r\n";
		$tot_bytes += fwrite($fp, $linha);
		
		$tot_bytes += fwrite($fp, "\r\n");
		fclose($fp);
		
		$this->session->set_userdata("save_questions_external", $nro_question);
		$total_questions = str_pad($nro_question, 3, "0", STR_PAD_LEFT);
		
		$id_edit = $this->input->post("id_edit");		
				
		echo "<br /><br />";
		echo "<br /> id - type => ". $id_edit ." - ". $type_question ."<br />";
				
		if ($id_edit != "0" && trim($type_question) != "" && $type_question != "") {								
			$this->delete_questions_file(1, $id_edit);			
			renumber_questions_file();		
		}
		//$ret = $this->update_cookie();	 
		return $total_questions;		
	}

	public function save_external_db() {
				
		//print_r($_POST);
		//exit;
		
		$tot_questions = 0;

	   	$type_question = $this->input->post("chosen_option");		
		$text_statement = $this->input->post("text-statement");
		
		switch ($type_question) {
			
			case 'mc':
				$right_wrong = $this->input->post("right-wrong");				
				$answer1 = trim($this->input->post("answer1"));				
				$answer2 = trim($this->input->post("answer2"));

				$var = $this->input->post("answer3");
				$answer3 = isset($var) ? trim($var) : '';
								
				$var = $this->input->post("answer4");
				$answer4 = isset($var) ? trim($var) : '';
				
				$var = $this->input->post("answer5");
				$answer5 = isset($var) ? trim($var) : '';
				$data = array(
					"type" => 'mc',
					"statement" => $text_statement,
					"right_wrong" => $right_wrong,
					"answer1" => $answer1,
					"answer2" => $answer2,
					"answer3" => $answer3,
					"answer4" => $answer4,
					"answer5" => $answer5
				);								
				break;

			case 'tf':
				$issue1 = trim($this->input->post("issue1"));				
				$issue_tf1 = trim($this->input->post("issue-tf1"));

				$issue2 = trim($this->input->post("issue2"));
				$issue_tf2 = trim($this->input->post("issue-tf2"));

				$var = $this->input->post("issue3");
				$issue3 = isset($var) ? trim($var) : '';
				$var = $this->input->post("issue-tf3");
				$issue_tf3 = isset($var) ? trim($var)  : '';

				$var = $this->input->post("issue4");
				$issue4 = isset($var) ? trim($var) : '';
				$var = $this->input->post("issue-tf4");
				$issue_tf4 = isset($var) ? trim($var) : '';

				$var = $this->input->post("issue5");
				$issue5 = isset($var) ? trim($var) : '';
				$var = $this->input->post("issue-tf5");
				$issue_tf5 = isset($var) ? trim($var) : '';
				$data = array(
					"type" => 'tf',
					"statement" => $text_statement,
					"issue1" => $issue1,
					"issue-tf1" => $issue_tf1,
					"issue2" => $issue2,
					"issue-tf2" => $issue_tf2,
					"issue3" => $issue3,
					"issue-tf3" => $issue_tf3,
					"issue4" => $issue4,
					"issue-tf4" => $issue_tf4,
					"issue5" => $issue5,
					"issue-tf5" => $issue_tf5
				);				
				break;

			case 'fg':
				
				$qty_gap = trim($this->input->post("inlineRadioOptions"));				
				$part_fg1 = trim($this->input->post("part-fg1"));
				$gap_fg1 = trim($this->input->post("gap-fg1"));
				$part_fg_last = trim($this->input->post("part-fg-last"));

				$var = $this->input->post("part-fg2");
				$part_fg2 = isset($var) ? trim($var) : '';				
				$var = $this->input->post("gap-fg2");
				$gap_fg2 = isset($var) ? trim($var)  : '';
				
				$var = $this->input->post("part-fg3");
				$part_fg3 = isset($var) ? trim($var) : '';
				$var = $this->input->post("gap-fg3");
				$gap_fg3 = isset($var) ? trim($var)  : '';
				$data = array(
					"type" => 'fg',
					"statement" => $text_statement,
					"qty_gap" => $qty_gap,
					"part_fg1" => $part_fg1,
					"gap_fg1" => $gap_fg1,
					"part_fg2" => $part_fg2,
					"gap_fg2" => $gap_fg2,
					"part_fg3" => $part_fg3,
					"gap_fg3" => $gap_fg3,
				);				
				break;

			case 'sq':
				$text_sq = trim($this->input->post("text-sq"));
				$data = array(
					"type" => 'fg',
					"statement" => $text_statement,
					"text_sq" => $text_sq,
				);	
				break;
				
			default:
				return FALSE;			
				break;
		}

		$ret = $this->m_questions->save_external($data);

	}
		
	public function update_cookie() {
		//$cookie = $_COOKIE['avaleea'];
		//$ret = unserialize($cookie);	

		$time = time() + (3600*24*1*1*1);	// 1 day expiry date
		
		$value_cookie = array(
			"identify" => $this->session->userdata("prefix"),
			"name_file" => $this->session->userdata("name_file"),
			"quantity" => $this->session->userdata("save_questions_external")
		);

		$cookie = setcookie('avaleea', serialize($value_cookie), $time); //, '', "http://localhost/avaleea/");
		
		$ret = FALSE;
		if ($cookie) { $ret = TRUE; }
		
		return $ret;		
	}

	public function edit_questions_file() {

		$id = $this->input->get("id");
		$id_test = $this->input->get("id_test");
		$type = strtolower($this->input->get("type"));

		$this->session->set_userdata("id_edit", $id);		
		$this->session->set_userdata("id_test", $id_test);		
		$this->session->set_userdata("type_edit", $type);

		return TRUE;
	}

	public function edit_questions_db() {

		$id = $this->input->get("id");

		$this->session->set_userdata("id_test", $id);
		return TRUE;
	}

	public function delete_questions_file($edit=0, $id_edit=0) {
			
		if ($edit == 0) {	
			$id = $this->input->get("id");
		} else {
			
			if ($edit == 1) {
				$id = $id_edit;
			
			} else {
				return FALSE;
			}
		}

		$logged = $this->session->userdata("logged");
		
		if ($logged != "3") {
			$find = FALSE;
						
			$arquivo = $this->session->userdata("name_file");			
			$file = file(URL_UPL_QUESTIONS.$arquivo); 			// Lê todo o arquivo para um vetor
			 			
		    foreach($file as $k => $linha) {		// passa linha a linha do arquivo  
				if ( (substr($linha, 2, 5) == "start") && (substr($linha, 15, 3) == $id) ) {
	        		$find = TRUE;
					if ($k > 0) {
						unset($file[$k-1]); // Eliminando a linha
					}
					unset($file[$k]); // Eliminando a linha
				}	        	
	        	if ( $find && (substr($linha, 2, 3) == "end") ) {
	        		$find = FALSE;
	        		unset($file[$k]); // Eliminando a linha		
	        	}	            
	            if ($find) {
	            	unset($file[$k]); // Eliminando a linha
				}
			} 	     	 
	    	file_put_contents(URL_UPL_QUESTIONS.$arquivo, $file);		// Reescrevendo o arquivo	
			$delete = TRUE;
		
		} else {			
			$delete = $this->m_questions->delete($id);			
		}
		
		$ret = FALSE;
		
		if ($delete) {
			$quantity = ($this->session->userdata("save_questions_external") - 1);
			$this->session->set_userdata("save_questions_external", $quantity);
			$ret = TRUE;
		}		
		return $ret;
	}

	public function prepare_preview_questions() {
			
		$id = $this->input->get("id");
		$logged = $this->session->userdata("logged");			
		
		if ($logged == "3") {		// Search in DB
			
			$data = $this->m_questions->return_questions_completed(0, $id)->result_array();
			$tp = $data[0]['id_alternatives_type'];

			switch ($tp) {
				case 1:
					$type = "mc";				
					break;
				case 2:
					$type = "tf";				
					break;
				case 3:
					$type = "fg";				
					break;
				case 4:
					$type = "sq";				
					break;
			}
			
			$question = $this->format_preview_db($data);
			
			$html = $this->format_preview($question, $type);
			
		} else {					// Search in file

			$arquivo = $this->session->userdata("name_file");			
			$file = file(URL_UPL_QUESTIONS.$arquivo); // Lê todo o arquivo para um vetor 
	
			$qty_fg = 0;
			$find = FALSE;
			$data = array();
			
		    foreach($file as $k => $linha) {		// passa linha a linha do arquivo 
		    		    
		    	if (trim(substr($linha, 0, 3)) == "" || substr($linha, 0, 3) == "   ") {
		    		continue;
		    	}
		    	
				if ( (substr($linha, 2, 5) == "start") && (intval(substr($linha, 15, 3)) == intval($id)) ) {					
	        		$find = TRUE;
					$type = substr($linha, 10, 2);
					continue;
				} else {

		        	if ( $find && (substr($linha, 0, 3) == "stt") ) {					
						$array = array(
							"type" => $type,	
							"id" => $id,
							"statement" => substr($linha, 6)
						);	        		
		        		array_push($data, $array);
						continue;		
		        	} else {
			        		
						if ( $find ) {
						
							switch ($type) {
								case 'mc':
									if ( (substr($linha, 0, 2) == "  ") || (substr(trim($linha), 0, 2) == "") ) {
										continue;
									}
									if ( $find && (substr($linha, 0, 5) == "right") ) {
										
										$array = array(
											"correct_alternative" => substr($linha, 11)
										);
						        		array_push($data, $array);	
										continue;															
									}						
									if ( $find && (substr($linha, 0, 3) == "asw") ) {							
										$array = array(
											"id_alternative" => substr($linha, 3, 1),
											"alternative" => substr($linha, 7)		
										);
						        		array_push($data, $array);
										continue;																
									}																	
									break;
								
								case 'tf':						
									if ( $find && (substr($linha, 0, 3) == "iss") ) {							
										$array = array(
											"id_alternative" => substr($linha, 3, 1),
											"true_false" => substr($linha, 7, 1),
											"alternative" => substr($linha, 11)		
										);
						        		array_push($data, $array);
										continue;																
									}
									if ( $find && (substr($linha, 0, 5) == "right") ) {
										
										$array = array(
											"correct_alternative" => substr($linha, 11)
										);
						        		array_push($data, $array);
										continue;																
									}						
									break;
								
								case 'fg':						
									if ( $find && (substr($linha, 0, 3) == "qty") ) {							
										$array = array(
											"quantity" => substr($linha, 12, 1)		
										);										
										$qty_fg = substr($linha, 12, 1);
						        		
						        		array_push($data, $array);																
										continue;
										
									} else {								
										if ( $find && (substr($linha, 0, 3) == "lst") ) {
												
											if ($qty_fg > 1) {	
												$arr = array(
													"type" => substr($linha, 0, 3),									
													"alternative" => substr($linha, 6) 		
												);	

											} else {
												$array = array(
													"type" => substr($linha, 0, 3),									
													"alternative" => substr($linha, 6) 		
												);
								        		array_push($data, $array);																																									
											}
											continue;
												
										} else {										
											if ( $find && (substr($linha, 0, 2) == "pt" || substr($linha, 0, 2) == "gp") ) {							
												$array = array(
													"type" => substr($linha, 0, 3),									
													"alternative" => substr($linha, 6) 		
												);
							        			array_push($data, $array);
							        			continue;																
											}
										}
									}
									break;
								
								case 'sq':						
									if ( $find && (substr($linha, 0, 3) == "sbq") ) {							
										$array = array(
											"alternative" => substr($linha, 6)		
										);
						        		array_push($data, $array);
										continue;																
									}
									
									if ( (substr($linha, 2, 3) != "end") && (substr($linha, 0, 3) != "sbq")) {							
									
										if ( $find && (substr($linha, 0, 1) != " ") && 
												(trim(substr($linha, 0, 1)) != "") && (trim(substr($linha, 0, 1)) != "[") ) {
											
											$array = array(
												"alternative" => substr($linha, 6)
											);
							        		array_push($data, $array);
							        		continue;																
										}						
									}
									break;
							}
						}
					}
		        	if ( $find && (substr($linha, 2, 3) == "end") ) {
		        		if ($type == "fg" && $qty_fg > 1) {
							array_push($data, $arr);
						}	
		        		$find = FALSE;
						break;
					}					
				}
			}							// End Foreach
		
			$html = $this->format_preview($data, $type);
		}								// End If($logged)
			
//		print_r($data);
//		exit;
			
		echo $html;				
	}									// End Function

	public function format_preview($data, $type) {		
		$html = "";
		$i = 0;		
/*				
		echo "<br /><br /><br /> tipo => ". $type ."<br />";	
		print_r($data);
		exit;	
*/				
		foreach ($data as $linha) {
			$i++;
			
			if ($i == 1) {
				$html .= "<div class='row pl-3'> <h4> ". $linha['id']. " - ". 
					ucfirst($linha['statement']) ." </h4> </div> <div class='row pl-5'> ";				
				
			} else {
				switch ($type) {
					case 'mc':
						if ($i > count($data)) {
							continue;
						}
						if ($i == 2) {
							$id_right = $linha['correct_alternative'];
							continue;
						}						
						$right = (intval($id_right) == intval($linha['id_alternative'])) ? " - (Right)" : " - (Wrong)";													
						$html .= " <div class='col-12'> ". str_pad($linha['id_alternative'], 2, "0", STR_PAD_LEFT)
								." - ".  trim($linha['alternative']). $right ." </div> ";
						break;
	
					case 'tf':
						$html .= " <div class='col-12'> ". str_pad($linha['id_alternative'], 2, "0", STR_PAD_LEFT)
								." - [". strtoupper(trim($linha['true_false'])). "] - ".  trim($linha['alternative']). " </div> ";
						break;
	
					case 'fg':
						$bg_color = '';
						if ($i == 2 || $i > count($data)) {
							continue;
						}
						if (substr($linha['type'], 0, 2) == "pt" || substr($linha['type'], 0, 2) == "ls") {
							$tp = "Part ";
						}
						if (substr($linha['type'], 0, 2) == "gp") {
							$tp = "Gap ";
							$bg_color = ' style="background-color: #fff;"';
						}																			
						$html .= " <div class='col-12' ". $bg_color ."> ". $tp ." - ".  trim($linha['alternative']). " </div> ";
						break;					

					case 'sq':
						$html .= " <div class='col-12'> - ". trim($linha['alternative']). " </div> ";
						break;
				}												
			}
		}

		$html .= " </div> ";
		
		echo $html;
	}
		
	public function format_preview_db($data)	{
	
		$html = "";
		$question = array();
		$i = 0;
		$type = "";
		
		foreach ($data as $value) {
			$i++;
				
			if ($i == 1) {
				switch ($value['id_alternatives_type']) {
					case 1:
						$type = "mc";				
						break;
					case 2:
						$type = "tf";				
						break;
					case 3:
						$type = "fg";				
						break;
					case 4:
						$type = "sq";				
						break;
				}
				$array = array(
					"type" => $type,
					"id" => $value['id_questions'],
					"statement" => $value['enunciation']
				);				
				array_push($question, $array);
				
				$array = array(
					"correct_alternative" => 1
				);
				array_push($question, $array);
				//continue;				
			}
			
			if ($type == "mc" && $value['right_wrong'] == '1') {
				$question[1]['correct_alternative'] = $i;
			}	
		
			switch ($type) {
				case 'mc':
					$array = array(
						"id_alternative" => $i,
						"alternative" => $value['description_alternatives']					
					);
					array_push($question, $array);				
					break;

				case 'tf':
					$array = array(
						"id_alternative" => $i,
						"true_false" => ($value['right_wrong'] == '0' ? "F" : "T"),
						"alternative" => $value['description_alternatives']					
					);
					array_push($question, $array);				
					break;

				case 'fg':				
					$qty = 1;
					if (trim($value['gap_3']) != "") {
						$qty = 3;
					
					} else {
						if (trim($value['gap_2']) != "") {
							$qty = 2;							
						}	
					}
				
					$array = array(
						"quantity" => $qty
					);
					array_push($question, $array);				

					$array = array(
						"type" => "pt1",
						"alternative" => $value['title_questions']					
					);
					array_push($question, $array);
									
					$array = array(
						"type" => "gp1",
						"alternative" => $value['description_alternatives']					
					);
					array_push($question, $array);				

					if (trim($value['gap_2']) != "" ) {
						$array = array(
							"type" => "pt2",	
							"alternative" => $value['part_2']					
						);
						array_push($question, $array);				

						$array = array(
							"type" => "gp2",
							"alternative" => $value['gap_2']					
						);
						array_push($question, $array);				
					}

					if (trim($value['gap_3']) != "" ) {											
						$array = array(
							"type" => "pt3",	
							"alternative" => $value['part_3']					
						);
						array_push($question, $array);				

						$array = array(
							"type" => "gp3",
							"alternative" => $value['gap_3']					
						);
						array_push($question, $array);				
					}
					$array = array(
						"type" => "lst",
						"alternative" => $value['gap_4']					
					);
					array_push($question, $array);							
					break;

				case 'sq':	
					$array = array(
						"alternative" => $value['description_alternatives']					
					);
					array_push($question, $array);				
					break;
			}			
		}

	//	print_r($question);
	//	exit;
				
		return $question;
	}
		
		
}		// End Class
