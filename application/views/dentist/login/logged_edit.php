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
                                                Firstname:<input class="form-control" type="text" name="dentist_firstname" value="<?php echo $value->dentist_firstname; ?>"><br>
                                                Lastname:<input class="form-control" type="text" name="dentist_lastname" value="<?php echo $value->dentist_lastname; ?>"><br>
                                                Contact:<input class="form-control" type="number" name="dentist_contact" value="<?php echo $value->dentist_contact; ?>"><br>
                                                Address<input class="form-control" type="text" name="dentist_address" value="<?php echo $value->dentist_address; ?>"><br>
                                                Email:<input class="form-control" type="email" name="dentist_email" value="<?php echo $value->dentist_email; ?>"><br>
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