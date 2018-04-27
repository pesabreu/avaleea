
<?php   
    $var = $this->session->userdata("logged");
    $logged = 1; //isset($var) ? $this->session->userdata("logged") : 0;
	
    $var = $this->session->userdata("id_level_user");
    $id_level_user = isset($var) ? $this->session->userdata("id_level_user") : 0;

    $var = $this->session->userdata("user");
    $user = isset($var) ? $this->session->userdata("user") : '';

	$error_login = '0';
	$error = $this->session->userdata("error_logged");
	if ( isset($error) ) {
		$error_login = $this->session->userdata("error_logged");
		$this->session->set_userdata("error_logged", "0");
	}

    $message = $this->session->userdata("mess");
	$this->session->set_userdata("mess", "");
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> Avaleea </title>
    <link rel="shortcut icon" href="<?= URL_IMG.'symbol_.png' ?>" type="image/x-icon" />

	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <!-- Bootstrap -->

    <link href="<?=base_url('includes/css/bootstrap.min.css')?>" rel="stylesheet">    
    <link href="<?=base_url('includes/css/jquery-ui-1.10.4.custom.min.css')?>" rel="stylesheet">

    <!-- Bootstrap -->
    <!--<link href="<?=base_url('includes/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">-->
    <link href="<?=base_url('includes/bootstrap/datepicker/css/datepicker.css')?>" rel="stylesheet">
    <link href="<?=base_url('includes/bootstrap/timepicker/css/bootstrap-datetimepicker.min.css')?>" rel="stylesheet">

	<link href="<?=base_url('includes/css/style.css')?>" rel="stylesheet">

    <style>
        .glyphicon {
            margin-right: 5px;
        }
        
		.propag {
			border-radius: 10px 10px 10px 10px; 
			background-color: ##1D6FA9; 								
			border: 5px outset silver;
			width: 320px; 
			height: 84px;
			padding: 7px 10px;
			text-align: center;
		}
		.propag a {
			text-align: center;
			color: FFFFFE;
			font-weight: 700;
		}        
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<script src="<?=base_url('includes/js/jquery-2.1.4.min.js')?>"></script>

    <script src="<?=base_url('includes/js/scripts.js')?>"></script>

    <script>
        var base_url = '<?=base_url()?>';
        
        var error_login = '<?= $error_login ?>'; 
		$(document).ready(function() {
			$('#icon_people').focus();
						
			if (error_login == '1') {
				$("#menu_login")[0].click();
			}
		});        
        
    </script>

	<script>
		function clear_mess() {
			$(document).ready(function() {			
				$("#error_message").html("");
			});
			
			
			return true;			
		}
	</script>
	
  </head>


  <body>

    <!-- Bar navigation -->
    <nav class="navbar navbar-default header-menu">
      <div class="container-fluid">
       
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" 
                  data-toggle="collapse" data-target="#bar-navigation">
            <span class="sr-only">Alternar Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>	
            <span class="icon-bar"></span>
          </button>
          
          <a href="#" class="navbar-brand" style="margin-top: -12px;">
            <img src="<?= URL_IMG.'symbol_.png' ?>" class="img-responsive" width="45px" height="45px">
          </a>

		  <?php $user = substr(strtolower(trim($this->session->userdata("user"))), 0, 12); ?>
		  <?php if (trim($user) != ""): ?>
		  	<div style="background-color: LightGreen; width: auto; height: auto; margin: 15px 250px;">
				<li id="li_user" style="background-color: LightGreen; list-style-type: none;">
		        	<span class="" id="spanusu"> 
		            	<b class="">Usuário: <?= $user ?> </b>
		        	</span>
		        </li>			
			</div>
		  <?php endif; ?>
	
        </div>

        <div class="collapse navbar-collapse" id="bar-navigation">
          <ul class="nav navbar-nav navbar navbar-right ul-menu">

            <li> <a href="<?=base_url()?>" style="color: black;">Home</a> </li>
            <li> <a href="<?=base_url('home/external_questions')?>" style="color: black;">New Question</a> </li>
            <li> <a href="<?=base_url('home/external_test')?>" style="color: black;">New Test</a> </li>

            <li class="dropdown"> 
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: black;">
                My Account<span class="caret"></span>
              </a> 
              <ul class="dropdown-menu">
			  	<li>
            		<a href="#" data-toggle="modal" data-target="#janela" id="menu_login" name="menu_login">
            			Login
        			</a>
        		</li>              	
                <li> <a href="<?= base_url('login/logout')?>" style="color: black;">Logout</a> </li>
              </ul>
            </li>

          </ul>
        </div>

      </div>
    </nav>
    
    <header class="container-fluid text-center">
		<p style="padding-left: 90px;"> 
			Avaleea  
			<a href="https://espeficacoesdeconsultastic.inf.br/" target="_blank" class="btn btn-primary btn-lg" 
								style="float: right; font-size: 0.3em; font-weight: 600; margin: 12px -9px 2px 1px;">
				TIC/BR - ESpecificação de Consultas 
			</a>
      </p>
      
    </header>

    <!-- Window Login -->
	<form on class="modal fade" id="janela" method="post" action="<?= base_url('login/logging') ?>">
		
		<div class="modal-dialog modal-md">
		  <div class="modal-content" id="conteudo">
		    
		    <!-- cabecalho -->
		    <div class="modal-header" style="background-color: skyblue;">
		      <button type="button" class="close" data-dismiss="modal">
		        <span>&times;</span>
		      </button>
		      <table>
		      	<tr>
		      		<td style="padding-left: 10px;">
				  		<img src="<?= URL_IMG.'symbol_.png' ?>" class="img-responsive" 
				  			style="width: 50px; height: 50px; margin-top: 1px;" >
		  			</td>
		  			<td style="padding-left: 140px; font-size: 2.0em;">
			      		<span class="modal-title text-center"><b>Login Avaleea</b></span>
		      		</td>
		      	</tr>		      	
		      </table>
		    </div>
		
		    <!-- corpo -->
		    <div class="modal-body" style="background-color: #FAFAD2;">
		
		      <div class="form-group">
		        <input type="text" class="form-control" name="login" id="login" placeholder="type login" required>
		      </div>
		
		      <div class="form-group">
		        <input type="password" class="form-control" name="password" id="password" placeholder="type password" required>
		      </div>
		
		    </div>
		
		    <!-- rodape -->
		    <div class="modal-footer" style="background-color: #FAFAD2;">
		      <button type="reset" class="btn btn-warning">
		        Clear
		      </button>
			  
		      <button type="button" class="btn btn-danger" data-dismiss="modal" onkeypress="return clear_mess()">
		        Cancel
		      </button>
		
		      <button type="submit" class="btn btn-info" style="float: left;">
		        Login
		      </button>

			  <?php if (!empty($message) ): ?>        
				<div id="error_message" class="alert alert-danger text-center" style="margin-top: 20px;"><b> <?= $message; ?> </b> </div>
			  <?php endif; ?>
		
		    </div>
		
		  </div>
		</div>		
	</form>


