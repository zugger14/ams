<?php
  include 'assets/includes/header.php';
  include 'assets/includes/sidebar.php';
?>
   <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Services in Clinics</h1>
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
											<th>Services</th>
											<th>Price (in Rs.)</th>
											<th>Start Date</th>
											<th>Clinic</th>
										</tr>
                                    </thead>
                                    <tbody>
										<?php
                                        if(!empty($result)){
                                            $i=1;
											foreach ($result as $results) {	?>
												<tr>
													<td><?php echo $i;$i++;?></td>
													<td><?php echo htmlspecialchars($results->service_name);?></td>
													<td>Rs. <?php echo htmlspecialchars($results->service_price);?></td>
													<td><?php echo htmlspecialchars($results->service_startdate); ?></td>
													<td><?php echo htmlspecialchars($results->service_clinic);?></td>
												</tr><?php
											}
                                        } else { ?>
                                            <tr>
                                                <td colspan="5" class="text-center">No services currently available.</td>
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
            <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
<?php include 'assets/includes/footer.php';?>