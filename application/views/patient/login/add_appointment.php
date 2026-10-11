<?php
    include 'assets/includes/header.php';
    include 'assets/includes/sidebar.php';
?>
 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                 <h2>  <?php echo isset($info)?"Edit Appointment":"Add Appointment";?></h2></br></br>
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
                                   <form method="post" action="<?php echo isset($info)?site_url('patients/editAppointment').'/'.$id:site_url('patients/addAppointment'); ?>">
                                        <div class="form-group">
                                        <?php echo form_error('appointment_date'); ?>
                                            <label>appointment date:</label><input class="form-control" type="date" name="appointment_date" value="<?php echo isset($info)?$info[0]->appointment_date:set_value('appointment_date'); ?>">
                                        </div>
                                         <div class="form-group">
                                        <label>appointment time:</label><input class="form-control" type="time" name="appointment_time" value="<?php echo isset($info)?$info[0]->appointment_time:set_value('appointment_time'); ?>">
                                        </div>
                                        <div class="form-group">
                                        <label>dentist name:</label><select class="form-control" name="dentist_id">
                                        <?php echo form_error('dentist_id');
                                            foreach ($dentists as $value) {?>
                                                <option value="<?php echo $value->dentist_id;?>" <?php if(isset($info)&&$value->dentist_id===$info[0]->dentist_id) echo 'selected="selected"';?>><?php echo $value->dentist_firstname.' '.$value->dentist_lastname;?></option><?php
                                            }?>
                                        </select>
                                        </div>
                                        <div class="form-group">
                                        <?php echo form_error('clinic_id'); ?>
                                            <label>Select clinic</label>
                                            <select class="form-control" name="clinic_id">
                                            <?php
                                                foreach ($clinic_location as $value){?>
                                                    <option value="<?php echo $value->clinic_id;?>" <?php if(isset($info)&&$dentists[0]->dentist_clinic==$value->clinic_location) echo 'selected="selected"';?>>
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

                                <!-- /.col-lg-6 (nested) -->
                            </div>
                                <center><h4>Dentists Info</h4></center>
                                <table cellspacing="3px" cellpadding="3px" border="2" align="center" bgcolor="lightgrey" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <tr>
                                        <th>name</th>
                                        <th>address</th>
                                        <th>contact</th>
                                        <th>email</th>
                                        <th>Clinic_location</th>
                                    </tr>
                                    <?php
                                        foreach ($dentists as $results) {   ?>
                                            <tr>
                                                <td><?php echo $results->dentist_firstname;?></td>
                                                <td><?php echo $results->dentist_address;?></td>
                                                <td><?php echo $results->dentist_contact;?></td>
                                                <td><?php echo $results->dentist_email;?></td>
                                                <td><?php echo $results->dentist_clinic;?></td>
                                            </tr><?php
                                        }?>
                                </table>
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
