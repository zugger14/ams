<?php
  include 'assets/includes/header.php';
  include 'assets/includes/sidebar.php';
?>
   <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Services Info</h1>
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
																					<th>name</th>
																					<th>price(in Rs.)</th>
																					<th>clinic</th>
																					<th>startdate</th>
																					<th>Actions</th>
																				</tr>
																				<?php
																					foreach ($result as $results) {	?>
																						<tr>
																							<td><?php echo $results->service_name;?></td>
																							<td><?php echo $results->service_price;?></td>
																							<td><?php echo $results->service_clinic;?></td>
																							<td><?php echo $results->service_startdate;?></td>
																							<td>
																								<a href="<?php echo base_url();?>services/delete/<?php echo $results->service_id;?>"><button>delete</button></a>&nbsp &nbsp
																								<a href="<?php echo base_url();?>services/edit/<?php echo $results->service_id;?>"><button>edit</button></a>&nbsp &nbsp
																							</td>
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
