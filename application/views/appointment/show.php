<?php
include 'assets/includes/header.php';
include 'assets/includes/sidebar.php';
?><div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Apppointments Info</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>appointment made date</th>
																						<th>appointment time</th>
																						<th>appointment date</th>
																						<th>patient name</th>
																						<th>dentist name</th>
																						<th>clinic name</th>
																						<th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $i=1;
                                        foreach ($result as $results) {	?>
																	      	<tr class="odd gradeX">
																	       		<td><?php echo $i; $i++ ; ?></td><!--for serial number-->
																						<td><?php echo $results->appointment_made_date;?></td>
																						<td><?php echo $results->appointment_time;?></td>
																						<td><?php echo $results->appointment_date;?></td>
																						<td><?php echo $results->patient_firstname.' '.$results->patient_lastname;?></td>
																						<td><?php echo $results->dentist_lastname.' '.$results->dentist_lastname;?></td>
																						<td><?php echo $results->clinic_location;?></td>
																		       	<td>
																				       <a href="<?php echo base_url();?>appointments/delete/<?php echo $results->appointment_id;?>"><button>delete</button></a>
										                           <a href="<?php echo base_url();?>appointments/edit/<?php echo $results->appointment_id;?>"><button>edit</button></a>&nbsp &nbsp
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
