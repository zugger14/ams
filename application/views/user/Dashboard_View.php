<?php
  include 'assets/includes/header.php';
  include 'assets/includes/sidebar.php';
?>
   <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">dashboard</h1>
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
                                    <h3><center>Overview of information in Clinic</center></h3><br>
                                        <tr>
                                            <th>Total Patients</th>
                                            <th>Total Dentists</th>
                                            <th>Total Clinics</th>
                                            <th>Total Appointments</th>
                                            <th>Total Services</th>
                                        </tr>
                                        <tr>
                                            <td><?php echo $total_patient;?></td>
                                            <td><?php echo $total_dentist;?></td>
                                            <td><?php echo $total_clinic;?></td>
                                            <td><?php echo $total_appointment;?></td>
                                            <td><?php echo $total_service;?></td>
                                        </tr>
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

