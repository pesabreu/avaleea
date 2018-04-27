

<!--  
	menu_candidate.php - Panel Control Candidates 
-->
<?php
	include_once "scripts_invitations.php"; 

	$var = $this->session->userdata("id_people_admin");
	$id_people_admin = isset($var) ? $var : 0;	
?>



      <div class="row" style="margin-top: 20px;">
      	
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>03</h3>

              <p>Invitations Received</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-drafts"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>02<sup style="font-size: 20px"></sup></h3>

              <p>Completed Applications</p>
            </div>
            <div class="icon">
              <i class="ion ion-checkmark-circled"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>04</h3>

              <p>Applications in Progress</p>
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
          <div class="box box-solid box-primary">
            <div class="box-header with-border box-primary">
              <i class="fa fa-child"></i>

              <h3 class="box-title">Invitations and Applications</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body bg-info">

			    <div class="col-md-offset-2 col-md-8">
		          <div class="box box-solid box-info">
		            <div class="box-header with-border">
		              <i class="ion ion-android-contacts"></i>
		
		              <h3 class="box-title">Applications not completed</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body box-default">
		            	<div class="col-md-offset-1 col-md-5">
			            	<a href="" class="btn btn-app bg-olive margin text-center" data-toggle="modal" data-target="#formModalInvitationReceived">
	  							<i class="ion ion-android-drafts"></i> Invitations received
							</a>
						</div>
						<div class="col-md-offset-1 col-md-5">
			            	<a class="btn btn-app bg-olive margin text-center" data-toggle="modal" data-target="#formModalInvitationApplication">
	  							<i class="ion ion-clipboard"></i> Applications in progress
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
	        	</div> 		<!-- /.box-header -->
	        	
	        	<div class="box-body bg-info">							        			        	
	        	</div>      <!-- ./box-body -->
	        </div>      <!-- /.box-solid -->
	            
	        <div class="box-footer bg-navy">
	        </div>     <!-- /.box-footer -->            
	    </div>         <!-- /.col-md-10 -->
	
	  </div>            <!-- /.row -->

	
	<?= include_once "modal_invitations.php";        					// windows modal ?>
		
	<!-- jQuery 2.2.3 -->
	<script src="<?php echo base_url() .'assets/'; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="<?php echo base_url() .'assets/'; ?>bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() .'assets/'; ?>dist/js/app.min.js"></script>

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
//	    $('#formModalInvitationEmail').modal('show');				//	menuModalSystem
	})


	
</script>



