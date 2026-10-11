<?php
  include 'assets/includes/header.php';
  include 'assets/includes/sidebar.php';
?>
   <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Patient dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                        <!-- /.row -->
            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
											<th>Patient_id</th>
											<th>Name</th>
											<th>Address</th>
											<th>Contact</th>
											<th>Email</th>
											<th>Clinic_location</th>
										</tr>
										<?php
											foreach ($data as $results) {	?>
												<tr>
													<td><?php echo $results->patient_id;?></td>
													<td><?php echo $results->patient_firstname.' '.$results->patient_lastname;?></td>
													<td><?php echo $results->patient_address;?></td>
													<td><?php echo $results->patient_contact;?></td>
													<td><?php echo $results->patient_email;?></td>
													<td><?php echo $results->patient_clinic;?></td>
												</tr><?php
											}
										?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
<?php include 'assets/includes/footer.php';?>