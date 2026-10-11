
<?php
    include 'assets/includes/header.php';
    include 'assets/includes/sidebar.php';
?>
 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                 <h2>Account Settings</h2></br></br>
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
                                        <p>please fill all the fields.</p>
                                            <input type="text" class="form-control" placeholder="enter username" name="login_username" value="<?php echo set_value('login_username');?>"><br>
                                            <input type="password" placeholder="enter password" class="form-control" name="login_password" value="<?php echo set_value('login_password');?>"><br>
                                            <input type="password" placeholder="enter password again" class="form-control" name="re_password" value="<?php echo set_value('re_password');?>"><br>
                                            <input type="email" placeholder="enter email" class="form-control" name="login_email" value="<?php echo set_value('login_email');?>"><br>
                                        </div>
                                        <button type="submit" class="btn btn-default">Add</button>
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