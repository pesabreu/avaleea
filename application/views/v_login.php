
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
    </script>

    <!-- Bootstrap -->
    <link href="<?=base_url('includes/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('includes/css/style.css')?>" rel="stylesheet">
          
    <style>
        .glyphicon {
            margin-right: 5px;
        }
        #imagem {
            width: 200px;
            height: 200px;
            margin: 0 auto;
            margin-top: 20px;
            text-align: center;
            display: none;
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
    <script src="<?=base_url('includes/js/scripts.js')?>"></script>
        
</head>

<body onload="$('#login').focus()" style="padding-top: 50px;">

    <div id="imagem">
        <!-- <?php echo "base => ".base_url(); ?> -->    
        <!-- <?php echo "logo => ". $logotipo; ?> -->        
        <!-- <img src="<?php echo isset($logotipo) ? $logotipo : '' ?>" class="img-responsive" alt="Responsive image" /> -->
    </div>
                
    <div class="container">        
        <div class="row">
            
            <div class="col-md-6 col-md-offset-3">
                
                <div class="text-center">
                    <h4>Avaleea</h4>
                </div>

                <div class="login-panel panel panel-primary">
                    
                    <div class="panel-heading">
                        Avaleea - System access - Login
                    </div>
                    
                    <div class="panel-body">
                            <p> Enter the data below to access the system: </p>
                
                            <div class="col-md-12" style="padding-top: 10px;">            
                                <form role="form" method="post" action="<?= base_url('login/logging') ?>" >
                                    
                                    <div class="form-group">
                                        <label for="login">User</label>
                                        <input type="text" name="login" id="login" class="form-control" style="width: 200px;"/>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" style="width: 200px;" />
                                    </div>
                
                                    <div>
                                        <div>                            
                                            <span><input type="submit" value="Access" class="btn btn-primary" /></span>
                
                                            <span style="float: right;"><a href="<?= base_url('login/forgot_password') ?>" class="btn btn-info"> Forgot password </a></span>                        
                                        </div>
                                    </div>                                        
                
                                </form>

                                <?php 
                                    $message = $this->session->flashdata("message");
                                ?>
                        
                                <?php if (!empty($message)): ?>
                                    
                                    <div class="alert alert-danger" style="margin-top: 10px;"> <?= $message; ?> </div>
                                
                                <?php endif; ?>
                            </div>
                    
                    </div>                    
                </div>                                                                
            </div>            
        </div>        
    </div>

</body>
</html>
