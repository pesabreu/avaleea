
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Avaleea</title>
		<link rel="shortcut icon" href="<?= URL_IMG.'symbol.png' ?>" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">    

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
 
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

	<link rel="stylesheet" href="<?=base_url('includes/css/estilo.css')?>">
			
</head>

<body>

<?php 
	//$usuario = "pesabreu@pesabreu.com";
		
    $var = $this->session->userdata("logged");
	$logged = isset($var) ? $var : "0";
	$usuario = 'Not logged in';

	if ($logged == "2" || $logged == "3") {	
	    $var = $this->session->userdata("name_user");
   		$usuario = isset($var) ? (trim($var) != "") ? $var : 'User name missing' : 'Not logged in';	
	}		 	
?>

    <div class="container-fluid">

			<div class="row">
				<nav class="navbar fixed-top navbar-expand-md navbar-light bg-primary">
					<a class="navbar-brand ml-3" href="<?= base_url() ?>">
						<img src="../includes/img/symbol.png" width="40" height="40" alt="" class="mb-1 mr-3">				
						<span class="h3" style="font-family: 'Comic Sans MS'; color: #fff;">Avaleea</span> 
						<span class="h6" style="color: #ffff60;">Test Maker</span>
					</a>
					
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsavaleea" aria-controls="navbarsavaleea" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse ml-1 px-5" id="navbarsavaleea">
						<ul class="navbar-nav mr-auto h5 px-5" style="margin-left: 50px; padding: 0 10px;">
							<li class="nav-item active mx-3">
							<a class="nav-link" style="color: #fff;" href="<?= base_url() ?>">Home <span class="sr-only">(current)</span></a>
							</li>
							<li class="nav-item mx-3">
							<a class="nav-link" style="color: #fff;" href="#">Questions</a>
							</li>
							<li class="nav-item mx-3">
							<a class="nav-link" style="color: #fff;" href="#">Tests</a>
							</li>
							<li class="nav-item dropdown mx-3">
							<a class="nav-link dropdown-toggle" style="color: #fff;" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sign in</a>
							<div class="dropdown-menu" aria-labelledby="dropdown04">
								<a class="dropdown-item" style="color: #000;" href="#" data-toggle="modal" data-target="#modal_signin">Login</a>
								<a class="dropdown-item" style="color: #000;" href="<?= base_url('login/logout') ?>">Logout</a>
								<a class="dropdown-item" style="color: #000;" href="#" data-toggle="modal" data-target="#modal_signup">Sign Up</a>
							</div>
							</li>
						</ul>

						<div id="username" name="username" style="color: #FFF;"> Username: &nbsp; <span style="font-weight: 800;"> <?= $usuario ?> </span> </div>
<!--
						<form class="form-inline my-2 my-md-0" method="GET" action="http://www.google.com/search" style="margin-right: -50px;">
							<input type="hidden" name="sitesearch" value="http://localhost/desenv/bootstrap4/bootstrap-4-rev-2-master/">
							<input class="form-control" type="text" placeholder="type here">
							<input type="submit" value="Search" class="btn btn-light ml-1">
						</form>
-->						
					</div>
				</nav>
			</div>

