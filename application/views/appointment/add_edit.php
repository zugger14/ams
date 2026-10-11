<?php
    include 'assets/includes/header.php';
    include 'assets/includes/sidebar.php';
?>
 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                   <?php echo isset($info)?"Edit Appointment":"Add New Appointment";?></br></br>
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
                                   <form method="post" action="<?php echo isset($info)?site_url('appointments/edit').'/'.$id:site_url('appointments/add'); ?>">
                                        <div class="form-group">
                                            <label>appointment date:</label><input class="form-control" type="date" name="appointment_date" value="<?php echo isset($info)?$info[0]->appointment_date:set_value('appointment_date'); ?>">
                                        </div>
                                         <div class="form-group">
                                        <lable>appointment time:</lable><input class="form-control" type="time" name="appointment_time" value="<?php echo isset($info)?$info[0]->appointment_time:set_value('appointment_time'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>patient name:</label><select class="form-control" name="patient_id">
                                            <?php
                                                foreach($patients as $value) {?>
                                                    <option value="<?php echo $value->patient_id;?>"<?php if(isset($info)&&$value->patient_id===$info[0]->patient_id) echo 'selected="selected"';?>><?php echo $value->patient_firstname.' '.$value->patient_lastname;?></option><?php
                                                }?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                        <label>dentist name:</label><select class="form-control" name="dentist_id"><?php
                                            foreach ($dentists as $value) {?>
                                                <option value="<?php echo $value->dentist_id;?>"<?php if(isset($info)&&$value->dentist_id===$info[0]->dentist_id) echo 'selected="selected"';?>><?php echo $value->dentist_firstname.' '.$value->dentist_lastname;?></option><?php
                                            }?>
                                        </select>
                                        </div>
                                        <div class="form-group">
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
                                <hr>
                                <a href="<?php echo base_url();?>appointments/add/show">See Existing Appointments..</a>
                                <?php if(isset($result)) {?>
                                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                          <tr>
                                              <th>S.N</th>
                                              <th>appointment made date</th>
                                              <th>appointment time</th>
                                              <th>appointment date</th>
                                              <th>patient name</th>
                                              <th>dentist name</th>
                                              <th>clinic name</th>
                                              <th>action</th>
                                          </tr>
                                          <?php
                                          $i=1;
                                            foreach ($result as $results) { ?>
                                                <tr class="odd gradeX">
                                                  <td><?php echo $i; $i++ ; ?></td><!--for serial number-->
                                                  <td><?php echo $results->appointment_made_date;?></td>
                                                  <td><?php echo $results->appointment_time;?></td>
                                                  <td><?php echo $results->appointment_date;?></td>
                                                  <td><?php echo $results->patient_firstname;?></td>
                                                  <td><?php echo $results->dentist_firstname;?></td>
                                                  <td><?php echo $results->clinic_location;?></td>
                                                  <td>
                                                    <a href="<?php echo base_url();?>appointments/delete/<?php echo $results->appointment_id;?>"><button>delete</button></a>&nbsp &nbsp
                                                    <a href="<?php echo base_url();?>appointments/edit/<?php echo $results->appointment_id;?>"><button>edit</button></a>&nbsp &nbsp
                                                  </td>
                                                </tr><?php
                                            }?>
                                  </table>
                                 <?php
                                 }
                                 ?>
                                 <hr>
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
