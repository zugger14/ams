<?php
include 'assets/includes/header.php';
include 'assets/includes/sidebar.php';
?><div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Patients</h1>
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
                                            <th>FirstName</th>
                                            <th>LastName</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if(!empty($result)){
                                            $i=1;
                                            foreach ($result as $results) { ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $i; $i++ ; ?></td>
                                                    <td><?php echo htmlspecialchars($results->patient_firstname);?></td>
                                                    <td><?php echo htmlspecialchars($results->patient_lastname);?></td>
                                                    <td><?php echo htmlspecialchars($results->patient_address);?></td>
                                                    <td>
                                                        <a href="<?php echo base_url();?>patients/show/<?php echo $results->patient_id;?>"><button class="btn btn-xs btn-info">show</button></a>&nbsp;
                                                        <a href="<?php echo base_url();?>patients/delete/<?php echo $results->patient_id;?>"><button class="btn btn-xs btn-danger">delete</button></a>&nbsp;
                                                        <a href="<?php echo base_url();?>patients/edit/<?php echo $results->patient_id;?>"><button class="btn btn-xs btn-warning">edit</button></a>
                                                    </td>
                                                </tr><?php
                                            }
                                        } else { ?>
                                            <tr>
                                                <td colspan="5" class="text-center">No patients registered yet. <a href="<?php echo base_url();?>patients/add">Add a patient</a></td>
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
