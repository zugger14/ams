<?php
  include 'assets/includes/header.php';
  include 'assets/includes/sidebar.php';
?>
   <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dentist Info</h1>
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
										  <th>Dentist_id</th>
				    					  <th>FirstName</th>
					                      <th>LastName</th>
	    								  <th>Address</th>
										  <th>Contact</th>
										  <th>Email</th>
										  <th>Clinic_location</th>
										  <th>Actions</th>
									    </tr>
										<?php
											foreach ($result as $results) {	?>
												<tr>
													<td><?php echo $results->dentist_id;?></td>
													<td><?php echo $results->dentist_firstname;?></td>
					  	                            <td><?php echo $results->dentist_lastname;?></td>
													<td><?php echo $results->dentist_address;?></td>
													<td><?php echo $results->dentist_contact;?></td>
													<td><?php echo $results->dentist_email;?></td>
													<td><?php echo $results->dentist_clinic;?></td>
													<td>
														<a href="<?php echo base_url();?>dentists/delete/<?php echo $results->dentist_id;?>"><button>delete</button></a>
														<a href="<?php echo base_url();?>dentists/edit/<?php echo $results->dentist_id;?>"><button>edit</button></a>
													</td>
			             						</tr><?php
											}?>
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
