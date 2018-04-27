
<!DOCTYPE html>
<html lang="en">
	
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> Avaleea </title>
    <link rel="shortcut icon" href="<?= URL_IMG.'symbol_.png' ?>" type="image/x-icon" />
	
    <script>       
        var base_url = '<?=base_url()?>';        

        function valid_password () {      
            var password_1 = $('#password_1').val();
            var password_2 = $('#password_2').val();
            
            if ( password_1 == '' || password_2 == '') {                
                $('#password_1').focus();            
                return false;
            }
                   
            if (password_1 != password_2) {
                $('#password_2').val('');
                $('#password_1').val('');                
                $('#password_1').focus();
                
                return false;
            }                    
            return true;
        }
    
    </script>

    <!-- Bootstrap -->
    <link href="<?=base_url('includes/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('includes/css/style.css')?>" rel="stylesheet">
    
    <style>
        .glyphicon {
            margin-right: 5px;
        }
        .panel {
            width: 500px;
            margin-top: 150px;
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
    <script src="<?=base_url('includes/js/jquery-2.1.4.min.js')?>"></script>                
</head>

<body onload="$('#password_1').focus()">
    
    <?php 
        $message = $this->session->flashdata("message");		
		$key = isset($key) ? $key : '';
    	
    	$method = "save_password_new_user";
        if ($new_user == 0) {
        	$method = "save_password_recover";
        }		
    ?>
    
    <div class="panel panel-primary center-block">
        
        <div class="panel-heading">        
            <h3 class="panel-title"> <?= $title ?> </h3>                
        </div>
            
        <div class="panel-body">
            <p> Enter and confirm your new access password. </p>

            <div class="col-md-12" style="padding-top: 10px;">            
                <form role="form" method="post" action="<?= base_url('login/'.$method) ?>" onsubmit="return valid_password()">
                    
                    <div class="form-group">
                        <label for="senha_1">Password</label>
                        <input type="password" name="password_1" id="password_1" class="form-control" style="width: 300px;" />
                    </div>
                    <div class="form-group">
                        <label for="password_2">Retype password</label>
                        <input type="password" name="password_2" id="password_2" class="form-control"style="width: 300px;" />
                    </div>
                    
                    <div>
                        <div>
                            <span> <input type="submit" value="Continue" class="btn btn-primary" /> </span>
                
                            <span style="float:  right;"> <a href="<?= base_url('login') ?>" class="btn btn-info"> Login </a> </span>                    
                        </div>
                    </div>                                        
                    
                    <input type="hidden" name="key" id="chave" value="<?php echo $key; ?>" />
                    <input type="hidden" name="new_user" id="new_user" value="<?= $user  ?>" />
                    
                </form>
                
                <?php echo !empty($message) ? $message : '' ?>
            </div>            
        
        </div>                
    </div>
    
</body>
</html>

