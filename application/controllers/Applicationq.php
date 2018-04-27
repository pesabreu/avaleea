<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class applicationq extends MY_controller {

    public function index($id_people = 0) {        
        $this->session->userdata("ins_data", '');        

        $total_general = $this->m_application->total_application($id_people);
		$reg_initial = $this->uri->segment(3, 0);
		$per_page = $this->session->userdata("itens_per_page");

		$config = configure_pagination('applicationq/index', $total_general, $per_page);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
                                
        $data['total_consult'] = $total_general;            	                    
        $data['consult'] = $this->m_application->return_application(0, $reg_initial, $per_page, $id_people);                                   
		        
        $data['name_view'] = 'v_application';
        $this->load->view('v_layout', $data);
    }
    
    public function edit($id_application = 0) {

        $data['id_application'] = $id_application;			
        $data['application'] = $this->m_application->return_application($id_application)->row();        

		$data['list_questionnaries'] = $this->m_questionnaries->list_questionnaries();
		$data['list_people'] = $this->m_tabsys->list_tabsys('tbpeople');		
		$data['list_application_type'] = $this->m_tabsys->list_tabsys('tbapplication_mode');
		$data['list_application_mode'] = $this->m_tabsys->list_tabsys('tbapplication_mode');
								        
        $data['name_view'] = 'v_form_application';
        $this->load->view('v_layout', $data);        
    }
    
    public function new_application() {

		$data['list_questionnaries'] = $this->m_questionnaries->list_questionnaries();
		$data['list_people'] = $this->m_tabsys->list_tabsys('tbpeople');		
		$data['list_application_type'] = $this->m_tabsys->list_tabsys('tbapplication_mode');
		$data['list_application_mode'] = $this->m_tabsys->list_tabsys('tbapplication_mode');
						        
        $data['name_view'] = 'v_form_application';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_application() {		

        $id_application = $this->input->post("id_application");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                "<a href='". base_url("application") ."' class='btn btn-primary'> Application </a>",                                                                                    
                "<a href='". base_url('applicationq/new_application') ."' class='btn btn-primary'> New Application </a>"  );                

        if ($this->m_application->save_application()) {
        	if ($id_application != 0) {            
            	$message = standard_message( 1, " Application Updated Successfully....", $botoes );
			} else {
				$message = standard_message( 1, " Application Inserted Successfully....", $botoes );
			}
        
        } else {
        	if ($id_application != 0) {
            	$message = standard_message( 4, " Application Update Error....", $botoes);
			} else {
				$message = standard_message( 4, " Application Insert Error....", $botoes);
			} 
        }
            
        $this->load->view('v_layout', $message);                                    
    }
         
    public function delete($id_application){
           
        $ret = $this->m_application->delete($id_application);

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
            "<a href='". base_url("application") ."' class='btn btn-primary'> Application </a>",                                                                                    
            "<a href='". base_url('applicationq/new_application') ."' class='btn btn-primary'> New Application </a>" );                
        
        if ($ret == 0) {
            $message = standard_message( 1, " Excluded Successfully Application....", $botoes ); 

        } else {
             $message = standard_message( 4, " Error in Deletion, contact support.....", $botoes ); 
        } 

        $this->load->view('v_layout', $message);                      
    }
						
    public function autocomplete() {
        
        $term = $this->input->get("term");        
        $consult = $this->m_application->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }
 
    public function filter() {

        $this->load->library('pagination');                                               
 
        $var_post = $this->input->post();
 
        if (!empty($var_post)) {
            $this->session->set_userdata("id_application", $this->input->post("filtro_id_application"));
            $this->session->set_userdata("id_questionnaries", $this->input->post("filtro_id_questionnaries"));            
            $this->session->set_userdata("name_application", $this->input->post("filtro_name_application"));
            $this->session->set_userdata("title_application", $this->input->post("filtro_title_application"));			
        }

        $dados['id_application'] = $this->session->userdata("id_application");
        $dados['id_questionnaries'] = $this->session->userdata("id_questionnaries");
        $dados['name_application'] = $this->session->userdata("name_application");        
        $dados['title_application'] = $this->session->userdata("title_application");        
                                                                   
        $total_general = $this->m_application-> total_application_filtered();
		$reg_initial = $this->uri->segment(3, 0);
		$per_page = $this->session->userdata("itens_per_page");

		$config = configure_pagination('applicationq/filter', $total_general, $per_page);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
  
        $data['total_consult'] = $total_general;              			
        $data['consult'] = $this->m_application->filter_application($reg_initial, $per_page);
        //echo $this->db->last_query();
                    
        $data['name_view'] = 'v_application';                                                                                               
        $this->load->view('v_layout', $data);
    }
     
    public function order($field, $order) {
        
        $this->session->set_userdata("field", $field);
        $this->session->set_userdata("order", $order);
        
        redirect(base_url('applicationq'));                
    }

    public function window_data_complete_application() {
         
        $id_application = $this->input->post("id_application");
        
        $consult = $this->m_application->return_application($id_application)->result_array();
        //print_r($consult);        
        $data_application = $consult[0];
        echo json_encode($data_application);
    }

	public function return_application_client() {
        	
        $id_application = $this->input->post("id_application");

		if ($id_application == "" or $id_application == 0 ) {
			$array = "";				
			$this->session->set_userdata("application", "");			
			$this->session->set_userdata("edit_application", '0');

		} else {
			$this->session->set_userdata("edit_application", '1');				
			$application = $this->m_application->return_complete_data($id_application);
			
			$this->session->set_userdata("application", $application);
			$this->session->set_userdata("id_application", $application[0]['id_application']);
			$this->session->set_userdata("title_application", $application[0]['title_application']);						              		
			
			foreach ($application as $arr) {
				foreach ($arr as $key => $value) {										
					$array[$key] = $value;
				}
			}
			
			$quest = $this->m_application->return_questionnaries_application($id_application);
			$array['questionnaries'] = $quest;
		}
		
		echo json_encode($array);	
	}

	public function return_application_candidate() {
        	
        $id_application = $this->input->post("id_application");
		$questionnaires = $this->m_application->return_application_candidate($id_application);			
		
		$html = ' <label for="listApplication" class="col-sm-2 control-label">Questionnaires</label> ';
		$html .= ' <div class="col-sm-10"> ';
		
		$html .= ' <select class="form-control" size="3" id="listApplication" name="listApplication" disabled="disabled"> ';

        foreach($questionnaires->result() as $questionnaire) {
			$html .= ' <option value="">'. str_pad($questionnaire->id_questionnaries, 3, "0", STR_PAD_LEFT) 
					.' - '.	ucfirst(trim($questionnaire->name_questionnaries)) .' </option> ';         	
        }                        
		
		$html .= " </select> </div> ";
		        
		echo $html;	
	}

	public function save_application_author() {
							
		$this->session->set_userdata("save_application", "0");
	    $id_application = $this->input->post("id_application");	
					
        if ($this->m_application->save_application_authors()) {
        		
			if ($id_application != 0) {
				$msg = " Application Updated Successfully ! ";
				$msg_pend = " Check the pending of the application, some may prevent the use of the application. ";
				$ret = " <br /><br /><div class='callout callout-warning'> <p style='color: #000;'> ". $msg ." </p> <p style='color: #000;'> ". $msg_pend ." </p> </div> <br /> ";
				
				$pendencias = $this->checks_disputes($id_application);
				
				if (count($pendencias) > 0) {
					
					$ret .= " <br /> <div class='callout callout-danger'>";
					$ret .= " <p style='color: #000;'> Pending Issues </p>";
					foreach ($pendencias as $key => $value) {
						
						$ret .= " <p style='color: #000;'> ". $value ." </p> ";						
								
					}
					$ret .= "</div>";
					$ret .= "<br /> <div> <button id='open_evaluation' name='open_evaluation' 
					 						type='button' class='btn btn-success' 
			   		        				data-backdrop='static' data-toggle='modal' 
			   		        				data-target='#formModalInvitation'>
			   		               		Candidate Invitation
		   		                   </button>		   		                   
								<script> $('#$id_applicatione').val('". $id_application ."'); </script>
							</div>";
				}
			
			} else {
				$id = $this->session->userdata("id_application_save");
		   		$msg = " Application Inserted Successfully ! ";
				$msg_pend = " You just created a application, so that it can be used the application, 
								you must now create the Evaluation. ";
				$ret = "<br /><br /><div class='callout callout-success'> <p style='color: #000;'> ". 
							$msg ."</p> <p style='color: #000;'> ". $msg_pend ."</p> </div> <br />";
				$ret .= "<br /> <div> <button id='open_evaluation' name='open_evaluation' 
				 						type='button' class='btn btn-success' 
		   		        				data-backdrop='static' data-toggle='modal' 
		   		        				data-target='#formModalInvitation'>
		   		               		Candidate Invitation
	   		                   </button>
							<script> $('#id_application').val('". $id ."'); </script>
						</div>";
			}			
			$this->session->set_userdata("save_application", "1");			
			
			$evaluation = $this->m_evaluation->return_evaluation(0, 0, 0, $id_application)->result_array();			
			$this->session->set_userdata("evaluation", $evaluation);					
        
        } else {
        	$msg = " Application Registration Error ! ";
			$msg_pend = " Check the form completion ! ";
			$ret = "<div class='callout callout-danger'> <p> ". $msg ."</p> <p> ". $msg_pend ."</p> </div>";	
		}            
		
		echo $ret;
		exit;
		//return TRUE;
	}
		
	public function checks_disputes($id_application){
			
		$tot_evaluation = $this->m_evaluation->total_evaluation($id_questionnaries);
		$ret = "";
		
		if ($tot_evaluation == 0) {
			$ret = array( "Application does not have registered evaluation",
						  "There are Pending Issues that will prevent the use of the Application"						
						); 		
		} 
		return $ret;
	}

	public function return_application_view() {
        	
        $id_application = $this->input->post("id_application");        
		$application = $this->m_application->return_data_view($id_application);
		
		$html = " <div class='text-center'> <h3> ". $application[0]['title_application']. "</h3> ";		
		$html .= "<h4>". $application[0]['name_application'] ."&nbsp; &nbsp; &nbsp; - &nbsp; &nbsp; Date: ".  
						substr($application[0]['dt_application'], 0, 10) ." </h4> </div> ";
				
		$evaluation_old = 0;
		$questionnaries_old = 0;
		$questions_old = 0;
		$order_evaluation = 0;
		$order_questionnaries = 0;
		
		if ( !empty($application[0]['id_evaluation']) && $application[0]['id_evaluation'] != "") {
		
			foreach ($application as $applic) {
					
				if ($applic['id_evaluation'] != $evaluation_old) {
						
					if ($evaluation_old != 0) { $html .= " </div> "; }	
					$html .= " <br /> <div style='margin-left: 20px;'> <h4>". str_pad(++$order_evaluation, 5, "0", STR_PAD_LEFT).								
								" - ". 	$applic['name_evaluation'] ."</h4> ";
					$html .= " <p> <b> ". $applic['dt_evaluation']. " </b> </p> </div> <div style='margin-left: 20px;'> ";
					
					$evaluation_old = $applic['id_evaluation'];
				}

				if ($applic['id_questionnaries'] != $questionnaries_old) {
						
					if ($questionnaries_old != 0) { $html .= " </div> "; }	
					$html .= " <br /> <div style='margin-left: 20px;'> <h4>". str_pad(++$order_questionnaries, 5, "0", STR_PAD_LEFT).								
								" - ". 	$applic['name_questionnaries'] ."</h4> ";
													
					$questionnaries_old = $applic['id_questionnaries'];
				}

				if ($applic['id_questions'] != $questions_old) {
						
					if ($questions_old != 0) { $html .= " </div> "; }	
					$html .= " <br /> <div style='margin-left: 20px;'> <h4>". str_pad($applic['order_questionnaries'], 2, "0", STR_PAD_LEFT).								
								" - ". 	$applic['name_questionnaries'] ."</h4> ";
													
					$questions_old = $applic['id_questions'];
				}


				if ( !empty($applic['id_answers']) && $applic['id_answers'] != "") {
				
					$html .= " <p style='margin-left: 20px;'> 			
								(". str_pad($applic['id_alternative_select'], 2, "0", STR_PAD_LEFT). ") ".
								$applic['answer']. ' -> '. 
								($applic['right_wrong'] == '0' ? 'Wrong' : 'Right'). "</p>";
				}													
			}
			
			$html .= " </div> </div> </div> <hr /> ";
		} else {
			$html .= " <hr /> ";			
		}		
		
		echo $html;
	}

	public function return_data_candidate() {
        	
        $id_application = $this->input->post("id_application");        
		$application = $this->m_application->return_data_candidate($id_application);
		
		$html = " <div class='text-center'> <h3> ". $application[0]['title_application']. "</h3> ";		
		$html .= "<h4>". $application[0]['name_application'] ."&nbsp; &nbsp; &nbsp; - &nbsp; &nbsp; Date: ".  
						substr($application[0]['dt_application'], 0, 10) ." </h4> </div> ";
				
		$questionnaries_old = 0;
		$order_questionnaries = 0;
		
		if ( !empty($application[0]['id_questionnaries']) && $application[0]['id_questionnaries'] != "") {
		
			foreach ($application as $applic) {
					
				if ($applic['id_questionnaries'] != $questionnaries_old) {
						
					if ($questionnaries_old != 0) { $html .= " </div> "; }
					$html .= " <br /> <div class='text-center' style='margin-left: 20px;'> <h4>". str_pad(++$order_questionnaries, 5, "0", STR_PAD_LEFT).								
								" - ". 	$applic['title_questionnaries'] ."</h4> ";
													
					$questionnaries_old = $applic['id_questionnaries'];
				}

				$html.= ' <p> Name : '. $applic['name_questionnaries']. ' </p> ';
				$html.= ' <p> Descrição : '. $applic['description_questionnaries']. ' </p> ';
				$html.= ' <p> Instructions : '. $applic['instructions_questionnaries']. ' </p> ';
				$html.= ' <p> Number questions : '. str_pad($applic['quantity_issues'], 2, "0", STR_PAD_LEFT). ' </p> ';
			}
			
			$html .= " </div> <hr /> ";
		} else {
			$html .= " <hr /> ";			
		}		
		
		echo $html;
	}
	
	public function return_questionnaire_candidate() {
        	
        $id_application = $this->input->post("id_application");
		if ($id_application == "" or $id_application == 0 ) { return FALSE; }
		
		$list_questionnaires = $this->m_application->return_questionnaries_application($id_application);
		
		$id_people = $this->session->userdata("id_people_admin");
		
		foreach ($list_questionnaires as $value) {				
			$id_questionnaires = $value['id_questionnaires'];				

			$evaluation = $this->m_evaluation->return_evaluation_candidate($id_application, $id_people, $id_questionnaires);
			if (! $evaluation) {
				//$msg = "Existe Evaluation aberta";								
				$questionnaires = $this->m_questionnaries->return_data_view($id_questionnaires);			
				break;			
			}
		}

		$this->session->set_userdata("questionnaire_candidate", $questionnaires);

		if (count($questionnaires) > 0) {
	
			$html = $this->mounts_form_questionnaires();			
			echo $html;   // return TRUE;
			
		} else {
			return FALSE;
		}
	}
	
	public function mounts_form_questionnaires() {
		
 		$html = '';
		$cab = 0;
		
		$questions_old = 0;
		$initial = 1;
		$var = $this->session->userdata("questionnaire_candidate");
		$quest = isset($var) ? $var : array();
		
		foreach ($quest as $question) {
			
			if ($cab == 0) {
				//$html .= $this->mount_header($question);
				$html .= ' <h4> '.  str_pad($question['id_questionnaries'], 3, "0", STR_PAD_LEFT);
				$html .= ' - '. $question['title_questionnaries'] .' </h4> <hr />';
												
				$cab = 1;
			}
								
    		$break = 0;	
			if ($questions_old == 0 || $questions_old != $question['id_questions']) {								 
				$questions_old = str_pad($question['id_questions'], 5, "0", STR_PAD_LEFT);
				$break = 1;
				
				$order = str_pad($question['order_questionnaries'], 2, "0", STR_PAD_LEFT);            					
		 		$enunciado = ucfirst($question['enunciation']);
			}
			
			if ($questions_old == $question['id_questions']) {        						
				$order_alt = str_pad($question['id_order_questions'], 2, "0", STR_PAD_LEFT);            					
		 		$enunciado_alt = ucfirst($question['description_alternatives']);			
				$order = str_pad($question['order_questionnaries'], 2, "0", STR_PAD_LEFT);					
			}
								
			if ($break == 1) {
				$html .= ' <div class="text-center" style="text-align: justify; margin-left: 50px;"> ';
				if ($initial == 0) {
					$html .= ' </div> <div class="form-group"> ';
					$name_option = 'check_'.$questions_old; 	
					$html .= ' <br /> ';					
				} else {
					$initial = 0;
					$html .= ' <div class="form-group"> ';
					$name_option = 'check_'.$questions_old;										
				}
				
				$html .= $order. ' &nbsp;-&nbsp;<b> ' .$enunciado. ' </b> <br /> </div> ';
			}			
				
			$html .= ' <div class="radio text-center" style="text-align: justify; margin-left: 70px;"> ';							 
			$html .= ' <input type="radio" name="' .$name_option. '" id="check_'.$questions_old.$order_alt. '"'; 
			$html .= ' value="' .$questions_old.$order_alt. '" ' .$enunciado_alt. ' required /> ';							
			$html .= ' &nbsp;&nbsp;(' .$order_alt. ') &nbsp; ' .$enunciado_alt. ' <br /> </div> ';			            			
		}
		
		$html .= '  <div class="form-group" style="margin-top: 20px; padding: 5px 20px;">
                		<button type="submit" id="btn_save_aqea" name="btn_save_aqea" class="btn btn-success pull-left"
                				style="margin-left: -25px;" >Save</button>
			        	<button type="button" id="btn_close_aqea" name="btn_close_aqea" class="btn btn-warning pull-right" 
			        			style="margin-right: 25px;" data-dismiss="modal">Close</button>
			        </div>
			   	    <input type="hidden" id="id_application_cand" name="id_application_cand" value="" />		                   	                      				  
			        <input type="hidden" id="name_application_cand" name="name_application_cand" value="" />    
			   	    <input type="hidden" id="id_questionnaries_cand" name="id_questionnaries_cand" 
			   	    		value="' .(isset($question['id_questionnaries']) ? $question['id_questionnaries'] : ''). '" /> 
					<div class="callout callout-info" id="response_cand" name="response_cand" style="display: none; margin-left: -25px; margin-right: 25px;"> </div> ';
						
/*		$html .= '				</div>			            	
					          </form>
		
		          		  </div>
			      		  <!-- /.box-body -->		
			  			</div>
						<!-- /.box -->			                
		      		  </div>
		      		  <!-- modal-body -->
		      		  
					  <div class="modal-footer">
				        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
				      </div>
			  			            
					</div>
		    		<!-- /.modal-content --> ';	          
*/		
		return $html;			
	}	
	
	function mount_header($questionnaires) {
		
		$html = ' 			            
					<div class="modal-content bg-teal">			  				              
					  <div class="modal-header">
		                <button type="button" id="btn_close_aq" name="btn_close_aq" class="close" data-dismiss="modal" aria-label="Close">
		                  <span aria-hidden="true">X</span>
		                </button>
		              </div>          
					  <div class="modal-body" style="color: black;">										                
						<div class="box">						        						
						  <div class="box-header with-border">
		                	<h3 class="modal-title text-center" id="oper_invitation" name="oper_invitation"> ';
		                	
        $html .= str_pad($questionnaires['id_questionnaries'], 3, "0", STR_PAD_LEFT)
                	.' - '. $questionnaires['title_questionnaries'];
                	
        $html .= ' </h3>				  	
				  </div>
		          <div class="box-body" style="height: auto;">	

			          <form class="form-horizontal" role="form" method="post" 
			          				action="" id="form_dd_questionnaires_candidate" name="form_dd_questionnaires_candidate" /> 
			           	<div class="text-center"> ';
	
		return $html;			
	}
	
	
