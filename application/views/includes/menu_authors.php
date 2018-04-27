
<?php
	include_once "scripts_questionnaires.php";
	include_once "scripts_application.php"; 
?>
	
      <div class="row" style="margin-top: 20px;">
      	
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>36</h3>

              <p>Created Questionnaires</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>05<sup style="font-size: 20px"></sup></h3>

              <p>Answered Questionnaires</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>50</h3>

              <p>Questionnaires Applied</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-text-o"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
      </div>
      <!-- /.row -->


      <div class="row" style="margin-top: 10px;">

        <div class="col-md-offset-1 col-md-10">
          <div class="box box-solid box-default">
            <div class="box-header with-border bg-olive">
              <i class="fa fa-database"></i>

              <h3 class="box-title">Registration</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body bg-info">
		        		        
		        <div class="col-md-offset-1 col-lg-4 col-xs-12">
		          <!-- small box -->
		          <div class="small-box bg-teal">
		            <div class="inner">
		              <h4>Questionnaires</h4>
		
		              <p>&nbsp; <i class="fa fa-list-ul"></i></p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-list-ol"></i>
		            </div>
		            <a href="" class="small-box-footer" data-backdrop="static" data-toggle="modal" data-target="#formModalQuestionnaires">
		            	more info 
		            	<i class="fa fa-arrow-circle-right"></i>
	            	</a>
		          </div>
		        </div>
		        <!-- ./col -->
	        
		        <div class="col-md-offset-2 col-lg-4 col-xs-12">
		          <!-- small box -->
		          <div class="small-box" style="background-color: #FFD700;">
		            <div class="inner">
		              <h4>Applications</h4>
		
		              <p>&nbsp; <i class="fa fa-building-o"></i></p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-building-o"></i>
		            </div>
		            <a href="" class="small-box-footer" data-backdrop="static" data-toggle="modal" data-target="#formModalApplications">
		            	more info 
		            	<i class="fa fa-arrow-circle-right"></i>
	            	</a>
		          </div>
		        </div>
		        <!-- ./col -->			
				
            </div>
            <!-- /.box-body -->
	            
            <div class="box-footer bg-olive">
            </div>
            
          </div>
          <!-- /.box -->
        </div>

      </div>
      <!-- /.row -->


      <div class="row" style="margin-top: 10px;">
        <div class="col-md-offset-1 col-md-10">
          <div class="box box-solid box-primary">
            <div class="box-header with-border box-primary">
              <i class="fa fa-child"></i>

              <h3 class="box-title">Make Invitations</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body bg-info">

			    <div class="col-md-offset-2 col-md-8">
		          <div class="box box-solid box-info">
		            <div class="box-header with-border">
		              <i class="ion ion-android-contacts"></i>
		
		              <h3 class="box-title">Invitations to Candidates</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body box-default">
		            	<div class="col-md-offset-1 col-md-5">
			            	<a href="<?= base_url('people') ?>" class="btn btn-app bg-olive margin">
	  							<i class="ion ion-android-person-add"></i> Candidate registration
							</a>
						</div>
						<div class="col-md-offset-1 col-md-5">
			            	<a class="btn btn-app bg-olive margin text-center" data-toggle="modal" data-target="#formModalInvitationCandidates">
	  							<i class="ion ion-android-mail"></i> Send invitation with link
							</a>
						</div>
		            </div>
		            <!-- /.box-body -->
		            <!--<div class="box-footer bg-navy">
		            </div>-->
		            
		          </div>
		          <!-- /.box -->
		        </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" style="background-color: #3c8dbc;">
            </div>
            
          </div>
          <!-- /.box -->
        </div>

      </div>
      <!-- /.row -->



      <div class="row" style="margin-top: 10px;">

        <div class="col-md-offset-1 col-md-10">
          <div class="box box-solid box-default">
            <div class="box-header with-border bg-navy">
              <i class="fa fa-database"></i>

              <h3 class="box-title">Administrative Reports</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body bg-info">
							        			        	
	        </div>
		        <!-- ./col -->


            </div>
            <!-- /.box-body -->
	            
            <div class="box-footer bg-navy">
            </div>
            
          </div>
          <!-- /.box -->
        </div>

      </div>
      <!-- /.row -->


		<?php
			// windows modal			
			include_once "modal_questionnaire.php";
		 	include_once "modal_questions.php";
			include_once "modal_alternatives.php";
			include_once "modal_application.php";
			
		?>


		
<!-- jQuery 2.2.3 -->
	<!-- <script src="<?php echo base_url() .'assets/'; ?>plugins/jQuery/jquery-2.2.3.min.js"></script> -->
	<!-- Bootstrap 3.3.6 -->
	<!-- <script src="<?php echo base_url() .'assets/'; ?>bootstrap/js/bootstrap.min.js"></script> -->
    <!-- AdminLTE App -->
    <!-- <script src="<?php echo base_url() .'assets/'; ?>dist/js/app.min.js"></script> -->

<script type="text/javascript">

/*	$(document).ajaxStart(function() { 
		alert("oi");
		Pace.restart(); 
	});
*/

	$(function () {
		//$('#myModal').on('shown.bs.modal', function () {
		 // $('#myInput').focus()
		//});
	});

	
	$(document).ready(function() {
		$('#edit_questionnaire').hide();	
//	    $('#formModalInvitationEmail').modal('show');				//	menuModalSystem
	})


	
</script>



