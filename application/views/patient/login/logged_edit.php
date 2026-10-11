<?php
    include 'assets/includes/header.php';
    include 'assets/includes/sidebar.php';
?>
 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                 <h2>Edit Profile</h2></br></br>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                   <form method="post">
                                        <div class="form-group">
                                        <p>change the following fields you wish.</p><?php
                                            foreach ($info as $value) {?>
                                                Firstname:<input type="text" class="form-control" name="patient_firstname" value="<?php echo $value->patient_firstname; ?>"><br>
                                                Lastname:<input type="text" class="form-control" name="patient_lastname" value="<?php echo $value->patient_lastname; ?>"><br>
                                                Contact:<input type="number" class="form-control" name="patient_contact" value="<?php echo $value->patient_contact; ?>"><br>
                                                Address<input type="text" class="form-control" name="patient_address" value="<?php echo $value->patient_address; ?>"><br>
                                                Email:<input type="email" class="form-control" name="patient_email" value="<?php echo $value->patient_email; ?>"><br>
                                            <?php
                                            }?>
                                        </div>
                                        <button type="submit" class="btn btn-default">Edit  </button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
<?php
    include 'assets/includes/footer.php';
?>