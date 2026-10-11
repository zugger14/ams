<?php
include 'assets/includes/header.php';
include 'assets/includes/sidebar.php';
?><div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Clinics</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                          <th>S.N</th>
																					<th>location</th>
																					<th>clinic_type</th>
																					<th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $i=1;
                                        foreach ($result as $results) {	?>
																	      	<tr class="odd gradeX">
																	       		<td><?php echo $i; $i++;?></td>
																						<td><?php echo $results->clinic_location;?></td>
																						<td><?php echo $results->clinic_type;?></td>
																		       	<td>
																				       <a href="<?php echo base_url();?>clinics/delete/<?php echo $results->clinic_id;?>"><button>delete</button></a>&nbsp &nbsp
										                           <a href="<?php echo base_url();?>clinics/edit/<?php echo $results->clinic_id;?>"><button>edit</button></a>&nbsp &nbsp
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
                <!-- /.col-lg-12 -->
            </div>

<?php include 'assets/includes/footer.php';?>