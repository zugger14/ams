<?php
	include 'assets/includes/header.php';
	include 'assets/includes/sidebar.php';
?>
 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo isset($info)?"Edit Dentists":"Add New Dentists";?></h1>
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
                                    <form role="form" method="post" action="<?php echo isset($info)?site_url('dentists/edit').'/'.$id:site_url('dentists/add');?>">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Enter First Name" name="dentist_firstname" value="<?php echo isset($info)?$info[0]->dentist_firstname:set_value('dentist_firstname');?>">
                                        </div>
                                         <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Enter Last Name" name="dentist_lastname" value="<?php echo isset($info)?$info[0]->dentist_lastname:set_value('dentist_lastname');?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="number" placeholder="Enter Contact" name="dentist_contact" value="<?php echo isset($info)?$info[0]->dentist_contact:set_value('dentist_contact');?>">
                                        </div>
                                       	<div class="form-group">
                                            <input class="form-control" type="text" placeholder="Enter Address" name="dentist_address" value="<?php echo isset($info)?$info[0]->dentist_address:set_value('dentist_address');?>">
                                        </div>
                                       <?php
                                            if(!isset($info)){?>

                                                <div class="form-group">
                                                    <input class="form-control" type="email" placeholder="Enter Email" name="dentist_email" value="<?php echo set_value('dentist_email');?>">
                                                </div><?php
                                            }
                                            else{?>
                                                <div class="form-group"><?php
                                                if(empty($info[0]->dentist_email)){?>
                                                 <a href="<?php echo base_url().'dentists/edit_email/'.$id.'/add';?>">add email</a><?php

                                                }
                                                else{ echo "<label>email</label>:".$info[0]->dentist_email;?>
                                                    <a href="<?php echo base_url().'dentists/edit_email/'.$id.'/delete';?>">remove</a><?php
                                                }?>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                        <div class="form-group">
                                            <label>Select clinic</label>
                                            <select class="form-control" name="dentist_clinic">
                                            <?php
												foreach ($clinic_location as $value){?>
                                                	<option value="<?php echo $value->clinic_location;?>" <?php if(isset($info)&&$info[0]->dentist_clinic==$value->clinic_location) echo 'selected="selected"';?>>
													<?php echo $value->clinic_location;?>
													</option><?php
												}
                                            ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-default"><?php echo isset($id)?"Edit":"Add";?></button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
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
