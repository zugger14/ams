<?php
  include 'assets/includes/header.php';
  include 'assets/includes/sidebar.php';
?>
   <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">weekly report of dentist</h1>
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
				    					  <th>dentist name</th>
					                      <th>total appointment during week</th>
	    								  <th>view details</th>
									    </tr>
										<?php $i=1;
											foreach ($result as $results) {	?>
												<tr>
													<td><?php echo $i;?></td>
													<td><?php echo $results->dentist_firstname.' '.$results->dentist_lastname;?></td>
													<td><?php echo $num[$i-1];$i++;?></td>
													<td><a href="<?php echo base_url();?>clinics/viewDetail/<?php echo $results->dentist_id;?>/<?php echo $date;?>"><button>view</button></a></td>
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
