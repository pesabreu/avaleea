<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class questionnaries extends MY_controller {

    public function index($id_people = 0) {        
        $this->session->userdata("ins_data", '');        
    
        $total_general = $this->m_questionnaries->total_questionnaries($id_people);       
        $reg_initial = $this->uri->segment(3, 0);
		$per_page = $this->session->userdata("itens_per_page");		
       
		$config = configure_pagination('questionnaries/index', $total_general, $per_page);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
                               
        $data['total_consult'] = $total_general;            		                    
        $data['consult'] = $this->m_questionnaries->return_questionnaries(0, $reg_initial, $per_page, $id_people);                                   
		        
        $data['name_view'] = 'v_questionnaries';
        $this->load->view('v_layout', $data);
    }
    
    public function edit($id_questionnaries = 0) {

        $data['id_questionnaries'] = $id_questionnaries;			
        $data['questionnaries'] = $this->m_questionnaries->return_questionnaries($id_questionnaries)->row();        

		$data['list_modules'] = $this->m_modules->list_modules();
		$data['list_people'] = $this->m_people->list_people();
		
		$data['list_questionnaries_type'] = $this->m_tabsys->list_tabsys('tbquestionnaries_type');						
		$data['list_alternatives_type'] = $this->m_tabsys->list_tabsys('tbalternatives_type');
		$data['list_level_type'] = $this->m_tabsys->list_tabsys('tblevel_type');		
		$data['list_situation'] = $this->m_tabsys->list_tabsys('tbsituation');
						        
        $data['name_view'] = 'v_form_questionnaries';
        $this->load->view('v_layout', $data);        
    }
    
    public function new_questionnaries() {
    	
		$data['list_modules'] = $this->m_modules->list_modules();
		$data['list_people'] = $this->m_people->list_people();
		
		$data['list_questionnaries_type'] = $this->m_tabsys->list_tabsys('tbquestionnaries_type');						
		$data['list_alternatives_type'] = $this->m_tabsys->list_tabsys('tbalternatives_type');
		$data['list_level_type'] = $this->m_tabsys->list_tabsys('tblevel_type');		
		$data['list_situation'] = $this->m_tabsys->list_tabsys('tbsituation');
						        
        $data['name_view'] = 'v_form_questionnaries';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_questionnaries() {		

        $id_questionnaries = $this->input->post("id_questionnaries");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                        "<a href='". base_url("questionnaries") ."' class='btn btn-primary'> Questionnaries </a>",                                                                                    
                        "<a href='". base_url('questionnaries/new_questionnaries') ."' class='btn btn-primary'> New Questionnaries </a>"  );                

        if ($this->m_questionnaries->save_questionnaries()) {
        	if ($id_questionnaries != 0) {            
            	$message = standard_message( 1, " Questionnaries Updated Successfully....", $botoes );
			} else {
				$message = standard_message( 1, " Questionnaries Inserted Successfully....", $botoes );
			}
        
        } else {
        	if ($id_questionnaries != 0) {
            	$message = standard_message( 4, " Questionnaries Update Error....", $botoes);
			} else {
				$message = standard_message( 4, " Questionnaries Insert Error....", $botoes);
			} 
        }
            
        $this->load->view('v_layout', $message);                                    
    }
         
    public function delete($id_questionnaries){
           
        $ret = $this->m_questionnaries->delete($id_questionnaries);

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                        "<a href='". base_url("questionnaries") ."' class='btn btn-primary'> Questionnaries </a>",                                                                                    
                        "<a href='". base_url('questionnaries/new_questionnaries') ."' class='btn btn-primary'> New Questionnaries </a>"  );                
        
        if ($ret == 0) {
            $message = standard_message( 1, " Excluded Successfully Questionnaries....", $botoes ); 

        } else {
             $message = standard_message( 4, " Error in Deletion, contact support.....", $botoes ); 
        } 

        $this->load->view('v_layout', $message);                      
    }
						
    public function autocomplete() {
        
        $term = $this->input->get("term");
        
        $consult = $this->m_questionnaries->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }
 
    public function filter() {

        $this->load->library('pagination');                                               
 
        $var_post = $this->input->post();
 
        if (!empty($var_post)) {
            $this->session->set_userdata("id_questionnaries", $this->input->post("filtro_id_questionnaries"));
            $this->session->set_userdata("id_questionnaries_type", $this->input->post("filtro_id_questionnaries_type"));            
            $this->session->set_userdata("id_modules", $this->input->post("filtro_id_modules"));
            $this->session->set_userdata("name_questionnaries", $this->input->post("filtro_name_questionnaries"));			
        }

        $dados['id_questionnaries'] = $this->session->userdata("id_questionnaries");
        $dados['id_questionnaries_type'] = $this->session->userdata("id_questionnaries_type");
        $dados['id_modules'] = $this->session->userdata("id_modules");        
        $dados['name_questionnaries'] = $this->session->userdata("name_questionnaries");        
                                                                   
        $total_general = $this->m_questionnaries-> total_questionnaries_filtered();      
        $reg_initial = $this->uri->segment(3, 0);
		$per_page = $this->session->userdata("itens_per_page");		
       
		$config = configure_pagination('questionnaries/filter');
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
 
        $data['total_consult'] = $total_general;                   			
        $data['consult'] = $this->m_questionnaries->filter_questionnaries($reg_initial, $per_page);
        //echo $this->db->last_query();
                    
        $data['name_view'] = 'v_questionnaries';                                                                                               
        $this->load->view('v_layout', $data);
    }
     
    public function order($field, $order) {
        
        $this->session->set_userdata("field", $field);
        $this->session->set_userdata("order", $order);
        
        redirect(base_url('questionnaries'));                
    }

    public function window_data_complete_questionnaries() {
         
        $id_questionnaries = $this->input->post("id_questionnaries");
        
        $consult = $this->m_questionnaries->return_questionnaries($id_questionnaries)->result_array();
        //print_r($consult);        
        $data_questionnaries = $consult[0];
        echo json_encode($data_questionnaries);
    }

	public function return_questionnarie_client() {
        	
        $id_questionnaries = $this->input->post("id_questionnaries");

		if ($id_questionnaries == "" or $id_questionnaries == 0 ) {
			$array = "";		
			$this->session->set_userdata("questionnarie", "");			
			$this->session->set_userdata("edit_questionnarie", '0');

		} else {
			$this->session->set_userdata("edit_questionnarie", '1');				
			$questionnarie = $this->m_questionnaries->return_complete_data($id_questionnaries);
			
			$this->session->set_userdata("questionnarie", $questionnarie);
			$this->session->set_userdata("id_questionnaries", $questionnarie[0]['id_questionnaries']);
			$this->session->set_userdata("title_questionnaries", $questionnarie[0]['title_questionnaries']);						              		
			
			foreach ($questionnarie as $arr) {
				foreach ($arr as $key => $value) {										
					$array[$key] = $value;
				}
			}
		}		
		echo json_encode($array);	
	}
	
	public function save_questionnaire_author($value='') {
		
		$this->session->set_userdata("save_questionnarie", "0");
	    $id_questionnaries = $this->input->post("id_questionnaries");		
					
        if ($this->m_questionnaries->save_questionnaries_authors()) {
        		
			if ($id_questionnaries != 0) {
				$msg = " Questionnaires Updated Successfully ! ";
				$msg_pend = " Check the pending of the questionnaire, some may prevent the use of the questionnaire in applications. ";
				$ret = " <br /><br /><div class='callout callout-warning'> <p style='color: #000;'> ". $msg ." </p> <p style='color: #000;'> ". $msg_pend ." </p> </div> <br /> ";
				
				$quantity_issues = $this->input->post("quantity_issues");
				$pendencias = $this->checks_disputes($id_questionnaries, $quantity_issues);
				
				if (count($pendencias) > 0) {
					
					$ret .= " <br /> <div class='callout callout-danger'>";
					$ret .= " <p style='color: #000;'> Pending Issues </p>";
					foreach ($pendencias as $key => $value) {
						
						$ret .= " <p style='color: #000;'> ". $value ." </p> ";						
								
					}
					$ret .= "</div>";
					$ret .= "<br /> <div> <button id='open_questions' name='open_questions' 
					 						type='button' class='btn btn-success' 
			   		        				data-backdrop='static' data-toggle='modal' 
			   		        				data-target='#formModalQuestions'>
			   		               		Edit Questions
		   		                   </button>		   		                   
								<script> $('#id_questionnariesq').val('". $id_questionnaries ."'); </script>
							</div>";
				}
			
			} else {
				$id = $this->session->userdata("id_questionnaries_save");
		   		$msg = " Questionnaires Inserted Successfully ! ";
				$msg_pend = " You just created a questionnaire, so that it can be used in an application, 
								you must now create the questions and their alternatives. ";
				$ret = "<br /><br /><div class='callout callout-success'> <p style='color: #000;'> ". 
							$msg ."</p> <p style='color: #000;'> ". $msg_pend ."</p> </div> <br />";
				$ret .= "<br /> <div> <button id='open_questions' name='open_questions' 
				 						type='button' class='btn btn-success' 
		   		        				data-backdrop='static' data-toggle='modal' 
		   		        				data-target='#formModalQuestions'>
		   		               		Edit Questions
	   		                   </button>
							<script> $('#id_questionnariesq').val('". $id ."'); </script>
						</div>";
			}			
			$this->session->set_userdata("save_questionnarie", "1");			
			
			$questions = $this->m_questions->return_questions(0, 0, 0, $id_questionnaries)->result_array();			
			$this->session->set_userdata("questions", $questions);					
        
        } else {
        	$msg = " Questionnaires Registration Error ! ";
			$msg_pend = " Check the form completion ! ";
			$ret = "<div class='callout callout-danger'> <p> ". $msg ."</p> <p> ". $msg_pend ."</p> </div>";	
		}            
		
		echo $ret;
		exit;
		//return TRUE;
	}
		
	public function checks_disputes($id_questionnaries, $quantity_issues)	{
			
		$tot_questions = $this->m_questions->total_questions($id_questionnaries);
		$ret = "";
		
		if ($tot_questions == 0) {
			$ret = array( "Questionnaire does not have registered questions",
						  "There are Pending Issues that will prevent the use of the Application Questionnaire"						
						); 
		
		} elseif ($tot_questions != $quantity_issues ) {
			$ret = array( "Number of questions different from that reported in the Questionnaire",
						  "There are Pending Issues that will prevent the use of the Application Questionnaire"						
						); 
		}
		return $ret;
	}

	public function return_questionnarie_view() {
        	
        $id_questionnaries = $this->input->post("id_questionnaries");        
		$questionnaries = $this->m_questionnaries->return_data_view($id_questionnaries);
		
		$html = " <div class='text-center'> <h3> ". $questionnaries[0]['title_questionnaries']. "</h3> ";		
		$html .= "<h4>". $questionnaries[0]['instructions_questionnaries'] ."&nbsp; &nbsp; &nbsp; - &nbsp; &nbsp; Date: ".  
						substr($questionnaries[0]['dt_creation'], 0, 10) ." </h4> </div> ";
				
		$questions_old = 0;
		
		if ( !empty($questionnaries[0]['id_questions']) && $questionnaries[0]['id_questions'] != "") {
		
			foreach ($questionnaries as $questionnarie) {
					
				if ($questionnarie['id_questions'] != $questions_old) {
						
					if ($questions_old != 0) { $html .= " </div> "; }	
					$html .= " <br /> <div style='margin-left: 20px;'> <h4>". str_pad($questionnarie['order_questionnaries'], 2, "0", STR_PAD_LEFT).								
								" - ". 	$questionnarie['title_questions'] ."</h4> ";
					$html .= " <p> <b> ". $questionnarie['enunciation']. " </b> </p> </div> <div style='margin-left: 20px;'> ";
					
					$questions_old = $questionnarie['id_questions'];
				}
				
				$html .= " <p style='margin-left: 20px;'> 			
							(". str_pad($questionnarie['id_order_questions'], 2, "0", STR_PAD_LEFT). ") ".
							$questionnarie['text_alternatives']. ' -> '. 
							($questionnarie['right_wrong'] == '0' ? 'Wrong' : 'Right'). "</p>";									
			}
			
			$html .= " </div> <hr /> ";
		} else {
			$html .= " <hr /> ";			
		}		
		
		echo $html;
	}
	
	public function load_form($questionnarie) {

		$list_modules = $this->m_modules->list_modules();						
		$list_questionnaries_type = $this->m_tabsys->list_tabsys('tbquestionnaries_type');						
		$list_alternatives_type = $this->m_tabsys->list_tabsys('tbalternatives_type');
		$list_level_type = $this->m_tabsys->list_tabsys('tblevel_type');		
		$list_situation = $this->m_tabsys->list_tabsys('tbsituation');
		
		$list_presentation_type = $this->m_tabsys->list_tabsys('tbpresentation_type');
		$list_allows_interrupt = $this->m_tabsys->list_tabsys('tballows_interrupt');
		$list_allows_navigate = $this->m_tabsys->list_tabsys('tballows_navigate');
		$list_mandatory_answers = $this->m_tabsys->list_tabsys('tbmandatory_answers');
		$list_flow_issues = $this->m_tabsys->list_tabsys('tbflow_issues');						
		
		$id = $this->session->userdata('id_questionnaries');
		
		$html = '				
					  <div class="modal-dialog">			            
						<div class="modal-content bg-teal">
						  <?php $id ='. $id. ' ; ?>
				              
						  <div class="modal-header">
			                <button type="button" id="btn_close_x" name="btn_close_x" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">X</span></button>
			                <h3 class="modal-title text-center"><?= $id == 0 ? "New " : "Edit "?> Questionnaire</h3>
			              </div>
		              
						  <div class="modal-body" style="color: black;">										                
							<div class="box">						        						
							  <div class="box-header with-border"></div>
					
					          <div class="box-body" style="height: auto;">	

							    <form class="form-horizontal" role="form" method="post" id="form_dd" name="form_dd"
							            action="" onsubmit="return valid()" />
									  
								<div class="col-md-12">
								  <div class="nav-tabs-custom" style="border: 0px solid blue; padding: 5px; height: 100%;">
						            <ul class="nav nav-tabs">
						              <li class="active"><a href="#tab_1" id="tab1" name="tab1" data-toggle="tab">Questionnaire</a></li>
						              <li><a href="#tab_2" id="tab2" name="tab2" data-toggle="tab">Setup</a></li>
						              <li><a href="#tab_3" id="tab3" name="tab3" data-toggle="tab">Status</a></li>
						            </ul>
						            <div class="tab-content">
						
						              <div class="tab-pane active" id="tab_1">		<!-- tab 1 - Questionnaire -->            															
							              <div class="form-group">
					      					<label for="author" class="col-sm-2 control-label">Author</label>
					      					<div class="col-sm-10">
					        				  <input type="text" class="form-control" id="author" name="author" 
					        				  				value="' .$this->session->userdata('name_user'). '" readonly />
					      					</div>	
					    				  </div>
									  	
										  <div class="form-group">
											<label for="selectType" class="col-sm-2 control-label">Type</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectType" name="selectType" onchange="return store_type(this);" required>
						    				  	<option selected="selected" value="">Select Type questionnaire</option>
';												
								                    foreach($list_questionnaries_type->result() as $type) {                        								
														$html .= '<option value="' .$type->id_questionnaries_type. '"> '
								                        		.$type->code_questionnaries_type. ' </option> ';
								                    };
$html .= '					 				  </select>
											</div>              	
										  </div>
		
									  	
										  <div class="form-group">
											<label for="selectModules" class="col-sm-2 control-label">Modules</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectModules" name="selectModules" onchange="return store_modules(this);" required>
						    				  	<option selected="selected" value="">Select Modules</option>
';
								                    foreach ($list_modules->result() as $module) {                      
													   $html .= '<option value="' .$module->id_modules. '"> ' .$module->name_modules. '</option> ';
								                    }; 

$html .= '					   				  </select>
											</div>              	
										  </div>
									  	
										  <div class="form-group">
											<label for="selectTypeAlternatives" class="col-sm-2 control-label">Type</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectTypeAlternatives" name="selectTypeAlternatives" onchange="return store_typeAlternatives(this);" required>
						    				  	<option selected="selected" value="">Select Type Alternatives</option>
';
								                    foreach ($list_alternatives_type->result() as $alternative) {                    			
								                    		$html .= ' <option value="' .$alternative->id_alternatives_type. '"> '
								                        	  .$alternative->code_alternatives_type. ' </option> ';
								                    }; 

$html .= '					  				  </select>
											</div>              	
										  </div>
						
							              <div class="form-group">
						  					<label for="name_questionnaries" class="col-sm-2 control-label">Name</label>
						  					<div class="col-sm-10">
						    				  <input type="text" class="form-control" id="name_questionnaries" name="name_questionnaries" placeholder="Name" 
						    				  			value="' .($id > 0 ? $questionnarie[0]['name_questionnaries'] : ''). '" />
						  					</div>	
										  </div>
						
							              <div class="form-group">
						  					<label for="title_questionnaries" class="col-sm-2 control-label">Title</label>
						  					<div class="col-sm-6">
						    				  <input type="text" class="form-control" id="title_questionnaries" name="title_questionnaries" placeholder="Title"
									    				  value="' .($id > 0 ? $questionnarie[0]['title_questionnaries'] : ''). '" />
						  					</div>	
						  					<label for="order_module_questionnaries" class="col-sm-2 control-label">Order</label>
						  					<div class="col-sm-2">
						    				  <input type="number" class="form-control" id="order_module_questionnaries" name="order_module_questionnaries" placeholder="Order" 
						    				  			value="' .($id > 0 ? $questionnarie[0]['order_module_questionnaries'] : 0). '" />
						  					</div>	
										  </div>
						
							              <div class="form-group">
						  					<label for="description_questionnaries" class="col-sm-2 control-label">Description</label>
						  					<div class="col-sm-10">
						    				  <input type="text" class="form-control" id="description_questionnaries" name="description_questionnaries" placeholder="Description"
						    				  			 value="' .($id > 0 ? $questionnarie[0]['description_questionnaries'] : ''). '" />
						  					</div>	
										  </div>
					
					                      <div class="form-group">
					                        <label for="instructions_questionnaries" class="col-sm-2 control-label">Instructions</label>
					                        <div class="col-sm-10">
					                            <textarea id="instructions_questionnaries" name="instructions_questionnaries" class="form-control" placeholder="Instructions" rows="5">
					                            	' .($id > 0 ? $questionnarie[0]['instructions_questionnaries'] : ''). ' 
					                           	</textarea>
					                        </div>
					                      </div>
									  	
										  <div class="form-group">
											<label for="selectLeveltype" class="col-sm-2 control-label">Level</label>
											<div class="col-sm-4">
						    				  <select class="form-control" id="selectLeveltype" name="selectLeveltype" onchange="return store_level_type(this);" required>
						    				  	<option selected="selected" value="">Select Level Type</option>
';										  
								                	foreach ($list_level_type->result() as $level) {
								                    	$HTML .= '<option value="' .$level->id_level_type. '"> ' .$level->code_level_type. '</option> ';
								                    } 

$html .= '				    				  </select>
											</div>
											
											<label for="selectSeriessemester" class="col-sm-2 control-label">Series</label>
											<div class="col-sm-4">
						    				  <select class="form-control" id="selectSeriessemester" name="selectSeriessemester" onchange="return store_series_semester(this);">
						    				  	<option selected="selected" value="">Series-Semester</option>
					                            <option value="1a.">1a. série</option>
						                        <option value="2a.">2a. série</option>
						                        <option value="3a.">3a. série</option>
						    				  </select>
											</div>						              	
										  </div>
						
										  <div class="form-group"> 
											<label for="selectSituation" class="col-sm-2 control-label">Situation</label>
											<div class="col-sm-5">
						    				  <select class="form-control" id="selectSituation" name="selectSituation" onchange="return store_Situation(this);" disabled="disabled" readonly="readonly">
						    				  	<option selected="selected" value="">Select Situation</option>
';
									                foreach($list_situation->result() as $situation) {                        
									                    $html .= '<option value="' .$situation->id_situation.'"> '
									                    				.$situation->code_situation. ' </option> ';
									                }; 
$html .= '				    				  </select>
											</div>
					              	
						  					<label for="dt_creation" class="col-sm-2 control-label">Creation</label>
						  					<div class="col-sm-3">
							  				  <input type="text" class="form-control" id="dt_creation" readonly 
							  				  			value="' .($id > 0 ? $questionnarie[0]['dt_creation'] : date('Y-m-d')). '" />
						  					</div>
										  </div>
										
										  <input type="hidden" id="id_questionnaries" name="id_questionnaries" value="<?= $id ?>" />																																
										
						              </div>
						              <!-- /.tab-pane 1 -->		
';
						             
$html .= '					          <div class="tab-pane" id="tab_2">		<!-- tab 2 - Setup -->					
							              <div class="form-group">
					      					<label for="author" class="col-sm-2 control-label">Author</label>
					      					<div class="col-sm-10">
					        				  <input type="text" class="form-control" id="author" name="author" 
					        				  				value="' .$this->session->userdata("name_user"). '" readonly />
					      					</div>	
					    				  </div>
									  	
										  <div class="form-group">												
											<label for="selectWhocustomize" class="col-sm-2 control-label">Customize</label>
											<div class="col-sm-4">
						    				  <select class="form-control" id="selectWhocustomize" name="selectWhocustomize" onchange="">
						    				  	<option selected="selected" value="">Who Customize</option>
					                            <option value="1">Default</option>
						                        <option value="2">Author</option>
						                        <option value="3">Buyer</option>
						                        <option value="4">Other</option>
						    				  </select>
											</div>						              	
										  
											<label for="selectFormmarket" class="col-sm-2 control-label">Market</label>
											<div class="col-sm-4">
						    				  <select class="form-control" id="selectFormmarket" name="selectFormmarket" onchange="">
						    				  	<option selected="selected" value="">Form Market</option>
					                            <option value="1">Public</option>
						                        <option value="2">Private</option>
						                        <option value="3">For Rent</option>
						                        <option value="3">Other</option>
						    				  </select>
											</div>						              	
										  </div>
						
										  <div class="form-group"> 
											<label for="selectPresentationtype" class="col-sm-2 control-label">Presentation</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectPresentationtype" name="selectPresentationtype" onchange="" required>
						    				  	<option selected="selected" value="">Select Type Presentation</option>
';
								                    foreach ($list_presentation_type->result() as $type) {                        
								                        $html .= '<option value="' .$type->id_presentation_type. '"> '
								                        	.$type->code_presentation_type. ' </option> ';
								                    } 
$html .= '				    				  </select>
											</div>              	
										  </div>

										  <div class="form-group">
											<label for="selectAllowsinterrupt" class="col-sm-2 control-label">Interrupt</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectAllowsinterrupt" name="selectAllowsinterrupt" onchange="" required>
						    				  	<option selected="selected" value="">Select Allows Interrupt</option>
';
								                    foreach ($list_allows_interrupt->result() as $allows) {                        
								                        $html .= '<option value="' .$allows->id_allows_interrupt.'"> '
								                        	.$allows->code_allows_interrupt. '</option> ';
								                    } 
$html .= '				    				  </select>
											</div>              	
										  </div>
									  	
										  <div class="form-group">
											<label for="selectAllowsnavigate" class="col-sm-2 control-label">Navigate</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectAllowsnavigate" name="selectAllowsnavigate" onchange="" required>
						    				  	<option selected="selected" value="">Select Allows Navigate</option>
';
								                    foreach ($list_allows_navigate->result() as $allows_navigate) {                        
								                        $html .= '<option value="' .$allows_navigate->id_allows_navigate. '"> '
								                        	.$allows_navigate->code_allows_navigate. '</option>';
								                    } 
$html .= '				    				  </select>
											</div>              	
										  </div>

										  <div class="form-group">
											<label for="selectMandatoryanswers" class="col-sm-2 control-label">Mandatory</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectMandatoryanswers" name="selectMandatoryanswers" onchange="" required>
						    				  	<option selected="selected" value="">Select Mandatory Answers</option>
';
								                    foreach ($list_mandatory_answers->result() as $mandatory_answers) {                        
								                        $html .= '<option value="' .$mandatory_answers->id_mandatory_answers. '">'
								                        	.$mandatory_answers->code_mandatory_answers. ' </option> ';
								                    } 	
$html .= '				    				  </select>
											</div>
										  </div>											 
						
										  <div class="form-group"> 
											<label for="selectFlowissues" class="col-sm-2 control-label">Flow</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectFlowissues" name="selectFlowissues" onchange="" required>
						    				  	<option selected="selected" value="">Select Flow Issues</option>
';	
								                    foreach ($list_flow_issues->result() as $flow_issues) {                        
								                        $html .= '<option value="' .$flow_issues->id_flow_issues. '">'
								                        			.$flow_issues->code_flow_issues. ' </option> ';
								                    }
$html .= '				    				  </select>
											</div>
					              		  </div>
												  	
										  <div class="form-group"> 
						  					<label for="time_duration" class="col-sm-2 control-label">Duration</label>
						  					<div class="col-sm-3">
						    				  <input type="number" class="form-control" id="time_duration" name="time_duration" placeholder="minutes"
						    				  			value="' .($id > 0 ? $questionnarie[0]['time_duration'] : 0). '" />
						  					</div>	
					              	
						  					<label for="quantity_issues" class="col-sm-offset-2 col-sm-2 control-label">Quantity</label>
						  					<div class="col-sm-3">
						    				  <input type="number" class="form-control" id="quantity_issues" name="quantity_issues" placeholder="Quantity" 
						    				  			value="' .($id > 0 ? $questionnarie[0]['quantity_issues'] : 0). '" />
						  					</div>	
					           	      		
					           	      		<input type="hidden" id="id_cfg_questionnaries" name="id_cfg_questionnaries" value="<?= $id_cfg ?>" />		                   	                      				  
										  </div>							

						              </div>
						              <!-- tab-pane 2 -->
						             
						              <div class="tab-pane text-center" id="tab_3" name="tab_3" style="padding: 20px;">		<!-- tab 3 - Alternatives -->						                
						              
						              	<h4 style="color: red;"> Save the Questionnaire to get your status updated</h4>
						              
						              </div>
						              <!-- /.tab-pane 3 -->
';	
									
$html .= '  							<!-- botões do form -->
						              <div class="form-group" style="margin-top: 20px; padding: 5px 20px;">
						                  <button type="button" id="btn_close" name="btn_close" class="btn btn-warning pull-right" data-dismiss="modal">Close</button>
					                	  <button type="submit" id="btn_save" name="btn_save" class="btn btn-success pull-left">Save</button>
									  </div>	
						
						            </div>
						            <!-- /.tab-content -->
						          </div>
						          <!-- /.tab-custom -->
						        </div>		<!-- end col -->								  
							</form>

				          	</div>
						      <!-- /.box-body -->	
						   </div>
							<!-- /.box -->		                		             
			             </div>
			             	<!-- /. modal-body -->
			              
						 <div class="modal-footer">
			                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
			             </div>
	                	  			            
						</div>
			            <!-- /.modal-content -->		          
					  </div>
			          <!-- /.modal-dialog -->		        
';

		return $html;
		
	}


