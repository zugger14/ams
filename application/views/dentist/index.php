<?php
include 'assets/includes/header.php';
include 'assets/includes/sidebar.php';
?><div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dentists</h1>
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
                                                    <td><?php echo htmlspecialchars($results->dentist_firstname);?></td>
                                                    <td><?php echo htmlspecialchars($results->dentist_lastname);?></td>
                                                    <td><?php echo htmlspecialchars($results->dentist_address);?></td>
                                                    <td>
                                                        <a href="<?php echo base_url();?>dentists/show/<?php echo $results->dentist_id;?>"><button class="btn btn-xs btn-info">show</button></a>&nbsp;
                                                        <a href="<?php echo base_url();?>dentists/delete/<?php echo $results->dentist_id;?>"><button class="btn btn-xs btn-danger">delete</button></a>&nbsp;
                                                        <a href="<?php echo base_url();?>dentists/edit/<?php echo $results->dentist_id;?>"><button class="btn btn-xs btn-warning">edit</button></a>
                                                    </td>
                                                </tr><?php
                                            }
                                        } else { ?>
                                            <tr>
                                                <td colspan="5" class="text-center">No dentists registered yet. <a href="<?php echo base_url();?>dentists/add">Add a dentist</a></td>
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