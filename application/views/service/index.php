<?php
  include 'assets/includes/header.php';
  include 'assets/includes/sidebar.php';
?>
   <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Services</h1>
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
											<th>Name</th>
											<th>Price (in Rs.)</th>
											<th>Clinic</th>
											<th>Start Date</th>
											<th>Actions</th>
										</tr>
                                    </thead>
                                    <tbody>
										<?php
                                        if(!empty($result)){
											foreach ($result as $results) {	?>
												<tr>
													<td><?php echo htmlspecialchars($results->service_name);?></td>
													<td>Rs. <?php echo htmlspecialchars($results->service_price);?></td>
													<td><?php echo htmlspecialchars($results->service_clinic);?></td>
													<td><?php echo htmlspecialchars($results->service_startdate);?></td>
													<td>
														<a href="<?php echo base_url();?>services/show/<?php echo $results->service_id;?>"><button class="btn btn-xs btn-info">show</button></a>&nbsp;
														<a href="<?php echo base_url();?>services/delete/<?php echo $results->service_id;?>"><button class="btn btn-xs btn-danger">delete</button></a>&nbsp;
														<a href="<?php echo base_url();?>services/edit/<?php echo $results->service_id;?>"><button class="btn btn-xs btn-warning">edit</button></a>
													</td>
												</tr><?php
											}
                                        } else { ?>
                                            <tr>
                                                <td colspan="5" class="text-center">No services recorded yet. <a href="<?php echo base_url();?>services/add">Add a service</a></td>
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
