<?php
include 'assets/includes/header.php';
include 'assets/includes/sidebar.php';
?><div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Appointments</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-11">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>patient name</th>
											<th>dentist name</th>
											<th>clinic location</th>
											<th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if(!empty($result)){
                                            $i=1;
                                            foreach ($result as $results) {	?>
									       <tr class="odd gradeX">
									           <td><?php echo $i; $i++ ; ?></td><!--for serial number-->
										       <td><?php echo $results->patient_firstname.' '.$results->patient_lastname;?></td>
											   <td><?php echo $results->dentist_firstname.' '.$results->dentist_lastname;?></td>
											   <td><?php echo $results->clinic_location;?></td>
										       <td>
		                                          <a href="<?php echo base_url();?>appointments/show/<?php echo $results->appointment_id;?>"><button>show</button></a>&nbsp &nbsp
												  <a href="<?php echo base_url();?>appointments/delete/<?php echo $results->appointment_id;?>"><button>delete</button></a>&nbsp &nbsp
		                                          <a href="<?php echo base_url();?>appointments/edit/<?php echo $results->appointment_id;?>"><button>edit</button></a>&nbsp &nbsp
											   </td>
										   </tr><?php
									       }
                                        } else { ?>
                                            <tr>
                                                <td colspan="5" class="text-center">No appointments found. <a href="<?php echo base_url();?>appointments/add">Add a new appointment</a></td>
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
                <!-- /.col-lg-12 -->
            </div>
<?php include 'assets/includes/footer.php';?>