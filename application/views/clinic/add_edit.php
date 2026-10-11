<?php
	include 'assets/includes/header.php';
	include 'assets/includes/sidebar.php';
?>
 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo isset($info)?"Edit Clinic Info":"Add New Clinics";?></h1>
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
                                    <form role="form" method="post" action="<?php echo isset($info)?site_url('clinics/edit').'/'.$id:site_url('clinics/add');?>">
                                        <div class="form-group">
                                     			<label>location:</label><input  class="form-control" type="text" name="clinic_location" value="<?php echo isset($info)?$info[0]->clinic_location:set_value('clinic_location');?>">
                                        </div>
                                         <div class="form-group">
                                        	clinic_type:<select name="clinic_type" class="form-control">
												<option value="main" <?php if(isset($info)&&$info[0]->clinic_type=="main") echo 'selected="selected"';?>>main</option>
												<option value="branch" <?php if(isset($info)&&$info[0]->clinic_type=="branch") echo 'selected="selected"';?>>branch</option>
											</select><br>
		                                    <button type="submit" class="btn btn-default"><?php echo isset($id)?"Edit":"Add";?></button>
		                                    <button type="reset" class="btn btn-default">Reset</button>
                                        </div>
                                    </form>
                                </div>
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
