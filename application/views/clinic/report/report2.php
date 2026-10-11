<?php
  include 'assets/includes/header.php';
  include 'assets/includes/sidebar.php';
?>
   <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Appointments Scheduled For Day Ahead</h1>
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
										    <th>S.N</th>
											<th>Appointment Made Date</th>
											<th>Appointment Time</th>
											<th>Appointment Date</th>
											<th>Patient Name</th>
											<th>Dentist Name</th>
											<th>Clinic Name</th>
									    </tr>
                                    </thead>
                                    <tbody>
										<?php
                                        if(!empty($result)){
                                            $i=1;
											foreach ($result as $results) {	?>
												<tr>
													<td><?php echo $i; $i++;?></td>
													<td><?php echo htmlspecialchars($results->appointment_made_date);?></td>
													<td><?php echo htmlspecialchars($results->appointment_time);?></td>
													<td><?php echo htmlspecialchars($results->appointment_date);?></td>
													<td><?php echo htmlspecialchars($results->patient_firstname.' '.$results->patient_lastname);?></td>
													<td><?php echo htmlspecialchars($results->dentist_firstname.' '.$results->dentist_lastname);?></td>
													<td><?php echo htmlspecialchars($results->clinic_location);?></td>
			             						</tr><?php
											}
                                        } else { ?>
                                            <tr>
                                                <td colspan="7" class="text-center">No appointments scheduled for the day ahead.</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-10 -->
            </div>
    </div>
<?php include 'assets/includes/footer.php';?>