/**************************************************************************************************
*
*		Method of tbcfg_application
*  
 * **************************************************************************************************/
    
    public function edit_cfg_application($id_application = 0) {

        $data['id_application'] = $id_application;			
        $data['cfg_application'] = $this->m_application->return_cfg_application($id_application)->row();        

		$data['list_presentation_type'] = $this->m_tabsys->list_tabsys('tbpresentation_type');
		$data['list_mandatory_answers'] = $this->m_tabsys->list_tabsys('tbmandatory_answers');						
						        
        $data['name_view'] = 'v_cfg_application';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_cfg_application() {		

        $id_cfg_application = $this->input->post("id_cfg_application");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
	        "<a href='". base_url("application") ."' class='btn btn-primary'> Application </a>",                                                                                    
	        "<a href='". base_url('applicationq/edit_cfg_application/'.$id_cfg_application) ."' class='btn btn-primary'> Continue Editing </a>" );                

        if ($this->m_application->save_cfg_application()) {
        	$message = standard_message( 1, " Setup Application Updated Successfully....", $botoes );
        	        
        } else {
            $message = standard_message( 4, " Setup Application Update Error....", $botoes);
        }
            
        $this->load->view('v_layout', $message);                                    
    }
						
    public function autocomplete_cfg_application() {
    	        
        $term = $this->input->get("term");        
        $consult = $this->m_application->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }

}
