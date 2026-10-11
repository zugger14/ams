<?php
	include 'assets/includes/header.php';
	include 'assets/includes/sidebar.php';
?>
 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo isset($info)?"Edit services":"Add New services";?></h1>
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
                                    <form role="form" method="post" action="<?php echo isset($info)?site_url('services/edit').'/'.$id:site_url('services/add');?>">
                                        <div class="form-group">
                                     			<label>Service:</label><input class="form-control" type="text" name="service_name" value="<?php echo isset($info)?$info[0]->service_name:set_value('service_name'); ?>">
                                        </div>
                                        <div class="form-group">
                                        	<label>Price:</label><input class="form-control" type="number" name="service_price" value="<?php echo isset($info)?$info[0]->service_price:set_value('service_price'); ?>">
                                        </div>
                                        <div class="form-group">
                                        	<label>clinic_location:</label><select class="form-control" name="service_clinic"><br><br>
																					<?php
																						foreach ($clinic_location as $value) {
																							?><option value="<?php echo $value->clinic_location;?>"<?php if(isset($info)&&$info[0]->service_clinic==$value->clinic_location) echo 'selected="selected"';?>><?php echo $value->clinic_location;?></option><?php
																						}?>
																					</select>
                                				</div>
                                        <div class="form-group">
	                                        <button type="submit" class="btn btn-default"><?php echo isset($id)?"Edit":"Add";?></button>
			                                    <button type="reset" class="btn btn-default">Reset</button>
                                        </div>
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