
<?php   
    $var = $this->session->userdata("id_level_users");
    $id_level_users = isset($var) ? $var : 0;	

	$var = $this->session->userdata("candidate_application");
	$candidate_application = isset($var) ? $var : "0";
	
	$var = $this->session->userdata("category_user");
	$category_user = isset($var) ? $var : "0";
	 
?>


 <!-- Tela Inicial Admin -->

  <!-- Content Wrapper. Contains page content 		*********   Não mexer aqui !!!!!	*********	-->		
  <div class="content-wrapper">
  	
  											<!--	Usar daqui para baixo	-->	
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <h1>
        Avaleea
        <small> <?= ($id_level_users < 3) ? " Administrative Area " : " Client Area " ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
        <li><a href="#"> <?= ($id_level_users < 3) ? " Admin " : " Client " ?> </a></li>
        <li class="active">Panel Control</li>
      </ol>

    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Your Page Content Here -->
      
      <!-- Separar aqui os perfis um v_frm_???? para cada perfil -->
<?php
	switch ($id_level_users) {
		case 1:										// Support
		case 2:										// Admin
			include_once "includes/menu_admin.php";			
			break;
		
		case 3:	
			
			switch ($category_user) {
				case 3:							// Authors
					//$this->session->set_userdata("edit_questionnarie", "0");
					//$this->session->set_userdata("questionnarie", "");
					include_once "includes/menu_authors.php";
				break;
				
				case 4:							// Candidates
					if ($candidate_application == "0") {    //   <================ Para testes
						include_once "includes/menu_candidate.php";
					} else {
						include_once "includes/form_questionnaries.php";
					}
				break;
								
				default:
//					redirect(base_url());					// Visitors
					exit;
					break;
			}
												// Client - invited	
		default:
//			redirect(base_url());					// Visitors
			exit;
			break;
	}	
?>      
    </section>
    <!-- /.content -->
  
  					
  </div>					<!--	*********   Não mexer aqui !!!!!	*********	-->
  <!-- /.content-wrapper -->
