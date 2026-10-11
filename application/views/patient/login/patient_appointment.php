<?php
  include 'assets/includes/header.php';
  include 'assets/includes/sidebar.php';
?>
   <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">My Appointment</h1>
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
											<th>appointment made date</th>
											<th>appointment time</th>
											<th>appointment date</th>
											<th>dentist name</th>
											<th>clinic name</th>
											<th>action1</th>
											<th>action2</th>
										</tr>
										<?php
											if(!empty($data)){
												foreach ($data as $results) {	?>
												<tr>
													<td><?php echo $results->appointment_made_date;?></td>
													<td><?php echo $results->appointment_time;?></td>
													<td><?php echo $results->appointment_date;?></td>
													<td><?php echo $results->dentist_firstname.' '.$results->dentist_lastname;?></td>
													<td><?php echo $results->clinic_location;?></td>
													<td><a href="<?php echo base_url();?>patients/cancelAppointment/<?php echo $results->appointment_id;?>"><button class="btn btn-xs btn-danger">cancel</button></a></td>
													<td><a href="<?php echo base_url();?>patients/editAppointment/<?php echo $results->appointment_id;?>"><button class="btn btn-xs btn-warning">edit</button></a></td>
												</tr><?php
												}
											} else { ?>
												<tr>
													<td colspan="7" class="text-center">No upcoming appointments found. <a href="<?php echo base_url();?>patients/addAppointment">Book an Appointment</a></td>
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
                <!-- /.col-lg-6 -->
<?php include 'assets/includes/footer.php';?>
