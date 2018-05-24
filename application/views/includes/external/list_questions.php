
<?php
	$cookie = unserialize($_COOKIE['avaleea']);
	$var = $this->session->userdata("id_test");
	$id_test = isset($var) ? $var : 0;	
	if ($id_test == 0) {
		$id_test = $cookie["id_test"];
	}
	
	$logged = $this->session->userdata("logged");
	if ($logged == "0") {
		$logged = $cookie["logged"];
	}
?>

	<div id="div_list_tests" name="div_list_tests" style="border: 0 solid #0033ff; height: 100%; min-height: 458px; margin-top: 1px;">		

		<!-- Buttons -->
    	<div class="row wrapper text-center d-flex justify-content-center align-items-start mt-0">
			<div class="row" style="margin-top: 30px;">  <!-- Functions new, view, save, save & new -->
			
				<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups" id="div_toolbar_tests" name="div_toolbar_tests">

					<div class="col-1">
					  <div class="btn-group btn-group-md ml-4 pl-5 mr-4" role="group" aria-label="Second group">
						<a href="<?= base_url('home/external_questions/new')?>" class="btn btn-outline-info" id="btn-new-question" name="btn-new-question">
							<i class="ion ion-android-add-circle"></i>
							New
						</a>
					  </div>
					</div>

					<div class="col-1">
					  <div class="btn-group btn-group-md ml-3 pl-5 mr-1" role="group" aria-label="Second group">
						<button type="button" class="btn btn-outline-info" id="btn-edit-qu" name="btn-edit-qu">
							<i class="ion ion-edit"></i>
							Edit
						</button>
					  </div>
					</div>

					<div class="col-2">
					  <div class="btn-group btn-group-md ml-2 pl-5" role="group" aria-label="Third group">
						<button type="button" class="btn btn-outline-info" id="btn-delete" name="btn-delete">
							<i class="ion ion-close-circled"></i>
							Delete
						</button>
					  </div>
					</div>

					<div class="col-1">
					  <div class="btn-group btn-group-md ml-1 mr-3 pr-2" role="group" aria-label="First group">
						<a href="" class="btn btn-outline-info" id="btn-preview" name="btn-preview">
							<i class="ion ion-ios-eye"></i>
							Preview
						</a>
					  </div>
					</div>
					
					<?php if ($logged != '3') : ?>
						<div class="col-2">
						  <div class="btn-group btn-group-md ml-3 pl-1 mr-1" role="group" aria-label="Fourth group">
							<button type="button" class="btn btn-outline-info" id="btn-send-questions" name="btn-send-questions" data-toggle="modal" data-target="#modal_signin_save_name">
								<i class="ion ion-log-in"></i>
								Sign in & Save
							</button>
						  </div>
						</div>
					<?php endif ; ?>

					<div class="col-1">
					  <div class="btn-group btn-group-md ml-2 pl-3 mr-1" role="group" aria-label="Fourth group">
						<button type="button" class="btn btn-outline-info" id="btn-send-email" name="btn-send-email">
							<i class="ion ion-email-unread"></i>
							Send
						</button>
					  </div>
					</div>

					<div class="col-2">
					  <div class="btn-group btn-group-md ml-2 pl-2 mr-2" role="group" aria-label="Fifth group">
						<button type="button" class="btn btn-outline-info" id="btn-download" name="btn-download">
							<i class="ion ion-android-download"></i>
							Download
						</button>
					  </div>
					</div>

					<div class="col-2">
					  <div class="btn-group btn-group-md ml-1 mr-3" role="group" aria-label="Fifth group">
						<a href="<?= base_url('home/external_questions/clear')?>" class="btn btn-outline-info" id="btn-clear" name="btn-clear">
							<i class="ion ion-android-remove-circle" style="color: red;"></i>
							<b>Clear ALL</b>
						</a>
					  </div>
					</div>	
					
				</div>	<!-- end .btn-toolbar -->			
			
			</div>	<!-- end Functions -->										
		</div>	<!-- end Wrapper -->

		<div class="row mt-1 mx-5 px-5" id="hr-btn-actions" style="border: 2px ridge #007BFF;"> </div>  <!-- HR -->			

		<div class="row">
			<div class="col-1"></div>
			
			<div class="col-10">
				<table class="table table-striped table-light table-list" id="table-list-questions" name="table-list-questions">
				  <thead>
				    <tr>
				      <th scope="col">Identify</th>
				      <th scope="col">Statement</th>
				      <th scope="col">Type Question</th>
				      <th scope="col">Quantity</th>
				      <th scope="col">Select</th>
				    </tr>
				  </thead>
				  <tbody>
					
					<?php //print_r($questions);?>
					<?php foreach ($questions as $fields) : ?>
						<?php
							$name_type = $fields['type'];
							switch ($fields['type']) {
								case 'mc':
									$name_type = "Multiple choice";
									break;
								case 'tf':
									$name_type = "True or False";
									break;
								case 'fg':
									$name_type = "Fill in Gap";
									break;
								case 'sq':
									$name_type = "Subjective Question";
									break;
							}
							//Print_r($fields);
							//exit;
						?>
					    <tr id="tr<?= $fields['identify'] ?>" name="tr<?= $fields['identify'] ?>">
					      <th scope="row" id="id<?= $fields['identify'] ?>" name="id<?= $fields['identify'] ?>"><?= str_pad($fields['identify'], 6, "0", STR_PAD_LEFT) ?></th>
					      <td id="sta<?= $fields['identify'] ?>" name="sta<?= $fields['identify'] ?>"><?= $fields['statement'] ?></td>
					      <td class="type-list<?= $fields['identify'] ?>" id="<?= $fields['type']. $fields['identify'] ?>" name="<?= $fields['type'] .$fields['identify'] ?>"> <?= $name_type ?> </td>
					      <td class="pl-4" id="qty<?= $fields['identify'] ?>" name"qty<?= $fields['identify'] ?>"> <?= str_pad($fields['quantity'], 3, "0", STR_PAD_LEFT) ?> </td>
					      <td class="pl-5"> 
							<input class="form-check-input" type="radio" name="radio-test" id="radio<?= substr($fields['type'], 0, 2). $fields['identify'] ?>" value="radio<?= $fields['identify'] ?>" checked>			      		 
			      		  </td>
					    </tr>
				    <?php endforeach ; ?>
				  </tbody>
				</table>
	 			<input type="hidden" id="id_test_question" name="id_test_question" value="<?= $id_test ?>"> 		

			</div>
			<div class="col-1"></div>
				  
		</div>	<!-- end row -->

		<div class="row mt-1 mx-5 px-5" id="hr-btn-actions2" style="border: 2px ridge #007BFF;"> </div>  <!-- HR -->			

	</div>