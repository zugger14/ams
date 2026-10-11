<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <?php
                            $side_dash = base_url().'login';
                            if($this->session->userdata('logged_in_userid')) $side_dash = base_url().'dashboard';
                            elseif($this->session->userdata('logged_in_patient_id')) $side_dash = base_url().'patients_profile';
                            elseif($this->session->userdata('logged_in_dentist_id')) $side_dash = base_url().'dentists_profile';
                            ?>
                            <a href="<?php echo $side_dash;?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <?php if($this->session->userdata('logged_in_userid')){?>
                            <li>
                                <a href="#">patients<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo base_url().'patients';?>">Show all patients</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url().'patients/add';?>">Add Patients</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url().'patients/search';?>">Search patient by id code</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                             <li>
                            <a href="#">Dentists<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url().'dentists';?>">Show all dentists</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url().'dentists/add';?>">Add dentist</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                            <a href="#">Clinics<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url().'clinics';?>">Show all clinics</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url().'clinics/add';?>">Add clinic</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                            <a href="#">Appointments<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url().'appointments';?>">Show all appointments</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url().'appointments/add';?>">Add appointment</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#">Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url().'report/dentist';?>">weekly Report of dentist </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url().'report/day';?>">appointment report of day ahead</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url().'report/clinic';?>">weekly report of clinics</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#">Services<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url().'services';?>">Show all services</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url().'services/add';?>">Add services</a>
                                </li>
                            </ul>
                                <!-- /.nav-second-level -->
                        </li><?php
                        }
                        else if($this->session->userdata('logged_in_patient_id')){?>
                         <li>
                            <a href="<?php echo base_url();?>patients/appointment">My Appointment</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>patients/addAppointment">Add appointment</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'patients/notification';?>">Notifications</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'patients/showServices';?>">Services</a>
                        </li>
                        <?php
                        }
                        else{?>
                        <li>
                            <a href="<?php echo base_url();?>dentists/appointment">My Appointment</a>
                        </li>
                         <li>
                            <a href="<?php echo base_url().'dentists/notification';?>">My Notifications</a>
                        </li>
                         <li>
                            <a href="<?php echo base_url().'dentists/showServices';?>">Services</a>
                        </li>
                        <?php
                        }
                        ?>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