/**************************************************************************************************
*
*		Method of tbcfg_questionnaries
*  
 * **************************************************************************************************/
    
    public function edit_cfg_questionnaries($id_questionnaries = 0) {

        $data['id_questionnaries'] = $id_questionnaries;			
        $data['cfg_questionnaries'] = $this->m_questionnaries->return_cfg_questionnaries($id_questionnaries)->row();        

		$data['list_presentation_type'] = $this->m_tabsys->list_tabsys('tbpresentation_type');
		$data['list_allows_interrupt'] = $this->m_tabsys->list_tabsys('tballows_interrupt');
		$data['list_allows_navigate'] = $this->m_tabsys->list_tabsys('tballows_navigate');		
		$data['list_mandatory_answers'] = $this->m_tabsys->list_tabsys('tbmandatory_answers');						
		$data['list_flow_issues'] = $this->m_tabsys->list_tabsys('tbflow_issues');
						        
        $data['name_view'] = 'v_cfg_questionnaries';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_cfg_questionnaries() {		

        $id_cfg_questionnaries = $this->input->post("id_cfg_questionnaries");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
	        "<a href='". base_url("questionnaries") ."' class='btn btn-primary'> Questionnaries </a>",                                                                                    
	        "<a href='". base_url('questionnaries/edit_cfg_questionnaries/'.$id_cfg_questionnaries) ."' class='btn btn-primary'> Continue Editing </a>" );                

        if ($this->m_questionnaries->save_cfg_questionnaries()) {
        	$message = standard_message( 1, " Setup Questionnaries Updated Successfully....", $botoes );
        	        
        } else {
            $message = standard_message( 4, " Setup Questionnaries Update Error....", $botoes);
        }
		            
        $this->load->view('v_layout', $message);                                    
    }
						
    public function autocomplete_cfg_questionnaries() {
    	        
        $term = $this->input->get("term");        
        $consult = $this->m_questionnaries->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }

}
