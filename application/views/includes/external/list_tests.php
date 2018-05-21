
<?php
/*
	echo "<br /><br />list<br />";
	print_r($questions[0]);
				
	foreach ($questions as $fields) {				
		echo "<br /><br />";	
		echo 'identify => '.  $fields['identify'];
	}
	exit;
*/ 
?>

	<div id="div_list_tests" name="div_list_tests" style="border: 0 solid #0033ff; height: 100%; min-height: 458px; margin-top: 1px;">		

		<!-- Buttons -->
    	<div class="row wrapper text-center d-flex justify-content-center align-items-start mt-0">
			<div class="row" style="margin-top: 30px;">  <!-- Functions new, view, save, save & new -->
			
				<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups" id="div_toolbar_tests" name="div_toolbar_tests">

					<div class="col-1">
					  <div class="btn-group btn-group-md" role="group" aria-label="Second group">
						<a href="<?= base_url('home/external_questions/new')?>" class="btn btn-outline-info" id="btn-new-question" name="btn-new-question">
							<i class="ion ion-android-add-circle"></i>
							New
						</a>
					  </div>
					</div>

					<div class="col-1">
					  <div class="btn-group btn-group-md mr-3" role="group" aria-label="Second group">
						<button type="button" class="btn btn-outline-info" id="btn-edit-test" name="btn-edit-test">
							<i class="ion ion-edit"></i>
							Questions
						</button>
					  </div>
					</div>

					<div class="col-2">
					  <div class="btn-group btn-group-md ml-5" role="group" aria-label="Third group">
						<button type="button" class="btn btn-outline-info" id="btn-delete-test" name="btn-delete-test">
							<i class="ion ion-close-circled"></i>
							Delete
						</button>
					  </div>
					</div>

					<div class="col-2">
					  <div class="btn-group btn-group-md" role="group" aria-label="First group">
						<a href="<?= base_url('home/external_questions')?>" class="btn btn-outline-info" id="btn-preview-test" name="btn-preview-test">
							<i class="ion ion-ios-eye"></i>
							Preview
						</a>
					  </div>
					</div>

					<div class="col-2">
					  <div class="btn-group btn-group-md ml-2 mr-1" role="group" aria-label="Fourth group">
						<button type="button" class="btn btn-outline-info" id="btn-send-test" name="btn-send-test">
							<i class="ion ion-email-unread"></i>
							Send by Email
						</button>
					  </div>
					</div>
					<div class="col-2">
					  <div class="btn-group btn-group-md ml-1 mr-2" role="group" aria-label="Fifth group">
						<button type="button" class="btn btn-outline-info" id="btn-download-test" name="btn-download-test">
							<i class="ion ion-android-download"></i>
							Download
						</button>
					  </div>
					</div>
					<div class="col-2">
					  <div class="btn-group btn-group-md ml-1 mr-2" role="group" aria-label="Fifth group">
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
				<table class="table table-striped table-light table-list">
				  <thead>
				    <tr>
				      <th scope="col">Identify</th>
				      <th scope="col">Name</th>
				      <th scope="col">Quantity Questions</th>
				      <th scope="col">Select</th>
				    </tr>
				  </thead>
				  <tbody>

					<?php foreach ($tests as $fields) : ?>
					    <tr id="tr<?= $fields['identify'] ?>" name="tr<?= $fields['identify'] ?>">
					      <th scope="row" id="id<?= $fields['identify'] ?>" name="id<?= $fields['identify'] ?>"><?= str_pad($fields['identify'], 6, "0", STR_PAD_LEFT) ?></th>
					      <td id="name<?= $fields['identify'] ?>" name="name<?= $fields['identify'] ?>"><?= $fields['name'] ?></td>
					      <td class="pl-4" id="qty<?= $fields['identify'] ?>" name"qty<?= $fields['identify'] ?>"> <?= str_pad($fields['total'], 3, "0", STR_PAD_LEFT) ?> </td>
					      <td class="pl-5"> 
							<input class="form-check-input" type="radio" name="radio-test" id="radio<?= $fields['identify'] ?>" value="radio<?= $fields['identify'] ?>" checked>			      		 
			      		  </td>
					    </tr>
				    <?php endforeach ; ?>
				  </tbody>
				</table>
			</div>
			<div class="col-1"></div>
				  
		</div>	<!-- end row -->

		<div class="row mt-1 mx-5 px-5" id="hr-btn-actions2" style="border: 2px ridge #007BFF;"> </div>  <!-- HR -->			

	</div>